<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableQuestion extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'question_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'product_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'question' => [
				'type'           => 'TEXT',
				'null'           => true,
			],
			'response' => [
				'type'           => 'TEXT',
				'null'           => true,
			],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'           => true
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'           => true
			]
		]);

		$this->forge->addKey('product_id');
		$this->forge->addKey('question_id', true);
		$this->forge->createTable('questions');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('questions');
	}
}
