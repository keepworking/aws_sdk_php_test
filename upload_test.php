<?php
require '../lib/aws/aws-autoloader.php';

// $s3 = new Aws\S3\S3Client([
//   'version' => 'lastest',
//   'region' => 'us-east-1'
// ]);


$s3Client = new Aws\S3\S3Client([
  'version'     => 'latest',
  'region'      => 'ap-northeast-2',
  'credentials' => [
    'key'    => '****************',
    'secret' => '****************',
  ],
]);

if($_FILES["file"] != null){
  try {
    $result = $s3Client->putObject([
      'Bucket' => '***********',
      'Key'    => $_FILES["file"]['name'],
      'Body'   => fopen($_FILES["file"]["tmp_name"],'r'),
      'ACL'    => 'public-read',
    ]);

    ?>
    <img src="<?=$result['ObjectURL'];?>">

    <?php
  } catch (Aws\S3\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
  }
}

?>


<form class="" action="upload_test.php" enctype="multipart/form-data" method="post">
  <input type="file" name="file" value="">
  <input type="submit" name="" value="">
</form>
