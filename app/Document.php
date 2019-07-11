<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /**
	* Get the archive item that owns document.
	*/
	public function user()
	{
	    return $this->belongsTo('App\ArchiveItem');
	}
}