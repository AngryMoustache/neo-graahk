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

        $json->each(function ($trigger, $key) use (&$text) {
            // Trigger
            $text = $text->append(config("card-text.$key"));

            // Event
            $count = 0;
            $trigger = collect($trigger);
            $trigger->each(function ($event, $key) use (&$text, &$count, $trigger) {
                $count++;

                if (optional($event)->operator) {
                    if ($count > 1) {
                        $text = $text->append(', then ');
                    }

                    $newText = config("card-text.$key.$event->operator");
                    $newText = Str::of($newText)->replace('%s', $event->amount ?? '');
                    $text = $text->append($newText);
                }

                if ($count >= $trigger->count()) {
                    $text = $text->append('. ');
                }
            });
        });

        return $text;
    }
}
