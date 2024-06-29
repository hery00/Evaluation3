create table admin
(
    id_admin serial primary key not null,
    nom VARCHAR(255),
    login VARCHAR(50),
    passe VARCHAR(255)
);


CREATE TABLE propriétaire (
    id_proprietaire SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    telephone VARCHAR(20) NOT NULL
);

CREATE TABLE client (
    id_client SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);

CREATE TABLE typedebien (
    id_typebien SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    commission DECIMAL(5,2)
);

CREATE TABLE bien (
    id_bien SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    region VARCHAR(255) NOT NULL,
    loyer_par_mois DECIMAL(10, 2) NOT NULL,
    id_proprietaire INTEGER NOT NULL,
    id_typebien INTEGER NOT NULL,
    FOREIGN KEY (id_proprietaire) REFERENCES propriétaire(id_proprietaire),
    FOREIGN KEY (id_typebien) REFERENCES typedebien(id_typebien)
);

CREATE TABLE photos(
    id_photo serial primary key,
    id_bien INTEGER,
    nom VARCHAR(255),
    FOREIGN KEY(id_bien) REFERENCES bien(id_bien)
);

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



