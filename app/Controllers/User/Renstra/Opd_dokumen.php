<?php

namespace App\Controllers\User\Renstra;

use App\Controllers\BaseController;
use App\Models\User\Renstra\Model_opd_dokumen;

class Opd_dokumen extends BaseController
{
	protected $dokumen;

	public function __construct()
	{
		$this->dokumen = new Model_opd_dokumen(); // Miroring dari sub Kegiatan keuangan
	}
	/*
	 * ---------------------------------------------------
	 * Tambah Progres Dokument
	 * ---------------------------------------------------
	 */
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Dokumen',
				'mn' => 'dokumen',
				'title' => 'User | Kegiatan',
				'lok' => '<b>Dokumen</b>',
				'validation' => \Config\Services::validation(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Renstra/opd_dokumen', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Tambah Progres Dokument
	 * ---------------------------------------------------
	 */
	public function dokumen_create()
	{
		if (!$this->validate([
			'file' => [
				'rules' => 'uploaded[file]|max_size[file,20100]',
				// 'rules' => 'uploaded[file]|max_size[file,20100]|ext_in[file,doc,docx,Doc,Docx,xls,xlsx,Xls,Xlsx,pdf,jpg,jpeg,png]',
				'errors' => [
					'uploaded' => 'Pilih Berkas',
					'max_size' => 'Maksimal Size 20Mb',
					'ext_in' => 'Format file Salah!'
				]
			]
		])) {
			return redirect()->back()->withInput();
		}

		$file = $this->request->getFile('file');

		if ($file->getError() == 4) {
			$namaFile = '';
		} else {

			$path = './FileBerkasData/' . user()->opd_id . '/Renstra/' . $_SESSION['tahun'];
			if (!is_dir($path)) {
				mkdir($path, '0755', true);
			}

			$nama = $this->request->getVar('nama');
			$nama2 = $file->getRandomName();
			$namaFile = $nama . '-' . $nama2;
			$file->move('FileBerkasData/' . user()->opd_id . '/Renstra/' .  $_SESSION['tahun'], $namaFile);
		}

		$this->dokumen->save([
			'dokumen' => $namaFile,
			'size' => $file->getSize(),
			'keterangan' => $this->request->getVar('keterangan'),

			'opd_id' => user()->opd_id,
			'tahun' => $_SESSION['tahun'],
			'perubahan'  => $_SESSION['perubahan'],
		]);

		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		return redirect()->back();
	}
	/*
	 * ---------------------------------------------------
	 * Hapus Progres Dokument
	 * ---------------------------------------------------
	 */
	public function dokumen_hapus($id)
	{
		$dt = $this->dokumen->getwhere(['id_renstra_dokumen' => $id])->getRow();
		// dd($dt);
		$dokumen = $dt->dokumen;
		try {
			unlink('FileBerkasData/' . user()->opd_id . '/Renstra/' .  $_SESSION['tahun'] . '/' . $dokumen);
		} catch (\Exception $e) {
		}

		try {
			$this->dokumen->delete($id);
		} catch (\Exception $e) {
			session()->setFlashdata('error', 'Data Gagal di hapus.');
			return redirect()->back();
		}

		session()->setFlashdata('pesan', 'Data berhasil di hapus.');
		return redirect()->back();
	}
	/*
	 * ---------------------------------------------------
	 * Download Progres Dokument
	 * ---------------------------------------------------
	 */
	public function download($id)
	{
		$dt = $this->dokumen->getwhere(['id_renstra_dokumen' => $id])->getRow();
		$dokumen = $dt->dokumen;

		return $this->response->download('./FileBerkasData/' . user()->opd_id . '/Renstra/' .  $_SESSION['tahun'] . '/' . $dokumen, NULL);
	}
}
