<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>SOS Canicule</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<header>
  <h1>SOS Canicule</h1>
  <nav>
    <a href="index.php">Accueil</a>
    <?php if (isset($_SESSION['username'])): ?>
    <a href="logout.php">Déconnexion</a>
    <?php else: ?>
    <a href="login.php">Connexion</a>
    <a href="register.php">Inscription</a>
    <?php endif; ?>
  </nav>
</header>