<?php

namespace App\Models\User\Renstra_capaian;

use CodeIgniter\Model;

class Model_opd_capaian_kegiatan_sub extends Model
{
	protected $table = 'tb_renstra_capaian_kegiatan_sub';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_opd_kegiatan_sub';
	protected $allowedFields = [
		"id_opd_kegiatan_sub",
		"opd_kegiatan_n",
		"opd_kegiatan_sub_n",
		"opd_indikator_kegiatan_sub",
		"satuan",
		't_tahun',
		"triwulan_1",
		"penghambat_1",
		"pendukung_1",
		"tindak_lanjut_1",
		"triwulan_2",
		"penghambat_2",
		"pendukung_2",
		"tindak_lanjut_2",
		"triwulan_3",
		"penghambat_3",
		"pendukung_3",
		"tindak_lanjut_3",
		"triwulan_4",
		"penghambat_4",
		"pendukung_4",
		"tindak_lanjut_4",
		"opd_id",
		"tahun",
		"perubahan",
		"created_by",
		"updated_by",
		"created_at",
		"updated_at"
	];

	public function kegiatan_sub()
	{
		return $this->db->table('tb_renstra_capaian_kegiatan_sub')
			->select('tb_renstra_capaian_kegiatan_sub.*, set_sub_kegiatan_90.id_sub_kegiatan, set_kegiatan_90.id_kegiatan')
			->join('set_kegiatan_90', 'tb_renstra_capaian_kegiatan_sub.opd_kegiatan_n = set_kegiatan_90.kegiatan', 'left')
			->join('set_sub_kegiatan_90', 'tb_renstra_capaian_kegiatan_sub.opd_kegiatan_sub_n = set_sub_kegiatan_90.sub_kegiatan AND set_kegiatan_90.id_kegiatan = set_sub_kegiatan_90.kegiatan_id', 'left')
			->orderBy('id_kegiatan ASC')
			->orderBy('id_sub_kegiatan ASC')
			->getWhere(['tb_renstra_capaian_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id])->getResultArray();
	}
}
