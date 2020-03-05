<?php
include_once("header.php");
include_once("Request/utils.php");
?>

<div class="container">
    <h1 class="h1">Paramétre du compte</h1>

    <div id="mailMain">
        <div class="container" id="mailDiv">
            <h5>Changement d'adresse Email</h5>
            <div class="form-group">
                <label for="exampleInputEmail1">Nouvelle adresse email</label>
                <?php
                echo '<input type="email" class="form-control" name="mail" id="mail" aria-describedby="emailHelp" placeholder="'.getUserMailById($bdd).'">';
                ?>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <button type="submit" id="mailChange" name="mailChange" class="btn btn-primary">Submit</button>
        </div>
    </div>


    <br>


    <div id="passMain">
        <div class="container" id="passDiv">
            <h5>Changement de mot de passe</h5>
            <div class="form-group">
                <label for="exampleInputPassword1">Nouveau mot de passe</label>
                <input type="password" name="pass" class="form-control" id="pass">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Confimation</label>
                <input type="password" name="confirmation" class="form-control" id="confirmation">
            </div>
            <button type="submit" name="passChange" id="passChange" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>

<script type="text/javascript" src="script/settingUser.js"></script>