<?php

namespace App\Controllers\Api\Simonela;

use App\Controllers\BaseController;
use App\Models\User\Ropk\Model_ropk_keuangan_kegiatan_sub;
use App\Models\User\Simonela\Model_simonela_progres;
use App\Models\User\Simonela\Model_simonela_dokumen;
use CodeIgniter\API\ResponseTrait;

class Simonela extends BaseController
{
	use ResponseTrait;

	protected $sub_kegiatan, $simonela, $simonela_dokumen;

	public function __construct()
	{
		$this->sub_kegiatan = new Model_ropk_keuangan_kegiatan_sub(); // Miroring dari sub Kegiatan keuangan
		$this->simonela = new Model_simonela_progres();
		$this->simonela_dokumen = new Model_simonela_dokumen();
	}
	public function simonela($opd, $tahun, $perubahan)
	{
		return $this->respond($this->simonela->where(['opd_id' => $opd, 'tahun' => $tahun, 'perubahan' => $perubahan])->findAll(), 200);
	}
	public function simonela_dokumen($opd, $tahun, $perubahan)
	{
		return $this->respond($this->simonela_dokumen->where(['opd_id' => $opd, 'tahun' => $tahun, 'perubahan' => $perubahan])->findAll(), 200);
	}
}
