<?php
// KaryawanKontrak.php
require_once 'Karyawan.php';

class KaryawanKontrak extends Karyawan {
    // Properti tambahan spesifik
    private $durasiKontrakBulan;
    private $agensiPenyalur;

    // Constructor Subclass
    public function __construct($id_karyawan = null, $nama_karyawan = null, $departemen = null, $hariKerjaMasuk = null, $gajiDasarPerHari = null, $durasiKontrakBulan = null, $agensiPenyalur = null) {
        // Memanggil constructor kelas induk
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari);
        $this->durasiKontrakBulan = $durasiKontrakBulan;
        $this->agensiPenyalur = $agensiPenyalur;
    }

    // Metode Query Internal Spesifik Bersyarat (WHERE) - Mengambil data khusus Kontrak
    public function tampilkanProfilKaryawan($koneksi, $jenis_karyawan = 'Kontrak') {
        $query = "SELECT id_karyawan, nama_karyawan, departemen, hari_kerja_masuk, gaji_dasar_per_hari, durasi_kontrak_bulan, agensi_penyalur
                  FROM tabel_karyawan
                  WHERE jenis_karyawan = '$jenis_karyawan'";

        $result = mysqli_query($koneksi, $query);
        $daftarKaryawan = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $daftarKaryawan[] = new KaryawanKontrak(
                $row['id_karyawan'],
                $row['nama_karyawan'],
                $row['departemen'],
                $row['hari_kerja_masuk'],
                $row['gaji_dasar_per_hari'],
                $row['durasi_kontrak_bulan'],
                $row['agensi_penyalur']
            );
        }
        return $daftarKaryawan;
    }

    // Implementasi awal abstract method (Logika detail di Tahap 5)
    public function hitungGajiBersih() {
        return 0;
    }

    // Getter untuk keperluan View di Tahap 6
    public function getDurasiKontrak() { return $this->durasiKontrakBulan; }
    public function getAgensi() { return $this->agensiPenyalur; }
    public function getNama() { return $this->nama_karyawan; }
    public function getDepartemen() { return $this->departemen; }
    public function getHariKerja() { return $this->hariKerjaMasuk; }
    public function getGajiDasar() { return $this->gajiDasarPerHari; }
}
?>
