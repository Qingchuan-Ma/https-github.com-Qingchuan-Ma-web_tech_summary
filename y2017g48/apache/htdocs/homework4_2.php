<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="./css/jquery-ui.css" rel="stylesheet">
<title>
  Hello Guest!
</title>
<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<script>

$(function(){
  $("#return").click(function()
  {
    $("#start_menu").show();
    $("#return").css("display", "none");
    $("#party_table").html("");
    window.location.reload();
  });

  $("#send").click(function(){
    var Obj=document.getElementById("select_party").selected;
    for(var i=0;i<Obj.length;i++){if(Obj[i].checked){break}};
    if(i==Obj.length)
    {
      alert("No Choice");
      return;
    }
    else
    {
      var value=Obj[i].value;
    }
   $.ajax(
   {
    url:'./php/homework4_4.php',
    type:'post',
    dataType:'json',
    data:{Party_Num:value},
    error : function()
    {
          alert("Wrong!");
    },
    success:function(data)
    {
     $("#party_table").html//输出div
    (
      "<h1>Result! of Selection!</h1>You <b>"+data.name+", </b>Your Guest_ID is "+data.Guest_ID+"<br><br> And you have selected party "+data.Party_Num+"! <br><br> Following is the detailed info, please attend it <b>punctually!</b>. Your info has been written into database!<br> <br><table border=\"1\"align=\"center\"><tr><th>Guest_ID</th><th>Name</th><th>Age</th><th>Gender</th><th>E_mail</th></tr><tr><th>"+data.Guest_ID+"</th><th>"+data.name+"</th><th>"+data.age+"</th><th>"+data.gender+"</th><th>"+data.email+"</th></tr></table><br><table border=\"1\"align=\"center\"><tr><th>Party_Num</th><th>Time</th><th>Place</th><th>Host_Name</th></tr><tr><th>"+data.Party_Num+"</th><th>"+data.Time+"</th><th>"+data.Place+"</th><th>"+data.Host_Name+"</th></tr></table><br><table border=\"1\"align=\"center\"><tr><th>Guest_ID</th><th>Party_Num</th></tr><tr><th>"+data.Guest_ID+"</th><th>"+data.Party_Num+"</th></tr></table><br>"
    );
    $("#start_menu").hide();
    $("#return").css("display","inline");
    }
   });
  });
 });
</script>

<style media="screen">
input
{
  border: 1px solid #ccc;
  padding: 7px 0px;
  border-radius: 3px; /*css3属性IE不支持*/
  padding-left:5px;
}
input:focus
{
    outline: none;
    border-color: #9ecaed;
    box-shadow: 0 0 10px #9ecaed;
}
h1
{
	font-size:40px;
	color: transparent;
	-webkit-text-stroke: 1px black;
	letter-spacing: 0.04em;
	background-color:
	}
</style>
</head>


<body style="text-align:center">
  <?php
    $name=$_COOKIE["name"];
    $age=$_COOKIE["age"];
    $gender=$_COOKIE["gender"];
    $email=$_COOKIE["email"];
    echo "<div id=\"party_table\">";
    echo "</div>";
    echo "<div id=\"start_menu\">";
    echo "<h1>Welcome! Guest $name!</h1>";
    echo "Please Check the information about you listed below!<br><br>";
    echo "<table border=\"1\" align=\"center\">
          <tr>
          <th>$name</th>
          <th>$age</th>
          <th>$gender</th>
          <th>$email</th>
          </tr>
          </table><br>";
    echo "If your information is not correct, Please logout and login again! Thanks!<br><br>";
    //连接数据库
    $servername = "localhost";
    $username = "usr_2017_48";
    $password = "mazai123";
    $dbname = "db_2017_48";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn)
    {
      die("Connect fail: " . mysqli_connect_error());
    }

    //显示party表
    $sql = "SELECT Party_Num, Time, Place ,Host_Name FROM party";
    $result = mysqli_query($conn, $sql);
    echo "Here is all the information about parties so far, if you are interested in one of them, select and submit to attend!<br><br>";
    echo "<div><table border=\"1\" align=\"center\">";
    if (mysqli_num_rows($result) > 0)
    {
      echo
      "
      <tr>
        <th>Party_Num</th>
        <th>Time</th>
        <th>Place</th>
        <th>Host_Name</th>
      </tr>
      ";
      while($row = mysqli_fetch_assoc($result))
      {//显示表
        echo
        "
        <tr>
          <th>".$row["Party_Num"]."</th>
          <th>".$row["Time"]."</th>
          <th>".$row["Place"]."</th>
          <th>".$row["Host_Name"]."</th>
          </tr>
        ";
      }
    }
    else
    {
      echo "0 Results";
    }
    echo "</table></div></div>";


    //显示checkbox
    $result = mysqli_query($conn, $sql);

    echo "<br>";
    echo "<div style=\"margin:0 auto; text-align:left;width:46%\">";
    echo "<form id=\"select_party\" action=\"\"  method=\"post\">";
    echo "<b>";
    if (mysqli_num_rows($result) > 0)
    {
      while($row = mysqli_fetch_assoc($result))
      {//这里是显示checkbox
        $temp=$row["Party_Num"];
        echo
        "<input type=\"radio\" name=\"selected\" value=$temp>".$row["Party_Num"].": Time: ".$row["Time"]." - Place: ".$row["Place"]." - Host_Name: ".$row["Host_Name"]." <br>";
      }
    }
    else
    {
      echo "0 Results";
    }

    echo "</b>";
    echo "</div>";
    echo "<br>";
    echo "Select which party to join in and Press The Button Listed<br>";
    echo "</form>";

    mysqli_close($conn);
    echo "<button class=\"ui-button\" id=\"send\">Submit</button>";
  ?>
  <button class="ui-button" id="return" style="display:none">Return</button><br><br>
  <button class="ui-button"  onclick="window.location.href='./homework4_1.html'">Logout</button>
</body>
</html>
