<?php

namespace App\Http\Livewire;

use App\Lube\Fields\Field;
use App\Models\Attachment;
use Livewire\Component;
use Livewire\WithFileUploads;

class AttachmentPicker extends Component
{
    use WithFileUploads;

    public $item = null;
    public $picked = null;
    public $fieldName = null;
    public $selecting = false;
    public $uploading = false;
    public $upload;

    public function mount(Field $field)
    {
        $this->fieldName = $field->getName();
        $item = old($this->fieldName) ?? $field->getValue();
        $this->item = $item;
        $this->picked = $item;
    }

    public function openSelectingModal()
    {
        $this->selecting = true;
    }

    public function openUploadingModal()
    {
        $this->uploading = true;
    }

    public function closeModal()
    {
        $this->selecting = false;
        $this->uploading = false;
    }

    public function chooseAttachment($attachment)
    {
        $this->item = $attachment;
        $this->picked = $attachment;
        $this->closeModal();
    }

    public function uploadFile()
    {
        $attachment = Attachment::lubeUpload($this->upload);
        if (optional($attachment)->id) {
            $this->item = $attachment->id;
            $this->picked = $attachment->id;
            $this->closeModal();
        }
    }

    public function resetImage()
    {
        $this->item = null;
        $this->picked = null;
    }

    public function render()
    {
        if ($this->item) {
            $item = Attachment::find($this->item);
            if ($item) {
                $this->item = $item->format('thumb');
            }
        }

        if ($this->selecting) {
            $attachments = Attachment::get();
            return view('livewire.attachment-picker', [
                'attachments' => $attachments
            ]);
        }

        return view('livewire.attachment-picker');
    }
}
