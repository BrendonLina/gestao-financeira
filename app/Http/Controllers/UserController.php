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

        $entrada = Auth::user()->carteiras->sum('entrada');
        $saida = Auth::user()->carteiras->sum('saida');

        $saldo = $entrada - $saida;

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
        
        $entradas = Auth::user()->carteiras->where('entrada', '<>', 0.00)->all();
        $userEntradas = Auth::user()->carteiras->sum('entrada');
        $userSaidas = Auth::user()->carteiras->sum('saida');

        $userSaldo = $userEntradas - $userSaidas;
        
        return view('carteira', compact('user','entradas','userSaldo'));
    }

    public function carteiraPost(Request $request, $id)
    {

        $user = User::find($id); // Substitua 1 pelo ID do usuário desejado

        $carteira = new Carteira([
            'entrada' => $request->entrada,
            'entrada_descricao' => $request->entrada_descricao,
            'saida' => 0,
        ]);

        // Associar as carteiras ao usuário
        $user->carteiras()->save($carteira);
        
        return redirect()->back()->with('success','Dinheiro adicionado com sucesso!');
    }

    public function conta($id)
    {
        $user = Auth::user()->id;
        if(!$user){
            return redirect()->route('dashboard');
        }

        $saidas = Auth::user()->carteiras->where('saida','<>', 0.00)->all();

        $userSaidas = Auth::user()->carteiras->sum('saida');

        return view('conta', compact('user','userSaidas','saidas'));
    }

    public function contaPost(Request $request, $id)
    {
        
        $user = User::find($id); 

        $carteira = new Carteira([
            'entrada' => 0,
            'saida' => $request->saida,
            'saida_descricao' => $request->saida_descricao,
        ]);
        // Associar as carteiras ao usuário
        $user->carteiras()->save($carteira);

        return redirect()->back()->with('success','Saida adicionada com sucesso!');
    }
}
