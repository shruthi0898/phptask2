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
        <center><h4>Cropped Image</h4></center>

              <?php
if(isset($_POST['crop_image']))
{
  $y1=$_POST['top'];

  $x1=$_POST['left'];

  $w=$_POST['right'];

  $h=$_POST['bottom'];
 
 $con = mysql_connect('localhost', 'root'); 
                if (!$con) { die('Could not connect: ' . mysql_error()); } 
                mysql_select_db("saga", $con); 
                $result = mysql_query("SELECT id,path_org FROM images1 where id= (select max(id) from images1)"); 
               
                $row = mysql_fetch_array($result);
                
  $i=$row[0];
  $image = $row[1];

  list( $width,$height ) = getimagesize( $image );

  $thumb = imagecreatetruecolor( $width, $height );
  $source = imagecreatefromjpeg($image);

  imagecopyresized($thumb, $source, 0, 0, 0, 0, $width, $height, $width, $height);
  imagejpeg($thumb,$image,90); 


  $im = imagecreatefromjpeg($image);
  $dest = imagecreatetruecolor($w,$h);
  
  imagecopyresampled($dest,$im,0,0,$x1,$y1,$w,$h,$w,$h);

  $ext= ".jpeg";
  $imagename=date("d-m-Y")."-".time().$ext;
  $target_path = "img/".$imagename;



  imagejpeg($dest,$target_path, 100);
//insertion
  $query_upload="UPDATE images1 set path = '".$target_path."' where id = '".$i."' ";

  mysql_query($query_upload) or die("error in $query_upload == ----> ".mysql_error());

  $result = mysql_query("SELECT path FROM images1 where id= (select max(id) from images1)"); 
  echo "<table >";
  $row = mysql_fetch_array($result);
  echo "<tr>";
  echo "<td><img src='".$row[0]."'></td>";
  echo "</tr>"; 
  echo "</table>";

  mysql_close($con);
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