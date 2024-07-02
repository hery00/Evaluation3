<?php

namespace App\Controllers;

use App\Models\ResetDataModel;
use App\Models\ResetDataServices;

class ResetData_Controller extends BaseController
{
    public function resetData()
    {   
        // Obtenez la connexion à la base de données
        $db = db_connect();

        // Créez une instance du service de réinitialisation de la base de données en passant la connexion
        $dbResetService = new ResetDataModel($db);


        // Exécutez la réinitialisation des données
        $dbResetService->resetData();
        $data = [
            'content' => view('Pages/import')
        ];
        return view('LayoutAdmin/layout',$data);
    
    }
}
