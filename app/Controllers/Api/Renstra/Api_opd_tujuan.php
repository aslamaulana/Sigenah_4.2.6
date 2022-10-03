<?php

namespace App\Controllers\User\Renstra;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Api\Renstra\Model_renstra_tujuan;
use App\Models\Admin\RPJMD\Model_tahun;

class Opd_tujuan extends BaseController
{
	use ResponseTrait;

	protected $opd_tujuan, $tahun;

	public function __construct()
	{
		$this->opd_tujuan = new Model_renstra_tujuan();
		$this->tahun = new Model_tahun();
	}

	public function tujuan($perubahan, $opd_id = '')
	{
		return $this->respond($this->opd_tujuan->Api_tujuan($perubahan, $opd_id), 200);
	}
}
