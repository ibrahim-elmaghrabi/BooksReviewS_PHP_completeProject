<?php 
$title = "Login" ;
include("./inc/header.php") ;
include("./inc/navbar.php") ;

$error_fields =[] ;
if(isset($_POST['login-btn'])){
    if(!(isset($_POST['email']) && filter_input(INPUT_POST, 'email' , FILTER_VALIDATE_EMAIL))){
        $error_fields[] = "email" ;
    }
     if(!(isset($_POST['password']) && strlen($_POST['password']) > 5)){
        $error_fields[] = "password";
     }
    if(!$error_fields){
        $_POST['email'] = mysqli_escape_string($conn , $_POST['email']) ;
        $_POST['password'] = sha1($_POST['password']) ;
        $logUser=selectOne('users' , ['email' => $_POST['email'] , 'password' => $_POST['password']]) ;
        if($logUser){
            $_SESSION['id'] = $logUser['id'] ;
            $_SESSION['username'] = $logUser['username'] ;
            $_SESSION['admin'] = $logUser['admin'] ;
            header("Location: index.php") ;
            exit ;
        }
    }else{
            $errorValidation = " * Invalid Email Or Password " ;
        }
    
}
?>
    <div class="auth-content">
        <form action="login.php" method="POST">
            <h2 class="form-title">Login</h2>
            <div>
             <?php  if(isset($errorValidation)) { echo"<span class='msg error'>$errorValidation </span>" ; }  ?> 
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : '' ?>" class="text-input">
                <div>
                    <?php if(in_array("email" , $error_fields)) echo " <span class='class=msg error'>* please enter valid Email</span> " ?>
                </div>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" class="text-input">
                <div>
                    <?php if(in_array("password" , $error_fields)) echo " <span class='class=msg error'>* please enter valid Password</span> " ?>
                </div>
            </div>

            <div>
                <button type="submit" name="login-btn" class="btn btn-big">Login</button>
            </div>

            <p>Or <a href="register.php" style="font-weight: bold;">Sign Up</a></p>
             
        </form>
    </div>
    
<?php
#scripts 
include("./inc/scripts.php") ; 
?>