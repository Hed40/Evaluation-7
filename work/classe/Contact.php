<?php
// Contact.php

class Contact
{
    public $id;
    public $firstName;
    public $lastName;
    public $dateOfBirth;
    public $codeName;
    public $nationality;

    private $conn;

    private $table = 'contacts';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Méthodes

    // Méthode pour récupérer toutes les contacts

    public function getAllContacts()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Méthode pour récupérer un contact par ID

    public function getContactsById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }

    // Méthode pour créer un contact

    public function createContact()
    {
        $query = "INSERT INTO" . $this->table . "

            SET
                firts_name = :firstName,
                last_name = :lastName,
                date_of_birth = :dateOfBirth,
                code_name = :codeName,
                nationality = :nationality";
        $stmt = $this->conn->prepare($query);

        // Nettoyer les données
        $this->firstName = htmlspecialchars(strip_tags($this->firstName));
        $this->lastName = htmlspecialchars(strip_tags($this->lastName));
        $this->dateOfBirth = htmlspecialchars(strip_tags($this->dateOfBirth));
        $this->codeName = htmlspecialchars(strip_tags($this->codeName));
        $this->nationality = htmlspecialchars(strip_tags($this->nationality));

        // Binder les valeurs
        $stmt->bindParam(':firstName', $this->firstName);
        $stmt->bindParam(':lastName', $this->lastName);
        $stmt->bindParam(':dateOfBirth', $this->dateOfBirth);
        $stmt->bindParam(':codeName', $this->codeName);
        $stmt->blindParam(':nationality', $this->nationality);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Méthode pour mettre à jour un contact

    public function updateContact(){
        $query ="UPDATE" .$this->table ."
                SET
                firts_name = :firstName,
                last_name = :lastName,
                date_of_birth = :dateOfBirth,
                code_name = :codeName,
                nationality = :nationality
                WHERE
                id = :id";
    $stmt = $this->conn->prepare($query);

    // Nettoyer les données
    $this->firstName = htmlspecialchars(strip_tags($this->firstName));
    $this->lastName = htmlspecialchars(strip_tags($this->lastName));
    $this->dateOfBirth = htmlspecialchars(strip_tags($this->dateOfBirth));
    $this->codeName = htmlspecialchars(strip_tags($this->codeName));
    $this->nationality = htmlspecialchars(strip_tags($this->nationality));

    // Binder les valeurs
    $stmt->bindParam(':firstName', $this->firstName);
    $stmt->bindParam(':lastName', $this->lastName);
    $stmt->bindParam(':dateOfBirth', $this->dateOfBirth);
    $stmt->bindParam(':codeName', $this->codeName);
    $stmt->blindParam(':nationality', $this->nationality);

    if ($stmt->execute()) {
        return true;
    }
    return false;
    }

    // Méthode pour supprimer un contact

    public function deleteContacts(){
        $query = "DELETE FROM" .$this->table ."
                WHERE
                id = :id";
        $stmt = $this->conn->prepare($query);

        // Nettoyer les données
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Binder les valeurs
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>