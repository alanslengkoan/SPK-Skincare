<?php
session_start();
// untuk router
include_once '../../configs/library/my_root.php';
// autoload class
spl_autoload_register('autoLoadClass');
// untuk memanggil class sql
$pdo = new sql;
// untuk class my_login
$mylog = new my_login;
// untuk class my_function
$myfun = new my_function;
// untuk mengencek id user
if (empty($_SESSION['id_users'])) {
	// apa bila ingin mencoba back
	header("Location: ../../pages/login&akses");
	exit;
} else {
	// mengambil id user
	$id   = $_SESSION['id_users'];
	$data = $mylog->GetDataUser($_SESSION['id_users']);
	if (session_id() != session_id()) {
		session_unset();
		session_destroy();
		header("Location: ../../pages/login&akses");
	} else if ($data['id_users'] != $id) {
		// untuk id
		header("Location: ../../pages/login&akses");
		exit;
	} else if (isset($_COOKIE['id_users'])) {
		// untuk cookie id
		if ($data['id_users'] != $_COOKIE['id_users']) {
			header("Location: ../../pages/login&akses");
			exit;
		}
	} else if ($data['level'] != 'admin') {
		// apa bila level tidak sama
		header("Location: ../../pages/login&akses");
		exit;
	}

	// untuk data user
	$dataLog = $pdo->GetWhere('tb_users', 'id_users', $_SESSION['id_users']);
	$rowLog  = $dataLog->fetch(PDO::FETCH_OBJ);
}
// fungsi untuk minifier html
function minifier($path)
{
	if (trim($path) === "") {
		return $path;
	}
	$path = preg_replace_callback(
		'#<([^\/\s<>!]+)(?:\s+([^<>]*?)\s*|\s*)(\/?)>#s',
		function ($matches) {
			return '<' . $matches[1] . preg_replace('#([^\s=]+)(\=([\'"]?)(.*?)\3)?(\s+|$)#s', ' $1$2', $matches[2]) . $matches[3] . '>';
		},
		str_replace("\r", "", $path)
	);
	$search = array(
		'#<(img|input)(>| .*?>)#s',
		'#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
		'#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s',
		'#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s',
		'#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s',
		'#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s',
		'#<(img|input)(>| .*?>)<\/\1\x1A>#s',
		'#(&nbsp;)&nbsp;(?![<\s])#',
		'#&\#(?:10|xa);#',
		'#&\#(?:32|x20);#',
		'#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s'
	);
	$replace = array(
		"<$1$2</$1\x1A>",
		'$1$2$3',
		'$1$2$3',
		'$1$2$3$4$5',
		'$1$2$3$4$5$6$7',
		'$1$2$3',
		'<$1$2',
		'$1 ',
		"\n",
		' ',
		""
	);
	$path = preg_replace($search, $replace, $path);
	return $path;
}

ob_start("minifier");
$content = (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_REQUEST['content'])) ? str_replace('-', '_', $_REQUEST['content']) : $_REQUEST['content'];
if (file_exists('content/' . $content . '.php')) {
	include_once 'atribut/head.php';
	include_once 'atribut/sidebar.php';
	include_once 'atribut/navbar.php';
	switch ($content) {
		case $content:
			include_once 'content/' . str_replace('-', '_', $content) . '.php';
			break;
	}
	include_once 'atribut/footer.php';
	include_once 'atribut/foot.php';
} else {
	include_once 'content/403.html';
}
ob_end_flush();
