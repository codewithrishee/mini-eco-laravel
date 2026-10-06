<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Size;
use App\Models\Material;
use App\Models\Tag;

class AttributeController extends Controller
{
    private function getModel($type)
    {
        return match ($type) {
            'colors' => Color::class,
            'sizes' => Size::class,
            'materials' => Material::class,
            'tags' => Tag::class,
            default => abort(404),
        };
    }

    public function dashboard()
{
    return view('admin.attributes.dashboard', [
        'colors' => Color::count(),
        'sizes' => Size::count(),
        'materials' => Material::count(),
        'tags' => Tag::count(),
    ]);
}

    public function index($type)
    {
        $model = $this->getModel($type);

        $items = $model::orderBy('display_order')
            ->latest()
            ->paginate(10);

        return view('admin.attributes.index', compact('items', 'type'));
    }

    public function create($type)
    {
        return view('admin.attributes.form', compact('type'));
    }

    public function store(Request $request, $type)
    {
        $request->validate([
            'name' => 'required|max:255',
            'status' => 'required',
            'display_order' => 'nullable|integer',
        ]);

        $model = $this->getModel($type);

        $data = $request->only([
            'name',
            'status',
            'display_order',
        ]);

        if ($type == 'colors') {
            $data['code'] = $request->code;
        }

        $model::create($data);

        return redirect()
            ->route('admin.attributes.index', $type)
            ->with('success', ucfirst($type) . ' created successfully.');
    }

    public function edit($type, $id)
    {
        $model = $this->getModel($type);

        $item = $model::findOrFail($id);

        return view('admin.attributes.form', compact('item', 'type'));
    }

    public function update(Request $request, $type, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'status' => 'required',
            'display_order' => 'nullable|integer',
        ]);

        $model = $this->getModel($type);

        $item = $model::findOrFail($id);

        $data = $request->only([
            'name',
            'status',
            'display_order',
        ]);

        if ($type == 'colors') {
            $data['code'] = $request->code;
        }

        $item->update($data);

        return redirect()
            ->route('admin.attributes.index', $type)
            ->with('success', ucfirst($type) . ' updated successfully.');
    }

    public function destroy($type, $id)
    {
        $model = $this->getModel($type);

        $item = $model::findOrFail($id);

        $item->delete();

        return redirect()
            ->route('admin.attributes.index', $type)
            ->with('success', ucfirst($type) . ' deleted successfully.');
    }
}