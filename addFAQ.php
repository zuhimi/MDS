<?php
include "conn/conn.php";
error_reporting(0);
session_start();
if (empty($_SESSION['user_id']) AND empty($_SESSION['password']))
{
  header('location:index.php');
}
else
{
	$question = htmlspecialchars($_POST['question'], ENT_QUOTES);
	$answer = htmlspecialchars($_POST['answer'], ENT_QUOTES);
						
	$sql = mysqli_query($conn, "INSERT INTO faq (question, answer) VALUES ('$question', '$answer')");
											
																	
	header('location:setting_faq.php');
}

?>