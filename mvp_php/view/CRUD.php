<?php

/******************************************
 Asisten Pemrogaman 13 & 14
 ******************************************/

include("KontrakView.php");
include("presenter/ProsesMahasiswa.php");

class CRUD implements KontrakView
{
	private $prosesmahasiswa;
	private $tpl;

	function __construct()
	{
		$this->prosesmahasiswa = new ProsesMahasiswa();
	}
	
	function tampil()
	{
		$this->prosesmahasiswa->prosesDataMahasiswa();
		$data = null;

		for ($i = 0; $i < $this->prosesmahasiswa->getSize(); $i++) {
			$no = $i + 1;
			$gender = $this->prosesmahasiswa->getGender($i);
			$TampilanGender = ($gender === 'L') ? 'Laki-laki' : 'Perempuan';
			
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosesmahasiswa->getNim($i) . "</td>
			<td>" . $this->prosesmahasiswa->getNama($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTempat($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTl($i) . "</td>
			<td>" . $TampilanGender . "</td>
			<td>" . $this->prosesmahasiswa->getEmail($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTelefon($i) . "</td> 
			<td>
				<a href='index.php?form=edit&id=" . $this->prosesmahasiswa->getId($i) . "' class='btn btn-warning btn-sm'>Edit</a>
				<a href='index.php?hapus=" . $this->prosesmahasiswa->getId($i) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin hapus?')\">Hapus</a>
			</td></tr>";
		}
		
		$this->tpl = new Template("templates/skin.html");
		$this->tpl->replace("DATA_TABEL", $data);
		$this->tpl->write();
	}

	function tambah($post)
	{
		if ($this->validasiData($post)) {
			$this->prosesmahasiswa->TambahDataMahasiswa([
				'nim' => $post['nim'],
				'nama' => $post['nama'],
				'tempat' => $post['tempat'],
				'tl' => $post['tl'],
				'gender' => $post['gender'],
				'email' => $post['email'],
				'telp' => $post['telp']
			]);
			return true;
		}
		return false;
	}

	function edit($post)
	{
		if ($this->validasiData($post) && isset($post['id']) && is_numeric($post['id'])) {
			$this->prosesmahasiswa->EditDataMahasiswa([
				'id' => $post['id'],
				'nim' => $post['nim'],
				'nama' => $post['nama'],
				'tempat' => $post['tempat'],
				'tl' => $post['tl'],
				'gender' => $post['gender'],
				'email' => $post['email'],
				'telp' => $post['telp']
			]);
			return true;
		}
		return false;
	}

	function hapus($id)
	{
		if (is_numeric($id)) {
			$this->prosesmahasiswa->HapusDataMahasiswa($id);
			return true;
		}
		return false;
	}

	function tampilForm($mode = 'tambah', $id = null)
	{
		$data = [
			'id' => '',
			'nim' => '',
			'nama' => '',
			'tempat' => '',
			'tl' => '',
			'gender' => '',
			'email' => '',
			'telp' => ''
		];

		if ($mode === 'edit' && $id !== null) {
			$mahasiswa = $this->prosesmahasiswa->getDataById($id);

			if ($mahasiswa) {
				$data = $mahasiswa;
			}
		}

		$this->tpl = new Template("templates/form_mahasiswa.html");

		$html_format_tanggal = '';
		if (!empty($data['tl'])) {
			$date = date_create($data['tl']);
			if ($date) {
				$html_format_tanggal = date_format($date, 'Y-m-d');
			}
		}

		$this->tpl->replace("FORM_MAHASISWA", ($mode == 'edit') ? 'Edit Mahasiswa' : 'Tambah Mahasiswa');
		$this->tpl->replace("JUDUL_FORM", ($mode == 'edit') ? 'Edit Mahasiswa' : 'Tambah Mahasiswa');
		$this->tpl->replace("ISI_ID", htmlspecialchars($data['id']));
		$this->tpl->replace("ISI_NIM", htmlspecialchars($data['nim']));
		$this->tpl->replace("ISI_NAMA", htmlspecialchars($data['nama']));
		$this->tpl->replace("ISI_TEMPAT", htmlspecialchars($data['tempat']));
		$this->tpl->replace("ISI_TL", htmlspecialchars($html_format_tanggal));
		$this->tpl->replace("ISI_EMAIL", htmlspecialchars($data['email']));
		$this->tpl->replace("ISI_TELP", htmlspecialchars($data['telp']));
		$this->tpl->replace("SELECTED_L", ($data['gender'] === 'L' ? 'selected' : ''));
		$this->tpl->replace("SELECTED_P", ($data['gender'] === 'P' ? 'selected' : ''));

		$this->tpl->write();
	}

	private function validasiData($data)
	{
		return isset($data['nim']) && !empty($data['nim']) &&
			isset($data['nama']) && !empty($data['nama']) &&
			isset($data['tempat']) && !empty($data['tempat']) &&
			isset($data['tl']) && !empty($data['tl']) &&
			isset($data['gender']) && !empty($data['gender']) &&
			isset($data['email']) && !empty($data['email']) &&
			isset($data['telp']) && !empty($data['telp']);
	}
}
