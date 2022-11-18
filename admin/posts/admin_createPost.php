<?php
$title ="Admin section-create Books";
include("../admin_inc/admin_header.php");
include("../admin_inc/admin_navbar.php"); 


$error_fields= [] ;
$allTopics = selectAll('topics') ;
if(isset($_POST['addPost'])){

    unset($_POST['addPost']) ;
    $topic_id = $_POST['topic_id'] ;
    

   if(!(isset($_POST['title']) && !empty($_POST['title']))){
        $error_fields[] = "title" ;
    }

    if(!(isset($_POST['body']) && !empty($_POST['body']))){
        $error_fields[] = 'body';
    }

     $existTitle = selectOne('posts' , ['title' => $_POST['title']]) ;
     if($existTitle){
        $error_fields[] = "existTitle" ;
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

    if(!$error_fields){
        $title = mysqli_escape_string($conn , $_POST['title']) ;
        $body = mysqli_escape_string($conn,$_POST['body']) ;
        $body = htmlentities($body) ;
        $publish = (isset($_POST['publish'])) ? 1 : 0 ;
        $rate = $_POST['rate'] ;
        $_POST['user_id'] = $_SESSION['id'] ;

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
        $book = create('posts' ,
         ['title' => $title , 'body' => $body , 'rate' => $rate , 'image' => $avatar , 'publish' => $publish ,
          'topic_id' => $topic_id  , 'user_id' => $_POST['user_id'] ] ) ;
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
                <h2 class="page-title">Add Book</h2>
                <form action="admin_createPost.php" method="post" enctype="multipart/form-data">
                    <div>
                        <label>Title</label>
                        <input type="text" name="title" value="<?= (isset($_POST['title'])) ? $_POST['title'] : '' ?>" class="text-input" />
                         <?php if(in_array("title" , $error_fields)) echo " <span class='class=msg error'>* please enter title for book </span> " ?>
                         <?php if(in_array("existTitle" , $error_fields)) echo " <span class='class=msg error'>* this title already Exists </span> " ?>
                    </div>
                    <div>
                        <label for="body">Body</label>
                        <textarea type="text" name="body" id="body" >
                            <?=(isset($_POST['body'])) ? $_POST['body'] : '' ?>
                        </textarea>
                        <?php if(in_array("body" , $error_fields)) echo " <span class='class=msg error'>* please enter body for the book </span> " ?>
                        
                        
                    </div>

                    <div>
                        <label for="rate">Rate</label>
                         <input type="number" name="rate" min="1" max="10" value="<?= (isset($_POST['rate'])) ? $_POST['rate'] : '' ?>"  class="text-input" />
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
                        <input type="checkbox" name="publish"  > publish
                     </label>
                    </div>

                    <div>
                        <button type="submit" name="addPost" class="btn btn-big">Add Book</button>
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