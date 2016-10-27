<?php

//     _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _
//   / | Kodlayan  : Ramazan ŞAHİN - GÜMÜŞHANE/TÜRKİYE | \
//  <> | Proje     : Template Engine - Tema Motoru     | <>
//   \ | E-Posta   : tiyse@outlook.com                 | /
//     ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯ ¯

class tiyse {
	// template
	function draw($draw,$cachetime = 0){
		ob_start("ob_gzhandler");
		include $_SERVER["DOCUMENT_ROOT"].'/templates/Default/'.$draw.'.tpl';
		$template = ob_get_contents();
		ob_end_clean();
		# {value}
		$template = preg_replace_callback('#\{(.*?)}#msi', function($matches){
			if(isset($this->assign[$matches[0]])){ return $this->assign[$matches[0]]; }else{ return $matches[0]; }
		},$template);
		# {function="value()"}
		$template = preg_replace_callback('#\{function="(.*?)\((.*?)\)"\}#msi',function($matches){
			if(is_callable($matches[1])){ return "<?php echo $matches[1]($matches[2]); ?>"; }else{ return $matches[0]; }
		},$template);
		# {include="file"}
		$template = preg_replace_callback('#\{include="(.*?)"\}#msi',function($matches){
			$include = $_SERVER["DOCUMENT_ROOT"]."/templates/Default/".$matches[1].".tpl";
			if(file_exists($include)){ return file_get_contents($include); }else{ return $matches[0]; }
		},$template);
		# if elseif else endif
		$template = preg_replace_callback('#\{if="(.*?)"\}(.*?){/endif\}#msi',function($matches){
			$template = preg_replace_callback('#\{if="(.*?)"\}#msi',function($matches){
				$explode = explode(" ",$matches[1]);
				$if = '';
				foreach($explode as $exp){ if(isset($this->assign["{".$exp."}"])){ $if .= $this->assign["{".$exp."}"]; }else{ $if .= $exp; } }
				return "if($if): return ('";
			},$matches[0]);
			$template = preg_replace_callback('#\{elseif="(.*?)"\}#msi',function($matches){
				$explode = explode(" ",$matches[1]);
				$elseif = '';
				foreach($explode as $exp){ if(isset($this->assign["{".$exp."}"])){ $elseif .= $this->assign["{".$exp."}"]; }else{ $elseif .= $exp; } }
				return "'); elseif($elseif): return ('";
			},$template);
			$template = preg_replace_callback('#\{\/else\}#msi',function($matches){ return "'); else: return ('"; },$template);
			$template = preg_replace_callback('#\{\/endif\}#msi',function($matches){ return "'); endif;"; },$template);
			$template = preg_replace_callback('#\$(.*?)#msi',function($matches){ return "'); endif;"; },$template);
			return eval($template);
		},$template);
		# {loop="array"}{key}{value}{/loop}
		$template = preg_replace_callback('#\{loop="(.*?)"\}(.*?){\/loop\}#msi',function($matches){
			if(isset($this->assign["{".$matches[1]."}"])){
				$loop_result = '';
				foreach($this->assign["{".$matches[1]."}"] as $key => $value){
					$loop = preg_replace('{{key}}',$key,$matches[2]);
					$loop_result .= preg_replace('{{value}}',$value,$loop);
				}
				return $loop_result;
			}else{
				return $matches[0];
			}				
		}, $template);
		$template = preg_replace("/\s+/", " ",$template);
		$this->cache($cachetime,$template,$draw);
	}
	// value => item
	function assign($assign,$value){
		$this->assign[$assign] = $value;
	}
	// gzcompress & codecompress
	function cache($cachetime,$cache,$filename){
		$cachefile = $_SERVER['DOCUMENT_ROOT'].'/cache/'.sha1(md5($filename)).'.html';
		if(file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))){
			return eval("?>".gzuncompress(file_get_contents($cachefile))."<?php");
		}else{
			if($cachetime == 0){
				return eval("?>$cache<?");
			}else{
				if(!is_dir($_SERVER['DOCUMENT_ROOT'].'/cache/')){
					mkdir($_SERVER['DOCUMENT_ROOT'].'/cache/');
				}
				if(is_dir($_SERVER['DOCUMENT_ROOT'].'/cache/')){
					$compressed = gzcompress($cache, 9);
					$file = fopen($cachefile, "w");
					fwrite($file, $compressed);
					fclose($file);
				}
				return eval("?>$cache<?");
			}
		}
	}

}
?>