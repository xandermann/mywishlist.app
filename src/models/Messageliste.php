<?php
/**
 * Created by PhpStorm.
 * User: alex_
 * Date: 04/01/2019
 * Time: 15:32
 */

	namespace wishlist\models;
    use Illuminate\Database\Eloquent\Model;

    class Messageliste extends Model{
        protected $table="messageliste";
        protected $primaryKey="idmess";
        public $timestamps=false;
        protected $guarded = [];

        public function liste(){
            return $this->belongsTo('\wishlist\models\Liste','liste_id');
        }

    }