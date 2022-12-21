<?php

namespace Dev\Course\Models;

use Dev\Category\Models\Category;
use Dev\Media\Models\Media;
use Dev\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model {
	use HasFactory;
	
	protected           $guarded  = [];
	public static array $types    = [
		'free' ,
		'cash' ,
	];
	public static array $statuses = [
		'completed' ,
		'not-completed' ,
		'lock' ,
	];
	public const STATUS_LOCK = 'lock';
	public const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
	public const CONFIRMATION_STATUS_REJECTED = 'rejected';
	public const CONFIRMATION_STATUS_PENDING  = 'pending';
	public static array $confirmationStatuses = [
		self::CONFIRMATION_STATUS_ACCEPTED ,
		self::CONFIRMATION_STATUS_REJECTED ,
		self::CONFIRMATION_STATUS_PENDING,
	];
	
	public function teacher (): \Illuminate\Database\Eloquent\Relations\BelongsTo {
		return $this->belongsTo(User::class , 'teacher_id');
	}
	
	public function category (): \Illuminate\Database\Eloquent\Relations\BelongsTo {
		return $this->belongsTo(Category::class);
	}
	
	public function banner () {
		return $this->belongsTo(Media::class , 'banner_id');
	}
}
