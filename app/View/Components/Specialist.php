<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Specialist extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $specialists = \App\Models\Specialist::join('information', 'information.user_id','=','specialists.id')->where('account_type', 2)->get();
        return view('components.specialist', ['specialists'=> $specialists]);
    }
    public function edit()
    {
        $specialists = \App\Models\Specialist::join('information', 'information.user_id','=','specialists.id')->where('account_type', 2)->get();
        return view('admins.edit-specialist',['specialists'=> $specialists]);
    }
    
    
    
}
