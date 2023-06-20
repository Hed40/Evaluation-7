CREATE DATABASE kgb_management;

USE kgb_management;

CREATE TABLE agents (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  date_of_birth DATE NOT NULL,
  identification_code VARCHAR(20) NOT NULL,
  nationality VARCHAR(50) NOT NULL,
  specialties TEXT NOT NULL
);

CREATE TABLE targets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  date_of_birth DATE NOT NULL,
  code_name VARCHAR(50) NOT NULL,
  nationality VARCHAR(50) NOT NULL
);

CREATE TABLE contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  date_of_birth DATE NOT NULL,
  code_name VARCHAR(50) NOT NULL,
  nationality VARCHAR(50) NOT NULL
);

CREATE TABLE safehouses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  code VARCHAR(20) NOT NULL,
  address VARCHAR(100) NOT NULL,
  country VARCHAR(50) NOT NULL,
  type VARCHAR(50) NOT NULL
);

CREATE TABLE missions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  code_name VARCHAR(50) NOT NULL,
  country VARCHAR(50) NOT NULL,
  start_date DATE NOT NULL,
  end_date DATE NOT NULL,
  status VARCHAR(50) NOT NULL,
  required_specialty VARCHAR(50) NOT NULL
);

CREATE TABLE missions_agents (
  mission_id INT NOT NULL,
  agent_id INT NOT NULL,
  PRIMARY KEY (mission_id, agent_id),
  FOREIGN KEY (mission_id) REFERENCES missions(id),
  FOREIGN KEY (agent_id) REFERENCES agents(id)
);

CREATE TABLE missions_contacts (
  mission_id INT NOT NULL,
  contact_id INT NOT NULL,
  PRIMARY KEY (mission_id, contact_id),
  FOREIGN KEY (mission_id) REFERENCES missions(id),
  FOREIGN KEY (contact_id) REFERENCES contacts(id)
);

CREATE TABLE missions_targets (
  mission_id INT NOT NULL,
  target_id INT NOT NULL,
  PRIMARY KEY (mission_id, target_id),
  FOREIGN KEY (mission_id) REFERENCES missions(id),
  FOREIGN KEY (target_id) REFERENCES targets(id)
);

CREATE TABLE missions_safehouses (
  mission_id INT NOT NULL,
  safehouse_id INT NOT NULL,
  PRIMARY KEY (mission_id, safehouse_id),
  FOREIGN KEY (mission_id) REFERENCES missions(id),
  FOREIGN KEY (safehouse_id) REFERENCES safehouses(id)
);

CREATE TABLE administrators (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL,
  creation_date DATE NOT NULL
);

--INSERT TABLE AGENTS--

insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (1, 'Othilie', 'Lealle', '9/17/2022', 'Greece', 'Food Chemist');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (2, 'Salaidh', 'Blythin', '1/20/2023', 'Thailand', 'GIS Technical Architect');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (3, 'Ingemar', 'Weld', '12/22/2022', 'Democratic Republic of the Congo', 'Health Coach II');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (4, 'Florance', 'Wingate', '6/8/2022', 'Thailand', 'Clinical Specialist');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (5, 'Shannah', 'Bacchus', '2/2/2023', 'Estonia', 'Junior Executive');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (6, 'Geordie', 'O''Connor', '9/24/2022', 'Russia', 'General Manager');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (7, 'Heda', 'Watkin', '2/16/2023', 'China', 'Electrical Engineer');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (8, 'Aguie', 'Gronav', '9/5/2022', 'France', 'Administrative Officer');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (9, 'Chan', 'Purcell', '6/12/2022', 'Cuba', 'Marketing Assistant');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (10, 'Duffy', 'Freda', '6/13/2022', 'Serbia', 'Desktop Support Technician');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (11, 'Grete', 'Rowling', '6/25/2022', 'Russia', 'Financial Advisor');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (12, 'El', 'Aslam', '11/6/2022', 'China', 'Chief Design Engineer');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (13, 'Teodoro', 'Huxham', '10/2/2022', 'Portugal', 'Chemical Engineer');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (14, 'Kermy', 'Hillborne', '7/3/2022', 'Brazil', 'Financial Analyst');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (15, 'Kerri', 'Rossin', '12/5/2022', 'Canada', 'Senior Cost Accountant');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (16, 'Jerald', 'Filewood', '9/17/2022', 'China', 'Help Desk Technician');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (17, 'Marius', 'Cawdron', '12/4/2022', 'China', 'Executive Secretary');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (18, 'Alexi', 'Bubbings', '7/19/2022', 'Argentina', 'Geologist I');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (19, 'Corella', 'Dewicke', '4/6/2023', 'China', 'Professor');
insert into agents (id, first_name, last_name, date_of_birth, nationality, specialties) values (20, 'Solomon', 'Harriss', '4/3/2023', 'Libya', 'Physical Therapy Assistant');


