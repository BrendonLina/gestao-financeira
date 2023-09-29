<style>
    .mychart{
        width: 50%;
        margin-left: 200px;
    }

    #saida{
        color: red;
    }
</style>
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
    <p>Carteira de:<b> {{Auth::user()->name}}</b></p>
@stop

@section('content')
<div class="info-box bg-danger">
    <span class="info-box-icon"><i class="far fa-money-bill-alt"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">Saida</span>
      <span class="info-box-number">-{{$userSaidas}}</span>
    </div>
  </div>
  
  <form action="/conta/{{Auth::user()->id}}" method="POST">
    @csrf
    @method('PUT')
        <x-adminlte-input name="saida" label="Adicionar Saida" placeholder="Valor" type="number"
        igroup-size="sm" min=1>
    </x-adminlte-input>

    <x-adminlte-input name="saida_descricao" label="Descrição" placeholder="Descrição" type="text"
        igroup-size="sm" min=1 max=20>
    </x-adminlte-input>

        <x-adminlte-button label="Enviar" theme="primary" icon="fas fa-paper-plane" type="submit"/>
    
  </form>

  @foreach($saidas as $saida)
    <x-adminlte-card title="Saida {{substr($saida->created_at,0,10)}}" theme="dark" icon="fas fa-lg fa-money-bill-alt"> 
        <p>Saida de R$ <b id="saida">{{$saida->saida}}</b></p>
        @if($saida->saida_descricao == null)
        <p>Sem descrição</p>
        @else       
        <p>Descrição: <b>{{$saida->saida_descricao}}</b></p>
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