<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Support\Exceptions\Halt;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Permission\Models\Role;

class EditTowUser extends Page
{
    use InteractsWithForms;


    public $record = null;
    public $roless = null;
    public $name,$email,$password;
    public $roles = null;
    public ?array $data = [];


    protected static string $resource = UserResource::class;


    protected static string $view = 'filament.resources.user-resource.pages.edit-tow-user';


    protected function resolveRecord(int | string $key): Model
    {
        $record = static::getResource()::resolveRecordRouteBinding($key);

        if ($record === null) {
            throw (new ModelNotFoundException())->setModel($this->getModel(), [$key]);
        }
        return $record;
    }

    public function mount(string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->roless = Role::get();

        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->maxLength(255),
                Forms\Components\Select::make('roles')
                    ->options($this->roless->pluck('name', 'id'))->multiple()
//                    ->relationship('roles','name')
//                    ->preload()
//                    ->multiple()
//                    ->required(),
                    ])
            ])->statePath('data');
    }


    public function save(): void
    {
        try {
            $data = $this->form->getState();
            dd($data);
            auth()->user()->update($data);
        } catch (Halt $exception) {
            return;
        }
        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
            Action::make('cancel')
                ->label(__('filament-panels::resources/pages/create-record.form.actions.cancel.label'))
                ->url($this->previousUrl ?? static::getResource()::getUrl())
                ->color('gray'),
        ];
    }

}
