<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #537D5D;"> 
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="30" height="30" class="me-2">
            Sistem Informasi Deteksi Penyakit Padi
        </a>

        <div class="d-flex align-items-center gap-3">
            {{-- Icon Profil --}}
            <a href="#" class="text-white">
                <i class="bi bi-person-circle fs-4"></i>
            </a>

            {{-- Burger Icon --}}
            <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </div>
</nav>

{{-- tampilan saat icon burger ditekan --}}
<div class="offcanvas offcanvas-end text-white" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel" style="background-color: #73946B;" >
    <div class="offcanvas-header border-bottom border-secondary" style="background-color: #537D5D;">
        <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="d-grid gap-3">
            <a href="{{ route('users.index') }}" class="text-decoration-none text-white">
                <div class="p-2 rounded border border-light sidebar-item" style="background-color: #537D5D;">Kelola User</div>
            </a>

            <a href="#" class="text-decoration-none text-white">
                <div class="p-2 rounded border border-light sidebar-item" style="background-color: #537D5D;">Sistem Deteksi Padi</div>
            </a>

            <a href="#" class="text-decoration-none text-white">
                <div class="p-2 rounded border border-light sidebar-item" style="background-color: #537D5D;">Laporan Peringatan Bahaya</div>
            </a>

            <a href="#" class="text-decoration-none text-white">
                <div class="p-2 rounded border border-light sidebar-item" style="background-color: #537D5D;">Diagnosa dan Rekomendasi</div>
            </a>
        </div>
    </div>
</div>
