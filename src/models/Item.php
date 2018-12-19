<?php

namespace wishlist\models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
    protected $table = "item";
    protected $primaryKey = "id";
    protected $guarded = [];
    public $timestamps = false;

    /**
     * @return listes auxquelles appartient
     * l'item
     */
    public function listes() {
    	return $this->belongsToMany('\wishlist\models\Liste','estDans');
    }
    /**
     * @return images associées à l'item
     */
    public function images(){
    	return $this->belongsToMany('\wishlist\models\Image','decris');
    }
}
?>