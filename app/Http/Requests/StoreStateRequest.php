<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreStateRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'country_id' => 'required|integer|exists:countries,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|alpha_dash|max:255',
        ];
    }
}
