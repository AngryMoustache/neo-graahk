<?php

namespace App\Lube\Fields;

use App\Models\Attachment;

class AttachmentField extends Field
{
    public $component = 'lube.fields.attachment';
    public $showComponent = 'lube.fields.show.attachment';

    public function renderShow()
    {
        $id = $this->getValue();
        return view($this->showComponent, [
            'field' => $this,
            'attachment' => ($id ? Attachment::find($id) : null)
        ]);
    }
}
