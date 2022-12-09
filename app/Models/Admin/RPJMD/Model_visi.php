<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_visi extends Model
{
	protected $table = 'tb_visi';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_visi';
	protected $allowedFields = ['visi', 'kode_visi', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function visi()
	{
		return $this->db->table('tb_misi')
			->select('tb_misi.visi, tb_misi.misi, tb_misi.kode_misi, tb_visi.id_visi, tb_visi.kode_visi, tb_misi.id_misi')
			->join('tb_visi', 'tb_misi.visi = tb_visi.visi', 'LIFE')
			->get()->getResultArray();
	}
}
