<?php
	namespace wishlist\models;
	use Illuminate\Database\Eloquent\Model;

	/**
	 * @author lilian battani
	 * classe symbolisant les messages
	 * postés par les différents utilisateurs
	 */
	class Message extends Model{
		protected $table="message";
		protected $primaryKey="idMessage";
		public $timestamps=false;
		/**
		 * @return utilisateur qui a posté le message
		 */
		public function user(){
			return $this->belongsToMany('\wishlist\models\User','poste');
		}
	}
?>