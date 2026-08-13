<div class="split-login-container">
    <!-- Left Side: Modern Login Form -->
    <div class="split-login-left">
        <div class="split-login-form-wrapper">
            <!-- Brand Logo & Header -->
            <div class="split-brand-header">
                <div class="split-brand-logo-glow">
                    <div class="split-brand-logo">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                        </svg>
                    </div>
                </div>
                <div class="split-brand-text">
                    <span class="split-brand-title">Sistem Verifikasi BLUD</span>
                    <span class="split-brand-tag"></span>
                </div>
            </div>

            <!-- Login Welcome Heading -->
            <div class="split-heading-box">
                
                <h1 class="split-heading-title">Hi, Selamat Datang</h1>
                <p class="split-heading-subtitle">Masuk untuk mengelola & memverifikasi dokumen pengeluaran BLUD secara terpadu.</p>
            </div>

            <!-- Filament Livewire Login Form -->
            <form wire:submit="authenticate" class="split-filament-form">
                {{ $this->form }}

                <div class="split-form-actions">
                    <button type="submit" class="split-submit-btn">
                        <span>Login ke Sistem</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Right Side: Application Dashboard Feature Showcase -->
    <div class="split-login-right">
        <!-- Ambient Glowing Background Blobs -->
        <div class="split-hero-glow-top"></div>
        <div class="split-hero-glow-bottom"></div>

        <div class="split-hero-content">
            

            <h2 class="split-hero-title">
                Transparansi & Efisiensi Verifikasi Dokumen SPJ BLUD
            </h2>
            <p class="split-hero-subtitle">
                Alur kerja verifikasi berjenjang dari pengajuan PPTK, pemeriksaan verifikator, pengesahan PPK, hingga pencairan oleh Bendahara.
            </p>

            <!-- Interactive Dashboard Application Window Mockup -->
            <div class="app-dashboard-window">

                <!-- App Dashboard Content Preview -->
                <div class="app-window-body">
                    <div class="app-dasbor-title">Dasbor Monitoring SPJ</div>

                    <!-- Welcome Card Widget -->
                    <div class="pitch-welcome-card mini-welcome">
                        <div class="pitch-welcome-left">
                            <h2 class="pitch-welcome-title">
                                Hi, Tim Verifikator
                            </h2>
                            <p class="pitch-welcome-subtitle">
                                Kelola & pantau status pengajuan dokumen SPJ BLUD secara akurat.
                            </p>
                        </div>
                        <div class="pitch-welcome-right">
                            <img src="{{ asset('js/filament/widgets/components/undraw_budgeting_klon.svg') }}" alt="Budgeting Illustration" class="pitch-illustration">
                        </div>
                    </div>

                    <!-- Filter Pill Bar Mockup -->
                    <div class="app-filter-pill-bar">
                        <div class="app-pill-group">
                            <span class="app-pill active">Timeline</span>
                            <span class="app-pill">List</span>
                        </div>
                        <div class="app-pill-group">
                            <span class="app-pill">1D</span>
                            <span class="app-pill active">7D</span>
                            <span class="app-pill">1M</span>
                            <span class="app-pill">All time</span>
                        </div>
                    </div>

                    <!-- Stat Cards Grid -->
                    <div class="app-stats-grid">
                        <div class="app-stat-card">
                            <span class="app-stat-label">Total Dokumen</span>
                            <span class="app-stat-value">8</span>
                            <span class="app-stat-sub text-blue">Masuk 📄</span>
                        </div>
                        <div class="app-stat-card">
                            <span class="app-stat-label">Proses Verifikasi</span>
                            <span class="app-stat-value">3</span>
                            <span class="app-stat-sub text-orange">Review 🕒</span>
                        </div>
                        <div class="app-stat-card">
                            <span class="app-stat-label">Dikembalikan</span>
                            <span class="app-stat-value">2</span>
                            <span class="app-stat-sub text-red">Revisi ✖</span>
                        </div>
                        <div class="app-stat-card">
                            <span class="app-stat-label">Disahkan PPK</span>
                            <span class="app-stat-value">1</span>
                            <span class="app-stat-sub text-green">Setuju ✔</span>
                        </div>
                        <div class="app-stat-card">
                            <span class="app-stat-label">Dibayar</span>
                            <span class="app-stat-value">0</span>
                            <span class="app-stat-sub text-emerald">Cair 💲</span>
                        </div>
                        <div class="app-stat-card">
                            <span class="app-stat-label">Diarsipkan</span>
                            <span class="app-stat-value">1</span>
                            <span class="app-stat-sub text-gray">Arsip 🗄️</span>
                        </div>
                    </div>

                    <!-- Charts Preview -->
                    <div class="app-charts-grid">
                        <div class="app-chart-card">
                            <span class="app-chart-title">Pengeluaran 7 Hari</span>
                            <div class="app-bar-chart-preview">
                                <div class="app-bar-col"><span></span><small>04 Aug</small></div>
                                <div class="app-bar-col"><span></span><small>06 Aug</small></div>
                                <div class="app-bar-col"><span></span><small>08 Aug</small></div>
                                <div class="app-bar-col bar-active"><span style="height: 85%;"></span><small>10 Aug</small></div>
                            </div>
                        </div>
                        <div class="app-chart-card">
                            <span class="app-chart-title">Tren Pengajuan SPJ</span>
                            <div class="app-line-chart-preview">
                                <svg viewBox="0 0 200 50" class="app-line-svg">
                                    <path d="M10,45 L40,40 L70,35 L100,38 L130,25 L160,20 L190,8" fill="none" stroke="#6366f1" stroke-width="2.5" />
                                    <circle cx="190" cy="8" r="3.5" fill="#6366f1" />
                                </svg>
                                <div class="app-line-dates">
                                    <span>04 Aug</span><span>06 Aug</span><span>08 Aug</span><span>10 Aug</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floating Status Pulse Card -->
            <div class="split-floating-card">
                <div class="floating-card-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                </div>
                <div class="floating-card-content">
                    <span class="floating-card-title">Verifikasi Berjenjang Real-Time</span>
                    <span class="floating-card-sub">Otomatisasi notifikasi & audit trail dokumen SPJ</span>
                </div>
            </div>
        </div>
    </div>
</div>

