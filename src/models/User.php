<?php
	namespace wishlist\models;
	use Illuminate\Database\Eloquent\Model;

	/**
	 * @author lilian battani
	 * classe gèrant les comptes
	 * utilisateurs
	 */
	class User extends Model{
		protected $table="user";
		protected $primaryKey="idUser";
		public $timestamps=false;



		/**
		 * @return messages postés par l'utilisateur pour
		 * un item donné sur une liste données
		 */
		public function messages($list=null,$item){

		}
		/**
		 * @return listes auxquelles participe
		 * l'utilisateur
		 */
		public function lists(){

		}
	}
?>