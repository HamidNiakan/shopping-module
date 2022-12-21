<?php

namespace Dev\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Dev\Category\Repository\CategoryRepo;
use Dev\Category\Responses\AjaxResponses;
use Dev\Course\Http\Requests\AddCourseRequest;
use Dev\Course\Http\Requests\CourseRequest;
use Dev\Course\Models\Course;
use Dev\Course\Repository\CourseRepository;
use Dev\Media\Services\MediaFileService;
use Dev\User\Respository\UserRepo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseController extends Controller {
	public function index ( CourseRepository $course_repository ) {
		$courses = $course_repository->getCourses();
		
		return view('Courses::index' , compact('courses'));
	}
	
	public function create ( UserRepo $userRepo , CategoryRepo $categoryRepo ) {
		$teachers = $userRepo->getTeachers();
		$categories = $categoryRepo->all();
		
		return view('Courses::create' , compact('teachers' , 'categories'));
	}
	
	public function store ( AddCourseRequest $request ) {
		
		try {
			$exception = DB::transaction(function () use ( $request ) {
				$banner_id = MediaFileService::upload($request->file('image'))->id;
				$data = [
					'title' => $request->get('title') ,
					'slug' => Str::slug($request->get('slug')) ,
					'priority' => $request->get('priority') ,
					'price' => $request->get('price') ,
					'teacher_percent' => $request->get('teacher_percent') ,
					'teacher_id' => $request->get('teacher_id') ,
					'type' => $request->get('type') ,
					'status' => $request->get('status') ,
					'confirmation_status' => Course::CONFIRMATION_STATUS_PENDING ,
					'category_id' => $request->get('category_id') ,
					'body' => $request->get('body') ,
					'banner_id' => $banner_id ,
				];
				resolve(CourseRepository::class)->store($data);
				
				return redirect()->route('courses.index');
			});
			
			return is_null($exception) ? true : $exception;
		}
		catch ( \Exception $e ) {
			return false;
		}
	}
	
	public function edit ( Course $course , UserRepo $userRepo , CategoryRepo $categoryRepo ) {
		$teachers = $userRepo->getTeachers();
		$categories = $categoryRepo->all();
		
		return view('Courses::edit' , compact('course' , 'teachers' , 'categories'));
	}
	
	public function update ( $id , CourseRequest $request ) {
		
		try {
			
			$exception = DB::transaction(function () use ( $request , $id ) {
				$data = [
					'title' => $request->get('title') ,
					'slug' => Str::slug($request->get('slug')) ,
					'priority' => $request->get('priority') ,
					'price' => $request->get('price') ,
					'teacher_percent' => $request->get('teacher_percent') ,
					'teacher_id' => $request->get('teacher_id') ,
					'type' => $request->get('type') ,
					'status' => $request->get('status') ,
					'category_id' => $request->get('category_id') ,
					'body' => $request->get('body') ,
				];
				$course = resolve(CourseRepository::class)->findById($id);
				if ( $request->hasFile('image') ) {
					$banner_id = MediaFileService::upload($request->file('image'))->id;
					$course->banner->delete();
					$data[ 'banner_id' ] = $banner_id;
				}
				else {
					$data[ 'banner_id' ] = $course->banner_id;
				}
				resolve(CourseRepository::class)->update($id , $data);
				
				return redirect()->route('courses.index');
			});
			
			return is_null($exception) ? true : $exception;
		}
		catch ( \Exception $e ) {
			return false;
		}
		catch ( ModelNotFoundException $exception ) {
			return false;
		}
	}
	
	public function destroy ( $id ) {
		try {
			$course = resolve(CourseRepository::class)->findById($id);
			if ( $course->banner ) {
				$course->banner->delete();
			}
			$course->delete();
			
			return AjaxResponses::printResult('ok');
		}
		catch ( \Exception $exception ) {
			return false;
		}
	}
	
	public function accept ($id) {
		
		try {
			resolve(CourseRepository::class)->updateConfirmationStatus($id , Course::CONFIRMATION_STATUS_ACCEPTED);
			
			return AjaxResponses::printResult('عملیات با موفقیت انجام شده');
		}
		catch ( ModelNotFoundException $exception ) {
			AjaxResponses::printError('خطایی رخ داده است',Response::HTTP_NOT_FOUND);
		}
	}
	
	public function reject ($id) {
		
		try {
			resolve(CourseRepository::class)->updateConfirmationStatus($id , Course::CONFIRMATION_STATUS_REJECTED);
			
			return AjaxResponses::printResult('عملیات با موفقیت انجام شده');
		}
		catch ( ModelNotFoundException $exception ) {
			AjaxResponses::printError('خطایی رخ داده است',Response::HTTP_NOT_FOUND);
		}
	}
	
	public function lock ($id) {
		
		try {
			resolve(CourseRepository::class)->updateStatus($id , Course::STATUS_LOCK);
			
			return AjaxResponses::printResult('عملیات با موفقیت انجام شده');
		}
		catch ( ModelNotFoundException $exception ) {
			AjaxResponses::printError('خطایی رخ داده است',Response::HTTP_NOT_FOUND);
		}
	}
}