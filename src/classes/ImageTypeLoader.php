<?php
	namespace wishlist\classes;
	/**
	 * classe chargée de donner les formats image acceptés 
	 */
	class ImageTypeLoader{
		/**
		 * chemin d'accès au fichier ini
		 */
		private static $PATH="../src/config/imgType.ini";
		/**
		 * change le chemin d'accès au fichier ini
		 */
		public static function set_ini_path(string $path){
			self::$PATH=$path;
		}
		/**
		 * @return format acceptés
		 */
		public static function types():string{
			$readen_types=parse_ini_file(self::$PATH);
			$to_return="";
			$i=0;

			foreach($readen_types as $key => $value){
				if($value!=0){
					$to_return.='*.'.filter_var($key,FILTER_SANITIZE_SPECIAL_CHARS);

					if($i<count($readen_types)-1)
						$to_return.=',';
				}
			}

			return $to_return;
		}
	}
?>