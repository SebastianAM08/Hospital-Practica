<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';
    protected $primaryKey = 'codigo_paciente';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'codigo_paciente',
        'nombre',
        'apellidos',
        'foto',
    ];

    public function ingresos()
    {
        return $this->hasMany(Ingreso::class, 'codigo_paciente', 'codigo_paciente');
    }
}
