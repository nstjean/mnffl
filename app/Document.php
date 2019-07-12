<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['file_name','description'];

    /**
	* Get the archive item that owns document.
	*/
	public function user()
	{
	    return $this->belongsTo('App\ArchiveItem');
	}

	public function getFileNameShort() {
		$fullname = $this->file_name;
		$lengthfirst = 18;
		$lengthlast = 8;
		if(strlen($fullname)>$lengthfirst+$lengthlast+3) {
			// make it shorter
			// first 10 chars
			$first = substr($fullname, 0, $lengthfirst);
			// last 6 chars
			$last = substr($fullname, strlen($fullname)-$lengthlast, $lengthlast);
			return $first . '...' . $last;
		} else {
			return $fullname;
		}
	}
}
