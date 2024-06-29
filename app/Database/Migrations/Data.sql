create table admin
(
    id_admin serial primary key not null,
    nom VARCHAR(255),
    login VARCHAR(50),
    passe VARCHAR(255)
);

INSERT INTO admin (nom, login, passe) VALUES ('Admin', 'admin@gmail.com', '123');

create table type_user(
    id_type_user serial primary key,
    nom VARCHAR(255)
);

INSERT INTO type_user (nom) VALUES ('Professionnel');
INSERT INTO type_user (nom) VALUES ('Particulier');

CREATE TABLE proprietaire (
    id_proprietaire SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    id_type_user INTEGER,
    foreign key(id_type_user) references type_user(id_type_user)
);

INSERT INTO proprietaire (nom,telephone,id_type_user) VALUES ('Rakoto','335102567',1);
INSERT INTO proprietaire (nom,telephone,id_type_user) VALUES ('Fanirina','341202496',1);

CREATE TABLE client
(
    id_client SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    id_type_user INTEGER,
    foreign key(id_type_user) references type_user(id_type_user)
);

INSERT INTO client (nom,email,id_type_user) VALUES ('Randria','randria@gmail.com',1);
INSERT INTO client (nom,email,id_type_user) VALUES ('Rajao','rajao@gmail.com',1);

CREATE TABLE typedebien 
(
    id_typebien SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    commission DECIMAL(5,2)
);

INSERT INTO typedebien (nom,commission) VALUES ('Immeuble',30);
INSERT INTO typedebien (nom,commission) VALUES ('Appartement',20);
INSERT INTO typedebien (nom,commission) VALUES ('trano',10);


CREATE TABLE bien (
    id_bien SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    region VARCHAR(255) NOT NULL,
    loyer_par_mois DECIMAL(10, 2) NOT NULL,
    id_proprietaire INTEGER NOT NULL,
    id_typebien INTEGER NOT NULL,
    FOREIGN KEY (id_proprietaire) REFERENCES proprietaire(id_proprietaire),
    FOREIGN KEY (id_typebien) REFERENCES typedebien(id_typebien)
);


-- Insertion d'un immeuble
INSERT INTO bien (nom, description, region, loyer_par_mois, id_proprietaire, id_typebien) 
VALUES ('Immeuble de la Plaine', 'Un grand immeuble avec 10 appartements.', 'Antananarivo', 5000.00, 1, 1);

-- Insertion d'un appartement
INSERT INTO bien (nom, description, region, loyer_par_mois, id_proprietaire, id_typebien) 
VALUES ('Appartement de l''Avenue', 'Un appartement spacieux avec vue sur l''avenue principale.', 'Fianarantsoa', 800.00, 2, 2);

-- Insertion d'une maison traditionnelle (Trano)
INSERT INTO bien (nom, description, region, loyer_par_mois, id_proprietaire, id_typebien) 
VALUES ('Maison Traditionnelle', 'Une maison traditionnelle malgache avec un grand jardin.', 'Toamasina', 300.00, 1, 3);


CREATE TABLE photos(
    id_photo serial primary key,
    id_bien INTEGER,
    nom VARCHAR(255),
    FOREIGN KEY(id_bien) REFERENCES bien(id_bien)
);

INSERT INTO photos (id_bien,nom) VALUES (1,'appart1.jpg');
INSERT INTO photos (id_bien,nom) VALUES (1,'appart2.jpg');
INSERT INTO photos (id_bien,nom) VALUES (1,'appart3.jpg');
INSERT INTO photos (id_bien,nom) VALUES (1,'appart4.jpg');

CREATE TABLE location (
    id_location SERIAL PRIMARY KEY,
    id_bien INTEGER NOT NULL,
    id_client INTEGER NOT NULL,
    date_debut DATE NOT NULL,
    duree INTEGER NOT NULL,
    FOREIGN KEY (id_bien) REFERENCES bien(id_bien),
    FOREIGN KEY (id_client) REFERENCES client(id_client)
);

CREATE TABLE paiementloyer(
    id_paiement SERIAL PRIMARY KEY,
    id_location INTEGER NOT NULL,
    date_paiement DATE NOT NULL,
    loyer_a_paye DECIMAL(10, 2),
    loyer_paye DECIMAL(10, 2),
    FOREIGN KEY (id_location) REFERENCES location(id_location)
);

CREATE OR REPLACE VIEW commission_admin as
SELECT
    l.id_location,
    l.id_bien,
    b.nom AS nom_bien,
    t.nom AS type_bien,
    b.loyer_par_mois,
    t.commission,
    (b.loyer_par_mois * t.commission / 100) AS gain
FROM
    location l
JOIN
    bien b ON l.id_bien = b.id_bien
JOIN
    typedebien t ON b.id_typebien = t.id_typebien
ORDER BY
    l.id_location;


