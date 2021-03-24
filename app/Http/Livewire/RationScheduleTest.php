<?php

namespace App\Http\Livewire;

use App\Models\Ration;
use App\Models\Recipe;
use Carbon\Carbon;
use Livewire\Component;

class RationScheduleTest extends Component
{
    const DAYS = ['D', 'L', 'M', 'X', 'J', 'V', 'S'];

    public $now;
    public $focus;
    public $recipes;
    public $focusDay;

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
            'dateFocus' => $this->focus->isoFormat('MMM D Y'),
            'month' => $this->focus->monthName,
            'days'  => self::DAYS,
            'blankDays' => $this->getBlankDays(),
            'noOfDays' => $this->getNoOfDays(),
        ]);
    }

    public function isToday($day)
    {
        if($this->now->get('month') == $this->focus->get('month') 
            && $this->now->get('year') == $this->focus->get('year')){
            return $this->now->get('day') == $day;
        }   
        return false;
    }

    public function getBlankDays()
    {
        $dayOfWeek = $this->focus->dayOfWeek - 1;
        $blankDays = [];
        for ($i = 1; $i < $dayOfWeek; $i++) {
            array_push($blankDays, $i);
        }
        return $blankDays;
    }
    // TODO: Corregir el mes previo, no organiza los espacios en blanco
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
    }

    public function prev()
    {
        $this->focus->subMonth();
    }

    public function search($date)
    {
        //dd($this->focus->day($date));
        //$this->focus = $this->focus->day($date);
        $datetime = $this->focus;
        $datetime->day($date)->isoFormat('Y-MM-D');
        //dd($datetime);
        $this->recipes = Ration::all()->where('available_at', '2021-03-'.$date);
        dd($this->recipes);
    }

    public function render()
    {
        $schedule = json_decode($this->config());
        return view('livewire.ration-schedule-test', [
            'schedule' => $schedule,
            'recipes' => $this->recipes
        ]);
    }
}
