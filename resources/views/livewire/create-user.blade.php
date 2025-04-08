<div class="container pt-5">

    <div class="row">
        <div class="col-8 m-auto">
            <form wire:submit="store">
                <div class="card shadow border-1">
                    <div class="card-header">
                        <div class="row">

                            <div class="col-xl-6">
                                <h5 class="fw-bold">{{ $isView ? 'View' : ($user ? 'Edit' : 'Create') }} User</h5>
                            </div>

                            <div class="col-xl-6 text-end">
                                <a wire:navigate href="{{ route('users') }}" class="btn btn-primary btn-sm">Back to
                                    Users</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- Name --}}
                        <div class="form-group mb-2">
                            <label for="title">Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control" id="name"
                                placeholder="Enter Name"  required/>

                            @error('name')
                                <p class="text-danger">{{ $message }} </p>
                            @enderror
                        </div>
                        {{--  Email Address --}}
                        <div class="form-group mb-4">
                            <label for="content">Email Address <span class="text-danger">*</span></label>
                            <input type="text" wire:model="email" class="form-control" id="email address"
                                placeholder="Email Address" required />

                            @error('email')
                                <p class="text-danger">{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="title">Password <span class="text-danger">*</span></label>
                            <input type="text" wire:model="password" class="form-control" id="password"
                                placeholder="Enter Password" required />

                            @error('password')
                                <p class="text-danger">{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                            <input type="text" wire:model="password_confirmation" class="form-control" id="password_confirmation"
                                placeholder="Enter confirm password" required />

                            @error('password_confirmation')
                                <p class="text-danger">{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            @if ($user && !is_null($user->profile_image))
                                <div class="my-2">
                                    <img src="{{ Storage::url($user->profile_image) }}" class="img-fluid"
                                        width="250px" />
                                </div>
                            @endif
                            @if (!$isView)
                                <div class="form-group mb-2">
                                    <label for="profile_image">Profile Image <span class="text-danger"></span></label>
                                    <input type="file" wire:model="profile_image" class="form-control"
                                        id="profile_image" />

                                    {{-- Preview image --}}
                                    @if ($profile_image)
                                        <div class="my-2">
                                            <img src="{{ $profile_image->temporaryUrl() }}" class="img-fluid"
                                                width="200px" />
                                        </div>
                                    @endif

                                    @error('featuredImage')
                                        <p class="text-danger">{{ $message }} </p>
                                    @enderror
                                </div>
                            @endif

                        </div>
                    </div>


                    <div class="card-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">{{ $user ? 'Update' : 'Save' }} </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
