<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFacturesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'auto_increment' => true],
            'numero'         => ['type' => 'VARCHAR', 'constraint' => '50'],
            'date'           => ['type' => 'DATE'],
            'client'         => ['type' => 'VARCHAR', 'constraint' => '255'],
            'montant_total'  => ['type' => 'DECIMAL', 'constraint' => '10,2'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('factures');
    }

    public function down()
    {
        $this->forge->dropTable('factures');
    }
}