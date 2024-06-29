<?php

namespace App\Controllers;

use App\Models\PenaliteModel;
use App\Models\EtapesModel;
use App\Models\EquipeModel;
use CodeIgniter\Controller;

class PenaliteController extends Controller
{
    public function GetAllPenalite()
    {
        $penaliteModel = new PenaliteModel();
        $data['penalites'] = $penaliteModel->getAllPenalites();
        $data = [
            'content' => view('Pages/listepenalite',$data)
        ];
        return view('Layout_Admin/layout',$data);
    }

    public function forminsert()
    {
        $etape = new EtapesModel();
        $equipe = new EquipeModel();
        $data['etapes']=$etape->getAllEtapes();
        $data['equipes']=$equipe->getAllEquipes();
        $data = [
            'content' => view('Pages/formpenalite',$data)
        ];
        return view('Layout_Admin/layout',$data);
    }

    public function edit($id)
    {
        $penaliteModel = new PenaliteModel();
        $data['penalite'] = $penaliteModel->find($id);

        return view('penalite/edit', $data);
    }

    public function update($id)
    {
        $penaliteModel = new PenaliteModel();

        $data = [
            'nom_etape' => $this->request->getPost('nom_etape'),
            'nom_equipe' => $this->request->getPost('nom'),
            'Penalite' => $this->request->getPost('Penalite')
        ];

        $penaliteModel->update($id, $data);

        return redirect()->to('/penalite');
    }

    public function delete($id)
    {
        $penaliteModel = new PenaliteModel();
        $penaliteModel->delete($id);

        return redirect()->to('/penalite');
    }
}
