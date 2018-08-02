<?php 
require 'database.php';

if(isset($_POST['postcomment'])){
 


  $comment = $_POST['comment'];
  $id = $_POST ['id'];

  $comment = $mysql->real_escape_string($comment);

  $comment = filter_var($comment, FILTER_SANITIZE_MAGIC_QUOTES);


  $query = "insert into comment (comment, post_id) values ('$comment', '$id')";

  $mysql->query($query);

  $query = "update post set total_comments = total_comments + 1 where id = '$id'";

  $mysql->query($query);

  header('Location:./single-post.php?id='.$id);
  exit;

}