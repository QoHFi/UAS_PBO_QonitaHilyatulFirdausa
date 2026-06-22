<?php
// KaryawanTetap.php
require_once '1_Karyawan.php';

class KaryawanTetap extends Karyawan {
    // Properti tambahan spesifik
    private $tunjanganKesehatan;
    private $opsiSahamId;

    // Constructor Subclass
    public function __construct($id_karyawan = null, $nama_karyawan = null, $departemen = null, $hariKerjaMasuk = null, $gajiDasarPerHari = null, $tunjanganKesehatan = null, $opsiSahamId = null) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari);
        $this->tunjanganKesehatan = $tunjanganKesehatan;
        $this->opsiSahamId = $opsiSahamId;
    }

    // Metode Query Internal Spesifik Bersyarat (WHERE) - Mengambil data khusus Tetap
    public function tampilkanProfilKaryawan($koneksi, $jenis_karyawan = 'Tetap') {
        $query = "SELECT id_karyawan, nama_karyawan, departemen, hari_kerja_masuk, gaji_dasar_per_hari, tunjangan_kesehatan, opsi_saham_id
                  FROM tabel_karyawan
                  WHERE jenis_karyawan = '$jenis_karyawan'";

        $result = mysqli_query($koneksi, $query);
        $daftarKaryawan = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $daftarKaryawan[] = new KaryawanTetap(
                $row['id_karyawan'],
                $row['nama_karyawan'],
                $row['departemen'],
                $row['hari_kerja_masuk'],
                $row['gaji_dasar_per_hari'],
                $row['tunjangan_kesehatan'],
                $row['opsi_saham_id']
            );
        }
        return $daftarKaryawan;
    }
// Overriding method dari class induk Karyawan
    public function hitungGajiBersih() {
        $gajiBersih = ($this->hariKerjaMasuk * $this->gajiDasarPerHari) + $this->tunjanganKesehatan;
        return $gajiBersih;
    }

    // Getter untuk keperluan View di Tahap 6
    public function getTunjangan() { return $this->tunjanganKesehatan; }
    public function getOpsiSaham() { return $this->opsiSahamId; }
    public function getNama() { return $this->nama_karyawan; }
    public function getDepartemen() { return $this->departemen; }
    public function getHariKerja() { return $this->hariKerjaMasuk; }
    public function getGajiDasar() { return $this->gajiDasarPerHari; }
}
?>
