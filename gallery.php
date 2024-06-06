<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

$bucketName = 'your-s3-bucket-name';
$region = 'your-region';
$accessKey = 'your-access-key';
$secretKey = 'your-secret-key';

$s3Client = new S3Client([
    'region'  => $region,
    'version' => 'latest',
    'credentials' => [
        'key'    => $accessKey,
        'secret' => $secretKey,
    ],
]);

try {
    $objects = $s3Client->listObjectsV2([
        'Bucket' => $bucketName,
    ]);

    echo "<h1>Gallery</h1>";
    echo "<a href=\"index.php\">Upload Another Picture</a><br><br>";

    if ($objects['KeyCount'] > 0) {
        foreach ($objects['Contents'] as $object) {
            $objectUrl = $s3Client->getObjectUrl($bucketName, $object['Key']);
            echo "<img src=\"$objectUrl\" width=\"300\" style=\"margin: 10px;\">";
        }
    } else {
        echo "No pictures found.";
    }
} catch (AwsException $e) {
    echo "Error fetching gallery: " . $e->getMessage();
}
?>
