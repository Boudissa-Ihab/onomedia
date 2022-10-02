<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;

class AvailabilityComponent extends Component
{
    public $availability;

    public function mount()
    {
        if(setting('availability'))
        {
            foreach(setting('availability') as $key => $value)
                $this->availability[$key] = $value;
        } else {
            $this->availability = [
                'Dimanche' => [
                    "opening_time" => "08:00",
                    "closing_time" => "16:00"
                ],
                'Lundi' => [
                    "opening_time" => "08:00",
                    "closing_time" => "16:00"
                ],
                'Mardi' => [
                    "opening_time" => "08:00",
                    "closing_time" => "16:00"
                ],
                'Mercredi' => [
                    "opening_time" => "08:00",
                    "closing_time" => "16:00"
                ],
                'Jeudi' => [
                    "opening_time" => "08:00",
                    "closing_time" => "16:00"
                ]
            ];
        }
    }

    public function render()
    {
        return view('livewire.client.availability-component');
    }
}
