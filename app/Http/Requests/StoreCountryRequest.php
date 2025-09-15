<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreCountryRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        $id = $this->route('country') ? $this->route('country')->id : null;
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|alpha_dash|max:255|unique:countries,slug' . ($id ? ',' . $id : ''),
            'iso2' => 'nullable|string|size:2'
        ];
    }
}
