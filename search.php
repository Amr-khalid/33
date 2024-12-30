<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "carrentialdb";

$conn = new mysqli($server, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/seacar.css">
</head>
<body>
  <div class="container">
    <nav>
      <a href="#" class="logo">Search Available Car</a>
      <ul>
        <li>if you want search fill this page</li>
      </ul>
    </nav>
    <div class="content">
      <div class="text">
        <form class="f1" method="post">
          
          <label for="l1" class="fill" >Search Here</label>
          <input type="text" class="l1 form-field" name="search" placeholder="Search Box" value="" for="btn"><br>
          <button type="submit" name="submit" id="btn">search</button>
        </form>
        <div class="containerdb">
            <table class="table">
                <thead>
                    <tr>
                        <th>MODEL</th>
                        <th>YEAR_OF_MADE</th>
                        <th>CAR_STATUS</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(isset($_POST['submit'])) {
                    $search = $_POST['search'];
                    $sql="SELECT * FROM newcar WHERE model LIKE '%$search%' OR YEAR_OF_MADE LIKE '%$search%' OR carstatus LIKE '%$search%'";
                    $result = mysqli_query($conn,$sql);
                    if ($result) {
                if (mysqli_num_rows(( $result)) > 0) {
                            
                            while ($row=mysqli_fetch_array($result)){

                            

                            
                            echo'<tbody>
                            <tr>
                            <td>'.$row['model'].' </td>
                            <td>'.$row['YEAR_OF_MADE'].'</td>
                            <td>'.$row['carstatus'].'</td>
                            <tr>
                            </tbody>';}
                        
                     }else{
                        echo' <h2 class="text-danger">Data Not Found</h2>';
                }
            }
            }
                 ?>
                </tbody>
            </table>

        </div>
      </div>
      <div class="image">
        <img src="about.png">
      </div>
    </div>
  </div>
</body>
</html>