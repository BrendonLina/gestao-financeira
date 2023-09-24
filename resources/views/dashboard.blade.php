@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
    <p>Seja Bem-Vindo:<b> {{Auth::user()->name}}</b></p>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    {{-- Minimal with title, text and icon --}}
<x-adminlte-info-box title="Title" text="some text" icon="far fa-lg fa-star"/>

{{-- Themes --}}
<x-adminlte-info-box title="Saldo" text="{{$carteira}}" icon="fas fa-lg fa-money-bill-alt text-dark" theme="gradient-teal" />

<x-adminlte-info-box title="Downloads" text="1205" icon="fas fa-lg fa-download" icon-theme="purple"/>

<x-adminlte-info-box title="528" text="User Registrations" icon="fas fa-lg fa-user-plus text-primary"
    theme="gradient-primary" icon-theme="white"/>

<x-adminlte-info-box title="Tasks" text="75/100" icon="fas fa-lg fa-tasks text-orange" theme="warning"
    icon-theme="dark" progress=75 progress-theme="dark"
    description="75% of the tasks have been completed"/>

{{-- Updatable --}}
<x-adminlte-info-box title="Reputation" text="0/1000" icon="fas fa-lg fa-medal text-dark"
    theme="danger" id="ibUpdatable" progress=0 progress-theme="teal"
    description="0% reputation completed to reach next level"/>

@push('js')
<script>

    $(document).ready(function() {

        let iBox = new _AdminLTE_InfoBox('ibUpdatable');

        let updateIBox = () =>
        {
            // Update data.
            let rep = Math.floor(1000 * Math.random());
            let idx = rep < 100 ? 0 : (rep > 500 ? 2 : 1);
            let progress = Math.round(rep * 100 / 1000);
            let text = rep + '/1000';
            let icon = 'fas fa-lg fa-medal ' + ['text-primary', 'text-light', 'text-warning'][idx];
            let description = progress + '% reputation completed to reach next level';

            let data = {text, icon, description, progress};
            iBox.update(data);
        };

        setInterval(updateIBox, 5000);
    })

</script>
@endpush
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop