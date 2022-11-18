<?php
$title = "Book Details" ;
include("./inc/header.php");
include("./inc/navbar.php");

if(isset($_GET['book_id'])){
    $book_id = $_GET['book_id'] ;
    $book = selectOne("posts" , ['id' => $book_id]) ;
    

}
?>
    <!-- page wrapper/slider-->
    <div class="page-wrapper">
        <!-- content -->
        <div class="content clearfix">

            <!-- main content wrapper-->
            <div class="main-content-wrapper">
                <!-- main content-->
                <div class="main-content single">
                    <h1 class="post-title"><?= $book['title'] ?></h1>
                     <img src="./admin/admin_assets/images/<?= $book['image'] ?>" alt="" 
                        style="height: 400px; width: 400px ; margin:auto; padding :auto ; display: block;">
                
                    <div class="post-content">
                        <p>
                             <?= html_entity_decode($book['body']) ?>
                        </p>
                         
                
                    </div>
                </div>
                <!-- // main content -->

            </div>
            <!-- // main content wrapper-->

            <!-- sidebar-->
            <div class="sidebar single">
                <?php
                #popular Books
                include("./inc/popular.php") ;
                #sidebar Topics
                include("./inc/sidebar.php"); 
                ?>
            </div>
            <!-- //  sidebar-->
        </div>
        <!--- // content -->
    </div>
    <!--- /// page wrapper-->

     <?php 
    include("./inc/footer.php");
    include("./inc/scripts.php");
     ?>