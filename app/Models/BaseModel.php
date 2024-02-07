<?php

namespace App\Models;

use App\Traits\ModelBootEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class BaseModel extends Model
{
    use SoftDeletes;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 50;

    /**
     * The maximum number of models to return for pagination.
     *
     * @var int
     */
    protected $maxPerPage = 100;

    /**
     * Return table's name.
     *
     * @return string
     */
    public static function getTableName(): string
    {
        return with(new static)->getTable();
    }

    /**
     * Get the maximum number of models to return per page.
     *
     * @return int
     */
    public function getMaxPerPage(): int
    {
        return $this->maxPerPage;
    }
}
