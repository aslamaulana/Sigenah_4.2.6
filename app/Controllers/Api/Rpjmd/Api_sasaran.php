<?php

namespace App\Controllers\Api\Rpjmd;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Api\Rpjmd\Model_sasaran;

class Api_sasaran extends BaseController
{
	use ResponseTrait;

	protected $sasaran;

	public function __construct()
	{
		$this->sasaran = new Model_sasaran();
	}
	public function sasaran()
	{
		return $this->respond($this->sasaran->sasaran(), 200);
	}
}
