<?php 
$title ="Admin section-manage Users" ;
include("../admin_inc/admin_header.php") ;
include("../admin_inc/admin_navbar.php") ;

$users = selectAll('users') ;
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
                <h2 class="page-title">Manage Users</h2>
                <table>
                    <thead>
                        <th>SN</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <tbody>
                         <?php foreach($users as $key => $user) :?>
                             <tr>
                                <td><?= $key +1 ?></td>
                                <td><?=$user['username']?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= ($user['admin']) ? "Admin" : "Author" ?></td>
                                <td><a href="admin_editUser.php?user_id=<?= $user['id'] ?>" class="edit">Edit</a></td>
                                 <?php if($user['id'] == 18  ) :?>
                                    <td><a href="admin_deleteUser.php?user_id=<?= $user['id'] ?>" class="delete">Delete</a></td>
                                <?php endif ;?>
                            </tr>
                         <?php endforeach ; ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <!-- // Admin Content-->

    </div>
    <!--- /// admin wrapper-->



    #scripts
<?php include("../admin_inc/admin_scripts.php") ?>