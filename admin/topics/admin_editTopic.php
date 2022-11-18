<?php 
$title ="Admin section-Edit Topic" ;
include("../admin_inc/admin_header.php") ;
include("../admin_inc/admin_navbar.php") ;

$error_fields= [] ;
if(isset($_GET['topic_id'])){

    $topic_id = $_GET['topic_id'] ;
    $topic = selectOne('topics' , ['id' => $topic_id]) ;
    $topic_id = $topic['id'] ;
    
}

 if(isset($_POST['updateTopic'])){
        if(!(isset($_POST['name']) && !empty($_POST['name']))){
            $error_fields[] = "name" ;
        }
        if(!(isset($_POST['description']) && !empty($_POST['description']))){
            $error_fields[] = "description" ;
        }
         $existTopic = selectOne('topics' , ['name' => $_POST['name']]) ;
            if($existTopic){
            if($_POST['updateTopic'] && $existTopic['id'] != $_POST['id']){
                $error_fields[] = "existTopic" ;
            }    
             
     }
        if(!$error_fields){
            $topic_id = $_POST['id'] ;
            unset($_POST['updateTopic'] , $_POST['id']) ;
            $_POST['name'] = mysqli_escape_string($conn , $_POST['name']) ;
            $_POST['description'] = mysqli_escape_string($conn,$_POST['description']) ;
            
            $updatedTopic = update('topics', $topic_id , $_POST );
            header("Location: admin_indexTopic.php") ;
            exit ;

        }

    }
?>
    <!-- Admin  page wrapper/slider-->
    <div class="admin-wrapper">

        <!-- left sidebar-->
         <?php include("../admin_inc/admin_sidebar.php") ; ?>
        <!--// left sidebar-->

        <!-- Admin content-->
        <div class="admin-content">
            <div class="button-group">
                <a href="admin_createTopic.php" class="btn btn-big">Add Topic</a>
                <a href="admin_indexTopic.php" class="btn btn-big">Manage Topics</a>
            </div>

            <div class="content">
                <h2 class="page-title">Edit Topic</h2>
                <form action="admin_editTopic.php" method="post">
                    <input type="hidden" name="id" value="<?= $topic_id ?>" >
                   
                    <div>
                        <label>Name</label>
                        <input type="text" name="name" value="<?=  (isset($topic['name'])) ? $topic['name'] : '' ?>"  class="text-input" /> 
                        <?php if(in_array("name" , $error_fields)) echo " <span class='class=msg error'>* please enter title for topic </span> " ?>
                        <?php if(in_array("existTopic" , $error_fields)) echo " <span class='class=msg error'>* this topic already Exists </span> " ?>
                    </div>
                    <div>
                        <label for="Description">Description</label>
                        <textarea name="description" id="body" class="text-input">
                           <?= (isset($topic['description']) ? $topic['description'] : '') ?>
                        </textarea>
                         <?php if(in_array("description" , $error_fields)) echo " <span class='class=msg error'>* please enter description for topic </span> " ?>
                    </div>

                    <div>
                        <button type="submit" name="updateTopic" class="btn btn-big">Update Topic</button>
                    </div>

                </form>

            </div>
        </div>
        <!-- // Admin Content-->

    </div>
    <!--- /// admin wrapper-->

    #scripts
<?php include("../admin_inc/admin_scripts.php") ?>