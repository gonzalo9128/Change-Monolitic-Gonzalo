<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoriasController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categorias.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categorias.edit-add');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:categories|max:50']);
        Category::create($request->all());
        return redirect()->route('admincategorias.index')->with('success', 'Categoría creada.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categorias.edit-add', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate(['name' => 'required|max:50|unique:categories,name,' . $category->id]);

        $category->update($request->all());
        return redirect()->route('admincategorias.index')->with('success', 'Categoría actualizada.');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        if ($category->petitions()->count() > 0) {
            return back()->with('error', 'No puedes eliminar esta categoría porque hay peticiones asociadas a ella.');
        }

        $category->delete();
        return back()->with('success', 'Categoría eliminada.');
    }
}
