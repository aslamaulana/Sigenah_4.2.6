<?php

namespace App\Controllers\User\Renstra_capaian;

use App\Controllers\BaseController;
use App\Models\User\Renstra\Model_opd_sasaran;
use App\Models\User\Renstra_capaian\Model_opd_capaian_sasaran;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Opd_capaian_sasaran extends BaseController
{
	protected $opd_ujuan, $opd_sasaran, $satuan, $tahun, $opd_capaian_sasaran;

	public function __construct()
	{
		$this->opd_sasaran = new Model_opd_sasaran();
		$this->opd_capaian_sasaran = new Model_opd_capaian_sasaran();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra_capaian',
				'mn' => 'opd_capaian_sasaran',
				'title' => 'User | SASARAN',
				'lok' => '<b>Sasaran</b>',
				'sasaran' => $this->opd_capaian_sasaran->sasaran(),
			];
			echo view('user/Renstra_capaian/opd_sasaran', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_sasaran_edit($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra_capaian',
				'mn' => 'opd_capaian_sasaran',
				'title' => 'User | SASARAN',
				'lok' => '<a href="/user/renstra_capaian/opd_capaian_sasaran">Capaian Sasaran</a> -> <b>Ubah Sasaran</b>',
				'sasaran' => $this->opd_capaian_sasaran->find($id),
				'validation' => \Config\Services::validation(),
			];
			// dd($data);
			echo view('user/Renstra_capaian/opd_sasaran_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_sasaran_update()
	{
		if (has_permission('User')) :
			$this->opd_capaian_sasaran->save([
				'id_opd_sasaran' => $this->request->getVar('id_sasaran'),
				'triwulan_1' => $this->request->getVar('triwulan_1'),
				'triwulan_2' => $this->request->getVar('triwulan_2'),
				'triwulan_3' => $this->request->getVar('triwulan_3'),
				'triwulan_4' => $this->request->getVar('triwulan_4'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra_capaian/opd_capaian_sasaran');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------------------------------------------
	public function import()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra_capaian',
				'mn' => 'opd_capaian_sasaran',
				'title' => 'User | SASARAN',
				'lok' => '<a onclick="history.back(-1)" href="#">Sasaran</a> -> <b>Import Data</b>',
			];
			echo view('user/Renstra_capaian/opd_sasaran_import', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function import_sasaran()
	{
		if (has_permission('User')) :

			$data = $this->opd_sasaran->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id])->findAll();
			foreach ($data as $key => $val) {
				$result[] = array(
					'opd_tujuan_n' => $data[$key]['opd_tujuan_n'],
					'rpjmd_sasaran_n' => $data[$key]['rpjmd_sasaran_n'],
					'opd_sasaran' => $data[$key]['opd_sasaran'],
					'opd_kode_sasaran' => $data[$key]['opd_kode_sasaran'],
					'opd_indikator_sasaran' => $data[$key]['opd_indikator_sasaran'],
					'satuan' => $data[$key]['satuan'],
					't_tahun' => $data[$key]['t_' . $_SESSION['tahun']],
					'opd_id' => user()->opd_id,
					'tahun' => $_SESSION['tahun'],
					'perubahan' => $_SESSION['perubahan'],
					'created_by' => user()->full_name,
				);
			}
			$this->opd_capaian_sasaran->insertBatch($result);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra_capaian/opd_capaian_sasaran');

		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// -------------------------------------------------------------- 
	public function export_edit()
	{
		$sisw = $this->opd_capaian_sasaran->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun']])->findAll();
		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:L1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'ID')
			->setCellValue('B1', 'Tujuan')
			->setCellValue('C1', 'Sasaran RPJMD')
			->setCellValue('D1', 'Sasaran')
			->setCellValue('E1', 'Kode Sasaran')
			->setCellValue('F1', 'Indikator Sasaran')
			->setCellValue('G1', 'Satuan')
			->setCellValue('H1', 't_tahun')
			->setCellValue('I1', 'triwulan_1')
			->setCellValue('J1', 'triwulan_2')
			->setCellValue('K1', 'triwulan_3')
			->setCellValue('L1', 'triwulan_4');

		$column = 2;

		foreach ($sisw as $sisdata) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $sisdata['id_opd_sasaran'])
				->setCellValue('B' . $column, $sisdata['opd_tujuan_n'])
				->setCellValue('C' . $column, $sisdata['rpjmd_sasaran_n'])
				->setCellValue('D' . $column, $sisdata['opd_sasaran'])
				->setCellValue('E' . $column, $sisdata['opd_kode_sasaran'])
				->setCellValue('F' . $column, $sisdata['opd_indikator_sasaran'])
				->setCellValue('G' . $column, $sisdata['satuan'])
				->setCellValue('H' . $column, $sisdata['t_tahun'])
				->setCellValue('I' . $column, $sisdata['triwulan_1'])
				->setCellValue('J' . $column, $sisdata['triwulan_2'])
				->setCellValue('K' . $column, $sisdata['triwulan_3'])
				->setCellValue('L' . $column, $sisdata['triwulan_4']);


			$spreadsheet->getActiveSheet()->getStyle('A' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$column++;
		}
		$spreadsheet->getActiveSheet()->setTitle('Maping');

		$writer = new Xlsx($spreadsheet);
		$filename = 'Capaian Sasaran Renstra-Edit-' . date('Y-m-d-His');
		$extension = 'Xlsx';
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $extension);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename.{$extension}\"");
		$writer->save('php://output');
		exit();
	}
	public function simpanExcel_edit()
	{
		$file_excel = $this->request->getFile('fileexcel');
		$ext = $file_excel->getClientExtension();
		if ($ext == 'xls') {
			$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} else {
			$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $render->load($file_excel);

		$data = $spreadsheet->getActiveSheet()->toArray();
		foreach ($data as $x => $row) {
			if ($x == 0) {
				continue;
			}
			$simpandata = [
				// 'opd_tujuan_n' => preg_replace("/\r|\n/", "", $row[1]),
				// 'rpjmd_sasaran_n' => preg_replace("/\r|\n/", "", $row[2]),
				// 'opd_sasaran' => preg_replace("/\r|\n/", "", $row[3]),
				// 'opd_kode_sasaran' => $row[4],
				// 'opd_indikator_sasaran' => preg_replace("/\r|\n/", "", $row[5]),
				// 'satuan' => $row[6],
				// 't_tahun' => $row[7],
				'triwulan_1' => $row[8],
				'triwulan_2' => $row[9],
				'triwulan_3' => $row[10],
				'triwulan_4' => $row[11],
				'updated_by' => user()->full_name,
			];
			$id = [
				'id_opd_sasaran' => $row[0],
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
				'tahun' => $_SESSION['tahun'],
			];
			$this->opd_capaian_sasaran->set($simpandata)->where($id)->update();

			// $this->opd_sasaran->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/renstra_capaian/opd_capaian_sasaran');
	}
}
