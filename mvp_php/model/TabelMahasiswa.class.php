<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

class TabelMahasiswa extends DB
{
    function getMahasiswa()
    {
        $query = "SELECT * FROM mahasiswa";
        return $this->execute($query);
    }

    function tambahMahasiswa($nim, $nama, $tempat, $tl, $gender, $email, $telefon)
    {
        $query = "INSERT INTO mahasiswa (nim, nama, tempat, tl, gender, email, telp) 
                  VALUES ('$nim', '$nama', '$tempat', '$tl', '$gender', '$email', '$telefon')";
        return $this->execute($query);
    }

    function editMahasiswa($id, $nim, $nama, $tempat, $tl, $gender, $email, $telefon)
    {
        $query = "UPDATE mahasiswa SET 
                  nim = '$nim',
                  nama = '$nama',
                  tempat = '$tempat',
                  tl = '$tl',
                  gender = '$gender',
                  email = '$email',
                  telp = '$telefon'
                  WHERE id = $id";
        return $this->execute($query);
    }

    function hapusMahasiswa($id)
    {
        $query = "DELETE FROM mahasiswa WHERE id = $id";
        return $this->execute($query);
    }

    function getMahasiswaById($id)
	{
		$query = "SELECT * FROM mahasiswa WHERE id = " . intval($id);
		$this->execute($query);
		return $this->getResult(); // This should return a single row
	}
}