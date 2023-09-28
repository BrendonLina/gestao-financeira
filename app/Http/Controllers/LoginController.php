<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Carteira;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        auth()->logout();

        return redirect('login');
    }

    public function cadastrar()
    {
        return view('cadastrar');
    }

    public function cadastrarPost(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);
    
        // Criação da carteira associada ao usuário
        $carteira = new Carteira(['entrada' => 0, 'saida' => 0]);
        $user->carteira()->save($carteira);

        return redirect()->back()->with('success','Usuário cadastrado com sucesso!');
    }

}
