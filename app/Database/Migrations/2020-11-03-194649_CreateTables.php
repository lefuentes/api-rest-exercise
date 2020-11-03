<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTables extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'product_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'description' => [
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
		$this->forge->addKey('product_id', true);
		$this->forge->createTable('products');


		$this->forge->addField([
			'variant_id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'name' => [
				'type'           => 'TEXT',
				'null'           => true,
			],
			'product_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
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
		$this->forge->addKey('variant_id', true);
		$this->forge->addKey('product_id');
		$this->forge->createTable('variants');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('products');
		$this->forge->dropTable('variants');
	}
}
