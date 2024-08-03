<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class PiReportDomestic extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    public $guarded = [];

    protected $table = 'pi_report_domestics';

    protected static function boot()
    {
        parent::boot();
        static::creating(function (Model $model) {
            $model->setAttribute('created_by', auth()->user()->id);
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }

    public function piReportProducts() {
        return $this->hasMany(PiReportDomesticPrduct::class,'pi_report_domestic_id','id');
    }
}
