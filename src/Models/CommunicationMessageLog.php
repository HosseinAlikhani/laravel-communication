<?php
namespace D3cr33\Communication\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunicationMessageLog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const UPDATED_AT = null;
}
