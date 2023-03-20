<?php
namespace D3cr33\Communication\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunicationCallback extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'callback_data' =>  'array',
    ];

    const UPDATED_AT = null;
}
