<?php

namespace App\Models\User\Ropk;

use CodeIgniter\Model;

class Model_ropk_keuangan_kegiatan_sub extends Model
{
	protected $table = 'tb_ropk_keuangan_rkpd_kegiatan_sub';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_ropk_keuangan_rkpd_kegiatan_sub';
	protected $allowedFields = [
		'rkpd_kegiatan_n',
		'rkpd_kegiatan_sub_n',
		// 'rkpd_kegiatan_sub_sasaran_n',
		'rkpd_indikator_kegiatan_sub',
		'lokasi',
		'sumber_dana',
		'satuan',
		't_tahun',
		'rp_tahun',
		't_tahun+n',
		'rp_tahun+n',
		'opd_id',
		'tahun',
		'perubahan',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];

	public function Kegiatan()
	{
		return $this->db->table('tb_ropk_keuangan_rkpd_kegiatan_sub')
			->distinct('tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_n')
			->select('tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_n')
			->getWhere(['tb_ropk_keuangan_rkpd_kegiatan_sub.opd_id' => user()->opd_id, 'tb_ropk_keuangan_rkpd_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'tb_ropk_keuangan_rkpd_kegiatan_sub.tahun' => $_SESSION['tahun']])->getResultArray();
	}
	public function Program_simonela()
	{
		return $this->db->table('tb_ropk_keuangan_rkpd_kegiatan_sub')
			->distinct('tb_rkpd_program.rkpd_program_n')
			->select('tb_rkpd_program.rkpd_program_n')
			->join('tb_rkpd_kegiatan', 'tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_n = tb_rkpd_kegiatan.rkpd_kegiatan_n AND tb_ropk_keuangan_rkpd_kegiatan_sub.opd_id = tb_rkpd_kegiatan.opd_id AND	tb_ropk_keuangan_rkpd_kegiatan_sub.perubahan = tb_rkpd_kegiatan.perubahan AND tb_ropk_keuangan_rkpd_kegiatan_sub.tahun = tb_rkpd_kegiatan.tahun', 'LEFT')
			->join('tb_rkpd_program', 'tb_rkpd_kegiatan.rkpd_program_n = tb_rkpd_program.rkpd_program_n AND tb_rkpd_kegiatan.opd_id = tb_rkpd_program.opd_id AND tb_rkpd_kegiatan.tahun = tb_rkpd_program.tahun AND tb_rkpd_kegiatan.perubahan = tb_rkpd_program.perubahan', 'LEFT')
			->getWhere(['tb_ropk_keuangan_rkpd_kegiatan_sub.opd_id' => user()->opd_id, 'tb_ropk_keuangan_rkpd_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'tb_ropk_keuangan_rkpd_kegiatan_sub.tahun' => $_SESSION['tahun']])->getResultArray();
	}
	public function Kegiatan_sub()
	{
		return $this->db->table('tb_ropk_keuangan_rkpd_kegiatan_sub')
			->distinct('set_sub_kegiatan_90.id_sub_kegiatan, tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_sub_n')
			->select('set_sub_kegiatan_90.id_sub_kegiatan, tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_sub_n')
			->join('set_sub_kegiatan_90', 'tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_sub_n = set_sub_kegiatan_90.sub_kegiatan', 'LEFT')
			->getWhere(['tb_ropk_keuangan_rkpd_kegiatan_sub.opd_id' => user()->opd_id, 'tb_ropk_keuangan_rkpd_kegiatan_sub.tahun' => $_SESSION['tahun']])->getResultArray();
	}
	public function getRenstraKegiatan_sub()
	{
		return $this->db->table('tb_renstra_kegiatan_sub')
			->getWhere(['tb_renstra_kegiatan_sub.opd_id' => user()->opd_id])->getResultArray();
	}
	public function getProgram()
	{
		return $this->db->table('tb_rpjmd_program')
			->distinct('set_program_90.id_program,tb_rpjmd_program.program_90,tb_rpjmd_program.opd_id')
			->select('set_program_90.id_program,tb_rpjmd_program.program_90,tb_rpjmd_program.opd_id')
			->join('set_program_90', 'tb_rpjmd_program.program_90 = set_program_90.program', 'LEFT')
			->getWhere(['tb_rpjmd_program.opd_id' => user()->opd_id])->getResultArray();
	}
}
