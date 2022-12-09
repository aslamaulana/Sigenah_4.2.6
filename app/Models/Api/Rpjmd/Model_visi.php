<?php

namespace App\Models\Api\Rpjmd;

use CodeIgniter\Model;

class Model_visi extends Model
{
	public function visi()
	{
		return $this->db->table('tb_misi')
			->select('tb_misi.visi, tb_misi.misi, tb_misi.kode_misi, tb_visi.id_visi, tb_visi.kode_visi, tb_misi.id_misi')
			->join('tb_visi', 'tb_misi.visi = tb_visi.visi', 'LIFE')
			->get()->getResultArray();
	}
}
