<?php
namespace App\Controllers;

use App\Models\EtapesModel;
use App\Models\ParticipantModel;
use DateTime;


class ParticipationController extends BaseController
{
    public function index()
    {
        $data = [
            'content' => view('Pages/formulaire_temps')
        ];
        return view('Layout_Admin/layout',$data);
    }



public function formUpdateArrivee()

{
    $participationmodel = new ParticipantModel();
    $id_participation = $this->request->getGet('idparticipation');
    $data['participation'] = $participationmodel->getParticipationsById($id_participation);

    $data['content'] = view('Pages/forminsertdate',$data);
    return view('Layout_Admin/layout',$data);
}


public function updateArrivee()
    {
        $etapemodel = new EtapesModel();
        $model = new ParticipantModel();

        $id_etape = $this->request->getGet('idetape');
        $id_coureur = $this->request->getGet('idcoureur');
        $id_equipe = $this->request->getGet('idequipe');
        $date = $this->request->getGet('date');
        $time = $this->request->getGet('time');
        $nouvelle_arrivee = $date . ' ' . $time;

        $etape = $etapemodel->find($id_etape);

        $nouvelleArriveeDateTime = new DateTime($nouvelle_arrivee);
        $departDateTime = new DateTime($etape['depart']);

        if ($nouvelleArriveeDateTime < $departDateTime) {
            return redirect()->to('/formupdatearrivee')->with('error', 'Il faut insérer une date supérieure à ' . $etape['depart']);
        }

        // Debugging: Print the parameters being passed to the model
        log_message('debug', 'Parameters: id_etape=' . $id_etape . ', id_coureur=' . $id_coureur . ', id_equipe=' . $id_equipe . ', nouvelle_arrivee=' . $nouvelle_arrivee);

        $model->updateArrivee($id_etape, $id_coureur, $id_equipe, $nouvelle_arrivee);

        return redirect()->to('/listetapeadmin')->with('success', 'Heure d\'arrivée mise à jour avec succès.');
    }
    
}

?>