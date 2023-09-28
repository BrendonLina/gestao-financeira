<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Carteira;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $carteira = 1855.29;
        // $entrada = 529.30 + 250.22 + 100;
        // $saida = 285.80;

        // $saldo = $entrada - $saida;

        $entrada = Auth::user()->carteira->entrada;
        $saida = Auth::user()->carteira->saida;
        $saldo = $entrada - $saida;

        // dd($user);

        return view('dashboard', compact('saldo','entrada','saida'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dashboard(Request $request)
    {
        $credenciais = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ],[
            'email.required' => 'Email é obrigatório.',
            'email.email' => 'Email inválido.',
            'password.required' => 'Senha obrigatória.'
        ]);


        if(Auth::attempt($credenciais)){

            $request->session()->regenerate();
            
            return redirect()->intended('dashboard');
        }
        if(!Auth::check()){

            return redirect()->back()->with('danger','Email ou Senha incorreto');
        }
    }

    public function carteira($id)
    {
        $user = Auth::user()->id;
        if(!$user){
            return redirect()->route('dashboard');
        }
        
        return view('carteira', compact('user'));
    }

    public function carteiraPost(Request $request, $id)
    {
        // $user = User::find($id)->with('carteira')->first();
        
        // $user->carteira->entrada = $request->entrada;
        
        // $user->update();

        $carteira = Carteira::find($id);
        
        $carteira->entrada = $request->entrada + $carteira->entrada;

        $carteira->save();

        return redirect()->back()->with('success','Dinheiro adicionado com sucesso!');
    }
}
