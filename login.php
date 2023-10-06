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

  // Utilisez des requêtes préparées pour éviter les injections SQL
  $sql = "SELECT username FROM user WHERE email = ? AND password = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $_POST['email'], $_POST['password']);
  $stmt->execute();
  $result = $stmt->get_result();
  
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $_SESSION['username'] = $row['username'];
    }
    header('Location: index.php'); 
    exit;
  } else {
    echo "Échec de la connexion. Email ou mot de passe incorrect.";
  }
  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <!-- Inclure d'autres balises meta et liens vers des fichiers CSS si nécessaire -->
</head>
<body>
  <?php include 'header.php'; ?>

  <form method="POST">
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Mot de passe:</label>
    <input type="password" name="password" required>
    <input type="submit" value="Se connecter">
  </form>

  <?php include 'footer.php'; ?>
</body>
</html>
