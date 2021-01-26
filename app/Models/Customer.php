<?php

namespace App\Models;

use App\Traits\CustomAttributesTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use CustomAttributesTrait;

    protected $table = 'customers';
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'city_id',
        'status'
    ];

    /**
     * @param Builder $builder
     */
    public function scopeStatus(Builder $builder)
    {
        $builder->where('status', 1)->orderBy('name', 'ASC');
    }

    /**
     * @param Builder $builder
     * @param array $search
     * @return mixed
     */
    public function scopeSearch(Builder $builder, array $search)
    {
        foreach ($search as $column => $value) {
            switch ($column) {
                case 'code':
                    if ($value) {
                        $builder->where('id', $value);
                    }
                    break;
                case 'name':
                    if ($value) {
                        $builder->where('name', "like", "%{$value}%");
                    }
                    break;
                case 'city_id':
                    if ($value) {
                        $builder->where('city_id', $value);
                    }
                    break;
                case 'status':
                    if ($value !== null) {
                        $builder->where('status', $value);
                    }
                    break;
            }
        }
        return $builder->orderBy('name', 'ASC');
    }

    public static function getArrayList()
    {
        $lists = [
            'cities' => City::status()->get(),
        ];

        return $lists;
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
