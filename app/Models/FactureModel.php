<?php

namespace App\Models;

use CodeIgniter\Model;

class FactureModel extends Model
{
    protected $table            = 'factures';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['numero', 'date', 'client', 'montant_total'];

    protected $useTimestamps    = false;

    protected $validationRules = [
        'numero'        => 'required|max_length[50]',
        'date'          => 'required|valid_date',
        'client'        => 'required|max_length[255]',
        'montant_total' => 'required|numeric',
    ];

    protected $validationMessages = [
        'numero' => [
            'required'   => 'Le numéro est obligatoire',
            'max_length' => 'Le numéro ne doit pas dépasser 50 caractères',
        ],
        'date' => [
            'required'    => 'La date est obligatoire',
            'valid_date'  => 'La date doit être au format valide',
        ],
        'client' => [
            'required'   => 'Le nom du client est obligatoire',
            'max_length' => 'Le nom du client ne doit pas dépasser 255 caractères',
        ],
        'montant_total' => [
            'required' => 'Le montant est obligatoire',
            'numeric'  => 'Le montant doit être un nombre',
        ],
    ];

    protected $skipValidation = false;
}
