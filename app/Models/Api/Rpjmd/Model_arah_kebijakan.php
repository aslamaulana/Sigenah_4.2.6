<?php

namespace App\Models\Api\Rpjmd;

use CodeIgniter\Model;

class Model_arah_kebijakan extends Model
{
	public function arah_kebijakan()
	{
		return $this->db->table('tb_rpjmd_arah_kebijakan')->select('*')->get()->getResultArray();
	}
}
