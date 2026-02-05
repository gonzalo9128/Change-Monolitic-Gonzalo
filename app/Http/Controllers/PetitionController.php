<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\File;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetitionController extends Controller
{

    public function index()
    {
        $petitions = Petition::all();
        return view('petitions.index', compact('petitions'))->with('title', 'Peticiones destacadas');
    }

    public function show(Request $request, $id)
    {
        try {
            $petition = Petition::findOrFail($id);
            return view('petitions.show', compact('petition'));

        } catch (\Exception $exception) {
            return redirect()->route('petitions.index');
        }
    }
    public function create()
    {
        $categories = Category::all();

        return view('petitions.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'destinatary' => 'required',
            'category_id' => 'required',
            'file' => 'required|image|max:5120',
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('petitions'), $filename);

        $petition = new Petition();
        $petition->title = $request->title;
        $petition->description = $request->description;
        $petition->destinatary = $request->destinatary;
        $petition->category_id = $request->category_id;
        $petition->user_id = Auth::id();
        $petition->signers = 0;
        $petition->status = 'pending';

        $petition->save();

        $fileModel = new File();
        $fileModel->petition_id = $petition->id;
        $fileModel->name = $filename;
        $fileModel->file_path = 'petitions/' . $filename;
        $fileModel->save();

        return redirect()->route('petitions.mine')->with('success', 'Petición creada correctamente');
    }
    public function edit($id)
    {
        $petition = Petition::findOrFail($id);
        $categories = Category::all();

        return view('petitions.edit', compact('petition', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $petition = Petition::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'destinatary' => 'required',
            'category_id' => 'required',
            'file' => 'nullable|image|max:5120',
        ]);

        $petition->update($request->except('file'));

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('petitions'), $filename);

            $fileModel = new File();
            $fileModel->petition_id = $petition->id;
            $fileModel->name = $filename;
            $fileModel->file_path = 'petitions/' . $filename;
            $fileModel->save();
        }

        return redirect()->route('petitions.mine')->with('success', 'Petición actualizada correctamente');
    }
    public function firmar(Request $request, $id)
    {
        $petition = Petition::findOrFail($id);
        $user = Auth::user();

        // Comprobamos si el usuario YA ha firmado esta petición
        if ($petition->firmantes->contains($user->id)) {
            return back()->with('error', '¡Ya has firmado esta petición!');
        }

        // 1. Guardamos la firma en la tabla intermedia
        $petition->firmantes()->attach($user->id);

        // 2. Sumamos +1 al contador visual (para que sea rápido mostrarlo)
        $petition->increment('signers');

        return back()->with('success', '¡Gracias por firmar!');
    }

    public function listMine()
    {
        $userId = Auth::id();
        $petitions = Petition::where('user_id', $userId)->get();

        return view('petitions.index', compact('petitions'))->with('title', 'Mis peticiones creadas');
    }
    public function destroy($id)
    {
        $petition = Petition::findOrFail($id);

        if (Auth::id() != $petition->user_id) {
            return redirect()->back()->with('error', 'No tienes permiso para borrar esto.');
        }

        $petition->delete();

        return redirect()->route('petitions.mine')->with('success', 'Petición eliminada correctamente.');
    }
    // Listar las peticiones que he firmado
    public function peticionesFirmadas()
    {
        // Usamos la relación 'firmantes' que acabamos de arreglar
        $petitions = Auth::user()->firmantes;

        return view('petitions.firmadas', compact('petitions'));
    }
}
