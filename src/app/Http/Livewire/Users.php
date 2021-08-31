<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Users extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected $queryString = [
        'search' => ['except' => ''], 
        'perPage'  => ['except' => 5], 
    ];

    public $user, $name, $email, $user_id, $role_id, $roles;
    
    public $search = '';
    public $perPage = 5;
    public $isOpen = false;
    public $confirmingUserDeletion = false;

    public function mount()
    {        
        $this->roles = Role::pluck('name', 'id')->toArray();
    }
  
    public function render()
    {
        $users = User::where('name', 'LIKE', "%{$this->search}%")
            ->orWhere('email', 'LIKE', "%{$this->search}%")
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);

        return view('livewire.users', [
            'users' => $users
        ]);
    }

    public function confirmUserAdd()
    {
        $this->resetInputFields();
        //$this->reset(['user']);
        $this->resetErrorBag();
        $this->resetValidation();
        $this->authorize('create', User::class);       
        $this->openModal();
    }

    public function confirmUserEdit($id)
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role_id = $user->role_id;

        $this->authorize('update', $user);
        $this->openModal();
    }

    public function confirmUserDeletion(User $user)
    {
        $this->authorize('delete', $user);

        $this->confirmingUserDeletion = $user->id;
    }
     
    public function store()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required'
        ];

        $rules['email'] = empty($this->user_id) ? 'required|email|unique:users,email' : 'required|email|unique:users,email,'.$this->user_id;

        $this->validate($rules);

        $this->password = empty($this->password) ? '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' : $this->password;
   
        User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role_id' => $this->role_id,
        ]);
  
        session()->flash('message', 
            $this->user_id ? 'User Updated Successfully.' : 'User Created Successfully.');
  
        $this->resetInputFields();
        //$this->reset(['user']);        
        $this->closeModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role_id = $user->role_id;
    
        $this->openModal();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     */     
    public function delete($id)
    {
        User::find($id)->delete();
        $this->confirmingUserDeletion = false;
        session()->flash('message', 'User Deleted Successfully.');
    }

    public function resetModel()
    {
        $this->reset(['user']);
        $this->closeModal();
    }

    private function resetInputFields(){
        $this->name = '';
        $this->email = '';
    }

    public function clear()
    {
        $this->search = '';
        $this->page = 1;
        $this->perPage = 5;
    }
}
