<?php

function getDbAccess(): PDO {
    return new PDO ("mysql:host=185.224.138.133;dbname=u928306449_groupe_quatre;charset=utf8","u928306449_groupe_quatre","KeyceGroupe4");
}

function verifyCred($login, $password){
    $db = getDbAccess();
    $req = $db->prepare('SELECT * FROM credentials WHERE identifiant = "' .  $login . '" AND password = "' . $password . '"');
    $req->execute();
    $user = $req->fetch(PDO::FETCH_ASSOC);
    if($user && $password === $user['password']){
        return true;
    }
    return false;
}

function connect(){
    if (isset($_POST['login']) && isset($_POST['password'])){ //when form submitted
        if (verifyCred($_POST['login'], $_POST['password']))
            {
                $_SESSION['login'] = $_POST['login']; //write login to server storage
                $_SESSION['connected'] = true;
                $_SESSION['user'] = $_POST['login'];
                header('Location: /iot_project/dashboard.php'); //redirect to main
            }
        else{
            echo('mauvais identifiant ou mots de passe');
        }
        
    }

}


function getCaptorTempValue(string $from, string $to){
    $db = getDbAccess();
    $req = $db->prepare('SELECT temperature, date FROM captorData WHERE date > "' .  $from . '" AND date < "' . $to . '"');
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function formatTempValuetoChart($values){
    $result = '';
    $count = sizeof($values);
    foreach($values as $value){
        $result .= "{x: '" . $value['date'] . "', y: " . $value['temperature'] . '}' . (--$count > 0 ? ',' : '');
    }
    return $result;
}

function getCaptorHumValue(string $from, string $to){
    $db = getDbAccess();
    $req = $db->prepare('SELECT humidity, date FROM captorData WHERE date > "' .  $from . '" AND date < "' . $to . '"');
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function formatHumValuetoChart($values){
    $result = '';
    $count = sizeof($values);
    foreach($values as $value){
        $result .= "{x: '" . $value['date'] . "', y: " . $value['humidity'] . '}' . (--$count > 0 ? ',' : '');
    }
    return $result;
}




?>