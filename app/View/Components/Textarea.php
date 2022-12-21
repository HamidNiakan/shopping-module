<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Textarea extends Component {
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public string $name;
	public string $placeHolder;
	public string $value;
	
	public function __construct ( string $name , string $placeHolder, string $value ) {
		$this->name = $name;
		$this->placeHolder = $placeHolder;
		$this->value = $value;
	}
	
	/**
	 * Get the view / contents that represent the
	 * component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render () {
		return view('components.textarea');
	}
}
