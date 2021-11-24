<?php namespace App\Http\Validators;

use Validator;

class PetValidator{

	public function validate_create($request)
	{	

        $rules = [
            'name' => 'required|min:2|max:128|unique:pets',
            'nickname' => 'nullable|min:2|max:64',
            'weight'	=> 'required|numeric|between:0,99.99',
            'height'	=> 'required|numeric|between:0,5.99',
            'gender'	=> 'required|in:male,female',
            'color'	=> 'nullable|min:2|max:64',
            'friendliness'	=> 'nullable|in:friendly,not-friendly',
            'birthday'	=> 'required|date|date_format:Y-m-d',
        ];

        $allowed_fields = [
			'name',
			'nickname',
			'weight',
			'height',
            'gender',
            'color',
            'friendliness',
            'birthday',
        ];

		$validation = Validator::make($request -> only($allowed_fields), $rules);

		return $validation;
	}

	public function validate_update($request)
	{	

        $rules = [
            'id'	=> 'required|numeric|exists:pets',
            'name' => 'required|min:2|max:128|unique:pets,name,' . $request -> input('id'),
            'nickname' => 'nullable|min:2|max:64',
            'weight'	=> 'required|numeric|between:0,99.99',
            'height'	=> 'required|numeric|between:0,5.99',
            'gender'	=> 'required|in:male,female',
            'color'	=> 'nullable|min:2|max:64',
            'friendliness'	=> 'nullable|in:friendly,not-friendly',
            'birthday'	=> 'required|date|date_format:Y-m-d',
        ];

        $allowed_fields = [
            'id',
			'name',
			'nickname',
			'weight',
			'height',
            'gender',
            'color',
            'friendliness',
            'birthday',
        ];

		$validation = Validator::make($request -> only($allowed_fields), $rules);

		return $validation;
	}


}