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
  $newwidth = 600;
  $newheight = 400;

  $thumb = imagecreatetruecolor( $newwidth, $newheight );
  $source = imagecreatefromjpeg($image);

  imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
  imagejpeg($thumb,$image,100); 


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