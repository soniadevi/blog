<?php
require "./header.php";
require "./sidebar.php";
require "../../database.php";

$query = "select * from post order by id desc";
$result = $mysql->query ($query);
if ($result-> num_rows < 1) {
    $posts = array(); 
} else{
    while ($row = $result -> fetch_object()) {
       $posts[] = $row;
    }
}

/* delete coode*/
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $id = $mysql->real_escape_string($id);
    $id = filter_var($id, FILTER_SANITIZE_MAGIC_QUOTES);

    $query = "delete from post where id = '$id'";
    $result = $mysql->query($query);
    if($result === true){
        $delete_success = "Post {$id} is deleted";
    } else{
        $delete_error = "Post {$id} is fail to delete";
    }

}




?>
<!-- /.navbar-top-links -->

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Posts</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        
        <?php if(isset($delete_error)):?>
            <div style="margin-top: 20px" class="alert alert-danger col-lg-12"><?php echo $delete_error?></div>
        <?php endif;?>
        <?php if(isset($delete_success)):?>
            <div style="margin-top: 20px" class="alert alert-success col-lg-12"><?php echo $delete_success?></div>
        <?php endif;?>
        <!-- /.col-lg-4 (nested) -->
        <div class="col-lg-12">
            <div class="row" style="margin-top:20px ; margin-bottom: 100px">
                <div class="panel panel-default">
                        <div class="panel-heading">
                            Post Table
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Create Date</th>
                                        <th>Likes</th>
                                        <th>Dislikes</th>
                                        <th>Comments</th>
                                        <th>Views</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($posts as $post):?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $post->id ?> </td>
                                        <td><?php echo $post->title ?></td>
                                        <td><?php echo $post->created_at ?></td>
                                        <td class="center"><?php echo $post->total_likes?></td>
                                        <td class="center"><?php echo $post->total_dislikes ?></td>
                                        <td class="center"><?php echo $post->total_comments ?></td>
                                        <td class="center"><?php echo $post->total_views ?></td>
                                        <td class="center">
                                            <a class = "btn btn-xs btn-danger" href="<?php echo $_SERVER['PHP_SELF']?>?delete=<?php echo $post->id ?>"><span class="fa fa-trash"></span> </a> 

                                            <a class = "btn btn-xs btn-info" href="./edit_post.php?edit=<?php echo $post->id ?>"><span class="fa fa-edit"></span> </a> 

                                            <a class = "btn btn-xs btn-success" href="./view_post.php?view=<?php echo $post->id ?>"><span class="fa fa-eye"></span> </a> 

                                            <a class = "btn btn-xs btn-warning" href="./comment.php?view=<?php echo $post->id ?>"><span class="fa fa-comments"></span> </a> 
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
            </div>
        </div>
        <!-- /.col-lg-8 (nested) -->
    </div>
    <!-- /.row -->
</div>
<!-- /.panel-body -->
</div>
<!-- /.panel -->
<?php 
require "./footer.php";
?>


<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>