@extends('layouts.app')
@section('title', 'Manajemen User')

@section('styles')
<style>
    /* Modern design system */
    :root {
        --primary-color: #7e57c2;
        --primary-light: #b085f5;
        --primary-dark: #4d2c91;
        --accent-color: #ff6e40;
        --light-bg: #f5f3fc;
        --text-dark: #424242;
        --success: #4caf50;
        --warning: #ff9800;
        --danger: #f44336;
    }

    body {
        background-color: #f0f2f5; /* Light background for the overall page */
    }

    /* Card styling */
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(126, 87, 194, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 1.5rem; /* Space between cards */
    }

    .card:hover {
        box-shadow: 0 15px 35px rgba(126, 87, 194, 0.15);
    }

    /* Header styling */
    .page-header {
        color: #424242;
        font-weight: 700;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-header h1 {
        font-size: 2rem;
    }

    /* Card header styling */
    .card-header {
        background: none; /* No background for the card header */
        color: var(--text-dark);
        padding: 1rem 1.5rem 0.5rem 1.5rem; /* Adjusted padding */
        border-bottom: none;
        font-size: 1.25rem;
        font-weight: 600;
    }

    /* Search input styling */
    .search-input-container {
        padding: 0 1.5rem 1rem 1.5rem; /* Padding for the search input */
    }

    .search-input {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        width: 100%;
        font-size: 0.95rem;
        color: var(--text-dark);
        transition: border-color 0.3s ease;
    }

    .search-input::placeholder {
        color: #bdbdbd;
    }

    .search-input:focus {
        border-color: var(--primary-color);
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(126, 87, 194, 0.25);
    }

    /* User list item styling */
    .user-list-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #eee;
        color: var(--text-dark);
    }

    .user-list-item:last-child {
        border-bottom: none;
    }

    .user-list-item span {
        font-size: 1rem;
    }

    .user-role-badge {
        background-color: var(--primary-color);
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .user-role-badge.admin {
        background-color: #6a1b9a; /* Darker purple for Admin */
    }

    /* Button styling */
    .btn-tambah {
        border-radius: 50px;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        background: var(--primary-color); /* Changed background to primary color */
        color: white; /* Changed text color to white */
        border: none; /* Removed border */
        box-shadow: 0 4px 10px rgba(126, 87, 194, 0.25); /* Adjusted shadow */
        transition: all 0.3s ease;
    }

    .btn-tambah:hover {
        background: var(--primary-dark); /* Darker primary on hover */
        color: white;
        transform: translateY(-2px); /* Slightly less transform */
        box-shadow: 0 8px 18px rgba(126, 87, 194, 0.35); /* Adjusted shadow */
    }

    .btn-tambah i {
        margin-right: 0.5rem;
        font-size: 1.1rem;
        vertical-align: middle;
    }

    /* Alert styling */
    .alert {
        border-radius: 10px;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .alert-success {
        background-color: rgba(76, 175, 80, 0.1);
        color: #2e7d32;
        border-left: 4px solid #4caf50;
    }

    /* No data styling */
    .no-data {
        background-color: var(--light-bg);
        border: 2px dashed rgba(126, 87, 194, 0.3);
        color: var(--primary-color);
        border-radius: 10px;
        padding: 2rem !important;
        font-weight: 500;
        text-align: center;
        margin: 1rem 1.5rem; /* Adjusted margin */
    }
    .no-data i {
        font-size: 3rem !important;
        color: var(--primary-light);
        margin-bottom: 1rem;
        opacity: 0.7;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="page-header">
        <h1>Pengguna</h1>
        <a href="{{ route('users.create') }}" class="btn btn-tambah">
            <i class="bi bi-plus-circle"></i> Tambah User
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        {{-- Admin Card --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Admin <span class="text-muted small">Total: {{ $admins->count() }} Admin</span></h5>
                </div>
                <div class="search-input-container">
                    <input type="text" class="form-control search-input" placeholder="Cari Admin..." onkeyup="filterUsers('admin', this.value)">
                </div>
                <div class="card-body p-0">
                    <div id="admin-list">
                        @forelse ($admins as $admin)
                            <div class="user-list-item">
                                <span>{{ $loop->iteration }}. {{ $admin->name }}</span>
                                <span class="user-role-badge admin">Admin</span>
                            </div>
                        @empty
                            <div class="no-data">
                                <i class="bi bi-person-x-fill"></i>
                                <p class="mb-1">Tidak ada data admin.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- User Card --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">User <span class="text-muted small">Total: {{ $regularUsers->count() }} User</span></h5>
                </div>
                <div class="search-input-container">
                    <input type="text" class="form-control search-input" placeholder="Cari User..." onkeyup="filterUsers('user', this.value)">
                </div>
                <div class="card-body p-0">
                    <div id="user-list">
                        @forelse ($regularUsers as $user)
                            <div class="user-list-item">
                                <span>{{ $loop->iteration }}. {{ $user->name }}</span>
                                <span class="user-role-badge">User</span>
                            </div>
                        @empty
                            <div class="no-data">
                                <i class="bi bi-person-x-fill"></i>
                                <p class="mb-1">Tidak ada data user.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function filterUsers(role, searchText) {
        let listId = role + '-list';
        let items = document.querySelectorAll('#' + listId + ' .user-list-item');
        let noDataContainer = document.querySelector('#' + listId + ' + .no-data'); // Adjust if no-data is not a sibling

        let found = false;
        items.forEach(item => {
            let userName = item.querySelector('span').textContent.toLowerCase();
            if (userName.includes(searchText.toLowerCase())) {
                item.style.display = 'flex';
                found = true;
            } else {
                item.style.display = 'none';
            }
        });

        // If no items are found and there's a no-data message, show it
        if (!found) {
            let currentNoData = document.querySelector('#' + listId + ' .no-data');
            if (!currentNoData) { // Only append if it doesn't exist
                let noDataHtml = `
                    <div class="no-data">
                        <i class="bi bi-person-x-fill"></i>
                        <p class="mb-1">Tidak ada data ${role} yang cocok.</p>
                    </div>
                `;
                document.getElementById(listId).innerHTML = noDataHtml;
            } else {
                currentNoData.style.display = 'block';
            }
        } else {
             // If items are found, ensure any existing no-data message is hidden
            let currentNoData = document.querySelector('#' + listId + ' .no-data');
            if (currentNoData) {
                currentNoData.style.display = 'none';
            }
        }
    }
</script>
@endsection