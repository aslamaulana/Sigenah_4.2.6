<?php

namespace App\Controllers\User\Renstra_capaian;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_satuan;
use App\Models\User\Renstra\Model_opd_tujuan;
use App\Models\User\Renstra_capaian\Model_opd_capaian_tujuan;

class Opd_capaian_tujuan extends BaseController
{
	protected $opd_capaian_tujuan, $opd_tujuan, $satuan;

	public function __construct()
	{
		// $this->visi = new Model_visi();
		$this->opd_capaian_tujuan = new Model_opd_capaian_tujuan();
		$this->opd_tujuan = new Model_opd_tujuan();
		$this->satuan = new Model_satuan();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra_capaian',
				'mn' => 'opd_capaian_tujuan',
				'title' => 'User | OPD TUJUAN',
				'lok' => '<b>Capaian Tujuan</b>',
				'tujuan' => $this->opd_capaian_tujuan->tujuan(),
				'db' => \Config\Database::connect(),
			];
			// dd($data);
			echo view('user/Renstra_capaian/opd_tujuan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function opd_tujuan_edit($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra_capaian',
				'mn' => 'opd_capaian_tujuan',
				'title' => 'User | OPD TUJUAN',
				'lok' => '<a href="/user/renstra_capaian/opd_capaian_tujuan">Capaian Tujuan</a> -> <b>Ubah Tujuan</b>',
				'tujuan' => $this->opd_capaian_tujuan->find($id),
				'validation' => \Config\Services::validation(),
			];
			// dd($data);
			echo view('user/Renstra_capaian/opd_tujuan_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_tujuan_update()
	{
		if (has_permission('User')) :
			$this->opd_capaian_tujuan->save([
				'id_opd_tujuan' => $this->request->getVar('id_tujuan'),
				'triwulan_1' => $this->request->getVar('triwulan_1'),
				'triwulan_2' => $this->request->getVar('triwulan_2'),
				'triwulan_3' => $this->request->getVar('triwulan_3'),
				'triwulan_4' => $this->request->getVar('triwulan_4'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra_capaian/opd_capaian_tujuan');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// =======================================================================================================

	public function import_tujuan()
	{
		if (has_permission('User')) :

			$data = $this->opd_tujuan->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id])->findAll();
			foreach ($data as $key => $val) {
				$result[] = array(
					'opd_tujuan' => $data[$key]['opd_tujuan'],
					'opd_kode_tujuan' => $data[$key]['opd_kode_tujuan'],
					'opd_indikator_tujuan' => $data[$key]['opd_indikator_tujuan'],
					'satuan' => $data[$key]['satuan'],
					't_tahun' => $data[$key]['t_' . $_SESSION['tahun']],
					'opd_id' => user()->opd_id,
					'tahun' => $_SESSION['tahun'],
					'perubahan' => $_SESSION['perubahan'],
					'created_by' => user()->full_name,
				);
			}
			$this->opd_capaian_tujuan->insertBatch($result);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra_capaian/opd_capaian_tujuan');

		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
