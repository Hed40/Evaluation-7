<?php
require_once '../classe/Missions.php';
include_once '../pdo/index.php';
$mission = new Mission($pdo);
$missions = $mission->getAllMissions();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RGB Management</title>
    <!-- Inclure les fichiers CSS et JS nécessaires ici -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/js/bootstrap.js">
</head>

<body>
<?php include 'header.php'; ?>
    <main>
        <!-- Contenu principal de votre page -->
        <section>
            ACCUEIL
        </section>
    </main>

    <footer>
        <!-- Ajoutez votre pied de page ici -->
        <p>&copy; 2023 KGB Management. Tous droits réservés.</p>
    </footer>

    <!-- Inclure les fichiers JS supplémentaires ici -->
    <script src="script.js"></script>
</body>

</html>