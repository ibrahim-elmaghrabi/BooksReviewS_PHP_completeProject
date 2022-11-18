 <header>
        <div class="logo">
            <h1 class="logo-text"><a href="../../index.php"><span>BR</span>-Book Reviews</a></h1>
        </div>
        <i class="fa fa-bars menu-toggle"></i>
        <ul class="nav">
             
            <li>
                <?php if(isset($_SESSION['username'])) :?>
                <a href="#">
                    <i class="fa fa-user"></i>
                    <?= $_SESSION['username'] ?>
                    <i class="fa fa-chevron-down" style="font-size: 0.8em ;"></i>
                </a>
                 <ul>
                    <li><a href="../../logout.php" class="logout">Logout</a></li>
                </ul>
            </li>

               <?php endif ;?>
                 

                
        </ul>
    </header>