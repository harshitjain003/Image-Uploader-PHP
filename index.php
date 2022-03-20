<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Image Uploader By Harshit Jain</title>
  </head>
  <body>
<?php
 $con = mysqli_connect('localhost','root','','image_upload');//Connection to Database
 if (!$con){
     echo"Failed to connect to Database";
 }
$sql = "SELECT * From images";

$get = mysqli_query($con,$sql);




?>
  <div class="container">
      <nav>
          <h1 class="text-center m-3">Image Uploader in PHP By Harshit Jain </h1>
      </nav>
      <div class="row justify-content-center mt-4">
          <div class="col-4">
              
          <form method="post" enctype="multipart/form-data">
              <input type="file" name="image" class="form-control" value="">
              <button class="btn btn-primary btn-sm mt-3" type="submit" name="upload">Upload Image</button>
          </form>
          </div>

          <table class="table table-bordered mt-3">
  <thead>
    <tr>
      <th scope="col"colspan="2">Id</th>
      <th scope="col">Images</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if( mysqli_num_rows( $get )==0 ){
        echo '<tr><td colspan="4">No Rows Returned</td></tr>';
      }else{
        while( $row = mysqli_fetch_assoc($get) ){
            echo '<tr>';
            echo '<th colspan="2" scope="row">'.$row['id'];'</td>';
            echo '<td><img class="rounded img-thumbnail img-fluid" src= "images/'.$row['image'].'" width = "20%">'.'</td>';
          echo '</tr>';
          echo '<br>';
    
        }
      }
    
    ?>
  </tbody>
</table>
      </div>
      



  </div>

  <?php
 
  //Function to upload file to foder and store image name in databse
  if(isset($_POST['upload'])){
      $file_name = $_FILES['image']['name'];
      $sql = "INSERT INTO `images` (`image`) VALUES ('$file_name');";
      $command = mysqli_query($con,$sql); 
    $file_tmp_name = $_FILES["image"]["tmp_name"];
      $destination = 'images/'.$file_name;
      move_uploaded_file($file_tmp_name,$destination);
      echo '
      <script>
      alert("Image Successfully Uploaded")
      </script>
      ';
      header('location:index.php');
  }
  
  ?>







    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>