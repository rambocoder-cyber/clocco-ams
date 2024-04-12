<div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create new user</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
    </div>
    <div class="modal-body">
        <form  id="storeUserForm">
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" >
            </div>
            <div class="col-md-6 mb-2">
                <label for="">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" >
            </div>
            <div class="col-md-6 mb-2">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" id="email" >
            </div>
            <div class="col-md-6 mb-2">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password" id="password" >
            </div>
            <div class="col-md-6 mb-2">
                <label for="">DOB</label>
                <input type="date" class="form-control" name="dob" id="dob" >
            </div>
            <div class="col-md-6 mb-2">
                <label for="">Phone Number</label>
                <input type="text" class="form-control" name="phone" id="phone" >
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
        </div>
        <p class="text-danger mt-2 mb-2" id="errorShow" hidden>Please fill the highlighted text</p>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" onclick="storeUser()" class="btn btn-dark">Submit</button>
    </div>
    </div>
</div>

<script>
    
</script>
