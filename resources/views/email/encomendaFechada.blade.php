<!DOCTYPE html>
<html>
<head>
    <title>Encomenda Fechada</title>
</head>
<body>
    <p>Encomenda Numero {{$encomenda->id}} -> encontra se Fechada</p>
    <p>Agradecemos a sua compra </p>
    <p><a href="{{ route("minhasencomendas.show.pdf", $encomenda) }}">clique aqui para opter o recibo</a></p>
</body>
</html>