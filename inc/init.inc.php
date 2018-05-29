<?php
class Init {

/**
	*功能:初始化app模版页面
	*参数:$app_name app的名称
	*返回:TRUE OR FALSE
	*/
	public function init_app($app_tmplt_arr=array(),$app_name='404') {
		//确认app参数路径非文件
		$app_runtime_path=BASE_DIR.NAME_RUNTIME.DIRECTORY_SEPARATOR;
		$app_tmplt_path=BASE_DIR.NAME_TMPLT.DIRECTORY_SEPARATOR;

		//判断模版是否在硬盘缓存，并确认模版版本，否创建缓存
		if (!is_dir($app_runtime_path)){
			if(file_exists($app_runtime_path)){
				unlink($app_runtime_path);
			}
			$this->copy_dir($app_tmplt_path.DIRECTORY_SEPARATOR,$app_runtime_path.DIRECTORY_SEPARATOR,$app_tmplt_arr);
		} else {
			if (!file_exists($app_runtime_path.DIRECTORY_SEPARATOR.FILE_TMPLT_VRSN) || is_dir(($app_runtime_path.DIRECTORY_SEPARATOR.FILE_TMPLT_VRSN)) || file_get_contents($app_runtime_path.DIRECTORY_SEPARATOR.FILE_TMPLT_VRSN)!=VRSN_TMPLT) {
				$this->remove_directory($app_runtime_path);
				$this->copy_dir($app_tmplt_path.DIRECTORY_SEPARATOR,$app_runtime_path.DIRECTORY_SEPARATOR,$app_tmplt_arr);
			}
		}
		
		unset($app_runtime_path,$app_tmplt_path);
	}

/**
	*功能:拷贝文件夹
	*参数:$src 需要拷贝的文件夹绝对路径
	*	  $dst 目标拷贝的文件夹绝对路径
	*返回:无
	*/
	public function copy_dir($src,$dst,$app_tmplt_arr=array()) {
		$dir = opendir($src);
		@mkdir($dst);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($src.$file) ) {
					$this->copy_dir($src.$file.DIRECTORY_SEPARATOR,$dst.$file.DIRECTORY_SEPARATOR,$app_tmplt_arr);
					continue;
				}else{
					if ($app_tmplt_arr){
						$html_content=file_get_contents($src.$file);
						//echo $file.'#<br/>';
						foreach ($app_tmplt_arr as $key=>$val){
							//echo $key.'<br/>';
							$html_content=str_replace('{'.$key.'}', $val, $html_content);
						}
						file_put_contents($dst.$file, $html_content);
					}else{
						copy($src.$file,$dst.$file);
					}
				}
			}
		}
		closedir($dir);
	}

/**
 *功能:删除文件夹
 *参数:$dir 需要删除的文件夹绝对路径
 *返回:无
 */
	public function remove_directory($dir){
		if($handle=opendir("$dir")){
			while(false!==($item=readdir($handle))){
				if($item!="."&&$item!=".."){
					if(is_dir($dir.DIRECTORY_SEPARATOR.$item)){
						$this->remove_directory($dir.DIRECTORY_SEPARATOR.$item);
					}else{
						unlink($dir.DIRECTORY_SEPARATOR.$item);
					}
				}
			}
			closedir($handle);
			rmdir($dir);
		}
	}
	
}