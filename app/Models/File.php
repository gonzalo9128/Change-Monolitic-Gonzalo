<?php

namespace App\Models;

use app\Models\Petition;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public $table = 'files';
    protected $fillable = ['name','petition_id','file_path'];

    public function petition(){
        return $this->belongsTo(Petition::class, 'petition_id');
    }

}
