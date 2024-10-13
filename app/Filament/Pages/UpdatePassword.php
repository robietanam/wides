<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\ButtonAction;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as RulesPassword;

class UpdatePassword extends Page
{
    use InteractsWithForms;
    
    public ?array $data = [];
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationGroup = 'Akun';
    protected static string $view = 'filament.pages.update-password';
    public function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('new_password')
                ->label('Password Baru')
                ->password()
                ->required()
                ->rule(RulesPassword::min(8))
                ->autocomplete('new-password'),
            TextInput::make('confirm_password')
                ->label('Konfirmasi Password')
                ->password()
                ->required()
                ->same('new_password')
                ->autocomplete('new-password'),
        ])
        ->statePath('data');
    } 
    public function submit()
    {
        $this->form->validate();
        $_data = $this->form->getState();
        $userId = Auth::id();

        DB::table('users')->where('id', $userId)->update([
            'password' => Hash::make($_data['new_password']),
        ]);
        
        Notification::make()
            ->title('Password berhasil dirubah')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('submit')
                ->label('Update Password')
                ->action('submit')
                ->button()
                ->color('primary'),
        ];
    }
}
