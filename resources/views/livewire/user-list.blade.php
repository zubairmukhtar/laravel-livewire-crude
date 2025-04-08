<div>
    <div class="container my-3">

        <div class="row border-bottom py-2">
            <div class="col-xl-11 m-auto">
                <h4 class="text-center fw-bold">Task One</h4>

                <h4 class="text-center fw-bold">CRUD App Using Livewire 3 + Laravel 10</h4>
            </div>

            <div class="col-xl-12 text-end">
                <a wire:navigate href="{{ route('create.user') }}" class="btn btn-primary btn-sm">Add User </a>
            </div>
        </div>
        <div class="my-2">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <div class="card">
            <div class="card-body mt-4 table-responsive shadow">

                <div class="col-xl-4 ms-auto my-3">
                    <input type="text" wire:model.live.debounce.100ms="searchTerm" class="form-control"
                        placeholder="Search User.." />
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Profile Image
                                <span wire:click="sortBy('profile_image')">
                                    @if ($sortColumn === 'profile_image')
                                        @if ($sortOrder === 'asc')
                                            <i class="fa-solid fa-sort-up"></i>
                                        @else
                                            <i class="fa-solid fa-sort-down"></i>
                                        @endif
                                    @else
                                        <i class="fa-solid fa-sort"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Name
                                <span wire:click="sortBy('name')">
                                    @if ($sortColumn === 'name')
                                        @if ($sortOrder === 'asc')
                                            <i class="fa-solid fa-sort-up"></i>
                                        @else
                                            <i class="fa-solid fa-sort-down"></i>
                                        @endif
                                    @else
                                        <i class="fa-solid fa-sort"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Email
                                <span wire:click="sortBy('email')">
                                    @if ($sortColumn === 'email')
                                        @if ($sortOrder === 'asc')
                                            <i class="fa-solid fa-sort-up"></i>
                                        @else
                                            <i class="fa-solid fa-sort-down"></i>
                                        @endif
                                    @else
                                        <i class="fa-solid fa-sort"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Date
                                <span wire:click="sortBy('created_at')">
                                    @if ($sortColumn === 'created_at')
                                        @if ($sortOrder === 'asc')
                                            <i class="fa-solid fa-sort-up"></i>
                                        @else
                                            <i class="fa-solid fa-sort-down"></i>
                                        @endif
                                    @else
                                        <i class="fa-solid fa-sort"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Actions

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users) > 0)
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a wire:navigate href=""><img
                                                src="{{ Storage::url($user->profile_image) }}" class="img-fluid"
                                                width="150px" /></a>
                                    </td>
                                    <td><a class="text-decoration-none" wire:navigate
                                            href=""></a>{{ $user->name }}
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}" wire:navigate
                                            class="btn btn-success btn-sm">Edit</a>
                                        <button wire:confirm="Are you sure, you want to delete?"
                                            wire:click="deletePost({{ $user->id }})" type="button"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" style="text-align: center">Data Not Found</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
