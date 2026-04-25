<div class="sidebar-wrapper">
    <div class="position-relative d-flex justify-content-center">
        <div class="position-absolute sidebar-image-wrapper ">
            <img src="{{ asset('storage/defaults/slsu-cas-logo.png') }}" alt="">
            <h4 class="text-light">SLSU - CAS</h4>
        </div>
    </div>

    <nav class="sidebar-nav-wrapper">
        <button id="sidebarToggle" class="btn btn-modern">☰</button>
        <a href="{{route('dashboard')}}" class="side-link @if(request()->routeIs('dashboard')) link-active @endif">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
            </svg>
            <span class="link-text">Home</span>
        </a>
        {{-- @if(!request()->routeIs('profile.*')) --}}

            {{-- Add inside all the link related for patient --}}
            @if(auth()->user()->account_type == 3)
            @endif

            {{-- Add inside all the link related for admin --}}
            @if(auth()->user()->account_type == 1)
                <a href="{{route('specialists.index')}}" class="side-link @if(request()->routeIs('specialists.*')) link-active @endif">Manage Specialist</a>
                <a href="{{route('patients.list')}}" class="side-link @if(request()->routeIs('patients.list')) link-active @endif">Manage Patients</a>
                <a href="{{route('services.index')}}" class="side-link @if(request()->routeIs('services.*')) link-active @endif">Manage Services</a>
                <a href="{{route('appointments.index')}}" class="side-link @if(request()->routeIs('appointments.*')) link-active @endif">Manage Appointments</a>
            @endif

            {{-- Add inside all the link related for speciaslit --}}
            @if(auth()->user()->account_type == 2)
                <a href="{{route('schedules.index')}}" class="side-link @if(request()->routeIs('schedules.*')) link-active @endif">My Schedules</a>
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
  const toggleBtn = document.getElementById('sidebarToggle');
  const sidebar = document.querySelector('.sidebar-wrapper');

  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('sidebar-collapsed');
  });
</script>