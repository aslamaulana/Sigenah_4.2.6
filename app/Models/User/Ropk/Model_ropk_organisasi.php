<?php

namespace App\Models\User\Ropk;

use CodeIgniter\Model;

class Model_ropk_organisasi extends Model
{
	protected $table = 'tb_ropk_organisasi';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_ropk_organisasi';
	protected $allowedFields = [
		'rkpd_kegiatan',
		'rkpd_kegiatan_sub',
		'ropk_group',
		'rkpd_indikator_kegiatan_sub',
		'ropk_tahap_aktivitas',
		'ropk_bobot_acuan',
		'ropk_sasaran',
		'ropk_sasaran_target',
		'ropk_sasaran_satuan',
		'b1',
		'b2',
		'b3',
		'b4',
		'b5',
		'b6',
		'b7',
		'b8',
		'b9',
		'b10',
		'b11',
		'b12',
		'tahun',
		'perubahan',
		'opd_id',
		'nip',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];
}
