<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'brand',
        'price',
        'details'
    ];
    use SearchableTrait, Searchable;

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'products.title' => 10,
            'products.details' => 10,
        ],
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
