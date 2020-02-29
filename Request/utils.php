<?php

function redirectError($link, $time)
{
    echo '<p> Erreur redirection vers la page precedente</p>';
    header('Refresh:'.$time.'; URL='.$link);
}


function logUser($email, $username, $pass, $bdd){
    echo $email;
    echo $pass;
    //$pass = password_hash($pass, PASSWORD_DEFAULT);

    $req = $bdd->prepare('SELECT * FROM user WHERE (name = ? OR mail = ?) AND  passwd = ? ');
    $req->execute(array($username, $email,  $pass));
    $result = $req->fetch();
    $req->closeCursor();
    if ($result == false)
    {
        return false;
    }else{
        $_SESSION['id'] = $result['id'];
        $_SESSION['logged'] = TRUE;
        redirectError("../index.php", 0);
    }
}



?>
