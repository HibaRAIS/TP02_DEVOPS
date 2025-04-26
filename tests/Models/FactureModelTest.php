<?php

namespace App\Tests\Models;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\FactureModel;
use Config\Services;

class FactureModelTest extends CIUnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Rafraîchit la base de données et exécute toutes les migrations
        command('migrate:refresh');

        // Facultatif : vider le cache ou initialiser un environnement si nécessaire
    }

    public function testFindAllFactures()
    {
        $model = new FactureModel();
        $result = $model->findAll();

        $this->assertIsArray($result);  // vérifie que la réponse est bien un tableau
    }

    public function testInsertFacture()
    {
        $model = new FactureModel();

        $data = [
            'numero'        => 'F001',
            'date'          => '2025-04-23',
            'client'        => 'Client Test',
            'montant_total' => 150.00,
        ];

        $inserted = $model->insert($data);

      
        $this->assertIsInt($inserted); // On attend un ID entier
        $this->assertGreaterThan(0, $inserted);
    }
}
