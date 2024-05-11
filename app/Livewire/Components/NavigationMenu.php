<?php

namespace App\Livewire\Components;

use App\Models\Category;
use App\Models\Department;
use Livewire\Component;

class NavigationMenu extends Component
{
    public function render()
    {
        $categories = Category::all();

        $departments = Department::all();

        return view('livewire.components.navigation-menu', compact('categories', 'departments'));
    }
}
