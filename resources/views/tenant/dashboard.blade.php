<x-layouts.tenant title="Dashboard">
    <div class="flex items-center gap-3">
        <h1 class="text-xl font-semibold">Dashboard Tenant</h1>
    </div>
    <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
        Tenant: <span class="font-mono">{{ $tenantSlug }}</span>
    </p>
    <div class="mt-6">
        <x-empty-state title="Belum ada aktivitas"
            description="Data tenant dan keanggotaan operator akan ditambahkan setelah model dan isolasi tenant tersedia." />
    </div>
</x-layouts.tenant>
