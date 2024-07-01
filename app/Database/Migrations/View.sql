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
    p.id_proprietaire AS id_proprietaire,
    b.nom AS nom_bien,
    b.description,
    b.region,
    b.loyer_par_mois,
    p.nom AS nom_proprietaire,
    t.nom AS nom_typebien,
    t.commission,
    l.id_location,
    l.id_client,
    c.nom AS nom_client,
    l.date_debut,
    l.duree,
    l.date_fin_prevus
FROM location l
JOIN bien b ON b.id_bien = l.id_bien
JOIN proprietaire p ON b.id_proprietaire = p.id_proprietaire
JOIN typedebien t ON b.id_typebien = t.id_typebien
JOIN client c ON l.id_client = c.id_client;

CREATE OR REPLACE VIEW v_location_net AS
SELECT
    b.id_bien,
    p.id_proprietaire AS id_proprietaire,
    b.nom AS nom_bien,
    b.description,
    b.region,
    b.loyer_par_mois,
    p.nom AS nom_proprietaire,
    t.nom AS nom_typebien,
    t.commission,
    l.id_location,
    l.id_client,
    c.nom AS nom_client,
    l.date_debut,
    l.duree,
    l.date_fin_prevus,
    ROUND(b.loyer_par_mois - ((b.loyer_par_mois * commission) / 100), 2) AS loyer_net
FROM location l
JOIN bien b ON b.id_bien = l.id_bien
JOIN proprietaire p ON b.id_proprietaire = p.id_proprietaire
JOIN typedebien t ON b.id_typebien = t.id_typebien
JOIN client c ON l.id_client = c.id_client;
