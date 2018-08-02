<?php 
require "header.php"; 
require 'database.php';

$query = "select * from post";

$result = $mysql->query($query);


if ($result->num_rows < 1) {

  $posts = array();

} else {

  while ($row = $result->fetch_object()) {

    $posts[] = $row;
    
  }

}


?>



    <!-- Page Content -->
    <div class="container">


      
      
      <!-- Features Section -->
      <div class="row" style="margin-top:20px; margin-bottom: 100px">

      
 <?php foreach( $posts as $post):?>
     <div class="col-lg-3 col-sm-6 portfolio-item">
          <div class="card ">
            <a href="./single-post.php?id=<?php echo htmlspecialchars($post->id)?>"><img class="card-img-top" height="150px" width="300px" src="<?php echo './uploads/'.htmlspecialchars($post->image)?>" alt=""></a>
            <div class="card-body">
              <h4 class="card-title"  style="font-size: 14px; line-height: 1.2">
                <a href="./single-post.php?id=<?php echo htmlspecialchars($post->id)?>"><?php echo htmlspecialchars($post->title)?></a>
              </h4>
               <div class="row" style="color:blue">
              <div style="font-size: 10px" class="col-lg-3"><span class="fa fa-thumbs-up green"> <?php echo htmlspecialchars($post->total_likes)?></span> </div>
              <div style="font-size: 10px" class="col-lg-3"><span class="fa fa-thumbs-down green"> <?php echo htmlspecialchars($post->total_dislikes)?></span> </div>
              <div style="font-size: 10px"class="col-lg-3"><span class="fa fa-comments green"> <?php echo htmlspecialchars($post->total_comments)?></span> </div>
              <div style="font-size: 10px"class="col-lg-3"><span class="fa fa-eye green"> <?php echo htmlspecialchars($post->total_views)?></span> </div>
            </div>
            </div>
          </div>
        </div>
  <?php endforeach;?>
        </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="bg_green" style="padding-top: 20px ; padding-bottom: 20px;">
      <div class="container-fluid">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
