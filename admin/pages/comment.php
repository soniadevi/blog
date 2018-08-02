<?php
require "./header.php";
require "./sidebar.php";
require "../../database.php";

if(!isset($_GET['view'])){
  header('Location: ./index.php');
}

$postid = $_GET['view'];

$postid = $mysql->real_escape_string($postid);

$postid = filter_var($postid, FILTER_SANITIZE_MAGIC_QUOTES);

$query = "select * from comment where post_id = '$postid'";
$result = $mysql-> query($query);
if ($result->num_rows < 1) {
  $comments = [];
}else{
  while ($row = $result->fetch_object()) {
    $comments[] = $row;
  }
}

/* delete coode*/
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $id = $mysql->real_escape_string($id);
    $id = filter_var($id, FILTER_SANITIZE_MAGIC_QUOTES);

    $query = "delete from comment where id = '$id'";
    $result = $mysql->query($query);
    if($result === true){
        $delete_success = "Comment {$id} is deleted";
    } else{
        $delete_error = "Comment {$id} is fail to delete";
    }

}




?>
<!-- /.navbar-top-links -->

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Comments of post <?php echo $postid?></h1>
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
                            Comment Table
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width="30px"> ID</th>
                                        <th>Comment</th>
                                        <th width="150px">Create Date</th>
                                        
                                        <th width="60px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($comments as $comment):?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $comment->id ?> </td>
                                        <td><?php echo $comment->comment ?></td>
                                        <td><?php echo $comment->created_at ?></td>
                                       
                                        <td class="center">
                                            <a class = "btn btn-xs btn-danger" href="<?php echo $_SERVER['PHP_SELF']?>?delete=<?php echo $comment->id ?>"><span class="fa fa-trash"></span> </a> 
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