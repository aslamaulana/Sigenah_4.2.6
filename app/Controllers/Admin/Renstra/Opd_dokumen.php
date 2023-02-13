<?php

namespace App\Controllers\Admin\Renstra;

use App\Controllers\BaseController;
use App\Models\Admin\Renstra\Model_opd_dokumen;

class Opd_dokumen extends BaseController
{
	protected $dokumen, $session;

	public function __construct()
	{
		$this->dokumen = new Model_opd_dokumen(); // Miroring dari sub Kegiatan keuangan

		$this->session = \Config\Services::session();
		$this->session->start();
	}
	/*
	 * ---------------------------------------------------
	 * Tambah Progres Dokument
	 * ---------------------------------------------------
	 */
	public function index()
	{
		if (has_permission('Admin')) :
			if (!isset($_SESSION['opd_set'])) {
				try {
					$this->session->set('opd_set', '0002');
				} catch (\Exception $e) {
				}
				return redirect()->to(base_url('/admin/renstra/opd_dokumen'));
			}

			$data = [
				'gr' => 'A_dokumen',
				'mn' => 'A_dokumen',
				'title' => 'Admin | Kegiatan',
				'lok' => '<b>Dokumen</b>',
				'opd' => $this->dokumen->opd(),
				'validation' => \Config\Services::validation(),
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Renstra/opd_dokumen', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Set Opd
	 * ---------------------------------------------------
	 */
	public function opd($opd)
	{
		$this->session->set('opd_set', $opd);

		return redirect()->to(base_url('/admin/renstra/opd_dokumen'));
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
