@extends('layouts.app')

@section('content')
<div class="container p-3">
    <div class="mt-4 mb-3 d-flex justify-content-end">
        <button class="btn btn-dark" onclick="createArtistModal()">Add Artist</button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>D.O.B</th>
                    <th>First Release (Year)</th>
                    <th>No of albums</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($artists as $artist)
                <tr>
                    <td>{{ $artist->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($artist->dob)->format('Y-m-d') }}</td>
                    <td>{{ $artist->first_release_year }}</td>
                    <td>{{ $artist->no_of_albums_released }}</td>
                    <td>
                        <a href="#" type="button" onclick="editArtistModal({{ $artist->id }})" class="text-secondary">Edit</a>
                        <a href="#" onclick="deleteModal({{$artist->id}})" class="text-danger">Delete</a>
                        <a href="{{ route('getSongs',$artist->id) }}" class="text-temporary" >Songs</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No artist yet!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Display pagination links -->
    
    <!-- Pagination Links -->
    
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            @for ($i = max(1, $currentPage - 1); $i <= min($totalPages, $currentPage + 1); $i++)
                <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ route('getAllArtist', ['page' => $i]) }}">{{ $i }}</a>
                </li>
            @endfor
        </ul>
    </nav>

</div>
@endsection

<script src="{{ asset('js/modal.js') }}"></script>
<script>
    function deleteModal(artistId){
        let url = "{{route('deleteArtist','')}}" + `/${artistId}`;
        handleModal(url);
    }

    async function destroyArtist(id){
        let url = "{{route('destroyArtist','')}}" + `/${id}`;
        let res = await fetch(url);
        if (res.status == 200) {
            let data = await res.json();
            if (data.response == true) {
                Swal.fire({
                    icon: 'success',
                    title: 'Toast Message',
                    text: data.message,
                    timer: 3000, // Duration of the toast in milliseconds (3 seconds)
                    timerProgressBar: true, // Enable timer progress bar
                    toast: true,
                    position: 'top-end', // Position of the toast message
                    showConfirmButton: false // Hide the OK button
                });

                setTimeout(function() {
                    window.location.reload();
                }, 4000);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error Toast Message',
                    text: data.message,
                    timer: 3000, // Duration of the toast in milliseconds (3 seconds)
                    timerProgressBar: true, // Enable timer progress bar
                    toast: true,
                    position: 'top-end', // Position of the toast message
                    showConfirmButton: false // Hide the OK button
                });
            }
        }
    }

    function editArtistModal(artistId){
        let url = "{{ route('getArtist','') }}" + `/${artistId}`;
        handleModal(url);
    }

    function updateArtist(artistId){
        let url = "{{ route('updateArtist') }}";
        let token = "{{ csrf_token() }}";
        handleDB(url,'updateArtistForm',artistId,token);
    }

    

    function storeArtist(){
        let form = document.getElementById('storeArtistForm');

        // Artist form fields
        var name = document.getElementById('name');
        var dob = document.getElementById('dob');
        var address = document.getElementById('address');
        var gender = document.getElementById('gender');
        var firstReleaseYear = document.getElementById('first_release_year');
        var noOfAlbumsReleased = document.getElementById('no_of_albums_released');
        
        let artistArr = [name,dob,address,gender,firstReleaseYear,noOfAlbumsReleased];
        let artistErrorCount = validateForm1(artistArr);
        let songErrorCount = 0;

        // Check if songs are added
        let songsDivChecked = document.getElementById('addSongs').checked;
        if (songsDivChecked) {
            var songTitleInputs = document.getElementsByName('songs[title][]');
            var songAlbumInputs = document.getElementsByName('songs[album_name][]');
            var songGenreInputs = document.getElementsByName('songs[genre][]');

            var songDataArr = [...songTitleInputs,...songAlbumInputs,...songGenreInputs];
            songErrorCount = validateForm1(songDataArr);
        }

        let totalErrorCount = artistErrorCount + songErrorCount;
        debugger
        if (totalErrorCount > 0) {
            document.getElementById('errorShow').hidden = false;
        } else {
            document.getElementById('errorShow').hidden = true;
            form.submit();
        }
        debugger
    }

    function validateForm1(entries){
        let errorCount =0;
        entries.forEach(element => {
            if (element.value.trim() == '') {
                element.style.border = '1px solid red';
                errorCount++;
            } else {
                element.style.border = '';
            }
        });
        return errorCount;
    }

    function createArtistModal(){
        let url = "{{ route('createArtist') }}";
        handleModal(url); // Pass the URL to handleModal function
    }

    function toggleSongContent(){
        let songDiv = document.getElementById('songDiv');
        let dynamicDiv = document.getElementById('dynamicDiv');

        if (event.target.checked == true) {
            songDiv.hidden = false;
            dynamicDiv.style.display = 'block';

        } else {
            songDiv.hidden = true;
            dynamicDiv.style.display = 'none';
        }
    }

    function addRows(){
        let dynamicDiv = document.getElementById('dynamicDiv');
        let cardDiv = document.createElement('div');
        cardDiv.classList.add('card');
        cardDiv.classList.add('mt-3');
        cardDiv.classList.add('mb-3');
        cardDiv.classList.add('p-3');

        let innerSubstance = `
            <div class="row">
                <div class="col-md-10 mb-2">
                    <label for="">Title</label>
                    <input type="text" name="songs[title][]" class="form-control">
                </div>
                <div class="col-md-2 mb-2">
                    <button type="button" class="btn btn-danger mt-4" onclick="removeRows()">Remove</button>
                </div>
                <div class="col-md-6">
                    <label for="">Album Name</label>
                    <input type="text" name="songs[album_name][]" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="">Genre</label>
                    <select name="songs[genre][]" class="form-control">
                        <option value="rnb">RNB</option>
                        <option value="country">Country</option>
                        <option value="classic">Classic</option>
                        <option value="rock">Rock</option>
                        <option value="jazz">Jazz</option>
                    </select>
                </div>
            </div>
        `;
        cardDiv.innerHTML = innerSubstance;
        dynamicDiv.append(cardDiv);
    }

    function removeRows(){
        event.target.parentElement.parentElement.parentElement.remove()
    }
</script>
