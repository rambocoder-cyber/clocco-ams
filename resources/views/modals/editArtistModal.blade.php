<div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit {{ $artist->name }} Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
    </div>
    <div class="modal-body">
        <form  id="updateArtistForm">
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $artist->name }}">
            </div>
            <div class="col-md-6 mb-2">
                <label for="">DOB</label>
                <input type="date" class="form-control" name="dob" id="dob" value="{{ \Carbon\Carbon::parse($artist->dob)->format('Y-m-d') }}">
            </div>
            
            <div class="col-md-6 mb-2">
                <label for="">Address</label>
                <input type="text" class="form-control" name="address" id="address" value="{{ $artist->address }}">
            </div>
            <div class="col-md-6 mb-2">
                <label for="">Gender</label>
                <select name="gender" class="form-control" id="gender">
                    <option value="m" {{$artist->gender == 'm' ? 'selected' : ''}}>Male</option>
                    <option value="f" {{$artist->gender == 'f' ? 'selected' : ''}}>Female</option>
                    <option value="o" {{$artist->gender == 'o' ? 'selected' : ''}}>Others</option>
                </select>
            </div>
            <div class="col-md-6 mb-2">
                <label for="">First Release Year</label>
                <input type="text" class="form-control" name="first_release_year" id="first_release_year" value="{{ $artist->first_release_year }}">
            </div>
            <div class="col-md-6 mb-2">
                <label for="">Albums Released</label>
                <input type="text" class="form-control" name="no_of_albums_released" id="no_of_albums_released" value="{{ $artist->no_of_albums_released }}">
            </div>
        </div>
        <p class="text-danger mt-2 mb-2" id="errorShow" hidden>Please fill the highlighted text</p>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" onclick="updateArtist({{ $artist->id }})" class="btn btn-dark">Update changes</button>
    </div>
    </div>
</div>

<script>
    
</script>
