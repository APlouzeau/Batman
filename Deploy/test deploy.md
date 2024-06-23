SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE customer (
  id int(11) NOT NULL,
  nameCustomer tinytext NOT NULL,
  adress text DEFAULT NULL,
  mailGeneric tinytext DEFAULT NULL,
  siren varchar(14) DEFAULT NULL,
  nameContact tinytext DEFAULT NULL,
  mailContact tinytext DEFAULT NULL,
  adressContact text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO customer (id, nameCustomer, adress, mailGeneric, siren, nameContact, mailContact, adressContact) VALUES
(23, 'Bouygues construct', '3 rue des constructeurs', 'bouygues@bouygues.com', '12345678912345', 'Norman', 'norman@bouygues.com', '3 rue des constructeurs'),
(24, 'Eiffage construct', '3 allée des sapins', 'eiffage@eiffage.com', '98765432109876', 'Oswald', 'oswald@eiffage.com', '3 allée des sapins'),
(25, 'SOGEA', '15 chemin de terre', 'sogea@sogea.com', '57894610258467', 'Rozenblummentalovitch', 'Rozenblummentalovitch@sogea.com', '15 chemin de terre'),
(26, 'DOE Construction', '3 rue du dodo', 'doe@doe.fr', '51479238465217', 'John Doe', 'John@doe.fr', '2 rue du dodo'),
(28, 'Smith & Wesson', '44 rue du champs de tir', 'sw@sw.fr', '54986325875698', 'Smith', 'smith@sw.fr', '42 rue du champs de tir'),
(32, 'Un test', '2 rue du test', 'dadza@fzefze.fr', '12345678901234', 'alex', 'test@mailfr', 'alextest'),
(46, 'test client', 'dazdazda', 'dazdazda@dzadaz.fr', '12378912378945', 'dbyazudbazu', 'dazdazda@dzadaz.fr', 'fbnezifze');

CREATE TABLE estimate (
  id int(11) NOT NULL,
  nameEstimate tinytext NOT NULL,
  date date NOT NULL DEFAULT current_timestamp(),
  idCustomer int(11) NOT NULL,
  driver int(11) DEFAULT NULL,
  imput int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO estimate (id, nameEstimate, date, idCustomer, driver, imput) VALUES
(240, 'Exemple démonstration', '2024-06-21', 25, 8, 2406001),
(241, 'exemple ajax', '2024-06-21', 25, NULL, NULL),
(242, 'test main d\'oeuvre', '2024-06-22', 23, 10, 2406002),
(243, 'Test MO 2', '2024-06-23', 25, 8, 2406003),
(244, 'test MO 3', '2024-06-23', 25, 9, 2406004);

CREATE TABLE productbytask (
  idProductByTask int(11) NOT NULL,
  row int(11) NOT NULL,
  idProduct int(11) NOT NULL,
  idTask int(11) NOT NULL,
  quantityProduct decimal(10,2) NOT NULL,
  unit tinytext DEFAULT NULL,
  unitPriceProduct decimal(10,2) NOT NULL,
  situation int(11) NOT NULL DEFAULT 0,
  expense decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO productbytask (idProductByTask, row, idProduct, idTask, quantityProduct, unit, unitPriceProduct, situation, expense) VALUES
(1807, 1, 37, 977, 100.00, 'm²', 2.89, 100, 300.00),
(1808, 2, 38, 977, 100.00, 'm²', 6.46, 50, 323.00),
(1809, 3, 43, 977, 50.00, 'ml', 45.00, 25, 690.00),
(1810, 1, 43, 978, 75.00, 'ml', 45.00, 25, 900.00),
(1842, 1, 64, 1004, 30.00, 'Kg', 2.03, 50, 30.45),
(1843, 2, 65, 1004, 0.30, 'h', 30.00, 50, 0.15),
(1844, 3, 37, 1004, 100.00, 'm²', 2.89, 50, 144.50),
(1845, 4, 65, 1004, 7.00, 'h', 30.00, 50, 3.50),
(1846, 5, 63, 1004, 100.00, 'm²', 3.40, 50, 170.00),
(1847, 6, 65, 1004, 7.00, 'h', 30.00, 50, 4.50),
(1925, 1, 64, 1019, 30.00, 'Kg', 2.03, 100, 60.90),
(1926, 2, 65, 1019, 0.30, 'h', 30.00, 100, 0.30),
(1927, 3, 37, 1019, 100.00, 'm²', 2.89, 100, 300.00),
(1928, 4, 65, 1019, 7.00, 'h', 30.00, 100, 6.50),
(1929, 5, 56, 1019, 100.00, 'm²', 3.04, 50, 152.00),
(1930, 6, 65, 1019, 7.00, 'h', 30.00, 50, 3.50),
(1931, 1, 64, 1020, 15.00, 'Kg', 2.03, 100, 30.45),
(1932, 2, 65, 1020, 0.15, 'h', 30.00, 100, 0.15),
(1933, 3, 37, 1020, 50.00, 'm²', 2.89, 100, 150.00),
(1934, 4, 65, 1020, 3.50, 'h', 30.00, 100, 3.00),
(1935, 5, 63, 1020, 50.00, 'm²', 3.40, 0, 0.00),
(1936, 6, 65, 1020, 3.50, 'h', 30.00, 0, 0.00),
(1937, 1, 64, 1021, 60.00, 'Kg', 2.03, 100, 121.80),
(1938, 2, 65, 1021, 0.60, 'h', 30.00, 100, 0.60),
(1939, 3, 37, 1021, 200.00, 'm²', 2.89, 100, 578.00),
(1940, 4, 65, 1021, 14.00, 'h', 30.00, 100, 14.00),
(1941, 5, 56, 1021, 200.00, 'm²', 3.04, 100, 610.00),
(1942, 6, 65, 1021, 14.00, 'h', 30.00, 100, 14.00),
(1943, 1, 64, 1022, 45.00, 'Kg', 2.03, 100, 91.35),
(1944, 2, 65, 1022, 4.50, 'h', 30.00, 100, 4.50),
(1945, 3, 37, 1022, 150.00, 'm²', 2.89, 100, 433.50),
(1946, 4, 65, 1022, 10.50, 'h', 30.00, 100, 10.50),
(1947, 5, 63, 1022, 150.00, 'm²', 3.40, 50, 262.50),
(1948, 6, 65, 1022, 10.50, 'h', 30.00, 50, 5.00);

CREATE TABLE products (
  id int(11) NOT NULL,
  type tinyint(4) NOT NULL,
  name tinytext NOT NULL,
  length tinyint(4) DEFAULT NULL,
  recovery float DEFAULT NULL,
  summary tinytext DEFAULT NULL,
  descriptionProduct varchar(500) DEFAULT NULL,
  price decimal(10,2) NOT NULL,
  unit tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO products (id, type, name, length, recovery, summary, descriptionProduct, price, unit) VALUES
(37, 1, 'ELASTOVAP', 7, 60, '', 'Élastovap est une feuille d’étanchéité constituée d’une armature en voile de verre et de bitume élastomère.', 2.89, 'm²'),
(38, 1, 'CHAPE ATLAS AR', 7, 60, 'Chape Atlas AR est une chape souple de bitume élastomère armée par grille de verre – voile de verre.', 'Chape Atlas AR est une chape souple de bitume élastomère avec une armature grille de verre et voile de verre. Soudé en plein, il et utilisé comme pare-vapeur pour les toitures-terrasses en béton ou comme couche de finition autoprotégée pour les relevés d\'étanchéité. Le coloris Blanc Chagall avec un SRI de 59, fait partie de notre offre d\'étanchéité Cool Roof.', 6.46, 'm²'),
(43, 2, 'COUVERTINE', 3, 20, 'Une couvertine', 'De l\'alu en général', 45.00, 'ml'),
(56, 1, 'ELASTOPHENE FLAM 25', 7, 60, 'ELASTOPHENE FLAM 25 est une feuille d’étanchéité soudable, constituée d’une armature en voile de verre\r\net de bitume élastomère. ', 'ELASTOPHENE FLAM 25 est utilisée en complexe bicouche, soit somme première couche, soit comme\r\ndeuxième couche avec protection rapportée.\r\nLes emplois sont ceux décrits dans les Documents Techniques d’Application et Cahiers de Prescriptions de\r\nPose SOPREMA en vigueur. ', 3.04, 'm²'),
(62, 1, 'EQUERRE 0,25', 10, 60, 'Equerres de renfort', 'Les équerres servent de renfort aux relevés d\'étanchéité.', 135.00, 'm²'),
(63, 1, 'ELASTOPHENE FLAM 25 AR', 70, 60, 'test', 'test', 3.40, 'm²'),
(64, 1, 'SOPRADERE', 0, 0, 'EIF', 'Vernis d\'imprégnation à froid', 2.03, 'Kg'),
(65, 5, 'Main d\'oeuvre', 0, 0, '', NULL, 30.00, 'h');

CREATE TABLE `role` (
  id tinyint(4) NOT NULL,
  role varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tasks (id, idEstimate, taskNumber, descriptionTask, quantity, unitPrice) VALUES
(977, 240, 0, 'Etanchéité de terrasse inaccessible non isolée auto-protégée', NULL, NULL),
(978, 240, 1, 'Couvertine d\'acrotère sur mur mitoyen', NULL, NULL),
(1004, 242, 0, 'tache 1', NULL, NULL),
(1019, 243, 0, 'etanchéité de terrasse inaccessible sous gravillons', NULL, NULL),
(1020, 243, 1, 'etanchéité de terrasse inaccessible autoprotégée', NULL, NULL),
(1021, 244, 0, 'tache 1', NULL, NULL),
(1022, 244, 1, 'tache 2', NULL, NULL);

CREATE TABLE `type` (
  id tinyint(4) NOT NULL,
  name tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO type (id, name) VALUES
(1, 'ETANCHEITE'),
(2, 'ZINGUERIE'),
(5, 'MO');

CREATE TABLE users (
  id int(11) NOT NULL,
  name tinytext NOT NULL,
  firstName tinytext NOT NULL,
  mail varchar(200) NOT NULL,
  password varchar(60) NOT NULL,
  role tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users (id, name, firstName, mail, password, role) VALUES
(1, 'Plouz', 'Alex', 'eyola@gmail.com', '$2y$10$4X9QIWNSQglZZqu0X7g8/eYE4mghvs9yhzeTZg.MzCkXUhkFAcS52', 6),
(6, 'Ronron', 'Siphy', 'ronron.siphy@gmail.com', '$2y$10$YNMLobOQk0QtnUiDCqxEweWVWwaWxqes59vlbLo.5eO/61KAs1te2', 6),
(8, 'conduc', '1', 'conduc1@gmail.com', '$2y$10$N4jTHif0oCytTvuLnpePNe9NKWWV3liYurqwVfyUvAzqwhpYbxCxu', 2),
(9, 'secteur', '2', 'secteur2@gmail.com', '$2y$10$3e4bDDFI.8ltFh7pI6LyJ.1XM9QhlsWVmWYS7W7iTg8yoAKo8wyUq', 4),
(10, 'agence', '3', 'agence@gmail.com', '$2y$10$0t4Qbw7jeLReEtQSOh9ik.bIYOaA8kJMwITC8Kw9eBPhJ4O0T/esG', 5),
(12, 'Lucas', 'Dinot', 'shass@gmail.com', '$2y$10$DbKSnyMkfqJBuU6.G8XI1u7PKDhBMvbXlpvuW3CxbwhG8gsw/da1K', 6),
(13, 'Cédric', 'Cilia', 'analway@gmail.com', '$2y$10$TMltw7GMcWmpR0nseyOEy.9AFCzTloLymztCbUVDwjmzgZU6Gq7zW', 2),
(14, 'Laure', 'Connasse', 'connasse@gmail.com', '$2y$10$QQyk4IQBQMCctEX3IZRmhuvXIe6LcKZr7ebqYn/n.CJP9o3sbUpby', 1),
(15, 'compta', 'compta', 'compta@gmail.com', '$2y$10$ynYB9LkSNN3l/n30WT8kGedxwodB1YhVPZ3WqZTq23nkJ1oJ6l0gK', 3);


ALTER TABLE customer
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY siren (siren);
ALTER TABLE customer ADD FULLTEXT KEY nameCustomer (nameCustomer,adress,mailGeneric,siren,nameContact,mailContact,adressContact);

ALTER TABLE estimate
  ADD PRIMARY KEY (id),
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
