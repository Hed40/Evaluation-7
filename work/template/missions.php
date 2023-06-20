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
            <table>
                <tr>
                    <th>ID</th>
                    <th>titre</th>
                    <th>Description</th>
                    <th>Nom de code</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Statut</th>
                    <th>Spécialité requise</th>
                </tr>
                <?php
                while ($row = $missions->fetch(PDO::FETCH_ASSOC)) {
                  echo "<tr>";
                  echo "<td>" . $row['id'] . "</td>";
                  echo "<td>" . $row['title'] . "</td>";
                  echo "<td>" . $row['description']  . "</td>";
                  echo "<td>" . $row['code_name'] . "</td>";
                  echo "<td>" . $row['start_date'] . "</td>";
                echo "<td>" . $row['end_date'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>" . $row['required_specialty'] . "</td>";

                  echo "</tr>";
                }
                ?>
            </table>
        </section>
        <section>
            <a class="btn btn-primary">Nouvelle mission</a>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 KGB Management. Tous droits réservés.</p>
    </footer>
</body>

</html>