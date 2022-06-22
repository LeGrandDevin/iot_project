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
<div class="form">
    <div class="title">Bonjour !</div>
    <div class="subtitle">Veuillez remplir ces champs pour vous connecter</div>
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

        <!-- <input type="submit" value="log-in"> -->
        
        <input type="submit" class="submit" value="log-in">
    </form>

</div>


<?php 

verifyCred();

function checkSession(){

    if (session_id() == '' || !isset($_SESSION['login'])) { //if sid exists and login for sid exists

    }else{
        echo "Hi, " . $_SESSION['login'];
    }
}


function verifyCred(){

    
    if (isset($_POST['login']) && isset($_POST['password'])) //when form submitted
        $formLogin = $_POST['login']; 
        $formPassword = $_POST['password'];
        $db = new PDO ("mysql:host=185.224.138.133;dbname=u928306449_groupe_quatre;charset=utf8","u928306449_groupe_quatre","KeyceGroupe4");
        $req = $db->prepare('SELECT * FROM credentials WHERE identifiant = "' .  $formLogin . '" AND password = "' . $formPassword . '"');
        $req->execute();
        $id = $req->fetchAll();
        $bddLogin = $id[0][1];
        $bddpassword = $id[0][2];
    {
    if ($formLogin === $bddLogin && $formPassword === $bddpassword)
    
    {
        $_SESSION['login'] = $formLogin; //write login to server storage
        checkSession();
        //header('Location: /iot/login.php'); //redirect to main
    }
    else
    {
        echo "<script>alert('Wrong login or password');</script>";
        echo "<noscript>Wrong login or password</noscript>";
    }
    }

}