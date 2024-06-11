CREATE TABLE customer (
  id int(11) NOT NULL,
  nameCustomer tinytext NOT NULL,
  adress text DEFAULT NULL,
  mailGeneric tinytext DEFAULT NULL,
  siren varchar(14) DEFAULT NULL,
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

CREATE TABLE estimate (
  id int(11) NOT NULL,
  nameEstimate tinytext NOT NULL,
  date date NOT NULL DEFAULT current_timestamp(),
  idCustomer int(11) NOT NULL,
  driver int(11) DEFAULT NULL,
  imput int(11) DEFAULT NULL
);

CREATE TABLE productbytask (
  idProductByTask int(11) NOT NULL,
  idProduct int(11) NOT NULL,
  idTask int(11) NOT NULL,
  quantityProduct int(11) NOT NULL,
  unitPriceProduct decimal(10,2) NOT NULL
);

CREATE TABLE products (
  id int(11) NOT NULL,
  type tinyint(4) NOT NULL,
  name tinytext NOT NULL,
  length tinyint(4) NOT NULL,
  recovery float NOT NULL,
  summary tinytext NOT NULL,
  descriptionProduct varchar(500) DEFAULT NULL,
  price decimal(10,2) NOT NULL
);

INSERT INTO products (id, type, name, length, recovery, summary, descriptionProduct, price) VALUES
(37, 1, 'ELASTOVAP', 7, 60, '', 'Élastovap est une feuille d’étanchéité constituée d’une armature en voile de verre et de bitume élastomère.', 2.89),
(38, 1, 'CHAPE ATLAS AR', 7, 60, 'Chape Atlas AR est une chape souple de bitume élastomère armée par grille de verre – voile de verre.', 'Chape Atlas AR est une chape souple de bitume élastomère avec une armature grille de verre et voile de verre. Soudé en plein, il et utilisé comme pare-vapeur pour les toitures-terrasses en béton ou comme couche de finition autoprotégée pour les relevés d\'étanchéité. Le coloris Blanc Chagall avec un SRI de 59, fait partie de notre offre d\'étanchéité Cool Roof.', 6.46),
(43, 1, 'COUVERTINE', 3, 20, 'Une couvertine', 'De l\'alu en général', 45.00),

CREATE TABLE `role` (
  id tinyint(4) NOT NULL,
  role varchar(20) NOT NULL
);

INSERT INTO role (id, role) VALUES
(1, 'Assistant(e)'),
(2, 'Conducteur de travau'),
(3, 'Comptable'),
(4, 'Chef de Secteur'),
(5, 'Chef d\'agence'),
(6, 'Administrateur');

CREATE TABLE tasks (
  id int(11) NOT NULL,
  idEstimate int(11) NOT NULL,
  taskNumber int(11) DEFAULT NULL,
  descriptionTask text NOT NULL,
  quantity int(10) DEFAULT NULL,
  unitPrice decimal(10,2) DEFAULT NULL
);

CREATE TABLE `type` (
  id tinyint(4) NOT NULL,
  name tinytext NOT NULL
);

INSERT INTO type (id, name) VALUES
(1, 'ETANCHEITE'),
(2, 'ZINGUERIE');

CREATE TABLE users (
  id int(11) NOT NULL,
  name tinytext NOT NULL,
  firstName tinytext NOT NULL,
  mail varchar(200) NOT NULL,
  password varchar(60) NOT NULL,
  role tinyint(4) NOT NULL DEFAULT 1
);

ALTER TABLE customer
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY siren (siren);
ALTER TABLE customer ADD FULLTEXT KEY nameCustomer (nameCustomer,adress,mailGeneric,siren,nameContact,mailContact,adressContact);

ALTER TABLE estimate
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY nameEstimate (nameEstimate) USING HASH,
  ADD UNIQUE KEY imput (imput),
  ADD KEY idCustomer (idCustomer),
  ADD KEY driver (driver) USING BTREE;

ALTER TABLE productbytask
  ADD PRIMARY KEY (idProductByTask),
  ADD KEY productRef (idProduct),
  ADD KEY idTask (idTask);

ALTER TABLE products
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY name (name) USING HASH,
  ADD UNIQUE KEY name_2 (name) USING HASH,
  ADD KEY type (type);

ALTER TABLE role
  ADD PRIMARY KEY (id);

ALTER TABLE tasks
  ADD PRIMARY KEY (id),
  ADD KEY idEstimate (idEstimate) USING BTREE;

ALTER TABLE type
  ADD PRIMARY KEY (id);

ALTER TABLE users
  ADD PRIMARY KEY (id),
  ADD KEY role (role);


ALTER TABLE customer
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE estimate
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE productbytask
  MODIFY idProductByTask int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE products
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE role
  MODIFY id tinyint(4) NOT NULL AUTO_INCREMENT;

ALTER TABLE tasks
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE type
  MODIFY id tinyint(4) NOT NULL AUTO_INCREMENT;

ALTER TABLE users
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE estimate
  ADD CONSTRAINT customer FOREIGN KEY (idCustomer) REFERENCES customer (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT estimate_ibfk_1 FOREIGN KEY (driver) REFERENCES `users` (id);

ALTER TABLE productbytask
  ADD CONSTRAINT productRef FOREIGN KEY (idProduct) REFERENCES products (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT productbytask_ibfk_1 FOREIGN KEY (idTask) REFERENCES tasks (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE products
  ADD CONSTRAINT products_ibfk_1 FOREIGN KEY (type) REFERENCES type (id);

ALTER TABLE tasks
  ADD CONSTRAINT tasks_ibfk_1 FOREIGN KEY (idEstimate) REFERENCES estimate (id);

ALTER TABLE users
  ADD CONSTRAINT users_ibfk_1 FOREIGN KEY (role) REFERENCES role (id) ON DELETE CASCADE ON UPDATE CASCADE;
