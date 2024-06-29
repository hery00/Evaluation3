<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ParticipantModel;
use App\Models\CoureurModel;
use App\Models\EtapesModel;
use CodeIgniter\HTTP\ResponseInterface;

class ChoixCoureurController extends BaseController
{
    public function assignerParticipant()
    {
        $session = session();
        $Participant = new ParticipantModel();
        $Coureur = new CoureurModel();
        $Etape = new EtapesModel();
        $id_coureur = $this->request->getGet('id_coureur');
        $id_etape = $this->request->getGet('id_etape');
        $coureur = $Coureur->getCoureurByid($id_coureur);
        $etape = $Etape->getEtapesById($id_etape);
        $isparticipant = $Participant->EfaParticipant($id_etape,$coureur['id_equipe'], $id_coureur);
        if($isparticipant==true)
        {
            $session->setFlashdata('error', 'Certains coureurs ont déjà été choisis.');
            return redirect()->to('/listecoureur');
        }
         elseif($isparticipant==false){
                $countparticipation = $Participant->countparticipant($id_etape, $coureur['id_equipe']);
                if($countparticipation<$etape['nb_coureur']){
                    $Participant->insertParticipation($id_etape, $coureur['id_equipe'], $id_coureur);
                    $session->setFlashdata('error', 'succes');
                    return redirect()->to('/listecoureur');
                }
                elseif($countparticipation>=$etape['nb_coureur']){
                    $session->setFlashdata('error', 'Maximum nombre de Coureur Atteinte');
                    return redirect()->to('/listecoureur');
                }
         }
    }
}
