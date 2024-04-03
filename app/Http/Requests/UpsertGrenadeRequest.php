<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertGrenadeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [   
                'map_id' => 'required',
                'team' => 'required|',
                'type' => 'required|',
                'area_from_id' => 'required|',
                'callout_from_id' => 'nullable|',
                'area_to_id' => 'required|',
                'callout_from_id' => 'nullable|',
                'describtion' => 'nullable|',
                'images' => 'required|array|min:1',
                'images.*' => 'required|image|mimes:jpg,png|max:4096'
        ];
    }
}
