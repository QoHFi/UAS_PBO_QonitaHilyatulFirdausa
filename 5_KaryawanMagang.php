<?php
// KaryawanMagang.php
require_once '2_Karyawan.php';

class KaryawanMagang extends Karyawan {
    // Properti tambahan spesifik
    private $uangSakuBulanan;
    private $sertifikatKampusMerdeka;

    // Constructor Subclass
    public function __construct($id_karyawan = null, $nama_karyawan = null, $departemen = null, $hariKerjaMasuk = null, $gajiDasarPerHari = null, $uangSakuBulanan = null, $sertifikatKampusMerdeka = null) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari);
        $this->uangSakuBulanan = $uangSakuBulanan;
        $this->sertifikatKampusMerdeka = $sertifikatKampusMerdeka;
    }

    // Metode Query Internal Spesifik Bersyarat (WHERE) - Mengambil data khusus Magang
    public function tampilkanProfilKaryawan($koneksi, $jenis_karyawan = 'Magang') {
        $query = "SELECT id_karyawan, nama_karyawan, departemen, hari_kerja_masuk, gaji_dasar_per_hari, uang_saku_bulanan, sertifikat_kampus_merdeka
                  FROM tabel_karyawan
                  WHERE jenis_karyawan = '$jenis_karyawan'";

        $result = mysqli_query($koneksi, $query);
        $daftarKaryawan = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $daftarKaryawan[] = new KaryawanMagang(
                $row['id_karyawan'],
                $row['nama_karyawan'],
                $row['departemen'],
                $row['hari_kerja_masuk'],
                $row['gaji_dasar_per_hari'],
                $row['uang_saku_bulanan'],
                $row['sertifikat_kampus_merdeka']
            );
        }
        return $daftarKaryawan;
    }

    // Overriding method dari class induk Karyawan
    public function hitungGajiBersih() {
        $gajiBersih = ($this->hariKerjaMasuk * $this->gajiDasarPerHari) * 0.80;
        return $gajiBersih;
    }

    // Getter untuk keperluan View di Tahap 6
    public function getUangSaku() { return $this->uangSakuBulanan; }
    public function getSertifikat() { return $this->sertifikatKampusMerdeka; }
    public function getNama() { return $this->nama_karyawan; }
    public function getDepartemen() { return $this->departemen; }
    public function getHariKerja() { return $this->hariKerjaMasuk; }
    public function getGajiDasar() { return $this->gajiDasarPerHari; }
}
?>
