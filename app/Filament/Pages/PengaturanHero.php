<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class PengaturanHero extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static string $view = 'filament.pages.pengaturan-hero';

    protected static ?string $navigationLabel = 'Tampilan Utama';
    protected static ?string $title = 'Pengaturan Tampilan Utama';
    protected static ?int $navigationSort = 0; // Urutan di sidebar

    public ?array $data = [];

    public function mount(): void
    {
        // Ambil data teks dan isi ke form
        $heroTitle = Setting::firstOrCreate(['key' => 'hero_title'], ['value' => 'BP4D Halmahera Timur'])->value;
        $heroSubtitle = Setting::firstOrCreate(['key' => 'hero_subtitle'], ['value' => 'Mewujudkan Perencanaan Pembangunan...'])->value;

        $this->form->fill([
            'hero_title' => $heroTitle,
            'hero_subtitle' => $heroSubtitle,
        ]);
    }

    public function form(Form $form): Form
    {
        // Model untuk background di-bind langsung ke komponen FileUpload
        $backgroundSetting = Setting::firstOrCreate(['key' => 'hero_background']);

        return $form
            ->schema([
                Forms\Components\Section::make('Konten Teks')
                    ->schema([
                        Forms\Components\TextInput::make('hero_title')
                            ->label('Judul Utama')
                            ->required(),
                        Forms\Components\TextInput::make('hero_subtitle')
                            ->label('Subjudul')
                            ->required(),
                    ]),
                Forms\Components\Section::make('Gambar Latar')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('hero_background_image')
                            ->label('Gambar Latar Belakang')
                            ->collection('hero_background')
                            ->disk('uploads')
                            ->image()->imageEditor()
                            ->helperText('Rekomendasi resolusi 1920x1080px.')
                            ->model($backgroundSetting) // Bind komponen ini ke record setting
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        try {
            $formData = $this->form->getState();

            // Simpan data teks
            Setting::updateOrCreate(['key' => 'hero_title'], ['value' => $formData['hero_title']]);
            Setting::updateOrCreate(['key' => 'hero_subtitle'], ['value' => $formData['hero_subtitle']]);

            // Upload gambar sudah ditangani otomatis oleh Spatie/Filament
            // karena kita sudah bind modelnya di form.

            Notification::make()
                ->title('Pengaturan berhasil disimpan')
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal menyimpan pengaturan')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    protected function getFormActions(): array
    {
        return [
            Forms\Components\Actions\Action::make('save')
                ->label('Simpan Perubahan')
                ->submit('save'),
        ];
    }
}