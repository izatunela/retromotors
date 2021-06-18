<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use App\Events\UserResetPasswordEvent;
use App\Notifications\PasswordChangedNotification;
use App\Notifications\EmailChangedNotification;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements CanResetPassword
{
	use SoftDeletes,Notifiable,CanResetPasswordTrait,CascadeSoftDeletes,HasFactory;

	protected $cascadeDeletes = [
					'getAutoMarketItems',
					'getMotoMarketItems',
					'getTruckMarketItems',
					'getPartsMarketItems',
					'getEquipmentMarketItems',
					'getGalleryItems',
				];

	protected $dates = ['deleted_at'];
	protected $table = 'user';
	protected $fillable = ['name', 'email', 'password','city','country','phone'];
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	// protected $hidden = ['role_id','password','email','phone','country','city','confirmation_code','status','remember_token','created_at','updated_at','deleted_at'];
	protected $visible = ['name'];

	// public static function boot()
	// {
	// 	parent::boot();
	// 	static::restored(function($user) {
	// 		// $user->getEquipmentMarketItems()->withTrashed()->get()
	// 		// 	->each(function($equipment) {
	// 		// 		$equipment->restore();
	// 		// 		$equipment->marketAllPhotos()->restore();
	// 		// 	});
	// 		dd('wew');
	// 		// $user->files()->withTrashed()->restore();
	// 	});
	// }
	public function sendEmailChangedNotification()
	{
		$this->notify(new EmailChangedNotification($this));
	}
	public function sendPasswordChangedNotification()
	{
		$this->notify(new PasswordChangedNotification($this));
	}

	public function sendPasswordResetEmail($token)
    {
		event(new UserResetPasswordEvent($this,$token));

		return redirect()->back()->with('pw-reset-sent','Poslali smo uputstvo za promenu lozinke na Vašu email adresu');
    }

	public function posts()
	{
		return $this->hasMany(Post::class);
	}

	public function role()
	{
		return $this->belongsTo(Role::class);
	}

	public function isAdmin()
	{
		if ($this->role->id === 1) {
			return true;
		}
		return false;
	}
	public function getGalleryItems()
	{
		return $this->hasMany(Gallery::class);
	}
	public function getAutoMarketItems()
	{
		$auto = $this->hasMany(MarketAutomobile::class);
		return $auto;
	}

	public function getMotoMarketItems()
	{
		$moto = $this->hasMany(MarketMotorcycle::class);
		return $moto;
	}

	public function getTruckMarketItems()
	{
		$truck = $this->hasMany(MarketTruck::class);
		return $truck;
	}

	public function getPartsMarketItems()
	{
		$parts = $this->hasMany(MarketParts::class);
		return $parts;
	}

	public function getEquipmentMarketItems()
	{
		$equipment = $this->hasMany(MarketEquipment::class);
		return $equipment;
	}

	public function numOfMarketItems()
	{
		$sum =	 $this->getAutoMarketItems()->withTrashed()->count()  +
				 $this->getMotoMarketItems()->withTrashed()->count()  +
				 $this->getTruckMarketItems()->withTrashed()->count() +
				 $this->getPartsMarketItems()->withTrashed()->count() +
				 $this->getEquipmentMarketItems()->withTrashed()->count();

		return $sum;
	}
	public function userMarketItems()
	{
		$auto = $this->hasMany(MarketAutomobile::class);
		$moto = $this->hasMany(MarketMotorcycle::class);
		$truck = $this->hasMany(MarketTruck::class);
		$parts = $this->hasMany(MarketParts::class);
		$equip = $this->hasMany(MarketEquipment::class);
		$items = ['auto'=>$auto,'moto'=>$moto,'truck'=>$truck,'parts'=>$parts,'equip'=>$equip];

		return $items;
	}
	public function galleryItems()
	{
		$items = Gallery::with('user')->where('user_id',$this->id)->orderBy('created_at','desc')->paginate(6);

		return $items;
	}
	public function numOfGalleryItems()
	{
		return $this->getGalleryItems()->withTrashed()->count();
	}
}
