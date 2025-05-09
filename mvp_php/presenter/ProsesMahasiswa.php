<?php

include("KontrakPresenter.php");

/******************************************
 Asisten Pemrogaman 13 & 14
 ******************************************/

class ProsesMahasiswa implements KontrakPresenter
{
	private $tabelmahasiswa;
	private $data = [];

	function __construct()
	{
		// Konstruktor
		try {
			$db_host = "localhost"; // host 
			$db_user = "root"; // user
			$db_password = ""; // password
			$db_name = "mvp_php"; // nama basis data
			$this->tabelmahasiswa = new TabelMahasiswa($db_host, $db_user, $db_password, $db_name); // instansi TabelMahasiswa
			$this->data = array(); // instansi list untuk data Mahasiswa
		} catch (Exception $e) {
			echo "yah error" . $e->getMessage();
		}
	}

	function prosesDataMahasiswa()
	{
		try {
			// mengambil data di tabel Mahasiswa
			$this->tabelmahasiswa->open();
			$this->tabelmahasiswa->getMahasiswa();

			while ($row = $this->tabelmahasiswa->getResult()) {
				// ambil hasil query
				$mahasiswa = new Mahasiswa(); // instansiasi objek mahasiswa untuk setiap data mahasiswa
				$mahasiswa->setId($row['id']); // mengisi id
				$mahasiswa->setNim($row['nim']); // mengisi nim
				$mahasiswa->setNama($row['nama']); // mengisi nama
				$mahasiswa->setTempat($row['tempat']); // mengisi tempat
				$mahasiswa->setTl($row['tl']); // mengisi tl
				$mahasiswa->setGender($row['gender']); // mengisi gender
				$mahasiswa->setEmail($row['email']); // mengisi email
				$mahasiswa->setTelefon($row['telp']); // mengisi no telpon

				$this->data[] = $mahasiswa; // tambahkan data mahasiswa ke dalam list
			}
			// Tutup koneksi
			$this->tabelmahasiswa->close();
		} catch (Exception $e) {
			// memproses error
			echo "yah error part 2" . $e->getMessage();
		}
	}
	function TambahDataMahasiswa($data)
	{
		$this->tabelmahasiswa->open();
		$result = $this->tabelmahasiswa->tambahMahasiswa(
			$data['nim'],
			$data['nama'],
			$data['tempat'],
			$data['tl'],
			$data['gender'],
			$data['email'],
			$data['telp']
		);
		$this->tabelmahasiswa->close();
		return $result;
	}

	function EditDataMahasiswa($data)
	{
		$this->tabelmahasiswa->open();
		$result = $this->tabelmahasiswa->editMahasiswa(
			$data['id'],
			$data['nim'],
			$data['nama'],
			$data['tempat'],
			$data['tl'],
			$data['gender'],
			$data['email'],
			$data['telp']
		);
		$this->tabelmahasiswa->close();
		return $result;
	}

	function HapusDataMahasiswa($data)
	{
		$this->tabelmahasiswa->open();
		$this->tabelmahasiswa->hapusMahasiswa($data);
		$this->tabelmahasiswa->close();
	}

	function getDataById($id)
	{
		$this->tabelmahasiswa->open();
		$result = $this->tabelmahasiswa->getMahasiswaById($id);
		$this->tabelmahasiswa->close();

		if ($result) {
			return [
				'id' => $result['id'] ?? '',
				'nim' => $result['nim'] ?? '',
				'nama' => $result['nama'] ?? '',
				'tempat' => $result['tempat'] ?? '',
				'tl' => $result['tl'] ?? '',
				'gender' => $result['gender'] ?? '',
				'email' => $result['email'] ?? '',
				'telp' => $result['telp'] ?? ''
			];
		}
		return null;
	}

	function getId($i)
	{
		return $this->data[$i]->id;
	}
	function getNim($i)
	{
		return $this->data[$i]->nim;
	}
	function getNama($i)
	{
		return $this->data[$i]->nama;
	}
	function getTempat($i)
	{
		return $this->data[$i]->tempat;
	}
	function getTl($i)
	{
		return $this->data[$i]->tl;
	}
	function getGender($i)
	{
		return $this->data[$i]->gender;
	}
	function getEmail($i)
	{
		return $this->data[$i]->email;
	}
	function getTelefon($i)
	{
		return $this->data[$i]->telefon;
	}


	function getSize()
	{
		return sizeof($this->data);
	}
}
