<?php
session_start();

if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit();
}

$message = "";

if(isset($_POST["submit"])){
    $connect = mysqli_connect(
        'db',
        'kolya',
        'password',
        'docker'
    );

  $portfolio = $_POST["portfolio"];
  $username = $_SESSION["username"];

  $query = "UPDATE users SET portfolio='$portfolio' WHERE username='$username'";
  $result = mysqli_query($connect, $query);

  if($result){
    $message = "Portfolio updated successfully!";
  } else {
    $message = "Error updating portfolio. Please try again.";
  }
} else {
    $connect = mysqli_connect(
        'db',
        'kolya',
        'password',
        'docker'
    );

  $username = $_SESSION["username"];
  $query = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($connect, $query);

  if($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $portfolio = $row["portfolio"];
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Portfolio - Car Sale</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="edit-portfolio-container">
    <h1>Edit Portfolio</h1>
    <form method="post">
      <textarea name="portfolio" placeholder="Enter your portfolio"><?php echo $portfolio; ?></textarea>
      <button type="submit" name="submit">Save</button>
    </form>
    <div class="message"><?php echo $message; ?></div>
  </div>
</body>
</html>
