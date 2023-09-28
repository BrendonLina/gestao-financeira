<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css">
    <title>Login</title>
</head>
<body>
    <div class="container-login">
        <div class="login">  
            <h4 class="title-login">Login</h4>
            <form action="/dashboard" method="POST" >
                @csrf

                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                @if(session('danger'))
                    <div class="alert alert-danger">
                        {{session('danger')}}
                    </div>
                @endif
                <div class="mb-3">
                    <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="Seu email">
                    @error('email')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="exampleFormControlInput" name="password" placeholder="Senha" >
                    @error('password')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="submit"  class="form-control" id="btn-entrar" value="Entrar">
                    <a href="/cadastrar">Cadastrar</a>
                </div>
            </form>
        
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>












{{-- <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="/dashboard" method="POST">
        @csrf
        <input type="email" placeholder="Email" name="email">
        <input type="password" placeholder="Senha" name="password">
        <input type="submit" name="entrar" value="Entrar">
    </form>
</body>
</html> --}}