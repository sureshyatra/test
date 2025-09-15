<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreLocationContentRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'location_type' => 'required|in:country,state,city',
            'location_id'   => 'required|integer',
            'title'         => 'nullable|string|max:255',
            'content'       => 'nullable|string',
            'data'          => 'nullable|array',
            'meta_title'    => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'published_at'  => 'nullable|date',
        ];
    }
    protected function prepareForValidation(): void {
        if ($this->has('data') && is_string($this->data)) {
            $decoded = json_decode($this->data, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $this->merge(['data'=>$decoded]);
            }
        }
    }
}
