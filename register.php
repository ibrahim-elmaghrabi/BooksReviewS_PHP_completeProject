 <?php
 $title = "Register";
 require_once("./inc/header.php");
 require_once("./inc/navbar.php");
 
 $error_fields = [] ;
 if(isset($_POST['register-btn'])){
    
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
        unset($_POST['register-btn'] , $_POST['passwordConf']) ;
        $_POST['username']  = mysqli_escape_string($conn , $_POST['username']) ;
        $_POST['email']    =mysqli_escape_string($conn , $_POST['email']) ;
        $_POST['password'] =sha1($_POST['password']) ;
        
        $user_id = create('users' , $_POST ) ;
        $user = selectOne('users' , [ 'id' => $user_id]) ;
        header("Location: login.php") ;
        exit;
    }

 }

 ?>

  <div class="auth-content">
    <form action="register.php" method="POST">
        <h2 class="form-title">Register</h2>

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
            <button type="submit" name="register-btn" class="btn btn-big ">Register</button>
        </div>

        <p>Or <a href="login.php" style="font-weight: bold;">Sign In</a></p>
    </form>
  </div>
  
<?php
#scripts 
include("./inc/scripts.php") ; 
?>