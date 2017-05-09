<?php 
if(isset($_SESSION['connection'])){
    session_destroy();
    header('location:'.URL.'?page=login&info=logout');
}
else header('location:'.URL.'?page=login&info=notlogged');
?>