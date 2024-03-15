<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->after(function (Post $record) {
                    // delete single
                    if ($record->image) {
                        \Storage::disk('public')->delete($record->image);
                    }
                }),
        ];
    }
}
