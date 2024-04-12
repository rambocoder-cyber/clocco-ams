<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $user->first_name }} {{$user->last_name}} Details</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="">First Name</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $user->first_name }}" readonly>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="">Last Name</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $user->last_name }}" readonly>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" readonly>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="">DOB</label>
                    <input type="date" class="form-control" name="dob" id="dob" value="{{ \Carbon\Carbon::parse($user->dob)->format('Y-m-d') }}" readonly>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="">Phone Number</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}" readonly>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="">Address</label>
                    <input type="text" class="form-control" name="address" id="address" value="{{ $user->address }}" readonly>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="">Gender</label>
                    <select name="gender" class="form-control" id="gender" readonly>
                        <option value="m" {{$user->gender == 'm' ? 'selected' : ''}}>Male</option>
                        <option value="f" {{$user->gender == 'f' ? 'selected' : ''}}>Female</option>
                        <option value="o" {{$user->gender == 'o' ? 'selected' : ''}}>Others</option>
                    </select>
                </div>
            </div>

        </div>
    
    </div>
</div>

<script>
    
</script>
