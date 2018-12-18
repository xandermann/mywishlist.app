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
		 * @return tous les messages postés par l'utiisateur
		 */
		public function messages(){
			return $this->belongsToMany('wishlist\models\Message','poste');
		}
		/**
		 * @return messages globaux postés par l'utilisateur
		 * pour une liste donnée
		 */
		public function global_messages($list){
			$postes=DB::table('concerne')->select('concerne.idPoste')->get();
			$id_poste_array=array();

			foreach($postes as $concern)
				$id_poste_array[]=$concern->idPoste;

			$req=DB::table('message')->join('poste','message.idMessage','=','poste.idMessage');
			$req=$req->join('liste','poste.titreListe','=','liste.titreListe');
			$req=$req->where('poste.titreListe','=',$list);
			$req=$req->where('idUser','=',$this->idUser);
			$req=$req->whereNotIn('poste.idPoste',$id_poste_array);
			$req=$req->select('message.*');

			return $req;
		}
		/**
		 * @return messages postés par l'utilisateur pour
		 * un item donné sur une liste données
		 */
		public function messages($list,$item){
			$postes=DB::table('concerne')->where('concerne.nomItem','=',$item)->select('concerne.idPoste')->get();
			$id_poste_array=array();

			foreach($postes as $concern)
				$id_poste_array[]=$concern->idPoste;

			$req=DB::table('message')->join('poste','message.idMessage','=','poste.idMessage');
			$req=$req->join('liste','poste.titreListe','=','liste.titreListe');
			$req=$req->where('poste.titreListe','=',$list);
			$req=$req->where('idUser','=',$this->idUser);
			$req=$req->whereIn('poste.idPoste',$id_poste_array);
			$req=$req->select('message.*');

			return $req;
		}
		/**
		 * @return listes auxquelles participe
		 * l'utilisateur
		 */
		public function lists(){

		}
	}
?>