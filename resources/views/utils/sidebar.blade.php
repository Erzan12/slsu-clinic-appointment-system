<div class="sidebar-wrapper">
    <div class="position-relative d-flex justify-content-center">
        <div class="position-absolute sidebar-image-wrapper ">
            <img src="{{ asset('storage/defaults/slsu-cas-logo.png') }}" alt="">
            <h4 class="text-light">SLSU - CAS</h4>
        </div>
    </div>

    <nav class="sidebar-nav-wrapper">
        {{-- <button id="sidebarToggle" class="btn btn-modern">☰</button> --}}
        <button id="sidebarToggle" class="btn btn-modern">
            <span id="toggleIcon">←</span>
        </button>
        <a href="{{route('dashboard')}}" class="side-link @if(request()->routeIs('dashboard')) link-active @endif">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-graph-down" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M0 0h1v15h15v1H0zm14.817 11.887a.5.5 0 0 0 .07-.704l-4.5-5.5a.5.5 0 0 0-.74-.037L7.06 8.233 3.404 3.206a.5.5 0 0 0-.808.588l4 5.5a.5.5 0 0 0 .758.06l2.609-2.61 4.15 5.073a.5.5 0 0 0 .704.07"/>
            </svg>
            <span class="link-text">Dashboard</span>
        </a>
        {{-- @if(!request()->routeIs('profile.*')) --}}

            {{-- Add inside all the link related for patient --}}
            @if(auth()->user()->account_type == 3)
            @endif

            @php
                $isManagementActive = request()->routeIs('specialists.*') ||
                                    request()->routeIs('patients.*') ||
                                    request()->routeIs('services.*') ||
                                    request()->routeIs('appointments.*');
            @endphp

            <a class="side-link side-parent {{ $isManagementActive ? 'link-active' : '' }}" id="managementToggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-kanban" viewBox="0 0 16 16">
                    <path d="M13.5 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-11a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm-11-1a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                    <path d="M6.5 3a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm-4 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm8 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1z"/>
                </svg>
                <span class="link-text">Management</span>
            </a>

            <div class="side-submenu {{ $isManagementActive ? 'open' : '' }}" id="managementMenu">
                @if(auth()->user()->account_type == 1)
                    {{-- <a href="{{route('specialists.index')}}" class="side-link">Manage Specialist</a> --}}
                    <a href="{{route('specialists.index')}}" 
                        class="side-link {{ request()->routeIs('specialists.*') ? 'link-active' : '' }}">
                        Manage Specialist
                    </a>
                    <a href="{{route('patients.list')}}" 
                        class="side-link {{ request()->routeIs('patients.*') ? 'link-active' : '' }}">
                        Manage Patients
                    </a>
                    <a href="{{route('services.index')}}"
                        class="side-link {{ request()->routeIs('services.*') ? 'link-active' : '' }}">
                        Manage Services
                    </a>
                    <a href="{{route('appointments.index')}}"
                        class="side-link {{ request()->routeIs('appointments.*') ? 'link-active' : '' }}">
                        Manage Appointments
                    </a>
                @endif
            </div>
            

            {{-- Add inside all the link related for speciaslit --}}
            @if(auth()->user()->account_type == 2)
                <a href="{{route('schedules.index')}}" class="side-link @if(request()->routeIs('schedules.*')) link-active @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                </svg>    
                    My Schedules
                </a>
            @endif

            {{-- Add inside all the links related and can be use for patient and specialist --}}
            @if(auth()->user()->account_type == 2 || auth()->user()->account_type == 3)
                <a href="{{route('appointments.index')}}" class="side-link @if(request()->routeIs('appointments.*')) link-active @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                    <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                </svg>
                    My Appointments
                </a>
            @endif
        {{-- @else --}}
            {{-- <a href="{{route('profile.information')}}" class="side-link @if(request()->routeIs('profile.information')) link-active @endif">My Information</a> --}}
            {{-- <a href="" class="side-link @if(request()->routeIs('profile.password')) link-active @endif">Change Password</a> --}}
        {{-- @endif --}}
    </nav>
</div>
<script>
    const toggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar-wrapper');
    const icon = document.getElementById('toggleIcon');

    toggle.addEventListener('click', () => {
        sidebar.classList.toggle('sidebar-collapsed');

        if (sidebar.classList.contains('sidebar-collapsed')) {
        icon.textContent = '→'; // collapsed state (expand)
        } else {
        icon.textContent = '←'; // expanded state (collapse)
        }
    });

    const mgToggle = document.getElementById('managementToggle');
    const mgMenu = document.getElementById('managementMenu');

    mgToggle.addEventListener('click', () => {
        mgMenu.classList.toggle('open');
    });

    // document.getElementById('managementToggle').addEventListener('click', function () {
    //     document.getElementById('managementMenu').classList.toggle('open');
    // });
</script>