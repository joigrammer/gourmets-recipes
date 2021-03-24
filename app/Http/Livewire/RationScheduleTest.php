<?php

namespace App\Http\Livewire;

use App\Models\Recipe;
use Carbon\Carbon;
use Livewire\Component;

class RationScheduleTest extends Component
{
    const DAYS = ['D', 'L', 'M', 'X', 'J', 'V', 'S'];

    public $now;
    public $focus;
    public $recipes;
    
    public function mount()
    {
        $this->focus = Carbon::now();
        $this->now = Carbon::now();
        $this->recipes = Recipe::all();
    }
    
    public function config()
    {
        return json_encode([
            'today' => $this->now->isoFormat('dddd'),
            'date' => $this->now->isoFormat('MMMM D Y'),
            'month' => $this->focus->monthName,
            'days'  => self::DAYS,
            'blankDays' => $this->getBlankDays(),
            'noOfDays' => $this->getNoOfDays(),
        ]);
    }

    public function isToday($day)
    {
        return $this->now->get('day') == $day;   
    }

    public function getBlankDays()
    {
        $dayOfWeek = $this->focus->dayOfWeek;        
        $blankDays= [];
        for ($i = 1; $i < $dayOfWeek; $i++) {
            array_push($blankDays, $i);
        }
        return $blankDays;
    }

    public function getNoOfDays()
    {
        $daysInMonth = $this->focus->daysInMonth;
        $daysArray = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            array_push($daysArray, $i);
        }
        return $daysArray;
    }

    public function next()
    {
        $this->focus->addMonth();
        $this->config();
    }

    public function prev()
    {
        $this->focus->subMonth();
        $this->config();
    }

    public function search($date)
    {
        $this->recipes = Recipe::all()->take($date);
    }

    public function render()
    {
        return view('livewire.ration-schedule-test', [
            'schedule' => json_decode($this->config()),
            'recipes' => $this->recipes
        ]);
    }
}
