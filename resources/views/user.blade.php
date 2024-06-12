<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <!-- Content -->

    <div class="card card-responsive mb-3">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Data User</h5>
            <span class="badge bg-label-primary float-end" type="button" data-bs-toggle="modal"
                data-bs-target="#modalTambahUser">
                <i class="fa-solid fa-person-circle-plus me-1"></i>
                Tambah
            </span>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="myTable" class="table table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>User Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userList as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalEditUser{{ $user->id }}">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    @if (Auth::user()->username != $user->username)
                                        <a type="button" id="btn-hapus" href="delete-user/{{ $user->id }}"
                                            class="btn btn-danger btn-sm">
                                            <i class="bx bx-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                @foreach ($userList as $user)
                    <div class="modal fade" id="modalEditUser{{ $user->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel3">Edit Data User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="updateuser" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <div class="row mb-2">
                                            <div class="col mb-2 text-start">
                                                <label class="form-label">UserName <strong
                                                        class="text-danger">*</strong></label>
                                                <input type="text" name="username" class="form-control"
                                                    placeholder="Enter Username" value="{{ $user->username }}"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col mb-2 text-start">
                                                <label class="form-label">Nama</label>
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Enter Nama" value="{{ $user->name }}"
                                                    autocomplete="off">
                                            </div>
                                            <div class="col mb-2 text-start">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="Email" value="{{ $user->email }}" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col mb-2 text-start">
                                                <label class="form-label">User Role</label>
                                                <select class="form-select" name="role">
                                                    <option value="Admin"
                                                        @if ($user->role == 'Admin') @selected(true) @endif>
                                                        Admin</option>
                                                    <option value="Staff"
                                                        @if ($user->role == 'Staff') @selected(true) @endif>
                                                        Staff</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>


    <div class="modal fade" id="modalTambahUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Tambah Data User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="simpanUser" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col mb-2 text-start">
                                <label class="form-label">UserName <strong class="text-danger">*</strong></label>
                                <input type="text" name="username" class="form-control"
                                    placeholder="Enter Username" autocomplete="off">
                            </div>
                            <div class="col mb-2 text-start form-password-toggle">
                                <label class="form-label">Password <strong class="text-danger">*</strong></label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        autocomplete="off">
                                    <div class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col mb-2 text-start">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Nama"
                                    autocomplete="off">
                            </div>
                            <div class="col mb-2 text-start">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col mb-2 text-start">
                                <label class="form-label">User Role</label>
                                <select class="form-select" name="role">
                                    <option value="Admin">Admin</option>
                                    <option value="Staff">Staff</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- / Content -->
</x-layout>
