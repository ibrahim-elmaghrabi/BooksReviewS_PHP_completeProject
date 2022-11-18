 <?php 
require_once("./app/database/db_functions.php");
$topics = selectAll('topics');
 ?>
 <div class="section topics">
                        <h2 class="section-title">Topics</h2>
                        <ul>
                            <?php foreach($topics as $topic) :?>
                                <li><a href="topics.php?topic_id=<?=$topic['id']?>"><?= $topic['name']?></a></li>
                            <?php endforeach ; ?>
                        </ul>
                </div>