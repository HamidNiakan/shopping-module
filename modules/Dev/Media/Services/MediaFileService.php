<?php

namespace Dev\Media\Services;

use Dev\Media\Models\Media;
use Illuminate\Validation\Rules\ImageFile;

class MediaFileService {
	public static function upload ( $file ) {
		
		$extension = $file->getClientOriginalExtension();
		switch ( $extension ) {
			case  'jpg':
			case 'png':
			case "jpeg" :
				$media = Media::query()
							  ->create([
										   'files' => ImageFileService::upload($file) ,
										   'type' => 'image' ,
										   'user_id' => auth()->user()->id ,
										   'file_name' => $file->getClientOriginalName() ,
									   ]);
				
				return $media;
				break;
			case 'avi':
			case 'mp4':
				VideoFileService::upload($file);
				break;
		}
	}
	
	public static function delete ( Media $media ) {
		
		switch ( $media->type ) {
			case 'image' :
				ImageFileService::delete($media);
				break;
		}
	}
}