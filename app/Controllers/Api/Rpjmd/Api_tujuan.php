<?php

namespace App\Controllers\Api\Rpjmd;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Api\Rpjmd\Model_tujuan;

class Api_tujuan extends BaseController
{
	use ResponseTrait;

	protected $tujuan;

	public function __construct()
	{
		$this->tujuan = new Model_tujuan();
	}
	public function tujuan()
	{
		return $this->respond($this->tujuan->tujuan(), 200);
	}
}
