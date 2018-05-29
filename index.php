<?php //session_start();
$tmp_bs_dir=dirname(__DIR__).DIRECTORY_SEPARATOR;
require $tmp_bs_dir.DIRECTORY_SEPARATOR.'conf'.DIRECTORY_SEPARATOR.'init.cfg.php';
require BASE_DIR.NAME_CFG.DIRECTORY_SEPARATOR.'self.cfg.php';

require BASE_DIR.NAME_INC.DIRECTORY_SEPARATOR.'init'.POSTFIX_INC;

$init=new Init();

$init->init_app(BASE_DIR.NAME_TMPLT,)


unset($tmp_bs_dir);

if (!isset($_SESSION['flag_login'])){
    require 'templt/login.html';
}else{
    if ($_SESSION['flag_login']==1){
        //require '';
        echo 'aaaaaaaaa';
    }else{
        require '../templt/login.html';
    }
}