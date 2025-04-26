<?php

namespace App\Tests\Models;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\FactureModel;

class FactureModelTest extends CIUnitTestCase
{
    protected $model;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new FactureModel();
    }

    public function testFindAllFactures()
    {
        $result = $this->model->findAll();
        $this->assertIsArray($result);
    }

    public function testInsertFacture()
    {
        $data = [
            'numero'        => 'F001',
            'date'          => '2025-04-23',
            'client'        => 'Client Test',
            'montant_total' => 150.00,
        ];

        $inserted = $this->model->insert($data);
        $this->assertIsInt($inserted);
        $this->assertGreaterThan(0, $inserted);
    }

    public function testFindFactureById()
    {
        $id = $this->model->insert([
            'numero'        => 'F002',
            'date'          => '2025-04-24',
            'client'        => 'Client ABC',
            'montant_total' => 200.00,
        ]);

        $facture = $this->model->find($id);

        $this->assertNotNull($facture);
        $this->assertEquals('F002', $facture['numero']);
    }

    public function testUpdateFacture()
    {
        $id = $this->model->insert([
            'numero'        => 'F003',
            'date'          => '2025-04-25',
            'client'        => 'Client XYZ',
            'montant_total' => 250.00,
        ]);

        $updateData = [
            'montant_total' => 300.00,
        ];

        $updated = $this->model->update($id, $updateData);
        $this->assertTrue($updated);

        $facture = $this->model->find($id);
        $this->assertEquals(300.00, $facture['montant_total']);
    }

    public function testDeleteFacture()
    {
        $id = $this->model->insert([
            'numero'        => 'F004',
            'date'          => '2025-04-26',
            'client'        => 'Client Delete',
            'montant_total' => 100.00,
        ]);

        $deleted = $this->model->delete($id);
        $this->assertTrue($deleted);

        $facture = $this->model->find($id);
        $this->assertNull($facture);
    }

    public function testInsertInvalidFacture()
    {
        $data = [
            'numero' => 'F005',
            'date'   => '2025-04-27',
            'client' => 'Client Invalide',
            // montant_total est manquant
        ];

        $result = $this->model->insert($data);
        $this->assertFalse($result);

        $errors = $this->model->errors();
        $this->assertArrayHasKey('montant_total', $errors);
    }

    public function testInsertFactureWithTooLongNumero()
    {
        $data = [
            'numero'        => str_repeat('X', 60),
            'date'          => '2025-04-28',
            'client'        => 'Client LongNum',
            'montant_total' => 100.00,
        ];

        $result = $this->model->insert($data);
        $this->assertFalse($result);

        $errors = $this->model->errors();
        $this->assertArrayHasKey('numero', $errors);
    }

    public function testInsertFactureWithInvalidDate()
    {
        $data = [
            'numero'        => 'F006',
            'date'          => 'invalid-date',
            'client'        => 'Client Date',
            'montant_total' => 100.00,
        ];

        $result = $this->model->insert($data);
        $this->assertFalse($result);

        $errors = $this->model->errors();
        $this->assertArrayHasKey('date', $errors);
    }
}
