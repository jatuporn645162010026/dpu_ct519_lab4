<?php

if(isset($_GET['movie_id'])) {
 $id = $_GET['movie_id'];

}else{
  $id = null;
}


$mysql_hostname = "10.1.1.22";
$mysql_user = "JSA";
$mysql_password = "P@ssw0rd";
$mysql_database = "CT519_Movie";
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database) or die("Could not connect database");

if (!$bd) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully".'<br>';

if($id>0)
{
$sql_stmt = "select * from Movie Left Join Movie_Type on Movie_Type.Code=Movie.Code where id=".$id;

}else
{
$sql_stmt = "select * from Movie Left Join Movie_Type on Movie_Type.Code=Movie.Code";
}

$result=mysqli_query($bd,$sql_stmt);
if(!$result)
{
die("Database access failed".mysqli_error());
}

$rows=mysqli_num_rows($result);

if($rows){
echo '<!DOCTYPE html><html lang="en-US"><head><title>CT519 Lab2</title></head><body>';

 while($row = mysqli_fetch_array($result)){
   echo 'Movie title: '.$row['Name'].'<br>';
   echo 'Director: '.$row['Director'].'<br>';
   echo 'Style: '.$row['Type_name'].'<br>';
   echo 'Release date: '.$row['Show_date'].'<br>';
   echo 'Trailer: <a href="'.$row['Trailler'].'" target="_blank">'.$row['Trailler'].'</a><br><br>';
 }

echo '<button onclick="myFuction()">SQL statement to DB</button>'.PHP_EOL ;
echo '<script type="text/Javascript">' .PHP_EOL. 'function myFuction(){alert("'.$sql_stmt.'");}' .PHP_EOL. '</script>';
echo '</body></html>';
}


//Free result set
mysqli_free_result($result);
mysqli_close($bd);

?>

