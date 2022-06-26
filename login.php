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

        <div id="credResult">
            <?php
            session_start();
            echo(session_id());
            verifyCred();
            ?>
        </div>
        <!-- <input type="submit" value="log-in"> -->
        
        <input type="submit" class="submit" value="log-in">
    </form>

</div>



<?php 


function checkSession() : bool{
    return session_id() == '' || !isset($_SESSION['login']);
}


function verifyCred(){

    
    if (isset($_POST['login']) && isset($_POST['password'])){ //when form submitted
        $formLogin = $_POST['login']; 
        $formPassword = $_POST['password'];
        $db = new PDO ("mysql:host=185.224.138.133;dbname=u928306449_groupe_quatre;charset=utf8","u928306449_groupe_quatre","KeyceGroupe4");
        $req = $db->prepare('SELECT * FROM credentials WHERE identifiant = "' .  $formLogin . '" AND password = "' . $formPassword . '"');
        $req->execute();
        $id = $req->fetchAll();
        if(sizeof($id) < 1){
            echo("Mauvais identifiant ou mots de passe.");
            return;
        }
        $bddLogin = $id[0][1];
        $bddpassword = $id[0][2];
        
        if ($formLogin === $bddLogin && $formPassword === $bddpassword)
        {   
            if(checkSession()){
                $_SESSION['login'] = $formLogin; //write login to server storage
                $_COOKIE['sesid'] = session_id();
                echo("session started");
            }
            header('Location: /iot_project/dashboard.php'); //redirect to main
        }
    }

}

?>

<div style="color: white;">
<?php
    if(checkSession()){
        var_dump($_SESSION);
    }else{
        echo ("pas de sesion");
    }
?>
</div>


