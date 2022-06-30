<?php
require_once 'toolBox.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ekip.css" />
    <title>login iot</title>
</head>
<body>
    <?php 
    if(!isConnected()){
    ?>
<div class="form">
    <div class="title">Bonjour!</div>
    <div class="subtitle">Veuillez vous connecter!</div>
    <form method="post" action="">
        <!-- <label>login</label> -->
        <div class="input-container ic1">
            <input id="firstname" class="input" type="text" name="login" placeholder=" " />
            <div class="cut"></div>
            <label for="firstname" class="placeholder">Identifiant</label>
        </div>
        <div class="input-container ic2">
            <input id="lastname" class="input" type="password" name="password" placeholder=" " />
            <div class="cut" id="pass"></div>
            <label for="lastname" class="placeholder">Mot de passe</label>
        </div>

        <div id="credResult">
            <?php
            connect();
            ?>
        </div>
        <!-- <input type="submit" value="log-in"> -->
        
        <input type="submit" class="submit" value="Se Connecter">
    </form>

</div>

    <?php 
    } 
    else{
    ?>
    
<div class="form">
    <div class="title">Bonjour !</div>
    <div class="subtitle">Il semblerait que vous soyez déjà connecté</div>
    <form method="post" action="dashboard.php">
       <input type="submit" class="submit" value="Aller au Dashboard">
    </form>
</div>
    <?php
    }
    ?>
</body>