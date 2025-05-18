<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SISFO SARPRAS')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-color: #7e57c2;
            --secondary-color: #5e35b1;
            --sidebar-bg: linear-gradient(135deg, #7e57c2, #5e35b1);
        }
        body {
            min-height: 100vh;
            display: flex;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #e6eaf4 100%);
        }

        .sidebar {
            width: 250px;
            background: var(--sidebar-bg);
            color: white;
            padding: 20px 10px;
            height: 100vh;
            position: fixed;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .sidebar-header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar-header h4 {
            font-weight: bold;
            letter-spacing: 0.5px;
            margin: 0;
        }

        .sidebar a {
            color: white;
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 8px;
            text-decoration: none;
            margin-bottom: 8px;
            transition: all 0.2s ease;
            position: relative;
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.15);
            font-weight: 500;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .sidebar hr {
            opacity: 0.2;
            margin: 15px 0;
        }

        .dropdown-toggle {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 8px;
            cursor: pointer;
            margin-bottom: 8px;
            transition: all 0.2s ease;
        }

        .dropdown-toggle i {
            margin-right: 10px;
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        .dropdown-toggle:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .dropdown-toggle .icon-toggle {
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .dropdown-toggle.active .icon-toggle {
            transform: rotate(180deg);
        }

        #laporan-submenu {
            padding-left: 15px;
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease;
        }

        #laporan-submenu.show {
            max-height: 200px;
        }

        #laporan-submenu a {
            padding: 10px 15px 10px 30px;
        }

        .logout {
            position: absolute;
            bottom: 20px;
            width: 90%;
            left: 50%;
            transform: translateX(-50%);
        }

        .logout button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-weight: 500;
            background: linear-gradient(45deg, #dc3545, #c82333);
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .logout button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
            opacity: 0.9;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
            width: calc(100% - 250px);
            background-color: transparent;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                padding: 20px 5px;
            }

            .sidebar-header h4,
            .sidebar a span,
            .dropdown-toggle span {
                display: none;
            }

            .sidebar a,
            .dropdown-toggle {
                justify-content: center;
                padding: 12px 5px;
            }

            .sidebar a i,
            .dropdown-toggle i {
                margin-right: 0;
                font-size: 1.3rem;
            }

            #laporan-submenu {
                padding-left: 0;
            }

            #laporan-submenu a {
                padding: 10px 5px;
                justify-content: center;
            }

            .content {
                margin-left: 70px;
                width: calc(100% - 70px);
            }

            .logout button {
                padding: 8px;
                justify-content: center;
            }

            .logout button i {
                margin: 0;
            }

            .logout button span {
                display: none;
            }
        }

        .sidebar a.active::before {
            content: '';
            position: absolute;
            left: 0;
            height: 25px;
            width: 4px;
            background-color: white;
            border-radius: 0 4px 4px 0;
        }
    </style>
    @yield('styles')
</head>

<body>

    {{-- Sidebar --}}
    <div class="sidebar position-relative">
        <div class="sidebar-header">
            <h4>SARPRAS</h4>
        </div>

        <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('kategori-barangs.index') }}" class="{{ request()->is('kategori-barangs*') ? 'active' : '' }}">
            <i class="bi bi-folder"></i>
            <span>Kategori</span>
        </a>
        <a href="{{ route('barangs.index') }}" class="{{ request()->is('barangs*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i>
            <span>Barang</span>
        </a>
        <a href="{{ route('peminjamans.index') }}" class="{{ request()->is('peminjamans*') ? 'active' : '' }}">
            <i class="bi bi-arrow-right-circle"></i>
            <span>Peminjaman</span>
        </a>
        <a href="{{ route('pengembalians.index') }}" class="{{ request()->is('pengembalians*') ? 'active' : '' }}">
            <i class="bi bi-arrow-left-circle"></i>
            <span>Pengembalian</span>
        </a>
        <a href="{{ route('users.index') }}" class="{{ request()->is('user*') ? 'active' : '' }}">
            <i class="bi bi-people"></i>
            <span>User</span>
        </a>

        <hr class="text-white">

        <div class="dropdown-toggle" id="laporan-toggle">
            <i class="bi bi-file-earmark-text"></i>
            <span>Laporan</span>
            <i class="bi bi-chevron-down icon-toggle ms-auto"></i>
        </div>
        <div id="laporan-submenu">
            <a href="{{ route('laporan.barang') }}" class="{{ request()->is('laporan/barang') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-bar-graph"></i>
                <span>Laporan Barang</span>
            </a>
            <a href="{{ route('laporan.peminjaman') }}" class="{{ request()->is('laporan/peminjaman') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-arrow-up"></i>
                <span>Laporan Peminjaman</span>
            </a>
            <a href="{{ route('laporan.pengembalian') }}" class="{{ request()->is('laporan/pengembalian') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-arrow-down"></i>
                <span>Laporan Pengembalian</span>
            </a>
        </div>

        {{-- Logout di bawah --}}
        <form action="{{ route('logout') }}" method="POST" class="logout">
            @csrf
            <button type="submit" class="btn">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>

    {{-- Konten Utama --}}
    <div class="content">
        @yield('content')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const laporanToggle = document.getElementById('laporan-toggle');
            const laporanSubmenu = document.getElementById('laporan-submenu');

            laporanToggle.addEventListener('click', function() {
                this.classList.toggle('active');
                laporanSubmenu.classList.toggle('show');
            });

            const activeSubmenuItem = laporanSubmenu.querySelector('.active');
            if (activeSubmenuItem) {
                laporanToggle.classList.add('active');
                laporanSubmenu.classList.add('show');
            }
        });
    </script>
    @yield('scripts')
</body>

</html>