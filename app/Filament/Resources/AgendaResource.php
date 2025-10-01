<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgendaResource\Pages;
use App\Models\Agenda;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    // Pengaturan Label Bahasa Indonesia
    protected static ?string $navigationLabel = 'Agenda';
    protected static ?string $navigationGroup = 'Konten';

    protected static ?string $modelLabel = 'Agenda';
    protected static ?string $pluralModelLabel = 'Agenda';
    protected static ?int $navigationSort = 3;


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

                Forms\Components\DatePicker::make('tanggal')
                    ->required()
                    ->displayFormat('d F Y'),

                Forms\Components\TextInput::make('lokasi')
                    ->required()
                    ->maxLength(255),

                Forms\Components\SpatieMediaLibraryFileUpload::make('gambar')
                    ->collection('agenda_images')
                    ->disk('uploads')
                    ->multiple()
                    ->reorderable()
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('isi')
                    ->required()
                    ->disableToolbarButtons(['attachFiles'])
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
                    ->collection('agenda_images')
                    ->disk('uploads'),

                Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('tanggal')
                    ->date('d F Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('lokasi')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Status')
                    ->boolean(),
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
            'index' => Pages\ListAgendas::route('/'),
        ];
    }
}