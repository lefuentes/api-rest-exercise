<?php

namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $validatePaginate = [
		'page' => [
			'rules' => 'required|is_natural_no_zero'
		],
		'pageSize' => [
			'rules' => 'required|is_natural_no_zero'
		]
	];

	public $createProduct = [
		'name' => [
			'rules' => 'required|min_length[3]|max_length[100]'
		],
		'description' => [
			'rules' => 'required|min_length[3]|max_length[100]'
		]
	];

	public $searchProduct = [
		'query' => [
			'rules' => 'required|alpha_numeric_space'
		]
	];

	public $showSlug = [
		'slug' => [
			'rules' => 'required|regex_match[/^[a-z0-9\-]*$/]'
		]
	];

	public $createQuestion = [
		'question' => [
			'rules' => 'required|min_length[3]|max_length[100]'
		]
	];
}
