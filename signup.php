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

    <div class="form-signin">
        <form method="POST" action="./Request/registerRequest.php" id="signup-form">
            <h1 class="h3 mb-3 font-weight-normal">Inscription</h1>

            <div id="usernameDiv">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Nom d'utilisateur">
            </div>

            <div id="mailMainDiv">
                <div id="mailDiv">
                    <label for="email">Addresse e-mail</label>
                    <input type="email" class="form-control" id="email" name="mail" aria-describedby="emailHelp" placeholder="example@domain.fr">
                </div>


                <div id="mailVerifDiv">
                    <label for="emailVerif">Veuillez confirmez votre addresse e-mail</label>
                    <input type="email" class="form-control" id="emailVerif"  name="mailVerif" aria-describedby="emailHelp"placeholder="example@domain.fr">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
            </div>


            <div id="paswdMainDiv">
                <div id="pswdDiv">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="pswd" placeholder="***********">
                </div>

                <div id="pswdVerifDiv">
                    <label for="passwordVerif">Mot de passe</label>
                    <input type="password" class="form-control" id="passwordVerif" name="pswdVerif" placeholder="***********">
                </div>
            </div>

            <button class="btn btn-primary" id="submit" onclick="buttonClick()" type="button">S'inscrire</button>
        </form>
        <a href="signin.php"><p>J'ai déja un compte</p></a>
    </div>
</div>
</body>

</html>



<script type="text/javascript" src="script/signup.js"></script>
