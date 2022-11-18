<?php require_once("./app/database/db_functions.php"); 
$trendBooks = selectAll("posts") ;
?>
<div class="post-slider">
            <h1 class="slider-title">Trending Books</h1>
            <i class="fas fa-chevron-left prev"></i>
            <i class="fas fa-chevron-right next "></i>


            <div class="post-wrapper">

                <?php foreach($trendBooks as $trendBook) : ?>
                     <?php if($trendBook['rate'] > 5 ) :?>
                        <div class="post clearfix">
                    <img src="./admin/admin_assets/images/<?=$trendBook['image']?>" class="slider-image">
                    <div class="post-info">
                        <h4><a href="single.php?book_id=<?=$trendBook['id']?>"><?= $trendBook['title'] ?></a></h4>
                        <i class="far fa-user"><?php $author = selectOne('users' , ['id' => $trendBook['user_id']]) ; 
                                        echo $author['username'] ?></i>
                        &nbsp; &nbsp;
                        <i class="far fa-calendar"><?= date('F j , Y',strtotime($trendBook['created_at'])) ?></i>
                    </div>
                </div> 
                   <?php endif; ?>
                <?php endforeach ; ?>          
            </div>
         </div>