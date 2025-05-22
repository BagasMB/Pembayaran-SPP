<div>
    <div class="card card-responsive mb-3">
        <div class="card-header">
            <h5 class="mb-4">Data User</h5>
            <div class="form-group d-flex align-items-center justify-content-between">
                <div>
                    <label>
                        Show
                        <select wire:model.live="paginate" class="border rounded px-2 py-1 text-sm text-secondary">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        entries
                    </label>
                </div>
                <div class="col-sm-3">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                        <input type="text" wire:model="search" wire:keyup="updateSearch($event.target.value)"
                            class="form-control" placeholder="Search..." aria-label="Search..."
                            aria-describedby="basic-addon-search31">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped" width="100%">
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
                                <td>{{ $userList->firstItem() + $loop->index }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles->first()->name ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    @if (Auth::user()->username != $user->username)
                                        <a href="delete-user/{{ $user->id }}" class="btn btn-danger btn-sm">
                                            <i class="bx bx-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted small">
                    Showing {{ $userList->firstItem() }} to {{ $userList->lastItem() }} of
                    {{ $userList->total() }} entries
                </div>
                <div>
                    {{ $userList->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>