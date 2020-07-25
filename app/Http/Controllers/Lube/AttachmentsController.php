<?php

namespace App\Http\Controllers\Lube;

use App\Lube\Forms\AttachmentForm;
use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentsController extends LubeController
{
    public $model = Attachment::class;
    public $form = AttachmentForm::class;
    public $routeBase = 'attachments';

    public $label = 'Attachment';
    public $labelPlural = 'Attachments';

    public function store(Request $request)
    {
        $request->validate((new $this->form)->validation());

        $item = $this->model::create([
            'original_name' => $request->image->getClientOriginalName(),
            'alt_name' => $request->alt_name,
            'disk' => 'public',
        ]);

        $this->storeImage($request, $item->id);

        return redirect(route("lube.{$this->routeBase}.show", ['id' => $item->id]));
    }

    public function update(Request $request, $id)
    {
        $item = $this->model::find($id);

        $data = [
            'alt_name' => $request->alt_name,
            'disk' => 'public',
        ];

        if ($request->image) {
            $data['original_name'] = $request->image->getClientOriginalName();
            $this->storeImage($request, $item->id);
        }

        $item->update($data);

        return redirect(route("lube.{$this->routeBase}.show", ['id' => $id]));
    }

    public function storeImage($request, $id)
    {
        $request->file('image')->storeAs(
            "public/attachments/{$id}/",
            $request->image->getClientOriginalName()
        );
    }
}
