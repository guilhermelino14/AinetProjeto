<!DOCTYPE html>
<html>
<head>
    <title>Encomenda criada com sucesso</title>
</head>
<body>
    <p>Encomenda Criada com sucesso</p>
    <p>A sua encomenda está a ser processada</p>
    <p><a href="{{ route("minhasencomendas.show.pdf", $encomenda) }}">clique aqui para opter o recibo</a></p>
</body>
</html>