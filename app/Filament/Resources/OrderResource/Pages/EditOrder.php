<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Filament\Facades\Filament;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('complete')
                ->label('Отметить как выполненный')
                ->action(function () {
                    $this->record->update([
                        'status' => 'completed'
                    ]);
                    Notification::make()
                        ->success()
                        ->title('Заказ отмечен как выполненный')
                        ->send();
                    
                    return $this->redirect($this->getResource()::getUrl('edit', ['record' => $this->record]));
                })
                ->visible(fn () => $this->record->status !== 'completed')
                ->color('success'),
            Actions\DeleteAction::make(),
        ];
    }
}
