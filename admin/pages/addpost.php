<?php
require "./header.php";
require "./sidebar.php";
require "../../database.php";


//save code//
if (isset($_POST['post'])) {
  
  $title = $_POST['title'];
  $content = $_POST['content'];
  $image = $_FILES['image']['name'];


  $query = "insert into post (title,content,image) values ('$title','$content','$image')";

  $result = $mysql->query($query);

  if ($result === true) {

    if (move_uploaded_file($_FILES['image']['tmp_name'], '../../uploads/'.$_FILES['image']['name'])) {
      $_sucess = 'post sumit successfully';
    }else{
      $error = "unnable to upload post";
    }

  }else{

    $error = "unnable to upload post";

  }

}
?>
<!-- /.navbar-top-links -->

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Post</h1>
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

                        <input type="text" " class="form-control" name="title">
                        <br>
                        <label for="">Content</label>
                        <textarea name="content" rows="10" class="form-control" ></textarea>
                        <br>
                        <label for="">Image</label>
                        <input type="file" class="form-control" name="image">
                        <br>
                        <button type="submit" name="post" class="btn btn-success">Post</button>
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