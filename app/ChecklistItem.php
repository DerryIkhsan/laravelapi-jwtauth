<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChecklistItem extends Model
{
    //
    protected $fillable = [
        'item_name', 'checklist_id'
    ];
}
