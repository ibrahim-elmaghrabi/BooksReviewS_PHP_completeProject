
<header>
        <div class="logo">
            <h1 class="logo-text">
                <a href="index.php"><span>BR</span>-Book Reviews</a>
            </h1>
        </div>
        <i class="fa fa-bars menu-toggle"></i>
        <ul class="nav">
            <li><a href="./index.php">Home</a></li>
            <li><a href="./about.php">About</a></li>
            <li><a href="#">Services</a></li>

            <?php if(isset($_SESSION['id'])) :?>
            <li>
                <a href="#">
                    <i class="fa fa-user"></i>
                        <?= $_SESSION['username'] ?>
                    <i class="fa fa-chevron-down" style="font-size: 0.8em ;"></i>
                </a>
                     
                <ul>
                    <?php if($_SESSION['admin'] === 1 ) :?>
                         <li><a  href="./admin/posts/admin_indexPost.php">Dashboard</a></li>
                    <?php endif ;?>
                    <li><a href="./logout.php" class="logout">Logout</a></li>
                </ul>
            </li>
            <?php else :?>

             <li><a href="./register.php">Signup</a></li>
            <li><a href="./login.php">login</a></li>

            <?php endif ; ?>
        
             
        </ul>
    </header>