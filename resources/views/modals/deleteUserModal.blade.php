<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this ?</p>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="destroyUser({{$user->id}})" class="btn btn-danger">Delete</button>
        </div>
    </div>
</div>

<script>
    
</script>
