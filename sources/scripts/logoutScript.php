<?php
//--------------------------
//Filename: logoutScript.php
//Creation date: 09.05.2017
//Author: Luc Wachter
//Function: The script to log users out. 
//Last modification: 09.05.2017
//--------------------------

if(isset($_SESSION['isConnected'])){
    session_destroy();
    header('location:'.URL.'?page=login&info=logout');
}
else header('location:'.URL.'?page=login&info=notlogged');
?>