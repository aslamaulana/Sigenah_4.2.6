<?php

namespace App\Models\User\Renstra_capaian;

use CodeIgniter\Model;

class Model_opd_capaian_program extends Model
{
	protected $table = 'tb_renstra_capaian_program';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_opd_program';
	protected $allowedFields = [
		'opd_program_n',
		'opd_program_sasaran_n',
		'opd_sasaran_n',
		'opd_indikator_program',
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

	public function program()
	{
		return $this->db->table('tb_renstra_capaian_program')
			->join('set_program_90', 'tb_renstra_capaian_program.opd_program_n = set_program_90.program', 'left')
			->getWhere(['tb_renstra_capaian_program.perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id])->getResultArray();
	}
}
