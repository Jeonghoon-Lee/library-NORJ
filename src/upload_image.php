<?php
  include('config.php');
  include('functions.php');

  define('IMAGE_FOLDER', '../public/img/');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //
    // need to check admin permission
    //
    $response = '';
    if (isset($_FILES['image'])) {
      // generate unique name
      $file_name = IMAGE_FOLDER . uniqid() . $_FILES['image']['name'];
      $tmp_name = $_FILES['image']['tmp_name'];

      // save the uploaded file.
      move_uploaded_file($tmp_name, $file_name);
      $response = array(
        'status' => 200,    // 200: OK 
        'message' => 'Success',
        'filename' => $file_name
      );
      http_response_code(200);
    } else {
      $response = array(
        'status' => 400,    // 400: Bad Request 
        'message' => 'File not exist'
      );
      http_response_code(400);
    }
    // reply to client
    echo json_encode($response);
  } else {
    echo 'Bad request. Not allow to access server!';
  }
?>