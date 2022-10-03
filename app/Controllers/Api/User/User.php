<?php

namespace App\Controllers\Api\User;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Api\User\Model_users;

class User extends BaseController
{
	use ResponseTrait;

	public function index()
	{
		$users = new Model_users;
		return $this->respond(['users' => $users->findAll()], 200);
	}
}
