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
        $isEdit = $this->route('id') || $this->isMethod('put') || $this->isMethod('patch');
        return [   
                'map_id' => 'required|numeric',
                'team' => 'required|in:Terrorist,Counter-Terrorist',
                'type' => 'required|in:Smoke,Flash,He Grenade,Molotov',
                'visibility' => 'required|',
                'area_from_id' => 'required|numeric',
                'callout_from_id' => 'nullable|numeric',
                'area_to_id' => 'required|numeric',
                'callout_from_id' => 'nullable|numeric',
                'description' => 'nullable|max:500',
                'source_type' => 'required|in:youtube_path,images',
                'images' => $isEdit ? 'sometimes|array' :'required_if:source_type,images|array|min:1',
                'images.*' => 'required_if:source_type,images|image|mimes:jpg,png|max:4096',
                'youtube_path' => [
                    'nullable',
                    'required_if:source_type,youtube_path',
                    'regex:/^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$/',
                ],
        ];
    
    }
}
