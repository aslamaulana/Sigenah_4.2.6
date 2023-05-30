<?php

namespace App\Controllers\User\Proposal;

use App\Controllers\BaseController;
use App\Models\User\Proposal\Model_proposal;
use App\Models\User\Proposal\Model_proposal_verifikasi;

class Pengajuan extends BaseController
{
	protected $proposal, $verifikasi;

	public function __construct()
	{
		$this->proposal = new Model_proposal();
		$this->verifikasi = new Model_proposal_verifikasi();
	}

	public function index()
	{
		if (has_permission('User')) :
			// $bidang = $this->bidang->bidang();
			$data = [
				'gr' => 'proposal',
				'mn' => 'pengajuan',
				'title' => 'Proposal',
				'lok' => '<b>Proposal</b>',
				'proposal' => $this->proposal->where(['opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun']])->findAll(),
				'db' => \Config\Database::connect(),

			];
			// dd($data);
			// return view('user/Proposal/proposal_verifikasi', $data);
			return view('user/Proposal/proposal', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Tambah Proposal
	 * ---------------------------------------------------
	 */
	public function proposal_add()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'proposal',
				'mn' => 'pengajuan',
				'title' => 'Proposal',
				'lok' => '<a onclick="history.back(-3)" href="#">Proposal</a> -> <b>Tambah Proposal</b>',
				'validation' => \Config\Services::validation(),
			];
			return view('user/Proposal/proposal_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Tambah Proposal
	 * ---------------------------------------------------
	 */
	public function proposal_create()
	{
		if (has_permission('User')) :

			if (!$this->validate([
				'file' => [
					'rules' => 'uploaded[file]|max_size[file,20100]|ext_in[file,pdf]',
					'errors' => [
						'uploaded' => 'Pilih Berkas',
						'max_size' => 'Maksimal Size 20Mb',
						'ext_in' => 'Format file Salah!'
					]
				],
				'map' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Wajib di isi'
					]
				]
			])) {
				return redirect()->back()->withInput();
			}

			$file = $this->request->getFile('file');

			if ($file->getError() == 4) {
				$namaFile = '';
			} else {

				$path = './FileBerkasData/' . user()->opd_id . '/Proposal';
				if (!is_dir($path)) {
					mkdir($path, '0755', true);
				}

				$nama = $file->getName();
				$nama2 = $file->getRandomName();
				$namaFile = $nama . '-' . $nama2;
				$file->move('FileBerkasData/' . user()->opd_id . '/Proposal/', $namaFile);
			}

			$this->proposal->save([
				'usulan_kegiatan_id' => $this->request->getVar('usulan'),
				'judul_kegiatan' => $this->request->getVar('kegiatan'),
				'permasalahan' => $this->request->getVar('permasalahan'),
				'usulan_anggaran' => $this->request->getVar('anggaran'),
				'titik_lokasi' => $this->request->getVar('map'),
				'alamat' => $this->request->getVar('alamat'),
				'dokumen' => $namaFile,
				'size' => $file->getSizeByUnit('mb'),
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/proposal/pengajuan');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Ubah Proposal
	 * ---------------------------------------------------
	 */
	public function proposal_edit($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'proposal',
				'mn' => 'pengajuan',
				'title' => 'Proposal',
				'lok' => '<a onclick="history.back(-3)" href="#">Proposal</a> -> <b>ubah Proposal</b>',
				'validation' => \Config\Services::validation(),
				'proposal' => $this->proposal->find($id),
			];
			return view('user/Proposal/proposal_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Tambah Proposal
	 * ---------------------------------------------------
	 */
	public function proposal_update()
	{
		if (has_permission('User')) :

			if (!$this->validate([
				'file' => [
					'rules' => 'max_size[file,20100]|ext_in[file,pdf]',
					'errors' => [
						'max_size' => 'Maksimal Size 20Mb',
						'ext_in' => 'Format file Salah!'
					]
				],
				'map' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Wajib di isi'
					]
				]
			])) {
				return redirect()->back()->withInput();
			}

			$file = $this->request->getFile('file');

			if ($file->getError() == 4) {
				$namaFile = $this->request->getVar('file-old');
				$size = $this->request->getVar('size-old');
			} else {

				$path = './FileBerkasData/' . user()->opd_id . '/Proposal';
				if (!is_dir($path)) {
					mkdir($path, '0755', true);
				}

				$nama = $file->getName();
				$nama2 = $file->getRandomName();
				$size = $file->getSizeByUnit('mb');
				$namaFile = $nama . '-' . $nama2;
				$file->move('FileBerkasData/' . user()->opd_id . '/Proposal/', $namaFile);
				if ($this->request->getVar('file-old') != '') {
					unlink('FileBerkasData/' . user()->opd_id . '/Proposal/' . $this->request->getVar('file-old'));
				}
			}

			$this->proposal->save([
				'id_proposal' => $this->request->getVar('id_proposal'),
				'usulan_kegiatan_id' => $this->request->getVar('usulan'),
				'judul_kegiatan' => $this->request->getVar('kegiatan'),
				'permasalahan' => $this->request->getVar('permasalahan'),
				'usulan_anggaran' => $this->request->getVar('anggaran'),
				'titik_lokasi' => $this->request->getVar('map'),
				'alamat' => $this->request->getVar('alamat'),
				'dokumen' => $namaFile,
				'size' => $size,
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/proposal/pengajuan');
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
				'opd_id' => user()->opd_id,
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/proposal/pengajuan');
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
				'mn' => 'pengajuan',
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
}
