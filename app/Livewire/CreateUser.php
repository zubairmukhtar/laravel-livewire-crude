<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CreateUser extends Component
{
    use WithFileUploads;

    public $isView = false;
    public $user = null;

    public $name, $email, $password, $password_confirmation, $profile_image, $created_at, $userId;


    public function store()
    {

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => 'nullable|min:6|confirmed',
            'password_confirmation' => 'nullable|min:6',
            'profile_image' => 'nullable|image|mimes:png|max:1024',
        ]);

        if ($this->profile_image) {

            if ($this->userId && $this->user->profile_image && Storage::exists($this->user->profile_image)) {

                Storage::delete($this->user->profile_image);
            }

            $imagepath = $this->profile_image->store('', 'public');

        } else {
            $imagepath = $this->userId ? $this->user->profile_image : null;
        }

        if ($this->userId) {

            $user = User::findorFail($this->userId);

            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password ? Hash::make($this->password) : $user->password,
                'profile_image' => $imagepath,
            ]);
            $this->reset();

            session()->flash('message', 'User Updated successfully!');

            return $this->redirect('/', navigate: true);
        } else {

            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'profile_image' => $imagepath,
            ]);

            $this->reset();

            session()->flash('message', 'User created successfully!');

            return $this->redirect('/', navigate: true);
        }
    }

    public function mount(User $user)
    {

        if ($user->id) {
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->created_at = $user->created_at;
        }
    }

    public function render()
    {

        return view('livewire.create-user');
    }
}
