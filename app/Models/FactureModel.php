<?php
namespace App\Models;

use CodeIgniter\Model;

class FactureModel extends Model
{
    protected $table = 'test_factures';
    protected $primaryKey = 'id';
    protected $allowedFields = ['numero', 'date', 'client', 'montant_total'];
}
?>
