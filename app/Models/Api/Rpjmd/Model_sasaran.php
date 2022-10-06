<?php

namespace App\Models\Api\Rpjmd;

use CodeIgniter\Model;

class Model_sasaran extends Model
{
	public function sasaran()
	{
		return $this->db->table('tb_rpjmd_sasaran')
			->distinct('tb_rpjmd_tujuan.kode_tujuan, tb_rpjmd_sasaran.*')
			->select('tb_rpjmd_tujuan.kode_tujuan, tb_rpjmd_sasaran.*')
			->join('tb_rpjmd_tujuan', 'tb_rpjmd_sasaran.tujuan_n = tb_rpjmd_tujuan.tujuan', 'Left')->get()->getResultArray();
	}
}
