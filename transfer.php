<?php
    require_once('db_connect.php'); //connect to database
    $name = $_GET['name'];
    $query = "select * from users where name='" . $name . "'";
    $result = mysqli_query($link,$query);
    $row = mysqli_fetch_array($result);
    
    $query = "select name from users where name<>'" . $row['name'] . "'";
    $result = mysqli_query($link,$query);
    if(isset($_POST['transfer'])) {
        if($_POST['credits_tr'] > $row['credit']) {
            echo "Credits transferred cannot be more than " . $row['credit'] . "<br>";
        }
        else {
            $query = "update users set credit=credit-" . $_POST['credits_tr'] . " where name='" . $row['name'] . "'";
            mysqli_query($link,$query);
            $query = "update users set credit=credit+" . $_POST['credits_tr'] . " where name='" . $_POST['to_user'] . "'";
            mysqli_query($link,$query);
            $query = "insert into transfers values('" . $row['name'] . "','" . $_POST['to_user'] . "'," . $_POST['credits_tr'] . ")";
            mysqli_query($link,$query);
            header("Location: index.php");
        }
    }
?>

<html>
	<head>
        <title>Transfer Credits</title>
<style>		
.Back
{
	background-image:url('logo_small.jpg');
	background-size:100% 110%;
	width:100%;
	height:100%;
	
}
#b1
{
	background-color:black;
    color:white;
	font-weight:bold;
    padding: 12px 24px;
    border: none;
    cursor: pointer;
    text-align: center;
    border-radius:12px;
    margin-left:15px;
	}
#b1:hover
{
color:black;	
background-color:white;
}
</style>
    </head>
 
    <body>
 <div class="Back"> 
 <a href="index.php">&lt; Back</a>
        <br><br>
        Hello <?php echo $row['name'] ?>,
        <br>
        Your credits are: <?php echo $row['credit'] ?>
        <br><br>

        <form action="#" method="post">
            <fieldset>
                <legend>Transfer details</legend>
                Credits: <input type="number" name="credits_tr" min =0 value=1 required>
                <br><br>
                Transfer to: <select name="to_user" required>
                    <option value =""></option>

                <?php
                        while($tname = mysqli_fetch_array($result)) {
                            echo "<option value='" . $tname['name'] . "'>" . $tname['name'] . "</option>";
                        }
                ?>

                </select>
                <br>
            </fieldset>
            <br>
            <input id="b1" type="submit" name="transfer" value="Transfer">
        </form>
		</div>
    </body>
</html>