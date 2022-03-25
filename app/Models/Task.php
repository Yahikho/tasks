<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_date', 'end_date', 'id_state', 'id_user'];

    public function states(){
        return $this->belongsTo(State::class, 'id_state');
    }

    public function users(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
