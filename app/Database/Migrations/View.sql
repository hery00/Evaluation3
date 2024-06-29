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
