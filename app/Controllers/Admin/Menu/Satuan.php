<?php

namespace App\Controllers\Admin\Menu;

use App\Controllers\BaseController;
use App\Models\Admin\Menu\Model_satuan;

class Satuan extends BaseController
{
	protected $satuan;

	public function __construct()
	{
		$this->satuan = new Model_satuan();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'menu',
				'mn' => 'satuan',
				'title' => 'Admin | Setting',
				'lok' => '<b>Satuan</b>',
				'satuan' => $this->satuan->findAll(),
			];
			// echo date('M') . ', ' . date('d') . ' ' . date('Y') . ' ' . date('H') . ':' . date('i');
			echo view('admin/Menu/satuan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function satuan_add()
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'menu',
				'mn' => 'satuan',
				'title' => 'Admin | Setting',
				'lok' => '<a href="/admin/menu/satuan">Satuan</a> -> <b>Tambah Satuan</b>',

			];
			return view('admin/Menu/satuan_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function satuan_create()
	{
		if (has_permission('Admin')) :
			$this->satuan->save([
				'satuan' => $this->request->getVar('satuan'),
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/menu/satuan');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function satuan_edit($id)
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'menu',
				'mn' => 'satuan',
				'title' => 'Admin | Setting',
				'lok' => '<a href="/admin/menu/satuan">Satuan</a> -> <b>Ubah Satuan</b>',
				'satuan' => $this->satuan->find($id),

			];
			return view('admin/Menu/satuan_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function satuan_update()
	{
		if (has_permission('Admin')) :
			$this->satuan->save([
				'id_satuan' => $this->request->getVar('id'),
				'satuan' => $this->request->getVar('satuan'),
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/menu/satuan');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function hapus($id)
	{
		if (has_permission('Admin')) :
			try {
				$this->satuan->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/admin/menu/satuan');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------------------------------------------
}
