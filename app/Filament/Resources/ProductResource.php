<?php

namespace App\Filament\Resources;

use App\Enums\Enums\ProductStatusEnum;
use App\Enums\RolesEnum;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\Pages\EditProduct;
use App\Filament\Resources\ProductResource\Pages\ProductImages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static SubNavigationPosition $subNavigationPosition =subNavigationPosition::End;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        TextInput::make('title')
                            ->live(onBlur: true)
                             ->required()
                             ->afterStateUpdated(
                                 function (string $operation, $state, callable $set){
                                     $set ("slug", Str::slug($state));
                                 }),
                        TextInput::make('slug')
                        ->required(),
                        Select::make('department_id')
                             ->relationship('department', 'name')
                              ->label(__('Department'))
                               ->preload()
                               ->searchable()
                               ->required()
                                ->reactive()
                        ->afterStateUpdated(function (callable $set){
                            $set ('category_id', null);
                        }),
                        Select::make('category_id')
                        ->relationship(
                            name: 'category',
                            titleAttribute: 'name',
                            modifyQueryUsing: function (Builder $query, callable $get)  {
                                $department_id = $get('department_id');
                                if ($department_id) {
                                    $query->where('department_id', $department_id);
                                }
                            }
                            )
                        ->label(__('Category'))
                        ->preload()
                        ->searchable()
                        ->required(),

                ]),
                Forms\Components\RichEditor::make('description')
                ->required()
                ->toolbarButtons([
                    'block-quote',
                    'bold',
                    'bullet-list',
                    'h2',
                    'h3',
                    'italic',
                    'link',
                    'ordered-list',
                    'redo',
                    'strike',
                    'underline',
                    'undo',
                    'table',
                ])
                ->columnSpan(2),
                TextInput::make('price')
                ->required()
                ->numeric(),
                TextInput::make('quantity')
                ->integer(),
                Select::make('status')
                ->options(ProductStatusEnum::labels())
                ->default(ProductStatusEnum::Draft->value)
                ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                ->sortable()
                ->words(10)
                ->searchable(),
                Tables\Columns\TextColumn::make('status')
                ->badge()
                ->colors(ProductStatusEnum::colors()),
                Tables\Columns\TextColumn::make('department.name'),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
            ])
            ->filters([
                SelectFilter::make('status')
                ->options(ProductStatusEnum::labels()),
                SelectFilter::make('department_id')
                ->relationship('department', 'name'),

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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
            'images'=>Pages\ProductImages::route('/{record}/images'),
        ];
    }
    public static function getRecordSubNavigation(Page $page): array
    {
        return
            $page->generateNavigationItems([
                EditProduct::class,
                ProductImages::class,
            ]);

    }

    public static function canViewAny(): bool
    {
        $user = Filament::auth()->user();

        return $user && $user->hasRole(RolesEnum::Vendor);
    }
}
