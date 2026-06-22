<?php
// index.php

// Memanggil semua file koneksi dan class yang dibutuhkan
require_once '1_koneksi.php';
require_once '2_Karyawan.php';
require_once '3_KaryawanKontrak.php';
require_once '4_KaryawanTetap.php';
require_once '5_KaryawanMagang.php';

// Instansiasi objek dummy untuk memanggil fungsi query internal (Polimorfisme & Query Subclass)
$objekKontrak = new KaryawanKontrak();
$objekTetap   = new KaryawanTetap();
$objekMagang  = new KaryawanMagang();

// Mengambil data spesifik terkelompok dari database
$daftarKontrak = $objekKontrak->tampilkanProfilKaryawan($koneksi);
$daftarTetap   = $objekTetap->tampilkanProfilKaryawan($koneksi);
$daftarMagang  = $objekMagang->tampilkanProfilKaryawan($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Karyawan - PBO</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 font-sans min-h-screen pb-12">

    <header class="bg-gradient-to-r function-gradient from-pink-500 to-rose-400 text-white py-6 px-8 shadow-md mb-8">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-extrabold tracking-wide">🎀 PINK CORP</h1>
                <p class="text-pink-100 text-sm mt-1">Sistem Informasi Data Karyawan Berbasis Objek (PBO)</p>
            </div>
            <span class="bg-white text-pink-600 px-4 py-1.5 rounded-full font-bold text-xs shadow-sm uppercase tracking-wider">
                Tahap 6: View Selesai
            </span>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 space-y-12">

        <section class="bg-white rounded-2xl shadow-sm border border-pink-100 overflow-hidden">
            <div class="bg-pink-500 text-white px-6 py-4 flex justify-between items-center">
                <h2 class="text-lg font-bold tracking-wide flex items-center gap-2">📝 Karyawan Kontrak</h2>
                <span class="bg-pink-700 text-xs px-3 py-1 rounded-full font-medium"><?= count($daftarKontrak) ?> Orang</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-pink-50 text-pink-700 font-semibold text-sm border-b border-pink-100">
                            <th class="p-4">Nama</th>
                            <th class="p-4">Departemen</th>
                            <th class="p-4 text-center">Hari Kerja</th>
                            <th class="p-4 text-right">Gaji / Hari</th>
                            <th class="p-4">Durasi Kontrak</th>
                            <th class="p-4">Agensi Penyalur</th>
                            <th class="p-4 text-right text-pink-600 font-bold">Gaji Bersih</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-pink-50 text-gray-700 text-sm">
                        <?php foreach ($daftarKontrak as $k): ?>
                        <tr class="hover:bg-pink-50/50 transition">
                            <td class="p-4 font-medium text-gray-900"><?= $k->getNama() ?></td>
                            <td class="p-4"><span class="bg-gray-100 text-gray-700 text-xs px-2.5 py-1 rounded-md font-medium"><?= $k->getDepartemen() ?></span></td>
                            <td class="p-4 text-center"><?= $k->getHariKerja() ?> hari</td>
                            <td class="p-4 text-right">Rp <?= number_format($k->getGajiDasar(), 0, ',', '.') ?></td>
                            <td class="p-4"><?= $k->getDurasiKontrak() ?> Bulan</td>
                            <td class="p-4 text-gray-500"><?= $k->getAgensi() ?></td>
                            <td class="p-4 text-right font-bold text-rose-500 bg-pink-50/30">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>


        <section class="bg-white rounded-2xl shadow-sm border border-pink-100 overflow-hidden">
            <div class="bg-rose-500 text-white px-6 py-4 flex justify-between items-center">
                <h2 class="text-lg font-bold tracking-wide flex items-center gap-2">💎 Karyawan Tetap</h2>
                <span class="bg-rose-700 text-xs px-3 py-1 rounded-full font-medium"><?= count($daftarTetap) ?> Orang</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-rose-50 text-rose-700 font-semibold text-sm border-b border-pink-100">
                            <th class="p-4">Nama</th>
                            <th class="p-4">Departemen</th>
                            <th class="p-4 text-center">Hari Kerja</th>
                            <th class="p-4 text-right">Gaji / Hari</th>
                            <th class="p-4 text-right">Tunjangan Kesehatan</th>
                            <th class="p-4 text-center">Opsi Saham ID</th>
                            <th class="p-4 text-right text-rose-600 font-bold">Gaji Bersih</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-pink-50 text-gray-700 text-sm">
                        <?php foreach ($daftarTetap as $k): ?>
                        <tr class="hover:bg-rose-50/30 transition">
                            <td class="p-4 font-medium text-gray-900"><?= $k->getNama() ?></td>
                            <td class="p-4"><span class="bg-gray-100 text-gray-700 text-xs px-2.5 py-1 rounded-md font-medium"><?= $k->getDepartemen() ?></span></td>
                            <td class="p-4 text-center"><?= $k->getHariKerja() ?> hari</td>
                            <td class="p-4 text-right">Rp <?= number_format($k->getGajiDasar(), 0, ',', '.') ?></td>
                            <td class="p-4 text-right text-emerald-600">+ Rp <?= number_format($k->getTunjangan(), 0, ',', '.') ?></td>
                            <td class="p-4 text-center"><span class="font-mono text-xs bg-amber-50 text-amber-700 border border-amber-200 px-2 py-0.5 rounded"><?= $k->getOpsiSaham() ?></span></td>
                            <td class="p-4 text-right font-bold text-rose-600 bg-rose-50/20">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>


        <section class="bg-white rounded-2xl shadow-sm border border-pink-100 overflow-hidden">
            <div class="bg-fuchsia-500 text-white px-6 py-4 flex justify-between items-center">
                <h2 class="text-lg font-bold tracking-wide flex items-center gap-2">🎓 Karyawan Magang</h2>
                <span class="bg-fuchsia-700 text-xs px-3 py-1 rounded-full font-medium"><?= count($daftarMagang) ?> Orang</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-fuchsia-50 text-fuchsia-700 font-semibold text-sm border-b border-pink-100">
                            <th class="p-4">Nama</th>
                            <th class="p-4">Departemen</th>
                            <th class="p-4 text-center">Hari Kerja</th>
                            <th class="p-4 text-right">Gaji / Hari</th>
                            <th class="p-4 text-right">Uang Saku Bulanan</th>
                            <th class="p-4">Sertifikat Kampus Merdeka</th>
                            <th class="p-4 text-right text-fuchsia-600 font-bold">Gaji Bersih</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-pink-50 text-gray-700 text-sm">
                        <?php foreach ($daftarMagang as $k): ?>
                        <tr class="hover:bg-fuchsia-50/30 transition">
                            <td class="p-4 font-medium text-gray-900"><?= $k->getNama() ?></td>
                            <td class="p-4"><span class="bg-gray-100 text-gray-700 text-xs px-2.5 py-1 rounded-md font-medium"><?= $k->getDepartemen() ?></span></td>
                            <td class="p-4 text-center"><?= $k->getHariKerja() ?> hari</td>
                            <td class="p-4 text-right">Rp <?= number_format($k->getGajiDasar(), 0, ',', '.') ?></td>
                            <td class="p-4 text-right">Rp <?= number_format($k->getUangSaku(), 0, ',', '.') ?></td>
                            <td class="p-4 text-xs text-purple-600 font-medium"><?= $k->getSertifikat() ?></td>
                            <td class="p-4 text-right font-bold text-fuchsia-600 bg-fuchsia-50/20">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <footer class="text-center text-xs text-pink-400 mt-12">
        &copy; 2026 Pink Corp - Pemrograman Berorientasi Objek. All Rights Reserved.
    </footer>

</body>
</html>
