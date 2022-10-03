<?php

namespace App\Models\Api\Renstra;

use CodeIgniter\Model;

class Model_renstra_tujuan extends Model
{
	public function Api_tujuan($perubahan, $opd_id)
	{
		return $this->db->table('tb_renstra_tujuan')
			->select('opd_tujuan, opd_kode_tujuan, opd_id')
			->distinct('opd_tujuan, opd_kode_tujuan, opd_id')
			->getwhere(['opd_id' => $opd_id, 'perubahan' => $perubahan])->getResultArray();
	}
}
