<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tenant Portal Routes
|--------------------------------------------------------------------------
| Konteks operator tenant. Binding tenant dan isolasi akses ditambahkan bersama model tenant.
| Route fitur modul dimuat melalui PortalRoutes::tenant() agar middleware role tetap konsisten.
*/

Route::get('/dashboard', function (string $tenantSlug) {
    return view('tenant.dashboard', ['tenantSlug' => $tenantSlug]);
})->name('dashboard');
