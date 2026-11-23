<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table = 'ingresos';
    protected $primaryKey = 'codigo_ingreso';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'codigo_ingreso',
        'habitacion',
        'fecha',
        'codigo_medico',
        'codigo_paciente',
    ];

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'codigo_medico', 'codigo_medico');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'codigo_paciente', 'codigo_paciente');
    }
}
