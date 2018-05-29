<?php 
//$return_arr='zzz';
//echo json_encode($return_arr);
//unset($return_arr);
//echo $_POST['lgnbtnid'];

switch ($_POST['lgnbtnid']){
    case 'btnLogin':
        $flag_j=0;
        break;
    case 'btnSure':
        $flag_j=1;
        break;
    default:
        $flag_j=2;
        break;
}
echo $flag_j;
exit;