<?php

namespace App\Http\Livewire;

use App\Models\Recipe;
use Livewire\Component;
use Carbon\Carbon;

class RationSchedule extends Component
{
    const DAYS = ['Domingo', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']; 

    public $recipe;
    public $now; 

    public function mount()
    {        
        $this->now = Carbon::now();        
    }

    public function config()
    {
        return [
            'month' => $this->now->monthName,
            'year' => $this->now->get('year'),
            'today' => $this->now->get('day'),
            'days' => self::DAYS,
            'blankDays' => $this->getBlankDaysArray(),
            'noOfDays' => $this->getNoOfDays()
        ];
    }

    public function isToday($date)
    {     
        // TODO: Coge el mismo día para cualquier tipo de mes, validar cuando esté situado a otro mes
        return $this->now->get('day') == $date;       
    }

    public function getBlankDaysArray()
    {
        $dayOfWeek = $this->now->dayOfWeek;
        $blankDaysArray = [];
        for ($i = 1; $i <= $dayOfWeek; $i++) {
            array_push($blankDaysArray, $i);
        }
        return $blankDaysArray;
    }

    public function getNoOfDays()
    {
        $daysInMonth = $this->now->daysInMonth;
        $daysArray = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            array_push($daysArray, $i);
        }
        return $daysArray;
    }

    public function prev()
    {
        $this->now->subMonth();
    }

    public function next()
    {
        $this->now->addMonth();
    }
    
    public function render()
    {
        return view('livewire.ration-schedule', ['schedule' => $this->config()]);
    }
}
