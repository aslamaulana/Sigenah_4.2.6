<?php

namespace App\Controllers\Api\Rpjmd;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Api\Rpjmd\Model_strategi;

class Api_strategi extends BaseController
{
	use ResponseTrait;

	protected $strategi;

	public function __construct()
	{
		$this->strategi = new Model_strategi();
	}
	public function strategi()
	{
		return $this->respond($this->strategi->strategi(), 200);
	}
}
