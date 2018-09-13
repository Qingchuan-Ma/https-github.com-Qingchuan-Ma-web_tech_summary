<?php
$name=$_COOKIE["name"];
$age=$_COOKIE["age"];
$gender=$_COOKIE["gender"];
$email=$_COOKIE["email"];

$Party = $_POST['Party_Num'];
if(is_int($Party))
{
}
else
{
  $Party_Num=intval($Party);
}
if(is_int($age))
{
}
else
{
  $age=intval($age);
}


$servername = "localhost";
$username = "usr_2017_48";
$password = "mazai123";
$dbname = "db_2017_48";

$conn = mysqli_connect($servername, $username, $password, $dbname);


$sql = "SELECT * FROM guest Where Guest_Name='$name' AND Gender='$gender'  AND Age='$age'  AND E_mail='$email'";
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result)==0)
{
$sql1 = "INSERT INTO guest (Guest_Name, Age, Gender, E_mail) VALUE('$name','$age','$gender','$email')";
mysqli_query($conn, $sql1);
}


$sql2 = "SELECT Party_Num, Time, Place ,Host_Name FROM party WHERE Party_Num=$Party_Num";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);


$sql3 = "SELECT Guest_ID FROM guest WHERE Guest_Name='$name' AND Gender='$gender'  AND Age='$age'  AND E_mail='$email'";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result3);


$Guest_ID=$row3["Guest_ID"];
$sql = "SELECT Party_Num FROM guest_party WHERE Guest_ID='$Guest_ID'";
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
if((mysqli_num_rows($result)==0)||($row["Party_Num"]!=$Party_Num))
{
$sql4 = "INSERT INTO guest_party (Guest_ID,Party_Num) VALUE('$Guest_ID','$Party_Num')";
mysqli_query($conn, $sql4);
}




mysqli_close($conn);
$json_arr = array("name"=>$name,"age"=>$age,"gender"=>$gender,"email"=>$email,"Guest_ID"=>$row3["Guest_ID"],"Party_Num"=>$Party_Num,"Time"=>$row2["Time"],"Place"=>$row2["Place"],"Host_Name"=>$row2["Host_Name"]);
echo json_encode($json_arr);

?>
