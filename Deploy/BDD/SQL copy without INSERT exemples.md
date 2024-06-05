CREATE TABLE customer (
  id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  nameCustomer tinytext NOT NULL,
  adress text DEFAULT NULL,
  mailGeneric tinytext DEFAULT NULL,
  siren varchar(14) DEFAULT NULL UNIQUE,
  nameContact tinytext DEFAULT NULL,
  mailContact tinytext DEFAULT NULL,
  adressContact text DEFAULT NULL
);

CREATE TABLE role (
  id tinyint(4) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  role varchar(20) NOT NULL
);

CREATE TABLE users (
  id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  name tinytext NOT NULL,
  firstName tinytext NOT NULL,
  mail varchar(200) NOT NULL,
  password varchar(60) NOT NULL,
  role tinyint(4) NOT NULL DEFAULT 1,
  FOREIGN KEY (role) REFERENCES role (id)
);

CREATE TABLE estimate (
  id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  nameEstimate tinytext NOT NULL,
  date date NOT NULL DEFAULT current_timestamp(),
  idCustomer int(11) NOT NULL,
  driver int(11) DEFAULT NULL,
  imput int(11) DEFAULT NULL UNIQUE,
  FOREIGN KEY (idCustomer) REFERENCES customer (id),
  FOREIGN KEY (driver) REFERENCES users (id)
);

CREATE TABLE type (
  id tinyint(4) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  name tinytext NOT NULL
);

INSERT INTO type (id, name) VALUES
(1, 'ETANCHEITE'),
(2, 'ZINGUERIE');

CREATE TABLE products (
  id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  type tinyint(4) NOT NULL,
  name tinytext NOT NULL UNIQUE,
  length tinyint(4) NOT NULL,
  recovery float NOT NULL,
  summary tinytext NOT NULL,
  descriptionProduct varchar(500) DEFAULT NULL,
  price decimal(10,2) NOT NULL,
  FOREIGN KEY (type) REFERENCES type (id)
);

CREATE TABLE tasks (
  id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  idEstimate int(11) NOT NULL,
  taskNumber int(11) DEFAULT NULL,
  descriptionTask text NOT NULL,
  quantity int(10) DEFAULT NULL,
  unitPrice decimal(10,2) DEFAULT NULL,
  FOREIGN KEY (idEstimate) REFERENCES estimate (id)
);

CREATE TABLE productbytask (
  id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  idProduct int(11) NOT NULL,
  idTask int(11) NOT NULL,
  quantityProduct int(11) NOT NULL,
  unitPriceProduct decimal(10,2) NOT NULL,
  FOREIGN KEY (idProduct) REFERENCES products (id),
  FOREIGN KEY (idTask) REFERENCES tasks (id)
);

INSERT INTO role (id, role) VALUES
(1, 'Assistant(e)'),
(2, 'Conducteur de travaux'),
(3, 'Comptable'),
(4, 'Chef de Secteur'),
(5, 'Chef d\'agence'),
(6, 'Administrateur');