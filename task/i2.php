<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="crop_style.css">
  <script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript" src="jquery-ui.js"></script>
  <script type="text/javascript">

    $(function() {
      $( "#crop_div1" ).draggable({ containment: "parent" });
    });
   
    function crop()
    {
      var posi = document.getElementById('crop_div1');
      document.getElementById("top").value=posi.offsetTop;
      document.getElementById("left").value=posi.offsetLeft;
      document.getElementById("right").value=posi.offsetWidth;
      document.getElementById("bottom").value=posi.offsetHeight;
      return true;
    }

  </script>
</head>

<body>

<div id="crop_wrapper2">
<?php
                $con = mysql_connect('localhost', 'root'); 
                if (!$con) { die('Could not connect: ' . mysql_error()); } 
                mysql_select_db("saga", $con); 
                $result = mysql_query("SELECT path_org FROM images1 where id=(select max(id) from images1)"); 
                
                $row = mysql_fetch_array($result);
                    echo "<img src='".$row[0]."'/>";
                mysql_close($con);
?>  
  <div id="crop_div1">

  </div>
</div>

<br><br>

<form method="post" action="do_crop2.php" onsubmit="return crop();">
  <input type="hidden" value="" id="top" name="top">
  <input type="hidden" value="" id="left" name="left">
  <input type="hidden" value="" id="right" name="right">
  <input type="hidden" value="" id="bottom" name="bottom">
  <center><input type="submit" name="crop_image"></center>
</form>

</body>
</html>