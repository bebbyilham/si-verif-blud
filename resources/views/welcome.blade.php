<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI-VERIF BLUD - Sistem Verifikasi Dokumen Pengeluaran BLUD</title>

    <!-- Primary SEO Meta Tags -->
    <meta name="title" content="SI-VERIF BLUD - Sistem Verifikasi Dokumen Pengeluaran BLUD">
    <meta name="description" content="Sistem Informasi Verifikasi Dokumen Pengeluaran BLUD. Platform digital terpadu untuk pengajuan, verifikasi kelengkapan berkas SPJ, dan pengesahan dokumen pengeluaran BLUD secara transparan, akuntabel, dan real-time.">
    <meta name="keywords" content="SI-VERIF BLUD, Verifikasi BLUD, Dokumen Pengeluaran, SPJ BLUD, Verifikasi SPJ, Keuangan BLUD, Permendagri 77 Tahun 2020">
    <meta name="author" content="Subbag Akuntansi, Verifikasi dan Perbendaharaan BLUD">
    <meta name="theme-color" content="#4f46e5">

    <!-- Open Graph / Facebook / WhatsApp -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:site_name" content="SI-VERIF BLUD">
    <meta property="og:title" content="SI-VERIF BLUD - Sistem Verifikasi Dokumen Pengeluaran BLUD">
    <meta property="og:description" content="Platform digital terpadu untuk pengajuan, verifikasi berkas SPJ, dan pengesahan dokumen pengeluaran BLUD secara transparan, akuntabel, dan real-time.">
    <meta property="og:image" content="{{ asset('icon.png') }}">
    <meta property="og:image:secure_url" content="{{ asset('icon.png') }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="512">
    <meta property="og:image:height" content="512">
    <meta property="og:image:alt" content="Logo SI-VERIF BLUD">
    <meta property="og:locale" content="id_ID">

    <!-- Twitter / X -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="{{ url('/') }}">
    <meta name="twitter:title" content="SI-VERIF BLUD - Sistem Verifikasi Dokumen Pengeluaran BLUD">
    <meta name="twitter:description" content="Platform digital terpadu untuk pengajuan, verifikasi berkas SPJ, dan pengesahan dokumen pengeluaran BLUD secara transparan, akuntabel, dan real-time.">
    <meta name="twitter:image" content="{{ asset('icon.png') }}">
    <meta name="twitter:image:alt" content="Logo SI-VERIF BLUD">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">

    <!-- Instant redirect to admin panel -->
    <meta http-equiv="refresh" content="0;url={{ url('/admin') }}">
    <script>
        window.location.replace("{{ url('/admin') }}");
    </script>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: #f8fafc;
            color: #334155;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .redirect-box {
            text-align: center;
            padding: 30px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid #e2e8f0;
            max-width: 420px;
        }
        .redirect-link {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: #4f46e5;
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="redirect-box">
        <h2 style="margin: 0 0 8px; color: #1e1b4b; font-size: 18px;">SI-VERIF BLUD</h2>
        <p style="margin: 0; font-size: 14px; color: #64748b;">Mengarahkan ke Sistem Verifikasi Dokumen Pengeluaran...</p>
        <a href="{{ url('/admin') }}" class="redirect-link">Klik jika tidak otomatis dialihkan</a>
    </div>
</body>
</html>
