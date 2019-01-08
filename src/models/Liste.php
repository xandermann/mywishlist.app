<?php


namespace wishlist\models;

use Illuminate\Database\Eloquent\Model;

class Liste extends Model {

	protected $table = "liste";
	protected $primaryKey = "no";
    protected $guarded = [];
    public $timestamps = false;

	public function items() {
		return $this->hasMany('\wishlist\models\Item', 'liste_id');
	}

	public function user() {
		return $this->belongsTo('\wishlist\models\User', 'user_id');
	}

	public function messagesliste(){
	    return $this->hasMany('\wishlist\models\Messageliste','liste_id');
    }

}