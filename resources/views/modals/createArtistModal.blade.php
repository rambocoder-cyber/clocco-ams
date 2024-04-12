<div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create new artist</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
    </div>
    <div class="modal-body">
    <p class="text-danger mt-2 mb-2" id="errorShow" hidden>Please fill the highlighted text</p>

        <form  id="storeArtistForm" action="{{ route('storeArtist') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" id="name" >
            </div>
            
            <div class="col-md-6 mb-2">
                <label for="">DOB</label>
                <input type="date" class="form-control" name="dob" id="dob" >
            </div>
            <div class="col-md-6 mb-2">
                <label for="">Address</label>
                <input type="text" class="form-control" name="address" id="address">
            </div>
            <div class="col-md-6 mb-2">
                <label for="">Gender</label>
                <select name="gender" class="form-control" id="gender">
                    <option value="m" >Male</option>
                    <option value="f" >Female</option>
                    <option value="o" >Others</option>
                </select>
            </div>
            <div class="col-md-6 mb-2">
                <label for="">First Release Year</label>
                <input type="number" step="1" id="first_release_year" name="first_release_year" class="form-control" min="1700" max="4000">
            </div>
            <div class="col-md-6 mb-2">
                <label for="">No of albums released</label>
                <input type="number" step="1" id="no_of_albums_released" name="no_of_albums_released" class="form-control">
            </div>
            <div class="col-md-8 mb-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="addSongs" name="addSongs" onchange="toggleSongContent()">
                    <label class="form-check-label" for="addSongsCheckbox">Do you want to add songs?</label>
                </div>
            </div>
        </div>
        
        <div class="card p-3" id="songDiv" hidden>
            <div class="row">
                <div class="col-md-10 mb-2">
                    <label for="">Title</label>
                    <input type="text" name="songs[title][]" class="form-control">
                </div>
                <div class="col-md-2 mb-2">
                    <button type="button" class="btn btn-secondary mt-4" onclick="addRows()">Add</button>
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
        </div>  
        
        <div id="dynamicDiv">


        </div>


        </form>

    </div>
    <div class="modal-footer">
        <button type="button" onclick="storeArtist()" class="btn btn-dark">Submit</button>
    </div>
    </div>
</div>

<script>
    
</script>
