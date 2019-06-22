<?php
    require_once('db_connect.php'); //connect to database
    $query = "select * from users";
    $result = mysqli_query($link,$query);
?>
<html>  
	<head>
        <title>Credit Management</title>
<style>	

.Back
{
	background-image:url('logo_small.jpg');
	background-size:100% 110%;
	width:100%;
	height:100%;
	
}	
.container
{
	
	background-color:rgba(256,256,256,0.5);
	position:absolute;
	top:30%;
	left:20%;
	width:60%;
	height:50%;
}
.text
{ 
	
	position:absolute;
	width:99%;
	height:90px;
}	 
.text h1
{  
	color:black;
	text-align:center;
	font-size:60px;
	font-family:'Montserrat',sans-serif;
	letter-spacing:3;
    margin-top:15px;
}	 

</style>
    </head>

    <body>
	<div class="Back">
	<div class="text"><h1>CREDIT MANAGEMENT</h1></div>
	<div class="container">
  

        <table width="100%" border="0px" cellspacing="0px" cellpadding="5px">
			<thead>
				<tr>
                    <th>S No.</th>
    				<th>Name</th>
    				<th>Email</th>
    				<th>Credits</th>
				</tr>
			</thead>

            <!--fetch and display data from MySQL-->
            <?php
                $i=1;
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["credit"] . "</td>";
                    echo "<td><a href=transfer.php?name=" . $row['name'] . ">Select</a><td>";
                    echo "</tr>";
                    ++$i;
                }
            ?>

        </table>
		</div>
    </div>
	</body>
</html>