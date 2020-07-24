<?php

namespace App\Http\Controllers\Lube;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LubeController extends Controller
{
    public function index()
    {
        $columns = collect((new $this->form)->fieldStack());
        $columns = $columns->mapWithKeys(function ($field) {
            $name = $field->getName();
            return [$name => str_replace('_', ' ', ucfirst($name))];
        })->toArray();

        $items = $this->model::paginate(25);
        return view('lube.index', [
            'routeBase' => $this->routeBase,
            'items' => $items,
            'columns' => $columns,
            'label' => $this->label,
            'labelPlural' => $this->labelPlural
        ]);
    }

    public function show($id)
    {
        $item = $this->model::find($id);
        return view('lube.show', [
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
        $data = $request->except('_token');
        $item = $this->model::find($id);
        $item->update($data);
        return redirect(route("lube.{$this->routeBase}.show", ['id' => $id]));
    }

    public function delete($id)
    {
        $item = $this->model::find($id);
        $item->delete();
        return redirect(route("lube.{$this->routeBase}.index"));
    }
}
