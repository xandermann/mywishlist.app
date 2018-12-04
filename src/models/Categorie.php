<?php
namespace wishlist\models;

use Illuminate\Database\Eloquent\Model;

/**
 * @author lilian battani
 * classe symbolisant les catégories
 * des objets
 */
class Categorie extends Model{
	protected $table="categorie";
	protected $primaryKey="codeCateg";
	public $timestamps=false;

	/**
	 * @return tous les items d'une catégorie
	 */
	public function items(){
		return $this->hasMany('\wishlist\models\Item');
	}
}
?>