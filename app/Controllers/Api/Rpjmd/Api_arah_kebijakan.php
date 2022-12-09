<?php

namespace App\Controllers\Api\Rpjmd;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Api\Rpjmd\Model_arah_kebijakan;

class Api_arah_kebijakan extends BaseController
{
	use ResponseTrait;

	protected $arah_kebijakan;

	public function __construct()
	{
		$this->arah_kebijakan = new Model_arah_kebijakan();
	}
	public function arah_kebijakan()
	{
		return $this->respond($this->arah_kebijakan->arah_kebijakan(), 200);
	}
}
