<?php 
$title ="Admin section-create Topic" ;
include("../admin_inc/admin_header.php") ;
include("../admin_inc/admin_navbar.php") ;

$error_fields= [] ;

if(isset($_POST['addTopic'])){
    unset($_POST['addTopic']) ;
    if(!(isset($_POST['name']) && !empty($_POST['name']))){
        $error_fields[] = "name" ;
    }
    if(!(isset($_POST['description']) && !empty($_POST['description']))){
        $error_fields[] = "description" ;
    }
    $existTopic = selectOne('topics' , ['name' => $_POST['name']]) ;
     if($existTopic){
        $error_fields[] = "existTopic" ;
     }

    if(!$error_fields){
        $_POST['name'] = mysqli_escape_string($conn , $_POST['name']) ;
        $_POST['description'] = mysqli_escape_string($conn,$_POST['description']) ;
        
        $topic_id = create('topics' , $_POST) ;
        header("Location: admin_indexTopic.php");
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
                <h2 class="page-title">Add Topic</h2>
                <form action="admin_createTopic.php" method="post">
                    <div>
                        <label>Name</label>
                        <input type="text" name="name"value="<?= (isset($_POST['name'])) ? $_POST['name'] : ''?>" class="text-input" />
                        <?php if(in_array("name" , $error_fields)) echo " <span class='class=msg error'>* please enter title for topic </span> " ?>
                        <?php if(in_array("name" , $error_fields)) echo " <span class='class=msg error'>* this topic already Exists </span> " ?>
                    </div>
                    <div>
                        <label for="Description">Description</label>
                        <textarea name="description" id="body" value="<?= (isset($_POST['description'])) ? $_POST['description'] : ''?>" class="text-input" ></textarea>
                        <?php if(in_array("description" , $error_fields)) echo " <span class='class=msg error'>* please enter description </span> " ?>
                    </div>

                    <div>
                        <button type="submit" name="addTopic" class="btn btn-big">Add Topic</button>
                    </div>

                </form>

            </div>
        </div>
        <!-- // Admin Content-->

    </div>
    <!--- /// admin wrapper-->

    #scripts
<?php include("../admin_inc/admin_scripts.php") ?>