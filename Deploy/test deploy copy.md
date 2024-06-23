CREATE DATABASE batman;

USE batman;

CREATE TABLE customer (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nameCustomer tinytext NOT NULL,
  adress text DEFAULT NULL,
  mailGeneric tinytext DEFAULT NULL,
  siren varchar(14) DEFAULT NULL UNIQUE KEY,
  nameContact tinytext DEFAULT NULL,
  mailContact tinytext DEFAULT NULL,
  adressContact text DEFAULT NULL
);

INSERT INTO customer (id, nameCustomer, adress, mailGeneric, siren, nameContact, mailContact, adressContact) VALUES
(23, 'Bouygues construct', '3 rue des constructeurs', 'bouygues@bouygues.com', '12345678912345', 'Norman', 'norman@bouygues.com', '3 rue des constructeurs'),
(24, 'Eiffage construct', '3 allée des sapins', 'eiffage@eiffage.com', '98765432109876', 'Oswald', 'oswald@eiffage.com', '3 allée des sapins'),
(25, 'SOGEA', '15 chemin de terre', 'sogea@sogea.com', '57894610258467', 'Rozenblummentalovitch', 'Rozenblummentalovitch@sogea.com', '15 chemin de terre'),
(26, 'DOE Construction', '3 rue du dodo', 'doe@doe.fr', '51479238465217', 'John Doe', 'John@doe.fr', '2 rue du dodo'),
(28, 'Smith & Wesson', '44 rue du champs de tir', 'sw@sw.fr', '54986325875698', 'Smith', 'smith@sw.fr', '42 rue du champs de tir');

CREATE TABLE type (
  id tinyint(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name tinytext NOT NULL
);

INSERT INTO type (id, name) VALUES
(1, 'ETANCHEITE'),
(2, 'ZINGUERIE'),
(5, 'MO');

CREATE TABLE role (
  id tinyint(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  role varchar(25) NOT NULL
);

INSERT INTO role (id, role) VALUES
(1, 'Assistant(e)'),
(2, 'Conducteur de travaux'),
(3, 'Comptable'),
(4, 'Chef de Secteur'),
(5, 'Chef d\'agence'),
(6, 'Administrateur');

CREATE TABLE users (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name tinytext NOT NULL,
  firstName tinytext NOT NULL,
  mail varchar(200) NOT NULL,
  password varchar(60) NOT NULL,
  role tinyint(4) NOT NULL DEFAULT 1,
  FOREIGN KEY (role) REFERENCES role (id) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO users (id, name, firstName, mail, password, role) VALUES
(1, 'Plouzeau', 'Alexandre', 'eyola@gmail.com', '$2y$10$4X9QIWNSQglZZqu0X7g8/eYE4mghvs9yhzeTZg.MzCkXUhkFAcS52', 6),
(8, 'conduc', '1', 'conduc1@gmail.com', '$2y$10$N4jTHif0oCytTvuLnpePNe9NKWWV3liYurqwVfyUvAzqwhpYbxCxu', 2),
(9, 'secteur', '2', 'secteur2@gmail.com', '$2y$10$3e4bDDFI.8ltFh7pI6LyJ.1XM9QhlsWVmWYS7W7iTg8yoAKo8wyUq', 4),
(10, 'agence', '3', 'agence@gmail.com', '$2y$10$0t4Qbw7jeLReEtQSOh9ik.bIYOaA8kJMwITC8Kw9eBPhJ4O0T/esG', 5),
(15, 'compta', 'compta', 'compta@gmail.com', '$2y$10$ynYB9LkSNN3l/n30WT8kGedxwodB1YhVPZ3WqZTq23nkJ1oJ6l0gK', 3);

CREATE TABLE estimate (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nameEstimate tinytext NOT NULL,
  date date NOT NULL DEFAULT current_timestamp(),
  idCustomer int(11) NOT NULL,
  driver int(11) DEFAULT NULL,
  imput int(11) DEFAULT NULL UNIQUE,
  FOREIGN KEY (idCustomer) REFERENCES customer (id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (driver) REFERENCES users (id)
);

CREATE TABLE products (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  type tinyint(4) NOT NULL,
  name tinytext NOT NULL UNIQUE,
  length tinyint(4) DEFAULT NULL,
  recovery float DEFAULT NULL,
  summary tinytext DEFAULT NULL,
  descriptionProduct varchar(500) DEFAULT NULL,
  price decimal(10,2) NOT NULL,
  unit tinytext DEFAULT NULL,
  FOREIGN KEY (type) REFERENCES type (id)
);

INSERT INTO products (id, type, name, length, recovery, summary, descriptionProduct, price, unit) VALUES
(37, 1, 'ELASTOVAP', 7, 60, '', 'Élastovap est une feuille d’étanchéité constituée d’une armature en voile de verre et de bitume élastomère.', 2.89, 'm²'),
(38, 1, 'CHAPE ATLAS AR', 7, 60, 'Chape Atlas AR est une chape souple de bitume élastomère armée par grille de verre – voile de verre.', 'Chape Atlas AR est une chape souple de bitume élastomère avec une armature grille de verre et voile de verre. Soudé en plein, il et utilisé comme pare-vapeur pour les toitures-terrasses en béton ou comme couche de finition autoprotégée pour les relevés d\'étanchéité. Le coloris Blanc Chagall avec un SRI de 59, fait partie de notre offre d\'étanchéité Cool Roof.', 6.46, 'm²'),
(43, 2, 'COUVERTINE', 3, 20, 'Une couvertine', 'De l\'alu en général', 45.00, 'ml'),
(56, 1, 'ELASTOPHENE FLAM 25', 7, 60, 'ELASTOPHENE FLAM 25 est une feuille d’étanchéité soudable, constituée d’une armature en voile de verre\r\net de bitume élastomère. ', 'ELASTOPHENE FLAM 25 est utilisée en complexe bicouche, soit somme première couche, soit comme\r\ndeuxième couche avec protection rapportée.\r\nLes emplois sont ceux décrits dans les Documents Techniques d’Application et Cahiers de Prescriptions de\r\nPose SOPREMA en vigueur. ', 3.04, 'm²'),
(62, 1, 'EQUERRE 0,25', 10, 60, 'Equerres de renfort', 'Les équerres servent de renfort aux relevés d\'étanchéité.', 135.00, 'm²'),
(63, 1, 'ELASTOPHENE FLAM 25 AR', 70, 60, 'test', 'test', 3.40, 'm²'),
(64, 1, 'SOPRADERE', 0, 0, 'EIF', 'Vernis d\'imprégnation à froid', 2.03, 'Kg'),
(65, 5, 'Main d\'oeuvre', 0, 0, '', NULL, 30.00, 'h');

CREATE TABLE tasks (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idEstimate int(11) NOT NULL,
  taskNumber int(11) DEFAULT NULL,
  descriptionTask text NOT NULL,
  quantity int(10) DEFAULT NULL,
  unitPrice decimal(10,2) DEFAULT NULL,
  FOREIGN KEY (idEstimate) REFERENCES estimate (id)
);

CREATE TABLE productbytask (
  idProductByTask int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  row int(11) NOT NULL,
  idProduct int(11) NOT NULL,
  idTask int(11) NOT NULL,
  quantityProduct decimal(10,2) NOT NULL,
  unit tinytext DEFAULT NULL,
  unitPriceProduct decimal(10,2) NOT NULL,
  situation int(11) NOT NULL DEFAULT 0,
  expense decimal(10,2) DEFAULT NULL,
  FOREIGN KEY (idProduct) REFERENCES products (id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (idTask) REFERENCES tasks (id) ON DELETE CASCADE ON UPDATE CASCADE
);