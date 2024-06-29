CREATE OR REPLACE VIEW gain_admin as
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


    CREATE OR REPLACE VIEW v_bien_type AS
SELECT
    b.id_bien,
    b.nom AS nom_bien,
    b.description,
    b.region,
    b.loyer_par_mois,
    p.nom AS nom_proprietaire,
    t.nom AS nom_typebien,
    t.commission
FROM bien b
JOIN proprietaire p ON b.id_proprietaire = p.id_proprietaire
JOIN typedebien t ON b.id_typebien = t.id_typebien;


CREATE OR REPLACE VIEW v_location_bien_type AS
SELECT
    b.id_bien,
    p.id_proprietaire as id_proprietaire,
    b.nom AS nom_bien,
    b.description,
    b.region,
    b.loyer_par_mois,
    p.nom AS nom_proprietaire,
    t.nom AS nom_typebien,
    t.commission,
    l.id_location,
    l.id_client,
    l.date_debut,
    l.duree,
    l.date_fin_prevus
FROM bien b
JOIN proprietaire p ON b.id_proprietaire = p.id_proprietaire
JOIN typedebien t ON b.id_typebien = t.id_typebien
LEFT JOIN location l ON b.id_bien = l.id_bien;

CREATE OR REPLACE VIEW v_location_bien_type AS
SELECT
    b.id_bien,
    p.id_proprietaire as id_proprietaire,
    b.nom AS nom_bien,
    b.description,
    b.region,
    b.loyer_par_mois,
    p.nom AS nom_proprietaire,
    t.nom AS nom_typebien,
    t.commission,
    l.id_location,
    l.id_client,
    l.date_debut,
    l.duree,
    l.date_fin_prevus
FROM bien b
JOIN proprietaire p ON b.id_proprietaire = p.id_proprietaire
JOIN typedebien t ON b.id_typebien = t.id_typebien
LEFT JOIN location l ON b.id_bien = l.id_bien;