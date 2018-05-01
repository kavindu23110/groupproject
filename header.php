<?php
include "usermodal.php";
session_start();
$user=unserialize($_SESSION["userdetails"]);
if(!isset($_SESSION["userdetails"])){
   header('Location:index.html');
}
/**
 * Created by PhpStorm.
 * User: Kavindu
 * Date: 10/25/2017
 * Time: 6:40 PM
 */
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   
    <title>DMC</title>
 <style>
        @import url(\'https://fonts.googleapis.com/css?family=Vollkorn:400,400i,600,600i,700,700i,900,900i\');
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bootstrap-4.0.0-beta.2-dist/css/bootstrap.css">
    <script src="js/iziModal.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <link rel="stylesheet" href="css/iziModal.min.css">
    <link rel="stylesheet" href="css/General.css">
    <link rel="stylesheet" href="css/jquery.modal.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/navbar_both.css">
    <link rel="stylesheet" href="css/footer.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <style>
        @import url(\'https://fonts.googleapis.com/css?family=Vollkorn:400,400i,600,600i,700,700i,900,900i\');
    </style>

    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/flexslider.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/General.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/navbar_both.css">
    <link rel="stylesheet" href="css/carousl.css">
    <link rel="stylesheet" href="css/jquery.loadingModal.css">
    <script src="js/jquery.loadingModal.min.js"></script> 
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
    <a class="navbar-brand" style="font-family:Vollkorn400;" href="#">
        <img src="img/Emblem_of_Sri_Lanka.svg.png" width="40" height="51" class="d-inline-block align-content-center"
             alt="Gov LOGO">
        &nbsp;DMC Badulla
</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Image Gallery</a>
            </li>


        </ul>
        <ul class="nav navbar-nav">
            <li class="nav-item mr-2">
                <a href="#" class="nav-link ml-2"> <img src="img/s.jpg" class="rounded-circle" class="mr-5 " height="45"
                                                        width="45" style="border-radius: 50%"/>&nbsp;'.$user->getUserName().'</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <button class="btn btn-danger btn-outline-danger px-3 my-2 my-sm-0" type="button">Logout</button>
                </a>
            </li>
        </ul>

    </div>


</nav>

';