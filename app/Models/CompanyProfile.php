<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class CompanyProfile extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    public $guarded = [];

    protected $table = 'company_profiles';

    protected static function boot()
    {
        parent::boot();
        static::creating(function (Model $model) {
            $model->setAttribute('created_by', auth()->user()->id);
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }
}
