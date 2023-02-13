<?php

namespace App\Controllers\Api\User;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Api\User\Model_users;
use \Firebase\JWT\JWT;

class Login extends BaseController
{
	use ResponseTrait;

	public function index()
	{
		$userModel = new Model_users();

		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');

		$user = $userModel->where('email', $email)->first();

		if (is_null($user)) {
			return $this->respond(['error' => 'Invalid username or password.'], 401);
		}

		$pwd_verify = password_verify($password, $user['password']);

		if (!$pwd_verify) {
			return $this->respond(['error' => 'Invalid username or password.'], 401);
		}

		$key = getenv('JWT_SECRET');
		$iat = time(); // current timestamp value
		// jwt valid for 60 days (60 seconds * 60 minutes * 24 hours * 60 days)
		//$expirationTime = $issuedAt + 60 * 60 * 24 * 60;
		// $exp = $iat + 3600;
		$exp = $iat + 60 * 60 * 24;

		$payload = array(
			"iss" => "Issuer of the JWT",
			"aud" => "Audience that the JWT",
			"sub" => "Subject of the JWT",
			"iat" => $iat, //Time the JWT issued at
			"exp" => $exp, // Expiration time of token
			"email" => $user['email'],
		);

		$token = JWT::encode($payload, $key, 'HS256');

		$response = [
			'message' => 'Login Succesful',
			'token' => $token
		];

		return $this->respond($response, 200);
	}
}
