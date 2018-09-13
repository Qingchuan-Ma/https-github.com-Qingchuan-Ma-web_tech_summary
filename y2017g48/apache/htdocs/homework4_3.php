<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="./css/jquery-ui.css" rel="stylesheet">
<title>
  Hello Host!
</title>
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
<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<script>
$(function(){
  $("#return").click(function(){
    $("#start_menu").show();
    $("#return").css("display", "none");
    $("#party_table").html("");
    window.location.reload();
  });

  $("#send").click(function(){
    var cont = $("input").serialize();
    $.ajax({
    url:'./php/homework4_5.php',
    type:'post',
    dataType:'json',
    data:cont,
    error:function()
    {
      alert("Wrong!");
    },
    success:function(data)
    {
     $("#party_table").html
     (
       "<h1>Congratulate!</h1><p>Your party has been registered into database!</p><p><b>"+data.Party_Num+"</b> is your <b>Party_Num!</b></p><br><table border=\"1\"align=\"center\"><tr><th>Party_Num</th><th>Time</th><th>Place</th><th>Host_Name</th></tr><tr><th>"+data.Party_Num+"</th><th>"+data.Time+"</th><th>"+data.Place+"</th><th>"+data.Host_Name+"</th></tr></table><br><p><b>Guest</b> can see your party and <b>Sign up</b></p><p>If you want hold another party or see your party in all <b>Party_Table</b>, please press return button, otherwise, please logout.</p><br>"
     );
     $("#start_menu").hide();
     $("#return").css("display", "inline");
    }
   });
  });
 });

function show_party_table(str) //失败了
{
    if (str=="")
    {
        document.getElementById("party_table").innerHTML="";
        return;
    }
    if (window.XMLHttpRequest)
    {
        // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        // IE6, IE5 浏览器执行代码
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("party_table").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST","./php/homework4_4.php?q="+str,true);
    xmlhttp.send();
}
</script>
</head>

<body style="text-align:center">
  <div id="party_table">

  </div>
  <div id="start_menu">
    <?php
    $name_host=$_COOKIE["name_host"];
    echo "<h1>Welcome! Host $name_host!</h1>";
    ?>
    <h3> You must want to hold a party, aren't you? </h3>
    <h4>If you are, fill the following blanks</h4>

    <form action=""  method="post">
      <b>Host_Name:</b> <input type="text" name="name"> (Jinyu Zhang) <br>
      <b>Host_Time:</b><input type="text" name="time"> (DEC.20, 2003, 17 PM.) <br>
      <b>Host_Place:</b> <input type="text" name="place" >(Peking University)<br>
      <br>
    </form>
    <button type="submit" class="ui-button" id="send">Submit</button><!--还没写str的表达式-->
    <br>

    <div id="party"><!--从数据库找出的party表-->
      <?php
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
      $sql = "SELECT Party_Num, Time, Place ,Host_Name FROM party";
      $result = mysqli_query($conn, $sql);

      echo "Here is all the information about parties so far<br><br>";
      echo "<table border=\"1\" align=\"center\">";
      if (mysqli_num_rows($result) > 0)
      {
        while($row = mysqli_fetch_assoc($result))
        {//这里是显示checkbox
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
      echo "</table>";
      ?>
    </div>
  </div>

  <button class="ui-button" id="return" style="display:none">Return</button><br><br>
  <button class="ui-button" onclick="window.location.href='./homework4_1.html'">Logout</button>

</body>
</html>
