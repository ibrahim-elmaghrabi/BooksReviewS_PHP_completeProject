<?php
//$title ="Admin section-Edit Book";
include("../admin_inc/admin_header.php");
include("../admin_inc/admin_navbar.php"); 

$error_fields = [] ;
$allTopics = selectAll('topics') ;

if(isset($_GET['post_id'])){
    $id = $_GET['post_id'] ;
    $post = selectOne('posts' , ['id' => $id]) ;
    $id = $post['id'] ;
    $title = $post['title'] ;
    $body = $post['body'] ;
    $rate = $post['rate']  ;
    $topic_id = $post['topic_id'] ;
    $publish = $post['publish'] ;
}
if(isset($_GET['publish']) && isset($_GET['p_id'])){
    $publish = $_GET['publish'] ;
    $p_id    = $_GET['p_id'] ;

    $count = update('posts' , $p_id , ['publish' => $publish]) ;
    header("Location: admin_indexPost.php") ;
    exit;
}
if(isset($_POST['update'])){
    

   if(!(isset($_POST['title']) && !empty($_POST['title']))){
        $error_fields[] = "title" ;
    }

    if(!(isset($_POST['body']) && !empty($_POST['body']))){
        $error_fields[] = 'body';
    }

     if(!(isset($_FILES['avatar']['name']) && !empty($_FILES['avatar']['name']))){
        $error_fields[] = "avatar" ;
    }  

    if(!(isset($_POST['rate']) && !empty($_POST['rate']) && $_POST['rate']  >= 1  && $_POST['rate'] <= 10) ){
        $error_fields[] = "rate" ;
    }
    if(!(isset($_POST['topic_id']) && !empty($_POST['topic_id']))){
        $error_fields[] = 'topic_id';
    }

     $existTitle = selectOne('posts' , ['title' => $_POST['title']]) ;
     if($existTitle){
        if(isset($_POST['update']) && $existTitle['id'] != $_POST['id']){
            $error_fields[] = "existTitle" ;
        }  
    }
         
       

    if(!$error_fields){

        $updated_title = mysqli_escape_string($conn , $_POST['title']) ;
        $updated_body = mysqli_escape_string($conn,$_POST['body']) ;
        $updated_body = htmlentities($updated_body) ;
        $updated_publish = isset($_POST['publish']) ? 1 : 0 ;
        $updated_rate = $_POST['rate'] ;
        $updated_topic_id = $_POST['topic_id'] ;
        $updated_id   = $_POST['id'] ;
        $_POST['user_id']  = $_SESSION['id'] ;
        unset($_POST['update'] , $_POST['id']) ;

         #upload file 
        $uploads_dir = $_SERVER['DOCUMENT_ROOT']."/Hblog/admin/admin_assets/images" ;  // DOCUMENT_ROOT  == opt/lampp/htdocs 
        $avatar = '' ;
        if($_FILES["avatar"]["error"] == UPLOAD_ERR_OK){
        $tmp_name =$_FILES["avatar"]["tmp_name"] ;
        $avatar = basename($_FILES["avatar"]["name"]) ;
        move_uploaded_file($tmp_name  , "$uploads_dir/$avatar") ;
         
        }else{
            echo "file can't be uploaded " ;
            exit ;
        }
        
         #insert data 
        $updatedBook = update('posts' , $updated_id,
         ['title' => $updated_title , 'body' => $updated_body , 'rate' => $updated_rate , 'image' => $avatar , 
         'publish' => $updated_publish , 'topic_id' => $updated_topic_id  , 'user_id' => $_POST['user_id'] ] ) ;
         header("Location: admin_indexPost.php") ;
         exit ;
    }
}
?>


    <!-- Admin  page wrapper/slider-->
    <div class="admin-wrapper">

        <!-- left sidebar-->
         <?php include("../admin_inc/admin_sidebar.php") ?>
         <!--// left sidebar-->

           <!-- Admin content-->
        <div class="admin-content">
              <div class="button-group">
                <a href="admin_createPost.php" class="btn btn-big">Add</a>
                <a href="admin_indexPost.php" class="btn btn-big">Manage</a>
            </div>

            <div class="content">
                <h2 class="page-title">Edit Book</h2>
                <form action="admin_editPost.php" method="post" enctype="multipart/form-data">
                    <div>
                        <input type="hidden" name="id" value="<?= $id ?>" />
                    </div>

                    <div>
                        <label>Title</label>
                        <input type="text" name="title" value="<?= (isset($title)) ? $title : '' ?>" class="text-input" />
                         <?php if(in_array("title" , $error_fields)) echo " <span class='class=msg error'>* please enter title for book </span> " ?>

                    </div>
                    <div>
                        <label for="body">Body</label>
                        <textarea type="text" name="body" id="body" >
                            <?=(isset($body)) ? $body : '' ?>
                        </textarea>
                        <?php if(in_array("body" , $error_fields)) echo " <span class='class=msg error'>* please enter body for the book </span> " ?>
                        
                    </div>

                    <div>
                        <label for="rate">Rate</label>
                         <input type="number" name="rate" min="1" max="10" value="<?= (isset($rate)) ? $rate : '' ?>"  class="text-input" />
                         <?php if(in_array("rate" , $error_fields)) echo " <span class='class=msg error'>* please enter rate for the book </span> " ?>
                    </div>

                    <div>
                        <label for="image">Image</label>
                        <input type="file" name="avatar" value=""  class="text-input">
                        <?php if(in_array("avatar" , $error_fields)) echo " <span class='class=msg error'>* please enter image for the book </span> " ?>
                         
                    </div>
                    

                    <div>
                        <label>Topic</label>
                         <select name="topic_id" class="text-input">
                            <option></option>
                            <?php foreach($allTopics as $key => $topic): ?>
                                    <?php if(!empty($topic_id) && $topic_id == $topic['id']) : ?>
                                        <option selected value="<?= $topic['id'] ?>" >
                                            <?= $topic['name'] ?>
                                        </option>
                                    <?php else: ?> 
                                        <option value="<?= $topic['id'] ?>" >
                                            <?= $topic['name'] ?>
                                        </option>
                                    <?php endif ; ?>
                            <?php endforeach ; ?>
                         </select>
                         <?php if(in_array("topic_id" , $error_fields)) echo " <span class='class=msg error'>* please select topic for the book </span> " ?>
                    </div>

                    
                    <div>
                         <label>
                                 <input type="checkbox"  name="publish" <?= (isset($publish)) ? "checked" : '' ?> />publish
                            </label>
                    </div>

                    <div>
                        <button type="submit" name="update" class="btn btn-big">update</button>
                    </div>

                </form>
                 
            </div>
        </div>
         <!-- // Admin Content-->
       
    </div>
    <!--- /// admin wrapper-->

 <?php 
 #scripts 
 include("../admin_inc/admin_scripts.php") ;
 ?>

 