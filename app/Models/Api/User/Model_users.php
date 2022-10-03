<?php

namespace App\Models\Api\User;

use CodeIgniter\Model;

class Model_users extends Model
{
	protected $table = 'api_user';
	protected $useTimestamps = true;
	// protected $useAutoIncrement = false;
	protected $primaryKey = 'id';
	protected $allowedFields = ['email', 'password', 'created_at', 'updated_at'];
}
