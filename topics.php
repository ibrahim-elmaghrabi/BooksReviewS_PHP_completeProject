<?php
$title = "BR-Book Reviews:topics" ;
include("./inc/header.php") ;
include("./inc/navbar.php") ;

if(isset($_GET['topic_id'])){
    $topic_id = $_GET['topic_id'] ;
    $books = selectAll('posts' , ['topic_id' => $topic_id , 'publish' => 1  ]) ;
}

?>

    <!-- page wrapper/slider-->
    <div class="page-wrapper">

         <!-- content -->
         <div class="content clearfix">

            <!-- main content-->
            <div class="main-content">
                <h1 class="recent-post-title">
                    <?php
                    $topic = selectOne('topics', ['id' => $topic_id]) ;
                    echo $topic['name'] ;
                    ?>
                </h1>

                <?php foreach($books as $book) : ?>

                 <a href="single.php?book_id=<?= $book['id'] ?>">
                    <div class="post clearfix">
                    <img src="./admin/admin_assets/images/<?= $book['image'] ?>" alt="" class="post-image">
                    <div class="post-preview">
                        <h2><a href="single.html"><?= $book['title'] ?></a></h2>
                        <i class="far fa-user">
                            <?php $username  =selectOne('users' , ['id' => $book['user_id']]) ;
                                echo $username['username']?>
                                </i>
                        &nbsp; &nbsp; 
                        <i class="far fa-calendar"> <?= date('F j , Y',strtotime($book['created_at'])) ?></i>
                        <p class="preview-text" >
                            <?= html_entity_decode(substr($book['body'] , 0 , 150 ).'Their reason ...') ?>
                        </p>
                        <a href="single.php?book_id=<?=$book['id']?>" class="btn read-more" >Read More</a>
                    </div> 
                </div>
                 </a>

                <?php endforeach ; ?>
            </div>

            <!-- // main content -->
            <div class="sidebar">
                <?php
                    # search 
                    include("./inc/search.php") ;
                    
                    # sidebar Topics 
                    include("./inc/sidebar.php") ;
                ?>
            </div>
         </div>
         <!--- // content -->
        </div>
    <!--- /// page wrapper-->

    <?php
    /// footer 
    include("./inc/footer.php");
    /// scripts 
    include("./inc/scripts.php") ;
    ?>