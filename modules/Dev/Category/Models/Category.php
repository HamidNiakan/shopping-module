<?php

namespace Dev\Category\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	use HasFactory;
	
	protected $guarded = [];
	
	public function parentCategory () {
		return $this->belongsTo(Category::class , 'parent_id' , 'id');
	}
	
	public function children () {
		return $this->hasMany(Category::class , 'parent_id');
	}
	
	public function getParentAttribute () {
		return ( is_null($this->parent_id) ) ? 'ندارد' : $this->parentCategory->name;
	}
}
