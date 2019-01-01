<?php
namespace wishlist\models;
use Illuminate\Database\Eloquent\Model;

	/**
	 * classe gèrant les comptes
	 * utilisateurs
	 */
	class User extends Model{
		protected $table="users";
		protected $primaryKey="id";
		public $timestamps=false;
		protected $guarded = [];

		public function listes() {
			return $this->hasMany('\wishlist\models\Liste', 'user_id');
		}


		/**
		 * @return tous les messages postés par l'utiisateur
		public function messages(){
			return $this->belongsToMany('wishlist\models\Message','poste');
		}

		*/
		/**
		 * @return listes créées par l'utilisateur
		public function created_lists(){
			return $this->lists('creator');
		}
		/**
		 * @return listes auxquelles participe l'utilisateur
		public function participated_lists(){
			return $this->lists('participant');
		}
		/**
		 * @return listes que l'utilisateur doit recevoir
		public function received_lists(){
			return $this->lists('cible');


		*/
	}