<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreLocationPageRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'location_type' => 'required|in:country,state,city',
            'location_id'   => 'required|integer',
            'page_key'      => 'required|in:overview',
            'title'         => 'nullable|string|max:255',
            'content'       => 'nullable|string',
            'meta_title'    => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
        ];
    }
}
