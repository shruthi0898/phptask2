<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="crop_style.css">
  <script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript" src="jquery-ui.js"></script>
</head>

<body>

<p>1.</p>
<div id="crop_wrapper2">
<?php
                $con = mysql_connect('localhost', 'root'); 
                if (!$con) { die('Could not connect: ' . mysql_error()); } 
                mysql_select_db("saga", $con); 
                $result = mysql_query("SELECT path_org FROM images1 where id=LAST_INSERT_ID()"); 
                
                $row = mysql_fetch_array($result);
                    echo "<img src='".$row[0]."'/>";
                mysql_close($con);
?>  
</div>

<p>2.</p>
<div id="crop_wrapper">
<?php
                $con = mysql_connect('localhost', 'root'); 
                if (!$con) { die('Could not connect: ' . mysql_error()); } 
                mysql_select_db("saga", $con); 
                $result = mysql_query("SELECT path_org1 FROM images1 where id=LAST_INSERT_ID()"); 
                
                $row = mysql_fetch_array($result);
                    echo "<img src='".$row[0]."'/>";
                mysql_close($con);
?>  
</div>

<br><br>

<form method="post" action="selectimg1.php" onsubmit="return crop();">
  <p>Select the image that you would like to choose?</p>
    <input type="radio" name="option" value="1" checked> 1. <br>
    <input type="radio" name="option" value="2"> 2. <br>
  <center><input type="submit" name="s_image"></center>
</form>

</body>
</html>