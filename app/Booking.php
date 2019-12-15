<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $dates = [
        'from_date',
        'to_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'room_id',
        'from_date',
        'to_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    # Tratamento das datas, add +1 hora em período final.
    public function setFromDateAttribute($value)
    {
        $this->attributes['from_date'] = \DateTime::createFromFormat('d/m/Y H:i:s', $value);
        $this->attributes['to_date'] = \DateTime::createFromFormat('d/m/Y H:i:s', $value)->modify('+1 hour');
    }

    public function getFromDateAttribute()
    {   
        return Carbon::parse($this->attributes['from_date'])->format('d/m/Y H:i:s');    
    }

    public function getToDateAttribute()
    {   
        return Carbon::parse($this->attributes['to_date'])->format('d/m/Y H:i:s');    
    }

}
