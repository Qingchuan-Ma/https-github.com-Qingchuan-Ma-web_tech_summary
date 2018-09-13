<?php
header("Content-type:text/html;charset=utf-8");


$name = $_POST['name'];
$time = $_POST['time'];
$place = $_POST['place'];


$servername = "localhost";
$username = "usr_2017_48";
$password = "mazai123";
$dbname = "db_2017_48";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql = "SELECT * FROM party Where Time='$time' AND Place='$place'  AND Host_Name='$name'";
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result)==0)
{
$sql1 = "INSERT INTO party (Time, Place, Host_Name) VALUE('$time','$place','$name')";
mysqli_query($conn, $sql1);
}

$sql = "SELECT Party_Num FROM party Where Time='$time' AND Place='$place'  AND Host_Name='$name'";
$result=mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


$json_arr = array("Party_Num"=>$row["Party_Num"],"Time"=>$time,"Place"=>$place,"Host_Name"=>$name);
echo json_encode($json_arr);
?>
