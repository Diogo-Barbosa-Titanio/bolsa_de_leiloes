<?	ob_start();

	require_once "../../../../system/conecta.php";
	require_once "../../../../system/mysql.php";
	require_once "../../../../app/Funcoes/funcoes.php";
	require_once "../../../../app/Funcoes/funcoesAdmin.php";

	$mysql = new Mysql();
	$mysql->ini();

	$arr = array();
	$arr['id'] = 0;

		if(isset($_POST['modulos']) and $_POST['modulos'] and LUGAR == 'admin'){
			$mysql->prepare = array($_POST['modulos']);
			$mysql->filtro = " WHERE `id` = ? ";
			$modulos = $mysql->read_unico('menu_admin');
			verificar_permissoes_all($modulos, 0, 'lista');

			$mysql->prepare = array($_POST['modulos'], $_SESSION['x_admin']->id);
			$mysql->filtro = " WHERE `modulos` = ? AND `usuarios` = ? ";
			$arr['id'] = $mysql->delete('usuarios_config');

		} else {
			$arr['violacao_de_regras'] = 1;
			violacao_de_regras($arr);
		}

	$mysql->fim();
	echo json_encode($arr); 

?>