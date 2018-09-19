<?php
/*
 * Kodlayan  : Ramazan ŞAHİN - GÜMÜŞHANE/TÜRKİYE
 * Proje     : Template Engine - TEMA MOTORU
 * E-Posta   : tiyse@outlook.com
 * Version   : v.5.0.0
 */
class tiyse{
	function __construct($setting = null){
		if($setting == true){
			$this->setting = $setting;
		}else{
			$this->setting = array(
				'cache_dir'  => '/cache/',
				'tpl_dir'    => '/',
				'tpl_ext'    => 'tpl',
				'gzcompress' => true,
				'gzempty'    => true
			);
		}
		
	}
	function draw($draw){
		$tpl_file = $_SERVER["DOCUMENT_ROOT"].$this->setting["tpl_dir"].$draw.'.'.$this->setting["tpl_ext"];
		$sys_file = $_SERVER['DOCUMENT_ROOT'].$this->setting["cache_dir"].$draw.'_'.sha1(md5($draw)).'.php';
		ob_start();
		if(file_exists($tpl_file)){ include_once($tpl_file); }else{ echo "<code>Şablon mevcut değil: {$tpl_file}</code>"; }
		$template = ob_get_contents();
		ob_end_clean();
		//$template = addcslashes($template, "'");
		$template = preg_replace_callback('#\{\$(.*?)\}#msi', function($matches){
			return '<?php echo $'.$matches[1].'; ?>';
		},$template);
		$template = preg_replace_callback('#\{function="(.*?)\((.*?)\)"\}#msi',function($matches){ if(is_callable($matches[1])){ return "<?php echo $matches[1]($matches[2]); ?>"; }else{ return $matches[0]; } },$template);
		$template = preg_replace_callback('#\{loop="(.*?)"\}#msi',function($matches){ return '<?php foreach('.$matches[1].' as $key => $value){ ?>'; },$template);			
		$template = preg_replace_callback('#\{\break}#msi',function($matches){ return '<?php break; ?>'; },$template);
		$template = preg_replace_callback('#\{\continue}#msi',function($matches){ return '<?php continue; ?>'; },$template);
		$template = preg_replace_callback('#\{\/endloop}#msi',function($matches){ return '<?php } ?>'; },$template);
		$template = preg_replace_callback('#\{if="(.*?)"\}#msi',function($matches){ return '<?php if('.$matches[1].'){ ?>'; },$template);
		$template = preg_replace_callback('#\{elseif="(.*?)"\}#msi',function($matches){ return '<?php }else if('.$matches[1].'){ ?>'; },$template);
		$template = preg_replace_callback('#\{\/else}#msi',function($matches){ return '<?php }else{ ?>'; },$template);
		$template = preg_replace_callback('#\{\/endif\}#msi',function($matches){ return '<?php } ?>'; },$template);
		$template = preg_replace_callback('#\{include="(.*?)"\}#msi',function($matches){ $include = $_SERVER["DOCUMENT_ROOT"].$this->setting["tpl_dir"].$matches[1].'.'.$this->setting["tpl_ext"]; if(file_exists($include)){ return '<?php include_once("'.$include.'"); ?>'; }else{ return $matches[0]; } },$template);
		$template = ($this->setting["gzempty"] == true) ? preg_replace("/\s+/", " ",$template) : $template;
		if((strlen($template)+95) != @strlen(gzuncompress(file_get_contents($sys_file)))){ @unlink($sys_file); }
		$this->compiler($template,$draw);
		$this->cache($draw);
	}
	function assign($assign,$value = null){
		if(is_array($assign)){
			foreach($assign as $key => $value){
				$this->assign[$key] = $value;
			}
		}else{
			$this->assign[$assign] = $value;
		}
	}
	function compiler($template,$draw){
		$compilerfile = $_SERVER['DOCUMENT_ROOT'].$this->setting["cache_dir"].$draw.'_'.sha1(md5($draw)).'.php';
		if(!is_dir($_SERVER['DOCUMENT_ROOT'].$this->setting["cache_dir"])){
			$directory = mkdir($_SERVER['DOCUMENT_ROOT'].$this->setting["cache_dir"],0777,true);
			if($directory){
				echo "<code>Klasör mevcut değil: {$this->setting["cache_dir"]}</code>";
			}
		}
		if(is_dir($_SERVER['DOCUMENT_ROOT'].$this->setting["cache_dir"]) && !file_exists($compilerfile)){
			$secutiy = "<?php if(!defined('".sha1(md5($draw))."')) { die('Hacking attempt!'); } ?> ";
			$compressed = ($this->setting["gzcompress"] == true) ? gzcompress($secutiy.$template, 9) : $secutiy.$template;
			$file = fopen($compilerfile, "w");
			fwrite($file, $compressed);
			fclose($file);
		}
	}
	function cache($draw){
		$compilercache = $_SERVER['DOCUMENT_ROOT'].$this->setting["cache_dir"].$draw.'_'.sha1(md5($draw)).'.php';
		if(is_dir($_SERVER['DOCUMENT_ROOT'].$this->setting["cache_dir"]) && file_exists($compilercache)){
			define(sha1(md5($draw)),true);
			extract($this->assign);
			return ($this->setting["gzcompress"] == true) ? eval(" ?> ".gzuncompress(file_get_contents($compilercache))." <?php ") : eval(" ?> ".file_get_contents($compilercache)." <?php ");
		}
	}
}
?>
