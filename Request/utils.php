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
        $_SESSION['idUser'] = $result['id'];
        $_SESSION['logged'] = TRUE;

        header('LOCATION:../index.php');
    }
}


function userExistID($id, $bdd)
{
    $req = $bdd->prepare('SELECT id FROM user WHERE id = ?');
    $req->execute(array($id));
    $result = $req->fetch();
    $req->closeCursor();
    return ($result != false);
}


function imageExistID($id, $bdd)
{
    $req = $bdd->prepare('SELECT id FROM picture WHERE id = ?');
    $req->execute(array($id));
    $result = $req->fetch();
    $req->closeCursor();
    return ($result != false);
}

function getImageOwnerId($idImg, $bdd){
    $req = $bdd->prepare('SELECT owner_id FROM picture WHERE id = ?');
    $req->execute(array($idImg));
    $result = $req->fetch();
    $req->closeCursor();
    return $result['owner_id'];

}

function userExist($mail, $username, $bdd){
    $req = $bdd->prepare('SELECT * FROM user WHERE name = ? OR mail = ?');
    $req->execute(array($username, $mail));
    $result = $req->fetch();
    $error = false;
    if ($result['name'] == $username)
    {
        $error='?name='.$username;
    }
    if ($result['mail'] == $mail){
        if ($error == false)
            $error='?mail='.$mail;
        else{
            $error.='&mail='.$mail;
        }
    }
    $req->closeCursor();
    return $error;
}



?>
