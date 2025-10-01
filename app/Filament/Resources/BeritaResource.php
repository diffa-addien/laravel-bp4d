<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaResource\Pages;
use App\Models\Berita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    // Pengaturan Label Bahasa Indonesia
    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $modelLabel = 'Berita';
    protected static ?string $pluralModelLabel = 'Berita';
    protected static ?int $navigationSort = 1;


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

                Forms\Components\SpatieMediaLibraryFileUpload::make('gambar')
                    ->collection('berita_images')
                    ->disk('uploads') // Mengarahkan ke disk 'uploads'
                    ->multiple()
                    ->reorderable()
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('isi')
                    ->required()
                    ->disableToolbarButtons([
                        'attachFiles', // Menonaktifkan upload file di rich editor
                    ])
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('is_published')
                    ->label('Publikasikan')
                    ->required()
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('gambar')
                    ->collection('berita_images')
                    ->disk('uploads'), // Mengarahkan ke disk 'uploads'

                Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->limit(50),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Status')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBeritas::route('/'),
            // Create dan Edit akan menggunakan modal (pop-up) dari halaman List
            // 'create' => Pages\CreateBerita::route('/create'),
            // 'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}