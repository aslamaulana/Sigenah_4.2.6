<?php

namespace App\Models\Admin\Menu;

use CodeIgniter\Model;

class Model_satuan extends Model
{
	protected $table = 'tb_satuan';
	// protected $useTimestamps = true;
	protected $primaryKey = 'id_satuan';
	protected $allowedFields = ['satuan', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
