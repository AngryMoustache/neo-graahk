<?php

namespace App\Http\Controllers\Lube;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LubeController extends Controller
{
    public $paginate = 10;
    public $searchable = [];

    public function index()
    {
        $fields = $this->getFields();

        $items = $this->model::query();

        if ($search = request()->input('search')) {
            foreach ($this->searchable as $searchField) {
                $items = $items->orWhere($searchField, 'LIKE', "%$search%");
            }
        }

        $items = $items->paginate($this->paginate)
            ->onEachSide(1);

        return view('lube.index', [
            'routeBase' => $this->routeBase,
            'items' => $items,
            'fields' => $fields,
            'label' => $this->label,
            'labelPlural' => $this->labelPlural,
            'search' => $search ?? ''
        ]);
    }

    public function show($id)
    {
        $fields = $this->getFields();

        $item = $this->model::find($id);

        return view('lube.show', [
            'fields' => $fields,
            'routeBase' => $this->routeBase,
            'item' => $item,
            'label' => $this->label,
            'labelPlural' => $this->labelPlural
        ]);
    }

    public function create()
    {
        session()->pull('item');
        $form = new $this->form;
        return view('lube.create', [
            'routeBase' => $this->routeBase,
            'form' => $form,
            'label' => $this->label,
            'labelPlural' => $this->labelPlural
        ]);
    }

    public function store(Request $request)
    {
        $request->validate((new $this->form)->validation());

        $data = $request->except('_token');
        $item = $this->model::create($data);
        return redirect(route("lube.{$this->routeBase}.show", ['id' => $item->id]));
    }

    public function edit($id)
    {
        $form = new $this->form;
        session()->put('item', $this->model::find($id));
        return view('lube.edit', [
            'routeBase' => $this->routeBase,
            'form' => $form,
            'label' => $this->label,
            'labelPlural' => $this->labelPlural
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate((new $this->form)->validation());

        $data = $request->except('_token');
        $item = $this->model::find($id);
        $item->update($data);
        return redirect(route("lube.{$this->routeBase}.show", ['id' => $id]));
    }

    public function delete($id)
    {
        $item = $this->model::find($id);

        return view('lube.delete', [
            'routeBase' => $this->routeBase,
            'label' => $this->label,
            'labelPlural' => $this->labelPlural,
            'item' => $item
        ]);
    }

    public function deleteCommit($id)
    {
        $item = $this->model::find($id);
        $item->delete();
        return redirect(route("lube.{$this->routeBase}.index"));
    }

    public function getFields()
    {
        return collect((new $this->form)->fieldStack());
    }
}
