<?php


namespace wishlist\models;

use Illuminate\Database\Eloquent\Model;

class Liste extends Model {

	protected $table = "liste";
	protected $primaryKey = "no";
    protected $fillable = ['no','user_id','titre', 'description',  'expiration','token'];
    public $timestamps = false;

	public function items() {
		return $this->hasMany('\wishlist\models\Item');
	}

}