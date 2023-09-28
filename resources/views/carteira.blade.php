<style>
    .mychart{
        width: 50%;
        margin-left: 200px;
    }
</style>
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
    <p>Carteira de:<b> {{Auth::user()->name}}</b></p>
@stop

@section('content')
<div class="info-box bg-success">
    <span class="info-box-icon"><i class="far fa-money-bill-alt"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">Saldo</span>
      {{-- <span class="info-box-number">{{$user->carteira->entrada - $user->carteira->saida}}</span> --}}
      <span class="info-box-number">{{Auth::user()->carteira->entrada - Auth::user()->carteira->saida}}</span>
    </div>
  </div>
  {{-- <form action="/carteiraPost/{{Auth::user()->id}}" method="post"> --}}
  <form action="/carteira/{{Auth::user()->id}}" method="POST">
    @csrf
    @method('PUT')
        <x-adminlte-input name="entrada" label="Adicionar Dinheiro/Entrada" placeholder="Valor" type="number"
        igroup-size="sm" min=1>
        <x-slot name="appendSlot">
            <x-adminlte-button type="submit" theme="primary" icon="fas fa-paper-plane" label="Send"/>
        </x-slot>
    </x-adminlte-input>
  </form>
  
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop