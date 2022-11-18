<?php 
$title ="Admin section-create user" ;
include("../admin_inc/admin_header.php") ;
include("../admin_inc/admin_navbar.php") ;

$error_fields = [] ;

 if(isset($_POST['addUser'])){
    
    if(!(isset($_POST['username']) && !empty($_POST['username']))){
        $error_fields[] = "username" ;
    }
    if(!(isset($_POST['email']) && filter_input(INPUT_POST, 'email' , FILTER_VALIDATE_EMAIL))){
        $error_fields[] = "email" ;
    }
     #check if email is exist already or not
     $existEmail = selectOne('users' , ['email' => $_POST['email']]) ;
     if($existEmail){
        $error_fields[] = "existEmail" ;
     }
    if(!(isset($_POST['password']) && strlen($_POST['password']) > 5)){
        $error_fields[] = "password";
    }
    if(! (isset($_POST['passwordConf']) && $_POST['password'] === $_POST['passwordConf'])){
        $error_fields[] = "passwordConf" ;
    }
    if(!$error_fields){
        unset($_POST['addUser'] , $_POST['passwordConf']) ;
        $_POST['username']  = mysqli_escape_string($conn , $_POST['username']) ;
        $_POST['email']    =mysqli_escape_string($conn , $_POST['email']) ;
        $_POST['password'] =sha1($_POST['password']) ;
        $_POST['admin']     =(isset($_POST['admin'])) ? 1 : 0 ;
        $user_id = create('users' , $_POST ) ;
        header("Location: admin_indexUser.php") ;
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
                <a href="admin_createUser.php" class="btn btn-big">Add User</a>
                <a href="admin_indexUser.php" class="btn btn-big">Manage Users</a>
            </div>

            <div class="content">
                <h2 class="page-title">Add User</h2>
                <form action="admin_createUser.php" method="post">
                        <div>
                        <label for="username">Username</label>
                        <input type="text" name="username"value="<?= (isset($_POST['username'])) ? $_POST['username'] : ''?>"class="text-input">
                        <div>
                            <?php if(in_array("username" , $error_fields)) echo " <span class='class=msg error'>* please enter your username</span> " ?>
                        </div>
                    </div>

                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email"value="<?= (isset($_POST['email'])) ? $_POST['email'] : ''?>"  class="text-input">
                        <div>
                            <?php if(in_array("email" , $error_fields)) echo "<span class='class=msg error'>* please enter valid Email</span>"?>
                            <?php if(in_array("existEmail" , $error_fields)) echo "<span class='class=msg error'>* Email  already Exists </span>"  ?>
                        </div>
                    </div>

                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password"value="<?= (isset($_POST['password'])) ? $_POST['password'] : ''?>" class="text-input">
                        <div>
                            <?php if(in_array("password" , $error_fields)) 
                            echo "<span class='class=msg error'>* please enter password more than 5 characters </span> " ?>
                        </div>
                    </div>

                    <div>
                        <label for="password">Password Confirmation</label>
                        <input type="password" name="passwordConf" class="text-input">
                        <div>
                            <?php if(in_array("passwordConf" , $error_fields)) echo "<span class='class=msg error' >*Passwords do not match</span> " ?>
                        </div>
                    </div>


                    <div>
                        <label>
                            <input type="checkbox" name="admin"  <?=  (isset($_POST['admin'])) ? "checked" : '' ?> />
                            Admin
                        </label>
                    </div>

                    <div>
                        <button type="submit" name="addUser" class="btn btn-big">Add user</button>
                    </div>

                </form>

            </div>
        </div>
        <!-- // Admin Content-->

    </div>
    <!--- /// admin wrapper-->


    #scripts
<?php include("../admin_inc/admin_scripts.php") ?>