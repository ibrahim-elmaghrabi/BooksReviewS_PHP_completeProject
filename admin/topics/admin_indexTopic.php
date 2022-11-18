<?php 
$title ="Admin section-manage Topics" ;
include("../admin_inc/admin_header.php") ;
include("../admin_inc/admin_navbar.php") ;

$topics = selectAll('topics') ;
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
                <h2 class="page-title">Manage Topics</h2>
                <table>
                    <thead>
                        <th>SN</th>
                        <th>Name</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <tbody>
                         <?php foreach($topics as $key => $topic) : ?>
                            <tr>
                            <td><?= $key +1  ?></td>
                            <td><?= $topic['name'] ?></td>
                            <td><a href="admin_editTopic.php?topic_id=<?=$topic['id']?>" class="edit">Edit</a></td>
                            <td><a href="admin_deleteTopic.php?topic_id=<?=$topic['id']?>" class="delete">Delete</a></td>
                        </tr>
                         <?php endforeach ;?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- // Admin Content-->

    </div>
    <!--- /// admin wrapper-->


    #scripts
<?php include("../admin_inc/admin_scripts.php") ?>