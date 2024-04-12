@extends('layouts.app')

@section('content')
<div class="container p-3">
    <div class="mt-4 mb-3 d-flex justify-content-end">
        <button class="btn btn-dark" onclick="createUserModal()">Add User</button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>DOB</th>
                    <th>Address</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($user->dob)->format('Y-m-d') }}</td>
                    <td>{{ $user->address }}</td>
                    <td>
                        <a href="#" type="button" onclick="editModal({{ $user->id }})" class="text-secondary">Edit</i></a>
                        <a href="#" onclick="deleteModal({{$user->id}})" class="text-danger">Delete</i></a>
                        <a href="#" class="text-temporary" onclick="showUserModal({{$user->id}})">Show</i></a>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No users</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Display pagination links -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            @for ($i = max(1, $currentPage - 1); $i <= min($totalPages, $currentPage + 1); $i++)
                <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ route('dashboard', ['page' => $i]) }}">{{ $i }}</a>
                </li>
            @endfor
        </ul>
    </nav>

</div>

@endsection
<script src="{{ asset('js/modal.js') }}"></script>

<script>
    function deleteModal(userId){
        let url = "{{route('deleteUser','')}}" + `/${userId}`;
        debugger;
        handleModal(url);
    }

    async function destroyUser(id){
        let url = "{{route('destroy','')}}" + `/${id}`;
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

    function showUserModal(userId){
        let url = "{{ route('showUser','') }}" + `/${userId}`;
        handleModal(url);
    }

    function createUserModal(){
        let url = "{{ route('createUser') }}";
        handleModal(url);
    }

    function editModal(userId) {
        let url =  "{{ route('getUser', '') }}" + `/${userId}`;
        handleModal(url);
    }

    function storeUser(){
        let url = "{{ route('storeUser') }}";
        let token = "{{ csrf_token() }}";
        handleDB(url,'storeUserForm',null,token);        
    }


    async function updateUser(userId) {
        let url = "{{ route('updateUser') }}";
        let token = "{{ csrf_token() }}";
        handleDB(url,'updateUserForm',userId,token);
    }

    

</script>
