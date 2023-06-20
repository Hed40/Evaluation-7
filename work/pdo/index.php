<?php
$host = "localhost";
$db_name = "kgb_management";
$username = "root"; // Le nom d'utilisateur par défaut pour MySQL dans XAMPP est "root"
$password = ""; // Laissez le mot de passe vide par défaut dans XAMPP

try {
    $pdo = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   //$query= //"insert into targets (id, first_name, last_name, date_of_birth, code_name, nationality) values (2, 'Othilie', 'Lealle', '9/17/2022', '007', 'Food Chemist')";
   //"insert into missions (id, title, description, code_name, start_date, end_date, status, required_specialty) values (1, 'Pont kipitriak','Détruire le pont', '007','9/17/2022',  '9/17/2023', 'affecté','Food Chemist')";
    // Exécution de la requête
   //$result = $pdo->exec($query);

  
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
