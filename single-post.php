<?php 
require "header.php"; 
require 'database.php';


if(!isset($_GET['id'])){
  header('Location: ./index.php');
}

$postid = $_GET['id'];

$postid = $mysql->real_escape_string($postid);

$postid = filter_var($postid, FILTER_SANITIZE_MAGIC_QUOTES);

$query = "update post set total_views = total_views + 1 where id = '$postid'";



$mysql->query($query);

$query = "select * from post where id='$postid'";

$result = $mysql->query($query);


if ($result->num_rows < 1) {

  header('Location: ./index.php');

} else {

 $post = $result->fetch_object();

}
if(isset($_GET['like'])){

  $query = "update post set total_likes=total_likes + 1 where id='$postid'";
  $mysql->query($query);

}


if(isset($_GET['dislike'])){

  $query = "update post set total_dislikes=total_dislikes + 1 where id='$postid'";
  $mysql->query($query);

}

$query = "select * from comment where post_id = '$postid'";
$result = $mysql-> query($query);
if ($result->num_rows < 1) {
  $comments = [];
}else{
  while ($row = $result->fetch_object()) {
    $comments[] = $row;
  }
}




?>



    <!-- Page Content -->
    <div class="container">


      
      
      <!-- Features Section -->
      <div class="row" style="margin-top:20px; margin-bottom: 100px">
        <div class="col-lg-12" style="text-align: center; margin-bottom: 20px">
          <img class="img-fluid rounded" src="<?php echo './uploads/'.htmlspecialchars($post->image)?>" alt="">
        </div>
        <div class="col-lg-12">
          <h2><?php echo htmlspecialchars($post->title)?></h2>
         
          
          <p><?php echo ($post->content)?></p>
        </div>
        
      </div>
      <!-- /.row -->



    </div>
    <!-- /.container -->
        
      <!-- /.row -->

     <div class="container"> 
      <div class="row">
          <div class="col-lg-6" >
            <a href="<?php echo $_SERVER['PHP_SELF'] ?>?like=1&id=<?php echo htmlspecialchars($post->id)?>" class="pull-right"><span class="fa fa-thumbs-up green"></span> </a> <?php echo htmlspecialchars($post->total_likes)?>

              <a href="<?php echo $_SERVER['PHP_SELF'] ?>?dislike=1&id=<?php echo htmlspecialchars($post->id)?>"style="margin-left: 20px" ><span  class="fa fa-thumbs-down green"></span> </a> <?php echo htmlspecialchars($post->total_dislikes)?>

               <a href="<?php echo $_SERVER['PHP_SELF'] ?>?dislike=1&id=<?php echo htmlspecialchars($post->id)?>"style="margin-left: 20px" ><span class="fa fa-comments green"></span> </a> <?php echo htmlspecialchars($post->total_comments)?>

          </div>
          <br><br>
          <div class="col-lg-12">
            <form action="./add_comment.php" method="post">
              <input type="hidden" name="id" value="<?php echo htmlspecialchars($post->id)?>">
              <textarea name="comment" id="comment"  class="form-control col-lg-6"></textarea>
               <br>
              <button " class="btn btn-success pull-right bg_green" name="postcomment" type="submit">Post</button>
            </form>
          </div>

          <hr>
          <div class="col-lg-12" style="margin-top: 20px">
           <?php if( sizeof( $comments ) > 0):?>
               <?php foreach( $comments as $comment):?>
        
                <div class="alert alert-dark col-lg-6" role="alert">
                  <?php echo htmlspecialchars($comment->comment)?>
                </div>
              <?php endforeach;?>
           <?php endif;?>
          </div>
      </div>
    </div>
</div>

     

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="bg_green" style="padding-top: 20px ;padding-bottom: 20px;">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
