
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $servername = "127.20.10.9"; // adresse du serveur mysql
  $username = "armand"; // nom d'utilisateur mysql
  $password = "root"; // mot de passe mysql
  $database = "hackaton"; // nom de la base de données
  $port = 3306;
  

  $conn = new mysqli($servername, $username, $password, $database, $port);

  if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
  }

  $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
if ($stmt === false) {
  die("Erreur dans la requête SQL: " . $conn->error);
}
$stmt->bind_param("sss", $_POST['username'], $_POST['email'], $_POST['password']);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
    $_SESSION['username'] = $_POST['username'];
    header('Location: login.php'); 
    exit;
  } else {
    echo "Échec de l'inscription";
  }
  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
  <title>Inscription</title>
  <?php include 'header.php'; ?>
</head>
<body>

  <form method="POST">
    <label>Nom d'utilisateur:</label>
    <input type="text" name="username" required>
    <label>E-mail:</label>
    <input type="email" name="email" required>
    <label>Mot de passe:</label>
    <input type="password" name="password" required>
    <input type="submit" value="S'inscrire">
  </form>
</body>
</html>
<?php include 'footer.php'; ?>