<?php

namespace App\Controllers\Api\Ropk;

use App\Controllers\BaseController;
use App\Models\Api\Ropk\Model_ropk_keuangan_kegiatan_sub as RopkModel_ropk_keuangan_kegiatan_sub;
use CodeIgniter\API\ResponseTrait;

class Ropk_kegiatan_sub extends BaseController
{
	use ResponseTrait;

	protected $ropk_keuangan_rkpd_kegiatan_sub;

	public function __construct()
	{
		$this->ropk_keuangan_rkpd_kegiatan_sub = new RopkModel_ropk_keuangan_kegiatan_sub();
	}
	public function keuangan($opd, $tahun, $perubahan)
	{
		return $this->respond($this->ropk_keuangan_rkpd_kegiatan_sub->Kegiatan($opd, $tahun, $perubahan), 200);
	}
}
