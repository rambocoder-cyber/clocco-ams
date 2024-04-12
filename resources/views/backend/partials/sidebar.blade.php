<!-- Sidebar -->
<div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height: 100vh;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
        <span class="fs-4">Artist App</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link text-white" aria-current="page" id="user-link">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                Users
            </a>
        </li>
        <li>
            <a href="{{ route('getAllArtist') }}" class="nav-link text-white" id="artist-link">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                Artists
            </a>
        </li>
        
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>{{ ucwords(auth()->user()->first_name) }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#" onclick="showProfile({{auth()->id()}})">Profile</a></li>
            <li><a class="dropdown-item" href="#">Change Password</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}" >Log out</a></li>
        </ul>
    </div>
</div>
<script>
    document.getElementById('user-link').addEventListener('click',()=>{
        document.getElementById('artist-link').classList.remove('active');
        document.getElementById('user-link').classList.add('active');
        debugger
    });
    document.getElementById('artist-link').addEventListener('click',()=>{
        document.getElementById('user-link').classList.remove('active');
        document.getElementById('artist-link').classList.add('active');
        debugger
    });

    document.addEventListener('DOMContentLoaded', function() {
        var currentUrl = window.location.href;

        var artistLink = document.getElementById('artist-link');
        var userLink = document.getElementById('user-link');

        if (artistLink.href === currentUrl) {
            userLink.classList.remove('active');
            artistLink.classList.add('active');
        }

        if (userLink.href == currentUrl) {
            artistLink.classList.remove('active');
            userLink.classList.add('active');
        }
    });

    function showProfile(id){
        let url = "{{ route('showUser','') }}" + `/${id}`;
        handleModal(url);
    }

    async function handleModal(url){
        try {
            let res = await fetch(url);
            if (res.status == 200) {
                let data = await res.json();
                debugger;
                let modalDiv = document.getElementById('mainModal');
                modalDiv.innerHTML = data.page;
                modalDiv.classList.add('show'); // Show the modal
                modalDiv.style.display = 'block'; // Ensure modal is displayed
                document.body.classList.add('modal-open'); // Prevent scrolling behind modal
                let backdropDiv = document.createElement('div');
                backdropDiv.classList.add('modal-backdrop', 'fade', 'show');
                document.body.appendChild(backdropDiv);
            }
        } catch (error) {
            console.log(error);
        }
    }
</script>