<?php

namespace App\Controllers\User\Ropk;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_satuan;
use App\Models\User\Ropk\Model_ropk_organisasi_kegiatan_sub;
use App\Models\User\Ropk\Model_ropk_organisasi;
use App\Models\User\Rkpd\Model_opd_kegiatan_sub;
use App\Models\Admin\RPJMD\Model_tahun;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Ropk_organisasi extends BaseController
{
	protected $ropk_kegiatan_sub, $satuan, $tahun, $rkpd_kegiatan_sub, $ropk_organisasi;

	public function __construct()
	{
		$this->ropk_kegiatan_sub = new Model_ropk_organisasi_kegiatan_sub();
		$this->rkpd_kegiatan_sub = new Model_opd_kegiatan_sub();
		$this->ropk_organisasi = new Model_ropk_organisasi();
		$this->satuan = new Model_satuan();
		$this->tahun = new Model_tahun();
	}
	public function organisasi($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'ropk',
				'mn' => 'ropk_organisasi',
				'title' => 'User | Cantik Organisasi',
				'lok' => 'Sub Kegiatan -> <b>Cantik Organisasi</b>',
				'DT' => $this->ropk_kegiatan_sub->find($id),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Ropk/ropk_organisasi', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function grafik()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'ropk',
				'mn' => 'ropk_organisasi',
				'title' => 'User | Cantik Organisasi',
				'lok' => 'Sub Kegiatan -> <a onclick="history.back(-1)" href="#">Cantik Organisasi</a> -> <b>Grafik</b>',
				//'rkpd_kegiatan' => $this->ropk_kegiatan_sub->where(['rkpd_kegiatan_n' => $_GET['k'], 'rkpd_kegiatan_sub_n' => $_GET['s']])->findAll(),
				'rkpd_kegiatan' => $this->ropk_kegiatan_sub->where(['rkpd_kegiatan_n' => $_GET['k'], 'rkpd_kegiatan_sub_n' => $_GET['s'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan']])->findAll(),
				'db' => \Config\Database::connect(),
			];
			// dd($data);
			echo view('user/Ropk/ropk_organisasi_grafik', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function organisasi_add($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'ropk',
				'mn' => 'ropk_organisasi',
				'title' => 'User | Cantik Organisasi',
				'lok' => 'Sub Kegiatan -> <a onclick="history.back(-1)" href="#">Cantik Organisasi</a> -> <b>Tambah Tahap Aktivitas</b>',
				'DT' => $this->ropk_kegiatan_sub->find($id),
				'satuan' => $this->satuan->satuan(),
			];
			echo view('user/Ropk/ropk_organisasi_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function organisasi_create()
	{
		if (has_permission('User')) :

			$this->ropk_organisasi->save([
				'rkpd_kegiatan' => $this->request->getVar('kegiatan'),
				'rkpd_kegiatan_sub' => $this->request->getVar('kegiatan_sub'),
				'ropk_tahap' => $this->request->getVar('tahap'),
				'rkpd_indikator_kegiatan_sub' => $this->request->getVar('indikator_kegiatan_sub'),
				'ropk_group' => $this->request->getVar('group'),
				'ropk_tahap_aktivitas' => $this->request->getVar('aktifitas'),
				'ropk_sasaran' => $this->request->getVar('ropk_sasaran'),
				'ropk_sasaran_target' => $this->request->getVar('ropk_sasaran_target'),
				'ropk_sasaran_satuan' => $this->request->getVar('satuan'),
				'ropk_bobot_acuan' => $this->request->getVar('bobot_acuan'),
				'b1' => $this->request->getVar('b1'),
				'b2' => $this->request->getVar('b2'),
				'b3' => $this->request->getVar('b3'),
				'b4' => $this->request->getVar('b4'),
				'b5' => $this->request->getVar('b5'),
				'b6' => $this->request->getVar('b6'),
				'b7' => $this->request->getVar('b7'),
				'b8' => $this->request->getVar('b8'),
				'b9' => $this->request->getVar('b9'),
				'b10' => $this->request->getVar('b10'),
				'b11' => $this->request->getVar('b11'),
				'b12' => $this->request->getVar('b12'),
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/ropk/ropk_organisasi/organisasi/' . $this->request->getVar('id'));
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function organisasi_edit($id, $sub = '')
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'ropk',
				'mn' => 'ropk_organisasi',
				'title' => 'User | Cantik Organisasi',
				'lok' => 'Sub Kegiatan -> <a onclick="history.back(-1)" href="#">Cantik Organisasi</a> -> <b>Tambah Tahap Aktivitas</b>',
				'satuan' => $this->satuan->satuan(),
				'DT' => $this->ropk_kegiatan_sub->find($sub),
				'organisasi' => $this->ropk_organisasi->find($id),
			];
			echo view('user/Ropk/ropk_organisasi_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function organisasi_update()
	{
		if (has_permission('User')) :

			$this->ropk_organisasi->save([
				'id_ropk_organisasi' => $this->request->getVar('id'),
				'ropk_group' => $this->request->getVar('group'),
				'ropk_tahap_aktivitas' => $this->request->getVar('aktifitas'),
				'ropk_sasaran' => $this->request->getVar('ropk_sasaran'),
				'ropk_sasaran_target' => $this->request->getVar('ropk_sasaran_target'),
				'ropk_sasaran_satuan' => $this->request->getVar('satuan'),
				'ropk_bobot_acuan' => $this->request->getVar('bobot_acuan'),
				'tahun' => $_SESSION['tahun'],
				'b1' => $this->request->getVar('b1'),
				'b2' => $this->request->getVar('b2'),
				'b3' => $this->request->getVar('b3'),
				'b4' => $this->request->getVar('b4'),
				'b5' => $this->request->getVar('b5'),
				'b6' => $this->request->getVar('b6'),
				'b7' => $this->request->getVar('b7'),
				'b8' => $this->request->getVar('b8'),
				'b9' => $this->request->getVar('b9'),
				'b10' => $this->request->getVar('b10'),
				'b11' => $this->request->getVar('b11'),
				'b12' => $this->request->getVar('b12'),
				'opd_id' => user()->opd_id,
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/ropk/ropk_organisasi/organisasi/' . $this->request->getVar('id_sub'));
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function organisasi_hapus($id)
	{
		if (has_permission('User')) :
			try {
				$this->ropk_organisasi->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->back();
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/* ------------------------------------Data RKPD organisasi-----------------------------------
	---------------------------------------Data RKPD organisasi-----------------------------------
	---------------------------------------Data RKPD organisasi-----------------------------------
	---------------------------------------Data RKPD organisasi-------------------------------- */

	public function pindah()
	{
		if (has_permission('User')) :

			$data = $this->rkpd_kegiatan_sub->where(['perubahan' => $_SESSION['perubahan'], 'tahun' => $_SESSION['tahun'], 'opd_id' => user()->opd_id])->findAll();
			foreach ($data as $key => $val) {
				$result[] = array(
					'rkpd_kegiatan_n' => $data[$key]['rkpd_kegiatan_n'],
					'rkpd_kegiatan_sub_n' => $data[$key]['rkpd_kegiatan_sub_n'],
					'rkpd_indikator_kegiatan_sub' => $data[$key]['rkpd_indikator_kegiatan_sub'],
					'satuan' => $data[$key]['satuan'],
					't_tahun' => $data[$key]['t_tahun'],
					'rp_tahun' => $data[$key]['rp_tahun'],
					't_tahun+n' => $data[$key]['t_tahun+n'],
					'rp_tahun+n' => $data[$key]['rp_tahun+n'],
					'lokasi' => $data[$key]['lokasi'],
					'sumber_dana' => $data[$key]['sumber_dana'],

					'tahun' => $_SESSION['tahun'],
					'perubahan' => $_SESSION['perubahan'],
					'opd_id' => user()->opd_id,
					'created_by' => user()->full_name,
				);
			}
			$this->ropk_kegiatan_sub->insertBatch($result);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/ropk/ropk_kegiatan_sub/organisasi');

		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	/* ------------------------------------Data RKPD organisasi-----------------------------------
	---------------------------------------Data RKPD organisasi-----------------------------------
	---------------------------------------Data RKPD organisasi-----------------------------------
	---------------------------------------Data RKPD organisasi-------------------------------- */

	public function import($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'ropk',
				'mn' => 'ropk_organisasi',
				'title' => 'User | Cantik Organisasi',
				'lok' => 'Sub Kegiatan -> <a onclick="history.back(-1)" href="#">Cantik Organisasi</a> -> <b>Import Data</b>',
				'DT' => $this->ropk_kegiatan_sub->find($id),
			];
			echo view('user/Ropk/ropk_organisasi_import', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function export()
	{
		$data = $this->ropk_kegiatan_sub->where([
			'rkpd_kegiatan_n' => $_GET['k'],
			'rkpd_kegiatan_sub_n' => $_GET['s'],
			'opd_id' => user()->opd_id,
			'tahun' => $_SESSION['tahun'],
			'perubahan' => $_SESSION['perubahan'],
		])->findAll();

		$spreadsheet = new Spreadsheet();

		$tahun = $_SESSION['tahun'];

		$spreadsheet->getActiveSheet()->getStyle('A1:U1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Rkpd Kegiatan')
			->setCellValue('B1', 'Rkpd Sub Kegiatan')
			->setCellValue('C1', 'Indikator Sub Kegiatan (keluaran)')
			->setCellValue('D1', 'Group')
			->setCellValue('E1', 'Rk Tahap Aktivitas')
			->setCellValue('F1', 'Sasaran Tahap Aktivitas')
			->setCellValue('G1', 'Target Tahap Aktivitas')
			->setCellValue('H1', 'Satuan Target')
			->setCellValue('I1', 'Bobot Acuan')
			->setCellValue('J1', 'B1')
			->setCellValue('K1', 'B2')
			->setCellValue('L1', 'B3')
			->setCellValue('M1', 'B4')
			->setCellValue('N1', 'B5')
			->setCellValue('O1', 'B6')
			->setCellValue('P1', 'B7')
			->setCellValue('Q1', 'B8')
			->setCellValue('R1', 'B9')
			->setCellValue('S1', 'B10')
			->setCellValue('T1', 'B11')
			->setCellValue('U1', 'B12');

		$column = 2;

		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $_GET['k'])
				->setCellValue('B' . $column, $_GET['s'])
				->setCellValue('C' . $column, $row['rkpd_indikator_kegiatan_sub']);

			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'RK - ' . substr($_GET['s'], 0, 200) . '... (' . $_SESSION['tahun'] . ') - ' . date('Y-m-d-His');
		$extension = 'Xlsx';
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $extension);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename.{$extension}\"");
		$writer->save('php://output');
		exit();
	}
	public function simpanExcel()
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
				'rkpd_kegiatan' => $row[0],
				'rkpd_kegiatan_sub' => $row[1],
				'rkpd_indikator_kegiatan_sub' => $row[2],
				'ropk_group' => $row[3],
				'ropk_tahap_aktivitas' => $row[4],
				'ropk_sasaran' => $row[5],
				'ropk_sasaran_target' => $row[6],
				'ropk_sasaran_satuan' => $row[7],
				'ropk_bobot_acuan' => empty($row[8]) ? '0' : $row[8],
				'b1' => empty($row[9]) ? '0' : $row[9],
				'b2' => empty($row[10]) ? '0' : $row[10],
				'b3' => empty($row[11]) ? '0' : $row[11],
				'b4' => empty($row[12]) ? '0' : $row[12],
				'b5' => empty($row[13]) ? '0' : $row[13],
				'b6' => empty($row[14]) ? '0' : $row[14],
				'b7' => empty($row[15]) ? '0' : $row[15],
				'b8' => empty($row[16]) ? '0' : $row[16],
				'b9' => empty($row[17]) ? '0' : $row[17],
				'b10' => empty($row[18]) ? '0' : $row[18],
				'b11' => empty($row[19]) ? '0' : $row[19],
				'b12' => empty($row[20]) ? '0' : $row[20],

				'tahun' => $_SESSION['tahun'],
				'perubahan' => $_SESSION['perubahan'],
				'opd_id' => user()->opd_id,
				'created_by' => user()->full_name,
			];

			$this->ropk_organisasi->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/ropk/ropk_organisasi/organisasi/' . $this->request->getVar('id'));
	}
	// ---------------------------------------------------------------
	public function export_edit()
	{
		$data = $this->ropk_organisasi->where([
			'rkpd_kegiatan' => $_GET['k'],
			'rkpd_kegiatan_sub' => $_GET['s'],
			'opd_id' => user()->opd_id,
			'tahun' => $_SESSION['tahun'],
			'perubahan' => $_SESSION['perubahan']
		])->findAll();

		$spreadsheet = new Spreadsheet();

		$spreadsheet->getActiveSheet()->getStyle('A1:V1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'ID')
			->setCellValue('B1', 'Rkpd Kegiatan')
			->setCellValue('C1', 'Rkpd Sub Kegiatan')
			->setCellValue('D1', 'Indikator Sub Kegiatan (keluaran)')
			->setCellValue('E1', 'Group')
			->setCellValue('F1', 'Rk Tahap Aktivitas')
			->setCellValue('G1', 'Sasaran Tahap Aktivitas')
			->setCellValue('H1', 'Target Tahap Aktivitas')
			->setCellValue('I1', 'Satuan Target')
			->setCellValue('J1', 'Bobot Acuan')
			->setCellValue('K1', 'B1')
			->setCellValue('L1', 'B2')
			->setCellValue('M1', 'B3')
			->setCellValue('N1', 'B4')
			->setCellValue('O1', 'B5')
			->setCellValue('P1', 'B6')
			->setCellValue('Q1', 'B7')
			->setCellValue('R1', 'B8')
			->setCellValue('S1', 'B9')
			->setCellValue('T1', 'B10')
			->setCellValue('U1', 'B11')
			->setCellValue('V1', 'B12');

		$column = 2;

		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $row['id_ropk_organisasi'])
				->setCellValue('B' . $column, $row['rkpd_kegiatan'])
				->setCellValue('C' . $column, $row['rkpd_kegiatan_sub'])
				->setCellValue('D' . $column, $row['rkpd_indikator_kegiatan_sub'])
				->setCellValue('E' . $column, $row['ropk_group'])
				->setCellValue('F' . $column, $row['ropk_tahap_aktivitas'])
				->setCellValue('G' . $column, $row['ropk_sasaran'])
				->setCellValue('H' . $column, $row['ropk_sasaran_target'])
				->setCellValue('I' . $column, $row['ropk_sasaran_satuan'])
				->setCellValue('J' . $column, $row['ropk_bobot_acuan'])
				->setCellValue('K' . $column, $row['b1'])
				->setCellValue('L' . $column, $row['b2'])
				->setCellValue('M' . $column, $row['b3'])
				->setCellValue('N' . $column, $row['b4'])
				->setCellValue('O' . $column, $row['b5'])
				->setCellValue('P' . $column, $row['b6'])
				->setCellValue('Q' . $column, $row['b7'])
				->setCellValue('R' . $column, $row['b8'])
				->setCellValue('S' . $column, $row['b9'])
				->setCellValue('T' . $column, $row['b10'])
				->setCellValue('U' . $column, $row['b11'])
				->setCellValue('V' . $column, $row['b12']);

			$spreadsheet->getActiveSheet()->getStyle('A' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$spreadsheet->getActiveSheet()->getStyle('B' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$spreadsheet->getActiveSheet()->getStyle('C' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$spreadsheet->getActiveSheet()->getStyle('D' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'Edit RK - ' . substr($_GET['s'], 0, 200) . '... (' . $_SESSION['tahun'] . ') - ' . date('Y-m-d-His');
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
				'rkpd_kegiatan' => $row[1],
				'rkpd_kegiatan_sub' => $row[2],
				'rkpd_indikator_kegiatan_sub' => $row[3],
				'ropk_group' => $row[4],
				'ropk_tahap_aktivitas' => $row[5],
				'ropk_sasaran' => $row[6],
				'ropk_sasaran_target' => $row[7],
				'ropk_sasaran_satuan' => $row[8],
				'ropk_bobot_acuan' => empty($row[9]) ? '0' : $row[9],
				'b1' => empty($row[10]) ? '0' : $row[10],
				'b2' => empty($row[11]) ? '0' : $row['11'],
				'b3' => empty($row[12]) ? '0' : $row['12'],
				'b4' => empty($row[13]) ? '0' : $row['13'],
				'b5' => empty($row[14]) ? '0' : $row['14'],
				'b6' => empty($row[15]) ? '0' : $row['15'],
				'b7' => empty($row[16]) ? '0' : $row['16'],
				'b8' => empty($row[17]) ? '0' : $row['17'],
				'b9' => empty($row[18]) ? '0' : $row['18'],
				'b10' => empty($row[19]) ? '0' : $row['19'],
				'b11' => empty($row[20]) ? '0' : $row['20'],
				'b12' => empty($row[21]) ? '0' : $row['21'],

				'opd_id' => user()->opd_id,
				'updated_by' => user()->full_name,
			];
			$id = [
				'tahun' => $_SESSION['tahun'],
				'perubahan' => $_SESSION['perubahan'],
				'id_ropk_organisasi' => $row[0],
				'opd_id' => user()->opd_id,
			];
			$this->ropk_organisasi->set($simpandata)->where($id)->update();

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() .  '/user/ropk/ropk_organisasi/organisasi/' . $this->request->getVar('id'));
	}
}
