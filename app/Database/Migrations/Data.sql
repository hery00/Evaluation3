create table admin
(
    id_admin serial primary key not null,
    nom VARCHAR(255),
    login VARCHAR(50),
    passe VARCHAR(255)
);

CREATE TABLE equipe(
   id_equipe serial primary key not null,
   nom VARCHAR(255) ,
   login VARCHAR(50) ,
   passe VARCHAR(255)
);

CREATE TABLE Categorie(
   id_categorie serial primary key not null,
   nom VARCHAR(255)
);

-- Insérer des catégories dans la table Categorie
INSERT INTO Categorie (nom) VALUES ('Homme');
INSERT INTO Categorie (nom) VALUES ('Femme');
INSERT INTO Categorie (nom) VALUES ('Junior');
INSERT INTO Categorie (nom) VALUES ('Senior');
-- Ajoutez d'autres catégories si nécessaire

CREATE TABLE Course(
   id_course serial primary key,
   nom_course VARCHAR(255)
);

INSERT INTO Course (nom_course) VALUES ('Course 1');
INSERT INTO Course (nom_course) VALUES ('Course 2');
INSERT INTO Course (nom_course) VALUES ('Course 3');


CREATE TABLE Etape(
   id_etape serial not null,
   nom VARCHAR(225) ,
   longueur_km NUMERIC(10,2),
   nb_coureur INTEGER,
   rang_etape INTEGER,
   id_course INTEGER,
   depart TIMESTAMP,
   PRIMARY KEY(id_etape),
   FOREIGN KEY(id_course) REFERENCES Course(id_course)
);

INSERT INTO Etape (nom, longueur_km, nb_coureur, rang_etape, id_course, depart) 
VALUES 
('Betsizaraina', 150.5, 2, 1, 1, '2024-06-01 08:00:00'),
('Mandrosoa', 120.25, 3, 2, 1, '2024-06-02 09:00:00'),
('Andapa', 120.25, 3, 3, 1, '2024-06-03 10:00:00');


CREATE TABLE Coureur (
    id_coureur SERIAL PRIMARY KEY,
    nom VARCHAR(100) ,
    numero_dossard INTEGER UNIQUE,
    genre VARCHAR(10) ,
    date_naissance DATE ,
    id_equipe INTEGER ,
    FOREIGN KEY (id_equipe) REFERENCES Equipe(id_equipe)
);

-- Insertions d'exemples de coureurs
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('Rakoto', 101, 'Homme', '1990-05-15', 1);
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('Randria', 102, 'Femme', '1992-08-20', 1);
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('Michael', 103, 'Homme', '1988-03-10', 1);
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('Emily Johnson', 104, 'Femme', '1995-11-28', 1);
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('David Brown', 105, 'Homme', '1993-09-17', 1);
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('Sarah Williams', 106, 'Femme', '1991-07-05',1);
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('Daniel Lee', 107, 'Homme', '1987-12-22', 2);
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('Jessica Taylor', 108, 'Femme', '1989-06-12', 2);
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('Ryan Martinez', 109, 'Homme', '1994-04-03', 2);
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('Amanda White', 110, 'Femme', '1996-01-19', 2);
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('Michael Dieu', 111, 'Homme', '1990-08-15', 2);
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('Jennifer Rodriguez', 112, 'Femme', '1992-03-25', 2);
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('Christopher Anderson', 113, 'Homme', '1988-05-10',3);
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('Emma Garcia', 114, 'Femme', '1997-10-08',3);
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('Nicholas Martinez', 115, 'Homme', '1996-12-01',3);
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('Olivia Miller', 116, 'Femme', '1993-02-14',3);
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('William Taylor', 117, 'Homme', '1991-06-30',3);
INSERT INTO Coureur (nom, numero_dossard, genre, date_naissance, id_equipe) VALUES ('Sophia Anderson', 118, 'Femme', '1994-09-23',3);



CREATE TABLE CoureurCategorie (
    id_coureurcategorie serial primary key not null,
    id_coureur INTEGER NOT NULL,
    id_categorie INTEGER NOT NULL,
    id_equipe INTEGER NOT NULL,
    FOREIGN KEY (id_coureur) REFERENCES Coureur(id_coureur),
    FOREIGN KEY (id_equipe) REFERENCES equipe(id_equipe),
    FOREIGN KEY (id_categorie) REFERENCES Categorie(id_categorie)
);



CREATE TABLE Classement (
    id_classement SERIAL PRIMARY KEY,
    id_etape INTEGER NOT NULL,
    id_coureur INTEGER NOT NULL,
    Chronos TIME,
    rang INTEGER NOT NULL,
    FOREIGN KEY (id_etape) REFERENCES Etape(id_etape),
    FOREIGN KEY (id_coureur) REFERENCES Coureur(id_coureur)
);

--ity le DENSE RANK
Create or replace view classement_general as
SELECT
    id_participation,
    id_etape,
    id_coureur,
    etape_nom,
    longueur_km,
    nb_coureur,
    rang_etape,
    coureur_nom,
    numero_dossard,
    date_naissance,
    id_equipe,
    equipe_nom,

    CASE 
        WHEN arrivee IS NULL THEN '' -- Renvoie une chaîne vide si arrivee est nulle
        ELSE (DATE_PART('day', arrivee - depart) * 24 +
            DATE_PART('hour', arrivee - depart))::int || ':' ||
            TO_CHAR(DATE_PART('minute', arrivee - depart), 'FM00') || ':' ||
            TO_CHAR(DATE_PART('second', arrivee - depart), 'FM00')
    END AS Chronos,
    CASE 
        WHEN arrivee IS NOT NULL THEN DENSE_RANK() OVER (PARTITION BY id_etape ORDER BY (arrivee - depart) ASC)
        ELSE NULL -- Renvoie NULL si arrivee est nulle
    END AS rang
FROM vparticipationdetails;


create or replace view point_classement_generale as
SELECT
    cg.*,
    COALESCE(p.points, 0) AS points
FROM
    classement_general cg
LEFT JOIN
    points p ON cg.rang = p.rang_point;

create or replace view point_classement_generale_categorie as
select 
    pcg.id_participation,
    pcg.id_etape,
    cc.id_coureur,
    pcg.etape_nom,
    pcg.longueur_km,
    pcg.nb_coureur,
    pcg.rang_etape,
    pcg.coureur_nom,
    cc.id_categorie,
    c.nom as nom_categorie,
    pcg.numero_dossard,
    pcg.date_naissance,
    pcg.id_equipe,
    pcg.equipe_nom,
    pcg.chronos,
    pcg.rang,
    pcg.points
    FROM point_classement_generale pcg
    JOIN coureurcategorie cc
    ON pcg.id_coureur = cc.id_coureur
    JOIN Categorie c
    ON cc.id_categorie = c.id_categorie;

create table points(
    id_point serial primary key not null,
    rang_point INTEGER,
    points INTEGER
);

INSERT INTO points (rang_point, points)
VALUES
    (1, 10),
    (2, 6),
    (3, 4),
    (4, 2),
    (5, 1);



CREATE TABLE Participation (
    id_participation SERIAL PRIMARY KEY,
    id_etape INTEGER,
    id_coureur INTEGER,
    id_equipe INTEGER,
    arrivee TIMESTAMP,
    FOREIGN KEY (id_etape) REFERENCES Etape(id_etape),
    FOREIGN KEY (id_coureur) REFERENCES Coureur(id_coureur),
    FOREIGN KEY (id_equipe) REFERENCES Equipe(id_equipe)
);

create table penalite(
    id_penalite serial primary key not null,
    nom_etape VARCHAR(255),
    nom_equipe VARCHAR(255),
    penalite TIME
);



--Mandrosoa
-- Équipe A
INSERT INTO Participation (id_etape, id_coureur, id_equipe, heure_depart, heure_arrivee) VALUES (2, 1, 1, '09:00:45', '11:31:30'); -- Lova
INSERT INTO Participation (id_etape, id_coureur, id_equipe, heure_depart, heure_arrivee) VALUES (2, 2, 1, '09:01:20', '11:32:45'); -- Sabrina

-- Équipe B
INSERT INTO Participation (id_etape, id_coureur, id_equipe, heure_depart, heure_arrivee) VALUES (2, 3, 2, '09:16:00', '11:47:25'); -- Justin
INSERT INTO Participation (id_etape, id_coureur, id_equipe, heure_depart, heure_arrivee) VALUES (2, 4, 2, '09:17:35', '11:49:15'); -- Vero

-- Équipe C
INSERT INTO Participation (id_etape, id_coureur, id_equipe, heure_depart, heure_arrivee) VALUES (2, 5, 3, '09:32:40', '12:03:10'); -- John
INSERT INTO Participation (id_etape, id_coureur, id_equipe, heure_depart, heure_arrivee) VALUES (2, 6, 3, '09:34:15', '12:04:55'); -- Jill


--Andapa
-- Équipe A
INSERT INTO Participation (id_etape, id_coureur, id_equipe, heure_depart, heure_arrivee) VALUES (3, 7, 1, '08:02:20', '10:47:10'); -- Victor

-- Équipe B
INSERT INTO Participation (id_etape, id_coureur, id_equipe, heure_depart, heure_arrivee) VALUES (3, 3, 2, '08:17:50', '11:02:40'); -- Justin

-- Équipe C
INSERT INTO Participation (id_etape, id_coureur, id_equipe, heure_depart, heure_arrivee) VALUES (3, 6, 3, '08:33:30', '11:18:20'); -- Jill

create table import_etape (
    etape VARCHAR(225),
    longueur NUMERIC(10,2),
    nb_coureur INTEGER,
    rang_etape INTEGER,
    date_depart DATE,
    heure_depart TIME
);

create table import_resultat(
    etape_rang INTEGER,
    numero_dossard INTEGER,
    nom VARCHAR(225),
    genre VARCHAR(25),
    date_naissance DATE,
    equipe VARCHAR(25),
    arrivee TIMESTAMP
);

create table import_point(
    classement INTEGER,
    points INTEGER
);

CREATE OR REPLACE VIEW vParticipationDetails AS
SELECT 
    p.id_participation,
    p.arrivee,
    e.depart,
    e.id_etape,
    e.nom AS etape_nom,
    e.longueur_km,
    e.nb_coureur,
    e.rang_etape,
    e.id_course,
    c.id_coureur,
    c.nom AS coureur_nom,
    c.numero_dossard,
    c.genre,
    c.date_naissance,
    eq.id_equipe,
    eq.nom AS equipe_nom
FROM 
    Participation p
JOIN 
    Etape e ON p.id_etape = e.id_etape
JOIN 
    Coureur c ON p.id_coureur = c.id_coureur
JOIN 
    Equipe eq ON p.id_equipe = eq.id_equipe;

CREATE OR REPLACE VIEW vEquipe AS 
SELECT e.id_equipe, i.equipe
FROM import_resultat i
JOIN equipe e ON e.nom = i.equipe;