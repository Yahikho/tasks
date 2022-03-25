<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\State;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class Tasks extends Component
{

    public $states, $name, $start_date, $end_date, $id_state, $id_task, $id_user, $name_state;
    public $modal = false;
    public $selectedState = null;
    public $modalRepo = false, $dateRepo;

    public function render()
    {
        $this->id_user = auth()->user()->id;
        $this->states = State::all();
        return view('livewire.tasks', [
            'tasks' => Task::when($this->selectedState, function($query){
                $query->where('id_state', $this->selectedState);
            })->where('id_user', $this->id_user)->get(),
        ]);
    }

    public function create()
    {
        $this->cleanInputs();
        $this->openModal();
    }

    public function openModal()
    {
        $this->modal = true;
    }

    public function closeModal()
    {
        $this->modal = false;
        $this->name_state = '';
    }

    public function cleanInputs()
    {
        $this->id_task = '';
        $this->name = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->id_state = '';
        $this->id_user = '';
    }

    public function editTask($id, $id_state)
    {
        
        $task = Task::findOrFail($id);
        $this->id_task = $id;
        $this->name = $task->name;
        $this->start_date = $task->start_date;
        $this->end_date = $task->end_date;
        $this->id_state = $task->id_state;
        $this->id_user = $task->id_user;

        $state = State::findOrFail($id_state);
        $this->name_state = $state->name;
        $this->openModal();
    }

    public function deleteTask($id)
    {
        Task::find($id)->delete();
    }

    public function save()
    {
        Task::updateOrCreate(['id' => $this->id_task], [
            'name' => $this->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'id_state' => $this->id_state == null ? State::all()->first()->id : $this->id_state,
            'id_user' => $this->id_user
        ]);
        $this->closeModal();
        $this->cleanInputs();
    }

    function closeModalRepo(){
        $this->modalRepo = false;
        $this->dateRepo = '';
    }

    function generateReport(){
        $this->modalRepo = true;
        $this->dateRepo = DB::table('tasks')
                ->join('states', 'tasks.id_state', '=', 'states.id')
                ->select('states.name',DB::raw('count(*) as total'))
                ->groupBy('states.name')
                ->get();
    }
}
