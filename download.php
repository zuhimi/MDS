<?php
include "conn/conn.php";
error_reporting(2);
session_start();
if (empty($_SESSION['user_id']) AND empty($_SESSION['password']))
{
  header('location:index.php');
}
else
{
	
function output_file($file, $name, $mime_type='')
{
 if(!is_readable($file)) die('File not found or inaccessible!');
 $size = filesize($file);
 $name = rawurldecode($name);
 $known_mime_types=array(
    "htm" => "text/html",
    "exe" => "application/octet-stream",
    "zip" => "application/zip",
    "doc" => "application/msword",
    "jpg" => "image/jpg",
    "php" => "text/plain",
    "xls" => "application/vnd.ms-excel",
    "ppt" => "application/vnd.ms-powerpoint",
    "gif" => "image/gif",
    "pdf" => "application/pdf",
    "txt" => "text/plain",
    "html"=> "text/html",
    "png" => "image/png",
    "jpeg"=> "image/jpg"
 );
 
 if($mime_type==''){
     $file_extension = strtolower(substr(strrchr($file,"."),1));
     if(array_key_exists($file_extension, $known_mime_types)){
        $mime_type=$known_mime_types[$file_extension];
     } else {
        $mime_type="application/force-download";
     };
 };
 
 //turn off output buffering to decrease cpu usage
 @ob_end_clean(); 
 
 // required for IE, otherwise Content-Disposition may be ignored
 if(ini_get('zlib.output_compression'))
 ini_set('zlib.output_compression', 'Off');
 header('Content-Type: ' . $mime_type);
 header('Content-Disposition: attachment; filename="'.$name.'"');
 header("Content-Transfer-Encoding: binary");
 header('Accept-Ranges: bytes');
 
 
 
 // multipart-download and download resuming support
 if(isset($_SERVER['HTTP_RANGE']))
 {
    list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
    list($range) = explode(",",$range,2);
    list($range, $range_end) = explode("-", $range);
    $range=intval($range);
    if(!$range_end) {
        $range_end=$size-1;
    } else {
        $range_end=intval($range_end);
    }

    $new_length = $range_end-$range+1;
    header("HTTP/1.1 206 Partial Content");
    header("Content-Length: $new_length");
    header("Content-Range: bytes $range-$range_end/$size");
 } else {
    $new_length=$size;
    header("Content-Length: ".$size);
 }
 
 
 /* Will output the file itself */
 $chunksize = 1*(1024*1024); 
 $bytes_send = 0;
 if ($file = fopen($file, 'r'))
 {
    if(isset($_SERVER['HTTP_RANGE']))
    fseek($file, $range);
 
    while(!feof($file) && 
        (!connection_aborted()) && 
        ($bytes_send<$new_length)
          )
    {
        $buffer = fread($file, $chunksize);
        echo($buffer); 
        flush();
        $bytes_send += strlen($buffer);
    }
 fclose($file);
 } else
 //If no permissiion
 die('Error - can not open file.');
 
 
 
	
 //die
//die();
}
//Set the time out
set_time_limit(0);

//decryption process

function decryptFileAES256($inputFile, $outputFile, $key, $iv) {
		// Make sure the key length is 32 bytes (256 bits)
		$key = hash('sha256', $key, true);

		// Make sure the IV length is 16 bytes (128 bits)
		$iv = substr(hash('sha256', $iv, true), 0, 16);

		// Read the file content
		$data = file_get_contents($inputFile);

		// Decrypt the data using AES-256-CBC
		$decrypted = openssl_decrypt($data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

		// Write the decrypted data to the output file
		file_put_contents($outputFile, $decrypted);
}

//get file id

$sql = mysqli_query($conn, "SELECT * FROM file WHERE file_id = '$_GET[file_id]'");
$row = mysqli_fetch_array($sql);
$encryptedFilePath = "uploads/" . $row['file'];

// Set the decrypted file path
$trimmedFileName = str_replace("encrypted_", '', $row['file']);
$decryptedFileName = 'decrypted_' . $trimmedFileName;
$decryptedFilePath = 'temp/' . $decryptedFileName;
//$decryptedFilePath = 'temp/decrypted_' . basename($encryptedFilePath);

// Specify the key and IV used for encryption
$key = '_jS%DDFK%5^?7u&';
$iv = 'sample_iv_value';

// Decrypt the file
decryptFileAES256($encryptedFilePath, $decryptedFilePath, $key, $iv);


//code asal
$file_path = $decryptedFilePath;
$title = $row['title'];
$extension = $row['extension'];
//$output_name = $title . "." . $extension;
$output_name = $decryptedFileName;
//Call the download function with file path,file name and file type
output_file($file_path, ''.$output_name.'', 'text/plain');

unlink($decryptedFilePath);

ignore_user_abort(true);
}
?>