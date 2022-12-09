<?php

namespace App\Models\User\Renstra_capaian;

use CodeIgniter\Model;

class Model_opd_capaian_tujuan extends Model
{
	protected $table = 'tb_renstra_capaian_tujuan';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_opd_tujuan';
	protected $allowedFields = [
		'opd_kode_tujuan',
		'opd_tujuan',
		'opd_indikator_tujuan',
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

	public function tujuanEdit()
	{
		return $this->db->table('tb_renstra_tujuan')
			->select('tb_renstra_tujuan.*');
	}
	public function tujuan()
	{
		return $this->db->table('tb_renstra_capaian_tujuan')->getWhere(['opd_id' => user()->opd_id, 'perubahan' => $_SESSION['perubahan']])->getResultArray();
	}
}
