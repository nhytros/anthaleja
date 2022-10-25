<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CharacterStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'user_id' => 'required',
            'first_name' => 'required|max:48',
            'last_name' => 'required|max:48',
            'username' => 'required|unique:characters,username',
            'gender' => 'required',
            'height' => 'required|numeric|min:150|max:210',
            'date_start' => Carbon::now()->subYears(60),
            'date_end' => Carbon::now()->subYears(18),
            'date_of_birth' => 'required|date',
            // TODO: Fix after and before
            // 'date_of_birth' => 'required|date|after_or_equal:date_start|before_or_equal:date_end',
            // TODO: After fixed upload, make it required
            // 'avatar' => 'file|mimes:jpeg,jpeg,png,webp',
        ];
    }
}
