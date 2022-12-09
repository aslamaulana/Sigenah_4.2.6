<?php

namespace App\Models\Admin\Renstra;

use CodeIgniter\Model;

class Model_opd_dokumen extends Model
{
	protected $table = 'tb_renstra_dokumen';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_renstra_dokumen';
	protected $allowedFields = [
		'dokumen',
		'size',
		'keterangan',
		'opd_id',
		'tahun',
		'perubahan',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];

	public function opd()
	{
		return $this->db->table('auth_groups')
			->notLike('auth_groups.id', '0001')->get()->getResultArray();
	}
}
