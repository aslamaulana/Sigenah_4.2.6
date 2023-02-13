<?php

namespace App\Controllers\Api\Ropk;

use App\Controllers\BaseController;
use App\Models\User\Ropk\Model_ropk_keuangan;
use CodeIgniter\API\ResponseTrait;

class Ropk_keuangan extends BaseController
{
	use ResponseTrait;

	protected $ropk_keuangan;

	public function __construct()
	{
		$this->ropk_keuangan = new Model_ropk_keuangan();
	}
	public function keuangan($opd, $tahun, $perubahan)
	{
		return $this->respond($this->ropk_keuangan->where(['opd_id' => $opd, 'tahun' => $tahun, 'perubahan' => $perubahan])->findAll(), 200);
	}
	// public function keuangan($id)
	// {
	// 	if (has_permission('User')) :
	// 		$data = [
	// 			'gr' => 'ropk',
	// 			'mn' => 'ropk_keuangan',
	// 			'title' => 'User | Cantiku',
	// 			'lok' => 'Sub Kegiatan -> <b>Cantiku</b>',
	// 			'DT' => $this->ropk_kegiatan_sub->find($id),
	// 			'db' => \Config\Database::connect(),
	// 		];
	// 		// dd($data);
	// 		echo view('user/Ropk/ropk_keuangan', $data);
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }

}
