<?php

namespace App\Controllers\User\Ropk;

use App\Controllers\BaseController;
use App\Models\Admin\User\Model_bidang;

class Ropk_laporan extends BaseController
{
	protected $opd;

	public function __construct()
	{
		$this->opd = new Model_bidang();
	}

	public function index()
	{
		if (has_permission('User')) :
			$opd = $this->opd->find(user()->opd_id);
			$data = [
				'gr' => 'ropk',
				'mn' => 'ropk_laporan',
				'title' => 'User | Laporan',
				'lok' => '<b>Laporan Triwulan</b>',
				'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			// dd($data);
			echo view('user/Ropk/opd_laporan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function cetak()
	{
		// dd("jjjjjjjjjjjjjjjjj");
		$filename = "Renstra " . " - " . date('Y-m-d') . ".xls";
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="' . $filename . '";');

		$data = [
			'gr' => 'Renstra',
			'mn' => 'opd_laporan',
			'title' => 'User | Laporan',
			'lok' => '<b>Laporan Renstra</b>',
			'db' => \Config\Database::connect(),
			// 'opd_data' => $this->request->getVar('opd'),

		];
		echo view('user/Ropk/ropk_laporan_triwulan', $data);
	}
}
