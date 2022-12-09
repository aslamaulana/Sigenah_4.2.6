<?php

namespace App\Controllers\Api\Rpjmd;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Api\Rpjmd\Model_visi;

class Api_visi extends BaseController
{
	use ResponseTrait;

	protected $visi, $misi;

	public function __construct()
	{
		$this->visi = new Model_visi();
	}

	public function visi()
	{
		return $this->respond($this->visi->visi(), 200);
	}
}
