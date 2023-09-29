<style>
    .mychart{
        width: 50%;
        margin-left: 200px;
    }

    #entrada{
        color: green;
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
      <span class="info-box-number">{{$userSaldo}}</span>
    </div>
  </div>

  <form action="/carteira/{{Auth::user()->id}}" method="POST">
    @csrf
    @method('PUT')
        <x-adminlte-input name="entrada" label="Adicionar Dinheiro/Entrada" placeholder="Valor" type="number"
        igroup-size="sm" min=1>
    </x-adminlte-input>

    <x-adminlte-input name="entrada_descricao" label="Descrição" placeholder="Descrição" type="text"
        igroup-size="sm" min=1 max=20>
    </x-adminlte-input>

        <x-adminlte-button label="Enviar" theme="primary" icon="fas fa-paper-plane" type="submit"/>

  </form>
    @foreach($entradas as $entrada)
    <x-adminlte-card title="Entrada {{substr($entrada->created_at,0,10)}}" theme="dark" icon="fas fa-lg fa-money-bill-alt">
        <p>Entrada de R$ <b id="entrada">{{$entrada->entrada}}</b></p>
        @if($entrada->entrada_descricao == null)
        <p>Sem descrição</p>
        @else
        <p>Descricao: <b>{{$entrada->entrada_descricao}}</b></p>
        @endif
    </x-adminlte-card>
    @endforeach
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop