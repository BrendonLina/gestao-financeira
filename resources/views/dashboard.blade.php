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
    <p>Seja Bem-Vindo:<b> {{Auth::user()->name}}</b></p>
@stop

@section('content')
    <p>Bem vindo ao painel financeiro</p>

    {{-- Themes --}}
    <x-adminlte-info-box title="Entradas" text="{{$entrada}}" icon="far fa-lg fa-money-bill-alt" theme="primary"/>
    <x-adminlte-info-box title="Saídas" text="- {{$saida}}" icon="fas fa-lg fa-money-bill-alt text-dark" theme="danger" id="ibUpdatable"/>
    <x-adminlte-info-box title="Saldo" text="{{$saldo}}" icon="fas fa-lg fa-money-bill-alt text-dark" theme="gradient-teal" />

<div class="mychart">
    <canvas id="myChart"></canvas>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('myChart');
  
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Entradas', 'Saídas','Saldo'],
        datasets: [{
          label: '$',
          data: [529.30, 285.80, 1855.29],
          backgroundColor: [
            'blue',
            'red',
            'green'
        ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop