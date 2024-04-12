<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artist Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-PDW+0zvLcQSb5A0JxuE/aR2bHPuUf8aBK0ZDcpE5uQclngfTMbm3Kz76Yt3NMh72L1H+0TIlcF/wSaztVL3U3w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    @include('sweetalert::alert')

    <div class="wrapper d-flex">
        @guest
            @yield('content')
        @else
            <!-- Sidebar -->
            @include('backend.partials.sidebar')

            <!-- Page content -->
            <div class="page-wrapper">
                <!-- Header -->

                <!-- Content -->
                <div class="page-content">
					<div class="container p-3">
						@yield('content')
					</div>
                </div>
            </div>
        @endif
    </div>
	<div class="modal fade" id="mainModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
    function closeModal(){
        debugger
        let modalDiv = document.getElementById('mainModal');
        modalDiv.classList.remove('show'); // Hide the modal
        modalDiv.style.display = 'none'; // Hide modal
        document.body.classList.remove('modal-open'); // Allow scrolling behind modal
        let backdropDiv = document.querySelector('.modal-backdrop');
        document.body.removeChild(backdropDiv); // Remove backdrop
    }
</script>
</body>
</html>
