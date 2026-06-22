<?php
namespace Tests\Feature;
use App\Filament\Pages\ManageGeneral;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SettingsSaveTest extends TestCase {
  use RefreshDatabase;
  public function test_general_settings_save(): void {
    $this->actingAs(User::factory()->create());
    Livewire::test(ManageGeneral::class)
      ->set('data.phone', '444 96 16')
      ->set('data.brandTr', 'AWA')
      ->set('data.email', 'info@awamobilya.com')
      ->call('save')
      ->assertHasNoErrors();
    $this->assertSame('444 96 16', Setting::where('key','phone')->value('value'));
    $this->assertSame('general', Setting::where('key','phone')->value('group'));
    $this->assertSame('AWA', Setting::where('key','brandTr')->value('value'));
  }
}
