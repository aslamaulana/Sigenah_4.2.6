<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_arah_kebijakan extends Model
{
	protected $table = 'tb_rpjmd_arah_kebijakan';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_arah_kebijakan';
	protected $allowedFields = ['arah_kebijakan', 'strategi_n', 'arah_kebijakan_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function arah_kebijakan()
	{
		return $this->db->table('tb_rpjmd_arah_kebijakan')
			->select('tb_rpjmd_arah_kebijakan.*')
			->select('tb_rpjmd_strategi.strategi_n')

			->join('tb_rpjmd_strategi', 'tb_rpjmd_strategi.strategi = tb_rpjmd_arah_kebijakan.strategi_n', 'left')
			->get()->getResultArray();
	}
	public function arah_kebijakanEdit($id)
	{
		return $this->db->table('tb_rpjmd_arah_kebijakan')
			->select('tb_rpjmd_arah_kebijakan.*')
			->select('tb_rpjmd_strategi.strategi_n')

			->join('tb_rpjmd_strategi', 'tb_rpjmd_strategi.strategi = tb_rpjmd_arah_kebijakan.strategi_n', 'left')
			->getWhere(['tb_rpjmd_arah_kebijakan.id_arah_kebijakan' => $id])->getRowArray();
	}
}
