<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    {{-- Navbar brand --}}
    <form action="/logout" method="post">
        @csrf
        <a class="navbar-brand pl-3">
            <button class="border-0 bg-white" type="submit">
                <i class="bi bi-box-arrow-left mr-2"></i> Keluar
            </button>
        </a>
    </form>

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="bi bi-list"></i>
    </button>

</nav>
<!-- End of Topbar -->
