<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            
            // --- PERBAIKAN UTAMA DI SINI ---
            // Secara eksplisit memberitahu 'unique' untuk mengabaikan user saat ini
            // berdasarkan kolom primary key 'user_id'.
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                Rule::unique(User::class)->ignore($this->user()->user_id, 'user_id')
            ],
            
            // Aturan validasi untuk file tetap ada
            'tanda_tangan' => ['nullable', 'image', 'mimes:png', 'max:1024'],
            'stempel' => ['nullable', 'image', 'mimes:png', 'max:1024'],
        ];
    }
}
