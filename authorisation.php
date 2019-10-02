<?php
session_start();
include 'v_top.php';
if($_POST['exit']==1)$_SESSION['vhod']=0;

if(isset($_POST['login']) && isset($_POST['password']))
{
    $pass=$_POST['password'];
    $login=$_POST['login'];
    if($login=='admin' && $pass=='123')
    {
        $_SESSION['vhod']=1;
        $message='Вы вошли как admin';
    }
    else $message='Неверный логин или пароль.';
}
include 'v_autorisation.php';
