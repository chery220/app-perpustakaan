<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\StoreMemberRequest;

class StoreMemberRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'nama'          => 'required|string|max:255',
        'nim'           => 'required|string',
        'email'         => 'required|email',
        'nomor_telepon' => 'required|string',
        'alamat'        => 'required|string',
        'status'        => 'required|in:aktif,non-aktif',
        ];
    }
}
