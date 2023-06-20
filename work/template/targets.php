<?php
require_once '../classe/Target.php';
include_once '../pdo/index.php';
$target = new Target($pdo);
$targets = $target->getAllTargets();
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
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>Nom de code</th>
                    <th>Nationalité</th>

                    <!-- Ajoutez d'autres en-têtes de colonnes si nécessaire -->
                </tr>
                <?php
                while ($row = $targets->fetch(PDO::FETCH_ASSOC)) {
                  echo "<tr>";
                  echo "<td>" . $row['id'] . "</td>";
                  echo "<td>" . $row['first_name'] . "</td>";
                  echo "<td>" . $row['last_name']  . "</td>";
                  echo "<td>" . $row['date_of_birth'] . "</td>";
                  echo "<td>" . $row['code_name'] . "</td>";
                echo "<td>" . $row['nationality'] . "</td>";
                  // Affichez d'autres cellules de données si nécessaire
                  echo "</tr>";
                }
                ?>
            </table>
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