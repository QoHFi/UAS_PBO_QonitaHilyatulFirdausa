<?php
// Karyawan.php

abstract class Karyawan {
    // Properti terenkapsulasi (protected agar bisa diakses oleh subclass)
    protected $id_karyawan;
    protected $nama_karyawan;
    protected $departemen;
    protected $hariKerjaMasuk;
    protected $gajiDasarPerHari;

    // Constructor untuk menginisialisasi data objek induk
    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari) {
        $this->id_karyawan = $id_karyawan;
        $this->nama_karyawan = $nama_karyawan;
        $this->departemen = $departemen;
        $this->hariKerjaMasuk = $hariKerjaMasuk;
        $this->gajiDasarPerHari = $gajiDasarPerHari;
    }

    // Abstract method tanpa body (wajib di-override di Tahap 5)
    abstract public function hitungGajiBersih();

    // Abstract method tanpa body dengan parameter untuk query WHERE jenis_karyawan
    abstract public function tampilkanProfilKaryawan($koneksi, $jenis_karyawan);
}
?>
