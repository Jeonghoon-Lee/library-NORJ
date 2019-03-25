<?php
  include('config.php');
  include('functions.php');

  use Monolog\Logger;
  use Monolog\Handler\StreamHandler;
  
  // create a log channel
  $log = new Logger('upload_image');
  $log->pushHandler(new StreamHandler('book.log', Logger::DEBUG));

  $log->info('Upload image file');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file_name = '../public/img/' . $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];

    if (isset($_FILES['image'])) {
      $log->info('file is upload' . $file_name);
      move_uploaded_file($file_tmp, $file_name);

      // $date = array(
      //   'response' => 'OK'
      // );

      // header('Content-type: application/json');
      // echo json_encode( $data );
    }
  }
?>