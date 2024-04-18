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
	$faq_id = $_POST['faq_id'];
	$question = htmlspecialchars($_POST['question'], ENT_QUOTES);
	$answer = htmlspecialchars($_POST['answer'], ENT_QUOTES);
						
	$sql = mysqli_query($conn, "UPDATE faq SET question = '$question',
												answer = '$answer'
												WHERE faq_id = '$faq_id'");
											
																	
	header('location:setting_faq.php');
}

?>