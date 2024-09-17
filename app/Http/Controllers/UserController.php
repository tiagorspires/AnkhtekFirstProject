<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $search = request('search');

        if($search) {

            $users = User::where([
                ['name', 'like', '%'.$search.'%']
            ])->get();

        } else {
            $users = User::all();
        }

        return view('/users/users', ['users' => $users, 'search' => $search]);
    }

    public function show($id = null)
    {
        $user = User::findOrFail($id);
        return view('users/user', ['user' => $user]);
    }
    public function store(Request $request)
    {
        // Validação dos dados de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'unique:users,email',
                'regex:/^[\w\.-]+@[\w\.-]+\.\w{2,}$/'
            ],
            'password' => 'required|string|min:8',
        ]);


        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return response()->json(['message' => 'Usuário criado com sucesso!', 'user' => $user], 201);
    }
}
