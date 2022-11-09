<?php

namespace App\Controllers\Admin\Menu;

use App\Controllers\BaseController;
use App\Models\Admin\Menu\Model_tag;

class Tag extends BaseController
{
	protected $tag;

	public function __construct()
	{
		$this->tag = new Model_tag();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'menu',
				'mn' => 'tag',
				'title' => 'Admin | Setting',
				'lok' => '<b>Tag</b>',
				'tag' => $this->tag->findAll(),
			];
			// echo date('M') . ', ' . date('d') . ' ' . date('Y') . ' ' . date('H') . ':' . date('i');
			echo view('admin/Menu/tag', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function tag_add()
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'menu',
				'mn' => 'tag',
				'title' => 'Admin | Setting',
				'lok' => '<a href="/admin/menu/tag">Tag</a> -> <b>Tambah Tag</b>',

			];
			return view('admin/Menu/tag_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function tag_create()
	{
		if (has_permission('Admin')) :
			$this->tag->save([
				'tag' => $this->request->getVar('tag'),
				'keterangan' => $this->request->getVar('keterangan'),
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/menu/tag');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function tag_edit($id)
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'menu',
				'mn' => 'tag',
				'title' => 'Admin | Setting',
				'lok' => '<a href="/admin/menu/tag">Tag</a> -> <b>Ubah Tag</b>',
				'tag' => $this->tag->find($id),

			];
			return view('admin/Menu/tag_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function tag_update()
	{
		if (has_permission('Admin')) :
			$this->tag->save([
				'id_tag' => $this->request->getVar('id'),
				'tag' => $this->request->getVar('tag'),
				'keterangan' => $this->request->getVar('keterangan'),
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/menu/tag');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function hapus($id)
	{
		if (has_permission('Admin')) :
			try {
				$this->tag->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/admin/menu/tag');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------------------------------------------
}
