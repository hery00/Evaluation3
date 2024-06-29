<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CoureurModel;
use CodeIgniter\HTTP\ResponseInterface;

class CoureurController extends BaseController
{

    public function getCoureurByEquipe()
    {
        $session = session();  
        $id_equipe = $session->get('id_user');
        $id_etape = $this->request->getGet('idetape');
        $nb_coureur = $this->request->getGet('nbcoureur');
        // get idetape avy any anaty sessions
        if ($session->get('id_etape')==null &&($session->get('nb_coureur'))) {
        $session->set('id_etape',$id_etape);
        $session->set('nb_coureur',$nb_coureur);
    }

        $CoureurModel = new CoureurModel();
        if(isset($_GET['idcategorie']))
        {
            $idcategorie = $_GET['idcategorie'];
            $data['coureurs']= $CoureurModel->getCoureurByCategorie($id_equipe,$idcategorie);
        }
        else{
            $data['coureurs'] = $CoureurModel->getCoureurByEquipe($id_equipe);
        }
       
        $data = [
            'content' => view('Pages/coureurparequipe',$data)
        ];
        return view('Layout/layout',$data);
    }

    
}
