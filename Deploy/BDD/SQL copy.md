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

INSERT INTO customer (id, nameCustomer, adress, mailGeneric, siren, nameContact, mailContact, adressContact) VALUES
(23, 'Bouygues construct', '3 rue des constructeurs', 'bouygues@bouygues.com', '12345678912345', 'Norman', 'norman@bouygues.com', '3 rue des constructeurs'),
(24, 'Eiffage construct', '3 allée des sapins', 'eiffage@eiffage.com', '98765432109876', 'Oswald', 'oswald@eiffage.com', '3 allée des sapins'),
(25, 'SOGEA', '15 chemin de terre', 'sogea@sogea.com', '57894610258467', 'Rozenblummentalovitch', 'Rozenblummentalovitch@sogea.com', '15 chemin de terre'),
(26, 'DOE Construction', '3 rue du dodo', 'doe@doe.fr', '51479238465217', 'John Doe', 'John@doe.fr', '2 rue du dodo'),
(28, 'Smith & Wesson', '44 rue du champs de tir', 'sw@sw.fr', '54986325875698', 'Smith', 'smith@sw.fr', '42 rue du champs de tir');

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

INSERT INTO products (id, type, name, length, recovery, summary, descriptionProduct, price) VALUES
(37, 1, 'ELASTOVAP', 7, 60, '', 'Élastovap est une feuille d’étanchéité constituée d’une armature en voile de verre et de bitume élastomère.', 2.89),
(38, 1, 'CHAPE ATLAS AR', 7, 60, 'Chape Atlas AR est une chape souple de bitume élastomère armée par grille de verre – voile de verre.', 'Chape Atlas AR est une chape souple de bitume élastomère avec une armature grille de verre et voile de verre. Soudé en plein, il et utilisé comme pare-vapeur pour les toitures-terrasses en béton ou comme couche de finition autoprotégée pour les relevés d\'étanchéité. Le coloris Blanc Chagall avec un SRI de 59, fait partie de notre offre d\'étanchéité Cool Roof.', 6.46),
(43, 1, 'COUVERTINE', 3, 20, 'Une couvertine', 'De l\'alu en général', 45.00);

INSERT INTO role (id, role) VALUES
(1, 'Assistant(e)'),
(2, 'Conducteur de travaux'),
(3, 'Comptable'),
(4, 'Chef de Secteur'),
(5, 'Chef d\'agence'),
(6, 'Administrateur');





