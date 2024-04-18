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
?>

<!DOCTYPE html>
<html lang="en">

<!-- head -->
<?php include "layout/head.php";?>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include "layout/top.php";?>
	
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
       <?php include "layout/menu.php";?>
	   
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            
            
            <div class="col-12 grid-margin">
			<?php
					if (isset($_POST['submit']))
					{
						/* AES file encryption technique */
						function encryptFileAES256($inputFile, $outputFile, $key, $iv) {
							// Make sure the key length is 32 bytes (256 bits)
							$key = hash('sha256', $key, true);

							// Make sure the IV length is 16 bytes (128 bits)
							$iv = substr(hash('sha256', $iv, true), 0, 16);

							// Read the file content
							$data = file_get_contents($inputFile);

							// Encrypt the data using AES-256-CBC
							$encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

							// Write the encrypted data to the output file
							file_put_contents($outputFile, $encrypted);
						}
						
						//post data
						$file_id = $_POST['file_id'];
						$upload_date = $_POST['upload_date'];
						$title = $_POST['title'];
						$uploader = $_SESSION['user_id'];
						
						/* apply malware scanning function using virustotal api */
						// Replace 'API_KEY' with actual VirusTotal API key 
						// incase provided api key reach limit, replace the new one here
						$apiKey = '830cbbc9acff2f17a016b7fd9b04e8ca34494757c798719e47e81220a5d96f67';

						// Function to scan a file using the VirusTotal API
						function scanFile($filePath, $apiKey) {
							$url = 'https://www.virustotal.com/vtapi/v2/file/scan';
							
							$postData = array(
								'apikey' => $apiKey,
								'file' => new CURLFile($filePath)
							);

							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, $url);
							curl_setopt($ch, CURLOPT_POST, true);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							$response = curl_exec($ch);
							curl_close($ch);

							return json_decode($response, true);
						}

						// Function to get the scan report from VirusTotal
						function getScanReport($resource, $apiKey) {
							$url = 'https://www.virustotal.com/vtapi/v2/file/report';
							$postData = array(
								'apikey' => $apiKey,
								'resource' => $resource
							);

							$options = array(
								'http' => array(
									'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
									'method'  => 'POST',
									'content' => http_build_query($postData)
								)
							);

							$context  = stream_context_create($options);
							$response = file_get_contents($url, false, $context);

							return json_decode($response, true);
						}
						$file = $_FILES['file'];

						// Check for errors during file upload
						if ($file['error'] === UPLOAD_ERR_OK) {
							$filePath = $file['tmp_name'];
							// Scan the file
							$scanResult = scanFile($filePath, $apiKey);

							if ($scanResult['response_code'] == 1) {
								// If the file was successfully uploaded and scanned
								$resource = $scanResult['resource'];

								// Retrieve the scan report
								$report = getScanReport($resource, $apiKey);
								
							} else {
								echo "Failed to scan file. Error: " . $scanResult['verbose_msg'] . "\n";
							}
						} else {
							echo "Error uploading file. Error code: " . $file['error'];
						}
						
						// Output the result based on the scan report
						if ($report['response_code'] == 1) {
							// If the file was successfully scanned
							$positives = $report['positives'];
							if ($positives == 0) {
								$status = "Safe";
							} else {
								$status = "Malware";
							}
						}
						/* end of malware scanning function using virustotal api */
						
						//upload file to directory using basic method
						$uploadDir = 'uploads/';
						$uploadedFile = $_FILES['file'];
						$originalFileName = $uploadedFile['name'];
						$uploadedFilePath = $uploadDir . $originalFileName;
						
						
						//file extension
						$extension = end((explode(".", $originalFileName)));

						// Move the uploaded file to the upload directory
						move_uploaded_file($uploadedFile['tmp_name'], $uploadedFilePath);

						// Encrypt the uploaded file
						$encryptedFileName = 'encrypted_' . $originalFileName;
						//$encryptedFilePath = $uploadDir . 'encrypted_' . $originalFileName;
						$encryptedFilePath = $uploadDir . $encryptedFileName;
						$key = '_jS%DDFK%5^?7u&';
						$iv = 'sample_iv_value';
						
						encryptFileAES256($uploadedFilePath, $encryptedFilePath, $key, $iv);
						
						//remove original file to secure the files
						unlink($uploadedFilePath);
						
						
						$upload = mysqli_query($conn, "INSERT INTO file (file_id,
																		upload_date,
																		title,
																		file,
																		extension,
																		uploader,
																		status)
															VALUES ('$file_id',
																	'$upload_date',
																	'$title',
																	'$encryptedFileName',
																	'$extension',
																	'$uploader',
																	'$status')");
						
						


						
						if($upload == true)
						{
							$title = "";
							
							echo "<div class='alert alert-success alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Thank you!</strong> File $file_name successfully uploaded.
										<a href='my_file.php'>View your file status here.</a>
									</div>";
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> error.
								</div>";
					}
					
					// function utk	generate unique id
					//$queryx_ = ;
					$queryx  = mysqli_query($conn, "SELECT * FROM file ORDER BY file_id desc LIMIT 1");
					$fetchx  = mysqli_fetch_array($queryx);

					if($fetchx[0]==NULL)
						$file_id = "FILES00001";
					else
					{
						$patterns 	  = array("/[123456789].*/",);
						$replacements = '';
						$x= preg_replace($patterns, $replacements, $fetchx[0]);
						$x_= explode($x, $fetchx[0]);
						$nolast		= implode("",$x_);

						$newlast	= $nolast + 1;
						$length		= strlen($x);
						$initlength = strlen($nolast);
						$newlength  = strlen($newlast);
						$last		= substr($fetchx[0], -1);
						$zero		= substr($fetchx[0], 0, $length);
						
						if($newlength > $initlength)
							$zero = substr($zero, 0, -1);

						$file_id  = $zero.$newlast;
					}
					
					date_default_timezone_set("Asia/Kuala_Lumpur");
					$today = date("Y-m-d");
					$title = "";

				?>
              <div class="card">
                <div class="card-body">
                  <p class="card-description text-success">
                      <i class="mdi mdi-folder"></i> Upload Your File<br />
					  <small class="text-muted">Fill in your file details.</small>
                  </p>
                  <hr />
                  <form method="post" enctype="multipart/form-data">
					<input type="hidden" id="file_id" class="form-control" name="file_id" value="<?php echo $file_id; ?>" readonly />
					
					
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Date</label>
								<input type="text" id="upload_date" class="form-control" placeholder="Sent Date" name="upload_date" value="<?php echo $today; ?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>File Title</label>
								<input type="text" id="title" class="form-control" placeholder="File Title" name="title" value="<?php echo $title; ?>" required />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>File</label>
								<input type="file" style="padding: 0.35rem 0.75rem;" id="file" class="form-control" placeholder="File" name="file" value="<?php echo $file; ?>" required />
							</div>
						</div>
					</div>
					
					
                    
                    
                    <br />
                    <button type="reset" class="btn btn-outline-dark"><i class="mdi mdi-refresh"></i> Reset</button>
					<button type="submit" name="submit" class="btn btn-success mr-2"><i class="mdi mdi-cloud-upload"></i> Upload</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php include "layout/footer.php";?>
		
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <!-- SCRIPT -->
   <?php include "layout/script.php";?>
</body>

</html>
<?php
}
?>