<?php
require "./header.php";
require "./sidebar.php";
require "../../database.php";


/* edit coode*/
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $id = $mysql->real_escape_string($id);
    $id = filter_var($id, FILTER_SANITIZE_MAGIC_QUOTES);

    $query = "select * from post where id = '$id'";
    $result = $mysql->query($query);
    $post_details = $result->fetch_object();
}


//save code//
if (isset($_POST['edit_post'])) {


  $id = $_POST['id'];
  $title = $_POST['title'];
  $title = filter_var($title, FILTER_SANITIZE_MAGIC_QUOTES);
  $content = $_POST['content'];
  $content = filter_var($content, FILTER_SANITIZE_MAGIC_QUOTES);



  if($_FILES['image']['error'] !== 4){
    $image = $_FILES['image']['name'];
  }
  
  if(!empty($image)){
      $query = "update post set title = '$title', content = '$content', image = '$image' where id = '$id'";
  }else{
     $query = "update post set title = '$title', content = '$content' where id = '$id'";
  }

  
  $result = $mysql->query($query);

  if ($result === true) {
    $_sucess = 'post update successfully';

    if($_FILES['image']['error'] !== 4){
        if (move_uploaded_file($_FILES['image']['tmp_name'], '../../uploads/'.$_FILES['image']['name'])) {
            $_sucess = 'post update successfully';
        }else{
            $error = "unnable to update post";
        }
    }

  }else{

    $error = "unnable to update post";

  }

}

?>
<!-- /.navbar-top-links -->

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Post</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        
        
        <!-- /.col-lg-4 (nested) -->
        <div class="col-lg-12">
            <div class="row" style="margin-top:20px ; margin-bottom: 100px">
                <div class="col-lg-12">
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                        <label for="">Title</label>
                        <input type="hidden" name="id" value="<?php echo  $post_details->id ?>">
                        <input type="text" value="<?php echo  $post_details->title ?>" class="form-control" name="title">
                        <br>
                        <label for="">Content</label>
                        <textarea name="content" rows="10" class="form-control" >
                            <?php echo $post_details->content?>
                        </textarea>
                        <br>
                        <label for="">Image</label>
                        <input type="file" class="form-control" name="image">
                        <br>
                        <button type="submit" name="edit_post" class="btn btn-success">Post</button>
                    </form>
                </div>
                
                <div class="clear-fix"></div>
                <?php if(isset($error)):?>
                <div style="margin-top: 20px" class="alert alert-danger col-lg-12"><?php echo $error?></div>
                <?php endif;?>
                <?php if(isset($_sucess)):?>
                <div style="margin-top: 20px" class="alert alert-success col-lg-12"><?php echo $_sucess?></div>
                <?php endif;?>
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