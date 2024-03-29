<?php

namespace App\Controllers\User\Ropk;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_satuan;
use App\Models\User\Ropk\Model_ropk_organisasi_kegiatan_sub;
use App\Models\User\Ropk\Model_ropk_fisik_kegiatan_sub;
use App\Models\User\Ropk\Model_ropk_keuangan_kegiatan_sub;
use App\Models\Admin\RPJMD\Model_tahun;

class Ropk_kegiatan_sub extends BaseController
{
	protected $ropk_organisasi_rkpd_kegiatan_sub, $satuan, $tahun, $ropk_fisik_rkpd_kegiatan_sub, $ropk_keuangan_rkpd_kegiatan_sub;

	public function __construct()
	{
		$this->ropk_organisasi_rkpd_kegiatan_sub = new Model_ropk_organisasi_kegiatan_sub();
		$this->ropk_fisik_rkpd_kegiatan_sub = new Model_ropk_fisik_kegiatan_sub();
		$this->ropk_keuangan_rkpd_kegiatan_sub = new Model_ropk_keuangan_kegiatan_sub();
		$this->satuan = new Model_satuan();
		$this->tahun = new Model_tahun();
	}
	public function fisik()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'ropk',
				'mn' => 'ropk_fisik',
				'title' => 'User | Cantik Fisik',
				'lok' => '<b>Sub Kegiatan</b>',
				// Ropk Fisik Miroring dari sub Kegiatan keuangan
				'rkpd_kegiatan' => $this->ropk_keuangan_rkpd_kegiatan_sub->Kegiatan(),
				'tahunA' => $this->tahun->tahunA(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Ropk/ropk_fisik_kegiatan_sub', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function keuangan()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'ropk',
				'mn' => 'ropk_keuangan',
				'title' => 'User | Cantik Keuangan',
				'lok' => '<b>Sub Kegiatan</b>',
				'rkpd_kegiatan' => $this->ropk_keuangan_rkpd_kegiatan_sub->Kegiatan(),
				'tahunA' => $this->tahun->tahunA(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Ropk/ropk_keuangan_kegiatan_sub', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function organisasi()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'ropk',
				'mn' => 'ropk_organisasi',
				'title' => 'User | Cantik Organisasi',
				'lok' => '<b>Sub Kegiatan</b>',
				'rkpd_kegiatan' => $this->ropk_organisasi_rkpd_kegiatan_sub->Kegiatan(),
				'tahunA' => $this->tahun->tahunA(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Ropk/ropk_organisasi_kegiatan_sub', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Hapus data sub kegiatan Organisasi
	 * ---------------------------------------------------
	 */
	public function delete_organisasi()
	{
		try {
			foreach ($_POST['id_sub'] as $key => $val) {
				$data[] = $val;
			}
		} catch (\Exception $e) {
			session()->setFlashdata('error', 'Data Gagal di hapus.');
			return redirect()->back();
		}

		$this->ropk_organisasi_rkpd_kegiatan_sub->delete($data);
		session()->setFlashdata('pesan', 'Data berhasil di hapus.');
		return redirect()->to(base_url() . '/user/ropk/ropk_kegiatan_sub/organisasi');
	}
	/*
	 * ---------------------------------------------------
	 * Hapus data sub kegiatan Organisasi
	 * ---------------------------------------------------
	 */
	public function delete_keuangan()
	{
		try {
			foreach ($_POST['id_sub'] as $key => $val) {
				$data[] = $val;
			}
		} catch (\Exception $e) {
			session()->setFlashdata('error', 'Data Gagal di hapus.');
			return redirect()->back();
		}

		$this->ropk_keuangan_rkpd_kegiatan_sub->delete($data);
		session()->setFlashdata('pesan', 'Data berhasil di hapus.');
		return redirect()->to(base_url() . '/user/ropk/ropk_kegiatan_sub/keuangan');
	}
}
