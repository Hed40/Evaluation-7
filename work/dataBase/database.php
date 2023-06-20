<?php

// Exemple de requête SQL pour créer une table
    $query = 
    "CREATE TABLE agents (
      id INT AUTO_INCREMENT PRIMARY KEY,
      first_name VARCHAR(50) NOT NULL,
      last_name VARCHAR(50) NOT NULL,
      date_of_birth DATE NOT NULL,
      identification_code VARCHAR(20) NOT NULL,
      nationality VARCHAR(50) NOT NULL,
      specialties TEXT NOT NULL
    )";
   " CREATE TABLE targets (
      id INT AUTO_INCREMENT PRIMARY KEY,
      first_name VARCHAR(50) NOT NULL,
      last_name VARCHAR(50) NOT NULL,
      date_of_birth DATE NOT NULL,
      code_name VARCHAR(50) NOT NULL,
      nationality VARCHAR(50) NOT NULL
    )";
    
    "CREATE TABLE contacts (
      id INT AUTO_INCREMENT PRIMARY KEY,
      first_name VARCHAR(50) NOT NULL,
      last_name VARCHAR(50) NOT NULL,
      date_of_birth DATE NOT NULL,
      code_name VARCHAR(50) NOT NULL,
      nationality VARCHAR(50) NOT NULL
    )";
    
    "CREATE TABLE safehouses (
      id INT AUTO_INCREMENT PRIMARY KEY,
      code VARCHAR(20) NOT NULL,
      address VARCHAR(100) NOT NULL,
      country VARCHAR(50) NOT NULL,
      type VARCHAR(50) NOT NULL
    )";
    
    "CREATE TABLE missions (
      id INT AUTO_INCREMENT PRIMARY KEY,
      title VARCHAR(100) NOT NULL,
      description TEXT NOT NULL,
      code_name VARCHAR(50) NOT NULL,
      country VARCHAR(50) NOT NULL,
      start_date DATE NOT NULL,
      end_date DATE NOT NULL,
      status VARCHAR(50) NOT NULL,
      required_specialty VARCHAR(50) NOT NULL
    )";
    
    "CREATE TABLE missions_agents (
      mission_id INT NOT NULL,
      agent_id INT NOT NULL,
      PRIMARY KEY (mission_id, agent_id),
      FOREIGN KEY (mission_id) REFERENCES missions(id),
      FOREIGN KEY (agent_id) REFERENCES agents(id)
    )";
    
    "CREATE TABLE missions_contacts (
      mission_id INT NOT NULL,
      contact_id INT NOT NULL,
      PRIMARY KEY (mission_id, contact_id),
      FOREIGN KEY (mission_id) REFERENCES missions(id),
      FOREIGN KEY (contact_id) REFERENCES contacts(id)
    )";
    
    "CREATE TABLE missions_targets (
      mission_id INT NOT NULL,
      target_id INT NOT NULL,
      PRIMARY KEY (mission_id, target_id),
      FOREIGN KEY (mission_id) REFERENCES missions(id),
      FOREIGN KEY (target_id) REFERENCES targets(id)
    )";
    
    "CREATE TABLE missions_safehouses (
      mission_id INT NOT NULL,
      safehouse_id INT NOT NULL,
      PRIMARY KEY (mission_id, safehouse_id),
      FOREIGN KEY (mission_id) REFERENCES missions(id),
      FOREIGN KEY (safehouse_id) REFERENCES safehouses(id)
    )";
    
    "CREATE TABLE administrators (
      id INT AUTO_INCREMENT PRIMARY KEY,
      first_name VARCHAR(50) NOT NULL,
      last_name VARCHAR(50) NOT NULL,
      email VARCHAR(100) NOT NULL,
      password VARCHAR(100) NOT NULL,
      creation_date DATE NOT NULL
    )";
    
    

    // Exécution de la requête
    $result = $pdo->exec($query);

    if ($result !== false) {
        echo "Table créée avec succès !";
    } else {
        echo "Erreur lors de la création de la table.";
    }