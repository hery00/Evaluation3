
CREATE OR REPLACE VIEW v_location_bien_type AS
SELECT
    b.id_bien,
    b.reference,
    b.id_proprietaire,
    b.nom AS nom_bien,
    b.description,
    b.region,
    b.loyer_par_mois,
    t.nom AS nom_typebien,
    t.commission,
    l.id_location,
    l.id_client,
    c.email AS email,
    p.telephone,
    l.date_debut,
    l.duree
FROM location l
JOIN bien b ON b.id_bien = l.id_bien
JOIN proprietaire p ON b.id_proprietaire = p.id_proprietaire
JOIN typedebien t ON b.id_typebien = t.id_typebien
JOIN client c ON l.id_client = c.id_client;



CREATE OR REPLACE VIEW v_detail_locations as
SELECT
    EXTRACT(YEAR FROM payment_date) AS annee,
    EXTRACT(MONTH FROM payment_date) AS num_mois,
    TO_CHAR(payment_date, 'MON') AS mois,
    SUM(ca_admin) AS total_ca_admin,
    SUM(ca_proprio) AS total_ca_proprio,
    SUM(montant_commission) AS total_montant_commission,
    payment_date,
    id_proprietaire
FROM
    detail_locations
GROUP BY
    EXTRACT(YEAR FROM payment_date),
    EXTRACT(MONTH FROM payment_date),
    TO_CHAR(payment_date, 'MON'),
    payment_date,
    id_proprietaire
ORDER BY
    EXTRACT(YEAR FROM payment_date),
    EXTRACT(MONTH FROM payment_date);


  