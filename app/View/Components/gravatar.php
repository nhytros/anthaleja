<?php

namespace App\View\Components;

use Illuminate\View\Component;

class gravatar extends Component
{
    public $email, $set, $type;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($email, $set = 'robohash', $size)
    {
        $this->email = $email;
        $this->set = $set;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $hash = md5(strtolower($this->email));
        $url = "https://www.gravatar.com/avatar/{$hash}?r=g&d={$this->set}&s={$this->size}";
        return '<img src="' . $url . '" />';

        // return view('components.gravatar');
    }
}
