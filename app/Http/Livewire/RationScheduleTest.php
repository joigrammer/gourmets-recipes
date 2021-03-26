<?php

namespace App\Http\Livewire;

use App\Models\Ration;
use App\Models\Recipe;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RationScheduleTest extends Component
{
    const DAYS = ['D', 'L', 'M', 'X', 'J', 'V', 'S'];

    public $now;
    public $focus;
    public $recipes;
    public $focusDay;
    public $rations;

    public function mount()
    {
        $this->focus = Carbon::now();
        $this->now = Carbon::now();
        $this->search($this->now->get('day'));
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
        $this->focusDay = $date;
        $datetime = new Carbon($this->focus);
        $datetime->day($date)->format('Y-m-d');
        $this->rations = Ration::select('rations.*')->join('recipes', 'recipes.id', '=', 'rations.recipe_id')->where(function ($query) use ($datetime) {
            $query->where('available_at', Carbon::parse($datetime)->format('Y-m-d'));
        })->get();
        $this->recipes = Recipe::select('recipes.*')->join('rations', 'recipes.id', '=', 'rations.recipe_id')->where(function ($query) use ($datetime) {
            $query->where('available_at', Carbon::parse($datetime)->format('Y-m-d'));
        })->get();
    }
    // TODO: Existe un problema en el calendario, al seleccionar dos fechas que tengan las mismas recetas
    // no actualiza o no se renderiza nuevamente el cuadrante del listado de recetas.
    public function render()
    {
        $schedule = json_decode($this->config());
        return view('livewire.ration-schedule-test', [
            'schedule' => $schedule,
            'recipes' => $this->recipes,
            'rations' => $this->rations
        ]);
    }
}
