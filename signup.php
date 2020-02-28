<?php
include_once('header.php')
?>
<!doctype html>
<html lang="en">
<head>

    <link href="signin.css" rel="stylesheet">
</head>
<body>
<div class="container">

<form>

    <div class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal">Inscription</h1>

            <label for="username">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" placeholder="Nom d'utilisateur">

        <label for="email">Addresse e-mail</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="example@domain.fr">

            <label for="emailVerif">Veuillez confirmez votre addresse e-mail</label>
            <input type="email" class="form-control" id="emailVerif" aria-describedby="emailHelp"placeholder="example@domain.fr">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" id="password" placeholder="***********">
        <label for="passwordVerif">Mot de passe</label>
        <input type="password" class="form-control" id="passwordVerif"placeholder="***********">

    <button type="submit" class="btn btn-primary">S'inscrire</button>
        <a href="signin.php"><p>J'ai déja un compte</p></a>
    </div>
</form>
</div>
</body>

</html>

