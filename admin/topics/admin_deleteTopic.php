<?php 
include("../admin_inc/admin_header.php") ;
include("../admin_inc/admin_navbar.php") ;

if(isset($_GET['topic_id'])){
    $id = $_GET['topic_id'] ;

    $count = delete('topics' , $id ) ;
    header("Location: admin_indexTopic.php") ;
    exit ;
    
}

