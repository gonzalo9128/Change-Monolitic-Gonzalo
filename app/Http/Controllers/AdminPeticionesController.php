<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Petition;
use App\Models\File;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FileSystem;

class AdminPeticionesController extends Controller
{
    public function index()
    {
        $peticiones = Petition::all();
        return view('admin.peticiones.index', compact('peticiones'));
    }

    public function show($id)
    {
        $petition = Petition::findOrFail($id);
        return view('admin.peticiones.show', compact('petition'));
    }

    public function edit($id)
    {
        $petition = \App\Models\Petition::findOrFail($id);
        $categories = \App\Models\Category::all(); // <--- ESTO TAMBIÉN
        return view('admin.peticiones.edit-add', compact('petition', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // 1. Validación
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'status'       => 'required',
            'category_id' => 'required',
            'destinatary' => 'required',
            'file'        => 'nullable|image|max:5120',
        ]);

        // 2. Buscar la petición
        $petition = Petition::findOrFail($id);

        // 3. Actualizar datos básicos
        $petition->update([
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => $request->status,
            'category_id' => $request->category_id,
            'destinatary' => $request->destinatary,
        ]);

        if ($request->hasFile('file')) {

          foreach ($petition->files as $oldFile) {
               $path = public_path($oldFile->file_path);
                if (file_exists($path)) {
                    unlink($path);
                }
                $oldFile->delete();
            }
            //se sube la nueva foto
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('petitions'), $filename);

            //  Guardar en la tabla 'files'
            File::create([
                'petition_id' => $petition->id,
                'name' => $filename,
                'file_path' => 'petitions/' . $filename,
            ]);
        }

        return redirect()->route('adminpeticiones.index')
            ->with('success', 'Petición actualizada correctamente');
    }


    public function delete($id)
    {
        $petition = Petition::findOrFail($id);

        if ($petition->firmantes()->count() > 0) {
            return back()->with('error', ' NO SE PUEDE ELIMINAR: Esta petición ya tiene firmas de usuarios. ');
        }

        // Borrar las imágenes del servidor
        foreach ($petition->files as $file) {
            $path = public_path($file->file_path);
            if (file_exists($path)) {
                unlink($path);
            }
            $file->delete();
        }

        // Borrar la petición
        $petition->delete();

        return back()->with('success', 'Petición eliminada correctamente (no tenía firmas).');
    }


    // MOSTRAR FORMULARIO DE CREAR
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.peticiones.edit-add', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'title'       => 'required|max:255',
            'description' => 'required',
            'destinatary' => 'required',
            'category_id' => 'required|exists:categories,id',
            'file'        => 'nullable|image|max:5120', // Máximo 5MB
        ]);

        // Crear la petición
        $petition = new Petition();
        $petition->title       = $request->title;
        $petition->description = $request->description;
        $petition->destinatary = $request->destinatary;
        $petition->category_id = $request->category_id;
        $petition->user_id     = Auth::id();
        $petition->status      = 'accepted';
        $petition->signers     = 0;
        $petition->save();

        // Subir imagen
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('petitions'), $filename);

            \App\Models\File::create([
                'petition_id' => $petition->id,
                'name'        => $filename,
                'file_path'   => 'petitions/' . $filename,
            ]);
        }

        return redirect()->route('adminpeticiones.index')
            ->with('success', 'Petición creada y publicada correctamente.');
    }
}
