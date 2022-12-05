<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description', 'assigned_by_id', 'assigned_to_id'];

    /**
     * Get the admmin user that assigned the task.
     */
    public function assignedByUser()
    {
        return $this->belongsTo(User::class, 'assigned_by_id', 'id');
    }

    /**
     * Get the assignee user that that task was assigned to.
     */
    public function assignedToUser()
    {
        return $this->belongsTo(User::class, 'assigned_to_id', 'id');
    }
}
