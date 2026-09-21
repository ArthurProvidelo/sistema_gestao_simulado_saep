<?php

namespace App\Models;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Empresa extends Model
{
    protected $fillable = ['nome', 'cnpj', 'telefone', 'email'];

    
    public function getCnpjAttribute($valor)
    {
        if ($valor === null) {
            return null;
        }

        try {
            $valor = Crypt::decryptString($valor);
        } catch (DecryptException $e) {
            // valor já está em texto puro
        }

        $digitos = preg_replace('/\D/', '', $valor);

        if (strlen($digitos) !== 14) {
            return $valor;
        }

        return preg_replace('/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/', '$1.$2.$3/$4-$5', $digitos);
    }

    public function salas()
    {
        return $this->hasMany(Sala::class);
    }
}
