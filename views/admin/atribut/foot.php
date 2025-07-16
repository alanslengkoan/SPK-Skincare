<script src="./../../assets/admin/js/vendor/jquery-2.1.4.min.js"></script>
<script src="./../../assets/admin/js/popper.min.js"></script>
<script src="./../../assets/admin/js/plugins.js"></script>
<script src="./../../assets/admin/js/main.js"></script>

<?php
$content = (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_REQUEST['content'])) ? str_replace('-', '_', $_REQUEST['content']) : $_REQUEST['content'];
if (file_exists('js/' . $content . '.php')) {
    switch ($content) {
        case $content:
            include_once 'js/' . str_replace('-', '_', $content) . '.php';
            break;
    }
}
?>