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
        $rules = [   
                'map_id' => 'required|numeric',
                'team' => 'required|',
                'type' => 'required|',
                'visibility' => 'required|',
                'area_from_id' => 'required|numeric',
                'callout_from_id' => 'nullable|numeric',
                'area_to_id' => 'required|numeric',
                'callout_from_id' => 'nullable|numeric',
                'describtion' => 'nullable|max:500',
                'source_type' => 'required|',
        ];

        if($this->input('source_type') === 'images'){
            $rules['images'] = 'required|array|min:1';
            $rules['images.*'] = 'required|image|mimes:jpg,png|max:4096';
        }
        if($this->input('source_type') === 'youtube'){
            $rules['youtube_path'] = 'required|url';
        }
        if($this->input('source_type') === 'twitch'){
            $rules['twitch_path'] = 'required|';
        }

        return $rules;
    }
}
