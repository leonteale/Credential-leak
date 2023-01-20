<?php
session_start();
if(!isset($_SESSION['session_id'])){
    $_SESSION['session_id'] = md5(uniqid());
}
$session_id = $_SESSION['session_id'];
?>