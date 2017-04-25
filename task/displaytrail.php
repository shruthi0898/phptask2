<?php
                $con = mysql_connect('localhost', 'root'); 
                if (!$con) { die('Could not connect: ' . mysql_error()); } 
                mysql_select_db("saga", $con); 
                $result = mysql_query("SELECT path FROM images1 where id=LAST_INSERT_ID()"); 
                echo "<table >";
                
                $row = mysql_fetch_array($result);
                    echo "<tr>";
                    echo "<td><img src='".$row[0]."'></td>";
                    echo "</tr>"; 
                echo "</table>";
                mysql_close($con);
?>            