<div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit {{ $song->title }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
    </div>
    <div class="modal-body">
        <form  id="updateSongForm">
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $song->title }}">
            </div>
            <div class="col-md-6 mb-2">
                <label for="">Album Name</label>
                <input type="text" class="form-control" name="album_name" id="album_name" value="{{ $song->album_name }}">
            </div>
        
            <div class="col-md-6 mb-2">
                <label for="">Genre</label>
                <select name="genre" class="form-control" id="genre">
                    <option value="rnb" {{$song->genre == 'rnb' ? 'selected' : ''}}>RNB</option>
                    <option value="country" {{$song->genre == 'country' ? 'selected' : ''}}>Country</option>
                    <option value="classic" {{$song->genre == 'classic' ? 'selected' : ''}}>Classic</option>
                    <option value="rock" {{$song->genre == 'rock' ? 'selected' : ''}}>Rock</option>
                    <option value="jazz" {{$song->genre == 'jazz' ? 'selected' : ''}}>Jazz</option>
                </select>
            </div>
        </div>
        <p class="text-danger mt-2 mb-2" id="errorShow" hidden>Please fill the highlighted text</p>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" onclick="updateSong({{ $song->id }})" class="btn btn-dark">Update changes</button>
    </div>
    </div>
</div>

<script>
    
</script>
