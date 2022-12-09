<?php

namespace App\Controllers\Api\Renstra;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Api\Renstra\Model_renstra_program;


class Api_opd_program extends BaseController
{
	use ResponseTrait;

	protected $opd_program, $satuan, $tahun;

	public function __construct()
	{
		$this->opd_program = new Model_renstra_program();
	}
	// public function program($perubahan)
	// {
	// 	return $this->respond($this->opd_program->Api_program($perubahan), 200);
	// }
	public function program($perubahan, $opd_id = '')
	{
		return $this->respond($this->opd_program->Api_program_opd($perubahan, $opd_id), 200);
	}
}
