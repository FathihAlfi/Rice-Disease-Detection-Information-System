<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage; // <-- Import Storage

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Mengambil semua data yang sudah lolos validasi dari ProfileUpdateRequest
        $validatedData = $request->validated();

        // Mengisi data teks (nama dan email)
        $user->fill($validatedData);

        // Jika email diubah, reset status verifikasinya
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // --- PERBAIKAN UTAMA: Logika Upload yang Lebih Andal ---

        // Menangani upload Tanda Tangan
        if ($request->hasFile('tanda_tangan')) {
            // Hapus file lama jika ada
            if ($user->tanda_tangan) {
                Storage::disk('public')->delete($user->tanda_tangan);
            }
            // Simpan file baru dan update path di database
            $user->tanda_tangan = $request->file('tanda_tangan')->store('signatures', 'public');
        }

        // Menangani upload Stempel
        if ($request->hasFile('stempel')) {
            // Hapus file lama jika ada
            if ($user->stempel) {
                Storage::disk('public')->delete($user->stempel);
            }
            // Simpan file baru dan update path di database
            $user->stempel = $request->file('stempel')->store('stamps', 'public');
        }

        // Menyimpan semua perubahan (termasuk file) ke database
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


}
