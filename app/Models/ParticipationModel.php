<?php
namespace App\Models;

use CodeIgniter\Model;

class ParticipationModel extends Model
{
    protected $table = 'Participation';
    protected $primaryKey = 'id_participation';
    protected $allowedFields = ['id_etape', 'id_coureur', 'id_equipe', 'heure_depart', 'heure_arrivee'];
}
?>
