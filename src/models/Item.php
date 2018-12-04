<?php

namespace wishlist\models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
    protected $table = "items";
    protected $primaryKey = "id";
    protected $fillable = ['id', 'liste_id', 'nom', 'descr', 'img', 'url', 'tarif'];
    public $timestamps = false;


    public function liste() {
    	return $this->belongsTo('\wishlist\models\Liste');
    }
}