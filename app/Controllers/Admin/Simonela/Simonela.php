<?php

namespace App\Controllers\Admin\Simonela;

use App\Controllers\BaseController;
use App\Models\Admin\Ropk\Model_ropk_keuangan_kegiatan_sub;
use App\Models\Admin\Simonela\Model_simonela_progres;
use App\Models\Admin\Simonela\Model_simonela_dokumen;
use App\Models\Admin\User\Model_bidang;

use Dompdf\Dompdf;
use Dompdf\Options;

use Google\Service\Drive;

class Simonela extends BaseController
{
	protected $sub_kegiatan, $simonela, $simonela_dokumen, $opd, $session;

	public function __construct()
	{
		$this->sub_kegiatan = new Model_ropk_keuangan_kegiatan_sub(); // Miroring dari sub Kegiatan keuangan
		$this->simonela = new Model_simonela_progres();
		$this->simonela_dokumen = new Model_simonela_dokumen();
		$this->opd = new Model_bidang();

		$this->session = \Config\Services::session();
		$this->session->start();
	}

	/*
	 * ---------------------------------------------------
	 * Menu sub kegiatan e-monev
	 * Sub kegiatan di ambil dari ropk keuangan sub kegiatan
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
				return redirect()->to(base_url('/admin/simonela/simonela'));
			}

			$data = [
				'gr' => 'simonela',
				'mn' => 'simonela',
				'title' => 'Admin | Si-Monela',
				'lok' => '<b>Si-Monela</b>',
				'opd' => $this->opd->skpd(),
				'sub_kegiatan' => $this->sub_kegiatan->Kegiatan(), //Miroring dari sub Kegiatan keuangan
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Simonela/simonela', $data);
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
		return redirect()->back();
		return redirect()->to(base_url('/admin/simonela/simonela'));
	}
	public function opd2($opd, $bulan_long = '')
	{
		$this->session->set('opd_set', $opd);
		// return redirect()->back();
		return redirect()->to(base_url('/admin/simonela/simonela/laporan/' . $bulan_long . '?bu=' . $_GET['bu']));
	}
	/*
	 * ---------------------------------------------------
	 * Progres berdasarkan sub kegiatan
	 * ---------------------------------------------------
	 */
	public function progres($id)
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'simonela',
				'mn' => 'simonela',
				'title' => 'Admin | Si-Monela',
				'lok' => '<a onclick="history.back(-1)" href="#">Si-Monela</a> -> <b>Progres</b>',
				'DT' => $this->sub_kegiatan->find($id),
				'opd' => $this->opd->skpd(),
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Simonela/simonela_progres', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Progres berdasarkan sub kegiatan
	 * ---------------------------------------------------
	 */
	public function progres_grafik($id)
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'simonela',
				'mn' => 'simonela',
				'title' => 'Admin | Si-Monela',
				'lok' => 'Si-Monela -> <a onclick="history.back(-1)" href="#">Progres</a> -> <b>Progres Grafik</b>',
				'DT' => $this->sub_kegiatan->find($id),
				'opd' => $this->opd->skpd(),
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Simonela/simonela_progres_grafik', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Progres Perbulan
	 * ---------------------------------------------------
	 */
	public function progres_bulan($id, $b = '', $nm = '')
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'simonela',
				'mn' => 'simonela',
				'title' => 'Admin | Si-Monela',
				// 'lok' => 'Si-Monela -> <a onclick="history.back(-1)" href="#">Progres</a> -> <b>Progres ' . $nm . '</b>',
				'lok' => 'Si-Monela -> <a href="/admin/simonela/simonela/progres/' . $id . '/' . $b . '/' . $nm . '?keu=' . $_GET['keu'] . '&fis=' . $_GET['fis'] . '">Progres</a> -> <b>Progres ' . $nm . '</b>',
				'DT' => $this->sub_kegiatan->find($id),
				'opd' => $this->opd->skpd(),
				'id_ropk_keuangan' => $id,
				'b' => $b,
				'nm' => $nm,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Simonela/simonela_progres_bulan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Tambah Progres Dokument
	 * ---------------------------------------------------
	 */
	public function dokumen_add($id, $b = '', $nm = '')
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'simonela',
				'mn' => 'simonela',
				'title' => 'Admin | Si-Monela',
				'lok' => 'Si-Monela -> <a href="/admin/simonela/simonela/progres/' . $id . '">Progres</a> -> <b>Tambah Dokemen</b>',
				'DT' => $this->sub_kegiatan->find($id),
				'opd' => $this->opd->skpd(),
				'b' => $b,
				'nm' => $nm,
				'validation' => \Config\Services::validation(),
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Simonela/simonela_progres_dokumen_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Download Progres Dokument
	 * ---------------------------------------------------
	 */
	public function download($opd_id, $id)
	{
		$dt = $this->simonela_dokumen->getwhere(['id_simonela_progres_berkas' => buka($id)])->getRow();
		$dokumen = $dt->dokumen;

		return $this->response->download('./FileBerkasData/' . $opd_id . '/Si-Monela/' . $dokumen, NULL);
	}
	/*
	 * ---------------------------------------------------
	 * Simonela Laporan
	 * ---------------------------------------------------
	 */
	public function laporan($bulan_long = '')
	{
		if (has_permission('Admin')) :

			if (!isset($_SESSION['opd_set'])) {
				try {
					$this->session->set('opd_set', '0002');
				} catch (\Exception $e) {
				}
				return redirect()->to(base_url('/admin/simonela/simonela/laporan?bu=b1'));
			}

			$data = [
				'gr' => 'simonela',
				'mn' => 'simonela_laporan',
				'title' => 'Admin | Si-Monela',
				'lok' => '<b>Si-Monela Laporan</b>',
				'sub_kegiatan' => $this->sub_kegiatan->Kegiatan(), //Miroring dari sub Kegiatan keuangan
				'db' => \Config\Database::connect(),
				'opd' => $this->opd->skpd(),
				'bulan_long' => $bulan_long,
			];
			echo view('admin/Simonela/simonela_laporan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Menu sub kegiatan e-monev
	 * Sub kegiatan di ambil dari ropk keuangan sub kegiatan
	 * ---------------------------------------------------
	 */
	public function laporan_pdf($bulan_long)
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'simonela',
				'mn' => 'simonela_laporan',
				'title' => 'Admin | Si-Monela',
				'lok' => '<b>Si-Monela Laporan</b>',
				'sub_kegiatan' => $this->sub_kegiatan->Kegiatan(), //Miroring dari sub Kegiatan keuangan
				'db' => \Config\Database::connect(),
				'opd' => $this->opd->find($_SESSION['opd_set']),
				'bulan_long' => $bulan_long,
			];

			// return view('surat/disposisi_print', $data);
			$html = view('admin/Simonela/simonela_laporan_pdf', $data);

			$options = new Options();
			$options->set('defaultFont', 'serif');

			// $dompdf = new Dompdf($options);
			$dompdf = new Dompdf($options);
			$dompdf->loadHtml($html, 'UTF-8');

			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('a3', 'landscape');
			// Render the HTML as PDF
			$dompdf->render();

			// Output the generated PDF to Browser
			// $dompdf->stream();
			$dompdf->stream('Lembar Disposisi-' . date('d-m-Y H:i'), array("Attachment" => false));
		// echo view('admin/Simonela/simonela_laporan_pdf', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
