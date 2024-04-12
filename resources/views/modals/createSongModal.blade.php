<div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create new song</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
    </div>
    <div class="modal-body">
        <form  id="storeSongForm">
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title" id="title" >
            </div>
            <div class="col-md-6 mb-2">
                <label for="">Album Name</label>
                <input type="text" class="form-control" name="album_name" id="album_name" >
            </div>
            <div class="col-md-6">
                <label for="">Genre</label>
                <select name="genre" id="genre" class="form-control">
                    <option value="rnb">RNB</option>
                    <option value="country">Country</option>
                    <option value="classic">Classic</option>
                    <option value="rock">Rock</option>
                    <option value="jazz">Jazz</option>
                </select>
            </div>
        </div>
        <input type="text" name="artist_id" value="{{$artist_id}}" id="artist_id" hidden>
        <p class="text-danger mt-2 mb-2" id="errorShow" hidden>Please fill the highlighted text</p>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" onclick="storeSong()" class="btn btn-dark">Submit</button>
    </div>
    </div>
</div>


