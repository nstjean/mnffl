<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchiveItem extends Model
{
    // Table Name
    protected $table = 'archive';

    // Primary Key
    public $primaryKey = 'id_year';
}
