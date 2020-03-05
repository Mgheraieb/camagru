<?php
include_once("../header.php");
include_once("utils.php");


if (!isset($_POST['username']) ||
    !isset($_POST['mail']) || !isset($_POST['mailVerif']) ||
    !isset($_POST['pswd']) || !isset($_POST['pswdVerif']))
{
    redirectError("../signup.php", 3);
    return;
}

$username = htmlspecialchars($_POST['username']);
$mail = htmlspecialchars($_POST['mail']);
$mailVerif = htmlspecialchars($_POST['mailVerif']);
$pswd = htmlspecialchars($_POST['pswd']);
$pswdVerif = htmlspecialchars($_POST['pswdVerif']);


if (empty($username) || empty($mail) || empty($mailVerif) || empty($pswd) || empty($pswdVerif)){
    redirectError("../signup.php", 3 );
    return;
}

if ($pswd != $pswdVerif || $mail != $mailVerif){
    errorRegistration("MP");
    return;
}

$checkUserExist = userExist($mail, $username, $bdd);

echo  $checkUserExist;
if ($checkUserExist != false){
    $link = "../signup.php".$checkUserExist;

    redirectError($link, 0);
}else{
    registerUser($mail, $username, $pswd, $bdd);
}

function registerUser($mail, $name, $pswd, $bdd){
    $pswd = password_hash($pswd, PASSWORD_DEFAULT);

    try {
        $req = $bdd->prepare('INSERT INTO user (name, mail, passwd) VALUES(?, ?, ?)');
        $req->execute(array($name, $mail, $pswd));
    }catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    logUser($mail, $name, $pswd, $bdd);
}


?>