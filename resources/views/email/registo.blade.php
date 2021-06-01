<!DOCTYPE html>
<html>
<head>
    <title>Registado com sucesso</title>
</head>
<body>
    <p>Bem Vindo {{$user->name}}</p>
    <p><a href="{{route('verify_email')}}">Verifica o teu email aqui</a></p>
</body>
</html>