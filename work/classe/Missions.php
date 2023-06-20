<?php

// missions.php

class Mission
{
    public $id;
    public $title;
    public $description;
    public $codeName;
    public $country;
    public $startDate;
    public $endDate;
    public $status;
    public $requiredSpecialty;

    private $conn;
    private $table = 'missions';

public function __construct($db)
{
    $this->conn = $db;
}
    // Méthodes
    // Méthode pour récupérer toutes les missions
public function getAllMissions()
{
    $query = "SELECT * FROM " . $this->table;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
}

    // Méthode pour récupérer une mission par ID

    public function getMissionsById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }

    // Méthode pour créer une mission

    public function createMissions()
    {
        $query = "INSERT INTO" . $this->table . "

            SET
                title = :title,
                description = :description,
                code_name = :codeName,
                country = :country,
                start_date = :startDate,
                end_date = :endDate,
                status = :status,
                required_specialty = :requiredSpecialty";
        $stmt = $this->conn->prepare($query);

        // Nettoyer les données
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->codeName = htmlspecialchars(strip_tags($this->codeName));
        $this->country = htmlspecialchars(strip_tags($this->country));
        $this->startDate = htmlspecialchars(strip_tags($this->startDate));
        $this->endDate = htmlspecialchars(strip_tags($this->endDate));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->requiredSpecialty = htmlspecialchars(strip_tags($this->requiredSpecialty));

        // Binder les données
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':codeName', $this->codeName);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':startDate', $this->startDate);
        $stmt->bindParam(':endDate', $this->endDate);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':requiredSpecialty', $this->requiredSpecialty);

        // Exécuter la requête
        if ($stmt->execute()) {
            return true;
        }
        printf("Erreur : %s.\n", $stmt->error);
        return false;
    }

    // Méthode pour mettre à jour une mission


    public function updateMission(){
        $query = "UPDATE " . $this->table . "
            SET
                title = :title,
                description = :description,
                code_name = :codeName,
                country = :country,
                start_date = :startDate,
                end_date = :endDate,
                status = :status,
                required_specialty = :requiredSpecialty
            WHERE
                id = :id";
        $stmt = $this->conn->prepare($query);

        // Nettoyer les données

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->codeName = htmlspecialchars(strip_tags($this->codeName));
        $this->country = htmlspecialchars(strip_tags($this->country));
        $this->startDate = htmlspecialchars(strip_tags($this->startDate));
        $this->endDate = htmlspecialchars(strip_tags($this->endDate));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->requiredSpecialty = htmlspecialchars(strip_tags($this->requiredSpecialty));

        // Binder les données

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':codeName', $this->codeName);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':startDate', $this->startDate);
        $stmt->bindParam(':endDate', $this->endDate);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':requiredSpecialty', $this->requiredSpecialty);

        // Exécuter la requête

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }    

    // Méthode pour supprimer une mission

    public function deleteMissions()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Nettoyer les données

        $this->id = htmlspecialchars(strip_tags($this->id));

        // Binder les données

        $stmt->bindParam(1, $this->id);

        // Exécuter la requête

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

?>