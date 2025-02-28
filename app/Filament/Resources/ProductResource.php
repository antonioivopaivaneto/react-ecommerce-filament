<?php

namespace App\Filament\Resources;

use App\Enums\Enums\ProductStatusEnum;
use App\Enums\RolesEnum;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Callable_;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
            ->schema([
                Forms\Components\TextInput::make('title')
                ->live(onBlur: true)
                ->required()
                ->afterStateUpdated(
                    function (string $operation, $state, callable $set){
                        $set("slug",Str::slug($state));
                    }
                ),
                Forms\Components\TextInput::make('slug')
                ->required(),
                Forms\Components\Select::make('department_id')
                ->relationship('department', 'name')
                ->label(__('Department'))
                ->preload()
                ->searchable()
                ->required()
                ->reactive()
                ->afterStateUpdated(function (callable $set){
                    $set('category_id',null);
                }),
                Select::make('category_id')
                ->relationship(
                    name: 'category',
                    titleAttribute: 'name',
                    modifyQueryUsing: function (Builder $query, Callable $get)  {
                        $departmentId = $get('department_id');
                        if ( $departmentId){
                            $query->where('department_id', $departmentId);
                        }

                    }
                )
                ->label(__("Category"))
                ->preload()
                ->searchable()
                ->required()
            ]),
        Forms\Components\RichEditor::make('description')
            ->required()
            ->toolbarButtons([
                'attachFiles',
                'blockquote',
                'bold',
                'h2',
                'h3',
                'bulletList',
                'codeBlock',
                'heading',
                'italic',
                'link',
                'orderedList',
                'redo',
                'strike',
                'table',
                'undo',
                ])
            ->columnSpan(2),
                Forms\Components\TextInput::make('price')
                ->required()
                ->numeric(),
                Forms\Components\TextInput::make('quantity')
                ->integer(),
                Forms\Components\Select::make('status')
                ->options(ProductStatusEnum::labels())
                ->default(ProductStatusEnum::Draft->value)
                ->required()

            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                ->sortable()
                ->words()
                ->searchable(),
                TextColumn::make('status')
                ->badge()
                ->colors(ProductStatusEnum::colors()),
                TextColumn::make('department.name'),
                TextColumn::make('category.name'),
                TextColumn::make('created_at')
                ->dateTime(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                ->options(ProductStatusEnum::labels()),
                Tables\Filters\SelectFilter::make('department_id')
                ->relationship('department', 'name')
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
        ];
    }
    public static function canviewAny():bool
    {
        $user = Filament::Auth()->user();
        return $user && $user->hasRole(RolesEnum::Vendor);
    }
}
