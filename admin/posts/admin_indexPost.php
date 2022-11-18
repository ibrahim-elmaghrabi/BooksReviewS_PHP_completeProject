<?php 
$title ="Admin section-manage-Books" ;
include("../admin_inc/admin_header.php") ;
include("../admin_inc/admin_navbar.php") ;

$books = selectAll('posts') ;

?>

    <!-- Admin  page wrapper/slider-->
    <div class="admin-wrapper">

        <!-- left sidebar-->
         <?php include("../admin_inc/admin_sidebar.php") ; ?>
        <!--// left sidebar-->

        <!-- Admin content-->
        <div class="admin-content">
            <div class="button-group">
                <a href="admin_createPost.php" class="btn btn-big">Add Book</a>
                <a href="admin_indexPost.php" class="btn btn-big">Manage Books</a>
            </div>

            <div class="content">
                <h2 class="page-title">Manage Books</h2>
                <table>
                    <thead>
                        <th>SN</th>
                        <th>Title</th>
                        <th>Author</th>
                        <td>Image</td>
                        <th>Rate</th>
                        <th colspan="3">Action</th>
                    </thead>
                    <tbody>
                         <?php foreach($books as $key => $book) : ?>
                            <tr>
                            <td><?= $key + 1  ?></td>
                            <td><?= $book['title'] ; ?></td>
                            <td><?php $author = selectOne('users' , ['id' => $book['user_id']]) ; echo $author['username'] ?></td>
                            <td><img src="../admin_assets/images/<?=$book['image']?>" style="width: 100px ; height: 100px ;"  /></td>
                            <td><?= $book['rate'] ?></td>
                            <td><a href="admin_editPost.php?post_id=<?=$book['id']?>" class="edit">Edit</a></td>
                            <td><a href="admin_deletePost.php?post_id=<?=$book['id']?>" class="delete">Delete</a></td>

                            <?php if($book['publish']) :?>
                                <td><a href="admin_editPost.php?publish=0&p_id=<?=$book['id']?>" class="non-publish">unPublish</a></td>
                            <?php else : ?>
                                <td><a href="admin_editPost.php?publish=1&p_id=<?=$book['id']?>" class="publish">Publish</a></td>
                            <?php endif ;?>
                        </tr>
                         <?php endforeach ;?>
                         
                    </tbody>
                </table>
            </div>
        </div>
        <!-- // Admin Content-->

    </div>
    <!--- /// admin wrapper-->

    
<?php
#scripts 
include("../admin_inc/admin_scripts.php") ;
?>