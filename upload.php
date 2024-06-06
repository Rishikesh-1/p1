<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

$bucketName = 'your-s3-bucket-name';
$region = 'your-region';
$accessKey = 'your-access-key';
$secretKey = 'your-secret-key';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['picture'])) {
    $file = $_FILES['picture'];
    
    if ($file['error'] === UPLOAD_ERR_OK) {
        $tmpName = $file['tmp_name'];
        $fileName = basename($file['name']);
        
        $s3Client = new S3Client([
            'region'  => $region,
            'version' => 'latest',
            'credentials' => [
                'key'    => $accessKey,
                'secret' => $secretKey,
            ],
        ]);
        
        try {
            $result = $s3Client->putObject([
                'Bucket' => $bucketName,
                'Key'    => $fileName,
                'SourceFile' => $tmpName,
                'ACL'    => 'public-read', // Make the file publicly accessible
            ]);
            echo "File uploaded successfully. <a href=\"gallery.php\">View Gallery</a>";
        } catch (AwsException $e) {
            echo "File upload failed: " . $e->getMessage();
        }
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "Invalid request.";
}
?>
