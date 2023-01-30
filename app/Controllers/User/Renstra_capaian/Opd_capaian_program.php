<?php

namespace App\Controllers\User\Renstra_capaian;

use App\Controllers\BaseController;
use App\Models\User\Renstra\Model_opd_program;
use App\Models\User\Renstra_capaian\Model_opd_capaian_program;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Opd_capaian_program extends BaseController
{
	protected $opd_program, $opd_capaian_program, $tahun;

	public function __construct()
	{
		$this->opd_capaian_program = new Model_opd_capaian_program();
		$this->opd_program = new Model_opd_program();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra_capaian',
				'mn' => 'opd_capaian_program',
				'title' => 'User | Program',
				'lok' => '<b>Program</b>',
				'opd_program' => $this->opd_capaian_program->program(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Renstra_capaian/opd_program', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// -----------------------------------------------------------
	public function opd_program_edit($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra_capaian',
				'mn' => 'opd_capaian_program',
				'title' => 'User | Program',
				'lok' => '<a href="/user/renstra_capaian/opd_capaian_program">Capaian program</a> -> <b>Ubah program</b>',
				'program' => $this->opd_capaian_program->find($id),
				'validation' => \Config\Services::validation(),
			];
			// dd($data);
			echo view('user/Renstra_capaian/opd_program_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_program_update()
	{
		if (has_permission('User')) :
			$this->opd_capaian_program->save([
				'id_opd_program' => $this->request->getVar('id_program'),
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
			return redirect()->to(base_url() . '/user/renstra_capaian/opd_capaian_program');
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
				'mn' => 'opd_capaian_program',
				'title' => 'User | Program',
				'lok' => '<a onclick="history.back(-1)" href="#">Program</a> -> <b>Import Data</b>',
			];
			echo view('user/Renstra_capaian/opd_program_import', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function import_program()
	{
		if (has_permission('User')) :

			$data = $this->opd_program->where(['perubahan' => 'Perubahan', 'opd_id' => user()->opd_id])->findAll();
			foreach ($data as $key => $val) {
				$result[] = array(
					'opd_sasaran_n' => $data[$key]['opd_sasaran_n'],
					'opd_program_n' => $data[$key]['opd_program_n'],
					'opd_program_sasaran_n' => $data[$key]['opd_program_sasaran_n'],
					'opd_indikator_program' => $data[$key]['opd_indikator_program'],
					'satuan' => $data[$key]['satuan'],
					't_tahun' => $data[$key]['t_' . $_SESSION['tahun']],
					'opd_id' => user()->opd_id,
					'tahun' => $_SESSION['tahun'],
					'perubahan' => $_SESSION['perubahan'],
					'created_by' => user()->full_name,
				);
			}
			$this->opd_capaian_program->insertBatch($result);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra_capaian/opd_capaian_program');

		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------------------------------------------
	public function export_edit()
	{
		$sisw = $this->opd_capaian_program->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun']])->findAll();
		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:K1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'ID')
			->setCellValue('B1', 'Sasaran')
			->setCellValue('C1', 'Program')
			->setCellValue('D1', 'Sasaran Program')
			->setCellValue('E1', 'Indikator Program')
			->setCellValue('F1', 'Satuan')
			->setCellValue('G1', 't_tahun')
			->setCellValue('H1', 'triwulan_1')
			->setCellValue('I1', 'penghambat_1')
			->setCellValue('J1', 'pendukung_1')
			->setCellValue('K1', 'tindak_lanjut_1')
			->setCellValue('L1', 'triwulan_2')
			->setCellValue('M1', 'penghambat_2')
			->setCellValue('N1', 'pendukung_2')
			->setCellValue('O1', 'tindak_lanjut_2')
			->setCellValue('P1', 'triwulan_3')
			->setCellValue('Q1', 'penghambat_3')
			->setCellValue('R1', 'pendukung_3')
			->setCellValue('S1', 'tindak_lanjut_3')
			->setCellValue('T1', 'triwulan_4')
			->setCellValue('U1', 'penghambat_4')
			->setCellValue('V1', 'pendukung_4')
			->setCellValue('W1', 'tindak_lanjut_4');

		$column = 2;

		foreach ($sisw as $sisdata) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $sisdata['id_opd_program'])
				->setCellValue('B' . $column, $sisdata['opd_sasaran_n'])
				->setCellValue('C' . $column, $sisdata['opd_program_n'])
				->setCellValue('D' . $column, $sisdata['opd_program_sasaran_n'])
				->setCellValue('E' . $column, $sisdata['opd_indikator_program'])
				->setCellValue('F' . $column, $sisdata['satuan'])
				->setCellValue('G' . $column, $sisdata['t_tahun'])
				->setCellValue('H' . $column, $sisdata['triwulan_1'])
				->setCellValue('I' . $column, $sisdata['penghambat_1'])
				->setCellValue('J' . $column, $sisdata['pendukung_1'])
				->setCellValue('K' . $column, $sisdata['tindak_lanjut_1'])
				->setCellValue('L' . $column, $sisdata['triwulan_2'])
				->setCellValue('M' . $column, $sisdata['penghambat_2'])
				->setCellValue('N' . $column, $sisdata['pendukung_2'])
				->setCellValue('O' . $column, $sisdata['tindak_lanjut_2'])
				->setCellValue('P' . $column, $sisdata['triwulan_3'])
				->setCellValue('Q' . $column, $sisdata['penghambat_3'])
				->setCellValue('R' . $column, $sisdata['pendukung_3'])
				->setCellValue('S' . $column, $sisdata['tindak_lanjut_3'])
				->setCellValue('T' . $column, $sisdata['triwulan_4'])
				->setCellValue('U' . $column, $sisdata['penghambat_4'])
				->setCellValue('V' . $column, $sisdata['pendukung_4'])
				->setCellValue('W' . $column, $sisdata['tindak_lanjut_4']);


			$spreadsheet->getActiveSheet()->getStyle('A' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$column++;
		}
		$spreadsheet->getActiveSheet()->setTitle('Maping');

		$writer = new Xlsx($spreadsheet);
		$filename = 'Capaian Program Renstra-Edit-' . date('Y-m-d-His');
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
				'triwulan_1' => $row[7],
				'penghambat_1' => $row[8],
				'pendukung_1' => $row[9],
				'tindak_lanjut_1' => $row[10],

				'triwulan_2' => $row[11],
				'penghambat_2' => $row[12],
				'pendukung_2' => $row[13],
				'tindak_lanjut_2' => $row[14],

				'triwulan_3' => $row[15],
				'penghambat_3' => $row[16],
				'pendukung_3' => $row[17],
				'tindak_lanjut_3' => $row[18],

				'triwulan_4' => $row[19],
				'penghambat_4' => $row[20],
				'pendukung_4' => $row[21],
				'tindak_lanjut_4' => $row[22],

				'updated_by' => user()->full_name,
			];
			$id = [
				'id_opd_program' => $row[0],
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
				'tahun' => $_SESSION['tahun'],
			];
			$this->opd_capaian_program->set($simpandata)->where($id)->update();

			// $this->opd_sasaran->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/renstra_capaian/opd_capaian_program');
	}
}
