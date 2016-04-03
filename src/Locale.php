<?php

namespace EscapeWork\Translations;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{

    /**
     * Table
     */
    protected $table = 'locales';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Fillable
     */
    protected $fillable = [
        'id',
        'title',
    ];

    /**
     * Timestamps
     */
    public $timestamps = false;
}
