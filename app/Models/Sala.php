<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $fillable = ['num_sala', 'bloco', 'empresa_id'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }
}
