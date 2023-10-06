<?php
session_start();
session_unset(); // Détruit les variables de session
session_destroy(); // Détruit la session elle-même
header("Location: index.php"); // Redirige l'utilisateur vers la page d'accueil
exit();
?>