<?php

namespace App\Controllers\User\Proposal;

use App\Controllers\BaseController;
use App\Models\User\Proposal\Model_proposal;
use App\Models\User\Proposal\Model_proposal_verifikasi;

class Verifikator extends BaseController
{
	protected $proposal, $verifikasi;

	public function __construct()
	{
		$this->proposal = new Model_proposal();
		$this->verifikasi = new Model_proposal_verifikasi();
	}

	public function index()
	{
		if (has_permission('verifikator')) :
			// $bidang = $this->bidang->bidang();
			$data = [
				'gr' => 'proposal',
				'mn' => 'verifikator',
				'title' => 'Proposal',
				'lok' => '<b>Proposal Verifikasi</b>',
				'proposal' => $this->proposal->where(['opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun']])->findAll(),
				'db' => \Config\Database::connect(),

			];
			// dd($data);
			// return view('user/Proposal/proposal_verifikasi', $data);
			return view('user/Proposal/proposal_verifikator', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Ubah Proposal
	 * ---------------------------------------------------
	 */
	public function proposal_verifikasi($id)
	{
		if (has_permission('verifikator')) :
			$data = [
				'gr' => 'proposal',
				'mn' => 'verifikator',
				'title' => 'Proposal',
				'lok' => '<a onclick="history.back(-3)" href="#">Proposal Verifikasi</a> -> <b>Verifikasi Proposal</b>',
				'validation' => \Config\Services::validation(),
				'proposal' => $this->proposal->find($id),
				'verifikasi' => $this->verifikasi->Where(['proposal_id' => $id])->first(),
			];
			// dd($data);
			return view('user/Proposal/proposal_verifikasi', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * lembar varifikasi
	 * ---------------------------------------------------
	 */
	public function proposal_lembar_verifikasi($id)
	{
		if (has_permission('verifikator')) :
			$data = [
				'gr' => 'proposal',
				'mn' => 'verifikator',
				'title' => 'Proposal',
				'lok' => '<a onclick="history.back(-3)" href="#">Proposal Verifikasi</a> -> <b>Lembar Verifikasi</b>',
				'validation' => \Config\Services::validation(),
				'proposal' => $this->proposal->find($id),
				'verifikasi' => $this->verifikasi->Where(['proposal_id' => $id])->first(),
			];
			// dd($data);
			return view('user/Proposal/proposal_verifikasi_lembar', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Proposal verifikasi
	 * ---------------------------------------------------
	 */
	public function proposal_varifikasi_update()
	{
		if (has_permission('User')) :
			$this->verifikasi->save([
				'id_proposal_verifikasi' => $this->request->getVar('id_proposal_verifikasi'),
				'verifikasi' => ($this->request->getVar('radio111') == 'telah') ? 'memenuhi_syarat' : 'dikembalikan',
				// 'verifikasi',memenuhi_syarat
				'syarat'  => $this->request->getVar('radio111'),
				'nama_singkat_bidang',
				'nm_verifikator' => user()->opd_id,
				'i_1' => $this->request->getVar('radio1'),
				'c_1' => $this->request->getVar('1'),
				'i_2' => $this->request->getVar('radio2'),
				'c_2' => $this->request->getVar('2'),
				'i_3' => $this->request->getVar('radio3'),
				'c_3' => $this->request->getVar('3'),
				'i_4' => $this->request->getVar('radio4'),
				'c_4' => $this->request->getVar('4'),
				'i_5' => $this->request->getVar('radio5'),
				'c_5' => $this->request->getVar('5'),
				'i_6' => $this->request->getVar('radio6'),
				'c_6' => $this->request->getVar('6'),
				'i_7' => $this->request->getVar('radio7'),
				'c_7' => $this->request->getVar('7'),
				'i_8' => $this->request->getVar('radio8'),
				'c_8' => $this->request->getVar('8'),
				'i_9' => $this->request->getVar('radio9'),
				'c_9' => $this->request->getVar('9'),
				'i_10' => $this->request->getVar('radio10'),
				'c_10' => $this->request->getVar('10'),
				'i_11' => $this->request->getVar('radio11'),
				'c_11' => $this->request->getVar('11'),
				'i_12' => $this->request->getVar('radio12'),
				'c_12' => $this->request->getVar('12'),
				'i_13' => $this->request->getVar('radio13'),
				'c_13' => $this->request->getVar('13'),
				'i_14' => $this->request->getVar('radio14'),
				'c_14' => $this->request->getVar('14'),
				'i_15' => $this->request->getVar('radio15'),
				'c_15' => $this->request->getVar('15'),
				'i_16' => $this->request->getVar('radio16'),
				'c_16' => $this->request->getVar('16'),
				'i_17' => $this->request->getVar('radio17'),
				'c_17' => $this->request->getVar('17'),
				'i_18' => $this->request->getVar('radio18'),
				'c_18' => $this->request->getVar('18'),
				'i_19' => $this->request->getVar('radio19'),
				'c_19' => $this->request->getVar('19'),
				'i_20' => $this->request->getVar('radio20'),
				'c_20' => $this->request->getVar('20'),
				'i_21' => $this->request->getVar('radio21'),
				'c_21' => $this->request->getVar('21'),
				'i_22' => $this->request->getVar('radio22'),
				'c_22' => $this->request->getVar('22'),
				'ii_1' => $this->request->getVar('radioi1'),
				'ii_c_1' => $this->request->getVar('II_1'),
				'ii_2' => $this->request->getVar('radioi2'),
				'ii_c_2' => $this->request->getVar('II_2'),
				'ii_3' => $this->request->getVar('radioi3'),
				'ii_c_3' => $this->request->getVar('II_3'),
				// 'opd_id',
				// 'tahun',
				// 'perubahan',
				// 'created_by',
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/proposal/verifikator');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Tampilkan Proposal Dokument
	 * ---------------------------------------------------
	 */
	public function show($id)
	{
		$dt = $this->proposal->getwhere(['id_proposal' => buka($id)])->getRow();
		$dokumen = $dt->dokumen;

		header("content-type: application/pdf");
		readfile('./FileBerkasData/' . user()->opd_id . '/Proposal/' . $dokumen);
	}
	/*
	 * ---------------------------------------------------
	 * Hapus Proposal
	 * ---------------------------------------------------
	 */
	public function proposal_hapus($id)
	{
		$dt = $this->proposal->getwhere(['id_proposal' => $id])->getRow();
		$dokumen = $dt->dokumen;
		try {
			unlink('FileBerkasData/' . user()->opd_id . '/Proposal/' . $dokumen);
		} catch (\Exception $e) {
		}

		try {
			$this->proposal->delete($id);
		} catch (\Exception $e) {
			session()->setFlashdata('error', 'Data Gagal di hapus.');
			return redirect()->back();
		}

		session()->setFlashdata('pesan', 'Data berhasil di hapus.');
		return redirect()->back();
	}
	/*
	 * ---------------------------------------------------
	 * Proposal diajukan
	 * ---------------------------------------------------
	 */
	public function ajukan_proposal($id)
	{
		if (has_permission('User')) :
			$this->verifikasi->save([
				'proposal_id' => $id,
				'verifikasi' => 'diajukan',
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/proposal/pengajuan');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
