<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LogLogin extends Model
{
    protected $table = 'loglogins'; // Specify table name if different from the class name

    protected $primaryKey = 'loglogin_id';
    public $incrementing = false;

    protected $nanoidLength = 16;

    protected $fillable = ['loglogin_id', 'loglogin_user', 'loglogin_created_by'];

    const CREATED_AT = 'loglogin_created_at';
    const UPDATED_AT = 'loglogin_updated_at';

    public static function generateLogLoginid(int $length = 16): string
    {
        do {
            $loglogin_id = Str::random($length); // Generate random string
            $exists = DB::table('loglogins')
                ->where('loglogin_id', '=', $loglogin_id)
                ->exists(); // Check if the ID exists
        } while ($exists);

        return $loglogin_id; // Return the generated ID as it does not exist in the DB
    }
}
