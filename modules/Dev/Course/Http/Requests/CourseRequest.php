<?php

namespace Dev\Course\Http\Requests;

use Dev\Course\Models\Course;
use Dev\Course\Rules\ValidTeacher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() == true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
		$rules = [
			'title' => 'required|min:3|max:190',
			'slug' => 'required|min:3|max:190|unique:courses,slug',
			'priority' => 'nullable|numeric',
			'price' => 'required|numeric|min:0|max:1000000',
			'teacher_percent' => 'required|numeric|min:0|max:100',
			'teacher_id' => ['required','exists:users,id', new ValidTeacher()],
			'type' => ['required',Rule::in(Course::$types)],
			'status' => ['required',Rule::in(Course::$statuses)],
			'category_id' => ['required','exists:categories,id'],
			'image' => 'required|mimes:jpg,jpeg,png',
			'body' => 'nullable'
		];
		
		if (request()->method === 'PATCH') {
			$rules['image'] = 'nullable|mimes:jpg,jpeg,png';
			$rules['slug'] = 'required|min:3|max:190|unique:courses,slug,'.$this->id;
			$rules['title'] = 'required|min:3|max:190|unique:courses,slug,'.$this->id;
		}
  
		return $rules;
    }
	
	public function messages () {
		return [
			'title.required' => 'عنوان دروه را وارد کنید',
			'title.min' => 'عنوان دوره نباید کمتر از ۳ کارکتر باشد',
			'title.max' => 'عنوان دوره نباید بیشتر از ۱۹۰ کارکتر باشد',
			'slug.required' => 'نام انگلیسی دوره را وارد کنید',
			'slug.min' => 'نام انگلیسی دوره نباید کمتر از ۳ کارکتر باشد',
			'slug.max' => 'نام انگلیسی دوره نباید بیشتر از ۱۹۰ کارکتر باشد',
			'slug.unique' => 'این نام قبلا در سیستم ثبت شده است',
			'priority.numeric' => 'ردیف دوره باید عدد باشد',
			'price.required' => 'قیمت دوره را وارد کنید',
			'price.min' => 'قیمت دوره نباید کمتر از صفر باشد',
			'price.numeric' => 'قیمت دوره باید عدد باشد',
			'teacher_percent.required' => 'درصد مدرس را وارد کنید',
			'teacher_percent.numeric' => 'درصد مدرس باید عدد باشد',
			'type.required' => 'نوع دروه را انتخاب کنید',
			'status.required' => 'وضعیت دروه را انتخاب کنید',
			'category_id.required' => 'دسته بندی را انتخاب کنید',
			'image.required' => 'بنر دوره را اپلود کنید',
			'image.mimes' => 'بنر دوره باید jpg,jpeg,png باشد',
			'teacher_id.required' => 'مدرس دوره را انتخاب کنید',
		];
	}
}
