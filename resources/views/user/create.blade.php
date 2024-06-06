<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Cadastrar usuário</h3>
    @if (session('success'))
        <p style="color:green;">
            {{ session('success') }}
        </p>
    @endif

    @if (session('error'))
        <p style="color: red">
            {{ session('error') }}
        </p>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $erro)
            <p style="color: red">
                {{ $erro }}
            </p>
        @endforeach
    @endif

    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        @method('POST')

        <label>Nome: </label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Nome completo" value="{{ old('name') }}"><br><br>
        <label>Email: </label>
        <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}"><br><br>
        <label>Senha: </label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Senha"><br><br>  
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>