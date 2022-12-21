<?php

namespace Dev\Media\Services;

use Dev\Media\Models\Media;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageFileService {
	protected static $sizes = [
		'300' ,
		'600' ,
	];
	
	public static function upload ( $file ) {
		$file_name = uniqid();
		$extension = $file->getClientOriginalExtension();
		$dir = 'app/public/';
		$file->move(storage_path($dir) , $file_name . '_original.' . $extension);
		$path = $dir . '/' . $file_name . '_original.' . $extension;
		return self::resize(storage_path($path) , $dir , $file_name , $extension);
	}
	
	private static function resize ( $img , $dir , $file_name , $extension ) {
		$img = Image::make($img);
		$images_path [ 'original' ] = $file_name . '_original.'. $extension;
		foreach ( self::$sizes as $size ) {
			$images_path[ $size ] = $file_name . '_' . $size . '.' . $extension;
			$img->resize($size , null , function ( $aspect ) {
				$aspect->aspectRatio();
			})
				->save(storage_path($dir) . $file_name . '_' . $size . '.' . $extension);
		}
		
		return $images_path;
	}
	
	public static function delete(Media $media) {
		foreach ($media->files as $file) {
			Storage::disk('public')->delete($file);
		}
	}
}