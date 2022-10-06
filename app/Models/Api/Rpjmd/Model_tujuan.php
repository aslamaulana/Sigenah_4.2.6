<?php

namespace App\Models\Api\Rpjmd;

use CodeIgniter\Model;

class Model_tujuan extends Model
{
	public function tujuan()
	{
		return $this->db->table('tb_rpjmd_tujuan')
			->select('tb_misi.kode_misi, tb_visi.kode_visi, tb_visi.visi, tb_rpjmd_tujuan.*')
			->join('tb_misi', 'tb_rpjmd_tujuan.misi_n = tb_misi.misi', 'left')
			->join('tb_visi', 'tb_misi.visi = tb_visi.visi', 'left')
			->get()->getResultArray();
	}
}
