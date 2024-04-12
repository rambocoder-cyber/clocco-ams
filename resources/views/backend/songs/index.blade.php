@extends('layouts.app')

@section('content')
<div class="container p-3">
    <div class="d-flex justify-content-between">
        <div class="mt-4 mb-3">
            <a href="{{ route('getAllArtist') }}" class="btn btn-dark">Return Back</a>
        </div>
        <div class="mt-4 mb-3">
            <button class="btn btn-dark" onclick="createSongsModal({{$id}})">Add Songs</button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Album Name</th>
                    <th>Genre</th>
                    <th>Artist</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($songs as $song)
                <tr>
                    <td>{{ $song->title }}</td>
                    <td>{{ $song->album_name }}</td>
                    <td>{{ $song->genre }}</td>
                    <td>{{ $song->artist_name }}</td>
                    <td>
                        <a href="#" onclick="editSongModal({{ $song->id }})" type="button" class="text-secondary">Edit</a>
                        <a href="#" onclick="deleteSongModal({{$song->id}})" class="text-danger">Delete</a>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No songs</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            @for ($i = max(1, $currentPage - 1); $i <= min($totalPages, $currentPage + 1); $i++)
                <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ route('getSongs', ['id'=>$song->artist_id,'page' => $i]) }}">{{ $i }}</a>
                </li>
            @endfor
        </ul>
    </nav>
</div>
@endsection

<script src="{{ asset('js/modal.js') }}"></script>
<script>
    function createSongsModal(id){
        let url = "{{ route('createSong','') }}" + `/${id}`;
        handleModal(url); // Pass the URL to handleModal function
    }

    function storeSong(){
        let url = "{{ route('storeSong') }}";
        let token = "{{ csrf_token() }}";
        handleDB(url,'storeSongForm',null,token);        
    }

    function editSongModal(songId){
        let url = "{{ route('editSong','') }}" + `/${songId}`;
        handleModal(url);
    }

    function updateSong(songId){
        let url = "{{ route('updateSong') }}";
        let token = "{{ csrf_token() }}";
        handleDB(url,'updateSongForm',songId,token);
    }

    function deleteSongModal(songId){
        let url = "{{route('deleteSong','')}}" + `/${songId}`;
        handleModal(url);
    }

    async function destroySong(id){
        let url = "{{route('destroySong','')}}" + `/${id}`;
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
</script>

