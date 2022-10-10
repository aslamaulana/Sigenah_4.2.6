<?php

namespace App\Models\User\Renstra_capaian;

use CodeIgniter\Model;

class Model_opd_capaian_sasaran extends Model
{
	protected $table = 'tb_renstra_capaian_sasaran';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_opd_sasaran';
	protected $allowedFields = [
		'opd_tujuan_n',
		'rpjmd_sasaran_n',
		'opd_kode_sasaran',
		'opd_sasaran',
		'opd_indikator_sasaran',
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
	public function sasaran()
	{
		return $this->db->table('tb_renstra_capaian_sasaran')
			->select('tb_renstra_capaian_sasaran.*, tb_rpjmd_sasaran.kode_sasaran, tb_renstra_capaian_tujuan.opd_kode_tujuan')
			->distinct('tb_renstra_capaian_sasaran.*, tb_rpjmd_sasaran.kode_sasaran, tb_renstra_capaian_tujuan.opd_kode_tujuan')
			->join('tb_rpjmd_sasaran', 'tb_renstra_capaian_sasaran.rpjmd_sasaran_n = tb_rpjmd_sasaran.sasaran', 'left')
			->join('tb_renstra_capaian_tujuan', 'tb_renstra_capaian_sasaran.opd_id = tb_renstra_capaian_tujuan.opd_id AND tb_renstra_capaian_sasaran.opd_tujuan_n = tb_renstra_capaian_tujuan.opd_tujuan AND tb_renstra_capaian_sasaran.perubahan = tb_renstra_capaian_tujuan.perubahan', 'left')
			->orderBy('tb_renstra_capaian_sasaran.opd_kode_sasaran', 'ASC')
			->getWhere(['tb_renstra_capaian_sasaran.opd_id' => user()->opd_id, 'tb_renstra_capaian_sasaran.perubahan' => $_SESSION['perubahan']])->getResultArray();
	}
}
