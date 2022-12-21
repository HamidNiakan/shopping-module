<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component {
	public string $type;
	public string $name;
	public string $placeholder;
	
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct ( string $name , string $placeholder , string $type ) {
		$this->name = $name;
		$this->placeholder = $placeholder;
		$this->type = $type;
	}
	
	/**
	 * Get the view / contents that represent the
	 * component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render () {
		return view('components.input');
	}
}
