<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\UserRepository;

class Dashboard extends Component
{
    private $user;

    public function __construct(
        UserRepository $user
    )
    {
        $this->user = $user;
    }

    public function render()
    {

        $warehouses = $this->user->getWarehouses();

        return view('livewire.dashboard', [
            'warehouses' => $warehouses
        ]);
    }
}
