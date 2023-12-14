<?php

namespace App\Containers\ReleaseVueJS\Models;

use App\Ship\Parents\Models\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class ReleaseVueJS extends Model
{
  use CrudTrait;

  protected $guard_name = 'web';
  protected $table = 'releasevuejs';
  protected $fillable = [
    'name',
    'date_created',
    'title_description',
    'detail_description',
    'is_publish',
    'images',
  ];

  protected $attributes = [];

  protected $hidden = [];

  protected $casts = [
    'images' => 'array',

  ];

  protected $dates = [
    'created_at',
    'updated_at',
  ];

  /**
   * A resource key to be used by the the JSON API Serializer responses.
   */
  protected $resourceKey = 'releasevuejs';
}
