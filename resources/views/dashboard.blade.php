<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="text-xl font-semibold">Selamat datang, {{ $user->name }}</h1>

        @if ($user->isAdmin())
            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                Anda masuk sebagai pengelola kantin.
                <a class="font-medium text-blue-600 underline dark:text-blue-400" href="{{ route('admin.dashboard') }}">
                    Buka dashboard admin
                </a>
            </p>
        @elseif ($user->isTenantOperator())
            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                Akun operator Anda aktif. Buka portal tenant melalui slug tenant yang ditetapkan kepada Anda.
            </p>
        @else
            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                Akun Anda sudah aktif. Fitur pelanggan akan tersedia pada modul katalog dan pemesanan.
            </p>
        @endif
    </div>
</x-layouts::app>