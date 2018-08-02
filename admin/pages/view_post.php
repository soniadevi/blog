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


$query = "select * from post where id='$postid'";

$result = $mysql->query($query);


if ($result->num_rows < 1) {

  header('Location: ./index.php');

} else {

 $post = $result->fetch_object();

}

?>
<!-- /.navbar-top-links -->

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">View Post</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        
        
        <!-- /.col-lg-4 (nested) -->
        <div class="col-lg-12">
            <div class="row" style="margin-top:20px ; margin-bottom: 100px">
                <div class="col-lg-12" style="text-align: center; margin-bottom: 20px">
          <img class="img-fluid rounded" src="<?php echo '../../uploads/'.htmlspecialchars($post->image)?>" alt="">
        </div>
        <div class="col-lg-12">
          <h2><?php echo htmlspecialchars($post->title)?></h2>
         
          
          <p><?php echo ($post->content)?></p>
        </div>
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