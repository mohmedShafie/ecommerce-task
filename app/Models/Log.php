<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'action',
        'action_type',
        'action_id',
        'action_model',
        'action_model_id',
        'action_model_type',
        'action_model_id',
        'status'
    ];

    public function actionModel()
    {
        return $this->belongsTo(Model::class);
    }
    public function actionModelType()
    {
        return $this->belongsTo(Model::class);
    }
    public function actionModelId()
    {
        return $this->belongsTo(Model::class);
    }
}
