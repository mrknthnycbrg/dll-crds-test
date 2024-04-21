<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_current_profile_information_is_available(): void
    {
        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test(UpdateProfileInformationForm::class);

        $this->assertEquals($user->first_name, $component->state['first_name']);
        $this->assertEquals($user->middle_name, $component->state['middle_name']);
        $this->assertEquals($user->last_name, $component->state['last_name']);
        $this->assertEquals($user->email, $component->state['email']);
    }

    public function test_profile_information_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(UpdateProfileInformationForm::class)
            ->set('state', ['first_name' => 'Test First', 'middle_name' => 'Test Middle', 'last_name' => 'Test Last', 'email' => 'test@example.com'])
            ->call('updateProfileInformation');

        $this->assertEquals('Test First', $user->fresh()->first_name);
        $this->assertEquals('Test Middle', $user->fresh()->middle_name);
        $this->assertEquals('Test Last', $user->fresh()->last_name);
        $this->assertEquals('test@example.com', $user->fresh()->email);
    }
}
