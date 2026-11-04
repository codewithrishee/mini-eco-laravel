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

    // Attributes Dashboard
    public function dashboard()
    {
        return view('admin.attributes.dashboard', [
            'colors' => Color::count(),
            'sizes' => Size::count(),
            'materials' => Material::count(),
            'tags' => Tag::count(),
        ]);
    }

    // Attribute Listing
    public function index($type)
    {
        $model = $this->getModel($type);

        $items = $model::orderBy('display_order')
            ->latest()
            ->paginate(10);

        return view("admin.attributes.{$type}.index", compact('items'));
    }

    // Create Attribute
    public function create($type)
    {
        $this->getModel($type);

        return view("admin.attributes.{$type}.form");
    }

    // Store Attribute
    public function store(Request $request, $type)
    {
        $model = $this->getModel($type);

        $rules = [
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'display_order' => 'nullable|integer|min:0',
        ];

        if ($type === 'colors') {
            $rules['code'] = ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'];
        }

        $validated = $request->validate($rules);

        $data = [
            'name' => $validated['name'],
            'status' => $validated['status'],
            'display_order' => $validated['display_order'] ?? 0,
        ];

        if ($type === 'colors') {
            $data['code'] = $validated['code'];
        }

        $model::create($data);

        return redirect()
            ->route('admin.attributes.index', $type)
            ->with('success', ucfirst($type) . ' created successfully.');
    }

    // Edit Attribute
    public function edit($type, $id)
    {
        $model = $this->getModel($type);

        $item = $model::findOrFail($id);

        return view("admin.attributes.{$type}.form", compact('item'));
    }

    // Update Attribute
    public function update(Request $request, $type, $id)
    {
        $model = $this->getModel($type);

        $item = $model::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'display_order' => 'nullable|integer|min:0',
        ];

        if ($type === 'colors') {
            $rules['code'] = ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'];
        }

        $validated = $request->validate($rules);

        $data = [
            'name' => $validated['name'],
            'status' => $validated['status'],
            'display_order' => $validated['display_order'] ?? 0,
        ];

        if ($type === 'colors') {
            $data['code'] = $validated['code'];
        }

        $item->update($data);

        return redirect()
            ->route('admin.attributes.index', $type)
            ->with('success', ucfirst($type) . ' updated successfully.');
    }

    // Delete Attribute
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
