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
				
					//get file id and file name
					$file_id = $_GET['file_id'];
					$title = $_GET['title'];
					
				?>
              <div class="card">
                <div class="card-body">
				   <h4 class="card-title text-success">File's Result Details</h4>
					<small class="card-description text-muted">
                      <i class="mdi mdi-lock"></i> Result Details for File <?php echo $title; ?>
                    </small>
					<hr />
					
					<div class="row">
						<?php
						
						//decrypt function
						function decryptFileAES256($inputFile, $outputFile, $key, $iv) {
							// Increase memory limit
							ini_set('memory_limit', '512M');

							// Make sure the key length is 32 bytes (256 bits)
							$key = hash('sha256', $key, true);

							// Make sure the IV length is 16 bytes (128 bits)
							$iv = substr(hash('sha256', $iv, true), 0, 16);

							// Read the file content as binary data
							$data = file_get_contents($inputFile, FILE_BINARY);

							if ($data === false) {
								die("Failed to read input file");
							}

							// Decrypt the data using AES-256-CBC
							$decrypted = openssl_decrypt($data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

							if ($decrypted === false) {
								die("Decryption failed");
							}

							// Write the decrypted data to the output file
							$result = file_put_contents($outputFile, $decrypted, LOCK_EX);

							if ($result === false) {
								die("Failed to write decrypted data to output file");
							}
						}
						
						$sql = mysqli_query($conn, "SELECT * FROM file WHERE file_id = '$file_id'");
						$row = mysqli_fetch_array($sql);
						$encryptedFilePath = "uploads/" . $row['file'];

						// Set the decrypted file path
						$trimmedFileName = str_replace("encrypted_", '', $row['file']);
						$decryptedFileName = 'decrypted_' . $trimmedFileName;
						$decryptedFilePath = 'temp/' . $decryptedFileName;

						// Specify the key and IV used for encryption
						$key = '_jS%DDFK%5^?7u&';
						$iv = 'sample_iv_value';

						// Decrypt the file
						decryptFileAES256($encryptedFilePath, $decryptedFilePath, $key, $iv);
						
						/* apply back malware scanning function using virustotal api to get the full result details */
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

						$filePath = $decryptedFilePath;
						// Scan the file
						$scanResult = scanFile($filePath, $apiKey);

						if ($scanResult['response_code'] == 1) {
								// If the file was successfully uploaded and scanned
								$resource = $scanResult['resource'];

								// Retrieve the scan report
								$report = getScanReport($resource, $apiKey);
								
								// Output the report
								echo "<pre class='text-white'>";
								print_r($report);
								echo "</pre>";
								
						} else {
								echo "Failed to scan file. Error: " . $scanResult['verbose_msg'] . "\n";
						}
						
						// Output the result based on the scan report
						if ($report['response_code'] == 1) {
							// If the file was successfully scanned
							$positives = $report['positives'];
							if ($positives == 0) {
								echo "<small>File is <b class='text-success'>safe!</b> No antivirus engines detected it as malicious.</small>";
							} else {
								echo "<small>File detected as <b class='text-danger'>malicious</b> by $positives out of {$report['total']} antivirus engines.</small>";
							}
						} else {
							echo "Failed to retrieve scan report. Error: " . $report['verbose_msg'];
						}
						/* end of malware scanning function using virustotal api */

					?>
					</div>
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