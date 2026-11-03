<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortalLayoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_portal_renders_the_public_layout(): void
    {
        $this->get(route('customer.home', ['canteen' => 'demo']))
            ->assertOk()
            ->assertSee('lang="id"', false)
            ->assertSee('Kantin: demo')
            ->assertSee('Katalog belum tersedia');
    }

    public function test_tenant_portal_renders_the_tenant_layout(): void
    {
        $tenantOperator = User::factory()->create([
            'role' => 'tenant',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        $this->actingAs($tenantOperator)
            ->get(route('tenant.dashboard', ['tenant' => 'demo']))
            ->assertOk()
            ->assertSee('Dashboard Tenant')
            ->assertSee('demo')
            ->assertSee('Katalog (Modul 7)');
    }

    public function test_admin_portal_renders_the_admin_layout(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Pengelola Kantin')
            ->assertSee('Dashboard Pengelola');
    }
}
