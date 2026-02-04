<?php

namespace App\View\Components\Users;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormUsers extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $email, $name, $password;
    public function __construct($id = null)
    {
        if ($id) {
            $user = User::find($id);
            $this->id = $user->id;
            $this->email = $user->email;
            $this->name = $user->name;
            // $this->password = $user->password;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.users.form-users');
    }
}
