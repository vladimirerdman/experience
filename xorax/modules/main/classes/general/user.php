<?

require_once($_SERVER["DOCUMENT_ROOT"]."/smartnote/xorax/modules/main/classes/general/subscr.php");

class CAllUser extends UserAuth {

	public function GetID(){
		if (isset($_SESSION['id'])) {
			return $_SESSION['id'];
		} else {
			return null;
		}
	}

}

?>
