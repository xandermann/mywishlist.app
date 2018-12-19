<?php
	namespace wishlist\models;
	use Illuminate\Database\Eloquent\Model;

	/**
	 * @author lilian battani
	 * classe utlisée pour la gestion
	 * des images associées aux items
	 */
	class Image extends Model{
		protected $table="image";
		protected $primaryKey="idImage";
		public $timestamps=false;
		protected $guarded = [];
	}
?>