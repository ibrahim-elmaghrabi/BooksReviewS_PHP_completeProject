<?php 
include("../admin_inc/admin_header.php") ;
include("../admin_inc/admin_navbar.php") ;

if(isset($_GET['post_id'])){
    $id = $_GET['post_id'] ;

    $count = delete('posts' , $id ) ;
    header("Location: admin_indexPost.php") ;
    exit ;
    
}

