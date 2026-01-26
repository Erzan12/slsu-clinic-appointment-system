<div class="sidebar-wrapper">
    <div class="position-relative d-flex justify-content-center">
        <div class="position-absolute sidebar-image-wrapper ">
            <img src="https://trace.southernleyte.org.ph/assets/img/slsu-logo.png" alt="">
            <h4 class="text-light">SLSU - CAS</h4>
        </div>
    </div>

    <nav class="sidebar-nav-wrapper">
        <a href="{{route('dashboard')}}" class="side-link @if(request()->routeIs('dashboard')) link-active @endif">Home</a>
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
                <a href="{{route('appointments.index')}}" class="side-link @if(request()->routeIs('appointments.*')) link-active @endif">My Appointments</a>
            @endif
        {{-- @else --}}
            {{-- <a href="{{route('profile.information')}}" class="side-link @if(request()->routeIs('profile.information')) link-active @endif">My Information</a> --}}
            {{-- <a href="" class="side-link @if(request()->routeIs('profile.password')) link-active @endif">Change Password</a> --}}
        {{-- @endif --}}
    </nav>
</div>