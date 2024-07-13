<?php

namespace App\Http\Livewire;

use App\Http\Models\Question;
use Livewire\Component;

class ShowQuestion extends Component
{

    public $quizze_id, $student_id, $data, $counter = 0;
    public function render()
    {
        $this->data = Question::where('quizze_id', $this->quizze_id)->get();
        return view('livewire.show-question', ['data' => $this->data]);
    }
}
