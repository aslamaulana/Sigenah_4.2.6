<?php

namespace App\Models\User\Renstra_capaian;

use CodeIgniter\Model;

class Model_opd_capaian_kegiatan extends Model
{
	protected $table = 'tb_renstra_capaian_kegiatan';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_opd_kegiatan';
	protected $allowedFields = [
		'opd_kegiatan_n',
		'opd_kegiatan_sasaran_n',
		'opd_program_n',
		'opd_indikator_kegiatan',
		'satuan',
		't_tahun',
		'triwulan_1',
		'triwulan_2',
		'triwulan_3',
		'triwulan_4',
		'tahun',
		'opd_id',
		'perubahan',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];

	public function kegiatan()
	{
		return $this->db->table('tb_renstra_capaian_kegiatan')
			->join('set_kegiatan_90', 'tb_renstra_capaian_kegiatan.opd_kegiatan_n = set_kegiatan_90.kegiatan', 'left')
			->join('set_program_90', 'tb_renstra_capaian_kegiatan.opd_program_n = set_program_90.program', 'left')
			->orderBy('id_program ASC')
			->orderBy('id_kegiatan ASC')
			->getWhere(['tb_renstra_capaian_kegiatan.perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id])->getResultArray();
	}
}
