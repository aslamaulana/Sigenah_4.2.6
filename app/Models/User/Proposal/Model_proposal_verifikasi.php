<?php

namespace App\Models\User\Proposal;

use CodeIgniter\Model;

class Model_proposal_verifikasi extends Model
{
	protected $table = 'tb_proposal_verifikasi';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_proposal_verifikasi';
	protected $allowedFields = [
		'proposal_id',
		'verifikasi',
		'syarat',
		'nama_singkat_bidang',
		'i_1',
		'c_1',
		'i_2',
		'c_2',
		'i_3',
		'c_3',
		'i_4',
		'c_4',
		'i_5',
		'c_5',
		'i_6',
		'c_6',
		'i_7',
		'c_7',
		'i_8',
		'c_8',
		'i_9',
		'c_9',
		'i_10',
		'c_10',
		'i_11',
		'c_11',
		'i_12',
		'c_12',
		'i_13',
		'c_13',
		'i_14',
		'c_14',
		'i_15',
		'c_15',
		'i_16',
		'c_16',
		'i_17',
		'c_17',
		'i_18',
		'c_18',
		'i_19',
		'c_19',
		'i_20',
		'c_20',
		'i_21',
		'c_21',
		'i_22',
		'c_22',
		'ii_1',
		'ii_c_1',
		'ii_2',
		'ii_c_2',
		'ii_3',
		'ii_c_3',
		'nm_verifikator',
		'opd_id',
		'tahun',
		'perubahan',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];
}
