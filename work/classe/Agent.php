<?php
// Agent.php

class Agent {
  // Propriétés
  public $id;
  public $firstName;
  public $lastName;
  public $dateOfBirth;
  public $identificationCode;
  public $nationality;
  public $specialties;

  private $conn;
  private $table = 'agents';

  public function __construct($db) {
    $this->conn = $db;
  }

  // Méthodes

  // Méthode pour récupérer tous les agents
  public function getAllAgents() {
    $query = "SELECT * FROM " . $this->table;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  // Méthode pour récupérer un agent par ID
  public function getAgentById($id) {
    $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    return $stmt;
  }

  // Méthode pour créer un agent
  public function createAgent() {
    $query = "INSERT INTO " . $this->table . "
              SET
                first_name = :firstName,
                last_name = :lastName,
                date_of_birth = :dateOfBirth,
                identification_code = :identificationCode,
                nationality = :nationality,
                specialties = :specialties";
    $stmt = $this->conn->prepare($query);

    // Nettoyer les données
    $this->firstName = htmlspecialchars(strip_tags($this->firstName));
    $this->lastName = htmlspecialchars(strip_tags($this->lastName));
    $this->dateOfBirth = htmlspecialchars(strip_tags($this->dateOfBirth));
    $this->identificationCode = htmlspecialchars(strip_tags($this->identificationCode));
    $this->nationality = htmlspecialchars(strip_tags($this->nationality));
    $this->specialties = htmlspecialchars(strip_tags($this->specialties));

    // Binder les valeurs
    $stmt->bindParam(':firstName', $this->firstName);
    $stmt->bindParam(':lastName', $this->lastName);
    $stmt->bindParam(':dateOfBirth', $this->dateOfBirth);
    $stmt->bindParam(':identificationCode', $this->identificationCode);
    $stmt->bindParam(':nationality', $this->nationality);
    $stmt->bindParam(':specialties', $this->specialties);

    if ($stmt->execute()) {
      return true;
    }

    return false;
  }

  // Méthode pour mettre à jour un agent
  public function updateAgent() {
    $query = "UPDATE " . $this->table . "
              SET
                first_name = :firstName,
                last_name = :lastName,
                date_of_birth = :dateOfBirth,
                identification_code = :identificationCode,
                nationality = :nationality,
                specialties = :specialties
              WHERE
                id = :id";
    $stmt = $this->conn->prepare($query);

    // Nettoyer les données
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->firstName = htmlspecialchars(strip_tags($this->firstName));
    $this->lastName = htmlspecialchars(strip_tags($this->lastName));
    $this->dateOfBirth = htmlspecialchars(strip_tags($this->dateOfBirth));
    $this->identificationCode = htmlspecialchars(strip_tags($this->identificationCode));
    $this->nationality = htmlspecialchars(strip_tags($this->nationality));
    $this->specialties = htmlspecialchars(strip_tags($this->specialties));

    // Binder les valeurs
    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':firstName', $this->firstName);
    $stmt->bindParam(':lastName', $this->lastName);
    $stmt->bindParam(':dateOfBirth', $this->dateOfBirth);
    $stmt->bindParam(':identificationCode', $this->identificationCode);
    $stmt->bindParam(':nationality', $this->nationality);
    $stmt->bindParam(':specialties', $this->specialties);

    if ($stmt->execute()) {
      return true;
    }

    return false;
  }

  // Méthode pour supprimer un agent
  public function deleteAgent($id) {
    $query = "DELETE FROM " . $this->table . " WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);

    if ($stmt->execute()) {
      return true;
    }

    return false;
  }
}
?>
