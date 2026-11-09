<?php

namespace Tests\Feature;

use App\Filament\Pages\Auth\EditProfile;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PasswordManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        foreach (['super_admin', 'admin', 'pptk', 'verifikator'] as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        foreach (['ViewAny:User', 'View:User', 'Update:User'] as $permName) {
            Permission::firstOrCreate(['name' => $permName, 'guard_name' => 'web']);
        }

        Role::findByName('super_admin', 'web')->syncPermissions(Permission::all());
    }

    public function test_authenticated_user_can_change_own_password_via_profile_page(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('oldpassword123'),
            'status_aktif' => true,
        ]);
        $user->assignRole('pptk');

        $this->actingAs($user);

        Livewire::test(EditProfile::class)
            ->fillForm([
                'name' => $user->name,
                'email' => $user->email,
                'password' => 'newpassword123',
                'passwordConfirmation' => 'newpassword123',
                'currentPassword' => 'oldpassword123',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertTrue(Hash::check('newpassword123', $user->fresh()->password));
    }

    public function test_super_admin_can_reset_user_password_from_users_table(): void
    {
        $superAdmin = User::factory()->create([
            'status_aktif' => true,
        ]);
        $superAdmin->assignRole('super_admin');

        $targetUser = User::factory()->create([
            'password' => Hash::make('oldpassword123'),
            'status_aktif' => true,
        ]);
        $targetUser->assignRole('verifikator');

        $this->actingAs($superAdmin);

        Livewire::test(ListUsers::class)
            ->callTableAction('reset_password', $targetUser, data: [
                'new_password' => 'resetpass888',
                'new_password_confirmation' => 'resetpass888',
            ])
            ->assertHasNoTableActionErrors();

        $this->assertTrue(Hash::check('resetpass888', $targetUser->fresh()->password));
        $this->assertEquals(1, $targetUser->notifications()->count());
    }
}

