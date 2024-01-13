<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Email</title>
</head>
<body>
    <p>Bienvenue, {{ $user->name  }} {{$user->prenom}}!</p>
    <p>Merci de vous être inscrit. Veuillez cliquer sur le lien ci-dessous pour confirmer votre adresse e-mail :</p>
    <a href="{{ $confirmationLink }}">Confirmer l'adresse e-mail</a>
</body>
</html>
