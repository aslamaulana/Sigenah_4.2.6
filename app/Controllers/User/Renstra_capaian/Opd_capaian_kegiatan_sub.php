<?php

namespace App\Controllers\User\Renstra_capaian;

use App\Controllers\BaseController;
use App\Models\User\Renstra\Model_opd_kegiatan_sub;
use App\Models\User\Renstra_capaian\Model_opd_capaian_kegiatan_sub;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Opd_capaian_kegiatan_sub extends BaseController
{
	protected $opd_kegiatan_sub, $opd_capaian_kegiatan_sub, $tahun;

	public function __construct()
	{
		$this->opd_capaian_kegiatan_sub = new Model_opd_capaian_kegiatan_sub();
		$this->opd_kegiatan_sub = new Model_opd_kegiatan_sub();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra_capaian',
				'mn' => 'opd_capaian_kegiatan_sub',
				'title' => 'User | Sub Kegiatan',
				'lok' => '<b>Sub Kegiatan</b>',
				'opd_kegiatan_sub' => $this->opd_capaian_kegiatan_sub->kegiatan_sub(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Renstra_capaian/opd_kegiatan_sub', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function opd_kegiatan_sub_edit($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra_capaian',
				'mn' => 'opd_capaian_kegiatan_sub',
				'title' => 'User | Sub Kegiatan',
				'lok' => '<a href=".">Sub Kegiatan</a> -> <b>Ubah Sub Kegiatan</b>',
				'opd_kegiatan_sub' => $this->opd_capaian_kegiatan_sub->find($id),
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Renstra_capaian/opd_kegiatan_sub_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sub_update()
	{
		if (has_permission('User')) :
			$this->opd_capaian_kegiatan_sub->save([
				'id_opd_kegiatan_sub' => $this->request->getVar('id_kegiatan_sub'),
				'triwulan_1' => $this->request->getVar('triwulan_1'),
				'penghambat_1' => $this->request->getVar('penghambat_1'),
				'pendukung_1' => $this->request->getVar('pendukung_1'),
				'tindak_lanjut_1' => $this->request->getVar('tindak_lanjut_1'),
				'triwulan_2' => $this->request->getVar('triwulan_2'),
				'penghambat_2' => $this->request->getVar('penghambat_2'),
				'pendukung_2' => $this->request->getVar('pendukung_2'),
				'tindak_lanjut_2' => $this->request->getVar('tindak_lanjut_2'),
				'triwulan_3' => $this->request->getVar('triwulan_3'),
				'penghambat_3' => $this->request->getVar('penghambat_3'),
				'pendukung_3' => $this->request->getVar('pendukung_3'),
				'tindak_lanjut_3' => $this->request->getVar('tindak_lanjut_3'),
				'triwulan_4' => $this->request->getVar('triwulan_4'),
				'penghambat_4' => $this->request->getVar('penghambat_4'),
				'pendukung_4' => $this->request->getVar('pendukung_4'),
				'tindak_lanjut_4' => $this->request->getVar('tindak_lanjut_4'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra_capaian/opd_capaian_kegiatan_sub');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------------------------------
	public function hapusAll()
	{
		if (has_permission('User')) :
			try {
				$this->opd_kegiatan_sub->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id])->delete();
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->to(base_url() . '/user/renstra/opd_kegiatan_sub/');
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/renstra/opd_kegiatan_sub/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------------------------------------------------------------------
	public function import()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra_capaian',
				'mn' => 'opd_capaian_kegiatan_sub',
				'title' => 'User | Sub Kegiatan',
				'lok' => '<a onclick="history.back(-1)" href="#">Sub Kegiatan</a> -> <b>Import Data</b>',
			];
			echo view('user/Renstra_capaian/opd_kegiatan_sub_import', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function import_kegiatan_sub()
	{
		if (has_permission('User')) :
			$data = $this->opd_kegiatan_sub->where(['perubahan' => 'Perubahan', 'opd_id' => user()->opd_id])->findAll();
			foreach ($data as $key => $val) {
				$result[] = array(
					'opd_kegiatan_n' => $data[$key]['opd_kegiatan_n'],
					'opd_kegiatan_sub_n' => $data[$key]['opd_kegiatan_sub_n'],
					'opd_indikator_kegiatan_sub' => $data[$key]['opd_indikator_kegiatan_sub'],
					'satuan' => $data[$key]['satuan'],
					't_tahun' => $data[$key]['t_' . $_SESSION['tahun']],
					'opd_id' => user()->opd_id,
					'tahun' => $_SESSION['tahun'],
					'perubahan' => $_SESSION['perubahan'],
					'created_by' => user()->full_name,
				);
			}
			$this->opd_capaian_kegiatan_sub->insertBatch($result);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra_capaian/opd_capaian_kegiatan_sub');

		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ----------------------------------------------------------------------
	public function export_edit()
	{
		$sisw = $this->opd_capaian_kegiatan_sub->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun']])->findAll();
		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:V1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'ID')
			->setCellValue('B1', 'Kegiatan')
			->setCellValue('C1', 'Sub Kegiatan')
			->setCellValue('D1', 'Indikator Kegiatan')
			->setCellValue('E1', 'Satuan')
			->setCellValue('F1', 't_tahun')
			->setCellValue('G1', 'triwulan_1')
			->setCellValue('H1', 'penghambat_1')
			->setCellValue('I1', 'pendukung_1')
			->setCellValue('J1', 'tindak_lanjut_1')
			->setCellValue('K1', 'triwulan_2')
			->setCellValue('L1', 'penghambat_2')
			->setCellValue('M1', 'pendukung_2')
			->setCellValue('N1', 'tindak_lanjut_2')
			->setCellValue('O1', 'triwulan_3')
			->setCellValue('P1', 'penghambat_3')
			->setCellValue('Q1', 'pendukung_3')
			->setCellValue('R1', 'tindak_lanjut_3')
			->setCellValue('S1', 'triwulan_4')
			->setCellValue('T1', 'penghambat_4')
			->setCellValue('U1', 'pendukung_4')
			->setCellValue('V1', 'tindak_lanjut_4');

		$column = 2;

		foreach ($sisw as $sisdata) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $sisdata['id_opd_kegiatan_sub'])
				->setCellValue('B' . $column, $sisdata['opd_kegiatan_n'])
				->setCellValue('C' . $column, $sisdata['opd_kegiatan_sub_n'])
				->setCellValue('D' . $column, $sisdata['opd_indikator_kegiatan_sub'])
				->setCellValue('E' . $column, $sisdata['satuan'])
				->setCellValue('F' . $column, $sisdata['t_tahun'])
				->setCellValue('G' . $column, $sisdata['triwulan_1'])
				->setCellValue('H' . $column, $sisdata['penghambat_1'])
				->setCellValue('I' . $column, $sisdata['pendukung_1'])
				->setCellValue('J' . $column, $sisdata['tindak_lanjut_1'])
				->setCellValue('K' . $column, $sisdata['triwulan_2'])
				->setCellValue('L' . $column, $sisdata['penghambat_2'])
				->setCellValue('M' . $column, $sisdata['pendukung_2'])
				->setCellValue('N' . $column, $sisdata['tindak_lanjut_2'])
				->setCellValue('O' . $column, $sisdata['triwulan_3'])
				->setCellValue('P' . $column, $sisdata['penghambat_3'])
				->setCellValue('Q' . $column, $sisdata['pendukung_3'])
				->setCellValue('R' . $column, $sisdata['tindak_lanjut_3'])
				->setCellValue('S' . $column, $sisdata['triwulan_4'])
				->setCellValue('T' . $column, $sisdata['penghambat_4'])
				->setCellValue('U' . $column, $sisdata['pendukung_4'])
				->setCellValue('V' . $column, $sisdata['tindak_lanjut_4']);


			$spreadsheet->getActiveSheet()->getStyle('A' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$column++;
		}
		$spreadsheet->getActiveSheet()->setTitle('Maping');

		$writer = new Xlsx($spreadsheet);
		$filename = 'Capaian Kegiatan Renstra-Edit-' . date('Y-m-d-His');
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
				// 'opd_sasaran_n' => preg_replace("/\r|\n/", "", $row[1]),
				// 'opd_program_n' => preg_replace("/\r|\n/", "", $row[2]),
				// 'opd_program_sasaran_n' => preg_replace("/\r|\n/", "", $row[3]),
				// 'opd_indikator_program' => preg_replace("/\r|\n/", "", $row[4]),
				// 'satuan' => $row[5],
				// 't_tahun' => $row[6],
				'triwulan_1' => $row[6],
				'penghambat_1' => $row[7],
				'pendukung_1' => $row[8],
				'tindak_lanjut_1' => $row[9],

				'triwulan_2' => $row[10],
				'penghambat_2' => $row[11],
				'pendukung_2' => $row[12],
				'tindak_lanjut_2' => $row[13],

				'triwulan_3' => $row[14],
				'penghambat_3' => $row[15],
				'pendukung_3' => $row[16],
				'tindak_lanjut_3' => $row[17],

				'triwulan_4' => $row[18],
				'penghambat_4' => $row[19],
				'pendukung_4' => $row[20],
				'tindak_lanjut_4' => $row[21],

				'updated_by' => user()->full_name,
			];
			$id = [
				'id_opd_kegiatan_sub' => $row[0],
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
				'tahun' => $_SESSION['tahun'],
			];
			$this->opd_capaian_kegiatan_sub->set($simpandata)->where($id)->update();

			// $this->opd_sasaran->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/renstra_capaian/opd_capaian_kegiatan_sub');
	}
}
