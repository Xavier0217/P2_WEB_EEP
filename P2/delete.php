<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

require 'includes/config.php';

    
$id = $_GET['id'];

$stmt = $conexao->prepare("DELETE FROM eventos WHERE id=?");
$stmt -> bind_param("i",$id);
$stmt -> execute();

header("Location: dashboard.php");
exit();  
?>