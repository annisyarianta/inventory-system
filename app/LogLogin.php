<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class loglogin extends Model
{

    protected $primaryKey = 'loglogin_id';
    public $incrementing = false;

    protected $nanoidLength = 16;

    protected $fillable = ['loglogin_id', 'loglogin_user', 'loglogin_created_by'];

    const CREATED_AT = 'loglogin_created_at';
    const UPDATED_AT = 'loglogin_updated_at';

    public static function generateLogLoginid(int $length = 16): string
    {
        $loglogin_id = Str::random($length); //Generate random string
        $exists = DB::table('loglogins')
            ->where('loglogin_id', '=', $loglogin_id)
            ->get(['loglogin_id']); //Find matches for id = generated id
        if (isset($exists[0]->loglogin_id)) { //id exists in users table
            return self::generateLogLoginid(); //Retry with another generated id
        }

        return $loglogin_id; //Return the generated id as it does not exist in the DB
    }
}
