<?php

namespace Dev\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Dev\Category\Http\Requests\CategoryRequest;
use Dev\Category\Http\Requests\CategroyRequestUpdate;
use Dev\Category\Repository\CategoryRepo;
use Dev\Category\Responses\AjaxResponses;

class CategoryController extends Controller {
	public $repo;
	
	public function __construct ( CategoryRepo $category_repo ) {
		$this->repo = $category_repo;
	}
	
	/**
	 * Display Index Category View
	 *
	 * @return \Illuminate\Support\Facades\View
	 */
	public function index () {
		$categories = $this->repo->all();
		
		return view('Category::index' , compact('categories'));
	}
	
	public function store ( CategoryRequest $request ) {
		$this->repo->store($request);
		
		return back()->with('success' , __('messages.alert.success'));
	}
	
	public function edit ( int $id ) {
		$categories = $this->repo->findExceptById($id);
		$category = $this->repo->findById($id);
		
		return view('Category::edit' , compact('category' , 'categories'));
	}
	
	public function update ( CategroyRequestUpdate $request , int $id ) {
		$this->repo->update($id , $request);
		
		return redirect()
			->route('category.index')
			->with('success' , __('messages.alert.update'));
	}
	
	public function destroy ( int $id ) {
		
		$this->repo->delete($id);
		
		return AjaxResponses::printResult(__('messages.alert.delete'));
	}
}
