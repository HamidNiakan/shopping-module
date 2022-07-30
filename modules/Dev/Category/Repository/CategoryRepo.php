<?php

namespace Dev\Category\Repository;

use Dev\Category\Models\Category;

class CategoryRepo {
	public function all () {
		return Category::all();
	}
	
	public function store ( $values ) {
		return Category::create([
									'name' => $values->name ,
									'slug' => $values->slug ,
									'parent_id' => $values->parent_id ,
								]);
	}
	
	public function findExceptById ( int $category_id ) {
		return $this->all()
					->filter(function ( $item ) use ( $category_id ) {
						return $item->id != $category_id;
					});
	}
	
	public function findById ( int $category_id ) {
		return Category::query()
					   ->find($category_id);
	}
	
	public function update ( int $category_id , $values ) {
		$category = $this->findById($category_id);
		
		return $category->update([
									 'name' => $values->name ,
									 'slug' => $values->slug ,
									 'parent_id' => $values->parent_id ,
								 ]);
	}
	
	public function delete ( int $category_id ) {
		return $this->findById($category_id)
					->delete();
	}
}