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
    telephone VARCHAR(20) NOT NULL,
    id_type_user INTEGER,
    foreign key(id_type_user) references type_user(id_type_user)
);

INSERT INTO proprietaire (nom,telephone,id_type_user) VALUES ('Rakoto','335102567',1);
INSERT INTO proprietaire (nom,telephone,id_type_user) VALUES ('Fanirina','341202496',1);

CREATE TABLE client
(
    id_client SERIAL PRIMARY KEY,
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
    reference VARCHAR(100), 
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    region VARCHAR(255) NOT NULL,
    loyer_par_mois DECIMAL(10, 2) NOT NULL,
    id_proprietaire INTEGER NOT NULL,
    id_typebien INTEGER NOT NULL,
    FOREIGN KEY (id_proprietaire) REFERENCES proprietaire(id_proprietaire),
    FOREIGN KEY (id_typebien) REFERENCES typedebien(id_typebien)
);

-- ALTER TABLE bien DROP COLUMN reference;

-- ALTER TABLE bien ADD COLUMN reference VARCHAR(100) AFTER id_bien;



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

INSERT INTO photos (id_bien,nom) VALUES (1,'immeuble1.jpg');
INSERT INTO photos (id_bien,nom) VALUES (1,'immeuble2.jpg');
INSERT INTO photos (id_bien,nom) VALUES (1,'immeuble3.jpg');
INSERT INTO photos (id_bien,nom) VALUES (1,'immeuble4.jpg');

INSERT INTO photos (id_bien,nom) VALUES (2,'appart1.jpg');
INSERT INTO photos (id_bien,nom) VALUES (2,'appart2.jpg');
INSERT INTO photos (id_bien,nom) VALUES (2,'appart3.jpg');
INSERT INTO photos (id_bien,nom) VALUES (2,'appart4.jpg');

INSERT INTO photos (id_bien,nom) VALUES (3,'maison1.jpg');
INSERT INTO photos (id_bien,nom) VALUES (3,'maison2.jpg');
INSERT INTO photos (id_bien,nom) VALUES (3,'maison3.jpg');
INSERT INTO photos (id_bien,nom) VALUES (3,'maison4.jpg');

CREATE OR REPLACE FUNCTION calculate_end_date(start_date DATE, duration INTEGER)
RETURNS DATE AS $$
DECLARE
    end_date DATE;
BEGIN
    -- Calculer la date de fin en ajoutant la durée en mois à la date de début
    end_date := start_date + (duration || ' months')::INTERVAL;
    RETURN end_date;
END;
$$ LANGUAGE plpgsql;


CREATE TABLE location (
    id_location SERIAL PRIMARY KEY,
    id_bien INTEGER NOT NULL,
    id_client INTEGER NOT NULL,
    date_debut DATE NOT NULL,
    duree INTEGER NOT NULL,
    date_fin_prevus DATE,
    FOREIGN KEY (id_bien) REFERENCES bien(id_bien),
    FOREIGN KEY (id_client) REFERENCES client(id_client)
);

CREATE OR REPLACE FUNCTION update_date_fin_prevus()
RETURNS TRIGGER AS $$
BEGIN
    NEW.date_fin_prevus := calculate_end_date(NEW.date_debut, NEW.duree);
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_update_date_fin_prevus
BEFORE INSERT OR UPDATE ON location
FOR EACH ROW
EXECUTE FUNCTION update_date_fin_prevus();

INSERT INTO location (id_bien, id_client, date_debut, duree)
VALUES (1, 1, '2024-07-01', 12); -- Id_bien = 1, Id_client = 1, Date de début = 1er juillet 2024, Durée = 12 mois

-- Exemple 2
INSERT INTO location (id_bien, id_client, date_debut, duree)
VALUES (2, 2, '2024-08-15', 6); -- Id_bien = 2, Id_client = 2, Date de début = 15 août 2024, Durée = 6 mois

-- Exemple 3
INSERT INTO location (id_bien, id_client, date_debut, duree)
VALUES (3, 1, '2024-09-10', 3);

CREATE TABLE paiementloyer(
    id_paiement SERIAL PRIMARY KEY,
    id_location INTEGER NOT NULL,
    date_paiement DATE NOT NULL,
    loyer_paye DECIMAL(10, 2),
    FOREIGN KEY (id_location) REFERENCES location(id_location)
);


-- Paiements pour la location avec id_location = 1
INSERT INTO paiementloyer (id_location, date_paiement, loyer_paye) VALUES (1, '2024-01-15', 500.00);
INSERT INTO paiementloyer (id_location, date_paiement, loyer_paye) VALUES (1, '2024-02-15', 500.00);
INSERT INTO paiementloyer (id_location, date_paiement, loyer_paye) VALUES (1, '2024-03-15', 500.00);

-- Paiements pour la location avec id_location = 2
INSERT INTO paiementloyer (id_location, date_paiement, loyer_paye) VALUES (2, '2024-01-10', 750.00);
INSERT INTO paiementloyer (id_location, date_paiement, loyer_paye) VALUES (2, '2024-02-10', 750.00);
INSERT INTO paiementloyer (id_location, date_paiement, loyer_paye) VALUES (2, '2024-03-10', 750.00);

-- Paiements pour la location avec id_location = 3
INSERT INTO paiementloyer (id_location, date_paiement, loyer_paye) VALUES (3, '2024-01-20', 600.00);
INSERT INTO paiementloyer (id_location, date_paiement, loyer_paye) VALUES (3, '2024-02-20', 600.00);
INSERT INTO paiementloyer (id_location, date_paiement, loyer_paye) VALUES (3, '2024-03-20', 600.00);

-- Paiements pour la location avec id_location = 4
INSERT INTO paiementloyer (id_location, date_paiement, loyer_paye) VALUES (4, '2024-01-05', 800.00);
INSERT INTO paiementloyer (id_location, date_paiement, loyer_paye) VALUES (4, '2024-02-05', 800.00);
INSERT INTO paiementloyer (id_location, date_paiement, loyer_paye) VALUES (4, '2024-03-05', 800.00);


CREATE TABLE import_bien (
    reference VARCHAR(50),
    nom VARCHAR(255),
    description TEXT,
    type VARCHAR(50),
    region VARCHAR(50),
    loyer_mensuel INTEGER,
    proprietaire VARCHAR(50)
);

CREATE TABLE import_location (
    reference VARCHAR(50),
    date_debut DATE NOT NULL,
    duree INTEGER,
    client VARCHAR(50)
);

CREATE TABLE import_commission (
    nom VARCHAR(50),
    commission DECIMAL(5,2)
);

CREATE TABLE detail_locations (
    id SERIAL PRIMARY KEY,
    id_location INT NOT NULL,
    id_client INT NOT NULL,
    id_bien INT NOT NULL,
    duree INT NOT NULL,
    date_debut DATE NOT NULL,
    date_fin_prevus DATE NOT NULL,
    loyer_par_mois DECIMAL(10, 2) NOT NULL,
    commission DECIMAL(5, 2) NOT NULL,
    montant_commission DECIMAL(10, 2) NOT NULL,
    CA_admin DECIMAL(10, 2) NOT NULL,
    CA_proprio DECIMAL(10, 2) NOT NULL,
    type_bien VARCHAR(255) NOT NULL,
    id_proprietaire INT NOT NULL,
    initial_payment_date DATE NOT NULL,
    payment_date DATE NOT NULL,
    num_mois INT NOT NULL,
    mois INT NOT NULL
);


