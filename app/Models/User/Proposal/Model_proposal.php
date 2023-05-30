<?php

namespace App\Models\User\Proposal;

use CodeIgniter\Model;

class Model_proposal extends Model
{
	protected $table = 'tb_proposal';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_proposal';
	protected $allowedFields = [
		'usulan_kegiatan_id',
		'judul_kegiatan',
		'permasalahan',
		'usulan_anggaran',
		'titik_lokasi',
		'alamat',
		'dokumen',
		'size',
		'opd_id',
		'tahun',
		'perubahan',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];
}
