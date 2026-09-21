<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = ['data', 'hora', 'descricao', 'sala_id'];

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
}
