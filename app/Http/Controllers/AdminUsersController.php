<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function updateRole($id)
    {
        $user = User::findOrFail($id);

        if ($user->id == Auth::id()) {
            return back()->with('error', 'No puedes cambiar tu propio rol.');
        }

        $user->role_id = ($user->role_id == 1) ? 2 : 1;
        $user->save();

        return back()->with('success', 'Rol de usuario actualizado correctamente.');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->id == Auth::id()) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta desde aquí.');
        }

        if ($user->firmantes()->count() > 0) {
            return back()->with('error', 'No se puede eliminar: El usuario ha firmado peticiones.');
        }

        if ($user->petitions()->count() > 0) {
            return back()->with('error', 'No se puede eliminar: El usuario es autor de peticiones.');
        }

        $user->delete();
        return back()->with('success', 'Usuario eliminado correctamente.');
    }
}
