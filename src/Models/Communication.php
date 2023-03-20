<?php
namespace D3cr33\Communication\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'template_data' =>  'array',
        'receiver_data' =>  'array',
    ];
}
