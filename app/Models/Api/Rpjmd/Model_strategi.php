<?php

namespace App\Models\Api\Rpjmd;

use CodeIgniter\Model;

class Model_strategi extends Model
{
	public function strategi()
	{
		return $this->db->table('tb_rpjmd_strategi')
			->distinct('tb_rpjmd_strategi.*, tb_rpjmd_sasaran.kode_sasaran')
			->select('tb_rpjmd_strategi.*, tb_rpjmd_sasaran.kode_sasaran')
			->join('tb_rpjmd_sasaran', 'tb_rpjmd_strategi.sasaran_n = tb_rpjmd_sasaran.sasaran', 'left')->get()->getResultArray();
	}
}
