<?php
// view.php

// Memanggil semua file koneksi dan class yang dibutuhkan
require_once '1_koneksi.php';
require_once '2_Karyawan.php';
require_once '3_KaryawanKontrak.php';
require_once '4_KaryawanTetap.php';
require_once '5_KaryawanMagang.php';

// Instansiasi objek untuk memanggil fungsi query internal
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
    <title>Sistem Manajemen Karyawan - PBO Filter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 font-sans min-h-screen pb-12">

    <header class="bg-gradient-to-r from-pink-500 to-rose-400 text-white py-6 px-8 shadow-md mb-6">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4">
            <div>
                <h1 class="text-3xl font-extrabold tracking-wide">🎀 PINK CORP</h1>
                <p class="text-pink-100 text-sm mt-1">Sistem Informasi Data Karyawan - Fitur Filter Interaktif</p>
                <p class="text-pink-100 text-sm mt-1">by QoHFi</p>
            </div>

            <div class="flex items-center gap-2 bg-white/20 p-2 rounded-xl backdrop-blur-sm">
                <label for="filterView" class="text-sm font-semibold whitespace-nowrap text-white">Tampilkan:</label>
                <select id="filterView" onchange="ubahTampilan()" class="bg-white text-gray-700 text-sm font-medium rounded-lg px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-pink-300">
                    <option value="semua-terpisah">Semua Tabel</option>
                    <option value="tabel-kontrak">Hanya Karyawan Kontrak</option>
                    <option value="tabel-tetap">Hanya Karyawan Tetap</option>
                    <option value="tabel-magang">Hanya Karyawan Magang</option>
                    <option value="satu-tabel-besar">Semua Data</option>
                </select>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4">

        <div id="wrapperTerpisah" class="space-y-12">

            <section id="sectionKontrak" class="bg-white rounded-2xl shadow-sm border border-pink-100 overflow-hidden">
                <div class="bg-pink-500 text-white px-6 py-4 flex justify-between items-center">
                    <h2 class="text-lg font-bold tracking-wide">📝 Karyawan Kontrak</h2>
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
                                <th class="p-4">Atribut Spesifik</th>
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
                                <td class="p-4 text-xs text-gray-500">Durasi: <?= $k->getDurasiKontrak() ?> Bln | Agensi: <?= $k->getAgensi() ?></td>
                                <td class="p-4 text-right font-bold text-rose-500 bg-pink-50/30">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <section id="sectionTetap" class="bg-white rounded-2xl shadow-sm border border-pink-100 overflow-hidden">
                <div class="bg-rose-500 text-white px-6 py-4 flex justify-between items-center">
                    <h2 class="text-lg font-bold tracking-wide">💎 Karyawan Tetap</h2>
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
                                <th class="p-4">Atribut Spesifik</th>
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
                                <td class="p-4 text-xs text-gray-500">Tunjangan: Rp <?= number_format($k->getTunjangan(), 0, ',', '.') ?> | Saham ID: <?= $k->getOpsiSaham() ?></td>
                                <td class="p-4 text-right font-bold text-rose-600 bg-rose-50/20">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <section id="sectionMagang" class="bg-white rounded-2xl shadow-sm border border-pink-100 overflow-hidden">
                <div class="bg-fuchsia-500 text-white px-6 py-4 flex justify-between items-center">
                    <h2 class="text-lg font-bold tracking-wide">🎓 Karyawan Magang</h2>
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
                                <th class="p-4">Atribut Spesifik</th>
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
                                <td class="p-4 text-xs text-gray-500">Uang Saku: Rp <?= number_format($k->getUangSaku(), 0, ',', '.') ?> | Program: <?= $k->getSertifikat() ?></td>
                                <td class="p-4 text-right font-bold text-fuchsia-600 bg-fuchsia-50/20">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>


        <div id="wrapperSatuTabel" class="hidden bg-white rounded-2xl shadow-sm border border-pink-100 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-4">
                <h2 class="text-lg font-bold tracking-wide">📊 Semua Data Karyawan</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-purple-50 text-purple-700 font-semibold text-sm border-b border-pink-100">
                            <th class="p-4">Nama</th>
                            <th class="p-4">Jenis Karyawan</th>
                            <th class="p-4">Departemen</th>
                            <th class="p-4 text-center">Hari Kerja</th>
                            <th class="p-4 text-right">Gaji Dasar / Hari</th>
                            <th class="p-4 text-right text-purple-700 font-bold">Gaji Bersih</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-pink-50 text-gray-700 text-sm">
                        <?php foreach ($daftarKontrak as $k): ?>
                        <tr class="hover:bg-pink-50/30">
                            <td class="p-4 font-medium text-gray-900"><?= $k->getNama() ?></td>
                            <td class="p-4"><span class="bg-pink-100 text-pink-700 text-xs px-2 py-0.5 rounded-full font-bold">Kontrak</span></td>
                            <td class="p-4"><?= $k->getDepartemen() ?></td>
                            <td class="p-4 text-center"><?= $k->getHariKerja() ?></td>
                            <td class="p-4 text-right">Rp <?= number_format($k->getGajiDasar(), 0, ',', '.') ?></td>
                            <td class="p-4 text-right font-bold text-rose-500">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>

                        <?php foreach ($daftarTetap as $k): ?>
                        <tr class="hover:bg-rose-50/30">
                            <td class="p-4 font-medium text-gray-900"><?= $k->getNama() ?></td>
                            <td class="p-4"><span class="bg-rose-100 text-rose-700 text-xs px-2 py-0.5 rounded-full font-bold">Tetap</span></td>
                            <td class="p-4"><?= $k->getDepartemen() ?></td>
                            <td class="p-4 text-center"><?= $k->getHariKerja() ?></td>
                            <td class="p-4 text-right">Rp <?= number_format($k->getGajiDasar(), 0, ',', '.') ?></td>
                            <td class="p-4 text-right font-bold text-rose-600">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>

                        <?php foreach ($daftarMagang as $k): ?>
                        <tr class="hover:bg-fuchsia-50/30">
                            <td class="p-4 font-medium text-gray-900"><?= $k->getNama() ?></td>
                            <td class="p-4"><span class="bg-fuchsia-100 text-fuchsia-700 text-xs px-2 py-0.5 rounded-full font-bold">Magang</span></td>
                            <td class="p-4"><?= $k->getDepartemen() ?></td>
                            <td class="p-4 text-center"><?= $k->getHariKerja() ?></td>
                            <td class="p-4 text-right">Rp <?= number_format($k->getGajiDasar(), 0, ',', '.') ?></td>
                            <td class="p-4 text-right font-bold text-fuchsia-600">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script>
    function ubahTampilan() {
        const pilihan = document.getElementById('filterView').value;

        const wrapperTerpisah = document.getElementById('wrapperTerpisah');
        const wrapperSatuTabel = document.getElementById('wrapperSatuTabel');

        const secKontrak = document.getElementById('sectionKontrak');
        const secTetap = document.getElementById('sectionTetap');
        const secMagang = document.getElementById('sectionMagang');

        // Reset Tampilan Awal
        wrapperTerpisah.classList.remove('hidden');
        wrapperSatuTabel.classList.add('hidden');
        secKontrak.classList.remove('hidden');
        secTetap.classList.remove('hidden');
        secMagang.classList.remove('hidden');

        if (pilihan === 'tabel-kontrak') {
            secTetap.classList.add('hidden');
            secMagang.classList.add('hidden');
        } else if (pilihan === 'tabel-tetap') {
            secKontrak.classList.add('hidden');
            secMagang.classList.add('hidden');
        } else if (pilihan === 'tabel-magang') {
            secKontrak.classList.add('hidden');
            secTetap.classList.add('hidden');
        } else if (pilihan === 'satu-tabel-besar') {
            wrapperTerpisah.classList.add('hidden');
            wrapperSatuTabel.classList.remove('hidden');
        }
    }
    </script>
</body>
</html>
