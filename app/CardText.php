<?php

namespace App;

use Illuminate\Support\Str;

/**
 * Parser to read out the JSOn card text as human readable strings
 */
class CardText
{
    public static function parse($json): string
    {
        if ($json === null) {
            return '';
        }

        $text = Str::of('');
        $json = collect($json);

        $json->each(function ($trigger) use (&$text) {
            if (!optional($trigger)['trigger'] || !optional($trigger)['events']) {
                return false;
            }

            // Trigger
            $text = $text->append(config("card-text.{$trigger['trigger']}"));

            // Events
            $count = 0;
            $trigger = collect($trigger['events']);
            $trigger->each(function ($event) use (&$text, &$count, $trigger) {
                $count++;
                $key = $event['event'] ?? null;
                $parameters = $event['parameters'] ?? null;

                if ($parameters) {
                    if ($count > 1) {
                        $text = $text->append(', then ');
                    }

                    foreach ($parameters as $pKey => $parameter) {
                        if (config("card-text.$key.$parameter")) {
                            $newText = config("card-text.$key.$parameter");
                            while (Str::contains($newText, '%')) {
                                preg_match('/%\w+/', $newText, $param);
                                $newText = Str::of($newText)
                                    ->replace($param, $parameters[ltrim($param[0], '%')] ?? '');
                            }

                            $text = $text->append($newText);
                        }
                    }
                }

                if ($count >= $trigger->count()) {
                    $text = $text->append('. ');
                }
            });
        });

        return $text;
    }
}
