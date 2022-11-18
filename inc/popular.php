 <?php require_once("./app/database/db_functions.php"); 
$trendBooks = selectAll("posts") ;
$i= 0 ;

?> 
 
 <div class="section popular">
                    <h2 class="section-title">Popular</h2>

                     <?php foreach($trendBooks as $trendBook){ 
                        if($trendBook['rate'] > 5 )
                        $i++ ;
                        if($i ===  3 ) {
                            break ;
                        }else {
                        ?>
                        
                                <div class="post clearfix">
                                <img src="./admin/admin_assets/images/<?=$trendBook['image']?>">
                                <a href="single.php?book_id=<?=$trendBook['id']?>" class="title">
                                <h4><?= $trendBook['title']?></h4>
                                </a>
                            </div>
                    <?php } } ?>
            
                </div>