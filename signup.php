<?php 
$username=filter_input(INPUT_POST,'username');
$password=filter_input(INPUT_POST,'password');

$host="localhost";
$dbusername="root";
$dbpassword="";
$dbname="treasury";

$conn =new mysqli ( $host , $dbusername , $dbpassword , $dbname);

if(mysqli_connect_error()){

    die('Connect Error('.mysqli_connect_errno().')');
    mysqli_connect_error();
}
else{
  $sql_u = "SELECT * FROM users WHERE username ='$username'";
  $res_u = mysqli_query($conn, $sql_u);
  if (mysqli_num_rows($res_u) > 0) {
      echo "<script language=\"JavaScript\">\n";
      echo "alert('Sorry... username already taken');\n";
      echo "window.location='signup.html'";
      echo "</script>";
    }else{
$sql="INSERT INTO users"."(username,password)".
"VALUES"."('$username','$password')";
if($conn->query($sql)){
        echo "<script language=\"JavaScript\">\n";
        echo "alert('Your details have been recorded successfully. Now You can Login');\n";
        echo "window.location='login.html'";
        echo "</script>";
    // echo 'Your details have been recorded successfully.';
}
else{
    echo "Error:".$sql."<br>".$conn->error;
}
$conn->close();
}
}

 ?>