<?php

namespace Dev\Course\Repository;

use Dev\Course\Models\Course;

class CourseRepository {
	public function getCourses () {
		return Course::query()
					 ->latest()
					 ->get();
	}
	
	public function store ( array $data ) {
		
		$record = new Course();
		$record->fill($data);
		$record->save();
		
		return $record;
	}
	
	public function findById ( $id ) {
		return Course::query()
					 ->findOrFail($id);
	}
	
	public function update ( $id , array $data ) {
		$course = $this->findById($id);
		$course->fill($data);
		$course->save();
		
		return $course;
	}
	
	public function updateConfirmationStatus($id,$status) {
		$course = $this->findById($id);
		$course->confirmation_status = $status;
		$course->save();
		
		return $course;
	}
	
	public function updateStatus($id,$status) {
		$course = $this->findById($id);
		$course->status = $status;
		$course->save();
		
		return $course;
	}
}

