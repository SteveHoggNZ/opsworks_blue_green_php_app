<?php
$version = "1.0";

date_default_timezone_set('UTC');
include "./config.php";
?>
<html>
  <head>
    <title>OpsWorks Blue Green Test <?=$version?></title>
  </head>
  <body>
    <h1>OpsWorks Blue Green Test <?=$version?></h1>
    <h2><?=$_SERVER["SERVER_NAME"] . " " . date("c")?></h2>
<?php
try {
  $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
  if ($mysqli->connect_errno) {
    echo "MySQL connection failed:<br>\n";
    echo "Errno: " . $mysqli->connect_errno . "<br>\n";
    echo "Error: " . $mysqli->connect_error . "<br>\n";
  } else {
    $sql = "SELECT message FROM messages";
    if (!$result = $mysqli->query($sql)) {
      echo "MySQL query failed:<br>\n";
      echo "Query: " . $sql . "<br>\n";
      echo "Errno: " . $mysqli->errno . "<br>\n";
      echo "Error: " . $mysqli->error . "<br>\n";
    } else {
      if ($result->num_rows === 0) {
        echo "There are no messages yet.<br>\n";
      } else {
        echo "<ul>\n";
        while ($message = $result->fetch_assoc()) {
          echo "<li>\n";
          echo $message['message'] . '\n';
          echo "</li>\n";
        }
        echo "</ul>\n";
      }
      $result->free();
    }
    $mysqli->close();
  }
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "<br>\n";
}
?>
  </body>
</html>
