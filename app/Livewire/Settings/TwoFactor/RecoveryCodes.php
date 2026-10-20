<?php

namespace App\Livewire\Settings\TwoFactor;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;
use Livewire\Attributes\Locked;
use Livewire\Component;

class RecoveryCodes extends Component
{
    /** @var list<string> */
    #[Locked]
    public array $recoveryCodes = [];

    /**
     * Mount the component
     * Inisialisasi komponen dan memuat kode pemulihan untuk pengguna yang sedang diautentikasi.
     */
    public function mount(): void
    {
        $this->loadRecoveryCodes();
    }

    /**
     * Generate new recovery codes for the user.
     * Membuat ulang recoveri codes untuk pengguna yang sedang diautentikasi dan memuat kode pemulihan yang baru.
     */
    public function regenerateRecoveryCodes(GenerateNewRecoveryCodes $generateNewRecoveryCodes): void
    {
        $user = Auth::guard()->user();

        if ($user) {
            $generateNewRecoveryCodes($user);
            $this->loadRecoveryCodes();
        }
    }

    /**
     * Load the recovery codes for the user.
     * Memuat kode pemulihan untuk pengguna yang sedang diautentikasi. Jika pengguna memiliki autentikasi dua faktor yang diaktifkan dan kode pemulihan tersedia, kode pemulihan akan didekripsi dan disimpan dalam properti recoveryCodes. Jika terjadi kesalahan saat memuat kode pemulihan, pesan kesalahan akan ditambahkan ke komponen.
     */
    private function loadRecoveryCodes(): void
    {
        /** @var User|null $user */
        $user = Auth::guard()->user();

        if ($user && $user->hasEnabledTwoFactorAuthentication() && $user->two_factor_recovery_codes) {
            try {
                $decoded = json_decode(decrypt($user->two_factor_recovery_codes), true);
                $this->recoveryCodes = is_array($decoded) ? $decoded : [];
            } catch (Exception) {
                $this->addError('recoveryCodes', 'Failed to load recovery codes');

                $this->recoveryCodes = [];
            }
        }
    }
}
