<?php

namespace App\Filament\Pages;

use App\Models\SiteInfo;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Forms\Form;

class SiteInfoPage extends Page implements HasForms
{
    
    use InteractsWithForms;
    public SiteInfo $siteInfo;
    
    protected static ?string $navigationGroup = 'Website';
    public ?array $data = [];
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static string $view = 'filament.pages.site-info-page';
    protected static ?string $navigationLabel = 'Informasi Website';

    public function mount(): void
    {
        $this->siteInfo = SiteInfo::firstOrCreate([]);
        $this->form->fill($this->siteInfo->attributesToArray()); 
    }

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('profile_title')->label('Judul Profile')->required(),
            Textarea::make('profile_desc')->label('Deskripsi Profile')->required(),
            TextInput::make('address')->label('Alamat')->required(),
            TextInput::make('phone_number')->label('Nomor Telepon')->required(),
            TextInput::make('contact_person')->label('Whatsapp')->required(),
            TextInput::make('contact_person_transaction')->label('Whatsapp u/Transaksi')->required(),
            TextInput::make('email')->label('Email')->required()->email(),
            TextInput::make('facebook')->label('Facebook')->required(),
            TextInput::make('instagram')->label('Instagram')->required(),
            FileUpload::make('landing_image')
            ->label('Gambar Landing Page')
            ->filled()
            ->disk('public')
            ->image(), 
            TextInput::make('video_profile')
                ->label('Video Profile (YouTube URL)')
                ->url(),
            Repeater::make('gallery')
            ->label('Galeri')
            ->schema([
                FileUpload::make('')
                    ->image()
                    ->directory('background')
                    ->preserveFilenames()
                    ->label('Gallery')
                    ->disk('public')
                    ->required(),
            ]),
        ])
        ->statePath('data');
    } 
    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $this->validate();
        
        $data = $this->form->getState();
        SiteInfo::first()->update($data);
        Notification::make()
            ->title('Site Info updated successfully!')
            ->success()
            ->send();
    }

    public function getFormModel(): SiteInfo
    {
        return $this->siteInfo;
    }
}
