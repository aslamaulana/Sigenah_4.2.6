<?php

namespace App\Controllers\User\Rkpd;

use App\Controllers\BaseController;
use App\Models\User\Rkpd\Model_opd_kegiatan_sub;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Opd_error_fix extends BaseController
{
	protected $opd_kegiatan_sub, $satuan, $tahun;

	public function __construct()
	{
		$this->opd_kegiatan_sub = new Model_opd_kegiatan_sub();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'rkpd',
				'mn' => 'opd_renstra_error_fix',
				'title' => 'User | Sub kegiatan',
				'lok' => '<b>Error Fix</b>',
				// 'opd_kegiatan_sub' => $this->opd_kegiatan_sub->kegiatan_sub(),
				// 'tahunA' => $this->tahun->tahunA(),
				// 'db' => \Config\Database::connect(),
			];
			echo view('user/Rkpd/opd_error_fix', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------------------------------------------------------------------
	public function hapusAll()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			try {
				$this->opd_kegiatan_sub->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun']])->delete();
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan_sub/');
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan_sub/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// --------------------------------------------------------------------------------
	public function export_edit()
	{
		$data = $this->opd_kegiatan_sub->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun']])->findAll();
		$tahun = $_SESSION['tahun'];

		$spreadsheet = new Spreadsheet();

		$spreadsheet->getActiveSheet()->getStyle('A1:J1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'RKPD Kegiatan')
			->setCellValue('B1', 'RENJA Sub Kegiatan')
			->setCellValue('C1', 'Indikator Sub Kegiatan')
			->setCellValue('D1', 'Satuan')
			->setCellValue('E1', 'Target ' . $tahun)
			->setCellValue('F1', 'Pagu ' . $tahun)
			->setCellValue('G1', 'Target ' . $tahun + 1)
			->setCellValue('H1', 'Pagu ' . $tahun + 1)
			->setCellValue('I1', 'Lokasi')
			->setCellValue('J1', 'Sumber Dana');

		$column = 2;

		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $row['rkpd_kegiatan_n'])
				->setCellValue('B' . $column, $row['rkpd_kegiatan_sub_n'])
				->setCellValue('C' . $column, $row['rkpd_indikator_kegiatan_sub'])
				->setCellValue('D' . $column, $row['satuan'])
				->setCellValue('E' . $column, $row['t_tahun'])
				->setCellValue('F' . $column, $row['rp_tahun'])
				->setCellValue('G' . $column, $row['t_tahun+n'])
				->setCellValue('H' . $column, $row['rp_tahun+n'])
				->setCellValue('I' . $column, $row['lokasi'])
				->setCellValue('J' . $column, $row['sumber_dana']);
			$spreadsheet->getActiveSheet()->getStyle('A' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'Sub Kegiatan renja-Backup - (' . $tahun . ') - ' . date('Y-m-d-His');
		$extension = 'Xlsx';
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $extension);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename.{$extension}\"");
		$writer->save('php://output');
		exit();
	}
}
