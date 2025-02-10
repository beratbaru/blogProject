<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PolicyResource\Pages;
use App\Filament\Resources\PolicyResource\RelationManagers;
use App\Models\Policy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\MarkdownEditor;
use Tables\Columns\TextColumn;
class PolicyResource extends Resource
{
    protected static ?string $model = Policy::class;

    protected static ?string $navigationIcon = 'heroicon-c-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextArea::make('kvkk_policy')
                    ->label('KVKK Policy')
                    ->placeholder('Enter KVKK policy content here...')
                    ->required(),
                MarkdownEditor::make('security_policy')
                    ->label('Security Policy')
                    ->placeholder('Enter security policy content here...')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // You can add columns like 'kvkk_policy' and 'security_policy' for easy reference
                Tables\Columns\TextColumn::make('kvkk_policy')->limit(50),
                Tables\Columns\TextColumn::make('security_policy')->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPolicies::route('/'),
            'create' => Pages\CreatePolicy::route('/create'),
            'edit' => Pages\EditPolicy::route('/{record}/edit'),
        ];
    }
}
