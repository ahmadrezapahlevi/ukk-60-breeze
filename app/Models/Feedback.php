<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $fillable = [
        'aspirasi_id',
        'admin_id',
        'feedback'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class);
    }
}
