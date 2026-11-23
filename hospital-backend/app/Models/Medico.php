<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $table = 'medicos';
    protected $primaryKey = 'codigo_medico';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'codigo_medico',
        'nombre',
        'apellidos',
    ];

    public function ingresos()
    {
        return $this->hasMany(Ingreso::class, 'codigo_medico', 'codigo_medico');
    }
}
