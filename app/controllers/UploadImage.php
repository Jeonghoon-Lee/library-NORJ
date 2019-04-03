<?php
// UploadImage.php
  class UploadImage {
    function book_image($f3) {
      // generate unique name
      $file_name = uniqid() . $_FILES['image']['name'];
      $tmp_name = $_FILES['image']['tmp_name'];

      // save the uploaded file.
      move_uploaded_file($tmp_name, 'public/img/' . $file_name);
      $response = array(
        'status' => 200,    // 200: OK 
        'message' => 'Success',
        'filename' => $file_name
      );
      http_response_code(200);

      // reply to client
      echo json_encode($response);
    }
  }
?>