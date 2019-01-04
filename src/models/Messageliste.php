<?php
/**
 * Created by PhpStorm.
 * User: alex_
 * Date: 04/01/2019
 * Time: 15:32
 */

	namespace wishlist\models;
    use Illuminate\Database\Eloquent\Model;

    class Message extends Model{
        protected $table="messageliste";
        protected $primaryKey="liste_id,message";
        public $timestamps=false;
        protected $guarded = [];

    }