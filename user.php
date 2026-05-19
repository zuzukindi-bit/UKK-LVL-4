<?php
session_start();
include 'koneksi.php';
if ($_SESSION['role'] != "user") {
    header('location: ./auth/login.php');
    header('location: ./auth/register.php');
    exit();
}

// Ambil jumlah total alumni untuk ditampilkan sebagai statistik kecil
$hitung_total = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM alumni");
$row_total = mysqli_fetch_assoc($hitung_total);
$total_alumni = $row_total['total'];
?>


<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Manajemen Data Alumni</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-slate-50 text-slate-800 min-h-full font-sans antialiased flex flex-col m-0 p-0">

    <header>
        <nav class="fixed top-0 left-0 w-full bg-gradient-to-r from-red-700 to-red-600 text-white py-3.5 px-4 shadow-lg z-50 backdrop-blur-md bg-opacity-95">
            <div class="container mx-auto max-w-7xl flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-3">
                    <h1 class="text-xl font-extrabold tracking-tight">Manajemen Data Alumni</h1>
                    <span class="hidden sm:inline-block text-[10px] font-bold uppercase tracking-wider bg-white/20 px-2.5 py-0.5 rounded-full border border-white/10">User Panel</span>
                </div>

                <div class="flex flex-wrap items-center justify-center md:justify-end gap-5 w-full md:w-auto">
                    <div class="flex items-center gap-3 w-full sm:w-auto justify-center">
                        <div class="bg-white text-red-600 py-2 px-4 text-xs font-bold rounded-xl flex items-center gap-2 shadow-sm border border-red-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            <p><?= $_SESSION['username'] ?></p>
                        </div>
                        <a href="logout.php" class="border border-white/40 bg-white/10 hover:bg-white hover:text-red-600 text-xs py-2 px-4 font-bold rounded-xl transition-all duration-200 flex items-center gap-2 active:scale-[0.98]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out">
                                <path d="m16 17 5-5-5-5" />
                                <path d="M21 12H9" />
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            </svg>
                            <p>Logout</p>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mx-auto max-w-7xl pt-28 pb-12 px-4">

        <div id="content"></div>

        <div class="bg-white p-6 rounded-2xl shadow-xs border border-slate-200/60 mb-6 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">

            <div class="flex-1 max-w-2xl">
                <!-- Form Pencarian -->
                <form method="GET" class="flex items-center gap-2">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-4.3-4.3" />
                            </svg>
                        </div>
                        <input type="text" name="cari" placeholder="Cari Nama / Tahun Lulus / Jurusan..."
                            value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>"
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-red-500 focus:bg-white focus:ring-4 focus:ring-red-500/10 transition-all duration-200" required>
                    </div>
                    <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white font-semibold text-sm px-5 py-2.5 rounded-xl cursor-pointer transition-colors active:scale-[0.98]">
                        Cari
                    </button>

                    <?php if (isset($_GET['cari']) && $_GET['cari'] != ''): ?>
                        <a href="user.php" class="bg-slate-100 hover:bg-slate-200 text-slate-600 p-2.5 rounded-xl transition-colors border border-slate-200 flex items-center justify-center" title="Reset Pencarian">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                <path d="M3 3v5h5" />
                            </svg>
                        </a>
                    <?php endif; ?>
                </form>
            </div>
            
            <div class="flex items-center gap-2 self-end md:self-auto bg-slate-50 border border-slate-200/80 px-4 py-2 rounded-xl">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <p class="text-xs font-bold text-slate-600 uppercase tracking-wider">
                    Total Terdata: <span class="text-slate-900 font-extrabold ml-1"><?= $total_alumni ?> Alumni</span>
                </p>
            </div>

        </div>

        <!-- Table dahsboard -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200/60 text-xs font-bold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4 text-center w-20">No</th>
                            <th class="px-6 py-4">Nama Lengkap</th>
                            <th class="px-6 py-4">Tahun Lulus</th>
                            <th class="px-6 py-4">Jurusan/Program Studi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">

                        <?php
                        if (isset($_GET['cari'])) {
                            $cari = $_GET['cari'];
                            $result = mysqli_query($koneksi, "SELECT * FROM alumni
                             WHERE nama LIKE '%$cari%'
                             OR angkatan LIKE '%$cari%'
                             OR jurusan LIKE '%$cari%'");
                        } else {
                            $result = mysqli_query($koneksi, "SELECT * FROM alumni");
                        }
                        ?>

                        <?php
                        while ($data = mysqli_fetch_assoc($result)) {
                            // Mengubah keluaran string echo ke format komponen UI yang dinamis & bersih
                            echo "<tr class='hover:bg-slate-50/80 transition-colors duration-150 text-sm text-slate-700 font-medium'>
                                 <td class='px-6 py-4 text-center font-bold text-slate-400'>{$data['id']}</td>
                                 <td class='px-6 py-4 font-semibold text-slate-900'>{$data['nama']}</td>
                                 <td class='px-6 py-4'>
                                     <span class='inline-flex items-center bg-red-50 text-red-700 text-xs px-2.5 py-1 rounded-md font-bold border border-red-100/50'>
                                         {$data['angkatan']}
                                     </span>
                                 </td>
                                 <td class='px-6 py-4 text-slate-600'>{$data['jurusan']}</td>
                             </tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>

            <?php if (mysqli_num_rows($result) == 0): ?>
                <div class="p-8 text-center text-slate-400 text-sm font-medium">
                    <p>Tidak ada data alumni yang ditemukan.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="mt-auto shrink-0 w-full bg-slate-900 text-slate-300 border-t border-slate-800/80">
        <div class="pt-5 py-1">
            <div class="container mx-auto max-w-7xl flex flex-col justify-center gap-4">
                <h1 class="text-2xl text-center font-bold text-white tracking-tight">Manajemen Data Alumni</h1>
                <p class="text-sm text-center font-regular text-slate-200">Platform penelusuran data alumni untuk memetakan perkembangan karir, </br> mempererat jejaring komunikasi, dan berbagi inspirasi antar angkatan.</p>
            </div>
        </div>

        <hr class="border-t border-white/10 mt-6 mb-4 w-full max-w-4xl mx-auto" />

        <div class="mt-2 py-4 flex-col text-center text-xs text-slate-400 tracking-wide">
            <p class="text-md font-medium">&copy; 2026 <span class="text-slate-500">Tim rasyid_ux</span></p>
        </div>
        </div>
    </footer>


</body>

</html>