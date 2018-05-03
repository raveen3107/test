<?php
// Initialize the session
require_once 'config.php';
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    
    
     
    
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. Welcome to our site.</h1>
         
    </div>
    <p><a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a></p>
    
    
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="file" name="photo" required>
   <input type="submit" name="submit_image" value="Upload">
    </form>
    
    <?php
 require_once 'config.php';
  //    $msg = "";
 if (isset($_POST['submit_image'])) {

     $image = $_FILES['photo']['name'];
   // $image_text = mysqli_real_escape_string($link, $_POST['image_text']);
       
       
     $username=$_SESSION['username'];
     
    $target = "images/".basename($image);
    $sql = "INSERT INTO image (image,username) VALUES ('$image','$username')";
    mysqli_query($link, $sql);
  //function my_flush() {
    if(move_uploaded_file($_FILES['photo']['tmp_name'],$target)) 
{ 
      header('Location: welcome.php');
    $msg = "Image uploaded successfully";
    
}
 else {
    $msg = "Failed to upload image";
}
 }
   // $target = "images/"; 
    //$target = $target . basename( $_FILES['photo']['name']); 
    //$sql = "INSERT INTO image_table (image, image_text) VALUES ('$image', '$image_text')";
   // mysqli_query($link, $sql);
    
   // if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
  //		$msg = "Image uploaded successfully";
  //	}else{
  //		$msg = "Failed to upload image";
  //	}
    
// }

//$target = "images/"; 
//$target = $target . basename( $_FILES['photo']['name']); 
//$sql = "INSERT INTO images (image, image_text) VALUES ('$image', '$image_text')";
//if(move_uploaded_file($_FILES['photo']['tmp_name'],$target)) 
//{ 
  //  echo "sucess";
    
//}
 
?>
    
    <?php
     if(!$_SESSION['username']==NULL)
     {
              
     $username=$_SESSION['username'];
     $result = mysqli_query($link, "SELECT * FROM image  where username='$username'");
    
    while ($row = mysqli_fetch_array($result)) {
        
        
        
     
      	echo "<img class='px-2 mt-2' height='150' width='150' src='images/".$row['image']."' >";
            
         // echo "<p>".$row['username']."</p>";
         
            
     
     
    }
  
    exit();
    //$old_submit = $_GET['submit']; // this gets the submit variable you appended in your form
//$current_url = 'samepage.php'
//if ($old_submit == "true") {
//header("Location: $current_url");
//$old_submit = "false";
//}
    
      
    
     }
    
  ?>

    

</body>

</html>

