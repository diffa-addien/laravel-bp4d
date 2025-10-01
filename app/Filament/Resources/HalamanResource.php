<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HalamanResource\Pages;
use App\Models\Halaman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Get;

class HalamanResource extends Resource
{
    protected static ?string $model = Halaman::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Halaman';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $modelLabel = 'Halaman';
    protected static ?string $pluralModelLabel = 'Halaman';
    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Forms\Components\Select::make('kategori')
                    ->options([
                        'profil' => 'Profil',
                        'informasi' => 'Informasi',
                        'lainnya' => 'Lainnya',
                    ])
                    ->required(),

                Forms\Components\RichEditor::make('isi')
                    ->required()
                    ->fileAttachmentsDisk('uploads')
                    ->fileAttachmentsDirectory('halaman-attachments')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'profil' => 'success',
                        'informasi' => 'info',
                        'lainnya' => 'gray',
                    }),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('lihat')
                    ->label('Lihat')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('gray')
                    ->url(fn (Halaman $record): string => route('halaman.show', $record))
                    ->openUrlInNewTab(),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Halaman')
                    ->modalDescription('Aksi ini tidak dapat dibatalkan. Untuk melanjutkan, silakan ketik judul halaman yang ingin dihapus.')
                    ->modalSubmitActionLabel('Ya, Saya Mengerti dan Hapus')
                    ->form(function (Halaman $record) {
                        return [
                            Forms\Components\TextInput::make('konfirmasi_judul')
                                ->label('Ketik "' . $record->judul . '" untuk konfirmasi')
                                ->required()
                                ->rules([
                                    function () use ($record) {
                                        return function (string $attribute, $value, \Closure $fail) use ($record) {
                                            if ($value !== $record->judul) {
                                                $fail('Konfirmasi judul tidak cocok.');
                                            }
                                        };
                                    },
                                ])
                        ];
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // --- PERUBAHAN DI SINI ---
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Halaman Terpilih')
                        ->modalDescription('PERINGATAN! Aksi ini tidak dapat dibatalkan. Untuk melanjutkan, silakan ketik "Saya konfirmasi" pada kolom di bawah ini.')
                        ->modalSubmitActionLabel('Ya, Hapus Semua yang Dipilih')
                        ->form([
                            Forms\Components\TextInput::make('konfirmasi_bulk_delete')
                                ->label('Ketik "Saya konfirmasi" untuk melanjutkan')
                                ->required()
                                ->rules([
                                    function () {
                                        return function (string $attribute, $value, \Closure $fail) {
                                            if ($value !== 'Saya konfirmasi') {
                                                $fail('Konfirmasi yang Anda ketik tidak cocok.');
                                            }
                                        };
                                    },
                                ])
                        ]),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHalamans::route('/'),
        ];
    }
}