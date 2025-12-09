<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * Los atributos que son asignables en masa.
     */
    protected $fillable = [
        'title',
        'description',
        'is_done',
        'due_date'
    ];

    /**
     * Los atributos que deben ser casteados.
     */
    protected $casts = [
        'is_done' => 'boolean',
        'due_date' => 'date',
    ];
}