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

// Hitung total karyawan untuk widget statistik
$totalKaryawan = count($daftarKontrak) + count($daftarTetap) + count($daftarMagang);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QoHFi Corp - Dashboard Manajemen Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen pb-16">

    <!-- TOP GLOW BACKGROUND EFFECT (PINK CERAH) -->
    <div class="absolute top-0 left-0 right-0 h-80 bg-gradient-to-b from-pink-200/60 to-transparent -z-10"></div>

    <!-- NAVBAR UTAMA -->
    <nav class="bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-pink-200 px-6 py-4 shadow-md shadow-pink-100/50">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-3">
                <!-- LOGO HURUF Q DENGAN GRADASI PINK CERAH -->
                <div class="h-11 w-11 rounded-xl bg-gradient-to-tr from-pink-500 via-rose-500 to-fuchsia-600 flex items-center justify-center shadow-lg shadow-pink-300/80">
                    <span class="text-white font-extrabold text-2xl tracking-tighter font-mono">Q</span>
                </div>
                <div>
                    <h1 class="text-2xl font-black tracking-tight bg-gradient-to-r from-pink-500 via-pink-600 to-fuchsia-600 bg-clip-text text-transparent">🎀 QoHFi Corp</h1>
                    <p class="text-xs text-pink-500 font-bold tracking-wide uppercase">Sistem Informasi PBO Kelompok Karyawan</p>
                </div>
            </div>

            <!-- IDENTITAS CEO & DROPDOWN FILTER -->
            <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto justify-end">
                <!-- Sesi Nama Pengguna (CEO) -->
                <div class="flex items-center gap-2 bg-pink-100 border border-pink-300 px-4 py-2 rounded-xl shadow-sm">
                    <div class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">CEO:</span>
                    <span class="text-sm font-black text-pink-600 font-mono tracking-widest">QoHFi</span>
                </div>

                <!-- Dropdown Filter -->
                <div class="flex items-center gap-2 bg-pink-100/80 border border-pink-300 rounded-xl p-1.5 shadow-md w-full sm:w-auto">
                    <select id="filterView" onchange="ubahTampilan()" class="bg-white text-slate-800 text-sm font-bold rounded-lg border border-pink-200 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 cursor-pointer w-full sm:w-auto transition-all">
                        <option value="semua-terpisah">📑 Semua Tabel Terpisah</option>
                        <option value="tabel-kontrak">📝 Hanya Karyawan Kontrak</option>
                        <option value="tabel-tetap">💎 Hanya Karyawan Tetap</option>
                        <option value="tabel-magang">🎓 Hanya Karyawan Magang</option>
                        <option value="satu-tabel-besar">📊 Gabungkan Semua Data</option>
                    </select>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTAINER -->
    <main class="max-w-7xl mx-auto px-6 mt-8">

        <!-- WIDGET STATISTIK CEPAT (BISA DIKLIK) -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            <!-- Box Total Staf -->
            <div onclick="filterLewatBox('semua-terpisah')" class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between cursor-pointer transition-all duration-300 hover:scale-105 hover:shadow-md hover:border-slate-400 select-none">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Staf</span>
                <span class="text-3xl font-extrabold text-slate-800 mt-2"><?= $totalKaryawan ?> <span class="text-xs font-medium text-slate-400">Orang</span></span>
            </div>

            <!-- Box Staf Kontrak -->
            <div onclick="filterLewatBox('tabel-kontrak')" class="bg-white p-5 rounded-2xl border-2 border-pink-400 shadow-md flex flex-col justify-between bg-gradient-to-br from-white to-pink-50/30 cursor-pointer transition-all duration-300 hover:scale-105 hover:shadow-lg hover:from-pink-50/50 select-none">
                <span class="text-xs font-bold text-pink-500 uppercase tracking-wider">Staf Kontrak</span>
                <span class="text-3xl font-extrabold text-pink-600 mt-2"><?= count($daftarKontrak) ?></span>
            </div>

            <!-- Box Staf Tetap -->
            <div onclick="filterLewatBox('tabel-tetap')" class="bg-white p-5 rounded-2xl border-2 border-rose-400 shadow-md flex flex-col justify-between bg-gradient-to-br from-white to-rose-50/30 cursor-pointer transition-all duration-300 hover:scale-105 hover:shadow-lg hover:from-rose-50/50 select-none">
                <span class="text-xs font-bold text-rose-500 uppercase tracking-wider">Staf Tetap</span>
                <span class="text-3xl font-extrabold text-rose-600 mt-2"><?= count($daftarTetap) ?></span>
            </div>

            <!-- Box Staf Magang -->
            <div onclick="filterLewatBox('tabel-magang')" class="bg-white p-5 rounded-2xl border-2 border-fuchsia-400 shadow-md flex flex-col justify-between bg-gradient-to-br from-white to-fuchsia-50/30 cursor-pointer transition-all duration-300 hover:scale-105 hover:shadow-lg hover:from-fuchsia-50/50 select-none">
                <span class="text-xs font-bold text-fuchsia-500 uppercase tracking-wider">Staf Magang</span>
                <span class="text-3xl font-extrabold text-fuchsia-600 mt-2"><?= count($daftarMagang) ?></span>
            </div>
        </div>

        <!-- ==================== MODE 1: TABEL TERKELOMPOK (TERPISAH) ==================== -->
        <div id="wrapperTerpisah" class="space-y-10">

            <!-- SEKSI TABEL KONTRAK -->
            <section id="sectionKontrak" class="bg-white rounded-2xl shadow-md border border-pink-100 overflow-hidden transition-all duration-300">
                <div class="bg-gradient-to-r from-pink-500 via-pink-600 to-fuchsia-600 text-white px-6 py-4 flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">📝</span>
                        <h2 class="font-extrabold tracking-wide">Data Karyawan Kontrak</h2>
                    </div>
                    <span class="bg-white/20 backdrop-blur-md text-xs px-3 py-1 rounded-md font-bold uppercase tracking-wider">Subclass Kontrak</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-pink-50/50 text-pink-700 font-bold text-xs uppercase tracking-wider border-b border-pink-100">
                                <th class="p-4">Nama Lengkap</th>
                                <th class="p-4">Departemen</th>
                                <th class="p-4 text-center">Hari Kerja</th>
                                <th class="p-4 text-right">Gaji / Hari</th>
                                <th class="p-4 pl-8">Kontrak & Agensi</th>
                                <th class="p-4 text-right text-pink-600 font-black bg-pink-100/40">Gaji Bersih</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-600 text-sm font-medium">
                            <?php foreach ($daftarKontrak as $k): ?>
                            <tr class="hover:bg-pink-50/20 transition-colors">
                                <td class="p-4 font-bold text-slate-900"><?= $k->getNama() ?></td>
                                <td class="p-4"><span class="bg-pink-50 text-pink-600 border border-pink-200 text-xs px-2.5 py-1 rounded-md font-bold"><?= $k->getDepartemen() ?></span></td>
                                <td class="p-4 text-center font-semibold"><?= $k->getHariKerja() ?> hari</td>
                                <td class="p-4 text-right font-semibold">Rp <?= number_format($k->getGajiDasar(), 0, ',', '.') ?></td>
                                <td class="p-4 pl-8 text-xs text-slate-500">
                                    <span class="inline-block bg-pink-600 text-white font-bold px-2 py-0.5 rounded mr-1"><?= $k->getDurasiKontrak() ?> Bulan</span>
                                    <span class="font-medium text-pink-700">via <?= $k->getAgensi() ?></span>
                                </td>
                                <td class="p-4 text-right font-black text-pink-600 bg-pink-50/40 text-base">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- SEKSI TABEL TETAP -->
            <section id="sectionTetap" class="bg-white rounded-2xl shadow-md border border-rose-100 overflow-hidden transition-all duration-300">
                <div class="bg-gradient-to-r from-rose-500 via-rose-600 to-pink-600 text-white px-6 py-4 flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">💎</span>
                        <h2 class="font-extrabold tracking-wide">Data Karyawan Tetap</h2>
                    </div>
                    <span class="bg-white/20 backdrop-blur-md text-xs px-3 py-1 rounded-md font-bold uppercase tracking-wider">Subclass Tetap</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-rose-50/50 text-rose-700 font-bold text-xs uppercase tracking-wider border-b border-rose-100">
                                <th class="p-4">Nama Lengkap</th>
                                <th class="p-4">Departemen</th>
                                <th class="p-4 text-center">Hari Kerja</th>
                                <th class="p-4 text-right">Gaji / Hari</th>
                                <th class="p-4 pl-8">Tunjangan & Saham ID</th>
                                <th class="p-4 text-right text-rose-600 font-black bg-rose-100/40">Gaji Bersih</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-600 text-sm font-medium">
                            <?php foreach ($daftarTetap as $k): ?>
                            <tr class="hover:bg-rose-50/20 transition-colors">
                                <td class="p-4 font-bold text-slate-900"><?= $k->getNama() ?></td>
                                <td class="p-4"><span class="bg-rose-50 text-rose-600 border border-rose-200 text-xs px-2.5 py-1 rounded-md font-bold"><?= $k->getDepartemen() ?></span></td>
                                <td class="p-4 text-center font-semibold"><?= $k->getHariKerja() ?> hari</td>
                                <td class="p-4 text-right font-semibold">Rp <?= number_format($k->getGajiDasar(), 0, ',', '.') ?></td>
                                <td class="p-4 pl-8 text-xs text-slate-500">
                                    <span class="text-emerald-600 font-extrabold mr-2">+Rp <?= number_format($k->getTunjangan(), 0, ',', '.') ?></span>
                                    <span class="font-mono bg-amber-100 text-amber-800 border border-amber-300 px-1.5 py-0.5 rounded font-bold"><?= $k->getOpsiSaham() ?></span>
                                </td>
                                <td class="p-4 text-right font-black text-rose-600 bg-rose-50/40 text-base">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- SEKSI TABEL MAGANG -->
            <section id="sectionMagang" class="bg-white rounded-2xl shadow-md border border-fuchsia-100 overflow-hidden transition-all duration-300">
                <div class="bg-gradient-to-r from-fuchsia-500 via-fuchsia-600 to-rose-500 text-white px-6 py-4 flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">🎓</span>
                        <h2 class="font-extrabold tracking-wide">Data Karyawan Magang</h2>
                    </div>
                    <span class="bg-white/20 backdrop-blur-md text-xs px-3 py-1 rounded-md font-bold uppercase tracking-wider">Subclass Magang</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-fuchsia-50/50 text-fuchsia-700 font-bold text-xs uppercase tracking-wider border-b border-fuchsia-100">
                                <th class="p-4">Nama Lengkap</th>
                                <th class="p-4">Departemen</th>
                                <th class="p-4 text-center">Hari Kerja</th>
                                <th class="p-4 text-right">Gaji / Hari</th>
                                <th class="p-4 pl-8">Uang Saku & Program</th>
                                <th class="p-4 text-right text-fuchsia-600 font-black bg-fuchsia-100/40">Gaji Bersih</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-600 text-sm font-medium">
                            <?php foreach ($daftarMagang as $k): ?>
                            <tr class="hover:bg-fuchsia-50/20 transition-colors">
                                <td class="p-4 font-bold text-slate-900"><?= $k->getNama() ?></td>
                                <td class="p-4"><span class="bg-fuchsia-50 text-fuchsia-600 border border-fuchsia-200 text-xs px-2.5 py-1 rounded-md font-bold"><?= $k->getDepartemen() ?></span></td>
                                <td class="p-4 text-center font-semibold"><?= $k->getHariKerja() ?> hari</td>
                                <td class="p-4 text-right font-semibold">Rp <?= number_format($k->getGajiDasar(), 0, ',', '.') ?></td>
                                <td class="p-4 pl-8 text-xs text-slate-500">
                                    <span class="text-slate-800 font-bold mr-2">Saku: Rp <?= number_format($k->getUangSaku(), 0, ',', '.') ?></span>
                                    <span class="text-purple-700 bg-purple-100 border border-purple-200 px-2 py-0.5 rounded font-bold"><?= $k->getSertifikat() ?></span>
                                </td>
                                <td class="p-4 text-right font-black text-fuchsia-600 bg-fuchsia-50/40 text-base">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>


        <!-- ==================== MODE 2: SATU TABEL BESAR (GABUNGAN) ==================== -->
        <div id="wrapperSatuTabel" class="hidden bg-white rounded-2xl shadow-md border border-slate-200 overflow-hidden transition-all duration-300">
            <div class="bg-gradient-to-r from-slate-700 to-slate-800 text-white px-6 py-4">
                <h2 class="font-extrabold tracking-wide flex items-center gap-2"><span class="text-xl">📊</span> Semua Data Karyawan (Satu Tabel Besar)</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 font-bold text-xs uppercase tracking-wider border-b border-slate-100">
                            <th class="p-4">Nama Lengkap</th>
                            <th class="p-4">Tipe Karyawan</th>
                            <th class="p-4">Departemen</th>
                            <th class="p-4 text-center">Hari Kerja</th>
                            <th class="p-4 text-right">Gaji Dasar / Hari</th>
                            <th class="p-4 text-right text-pink-600 font-black bg-pink-50/20">Gaji Bersih</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600 text-sm font-medium">
                        <!-- Looping Kontrak -->
                        <?php foreach ($daftarKontrak as $k): ?>
                        <tr class="hover:bg-slate-50/50">
                            <td class="p-4 font-bold text-slate-900"><?= $k->getNama() ?></td>
                            <td class="p-4"><span class="bg-pink-600 text-white text-xs px-2.5 py-1 rounded-full font-black">Kontrak</span></td>
                            <td class="p-4 font-semibold"><?= $k->getDepartemen() ?></td>
                            <td class="p-4 text-center font-semibold"><?= $k->getHariKerja() ?> hari</td>
                            <td class="p-4 text-right font-semibold">Rp <?= number_format($k->getGajiDasar(), 0, ',', '.') ?></td>
                            <td class="p-4 text-right font-black text-pink-600 bg-pink-50/20 text-base">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>

                        <!-- Looping Tetap -->
                        <?php foreach ($daftarTetap as $k): ?>
                        <tr class="hover:bg-slate-50/50">
                            <td class="p-4 font-bold text-slate-900"><?= $k->getNama() ?></td>
                            <td class="p-4"><span class="bg-rose-600 text-white text-xs px-2.5 py-1 rounded-full font-black">Tetap</span></td>
                            <td class="p-4 font-semibold"><?= $k->getDepartemen() ?></td>
                            <td class="p-4 text-center font-semibold"><?= $k->getHariKerja() ?> hari</td>
                            <td class="p-4 text-right font-semibold">Rp <?= number_format($k->getGajiDasar(), 0, ',', '.') ?></td>
                            <td class="p-4 text-right font-black text-rose-600 bg-pink-50/20 text-base">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>

                        <!-- Looping Magang -->
                        <?php foreach ($daftarMagang as $k): ?>
                        <tr class="hover:bg-slate-50/50">
                            <td class="p-4 font-bold text-slate-900"><?= $k->getNama() ?></td>
                            <td class="p-4"><span class="bg-fuchsia-600 text-white text-xs px-2.5 py-1 rounded-full font-black">Magang</span></td>
                            <td class="p-4 font-semibold"><?= $k->getDepartemen() ?></td>
                            <td class="p-4 text-center font-semibold"><?= $k->getHariKerja() ?> hari</td>
                            <td class="p-4 text-right font-semibold">Rp <?= number_format($k->getGajiDasar(), 0, ',', '.') ?></td>
                            <td class="p-4 text-right font-black text-fuchsia-600 bg-pink-50/20 text-base">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- FOOTER -->
    <footer class="text-center text-xs text-slate-400 font-medium mt-16">
        &copy; 2026 <span class="font-extrabold text-pink-500 font-mono">QoHFi Corp</span> — Seluruh Hak Cipta Dilindungi Undang-Undang. Dikembangkan khusus oleh CEO QoHFi untuk UAS Pemrograman Berorientasi Objek.
    </footer>

    <!-- JAVASCRIPT LOGIK FILTER -->
    <script>
    // Fungsi baru untuk menangani klik pada box statistik
    function filterLewatBox(valuePilihan) {
        const dropdown = document.getElementById('filterView');
        dropdown.value = valuePilihan; // Set nilai dropdown secara otomatis
        ubahTampilan(); // Jalankan fungsi filter
    }

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
