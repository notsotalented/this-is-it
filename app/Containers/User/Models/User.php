<?php

namespace App\Containers\User\Models;

use App\Containers\Authorization\Traits\AuthorizationTrait;
use App\Containers\Payment\Contracts\ChargeableInterface;
use App\Containers\Payment\Models\PaymentAccount;
use App\Containers\Payment\Traits\ChargeableTrait;
use App\Containers\Product\Models\Product;
use App\Ship\Parents\Models\UserModel;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Notifications\Notifiable;

/**
 * Class User.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class User extends UserModel implements ChargeableInterface
{

  use ChargeableTrait;
  use AuthorizationTrait;
  use Notifiable;
  use CrudTrait;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'device',
    'platform',
    'gender',
    'birth',
    'social_provider',
    'social_token',
    'social_refresh_token',
    'social_expires_in',
    'social_token_secret',
    'social_id',
    'social_avatar',
    'social_avatar_original',
    'social_nickname',
    'confirmed',
    'is_client',
  ];

  protected $casts = [
    'is_client' => 'boolean',
    'confirmed' => 'boolean',
  ];

  /**
   * The dates attributes.
   *
   * @var array
   */
  protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  public function paymentAccounts()
  {
    return $this->hasMany(PaymentAccount::class);
  }

  public function ownProducts()
  {
    return $this->hasMany(Product::class, 'user_id', 'id');
  }

  public function ownAccounts()
  {
    return $this->hasMany(Account::class, 'belongs_to', 'id');
  }

  public function getPhoto()
  {
    if ($this->social_avatar) {
      return '/storage/uploads/photos/' . $this->social_avatar;
    }
  }
}
