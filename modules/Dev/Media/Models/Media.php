<?php

namespace Dev\Media\Models;

use Dev\Media\Services\MediaFileService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
	
	protected $guarded = [];
	
	public function getThumbAttribute() {
		return $this->files[300];
	}
	
	protected $casts = [
		'files' => 'json'
	];
	
	public static array $types = [
		'image',
		'video',
		'audio',
		'zip',
		'doc'
	];
	
	protected static function booted () {
		static::deleted(function ($media) {
			MediaFileService::delete($media);
		});
	}
}
