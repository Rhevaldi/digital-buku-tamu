<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuestBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'no_identitas' => 'required|numeric|max_digits:32',
            'no_wa' => 'required|string|numeric|max_digits:16',
            'instansi' => 'required|string|max:255',
            'alamat' => 'required|string|max:20',
            'purpose_id' => 'required|exists:purposes,id',
            'bidang_id' => 'required|exists:bidangs,id',
            'description' => 'nullable|string',
        ];
    }
}
