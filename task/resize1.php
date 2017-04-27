<?php
  define("TITLE", "Task");
  $my_name  = "Shri Shruthi";
  
  if (isset ($_GET['ref'])) {
    $ref = $_GET['ref'];
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>PHP <?php echo TITLE; ?></title>
    <link href="../assets/styles.css" rel="stylesheet">
    <script type="text/javascript" src="../assets/syntaxhighlighter/scripts/shCore.js"></script>
    <script type="text/javascript" src="../assets/syntaxhighlighter/scripts/shBrushPhp.js"></script>
    <link type="text/css" rel="stylesheet" href="../assets/syntaxhighlighter/styles/shCoreDefault.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css">
      <script src="https://use.fontawesome.com/7fe139a1a7.js"></script>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/main.css">
      <link rel="stylesheet" href="css/animate.css">

    <script type="text/javascript">SyntaxHighlighter.all();</script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    <script>
    function setfilename(val)
    {
      var fileName = val.substr(val.lastIndexOf("\\")+1, val.length);
      document.getElementById("filename").value = fileName;
    }
    </script>
  
  </head>
  
  <body>
    <div class="wrapper">
      <header>
        <?php include('includes/header.php'); ?>
      </header>
      
      
      <h1><small><?php echo TITLE; ?></small></h1>
      
      <img src="../assets/img/hr.png" alt="PHP">
      <br>
      <br>
      
      <div class="sandbox"> 

        <section>

<form action method="post" enctype="multipart/form-data">
    <div>
    <div>
      <label>Upload Image</label>
    </div>
    <div>
      <input type="file" name="image" onchange="setfilename(this.value);"/>
    </div>
    <br>
    <div>
      <label>Image Name</label>
    </div>
    <div>
      <input type="text" name="imagename" id="filename">
    </div>
    <br>
    <div>
      <center><input type="submit" value="Upload" /></center>
    </div>
</form>


<?php
$username = "root";
$password = "";
$hostname = "localhost"; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$ID = isset($_POST['image']) ? $_POST['image'] : false;
//connection to the database
$dbhandle = mysql_connect($hostname, $username);
if (!$dbhandle)
  {
  die('Could not connect: ' . mysql_error());
  }
  mysql_select_db("saga", $dbhandle);

//directory creation
     $desired_dir="img";
if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);  } 

                     $desired_dir1="img1";
if(is_dir($desired_dir1)==false){
                mkdir("$desired_dir1", 0700);  } 
                 $desired_dir2="imgorg";
if(is_dir($desired_dir2)==false){
                mkdir("$desired_dir2", 0700);  }

if( ! is_uploaded_file($_FILES['image']['tmp_name']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK)
{
    exit('File not uploaded. Possibly too large.');
}
// Create image from file
switch(strtolower($_FILES['image']['type']))
{
    case 'image/jpeg':
        $image = imagecreatefromjpeg($_FILES['image']['tmp_name']);
        break;
    case 'image/png':
        $image = imagecreatefrompng($_FILES['image']['tmp_name']);
        break;
    case 'image/gif':
        $image = imagecreatefromgif($_FILES['image']['tmp_name']);
        break;
    default:
        exit('Unsupported type: '.$_FILES['image']['type']);
}
// Target dimensions
$max_width = 300;
$max_height = 250;

// Get current dimensions
$old_width  = imagesx($image);
$old_height = imagesy($image);

if($old_width>$max_width || $old_height>$max_height)
{
  $scale=min($max_height/$old_height,$max_width/$old_width);
  $new_width1  = ceil($scale*$old_width);
  $new_height1 = ceil($scale*$old_height); 


  #for images with height underflow
  if($old_width<=$old_height)
  {
    $scale1 = $max_width/$old_width;
    $scale2 = $max_height/$old_height;

    // Get the new dimensions
    $new_width  = ceil($scale1*$old_width);
    $new_height = ceil($scale2*$old_height);
    
    // Create new empty image
    $new = imagecreatetruecolor($new_width, $new_height);

    $new1 = imagecreatetruecolor($new_width1, $new_height1);

    // Resize old image into new
    imagecopyresampled($new, $image, 
    0, 0, 0, 0, 
    $new_width, $new_height, $old_width, $old_height);
    imagecopyresampled($new1, $image, 
    0, 0, 0, 0, 
    $new_width1, $new_height1, $old_width, $old_height);
    include 'blur.php';
    $w = imagesx($new1);
    imagecopy($new, $new1, 50, 0, 0, 0, $w, 250); 
    

    $ext= ".jpeg";
    $imagename=date("d-m-Y")."-".time().$ext;
    $target_path = "img/".$imagename;
    imagejpeg($new,$target_path, 90);



    //insertion
    $query_upload="INSERT into images1 (path) VALUES ('".$target_path."')";

    mysql_query($query_upload) or die("error in $query_upload == ----> ".mysql_error()); 


    include ("displaytrail.php");  

  }

  #for images with width overflow
  else
  {
    $scale=max($max_height/$old_height,$max_width/$old_width);
    $new_width1  = ceil($scale*$old_width);
    $new_height1 = ceil($scale*$old_height); 
    
    $new1 = imagecreatetruecolor($new_width1, $new_height1);
    imagecopyresampled($new1, $image, 
    0, 0, 0, 0, 
    $new_width1, $new_height1, $old_width, $old_height);

    $ext= ".jpeg";
    $imagename=date("d-m-Y")."-".time().$ext;
    $target_path = "imgorg/".$imagename;
    imagejpeg($new1,$target_path, 90);
    $query_upload="INSERT into images1 (path_org) VALUES ('".$target_path."')";

    mysql_query($query_upload) or die("error in $query_upload == ----> ".mysql_error()); 
    include ("i.php");
  }
  
}
else
{
// Calculate the scaling we need to do to fit the image inside our frame
$scale1 = $max_width/$old_width;
$scale2 = $max_height/$old_height;
$scale=min($max_height/$old_height,$max_width/$old_width);

// Get the new dimensions
$new_width  = ceil($scale1*$old_width);
$new_height = ceil($scale2*$old_height);

$new_width1  = ceil($scale*$old_width);
$new_height1 = ceil($scale*$old_height);
// Create new empty image
$new = imagecreatetruecolor($new_width, $new_height);

$new1 = imagecreatetruecolor($new_width1, $new_height1);

// Resize old image into new
imagecopyresampled($new, $image, 
    0, 0, 0, 0, 
    $new_width, $new_height, $old_width, $old_height);
imagecopyresampled($new1, $image, 
    0, 0, 0, 0, 
    $new_width1, $new_height1, $old_width, $old_height);
include 'blur.php';

$w = imagesx($new1); 
$h = imagesy($new1);

if($h==250)
{
imagecopy($new, $new1, 50, 0, 0, 0, $w, 250);

}
elseif($w==300) 
{
imagecopy($new, $new1, 0, 22, 0, 0, 300, $h);

}

// Catch the imagedata
  $ext= ".jpeg";
  $imagename=date("d-m-Y")."-".time().$ext;
  $target_path = "img/".$imagename;
imagejpeg($new,$target_path, 90);



//insertion
  $query_upload="INSERT into images1 (path) VALUES ('".$target_path."')";

  mysql_query($query_upload) or die("error in $query_upload == ----> ".mysql_error()); 


include ("displaytrail.php");
}
mysql_close($dbhandle);
}
  ?>


</section>

      </div><!-- end sandbox -->

      <br>
      <br>
      <img src="../assets/img/hr.png" alt="PHP">
      <br>
      <br>

      <footer>
        <?php include('includes/footer.php'); ?>
      </footer>
      
    </div><!-- end wrapper -->
    
  </body>
</html>
