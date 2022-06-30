<?php
require_once 'toolBox.php';
session_start();
if(!isConnected()){
    header('Location: notConnected.php');
}

?>