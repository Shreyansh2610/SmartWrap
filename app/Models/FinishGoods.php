<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class FinishGoods extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    public $guarded = [];

    protected $table = 'finish_goods';

    protected static function boot()
    {
        parent::boot();
        static::creating(function (Model $model) {
            $model->setAttribute('created_by', auth()->user()->id);
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }

    /**
     * Get the size that owns the FinishGoods
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }

    /**
     * Get the product that owns the FinishGoods
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
