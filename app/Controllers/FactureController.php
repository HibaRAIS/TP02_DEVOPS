<?php
namespace App\Controllers;

use App\Models\FactureModel;

class FactureController extends BaseController
{
    public function index()
    {
        $model = new FactureModel();
        $data['factures'] = $model->findAll();
        return view('facture_list', $data);
    }

    public function create()
    {
        return view('create_facture');
    }
}
?>
