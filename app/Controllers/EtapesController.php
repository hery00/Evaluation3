<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EtapesModel;
use App\Models\CoureurModel;
use App\Models\ParticipationDetailsModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;


class EtapesController extends BaseController
{

        
    public function getCoureurEtape()
    {
        $session = session();  
        $id_equipe = $session->get('id_user');
        $etapeModel = new EtapesModel();
        $CoureurModel = new CoureurModel();
        $data['etapes'] = $etapeModel->getEtapesByCourse();
        $data['coureurs'] = $CoureurModel->getCoureurByEquipe($id_equipe);
        $data =
        [
            'content' => view('Pages/ListeCoureurEquipe',$data)
        ];
        return view('Layout/layout',$data);
    }
    public function etapesCourseAdmin()
    {
        $id_course = $this->request->getGet('idcourse');
        $data['id_course'] = $id_course;
        $etapeModel = new EtapesModel();
        $data['etapes'] = $etapeModel->getEtapesByCourse($id_course);
        $data =
        [
            'content' => view('Pages/admin_dashboard',$data)
        ];
        return view('Layout_Admin/layout',$data);
    }
    
    
    public function getEtapesdetails()
    {
        $session = session();
        $id_equipe = $session->get('id_user');
        $etapesModel = new EtapesModel();
        $list_etape = $etapesModel->getEtapesByCourse();  
        $participationDetailsModel = new ParticipationDetailsModel();

        $result = [];

        foreach ($list_etape as $etape) {
            $id_etape = $etape['id_etape'];
            $list_participation = $participationDetailsModel->getParticipationsDetailsByEtape($id_etape);
            $result[$id_etape] = [
                'etape' => $etape,
                'participations' => $list_participation
            ];
        }

        $data = [
            'id_equipe' => $id_equipe,
            'result' => $result
        ];

        $pageContent = view('Pages/participationetape', $data);
        $data = ['content' => $pageContent];

        return view('Layout/layout', $data);
    }

    public function getEtapesdetailsAdmin()
    {
        $session = session();
        $etapesModel = new EtapesModel();
        $list_etape = $etapesModel->getEtapesByCourse();  
        $participationDetailsModel = new ParticipationDetailsModel();

        $result = [];

        foreach ($list_etape as $etape)
        {
            $id_etape = $etape['id_etape'];
            $list_participation = $participationDetailsModel->getParticipationsDetailsByEtape($id_etape);
            $result[$id_etape] = [
                'etape' => $etape,
                'participations' => $list_participation
            ];
        }

        $data = [
            'result' => $result
        ];

        $pageContent = view('Pages/ParticipationDetaillerAdmin', $data);
        $data = ['content' => $pageContent];

        return view('Layout_Admin/layout', $data);
    }

}
