<?php

namespace App\Models\Api\Ropk;

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

	public function Kegiatan($opd, $tahun, $perubahan)
	{
		return $this->db->table('tb_ropk_keuangan_rkpd_kegiatan_sub')
			->select('tb_ropk_keuangan_rkpd_kegiatan_sub.*')
			->join('set_kegiatan_90', 'tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_n = set_kegiatan_90.kegiatan', 'left')
			->join('set_sub_kegiatan_90', 'tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_sub_n = set_sub_kegiatan_90.sub_kegiatan AND set_kegiatan_90.id_kegiatan = set_sub_kegiatan_90.kegiatan_id', 'left')
			->getWhere([
				// 'tb_ropk_keuangan_rkpd_kegiatan_sub.opd_id' => $id,
				'tb_ropk_keuangan_rkpd_kegiatan_sub.opd_id' => $opd,
				'tb_ropk_keuangan_rkpd_kegiatan_sub.tahun' => $tahun,
				'tb_ropk_keuangan_rkpd_kegiatan_sub.perubahan' => $perubahan
			])->getResultArray();
	}
}
