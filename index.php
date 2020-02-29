<?php
include("header.php");

if ((isset($_SESSION['logged']) && $_SESSION['logged'] == FALSE) || session_status() == PHP_SESSION_NONE || session_status() == PHP_SESSION_DISABLED || !isset($_SESSION['logged']) ){
    header('LOCATION:./signin.php');
}else{
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="./index.php">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Camera</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="#">Mon compte</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="./Request/unlogRequest.php">Déconnexion</a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <?php
    include("home.php");
    //HOME SNAP USER=> SETTING
    //
    // DELOG
}
?>