<?php
$version = "v2.4";

date_default_timezone_set('UTC');
include "./config.php";
?>
<html>
  <head>
    <title>OpsWorks Blue Green Test <?php echo $version?></title>
  </head>
  <body>
    <h1>OpsWorks Blue Green Test <?php echo $version?></h1>
    <h3><?php echo `hostname` . " | " . $_SERVER["SERVER_ADDR"] . " | " . date("c")?></h3>
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
