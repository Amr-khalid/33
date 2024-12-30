<?php
$servername="localhost";
$username="root";
$password="";
$db="carrentialdb";
$conn = new mysqli($servername,$username,$password,$db);
if(!$conn){
    die("failled".mysqli_connect_error());
}
$sql = "SELECT model,YEAR_OF_MADE,carstatus FROM newcar";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        echo $row["model"]." ".$row["YEAR_OF_MADE"]." ".$row["carstatus"]."<br>";   
}
}
else{
    echo "0 result";
}

mysqli_close($conn)


?>