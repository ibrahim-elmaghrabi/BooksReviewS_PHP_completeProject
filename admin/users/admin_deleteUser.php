<?php 
include("../admin_inc/admin_header.php") ;
include("../admin_inc/admin_navbar.php") ;

if(isset($_GET['user_id'])){
    $id = $_GET['user_id'] ;

    $count = delete('users' , $id) ;
    header("Location: admin_indexUser.php") ;
    exit ;
    
}

