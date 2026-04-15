<?php
/** Adminer - Compact database management
* @link https://www.adminer.org/
* @author Jakub Vrana, https://www.vrana.cz/
* @copyright 2007 Jakub Vrana
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 4.8.0
*/function
adminer_errors($_c,$Bc){return!!preg_match('~^(Trying to access array offset on value of type null|Undefined array key)~',$Bc);}error_reporting(6135);set_error_handler('adminer_errors',2);$Xc=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($Xc||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$Ei=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($Ei)$$X=$Ei;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection(){global$f;return$f;}function
adminer(){global$b;return$b;}function
version(){global$ia;return$ia;}function
idf_unescape($v){$me=substr($v,-1);return
str_replace($me.$me,$me,substr($v,1,-1));}function
escape_string($X){return
substr(q($X),1,-1);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes($pg,$Xc=false){if(function_exists("get_magic_quotes_gpc")&&get_magic_quotes_gpc()){while(list($z,$X)=each($pg)){foreach($X
as$ee=>$W){unset($pg[$z][$ee]);if(is_array($W)){$pg[$z][stripslashes($ee)]=$W;$pg[]=&$pg[$z][stripslashes($ee)];}else$pg[$z][stripslashes($ee)]=($Xc?$W:stripslashes($W));}}}}function
bracket_escape($v,$Ma=false){static$qi=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($v,($Ma?array_flip($qi):$qi));}function
min_version($Vi,$_e="",$g=null){global$f;if(!$g)$g=$f;$jh=$g->server_info;if($_e&&preg_match('~([\d.]+)-MariaDB~',$jh,$C)){$jh=$C[1];$Vi=$_e;}return(version_compare($jh,$Vi)>=0);}function
charset($f){return(min_version("5.5.3",0,$f)?"utf8mb4":"utf8");}function
script($uh,$pi="\n"){return"<script".nonce().">$uh</script>$pi";}function
script_src($Ji){return"<script src='".h($Ji)."'".nonce()."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($P){return
str_replace("\0","&#0;",htmlspecialchars($P,ENT_QUOTES,'utf-8'));}function
nl_br($P){return
str_replace("\n","<br>",$P);}function
checkbox($D,$Y,$cb,$je="",$qf="",$gb="",$ke=""){$I="<input type='checkbox' name='$D' value='".h($Y)."'".($cb?" checked":"").($ke?" aria-labelledby='$ke'":"").">".($qf?script("qsl('input').onclick = function () { $qf };",""):"");return($je!=""||$gb?"<label".($gb?" class='$gb'":"").">$I".h($je)."</label>":$I);}function
optionlist($wf,$ch=null,$Ni=false){$I="";foreach($wf
as$ee=>$W){$xf=array($ee=>$W);if(is_array($W)){$I.='<optgroup label="'.h($ee).'">';$xf=$W;}foreach($xf
as$z=>$X)$I.='<option'.($Ni||is_string($z)?' value="'.h($z).'"':'').(($Ni||is_string($z)?(string)$z:$X)===$ch?' selected':'').'>'.h($X);if(is_array($W))$I.='</optgroup>';}return$I;}function
html_select($D,$wf,$Y="",$pf=true,$ke=""){if($pf)return"<select name='".h($D)."'".($ke?" aria-labelledby='$ke'":"").">".optionlist($wf,$Y)."</select>".(is_string($pf)?script("qsl('select').onchange = function () { $pf };",""):"");$I="";foreach($wf
as$z=>$X)$I.="<label><input type='radio' name='".h($D)."' value='".h($z)."'".($z==$Y?" checked":"").">".h($X)."</label>";return$I;}function
select_input($Ha,$wf,$Y="",$pf="",$bg=""){$Uh=($wf?"select":"input");return"<$Uh$Ha".($wf?"><option value=''>$bg".optionlist($wf,$Y,true)."</select>":" size='10' value='".h($Y)."' placeholder='$bg'>").($pf?script("qsl('$Uh').onchange = $pf;",""):"");}function
confirm($Je="",$dh="qsl('input')"){return
script("$dh.onclick = function () { return confirm('".($Je?js_escape($Je):'Are you sure?')."'); };","");}function
print_fieldset($u,$re,$Yi=false){echo"<fieldset><legend>","<a href='#fieldset-$u'>$re</a>",script("qsl('a').onclick = partial(toggle, 'fieldset-$u');",""),"</legend>","<div id='fieldset-$u'".($Yi?"":" class='hidden'").">\n";}function
bold($Ta,$gb=""){return($Ta?" class='active $gb'":($gb?" class='$gb'":""));}function
odd($I=' class="odd"'){static$t=0;if(!$I)$t=-1;return($t++%2?$I:'');}function
js_escape($P){return
addcslashes($P,"\r\n'\\/");}function
json_row($z,$X=null){static$Yc=true;if($Yc)echo"{";if($z!=""){echo($Yc?"":",")."\n\t\"".addcslashes($z,"\r\n\t\"\\/").'": '.($X!==null?'"'.addcslashes($X,"\r\n\"\\/").'"':'null');$Yc=false;}else{echo"\n}\n";$Yc=true;}}function
ini_bool($Rd){$X=ini_get($Rd);return(preg_match('~^(on|true|yes)$~i',$X)||(int)$X);}function
sid(){static$I;if($I===null)$I=(SID&&!($_COOKIE&&ini_bool("session.use_cookies")));return$I;}function
set_password($Ui,$M,$V,$F){$_SESSION["pwds"][$Ui][$M][$V]=($_COOKIE["adminer_key"]&&is_string($F)?array(encrypt_string($F,$_COOKIE["adminer_key"])):$F);}function
get_password(){$I=get_session("pwds");if(is_array($I))$I=($_COOKIE["adminer_key"]?decrypt_string($I[0],$_COOKIE["adminer_key"]):false);return$I;}function
q($P){global$f;return$f->quote($P);}function
get_vals($G,$d=0){global$f;$I=array();$H=$f->query($G);if(is_object($H)){while($J=$H->fetch_row())$I[]=$J[$d];}return$I;}function
get_key_vals($G,$g=null,$mh=true){global$f;if(!is_object($g))$g=$f;$I=array();$H=$g->query($G);if(is_object($H)){while($J=$H->fetch_row()){if($mh)$I[$J[0]]=$J[1];else$I[]=$J[0];}}return$I;}function
get_rows($G,$g=null,$m="<p class='error'>"){global$f;$wb=(is_object($g)?$g:$f);$I=array();$H=$wb->query($G);if(is_object($H)){while($J=$H->fetch_assoc())$I[]=$J;}elseif(!$H&&!is_object($g)&&$m&&defined("PAGE_HEADER"))echo$m.error()."\n";return$I;}function
unique_array($J,$x){foreach($x
as$w){if(preg_match("~PRIMARY|UNIQUE~",$w["type"])){$I=array();foreach($w["columns"]as$z){if(!isset($J[$z]))continue
2;$I[$z]=$J[$z];}return$I;}}}function
escape_key($z){if(preg_match('(^([\w(]+)('.str_replace("_",".*",preg_quote(idf_escape("_"))).')([ \w)]+)$)',$z,$C))return$C[1].idf_escape(idf_unescape($C[2])).$C[3];return
idf_escape($z);}function
where($Z,$o=array()){global$f,$y;$I=array();foreach((array)$Z["where"]as$z=>$X){$z=bracket_escape($z,1);$d=escape_key($z);$I[]=$d.($y=="sql"&&is_numeric($X)&&preg_match('~\.~',$X)?" LIKE ".q($X):($y=="mssql"?" LIKE ".q(preg_replace('~[_%[]~','[\0]',$X)):" = ".unconvert_field($o[$z],q($X))));if($y=="sql"&&preg_match('~char|text~',$o[$z]["type"])&&preg_match("~[^ -@]~",$X))$I[]="$d = ".q($X)." COLLATE ".charset($f)."_bin";}foreach((array)$Z["null"]as$z)$I[]=escape_key($z)." IS NULL";return
implode(" AND ",$I);}function
where_check($X,$o=array()){parse_str($X,$ab);remove_slashes(array(&$ab));return
where($ab,$o);}function
where_link($t,$d,$Y,$sf="="){return"&where%5B$t%5D%5Bcol%5D=".urlencode($d)."&where%5B$t%5D%5Bop%5D=".urlencode(($Y!==null?$sf:"IS NULL"))."&where%5B$t%5D%5Bval%5D=".urlencode($Y);}function
convert_fields($e,$o,$L=array()){$I="";foreach($e
as$z=>$X){if($L&&!in_array(idf_escape($z),$L))continue;$Fa=convert_field($o[$z]);if($Fa)$I.=", $Fa AS ".idf_escape($z);}return$I;}function
adm_cookie($D,$Y,$ue=2592000){global$ba;return
header("Set-Cookie: $D=".urlencode($Y).($ue?"; expires=".gmdate("D, d M Y H:i:s",time()+$ue)." GMT":"")."; path=".preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]).($ba?"; secure":"")."; HttpOnly; SameSite=lax",false);}function
restart_session(){if(!ini_bool("session.use_cookies"))session_start();}function
stop_session($dd=false){$Mi=ini_bool("session.use_cookies");if(!$Mi||$dd){session_write_close();if($Mi&&@ini_set("session.use_cookies",false)===false)session_start();}}function&get_session($z){return$_SESSION[$z][DRIVER][SERVER][$_GET["username"]];}function
set_session($z,$X){$_SESSION[$z][DRIVER][SERVER][$_GET["username"]]=$X;}function
auth_url($Ui,$M,$V,$k=null){global$hc;preg_match('~([^?]*)\??(.*)~',remove_from_uri(implode("|",array_keys($hc))."|username|".($k!==null?"db|":"").session_name()),$C);return"$C[1]?".(sid()?SID."&":"").($Ui!="server"||$M!=""?urlencode($Ui)."=".urlencode($M)."&":"")."username=".urlencode($V).($k!=""?"&db=".urlencode($k):"").($C[2]?"&$C[2]":"");}function
is_ajax(){return($_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest");}function
adm_redirect($B,$Je=null){if($Je!==null){restart_session();$_SESSION["messages"][preg_replace('~^[^?]*~','',($B!==null?$B:$_SERVER["REQUEST_URI"]))][]=$Je;}if($B!==null){if($B=="")$B=".";header("Location: $B");exit;}}function
query_redirect($G,$B,$Je,$_g=true,$Gc=true,$Qc=false,$ci=""){global$f,$m,$b;if($Gc){$Bh=microtime(true);$Qc=!$f->query($G);$ci=format_time($Bh);}$xh="";if($G)$xh=$b->messageQuery($G,$ci,$Qc);if($Qc){$m=error().$xh.script("messagesPrint();");return
false;}if($_g)adm_redirect($B,$Je.$xh);return
true;}function
queries($G){global$f;static$ug=array();static$Bh;if(!$Bh)$Bh=microtime(true);if($G===null)return
array(implode("\n",$ug),format_time($Bh));$ug[]=(preg_match('~;$~',$G)?"DELIMITER ;;\n$G;\nDELIMITER ":$G).";";return$f->query($G);}function
apply_queries($G,$S,$Cc='table'){foreach($S
as$Q){if(!queries("$G ".$Cc($Q)))return
false;}return
true;}function
queries_redirect($B,$Je,$_g){list($ug,$ci)=queries(null);return
query_redirect($ug,$B,$Je,$_g,false,!$_g,$ci);}function
format_time($Bh){return
sprintf('%.3f s',max(0,microtime(true)-$Bh));}function
relative_uri(){return
str_replace(":","%3a",preg_replace('~^[^?]*/([^?]*)~','\1',$_SERVER["REQUEST_URI"]));}function
remove_from_uri($Mf=""){return
substr(preg_replace("~(?<=[?&])($Mf".(SID?"":"|".session_name()).")=[^&]*&~",'',relative_uri()."&"),0,-1);}function
pagination($E,$Nb){return" ".($E==$Nb?$E+1:'<a href="'.h(remove_from_uri("page").($E?"&page=$E".($_GET["next"]?"&next=".urlencode($_GET["next"]):""):"")).'">'.($E+1)."</a>");}function
get_file($z,$Vb=false){$Wc=$_FILES[$z];if(!$Wc)return
null;foreach($Wc
as$z=>$X)$Wc[$z]=(array)$X;$I='';foreach($Wc["error"]as$z=>$m){if($m)return$m;$D=$Wc["name"][$z];$ki=$Wc["tmp_name"][$z];$Bb=file_get_contents($Vb&&preg_match('~\.gz$~',$D)?"compress.zlib://$ki":$ki);if($Vb){$Bh=substr($Bb,0,3);if(function_exists("iconv")&&preg_match("~^\xFE\xFF|^\xFF\xFE~",$Bh,$Fg))$Bb=iconv("utf-16","utf-8",$Bb);elseif($Bh=="\xEF\xBB\xBF")$Bb=substr($Bb,3);$I.=$Bb."\n\n";}else$I.=$Bb;}return$I;}function
upload_error($m){$Ge=($m==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):0);return($m?'Unable to upload a file.'.($Ge?" ".sprintf('Maximum allowed file size is %sB.',$Ge):""):'File does not exist.');}function
repeat_pattern($Yf,$se){return
str_repeat("$Yf{0,65535}",$se/65535)."$Yf{0,".($se%65535)."}";}function
is_utf8($X){return(preg_match('~~u',$X)&&!preg_match('~[\0-\x8\xB\xC\xE-\x1F]~',$X));}function
shorten_utf8($P,$se=80,$Ih=""){if(!preg_match("(^(".repeat_pattern("[\t\r\n -\x{10FFFF}]",$se).")($)?)u",$P,$C))preg_match("(^(".repeat_pattern("[\t\r\n -~]",$se).")($)?)",$P,$C);return
h($C[1]).$Ih.(isset($C[2])?"":"<i>…</i>");}function
format_number($X){return
strtr(number_format($X,0,".",','),preg_split('~~u','0123456789',-1,PREG_SPLIT_NO_EMPTY));}function
friendly_url($X){return
preg_replace('~[^a-z0-9_]~i','-',$X);}function
hidden_fields($pg,$Gd=array(),$hg=''){$I=false;foreach($pg
as$z=>$X){if(!in_array($z,$Gd)){if(is_array($X))hidden_fields($X,array(),$z);else{$I=true;echo'<input type="hidden" name="'.h($hg?$hg."[$z]":$z).'" value="'.h($X).'">';}}}return$I;}function
hidden_fields_get(){echo(sid()?'<input type="hidden" name="'.session_name().'" value="'.h(session_id()).'">':''),(SERVER!==null?'<input type="hidden" name="'.DRIVER.'" value="'.h(SERVER).'">':""),'<input type="hidden" name="username" value="'.h($_GET["username"]).'">';}function
table_status1($Q,$Rc=false){$I=table_status($Q,$Rc);return($I?$I:array("Name"=>$Q));}function
column_foreign_keys($Q){global$b;$I=array();foreach($b->foreignKeys($Q)as$q){foreach($q["source"]as$X)$I[$X][]=$q;}return$I;}function
enum_input($T,$Ha,$n,$Y,$wc=null){global$b;preg_match_all("~'((?:[^']|'')*)'~",$n["length"],$Be);$I=($wc!==null?"<label><input type='$T'$Ha value='$wc'".((is_array($Y)?in_array($wc,$Y):$Y===0)?" checked":"")."><i>".'empty'."</i></label>":"");foreach($Be[1]as$t=>$X){$X=stripcslashes(str_replace("''","'",$X));$cb=(is_int($Y)?$Y==$t+1:(is_array($Y)?in_array($t+1,$Y):$Y===$X));$I.=" <label><input type='$T'$Ha value='".($t+1)."'".($cb?' checked':'').'>'.h($b->editVal($X,$n)).'</label>';}return$I;}function
input($n,$Y,$s){global$U,$b,$y;$D=h(bracket_escape($n["field"]));echo"<td class='function'>";if(is_array($Y)&&!$s){$Da=array($Y);if(version_compare(PHP_VERSION,5.4)>=0)$Da[]=JSON_PRETTY_PRINT;$Y=call_user_func_array('json_encode',$Da);$s="json";}$Jg=($y=="mssql"&&$n["auto_increment"]);if($Jg&&!$_POST["save"])$s=null;$ld=(isset($_GET["select"])||$Jg?array("orig"=>'original'):array())+$b->editFunctions($n);$Ha=" name='fields[$D]'";if($n["type"]=="enum")echo
h($ld[""])."<td>".$b->editInput($_GET["edit"],$n,$Ha,$Y);else{$vd=(in_array($s,$ld)||isset($ld[$s]));echo(count($ld)>1?"<select name='function[$D]'>".optionlist($ld,$s===null||$vd?$s:"")."</select>".on_help("getTarget(event).value.replace(/^SQL\$/, '')",1).script("qsl('select').onchange = functionChange;",""):h(reset($ld))).'<td>';$Td=$b->editInput($_GET["edit"],$n,$Ha,$Y);if($Td!="")echo$Td;elseif(preg_match('~bool~',$n["type"]))echo"<input type='hidden'$Ha value='0'>"."<input type='checkbox'".(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?" checked='checked'":"")."$Ha value='1'>";elseif($n["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$n["length"],$Be);foreach($Be[1]as$t=>$X){$X=stripcslashes(str_replace("''","'",$X));$cb=(is_int($Y)?($Y>>$t)&1:in_array($X,explode(",",$Y),true));echo" <label><input type='checkbox' name='fields[$D][$t]' value='".(1<<$t)."'".($cb?' checked':'').">".h($b->editVal($X,$n)).'</label>';}}elseif(preg_match('~blob|bytea|raw|file~',$n["type"])&&ini_bool("file_uploads"))echo"<input type='file' name='fields-$D'>";elseif(($ai=preg_match('~text|lob|memo~i',$n["type"]))||preg_match("~\n~",$Y)){if($ai&&$y!="sqlite")$Ha.=" cols='50' rows='12'";else{$K=min(12,substr_count($Y,"\n")+1);$Ha.=" cols='30' rows='$K'".($K==1?" style='height: 1.2em;'":"");}echo"<textarea$Ha>".h($Y).'</textarea>';}elseif($s=="json"||preg_match('~^jsonb?$~',$n["type"]))echo"<textarea$Ha cols='50' rows='12' class='jush-js'>".h($Y).'</textarea>';else{$Ie=(!preg_match('~int~',$n["type"])&&preg_match('~^(\d+)(,(\d+))?$~',$n["length"],$C)?((preg_match("~binary~",$n["type"])?2:1)*$C[1]+($C[3]?1:0)+($C[2]&&!$n["unsigned"]?1:0)):($U[$n["type"]]?$U[$n["type"]]+($n["unsigned"]?0:1):0));if($y=='sql'&&min_version(5.6)&&preg_match('~time~',$n["type"]))$Ie+=7;echo"<input".((!$vd||$s==="")&&preg_match('~(?<!o)int(?!er)~',$n["type"])&&!preg_match('~\[\]~',$n["full_type"])?" type='number'":"")." value='".h($Y)."'".($Ie?" data-maxlength='$Ie'":"").(preg_match('~char|binary~',$n["type"])&&$Ie>20?" size='40'":"")."$Ha>";}echo$b->editHint($_GET["edit"],$n,$Y);$Yc=0;foreach($ld
as$z=>$X){if($z===""||!$X)break;$Yc++;}if($Yc)echo
script("mixin(qsl('td'), {onchange: partial(skipOriginal, $Yc), oninput: function () { this.onchange(); }});");}}function
process_input($n){global$b,$l;$v=bracket_escape($n["field"]);$s=$_POST["function"][$v];$Y=$_POST["fields"][$v];if($n["type"]=="enum"){if($Y==-1)return
false;if($Y=="")return"NULL";return+$Y;}if($n["auto_increment"]&&$Y=="")return
null;if($s=="orig")return(preg_match('~^CURRENT_TIMESTAMP~i',$n["on_update"])?idf_escape($n["field"]):false);if($s=="NULL")return"NULL";if($n["type"]=="set")return
array_sum((array)$Y);if($s=="json"){$s="";$Y=json_decode($Y,true);if(!is_array($Y))return
false;return$Y;}if(preg_match('~blob|bytea|raw|file~',$n["type"])&&ini_bool("file_uploads")){$Wc=get_file("fields-$v");if(!is_string($Wc))return
false;return$l->quoteBinary($Wc);}return$b->processInput($n,$Y,$s);}function
fields_from_edit(){global$l;$I=array();foreach((array)$_POST["field_keys"]as$z=>$X){if($X!=""){$X=bracket_escape($X);$_POST["function"][$X]=$_POST["field_funs"][$z];$_POST["fields"][$X]=$_POST["field_vals"][$z];}}foreach((array)$_POST["fields"]as$z=>$X){$D=bracket_escape($z,1);$I[$D]=array("field"=>$D,"privileges"=>array("insert"=>1,"update"=>1),"null"=>1,"auto_increment"=>($z==$l->primary),);}return$I;}function
search_tables(){global$b,$f;$_GET["where"][0]["val"]=$_POST["query"];$fh="<ul>\n";foreach(table_status('',true)as$Q=>$R){$D=$b->tableName($R);if(isset($R["Engine"])&&$D!=""&&(!$_POST["tables"]||in_array($Q,$_POST["tables"]))){$H=$f->query("SELECT".limit("1 FROM ".table($Q)," WHERE ".implode(" AND ",$b->selectSearchProcess(fields($Q),array())),1));if(!$H||$H->fetch_row()){$lg="<a href='".h(ME."select=".urlencode($Q)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>$D</a>";echo"$fh<li>".($H?$lg:"<p class='error'>$lg: ".error())."\n";$fh="";}}}echo($fh?"<p class='message'>".'No tables.':"</ul>")."\n";}function
dump_headers($Dd,$Re=false){global$b;$I=$b->dumpHeaders($Dd,$Re);$If=$_POST["output"];if($If!="text")header("Content-Disposition: attachment; filename=".$b->dumpFilename($Dd).".$I".($If!="file"&&preg_match('~^[0-9a-z]+$~',$If)?".$If":""));session_write_close();ob_flush();flush();return$I;}function
dump_csv($J){foreach($J
as$z=>$X){if(preg_match('~["\n,;\t]|^0|\.\d*0$~',$X)||$X==="")$J[$z]='"'.str_replace('"','""',$X).'"';}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$J)."\r\n";}function
apply_sql_function($s,$d){return($s?($s=="unixepoch"?"DATETIME($d, '$s')":($s=="count distinct"?"COUNT(DISTINCT ":strtoupper("$s("))."$d)"):$d);}function
get_temp_dir(){$I=ini_get("upload_tmp_dir");if(!$I){if(function_exists('sys_get_temp_dir'))$I=sys_get_temp_dir();else{$p=@tempnam("","");if(!$p)return
false;$I=dirname($p);unlink($p);}}return$I;}function
file_open_lock($p){$r=@fopen($p,"r+");if(!$r){$r=@fopen($p,"w");if(!$r)return;chmod($p,0660);}flock($r,LOCK_EX);return$r;}function
file_write_unlock($r,$Pb){rewind($r);fwrite($r,$Pb);ftruncate($r,strlen($Pb));flock($r,LOCK_UN);fclose($r);}function
password_file($h){$p=get_temp_dir()."/adminer.key";$I=@file_get_contents($p);if($I||!$h)return$I;$r=@fopen($p,"w");if($r){chmod($p,0660);$I=rand_string();fwrite($r,$I);fclose($r);}return$I;}function
rand_string(){return
md5(uniqid(mt_rand(),true));}function
select_value($X,$A,$n,$bi){global$b;if(is_array($X)){$I="";foreach($X
as$ee=>$W)$I.="<tr>".($X!=array_values($X)?"<th>".h($ee):"")."<td>".select_value($W,$A,$n,$bi);return"<table cellspacing='0'>$I</table>";}if(!$A)$A=$b->selectLink($X,$n);if($A===null){if(is_mail($X))$A="mailto:$X";if(is_url($X))$A=$X;}$I=$b->editVal($X,$n);if($I!==null){if(!is_utf8($I))$I="\0";elseif($bi!=""&&is_shortable($n))$I=shorten_utf8($I,max(0,+$bi));else$I=h($I);}return$b->selectVal($I,$A,$n,$X);}function
is_mail($tc){$Ga='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$gc='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';$Yf="$Ga+(\\.$Ga+)*@($gc?\\.)+$gc";return
is_string($tc)&&preg_match("(^$Yf(,\\s*$Yf)*\$)i",$tc);}function
is_url($P){$gc='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';return
preg_match("~^(https?)://($gc?\\.)+$gc(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i",$P);}function
is_shortable($n){return
preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~',$n["type"]);}function
count_rows($Q,$Z,$Zd,$od){global$y;$G=" FROM ".table($Q).($Z?" WHERE ".implode(" AND ",$Z):"");return($Zd&&($y=="sql"||count($od)==1)?"SELECT COUNT(DISTINCT ".implode(", ",$od).")$G":"SELECT COUNT(*)".($Zd?" FROM (SELECT 1$G GROUP BY ".implode(", ",$od).") x":$G));}function
slow_query($G){global$b,$mi,$l;$k=$b->database();$di=$b->queryTimeout();$rh=$l->slowQuery($G,$di);if(!$rh&&support("kill")&&is_object($g=connect())&&($k==""||$g->select_db($k))){$he=$g->result(connection_id());echo'<script',nonce(),'>
var timeout = setTimeout(function () {
	ajax(\'',js_escape(ME),'script=kill\', function () {
	}, \'kill=',$he,'&token=',$mi,'\');
}, ',1000*$di,');
</script>
';}else$g=null;ob_flush();flush();$I=@get_key_vals(($rh?$rh:$G),$g,false);if($g){echo
script("clearTimeout(timeout);");ob_flush();flush();}return$I;}function
get_token(){$xg=rand(1,1e6);return($xg^$_SESSION["token"]).":$xg";}function
verify_token(){list($mi,$xg)=explode(":",$_POST["token"]);return($xg^$_SESSION["token"])==$mi;}function
lzw_decompress($Qa){$dc=256;$Ra=8;$ib=array();$Lg=0;$Mg=0;for($t=0;$t<strlen($Qa);$t++){$Lg=($Lg<<8)+ord($Qa[$t]);$Mg+=8;if($Mg>=$Ra){$Mg-=$Ra;$ib[]=$Lg>>$Mg;$Lg&=(1<<$Mg)-1;$dc++;if($dc>>$Ra)$Ra++;}}$cc=range("\0","\xFF");$I="";foreach($ib
as$t=>$hb){$sc=$cc[$hb];if(!isset($sc))$sc=$jj.$jj[0];$I.=$sc;if($t)$cc[]=$jj.$sc[0];$jj=$sc;}return$I;}function
on_help($pb,$oh=0){return
script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $pb, $oh) }, onmouseout: helpMouseout});","");}function
edit_form($Q,$o,$J,$Hi){global$b,$y,$mi,$m;$Nh=$b->tableName(table_status1($Q,true));page_header(($Hi?'Edit':'Insert'),$m,array("select"=>array($Q,$Nh)),$Nh);$b->editRowPrint($Q,$o,$J,$Hi);if($J===false)echo"<p class='error'>".'No rows.'."\n";echo'<form action="" method="post" enctype="multipart/form-data" id="form">
';if(!$o)echo"<p class='error'>".'You have no privileges to update this table.'."\n";else{echo"<table cellspacing='0' class='layout'>".script("qsl('table').onkeydown = editingKeydown;");foreach($o
as$D=>$n){echo"<tr><th>".$b->fieldName($n);$Wb=$_GET["set"][bracket_escape($D)];if($Wb===null){$Wb=$n["default"];if($n["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$Wb,$Fg))$Wb=$Fg[1];}$Y=($J!==null?($J[$D]!=""&&$y=="sql"&&preg_match("~enum|set~",$n["type"])?(is_array($J[$D])?array_sum($J[$D]):+$J[$D]):(is_bool($J[$D])?+$J[$D]:$J[$D])):(!$Hi&&$n["auto_increment"]?"":(isset($_GET["select"])?false:$Wb)));if(!$_POST["save"]&&is_string($Y))$Y=$b->editVal($Y,$n);$s=($_POST["save"]?(string)$_POST["function"][$D]:($Hi&&preg_match('~^CURRENT_TIMESTAMP~i',$n["on_update"])?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(!$_POST&&!$Hi&&$Y==$n["default"]&&preg_match('~^[\w.]+\(~',$Y))$s="SQL";if(preg_match("~time~",$n["type"])&&preg_match('~^CURRENT_TIMESTAMP~i',$Y)){$Y="";$s="now";}input($n,$Y,$s);echo"\n";}if(!support("table"))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",$b->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($o){echo"<input type='submit' value='".'Save'."'>\n";if(!isset($_GET["select"])){echo"<input type='submit' name='insert' value='".($Hi?'Save and continue edit':'Save and insert next')."' title='Ctrl+Shift+Enter'>\n",($Hi?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".'Saving'."…', this); };"):"");}}echo($Hi?"<input type='submit' name='delete' value='".'Delete'."'>".confirm()."\n":($_POST||!$o?"":script("focus(qsa('td', qs('#form'))[1].firstChild);")));if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo'<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="',$mi,'">
</form>
';}if(isset($_GET["file"])){if($_SERVER["HTTP_IF_MODIFIED_SINCE"]){header("HTTP/1.1 304 Not Modified");exit;}header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: immutable");if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
lzw_decompress("\0\0\0` \0\84\0\n @\0\B4C\84\E8\"\0`E\E3Q\B8\E0\01\FF\1F\87\3F\C0\06\12\74\76\4D\27\94\4A\64\C1\19\64\5C\5C\02\13\19\8C\62\30\5C\30\08\C4\5C\22\13\99\C0\66\D3\88\A4\EE\73\35\9B\CF\E7\D1\41\9D\16\58\11\08\50\02\61\11\08\4A\93\30\18\84\A5\91\1A\38\84\23\52\8A\54\A9\91\7A\60\88\23\2E\A9
\C7\63\ED\58\C3\FE\C8\80\3F\C0\2D\0F\5C\30\05\A1\49\6D\3F\A0\2E\16\AB\4D\B6\16\80\5C\30\C8\AF\12\28\CC\89\FD\1E\C0\02\2F\28\1B\25\8C\5C\30\22\29\3B\7D\65\6C\73\65\69\66\28\24\5F\47\45\54\5B\22\66\69\6C\65\22\5D\3D\3D\22\64\65\66\61\75\6C\74
\2E\63\73\73\22\29\7B\68\65\61\64\65\72\28\22\43\6F\6E\74\65\6E\74\2D\54\79\70\65\3A\20\74\65\78\74\2F\63\73\73\3B\20\63\68\61\72\73\65\74\3D\75\74\66\2D\38\22\29\3B\65\63\68\6F\0A\6C\7A\77\5F\64\65\63\6F\6D\70\72\65\73\73\28\22\5C\6E\31\1B
\CC\87\93\D9\8C\DE\6C\37\9C\87\42\31\84\34\76\62\30\98\CD\66\73\91\BC\EA\6E\32\42\CC\D1\B1\D9\98\DE\6E\3A\0E\87\23\01\28\BC\62\2E\19\5C\72\44\05\63\29\C8\C8\61\37\18\45\84\13\91\A4\C2\6C\16\12\0C\A6\C3\B1\94\E8\69\31\CC\8E\73\03\98\B4\E7\2D
\34\99\87\66\D3\09\C8\CE\69\37\0E\86\03\B3\B9\A4\C8\74\34\0E\85\A6\D3\79\E8\5A\66\34\9D\05\B0\69\01\96\41\54\AB\56\07\56\0B\15\90\E9\66\3A\0E\CF\A6\18\2C\1E\12\3A\31\1B\0E\A6\51\DD\BC\F1\62\32\19\60\C7\23\0C\FE\3E\3A\37\47\EF\97\31\D1\D8\D2
\73\B0\99\4C\97\58\44\2A\62\76\3C\DC\8C\23\A3\65\40\D6\3A\34\1B\E7\A7\21\66\6F\1D\90\B7\C6\74\3A\3C\A5\DC\E5\92\BE\99\6F\E2\DC\0E\0F\5C\6E\69\C3\C5\F0\27\2C\E9\BB\16\61\17\5F\A4\3A\B9\69\EF\85\B4\C1\42\76\F8\7C\4E\FB\34\2E\35\1D\4E\66\81\69
\A2\76\70\D0\68\B8\B0\6C\A8\EA\A1\D6\9A\DC\4F\A6\81\89\EE\3D\20\A3\1A\4F\46\51\D0\C4\6B\5C\24\A5\D3\69\F5\1A\99\C0\C2\64\32\54\0C\E3\A1\70\E0\CA\36\84\01\8B\FE\87\A1\2D\D8\5A\80\8E\83\A0\DE\36\BD\A3\80\F0\10\0E\68\3A\AC\10\04\61\CC\2C\8E\A3
\EB\10\EE\32\8D\23\38\D0\90\B1\23\92\98\36\07\6E\E2\EE\11\86\F1\4A\1E\88\A2\68\AB\74\85\8C\B1\8A\E4\34\06\4F\34\32\F4\BD\6F\6B\DE\12\BE\2A\72\A0\A9\04\01\80\40\19\06\10\70\40\16\86\21\C4\1C\1D\BE\CF\C3\F4\FE\3F\D0\04\04\36\C0\89\72\5B\03\8D
\F0\4C\17\06\C1\F0\8B\3A\32\42\88\6A\A7\13\21\48\62\1C\F3\C3\50\E4\3D\10\21\31\1C\56\89\5C\22\88\B2\30\85\BF\5C\6E\53\C6\19\C6\CF\44\37\0E\C3\EC\44\DA\9B\C3\0F\43\21\1C\86\21\9B\E0\A6\47\CA\8C\A7\20\C8\2B\92\3D\11\0F\74\43\E6\A9\2E\43\A4\C0
\3A\0C\2B\C8\CA\3D\AA\AA\BA\B2\18\A1\B1\E5\25\1F\AA\63\ED\31\4D\52\2F\94\7F\45\C8\92\34\84\A9\A0\32\B0\E4\B1\A0\E3\60\C2\38\28\E1\D3\B9\5B\57\0B\E4\D1\1C\3D\89\1C\79\53\0C\81\62\B0\3D\D6\2D\DC\B9\08\42\53\04\2B\0B\C9\AF\C8\DC\FD\A5\0F\F8\40
\17\06\70\1D\4C\34\59\11\64\E3\17\84\71\8A\F8\E3\A6\F0\EA\A2\36\0C\A3\33\C4\AC\0C\AF\B8\41\63\DC\8C\E8\CE\A8\8C\6B\82\5B\26\3E\F6\95\A8\19\5A\C1\70\6B\6D\5D\97\75\2D\63\3A\D8\15\B8\88\4E\11\74\E6\11\CE\B4\70\D2\9D\8C\8A\38\E8\3D\BF\23\98\E1
\5B\0F\2E\F0\DC\DE\AF\8D\1A\7E\A0\8D\81\6D\CB\79\87\50\50\E1\7C\49\D6\9B\F9\7F\C0\0F\EC\07\51\AA\39\76\5B\96Q\95\84\5C\6E\96\D9\72\F4\27\67\87\2B\90\E1\54\D1\32\85\AD\56\C1\F5\7A\E4\34\8D\A3\38\F7\8F\28\09\BE\45\79\2A\23\6A\AC\32\5D\12\AD\95\52\D2\C1\06\91\A5\29\83\C0\5B\4E\AD\52\5C\24\8A\3C\3E\3A\F3\AD\3E\5C\24\3B\14\96\3E\A0\CC\5C\72\BB\84\CE\48
\CD\C3\19\54\C8\5C\6E\07\77\A1\4E\20\E5\77\D8\A3\A6\EC\3C\EF\0E\CB\47\77\E0\F6\F6\15\B9\5C\5C\59\F3\5F\A0\52\74\5E\8C\3E\8E\5C\72\7D\8C\D9\53\5C\72\7A\E9\34\3D\B5\5C\6E\4C\94\25\4A\E3\13\8B\5C\22\2C\5A\A0\38\0E\B8\9E\99\90\69\F7\30\75\A9\3F
\1A\A8\FB\D1\F4\A1\73\02\33\0C\23\A8\D9\89\A0\3A\F3\A6\FB\8D\E3\BD\96\18\C8\DE\04\1F\14\45\5D\78\DD\D2\0E\81\73\5E\38\8E\A3\4B\5E\C9\F7\2A\30\D1\DE\77\DE\14\03\E0\C8\DE\7E\8F\E3\F6\3A\ED\D1\69\D8\FE\8F\76\32\77\BD\FF\B1\07\FB\5E\37\90\17\0E
\E3\08\F2\37\A3\63\DD\D1\75\2B\55\02\1B\25\8E\03\7B\50\DC\2A\34\CC\BC\E9\4C\58\2E\2F\21\BC\89\31\43\1E\C5\DF\71\78\21\04\48\B9\02\E3\46\64\08\F9\AD\4C\A8\A4\1B\A8\12\C4\A0\CF\60\36\06\EB\0C\E8\07\35\AE\1A\1A\99\66\05\80\B8\C4\86\A8\3D\07\48
\F8\6C\20\8C\56\04\31\93\9B\5C\30\61\32\D7\3B\81\D4\36\86\E0\F6\FE\5F\D9\87\7F\C4\1E\5C\30\26\F4\5A\DC\53\A0\64\29\4B\45\27\92\80\6E\B5\90\12\0F\5B\0B\58\A9\B3\5C\30\5A\C9\8A\D4\46\5B\50\91\DE\98\40\E0\DF\21\19\89\0E\F1\59\C2\2C\60\C9\15\5C
\22\DA\B7\05\81\C2\30\45\65\39\08\0B\79\46\3E\CB\D4\1D\39\18\03\18\62\BA\96\8C\E6\46\35\3A\14\FC\88\94\5C\30\7D\05\C4\B4\8A\87\28\5C\24\0E\9E\D3\08\87\EB\80\33\37\48\F6\1C\A3\E8\20\0C\4D\BE\41\B0\B2\36\52\95\FA\7B\4D\71\DD\37\47\A0\DA\19\43
\99\43\0C\EA\6D\32\03\A2\28\8C\43\74\3E\5B\EC\2D\74\C0\19\2F\26\43\0C\9B\5D\EA\65\74\47\F4\CC\AC\1C\34\40\04\72\3E\06\C7\C2\13\08\E5\3C\9A\53\71\11\95\2F\E5\FA\94\51\EB\8D\68\6D\8D\9A\C0\D0\C6\F4\E3\F4\9D\4C\C0\DC\23\10\E8\F4\4B\CB\7C\AE\99
\84\36\66\4B\50\DD\5C\72\25\74\D4\08\D3\56\3D\06\5C\22\A0\53\48\5C\24\9D\7D\20\B8\81\29\77\A1\2C\57\5C\30\46\06\B3\AA\75\40\D8\62\0B\A6\39\82\5C\72\72\B0\32\C3\23\AC\44\8C\94\58\83\B3\DA\79\4F\49\F9\3E\14\BB\85\6E\0B\81\86\C7\A2\7F\25\E3\F9
\90\27\8B\DD\5F\C1\80\74\5C\72\CF\84\7A\0C\C4\5C\5C\31\98\68\6C\BC\5D\51\35\4D\70\36\6B\86\D0\C4\71\68\C3\5C\24\A3\48\7E\06\CD\02\7C\D2\14\DD\21\2A\34\8C\F1\1C\10\F2\1C\14\DB\60\53\EB\FD\B2\53\20\74\ED\50\50\5C\5C\67\B1\E8\37\87\5C\6E\2D\07
\8A\3A\E8\A2\AA\70\B4\95\94\88\6C\8B\42\9E\A6\EE\94\37\D3\A8\1A\63\83\28\77\4F\30\5C\5C\3A\07\95\D0\77\94\C1\9D\0C\70\34\88\93\F2\7B\54\DA\FA\6A\4F\A4\04\36\06\48\1A\1C\C3\8A\B6\72\D5\12\A5\03\90\71\07\5C\6E\04\11\A6\C9\25\25\B6\79\27\5D\1B
\5C\24\82\94\61\91\5A\1D\D3\2E\66\63\D5\71\2A\2D\EA\46\57\BA\FA\6B\8D\84\7A\83\15\B0\B5\03\6A\91\1E\8E\B0\6C\67\E1\8C\3A\87\5C\24\5C\22\DE\4E\BC\5C\72\23\C9\64\E2\C3\82\C2\FF\01\D0\73\63\E1\AC\CC\A0\84\14\83\5C\22\6A\AA\5C\72\C0\B6\96\15\A6
\88\D5\92\BC\50\68\8B\31\2F\82\02\9C\44\01\41\29\06\A0\B2\DD\5B\C0\6B\6E\C1\70\37\05\36\C1\59\B4\89\52\7B\18\E1\4D\05\A4\50\FB\B0\F2\40\5C\6E\2D\B8\61\B7\36\FE\DF\5B\BB\7A\4A\01\48\2C\96\64\6C\14\A0\15\42\A3\68\90\6F\B3\8D\EC\1F\02\03\F2\1D
\AC\2B\87\23\44\72\5E\1F\B5\5E\B5\D9\65\9A\BC\45\BD\BD\96\06\20\C4\9C\61\50\89\F4\F5\4A\47\A3\7A\1A\E0\F1\74\0E\F1\A0\32\C7\58\D9\16\A2\B4\C1\BF\56\B6\D7\DF\E0\DE\19\C8\B3\13\89\D1\42\5F\25\4B\3D\45\A9\B8\62\7F\E5\BC\BE\DF\C2\A7\6B\55\28\2E
\21\07\DC\AE\38\B8\9C\FC\C9\0C\49\2E\40\8E\4B\CD\78\6E\FE\AC\FC\3A\C3\50\F3\0E\33\07\32\AB\94\6D\ED\48\09\09\43\2A\EC\3A\76\17\E2\54\C5\5C\6E\52\B9\83\95\B5\8B\0B\30\75\04\01\C2\ED\10\83\E6\1C\EE\D2\A7\5D\01\CE\1B\AF\98\8A\94\50\0B\2F\B5\4A
\51\64\A5\7B\4C\96\DE\B3\3A\59\C1\8F\32\62\BC\9C\54\20\F1\9D\CA\33\D3\34\86\97\E4\63\EA\A5\56\3D\90\BF\15\86\4C\34\1E\CE\D0\72\0C\C4\21\DF\42\03\F0\59\B3\36\0F\CD\19\AD\4D\65\4C\07\1D\1D\06\07\8A\AA\DC\1D\E7\9C\F6\F9\69\C0\6F\D0\39\3C\10\13
\20\47\94\A4\C6\95\D0\99\4D\08\1F\68\6D\5E\AF\55\DB\4E\C0\8C\B7\17\0B\F2\54\72\0B\35\48\69\4D\94\2F\AC\6E\83\ED\9D\B3\54\A0\8D\5B\2D\3C\5F\0E\5F\EE\33\2F\58\72\28\15\3C\87\AF\8A\86\05\AE\C9\F4\93\CC\0C\75\12\D2\96\47\0C\4E\58\32\06\30\E5\5C
\72\5C\24\5E\87\8D\3A\27\39\E8\B6\4F\85\ED\04\3B\D7\6B\8F\0F\03\BC\86\0C\B5\66\A0\96\4E\27\61\B6\94\06\C7\0E\AD\62\C5\2C\CB\56\A4\F4\85\AB\31\B5\EF\48\49\21\25\36\40\FA\08\CF\5C\24\D2\45\47\1C\DA\9C\AC\31\9D\28\6D\55\AA\E5\85\72\D5\BD\EF\03
\DF\E5\60\A1\D0\69\1E\4E\2B\12\08\C3\9C\F1\29\9A\9C\16\E4\30\6C\D8\D2\66\30\C3\06\BD\5B\55\E2\F8\56\CA\E8\2D\3A\49\5E\A0\98\5C\24\D8\73\AB\08\62\5C\72\65\87\91\14\75\67\C9\68\AA\7E\39\DB\DF\88\9D\62\98\B5\F4\C2\C8\66\E4\2B\30\AC\D4\20\1A\68
\58\72\DD\AC\A9\21\03\5C\24\97\65\2C\B1\77\2B\84\F7\8C\EB\8C\33\86\CC\5F\10\E2\41\85\6B\9A\F9\5C\6E\6B\C3\72\F5\CA\9B\63\19\75\0C\57\64\59\FF\5C\5C\D7\3D\7B\2E\F3\C4\8D\98\90\A2\16\67\BB\89\70\38\9C\74\5C\72\52\5A\BF\76\8D\4A\15\3A\B2\3E\FE
\A3\59\7C\2B\C5\40\C0\87\83\DB\03\43\90\74\5C\72\80\81\1A\6A\74\81\BD\12\36\B2\F0\1E\0B\25\C2\3F\03\E0\F4\C7\8E\F1\92\1E\3E\F9\2F\06\0B\A5\CD\C7\F0\CE\39\46\60\D7\95\E4\F2\76\11\7E\4B\A4\90\E1\F6\D1\52\D0\57\8B\F0\7A\91\0C\EA\6C\6D\AA\77\04
\4C\C7\39\59\95\2A\0C\71\AC\78\C4\7A\F1\E8\53\65\AE\DD\9B\B3\E8\F7\A3\7E\9A\44\1D\E0\CD\E1\96\F7\9D\78\98\BE\EB\C9\9F\69\37\95\32\1F\C4\F8\D1\4F\DD\BB\07\92\FB\5F\7B\F1\FA\35\33\E2\FA\74\90\98\9B\5F\9F\F5\7A\D4\33\F9\64\29\8B\43\AF\C2\5C\24
\3F\4B\D3\AA\50\81\25\CF\CF\54\26\FE\0C\98\26\5C\30\50\D7\4E\41\8E\5E\AD\7E\A2\83\A0\70\07\06\C6\05\20\F6\05\CF\9C\93\0F\D4\F5\5C\72\5C\24\DE\EF\D0\D6\EC\62\2A\2B\44\36\EA\B6\A6\CF\88\DE\ED\4A\5C\24\0E\28\C8\6F\6C\DE\CD\68\26\06\94\EC\4B\42
\53\06\3E\B8\8B\F6\3B\0E\7A\B6\A6\78\C5\6F\7A\3E\ED\9C\DA\10\0F\02\6F\C4\5A\F0\5C\6E\CA\8B\5B\05\CF\76\F5\82\CB\02\C8\9C\B5\B0\32\F5\4F\78\D9\90\56\F8\30\66\FB\80\FA\0F\AF\DE\32\42\6C\C9\62\6B\02\D0\36\5A\6B\B5\01\68\58\63\0E\64\EA\30\2A\C2
\4B\54\E2\AF\48\3D\AD\95\07\CF\80\91\70\30\8A\6C\10\56\E9\F5\0B\E8\E2\5C\72\08\BC\8C\A5\6E\8E\6D\A6\EF\29\28\8F\28\F4\3A\23\A6\8F\E2\F2\45\89\DC\3A\43\A8\43\E0\DA\0B\E2\0C\5C\72\A8\47\5C\72\C3\A9\0F\30\F7\0E\85\69\0E\E6\DA\0C\B0\FE\3A\60\5A
\31\51\5C\6E\3A\80\E0\5C\72\5C\30\E0\0B\E7\C8\0C\71\12\05\B1\17\11\B0\FC\3A\11\01\12\60\BF\11\11\2D\10\C8\4D\13\23\7D\12\31\3B\11\E8\FE\B9\8B\01\13\71\15\11\91\23\13\03\7C\0E\F1\53\11\80\BE\A2\68\6C\99\44\C4\06\5C\30\66\06\69\44\70\EB\0E\4C
\A0\8D\17\60\60\99\B0\E7\10\D1\30\79\80\DF\12\31\85\18\80\EA\5C\72\F1\3D\10\91\4D\12\51\5C\5C\0C\A4\B3\12\25\6F\18\71\96\AD\5C\30\D8\0B\F1\A3\12\31\A8\32\31\AC\7F\31\B0\AD\20\BF\18\B1\A7\1B\D1\9C\62\69\3A\93\ED\01\5C\72\B1\2F\15\D1\A2\9B\20
\60\07\29\9A\C4\30\F9\19\91\1B\18\40\BE\0E\C2\9B\15\B1\1B\1E\C3\49\1C\31\AB\1F\4E\14\E0\43\D8\E0\8A\B5\17\F1\4F\11\B1\A2\5A\F1\E3\18\31\8F\1E\B1\EF\19\71\31\20\F2\1D\15\D1\FC\E0\2C\E5\5C\72\64\49\1D\11\81\15\C7\A6\76\E4\6A\ED\82\31\17\20\74
\DA\42\F8\93\B0\E2\81\92\30\3A\85\30\0C\F0\F0\93\31\A0\41\32\56\84\F1\E2\30\A0\E9\1B\F1\8F\25\B2\66\0C\69\33\21\11\01\26\51\B7\1A\52\63\25\D2\71\26\12\77\25\D1\EC\5C\72\90\E0\56\C8\19\23\CA\F8\99\51\77\17\60\8B\1E\11\01\25\20\BE\84\D2\6D\2A
\72\85\10\D2\79\1C\12\7F\26\69\DF\2B\72\7B\2A\B2\BB\28\72\67\28\B1\23\28\32\AD\28\F0\E5\29\52\40\04\69\9B\2D\A0\8D\20\88\9E\95\31\5C\22\0F\5C\30\DB\1A\B2\52\8F\EA\FF\2E\12\65\2E\72\EB\1A\C4\13\2C\0C\A1\19\72\79\28\32\AA\43\E0\E8\B2\62\EC\21
\42\DE\8F\33\05\25\D2\B5\2C\52\BF\31\B2\C6\26\E8\FE\74\80\E4\62\E8\61\10\5C\72\4C\93\B3\2D\33\12\E1\13\A0\D6\0C\A0\F3\14\5C\30\E6\0B\F3\42\70\11\97\31\F1\39\34\B3\4F\27\52\B0\7F\33\2A\B2\B3\3D\5C\24\E0\5B\13\A3\5E\69\49\3B\2F\33\69\13\11\A9
\35\D2\0B\26\92\7D\1D\31\1B\37\B2\23\20\D1\B9\38\A0\BF\1B\5C\22\DF\37\D1\E5\38\11\F1\39\2A\D2\32\33\99\21\F3\8F\21\31\5C\5C\0E\5C\30\CF\38\93\AD\1E\72\6B\39\13\B1\3B\53\85\32\33\B6\0B\E0\DA\93\2A\D3\3A\71\5D\35\53\7F\3C\B3\C1\23\33\8D\38\33
\DD\13\23\08\0C\65\D1\3D\13\B9\3E\13\7E\39\53\E8\9E\B3\91\1D\72\D5\29\80\8C\08\54\05\2A\11\0C\61\13\9F\40\D1\96\D9\62\65\19\73\D9\1B\D4\15\1B\A3\3A\2D\F3\80\8F\E9\C7\1E\2A\3B\2C\A0\D8\99\33\12\21\69\B4\9B\91\4C\D2\B2\F0\0C\23\31\20\8D\2B\19
\6E\C0\20\AB\2A\B2\E3\40\B3\33\69\37\B4\17\1E\31\A9\0F\02\04\9E\B4\5F\10\13\95\46\91\53\3B\33\CF\46\B1\5C\72\41\AF\E9\12\33\F5\3E\B4\78\3A\83\20\5C\72\B3\30\CE\D4\40\92\2D\D4\2F\02\0E\AC\D3\77\15\D3\DB\37\F1\84\D3\53\91\4A\33\9B\20\E7\2E\46
\E9\5C\24\4F\A4\42\92\B1\97\25\34\A9\2B\74\C3\27\67\F3\4C\71\5C\72\4A\74\87\4A\F4\CB\4D\32\14\5C\72\F4\CD\37\F1\C6\06\54\40\93\A3\BE\29\02\E2\93\A3\64\8D\C9\32\7F\80\50\3E\CE\B0\0E\80\9D\46\69\E0\B2\B4\FE\5C\6E\72\5C\30\9E\13\12\B8\62\E7\19
\6B\28\B4\44\B6\BF\E3\4B\51\83\A4\B4\E3\1A\31\E3\5C\22\32\74\94\F4\F4\BA\50\14\E8\5C\72\C3\C0\2C\5C\24\4B\43\74\F2\35\F4\F6\23\F4\FA\29\A2\E1\50\23\03\50\69\10\2E\15\0C\CE\55\10\32\B5\15\43\E6\7E\DE\5C\22\E4\22\29\3B\7D\65\6C\73\65\69\66\28
\24\5F\47\45\54\5B\22\66\69\6C\65\22\5D\3D\3D\22\66\75\6E\63\74\69\6F\6E\73\2E\6A\73\22\29\7B\68\65\61\64\65\72\28\22\43\6F\6E\74\65\6E\74\2D\54\79\70\65\3A\20\74\65\78\74\2F\6A\61\76\61\73\63\72\69\70\74\3B\20\63\68\61\72\73\65\74\3D\75\74
\66\2D\38\22\29\3B\65\63\68\6F\0A\6C\7A\77\5F\64\65\63\6F\6D\70\72\65\73\73\28\22\66\3A\9B\8C\67\43\49\BC\DC\5C\6E\38\9C\C5\07\33\29\B0\CB\03\37\9C\85\86\38\31\D0\CA\78\3A\5C\6E\4F\67\23\29\D0\EA\72\37\5C\6E\5C\22\86\E8\B4\60\F8\7C\32\1B\CC
\67\53\69\96\48\29\17\1C\4E\A6\53\91\E4\A7\5C\72\87\9D\5C\22\30\B9\C4\40\E4\29\1D\9F\60\10\28\5C\24\1A\10\73\36\4F\21\D3\E8\9C\56\2F\19\3D\9D\8C\27\20\54\34\E6\3D\84\98\69\53\98\8D\36\49\4F\A0\47\23\D2\01\05\58\B7\56\17\43\8D\C6\73\A1\A0\5A
\31\2E\D0\68\70\38\2C\1E\B3\5B\A6\48\E4\B5\0B\14\7E\43\7A\A7\C9\E5\32\B9\6C\BE\63\33\9A\CD\E9\73\A3\91\04\D9\49\86\62\E2\34\5C\6E\14\06\E9\46\38\54\E0\86\1A\49\98\DD\1A\A9\55\2A\66\7A\B9\04\E4\72\30\9E\45\C6\13\81\C0\D8\79\14\1B\8E\B8\F1\66
\8E\59\2E\3A\1C\E6\14\83\49\8C\CA\28\18\D8\63\B7\E1\05\CE\8B\21\8D\5F\6C\99\ED\5E\B7\5E\28\B6\9A\4E\7B\53\96\93\29\72\CB\71\C1\59\93\96\6C\D9\A6\33\8A\33\DA\5C\6E\98\2B\47\A5\D3\EA\79\BA\ED\86\CB\69\B6\C2\EE\78\56\33\77\17\B3\75\14\68\E3\5E
\72\D8\C0\BA\1E\B4\61\DB\94\FA\B9\8D\63\D8\E8\5C\72\0E\93\A8\EB\28\2E\C2\88\BA\81\43\68\D2\3C\5C\72\29\08\E8\D1\A3\A1\60\E6\37\A3\ED\F2\34\33\27\6D\08\14\35\8C\A3\C8\15\5C\6E\81\50\DC\3A\32\A3\50\BB\AA\8E\8B\71\20\F2\FF\C5\43\93\7D\18\C4\AB
\88\FA\CA\C1\EA\33\38\8B\0E\42\18\D8\30\8E\68\52\1A\89\C8\72\28\9C\30\A5\A1\62\5C\5C\30\8C\48\72\34\34\8C\C1\42\1A\8D\21\A1\70\C7\5C\24\8E\72\5A\5A\1E\CB\32\DC\89\2E\C9\83\28\5C\5C\8E\35\C3\0B\7C\14\5C\6E\43\28\CE\5C\22\8F\03\80\50\13\85\02
\F0\F8\2E\0B\8D\D0\4E\15\CC\52\54\CA\15\CE\93\C0\E6\3E\04\81\48\4E\14\85\81\38\48\19\50\E1\5C\5C\AC\37\4A\08\70\7E\13\84\13\DC\FB\32\25\A1\D0\4F\43\A8\31\E3\2E\83\A7\43\38\CE\87\05\03\48\C8\F2\2A\88\6A\B0\85\04\E1\1C\F7\53\28\13\0C\B9\2F\0C
\A1\EC\AC\36\4B\55\9C\CA\1E\87\A1\3C\12\32\0C\89\70\4F\49\84\F4\D5\7F\60\8D\D4\E4\06\E2\B3\88\64\1D\4F\81\48\A0\DE\35\8D\2D\FC\C6\34\8C\E3\70\58\32\35\2D\D2\A2\F2\DB\88\B0\7A\37\0C\A3\B8\14\5C\22\0C\28\B0\50\A0\5C\5C\33\32\18\3A\5D\17\55\DA
\17\0C\E8\ED\E2\DF\85\21\5D\B8\3C\B7\41\DB\06\DB\A4\92\D0\DF\69\DA\B0\04\8B\6C\5C\72\D4\5C\30\76\B2\CE\23\4A\38\AB\CF\77\6D\9E\ED\0E\C9\A4\A8\3C\8A\C9\A0\E6\FC\25\6D\3B\70\16\23\E3\60\58\9D\44\8C\F8\F7\69\5A\8D\F8\4E\30\8C\90\95\C8\39\0B\F8
\A8\E5\8D\A0\C1\E8\60\13\85\8E\08\77\11\4A\8D\44\BF\7F\BE\32\D2\39\74\8C\A2\2A\1C\F8\CE\79\EC\CB\4E\69\49\68\5C\5C\39\C6\D5\E8\D0\3A\0E\83\80\E6\1D\05\E1\78\EF\AD\B5\79\6C\2A\9A\05\C8\88\CE\17\E6\59\A0\DC\17\87\F8\EA\38\92\57\B3\E2\3F\B5\8E
\81\DE\9B\33\0C\D9\F0\CA\21\5C\22\36\08\E5\9B\6E\5B\AC\CA\17\5C\72\AD\1C\2A\5C\24\0C\B6\C6\A7\BE\6E\7A\78\C6\39\5C\72\EC\7C\2A\33\D7\A3\70\DE\13\EF\BB\B6\9E\3A\0F\28\70\5C\5C\3B\D4\CB\6D\7A\1B\A2\FC\A7\12\39\F3\1C\D0\D1\C2\8C\FC\38\4E\18\85
\C1\90\6A\32\8D\BD\14\AB\CE\5C\72\C9\48\EE\17\0E\03\7F\48\26\8C\B2\28\C3\7A\84\C1\37\69\DB\6B\A3\20\8B\8A\A4\82\63\A4\8B\65\F2\9E\FD\A7\74\9C\CC\CC\32\3A\53\48\F3\C8\A0\C3\2F\29\96\78\DE\40\E9\E5\74\89\72\69\39\A5\BD\F5\EB\9C\38\CF\C0\CB\EF
\79\D2\B7\BD\B0\8E\56\C4\2B\5E\57\DA\A6\AD\AC\6B\5A\E6\59\97\6C\1B\15\0E\B7\CA\A3\81\0E\81\8C\34\03\D6\C8\C6\8B\AA\B6\05\C0\AC\14\82\F0\5C\5C\45\C8\7B\EE\37\5C\30\B9\70\86\12\80\95\01\44\02\80\84\69\94\2D\54\E6\FE\DA\FB\30\6C\B0\25\3D\C1\A0
\D0\16\CB\83\39\28\01\84\35\06\10\F0\5C\6E\19\5C\6E\80\0E\6E\2C\34\87\5C\30\E8\0F\61\19\06\7D\07\DC\83\2E\B0\F6\1F\52\73\EF\82\AA\5C\30\13\32\42\5C\5C\DB\62\31\9F\53\B1\5C\30\30\30\33\2C\D4\58\50\48\4A\73\04\70\E5\64\93\04\0C\4B\83\20\43\41
\21\B0\32\2A\57\9F\13\D4\F1\DA\32\5C\24\E4\2B\19\C2\66\5E\5C\6E\84\18\04\31\8C\81\B4\F2\7A\45\83\20\49\76\A4\5C\5C\E4\9C\32\C9\1B\03\A0\2E\2A\41\B0\99\94\14\45\1E\03\28\64\07\B1\E1\B0\C3\62\EA\1C\C2\DC\84\90\11\C6\39\87\82\E2\80\C1\44\68\90
\26\AD\AA\3F\10\C4\1D\48\B0\73\8F\51\98\32\92\78\7E\6E\C3\81\0F\4A\8B\54\32\03\F9\17\26\E3\E0\65\07\52\9C\BD\99\47\D2\51\8E\90\54\77\EA\DD\91\BB\F5\50\02\88\E2\E3\5C\5C\A0\29\36\A6\F4\E2\9C\C2\F2\73\05\68\5C\5C\33\A8\5C\30\52\09\19\C0\27\5C
\72\2B\2A\3B\1F\52\1A\F0\48\E0\2E\93\21\D1\5B\CD\27\7E\AD\25\74\3C\20\E7\70\DC\4B\23\C2\91\E6\21\1A\0E\F1\6C\DF\CC\F0\4C\08\65\8C\B3\9C\12\D9\2C\06\C4\C0\AE\26\E1\5C\24\09\C1\BD\60\94\15\96\43\58\9A\10\0E\89\05\D3\86\30\D6\AD\E5\BC\FB\07\B3
\C4\3A\4D\E9\68\09\E7\DA\9C\47\E4\D1\21\26\33\A0\44\81\3C\04\21\E8\90\32\33\84\C3\3F\68\A4\17\4A\A9\65\10\07\20\DA\F0\68\E1\11\5C\72\A1\6D\95\98\F0\4E\17\69\02\B8\A3\B4\8E\92\86\CA\4E\D8\48\10\6C\37\A1\AE\76\82\EA\57\49\0C\E5\2E\0B\B4\C1\2D
\D3\35\D6\A7\65\79\07\8F\01\5C\72\0E\12\45\4A\19\5C\6E\69\01\2A\0B\BC\5C\24\07\40\DA\52\55\30\2C\5C\24\55\16\1B\BF\45\86\A6\D4\D4\C2\AA\75\29\40\28\74\CE\19\53\4A\6B\05\E1\70\21\02\80\7E\AD\82\E0\64\0F\60\CC\3E\AF\95\5C\6E\0B\C3\3B\23\5C\72
\08\70\39\86\17\6A\1C\C9\B9\DC\5D\26\4E\63\28\72\80\88\95\54\51\55\AA\BD\53\B7\DA\01\5C\30\11\38\6E\0E\12\60\AB\97\79\95\62\A4\C5\16\9E\05\4C\DC\4F\35\82\EE\2C\A4\F2\9E\91\3E\8E\82\86\78\E2\01\E2\15\B1\66\E4\B4\92\E2\D8\1A\1B\90\2B\81\96\5C
\22\D1\49\80\7B\6B\4D\C8\5B\5C\72\25\C6\0C\5B\09\A4\1E\65\0B\F4\0E\61\D4\31\21\20\E8\FF\ED\B3\D4\AE\A9\46\40\AB\62\29\52\9F\A3\37\32\88\EE\30\A1\5C\6E\57\16\A8\99\B1\4C\B2\DC\9C\06\D2\AE\74\64\D5\2B\81\ED\1C\DC\07\30\77\67\6C\F8\30\6E\40\F2
\EA\C9\A2\D5\69\ED\4D\AB\83\5C\6E\41\A7\4D\35\6E\EC\5C\24\45\B3\05\D7\B1\16\4E\DB\E1\6C\A9\DD\12\9F\D7\16\EC\25\AA\31\20\41\DC\FB\BA\13\FA\F7\DD\6B\F1\72\EE\69\46\42\F7\13\01\CF\F9\6F\6C\2C\6D\75\4E\78\2D\CD\5F\A0\D6\A4\43\28\20\0E\81\90\1D
\06\66\1C\E9\01\6C\04\5C\72\31\70\10\5B\05\39\78\0F\28\69\B4\18\42\D2\96\B2\DB\7A\51\6C\FC\BA\38\43\03\D4\09\B4\02\A9\58\55\20\54\62\A3\DD\49\DD\60\95\70\2B\56\5C\30\EE\8B\D1\3B\8B\13\43\62\CE\C0\58\F1\2B\CF\92\8D\73\EF\FC\5D\48\F7\D2\5B\E1
\6B\8B\78\AC\03\47\2A\F4\86\8F\5D\B7\61\77\6E\FA\21\C5\36\82\F2\E2\DB\D0\1A\6D\53\ED\BE\93\49\DE\CD\4B\CB\7E\2F\9D\D3\A5\37\DE\F9\65\65\4E\C9\F2\8D\AA\53\AB\2F\3B\64\E5\41\86\12\15\3E\7D\6C\7E\9E\CF\EA\03\20\A8\25\06\5E\B4\15\0C\66\E7\D8\A2
\70\DA\9C\44\45\EE\C3\61\B7\82\74\5C\6E\78\3D\C3\6B\D0\8E\84\19\2A\1A\64\BA\EA\04\F0\54\16\97\BA\FC\FB\6A\1D\32\9F\C9\6A\9C\9D\5C\6E\91\A0\C9\20\2C\98\65\3D\91\86\4D\38\1D\34\F4\FB\D4\12\61\95\6A\40\EE\54\C3\73\8F\D4\E4\6E\66\A9\DD\5C\6E\1A
\EE\36\AA\5C\72\64\9C\10\BC\30\DE\ED\F4\59\8A\27\25\D4\93\ED\18\DE\7E\09\81\D2\A8\86\3C\D6\10\CB\0B\96\41\EE\8B\96\48\BF\47\1B\82\81\38\F1\19\BF\9D\01\CE\83\5C\24\7A\10\1C\AB\F0\7B\B6\BB\B2\75\32\2A\11\86\03\E0\61\0F\96\C0\3E\17\BB\28\18\77
\8C\18\4B\2E\62\50\82\15\7B\85\83\10\6F\0F\0F\FD\01\94\1E\11\C2\B4\0E\AB\0C\7A\B5\23\EB\02\32\0E\F6\38\3D\C9\0B\38\3E\AA\A4\B3\41\2C\B0\65\B0\C0\85\2B\EC\43\E8\A7\78\F5\2A\C3\E1\D2\2D\62\3D\6D\87\99\9F\2C\8B\61\92\C3\6C\7A\6B\9D\81\EF\5C\24
\57\19\F5\2C\90\6D\8F\4A\69\E6\CA\A7\E1\F7\81\2B\8B\E8\FD\30\B0\5B\0B\AF\FF\2E\52\CA\73\4B\F9\C7\1B\E4\58\E7\1D\DD\1A\5A\0B\4C\CB\E7\32\90\60\17\CC\1C\28\EF\43\E0\76\5A\A1\DC\DD\05\C0\B6\17\02\E8\5C\24\81\D7\B9\2C\E5\44\3F\48\B1\D6\16\4E\78
\58\16\F4\F3\29\92\EE\8E\4D\0F\A8\89\5C\24\F3\2C\8D\CD\2A\5C\6E\D1\A3\1C\5C\24\3C\71\19\FF\C5\9F\68\21\BF\B9\53\93\17\E2\83\C0\9F\78\73\41\21\98\3A\04\B4\4B\A5\C1\0F\7D\C1\B2\04\93\F9\AC\A3\9C\52\FE\9A\41\32\6B\B7\58\8E\70\5C\6E\3C\F7\7F\07
\FE\A6\FD\EB\6C\EC\0E\A7\D9\33\AF\F8\A6\C8\1B\95\56\56\AC\7D\A3\67\1A\26\59\DD\8D\21\86\2B\F3\3B\3C\B8\59\C7\F3\9F\59\45\33\08\72\B3\D9\8E\F1\06\9B\43\ED\6F\35\A6\C5\F9\A2\D5\B3\CF\6B\6B\FE\85\F8\B0\D6\DB\A3\AB\CF\17\74\F7\92\55\F8\85\AD\29
\FB\5B\FD\DF\C1\EE\7D\EF\18\12\D8\75\B4\AB\6C\15\E7\A2\3A\44\9F\F8\2B\CF\8F\20\5F\6F\E3\0C\E4\68\31\34\30\D6\E1\CA\30\F8\AF\62\E4\4B\98\E3\AC\92\0C\A0\F6\FE\E9\04\BB\0C\6C\47\AA\84\23\AA\9A\A9\EA\8E\05\86\A6\A9\EC\7C\55\64\E6\B6\49\04\04\4B
\08\AB\EA\C2\37\E0\5E\EC\E0\B8\04\40\BA\AE\05\12\4F\5C\30\48\04\C5\1A\04\F0\48\69\8A\36\5C\72\87\DB\02\A9\DC\5C\5C\63\67\06\5C\30\F6\E3\EB\32\0E\8E\42\05\C4\2A\65\E0\90\5C\6E\80\9A\09\85\7A\72\90\0C\21\90\6E\57\10\7A\26\90\7F\08\20\7B\06\48
\96\F0\27\5C\24\58\20\A0\77\40\D2\38\EB\0E\44\47\72\2A\EB\C4\DD\05\48\E5\27\70\23\8E\C4\AE\80\A6\D4\5C\6E\64\FC\80\F7\0B\2C\F4\0F\A5\97\0B\2C\FC\3B\67\7E\0C\AF\0C\05\5C\30\D0\23\80\CC\05\8E\B2\45\8F\C2\05\5C\72\D6\49\60\9C\05\10\EE\05\27\83
\0F\F0\12\25\45\D2\2E\A0\5D\0E\60\CA\0C\D0\9B\0E\85\1D\0E\EE\0C\06\25\26\04\D0\EE\6D\B0\FD\5C\72\E2\DE\05\25\34\53\84\76\F0\23\5C\6E\0E\A0\9E\66\48\5C\24\25\EB\10\0C\2D\C2\23\AD\C6\D1\71\42\E2\ED\E6\A0\C0\C2\51\2D\F4\0E\63\32\8A\A7\82\0C\26
\C2\0C\C0\CC\5D\E0\99\11\20\E8\05\71\68\5C\72\F1\6C\5D\E0\AE\73\A0\D0\07\D1\68\E4\0B\37\16\B1\6E\23\B1\82\0C\82\DA\2D\E0\6A\45\AF\46\72\E7\A4\6C\26\64\0C\C0\D8\D9\E5\7A\EC\46\36\B8\90\88\C1\5C\22\0F\13\A0\9E\93\08\7C\BF\A7\A2\73\40\DF\1A\B1
\AE\0E\E5\7A\0C\29\30\72\70\DA\8F\5C\30\82\58\5C\30\A4\D9\E8\7C\44\4C\3C\21\B0\16\F4\6F\84\2A\87\19\1D\44\B6\7B\2E\42\3C\45\AA\8B\8B\30\6E\0E\42\28\11\EF\20\8E\7C\5C\72\5C\6E\EC\5E\A9\06\8D\E0\8D\20\68\B3\21\82\D6\EA\72\5C\24\A7\92\28\5E\AA
\7E\8F\E8\DE\C2\2F\70\8F\06\71\1F\B2\10\CC\42\A8\C5\4F\9A\07\88\F0\FA\2C\5C\5C\B5\0F\A8\23\52\52\CE\0E\8F\25\EB\E4\CD\64\D0\48\6A\C4\0B\60\C2\05\A0\F4\0B\AE\CC\AD\20\56\05\E5\13\05\20\62\53\92\64\A7\69\16\8E\45\82\0F\06\F8\EF\6F\68\B4\72\3C
\69\2F\6B\5C\24\2D\9F\5C\24\6F\94\BC\2B\C6\C5\8B\CE\FA\6C\D2\DE\4F\B3\26\65\76\C6\92\BC\69\D2\6A\4D\50\41\27\12\75\27\8E\CE\0C\92\7F\28\20\4D\28\68\2F\2B\AB\F2\57\44\BE\53\6F\B7\2E\0B\6E\B7\2E\0E\F0\6E\14\B8\12\EC\EA\28\9C\28\5C\22\AD\01\12
\C0\A7\68\F6\26\70\86\A8\12\2F\18\CB\2F\31\44\CC\8A\E7\6A\E5\A8\B8\05\12\45\1D\E8\DE\26\E2\A6\80\8F\2C\0F\27\6C\5C\24\2F\11\0F\2E\2C\05\C4\64\A8\85\82\57\80\62\06\62\4F\33\F3\42\B3\73\48\06\11\A0\3A\4A\60\21\93\2E\80\AA\82\87\C0\FB\01\A5\A0
\8F\13\2C\46\C0\D1\37\28\08\87\C8\D4\BF\B3\0B\0F\0B\FB\31\8A\6C\E5\73\20\D6\D2\8E\91\B2\97\1B\C5\A2\71\A2\58\5C\72\C0\9A\AE\83\7E\52\E9\B0\B1\11\60\AE\D2\9E\04\F3\AE\59\2A\E4\3A\52\A8\F9\72\4A\B4\13\B7\25\4C\CF\2B\6E\B8\5C\22\88\F8\5C\72\A6
\CE\CD\87\48\21\71\62\BE\32\E2\4C\69\B1\25\D3\DE\CE\13\A8\57\6A\23\39\D3\D4\4F\62\45\2E\49\3A\0F\85\36\C1\0F\03\37\5C\30\CB\36\2B\A4\25\B0\2E\C8\12\12\0C\85\DE\05\B3\61\37\45\38\56\53\E5\3F\07\28\44\47\A8\0E\D3\B3\42\EB\25\3B\F2\AC\F9\D4\2F
\3C\92\B4\FA\A5\C0\5C\72\20\EC\07\B4\3E\FB\4D\C0\B0\40\B6\BE\80\48\07\A0\44\0B\73\D0\0B\B0\5A\5B\74\48\A3\45\6E\78\28\F0\8C\A9\52\A0\05\78\F1\8F\FB\40\AF\FE\47\6B\6A\57\94\3E\CC\C2\DA\23\54\2F\38\AE\63\38\E9\51\30\CB\E8\5F\D4\49\49\47\49\49
\92\17\21\A5\F0\8A\05\59\45\64\CB\45\B4\5E\8F\74\64\E9\74\68\0E\C2\60\44\02\56\21\43\E6\38\8E\A5\5C\72\AD\B4\9F\62\93\33\A9\21\33\E2\06\0E\40\D9\33\33\4E\7D\E2\5A\42\F3\33\10\09\CF\33\E4\7F\33\30\DA\DC\4D\1B\15\28\EA\3E\82\CA\7D\E4\5C\5C\D1
\74\EA\82\66\A0\0C\66\8C\CB\E2\49\5C\72\AE\12\0C\80\F3\33\33\37\15\20\58\D4\5C\22\74\64\CE\2C\5C\6E\62\74\4E\4F\11\1F\60\15\50\E2\3B\14\AD\18\DC\95\04\D2\AD\1A\05\C0\D4\0E\AF\5C\24\5C\6E\82\9E\DF\E4\5A\D1\AD\35\55\35\57\55\B5\5E\68\6F\1E\FD
\E0\E6\08\74\D9\50\4D\2F\35\04\4B\34\45\6A\07\B3\4B\51\26\03\35\33\47\58\93\58\78\29\D2\3C\35\44\0E\85\12\8F\5C\72\FB\56\F4\5C\6E\DF\72\A2\05\35\62\DC\80\5C\5C\4A\5C\22\3E\A7\E8\31\53\02\5C\72\5B\2D\16\A6\CA\44\0B\75\C0\5C\72\D2\E2\A7\C3\29
\30\30\F3\59\F5\C8\CB\A2\0C\B7\6B\7B\5C\6E\B5\C4\23\B5\DE\5C\72\B3\5E\B7\8B\7C\E8\75\DC\BB\55\E5\5F\6E\EF\55\34\C9\55\8A\7E\59\74\D3\5C\72\49\9A\C3\40\E4\8F\B3\99\52\20\F3\0E\33\3A\D2\75\65\50\15\4D\53\E8\30\54\B5\77\57\AF\11\58\C8\F2\F2\44
\A8\F2\A4\4B\4F\55\DC\E0\95\87\3B\55\F5\5C\6E\A0\4F\59\8D\E9\59\CD\1A\51\2C\4D\5B\5C\30\F7\5F\AA\44\9A\CD\C8\57\A0\BE\4A\2A\EC\5C\72\67\28\5D\E0\A8\5C\72\5C\22\5A\43\89\A9\36\75\EA\8F\2B\B5\59\F3\0E\88\13\59\36\C3\B4\90\30\AA\71\F5\28\D9\F3
\38\7D\90\F3\15\33\41\58\33\54\07\A0\68\06\16\39\6A\B6\1F\6A\E0\66\07\14\F5\4D\74\E5\50\4A\03\62\71\4D\50\35\3E\8F\F0\C8\F8\B6\A9\59\15\87\6B\25\26\5C\5C\82\31\0C\64\A2\D8\45\34\0E\10\C0\20\B5\59\6E\90\CA\0C\ED\5C\24\3C\A5\55\5D\D3\89\31\89
\13\6D\62\D6\B6\90\5E\D2\F5\9A\A0\EA\12\05\5C\22\4E\56\E9\DF\70\B6\EB\70\F5\B1\65\4D\DA\DE\D7\1B\57\E9\DC\A2\EE\5C\5C\E4\29\11\5C\6E\20\CB\5C\6E\66\37\5C\6E\D7\05\07\32\0E\0B\B4\F5\72\17\38\8B\97\3D\45\6B\37\74\56\9A\87\B5\9E\05\37\50\A6\B6
\07\4C\C9\ED\61\36\0E\F2\15\14\F2\76\40\0F\27\82\04\36\1D\69\E0\EF\6A\26\3E\B1\E2\18\3B\AD\E3\60\D2\FF\61\15\09\5C\30\70\DA\A8\28\B5\4A\D1\EB\29\AB\5C\5C\BF\AA\6E\FB\F2\C4\AC\12\6D\04\5C\30\BC\A8\32\80\04\F4\16\0E\65\0F\71\05\4A\F6\AD\50\8D
\F4\74\8C\EB\B1\66\0B\6A\FC\C2\5C\22\5B\5C\30\A8\B7\15\86\07\A2\02\58\2C\3C\5C\5C\8C\EE\B6\D7\E2\0C\F7\E6\B7\2B\6D\64\86\E5\7E\07\E2\0C\E0\9A\85\D1\73\25\6F\B0\B4\6D\6E\D7\29\2C\D7\84\E6\D4\87\02\0F\12\B2\5C\72\11\34\B6\C2\38\5C\72\B1\CE\0C
\B8\1C\D7\6D\45\82\48\5D\82\A6\98\FC\D6\48\57\AD\4D\30\10\0E\44\EF\DF\80\97\E5\7E\8F\CB\81\98\4B\7F\98\0B\7F\EE\45\7D\F8\19\7F\B8\0E\0F\18\12\B4\E0\7C\66\D8\5E\93\08\DC\D7\5C\72\3E\D4\2D\7A\5D\32\73\82\78\44\05\98\64\5B\18\73\87\74\8E\53\A2
\0C\B6\5C\30\51\66\2D\1A\07\4B\60\AD\A2\82\74\E0\D8\0E\04\84\77\54\AF\39\80\E6\5A\80\E0\09\F8\5C\6E\42\A3\39\20\4E\62\96\E3\3C\DA\42\06\FE\49\35\6F\07\D7\6F\4A\F1\70\C0\CF\4A\4E\64\E5\CB\5C\72\8D\68\DE\8D\C3\16\90\32\90\5C\22\E0\78\E6\07\48
\43\E0\DD\8D\96\3A\8D\F8\FD\39\59\04\6E\31\36\C6\F4\17\7A\72\2B\7A\B1\F9\1B\11\FE\5C\5C\92\02\F7\95\9C\F4\6D\20\DE\15\B1\54\0C\20\F6\F2\A0\F7\40\59\32\6C\51\3C\32\4F\2B\0F\A5\25\93\CD\2E\D3\83\68\F9\30\41\04\14\DE\F1\B8\8A\C3\5A\8B\13\8F\32
\52\A6\C0\31\A3\8A\2F\AF\68\48\7F\5C\72\A8\58\85\C8\61\4E\42\26\A7\20\C4\4D\40\D6\5B\78\8C\05\87\CA\AE\A5\EA\96\E2\38\26\4C\DA\56\CD\9C\76\E0\B1\08\2A\9A\6A\A4\DB\9A\47\48\07\E5\C8\5C\5C\D9\AE\09\99\B2\0E\19\B6\26\73\DB\13\5C\30\51\9A\A0\5C
\5C\08\5C\22\E8\62\A0\B0\09\E0\C4\5C\72\42\73\9B\C9\77\9D\82\09\9D\D9\E1\9E\42\06\4E\60\9A\37\A7\18\43\6F\28\05\D9\C3\07\E0\A8\5C\6E\05\0E\C3\A8\9D\93\A8\31\9A\39\CC\2A\04\45\98\20\F1\53\85\D3\55\90\30\55\BA\20\74\9A\27\7C\94\6D\99\B0\DE\3F
\68\5B\A2\5C\24\2E\23\C9\35\09\20\E5\09\70\84\04\E0\79\42\E0\40\52\F4\5D\A3\85\EA\04\40\7C\84\A7\7B\99\C0\CA\50\5C\30\78\05\F4\2F\A6\20\77\A2\1A\25\A4\45\73\42\64\BF\A7\9A\43\55\9A\7E\4F\D7\B7\03\E0\50\05\E0\40\58\E2\5D\04\D4\03\85\10\8D\A8
\5A\33\A8\A5\31\A6\A5\7B\A9\65\4C\59\10\89\A1\8C\DA\90\A2\5C\5C\92\28\2A\52\60\A0\09\E0\A6\5C\6E\85\8A\04\E0\8E\08\BA\CC\51\06\43\46\C8\2A\8E\B9\B9\90\E0\E9\9C\AC\DA\70\86\58\7C\60\4E\A8\82\BE\5C\24\80\5B\86\89\92\40\CD\55\10\A2\0C\05\E0\F0
\05\A6\B6\0E\E0\5A\A5\60\5A\64\5C\22\5C\5C\5C\22\85\82\A2\A3\29\AB\87\49\88\3A\E8\74\9A\EC\6F\44\E6\0B\5C\30\5B\B2\A8\E0\05\B1\82\2D\A9\93\A0\67\ED\B3\89\99\AE\2A\60\68\75\25\A3\02\2C\80\94\AC\E3\49\B5\37\C4\AB\B2\48\F3\B5\02\6D\A4\36\DE\7D
\AE\BA\06\4E\D6\CD\B3\5C\24\0C\BB\4D\B5\55\59\66\0E\26\31\F9\8E\C0\9B\65\5D\70\0E\0F\7A\A5\A7\DA\49\A4\C5\6D\B6\47\2F\A3\20\7F\BA\06\1E\77\20\DC\21\95\5C\5C\23\05\35\A5\34\49\A5\64\B9\45\C2\68\71\80\E5\A6\04\F7\17\D1\AC\6B\E7\78\7C\DA\6B\A5
\1A\71\44\9A\62\85\7A\3F\A7\BA\89\3E\FA\83\BE\3A\86\93\5B\E8\4C\D2\C6\AC\5A\B0\58\1A\9A\AE\3A\9E\B9\84\05\B7\DA\1A\8D\C7\6A\05\1A\DF\77\35\09\B6\59\81\BE\30\20\A9\C2\93\AD\AF\1A\5C\24\5C\30\43\A2\19\86\64\53\67\B8\EB\10\82\A0\7B\9D\40\94\5C
\6E\60\9E\09\C0\7F\C3\FC\43\20\A2\19\B7\BB\4D\BA\B5\E2\0C\BB\B2\23\20\74\7D\78\CE\4E\84\F7\BA\87\7B\BA\DB\B0\29\EA\FB\43\83\CA\46\4B\12\01\5A\DE\0F\6A\99\C2\5C\30\50\46\59\94\42\E4\70\46\6B\96\9B\30\1C\3C\DA\3E\08\CA\44\3C\4A\45\99\9A\67\5C
\72\F5\2E\93\15\32\96\FC\38\E9\55\40\2A\CE\35\66\6B\AA\CC\19\4A\44\EC\C8\C9\34\8D\95\54\44\55\37\36\C9\2F\B4\E8\AF\40\0C\B7\82\4B\2B\84\C3\17\F6\4A\AE\BA\C3\C2\1C\ED\40\D3\3D\8C\DC\57\16\49\4F\44\B3\38\35\07\4D\17\9A\8D\4E\BA\5C\24\52\F4\0F
\5C\30\F8\35\07\A8\5C\72\E0\F9\5F\F0\AA\0F\9C\EC\45\9C\F1\CF\49\AB\CF\B3\4E\E7\6C\A3\D2\E5\79\5C\5C\F4\91\88\C7\71\55\80\D0\51\FB\1C\0C\A0\AA\5C\6E\40\92\A8\80\DB\BA\C3\70\9A\AC\A8\50\06\DB\B1\AB\37\D4\BD\4E\5C\72\FD\52\7B\2A\8D\71\6D\DD\5C
\24\5C\30\52\94\D7\D4\93\8A\01\C5\E5\71\D0\0C\11\C3\88\2B\55\40\DE\42\A4\E7\05\4F\66\2A\86\43\CB\AC\BA\4D\43\8E\E4\60\5F\0B\20\E8\05\FC\F2\BD\CB\B5\4E\EA\E6\54\E2\35\D9\A6\43\03\D7\BB\A9\20\B8\07\E0\5C\5C\05\57\C3\05\65\26\5F\58\8C\5F\D8\8D
\68\E5\97\C2\C6\42\05\9C\33\C0\8C\DB\25\DC\1F\02\46\57\A3\FB\81\7C\99\47\DE\9B\27\C5\5B\AF\C5\82\C0\B0\D9\D5\56\A0\D0\23\5E\5C\72\10\E7\0C\A6\47\52\0E\80\BE\98\80\50\B1\DD\46\67\0C\81\A2\FB\EE\AF\C0\59\69\20\FB\A5\C7\7A\5C\6E\07\E2\A8\DE\2B
\DF\5E\2F\93\A8\80\82\BC\A5\BD\5C\5C\95\36\E8\DF\62\07\BC\64\6D\68\D7\E2\40\71\ED\0F\8D\D5Ah\D6\29\15\16\2C\4A\AD\D7\57\96\C7\63\6D\F7\65\6D\5D\8E\D3\8F\65\CF\6B\5A\62\30\DF\E5\0E\FE\9E\81\59\F1\5D\79\6D\8A\E8\87\66\D8\1E\65\B9\42\1C\3B\B9\D3\EA\4F\C9\C0\77\9F\61\70\08\44\57\FB\8C\C9\DC\D3\7B\9B\08\5C\30\98\C0\2D\32\2F\62\4E\AC\73
\D6\BD\DE\BE\52\10\61\93\CF\AE\68\08\26\71\74\5C\6E\5C\22\D5\1A\69\02\F6\52\6D\FC\68\7A\CF\65\F8\07\86\E0\DC\46\53\37\B5\D0\1D\50\50\F2\E4\96\A4\E2\DC\3A\42\A7\88\E2\D5\73\6D\B6\AD\59\20\64\06\FC\DE\F2\37\7D\33\3F\2A\82\74\FA\F2\E9\CF\6C\54
\DA\7D\98\7E\0E\80\84\8F\80\E4\3D\63\9E\FD\AC\02\D6\DE\C7\09\9E\DA\33\85\3B\54\10\B2\4C\07\DE\35\12\2A\09\F1\7E\23\B5\41\95\BE\83\91\73\8E\78\2D\37\F7\8E\66\35\60\D8\23\5C\22\4E\D3\62\F7\AF\47\98\0E\9F\8B\F5\40\DC\65\FC\5B\EF\F8\81\1C\A4\CC
\73\91\98\80\B8\0E\2D\A7\01\98\4D\36\A7\A3\71\19\71\9A\06\20\68\05\80\65\35\85\5C\30\0E\0E\16\D2\A2\C0\B1\11\FA\2A\E0\62\F8\49\53\DC\12\C9\DC\46\CE\AE\39\7D\FD\70\D3\2D\F8\19\FD\60\7B\FD\7F\1E\B1\C9\96\6B\50\98\30\54\3C\84\A9\5A\39\06\1E\E4
\30\12\3C\05\D5\9A\5C\72\AD\80\3B\21\C3\16\88\67\BA\5C\72\10\5C\6E\4B\D4\0B\5C\6E\95\87\5C\30\C1\B0\2A\01\BD\5C\6E\62\15\37\28\C0\5F\B8\12\40\2C\11\05\EE\65\32\5C\72\C0\16\5D\96\4B\85\2B\5C\30\C9\FF\70\16\03\20\1D\43\5C\5C\1B\D1\A2\2C\16\05
\30\17\18\AC\06\5E\EE\4D\D0\A7\9A\BA\02\A9\15\01\93\10\40\8A\3B\58\5C\72\95\18\04\F0\3F\03\5C\24\5C\72\87\6A\92\15\2B\05\01\F6\2F\B4\17\AC\0F\42\F6\E6\50\A0\BD\89\F9\A8\4A\7B\5C\22\61\CD\36\98\E4\89\9C\B9\7C\E5\A3\5C\6E\5C\30\BB\E0\5C\5C\05
\35\93\81\D0\09\0F\0B\1C\31\35\0C\36\FF\86\20\2E\DD\5B\C2\55\0B\D8\AF\5C\30\64\E8\10\B2\38\59\1A\E7\13\0E\3A\21\D1\18\B2\91\3D\BA\C0\58\2E\B2\75\43\AA\8A\8C\F6\21\53\BA\B8\87\6F\85\70\D3\42\DD\FC\DB\37\1A\B8\AD\C5\AF\A1\52\68\AD\5C\5C\68\8B
\08\45\05\3D\FA\04\79\3A\3C\20\05\3A\75\B3\F3\32\B5\38\30\93\73\69\A6\9F\54\73\42\DB\40\5C\24\20\CD\12\0E\E9\40\C7\75\09\C8\51\01\BA\08\90\A6\2E\F4\01\82\54\30\08\07\1B\4D\5C\5C\2F\EA\80\64\2B\C6\83\5C\6E\91\A1\3D\D4\0C\B0\13\64\8C\0E\C5\EB
\03\41\A2\B8\1C\A2\29\0C\5C\72\40\40\C2\68\33\80\16\96\D9\38\2E\65\01\5A\16\61\7C\2E\E2\37\9D\0C\59\6B\D0\63\01\1B\C0\98\06\F1\96\27\44\23\87\A8\59\F2\15\40\58\8D\71\96\3D\4D\A1\EF\34\34\9A\15\42\1C\20\04\1E\41\4D\A4\AF\64\55\02\5C\22\11\14
\8B\48\77\34\EE\1D\28\3E\82\AC\38\07\A8\16\B2\C3\43\B8\3F\65\5F\60\D0\C5\58\3A\C4\41\39\C3\B8\99\81\F4\70\AB\47\D0\E4\87\47\79\36\BD\C3\46\93\58\72\89\A1\6C\F7\31\A1\BD\D8\BB\90\42\03\A2\C3\85\39\11\52\7A\06\A9\F5\68\42\84\7B\8D\9E\04\11\80
\1D\99\5C\30\EB\E5\5E\82\C3\2D\E2\30\A9\25\1B\44\9C\35\46\5C\22\5C\22\E0\DA\DC\CA\03\C2\99\16\FA\1F\69\C4\60\CB\06\D9\6E\41\66\A8\20\5C\22\1E\08\74\44\5A\5C\22\5F\E0\56\5C\24\9F\1D\AA\21\2F\85\44\10\80\E1\9A\86\F0\15\BF\B5\8B\08\B4\88\D9\A6
\A1\CC\80\46\2C\32\35\C9\6A\9B\54\EB\E1\97\79\5C\30\85\4E\BC\78\5C\72\E7\59\6C\12\A6\8F\23\15\91\C6\45\71\5C\6E\CD\C8\42\32\9C\5C\6E\EC\1B\E0\36\01\08\B7\85\C4\34\D3\D7\16\94\21\08\2F\01\C2\0C\5C\6E\F3\83\14\19\1E\1A\89\51\B8\1D\BD\2A\AE\3B
\11\29\62\52\B8\5A\30\1D\5C\30\C4\43\44\6F\8C\0B\CB\9E\8E\34\38\C0\95\B4\B5\87\D0\65\03\91\5C\6E\08\E3\A6\53\25\5C\5C\FA\10\50\49\6B\90\03\87\17\28\30\C1\8C\75\2F\0C\1A\99\1C\8B\47\05\B2\C6\18\1C\B9\8A\03\8C\BC\5C\5C\CB\7D\19\A0\34\46\70\0E
\91\9E\47\11\FB\5F\0E\02\F7\47\3F\29\67\C8\6F\74\81\BA\5B\76\9E\D6\5C\30\B0\B8\3F\62\C0\1E\3B\AA\CB\60\28\95\DB\8C\E0\B6\0E\4E\53\29\5C\6E\E3\78\3D\E8\D0\2B\40\04\EA\DC\37\83\12\8F\6A\FA\30\8F\97\2C\F0\31\C3\85\7A\99\93\AD\06\13\8D\3E\30\08
\88\89\47\63\F0\E3\4C\85\56\58\0B\F4\83\11\B1\0F\DB\F0\CA\18\25\C0\85\C1\84\51\2B\F8\8E\E9\6F\C6\46\F5\C8\E9\18\DC\B6\11\D0\3E\51\2D\E3\63\1D\91\DA\C7\6C\89\A1\B3\03\A4\77\E0\CC\7A\35\1B\47\91\EA\82\40\28\68\91\63\D3\17\48\F5\C7\72\3F\88\9A
\4E\62\FE\40\C9\1F\A8\F6\C7\F8\B0\EE\6C\78\33\8B\55\60\84\72\77\AA\A9\D4\12\16\55\C3\D4\10\F4\74\D8\38\07\D4\3D\C0\6C\23\F2\F5\8F\6C\FF\E4\A8\89\38\A5\45\5C\22\8C\83\98\99\4F\19\36\5C\6E\98\C2\31\65\A3\60\5C\5C\68\4B\66\97\56\18\2F\D0\B7\50
\61\59\4B\E7\4F\CC\FD\20\17\01\E9\8F\E0\78\91\09\89\4F\6A\84\F3\1B\8F\72\37\A5\46\12\3B\B4\02\EA\81\42\BB\01\91\EA\A3\ED\12\CC\92\87\BC\3E\01\E6\04\D0\A6\B2\56\5C\72\C4\96\07\C4\7C\A9\27\04\1A\4A\03\B5\7A\AB\BC\9A\13\13\94\23\92\50\42\E4\04
\92\59\35\5C\30\4E\43\A4\5E\5C\6E\7E\4C\72\52\92\D4\5B\CC\9F\1D\52\C3\AC\F1\67\C0\65\5A\5C\30\78\9B\5E\BB\69\3C\06\51\E3\2F\29\0E\D3\25\40\CA\90\13\92\99\66\05\42\B2\48\01\66\CA\1E\7B\25\50\11\E0\5C\22\5C\22\BD\8D\F8\08\12\40\AA\05\FE\8D\19
\29\F2\92\08\91\93\44\45\28\69\4D\32\82\53\92\2A\83\79\F2\53\C1\5C\22\E2\F1\CA\65\CC\92\31\8C\AB\D7\98\5C\6E\34\60\1E\CA\A9\3E\12\A6\11\13\8F\04\51\2A\A6\DC\01\79\B0\6E\94\11\92\9E\A5\54\E4\75\D4\0C\9D\1A\E2\E4\94\D1\7E\25\81\2B\19\57\81\B2
\58\04\4B\8B\8C\7F\A3\51\1A\A1\5B\CA\94\9E\E0\6C\01\90\50\59\79\23\44\D9\AC\44\3C\AB\46\4C\FA\B3\D5\40\C1\36\27\10\15\5D\C6\8B\87\FB\04\5C\72\46\C4\60\16\B1\21\95\25\5C\6E\8F\30\90\63\D0\F4\C0\13\CB\A9\25\63\38\57\72\70\47\83\2E\06\54\9C\1A
\44\6F\BE\55\4C\32\D8\2A\03\E9\7C\5C\24\AC\3A\E7\81\58\74\35\C6\58\59\E2\04\49\88\70\23\F1\20\B2\1E\5E\5C\6E\EA\07\84\3A\82\17\23\44\02\FA\19\40\D6\31\03\5C\72\2A\C8\04\4B\37\12\1B\E0\40\44\02\5C\30\8E\13\B8\04\43\92\43\A3\78\42\68\02\01\C9
\45\6E\4B\E8\1C\2C\31\15\5C\22\F5\2A\79\5B\04\1D\E1\23\21\16\F3\D7\99\E2\03\D9\99\A9\CA\15\B0\6C\5F\A2\2F\80\14\06\F6\78\CB\5C\30\E0\C9\DA\35\D0\5A\C7\FF\34\5C\30\30\30\35\4A\C6\68\5C\22\32\0B\88\8C\87\10\25\59\85\81\A6\61\AE\61\31\53\FB\4F
\9D\34\88\CA\25\6E\69\05\F8\9A\50\1A\8C\E0\DF\B4\10\01\71\10\EE\10\5F\08\0B\CA\BD\36\06\A4\9A\95\7E\8A\0E\03\C8\49\08\5C\5C\BE\10\16\9A\91\64\8D\1A\89\FA\08\03\64\12\D1\F8\81\8C\05\AE\08\97\44\DC\C8\1A\94\10\18\80\B5\05\33\67\5E\E3\FC\40\5E
\02\36\D5\06\84\0B\EE\E5\5F\08\08\C0\48\02\44\B7\11\2E\6B\73\4C\15\B4\D4\40\C2\03\F9\C9\88\E6\6E\AD\49\16\08\1D\A6\C4\06\D1\7E\01\C4\5C\72\93\62\08\A0\1B\40\B8\D3\80\95\4E\9E\74\5C\30\73\9D\14\E9\C2\5D\3A\75\F0\CE\58\0C\80\62\18\10\1B\40\5E
\06\B0\31\5C\30\BD\A9\A5\32\3F\E8\54\C0\F3\36\64\4C\4E\65\C9\13\9B\2B\1C\EA\5C\30\C7\3A\A9\D0\81\B2\6C\A1\83\01\7A\1D\07\02\36\71\3D\CC\BA\78\93\A7\0C\18\1C\E7\4E\36\A0\DC\4F\2C\25\40\73\9B\30\5C\6E\E6\5C\5C\29\D2\0C\4C\3C\F2\43\CA\7C\08\B7
\9E\12\A6\50\9D\01\B6\62\A2\15\98\BC\CE\1D\41\3E\49\8B\85\05\E1\5C\22\09\8C\DC\19\5E\1E\4B\34\FC\8B\04\67\0B\49\58\90\69\19\40\50\85\6A\1C\02\45\A9\26\2F\19\31\14\40\E6\66\DC\09\D4\4E\E1\BA\78\30\0B\63\6F\06\61\DF\A7\C1\AA\89\F3\2C\43\1C\27
\DC\79\23\36\46\1D\40\A1\D0\A0\89\8D\48\30\C7\07\7B\04\7A\33\11\74\96\7C\19\63\58\4D\4A\10\11\2E\2A\42\D0\29\5A\44\51\F0\E5\02\8F\5C\30\B0\F1\93\54\2D\01\76\A5\58\9E\61\2A\94\DD\2C\2A\C3\3C\62\C1\95\CB\23\78\D1\98\DD\64\80\50\13\18\1D\C6\F2
\4B\47\38\97\10\C6\20\79\93\4B\09\5C\5C\10\1D\23\0C\3D\E8\29\ED\67\0C\C8\91\68\8C\07\26\C8\1C\38\5D\29\BD\43\C5\5C\6E\C3\B4\F1\C0\39\BC\7A\03\88\57\5C\5C\01\92\67\FE\4D\20\37\8A\88\21\CA\1B\95\A1\F3\0B\C6\16\8A\1B\96\AC\2C\C5\F2\39\F1\B2\8A
\06\19\A9\A9\05\5C\24\54\5C\22\A3\03\2C\8A\A8\25\2E\46\21\CB\9A\20\41\BB\2D\E0\E9\0F\94\1C\18\F8\B9\2D\1A\E0\67\10\A8\11\07\E2\8A\5C\30\30\30\32\52\3E\4B\45\88\27\D8\55\D9\5F\49\15\12\04\D0\F7\EC\B3\13\39\B3\CB\BC\A1\6A\28\17\10\90\51\B0\9D
\12\15\40\CB\40\F2\34\2F\AC\37\F4\98\19\93\27\4A\17\2E\E2\87\52\54\85\5C\30\5D\14\4B\53\13\B9\44\90\87\16\16\96\41\70\35\BC\5C\72\C2\48\07\30\21\01\E4\9B\C2\B4\65\09\64\40\52\1F\D2\9D\D2\E0\B8\B4\CA\39\A2\53\02\A9\3B\37\9E\48\91\42\C0\62\78
\F3\1C\4A\E8\03\D6\5F\9E\06\76\69\D1\55\60\19\40\88\B5\07\C3\53\41\4D\85\AF\58\CB\CF\47\D8\58\69\D9\D3\55\0C\2A\AC\02\DA\F6\80\CA\1F\F5\FB\11\CD\7F\27\F8\03\DD\3A\56\F2\57\4A\76\A3\44\BE\81\FF\4E\01\27\5C\24\EC\10\7A\68\5C\24\64\5F\08\79\A7
\12\9C\93\5A\5D\95\99\AD\18\04\F3\1C\59\CA\11\17\B0\B3\38\D8\94\FE\A1\E6\5D\A8\50\EC\9C\10\06\2A\68\8F\06\9E\D4\D6\A7\65\3B\80\BA\70\65\FB\A2\5C\24\6B\E6\77\A7\EC\01\2A\37\4E\B2\44\54\78\5F\D4\D4\A7\BD\47\69\F4\26\50\FF\D4\86\9E\74\CD\86\A8
\62\E8\5C\5C\45\C6\48\5C\24\69\8D\45\5C\22\63\72\BD\E5\30\6C\89\3F\3E\14\C1\F1\8C\91\43\28\8A\57\40\33\15\C8\C1\95\32\32\61\B4\8D\93\08\49\C1\E0\B9\D5\06\A1\7B\A5\42\60\DC\DA\B3\08\69\C5\B8\47\6F\5E\36\45\5C\72\A1\BA\47\98\4D\A4\70\31\69\D9
\49\03\BC\A4\58\AA\5C\30\30\30\33\8E\32\05\C7\1A\4B\FC\A7\D3\F4\DD\7A\6C\26\D6\86\89\27\49\4C\D6\5C\5C\CE\5C\22\92\37\A4\3E\AC\6A\28\3E\18\E3\6A\F4\46\47\5F\11\E2\04\E4\26\20\31\30\49\C6\13\41\33\10\31\3D\07\68\20\71\04\5C\30\C6\46\8A\AB\96
\18\84\C4\B7\8A\DD\5F\C2\07\4A\AA\18\14\8C\84\D4\B3\14\04\56\CE\96\BA\87\DC\86\71\D9\D5\9A\A2\D9\09\C2\E0\28\05\2F\14\BE\13\64\18\4F\43\8F\5F\18\11\73\6D\A7\3C\0E\67\98\01\78\13\5C\30\92\04\B0\5C\22\81\F0\5C\6E\40\45\6B\48\16\5C\30\A1\4A\88
\AD\AE\38\0F\80\28\AC\A8\AF\6B\6D\5B\89\1E\91\EC\BF\C1\53\34\F0\5C\6E\13\59\34\30\12\9B\0E\AB\2B\0C\4C\0B\5C\6E\8A\A6\06\C0\93\91\EC\23\42\D3\AB\62\01\E7\C0\25\52\0C\D6\96\B0\B5\D7\AD\91\02\C0\52\14\3A\C6\10\3C\0F\04\11\5C\24\21\DB\A5\72\1F
\90\3B\01\9C\0F\85\C7\09\25\7C\CA\A8\02\02\E1\04\10\28\80\7C\AB\48\87\5C\30\E0\05\F0\91\C1\D0\0F\8C\13\B0\18\85\5D\1A\12\C2\63\D2\A1\3D\0B\30\AF\ED\5A\E1\A8\5C\22\5C\22\3D\D6\58\0E\95\98\29\BD\66\EB\4E\9F\90\36\56\7D\46\D5\DA\19\3D\5B\C9\10
\9E\81\E0\A7\A2\68\75\F4\2D\F8\B1\5C\30\74\A5\E5\62\57\7E\BA\F5\51\95\D5\16\02\69\4A\8A\F6\97\4C\F1\35\D7\AD\71\23\6B\62\9E\A0\DD\57\6E\AB\AB\CD\51\F8\18\54\83\21\EB\06\81\C2\65\F5\6E\03\63\8F\53\D1\5B\2B\19\D6\B4\45\15\AF\3C\2D\87\96\61\5D
\C5\83\88\EC\59\62\D3\5C\6E\08\5C\6E\4A\7E\E4\17\7C\0E\4A\C9\83\38\AE\20\1A\EC\4C\02\70\10\9F\06\99\C1\E6\6F\F1\20\80\4E\02\E4\A9\01\DC\A8\85\4A\2E\F9\8D\C5\83\13\1A\53\01\C8\08\A1\32\63\39\1E\C3\6A\A9\79\10\9F\2D\06\60\61\14\5C\30\17\C4\F6
\06\2A\EC\D6\88\40\5C\30\2B\B4\01\D8\6D\05\67\C9\DA\36\B0\31\A4\D4\4D\65\1A\5C\30\AA\CB\51\20\89\10\5F\16\84\1A\7D\21\49\F6\1C\07\92\47\4C\0C\80\66\02\29\0C\C3\58\1B\F1\6F\0B\2C\93\53\68\01\78\18\17\C2\06\5C\30\30\30\30\5C\22\68\F0\2B\4C\03
\A5\4D\D4\18\C9\20\AA\D1\98\B1\CA\5A\09\6A\97\5C\30\B6\A0\B5\2F\98\9D\5C\24\92\A8\3E\75\1C\2A\97\19\5A\39\94\EE\5A\E5\AE\65\F5\AB\07\1E\2B\4A\9C\89\99\B8\74\7A\90\01\C8\CB\FB\1E\C8\FE\52\A8\4B\03\D4\AF\D0\19\D1\E2\06\44\79\8E\DE\D9\71\E1\30
\43\97\2D\66\A2\C5\17\01\6D\82\B6\B9\AA\42\49\ED\7C\92\B9\19\08\48\42\89\9C\73\51\6C\C0\58\07\B0\83\2E\DD\C5\F6\D4\1C\7C\B8\63\88\AA\C0\16\5B\0C\0E\96\F3\5A\68\5A\E5\C3\6C\98\A8\DB\78\C2\40\27\B5\A0\19\6D\6C\B2\4B\72\51\B6\32\36\BD\95\5D\AF
\D2\B7\6E\A7\64\5B\06\DD\F6\F1\8E\A9\87\64\FE\80\91\5C\22\14\16\47\4A\39\75\F2\FB\42\83\6F\93\1D\A9\5A\DF\96\D5\61\A5\B2\6E\40\C1\AA\6E\B0\6C\0E\57\16\7C\2A\67\58\B4\07\5C\6E\6E\04\32\E5\46\AC\0C\7C\78\60\44\6B\17\9B\84\75\50\50\8D\21\51\10
\02\5C\72\72\8B\99\12\60\07\57\2F\B9\8C\9F\09\31\15\14\E6\5B\18\2D\6F\2C\37\31\62\05\55\73\98\0E\A2\A9\E7\4E\B8\37\B2\CB\C9\DB\47\71\B8\2E\5C\5C\51\5C\22\43\03\10\43\54\5C\22\E6\91\E0\96\08\C4\D2\2A\3F\75\19\02\A8\74\73\B6\89\94\B0\C7\5D\1E
\E1\D9\A9\50\7A\5B\A5\5B\59\1E\46\CF\B9\A2\9B\46\44\33\A4\5C\22\81\96\BA\C7\5D\81\75\DB\9D\29\77\0B\7A\05\AD\3A\23\15\B6\CD\DD\49\69\77\8A\EA\9D\70\0B\C9\9B\BB\F1\7B\AF\01\6F\D6\03\30\6E\F0\B6\DB\3B\D5\E2\5C\5C\E9\78\B8\B0\D8\5C\30\71\B7\8D
\6D\E5\E3\ED\AA\26\D8\7E\C2\EE\EE\97\94\37\B2\F8\C0\B9\39\0B\5B\A4\48\E9\71\64\4C\10\95\4F\BA\32\B4\76\81\7C\42\AF\74\0F\8D\E6\8A\5C\5C\C6\A4\89\48\64\A6\EB\E2\48\91\5C\22\20\F2\EC\12\4E\5C\6E\5C\30\0B\B7\A9\47\C5\67\CE\46\A0\B8\46\88\7D\5C
\22\EC\AD\26\51\45\4B\BE\91\7B\7D\1D\5C\72\79\C7\8E\BE\98\72\D7\9B\74\9B\C0\81\9E\84\EF\86\37\05\D4\15\4E\75\C3\B3\5B\41\F8\67\68\3B\53\A5\2E\D2\A0\82\9A\B1\C2\A5\0B\7C\1C\79\F9\CF\5B\16\D5\86\5F\62\F2\16\C8\A8\15\AC\21\2B\52\F1\E8\5A\58\F9
\40\30\4E\E9\E9\06\FE\C1\50\16\80\DE\04\EC\25\A1\6A\44\A3\C2\AF\7A\19\09\FE\E0\97\08\5B\F8\55\5C\22\B6\7B\65\92\12\14\38\F4\9F\3E\1C\94\45\4C\34\4A\D0\BD\85\1A\30\9B\A1\A6\03\E8\0E\37\20\16\80\B4\07\64\B7\AC\20\0B\C0\51\5E\60\30\60\9C\81\95
\8D\AF\5D\63\F0\3C\67\07\40\1C\8E\B2\68\79\38\98\ED\70\2E\11\65\66\5C\6E\F3\03\CE\65\01\68\0C\87\83\61\19\58\90\DA\C3\F8\16\17\6D\53\DF\DF\6A\42\05\DA\98\51\5C\22\87\1E\5C\72\EB\D7\C7\4B\33\86\3D\3E\C7\AA\41\58\94\5B\2C\2C\17\1B\5C\22\27\3C
\07\B5\9B\01\96\16\25\B6\61\80\AB\D3\B4\C3\04\B5\2E\5C\24\F1\5C\30\E7\14\25\5C\30\E1\90\73\56\A4\1D\EE\1A\17\CB\70\A0\05\4D\5C\24\BC\40\6A\01\E1\D7\F0\3E\06\A4\AD\9D\7D\56\65\C4\5C\24\40\1A\97\CD\84\0B\23\A7\AA\D0\28\33\3A\F8\60\82\1B\55\F0
\9A\59\CC\0E\B6\75\0C\E6\1A\A8\FB\88\10\CF\E2\1A\CE\02\40\C4\56\23\06\45\89\0C\47\2F\B8\FC\58\44\1A\5C\24\88\68\B5\83\61\76\96\BC\07\78\53\5C\22\5D\6B\31\38\11\61\16\AF\D1\8F\81\39\64\4A\52\4F\D3\8A\73\91\60\45\4A\B0\BD\A7\F8\55\6F\B3\6D\7B
\6C\B9\42\38\A5\88\C1\28\5C\6E\12\7D\65\69\B1\62\FC\07\F8\2C\20\8D\3B\A0\4E\94\AA\CD\87\F8\51\D8\5C\5C\02\E8\0F\C7\B8\49\35\79\52\1A\BC\5C\24\03\21\3E\17\5C\5C\CA\89\8C\67\C2\04\75\6A\15\0F\2A\3F\6E\B0\4D\D3\DE\B2\68\DD\F8\5C\72\25\C1\B3\E0
\55\28\64\80\A6\4E\7F\B5\64\23\7D\9A\70\07\41\18\15\16\3A\AC\A8\FD\95\2D\5C\5C\E8\0B\41\1A\BB\2A\C4\34\80\32\49\80\AE\E8\5C\72\8F\D6\A3\BB\85\04\20\30\01\68\0E\40\5C\5C\05\D4\B5\C9\10\C0\38\F0\33\82\72\71\5D\8F\F2\F9\64\38\5C\22\F0\51\A0\8C
\FF\EE\C6\99\3A\03\63\C6\E0\79\17\C7\34\09\CF\E1\91\9A\64\61\C2\80\87\CE\A0\36\3E\55\DB\41\DA\1D\8F\D1\1D\81\3A\BD\90\40\98\32\1B\8B\DB\0F\FF\5C\24\05\F2\65\68\1E\32\17\8F\B4\FB\19\46\BB\A7\1C\C9\99\4E\E1\2B\92\8C\9F\5C\72\FE\D4\80\28\0F\EE
\41\72\0F\82\B0\16\64\2A\FC\5C\30\5B\AE\23\01\63\6A\8F\8A\FB\01\B4\3E\21\28\90\53\F0\C8\1A\E9\4C\88\65\06\FD\0C\54\C9\C6\4D\09\39\5C\30\57\3A\1D\99\0E\42\44\02\FD\F8\82\33\4A\8C\AC\D5\5F\1F\40\73\C7\E1\9D\72\75\65\1C\7F\87\F8\A6\07\F0\BB\8D
\FD\14\AC\20\2B\BA\27\10\42\AB\C9\7D\12\5C\22\42\5C\22\1B\FC\7A\32\8E\EE\8B\72\8F\EB\1D\14\6C\BB\78\46\5B\E8\4C\17\D9\CB\B2\45\61\39\06\A0\CA\63\64\05\62\BD\19\BE\5E\2C\D4\55\43\3D\2F\32\BB\D7\F2\BC\F8\EC\2F\5C\24\8F\43\C6\23\DA\F7\38\05\A1
\7D\44\C0\DB\7F\D7\36\CF\10\0B\60\5E\3B\36\42\30\55\37\F3\B7\5F\3D\1F\09\05\2C\AA\31\E2\6A\31\56\5B\A8\2E\09\48\39\28\31\EF\B1\C6\1B\B1\D2\8F\4C\7A\A2\43\1E\B8\09\C7\5C\24\2E\41\CA\66\68\E3\96\AB\BE\CD\E0\EF\44\07\72\18\59\09\FD\48\D8\65\7E
\6F\97\1A\72\31\39\E6\12\97\D9\85\5C\5C\9A\DF\84\50\92\29\5C\22\C3\51\1F\B9\B4\2C\D1\65\F2\F6\13\4C\BE\94\77\30\06\CF\19\5C\30\1C\1B\A7\97\9A\96\81\CF\3B\77\EC\0B\58\0E\B3\C7\9D\A8\89\E7\71\6F\B9\EF\1D\BE\7E\15\1D\9F\AB\F6\E7\F8\3E\39\F4\03
\3E\7D\B2\F2\BA\64\63\BF\5C\30\E5\CA\67\BE\B6\66\CE\F9\71\96\1A\26\1F\39\97\90\B9\2D\FD\4A\03\23\A4\06\08\8A\12\B8\AA\33\5E\34\6D\2F\7F\CC\08\99\AF\5C\30\5C\30\30\30\36\C0\19\A6\6E\38\A3\B7\3E\E4\88\B4\18\11\2E\D3\97\E9\7F\92\63\70\68\B1\CB
\D9\F9\95\9B\9B\0F\BA\5F\41\40\5B\89\95\37\AB\7C\39\5C\24\70\4D\68\A0\3E\01\89\8C\C1\35\B0\4B\A5\0E\FA\C3\45\3D\68\FE\18\9A\41\D2\18\1E\74\8A\5E\E2\56\D7\09\A9\5C\22\8F\09\63\A3\42\3B\A4\F6\DE\69\1D\85\D5\51\D2\A0\1B\74\AC\11\9B\F2\E9\40\2C
\5C\6E\D8\29\AD\F3\10\88\73\D3\60\9F\99\B0\01\B0\3B\D1\06\34\B4\97\82\84\49\ED\A3\0E\A9\91\ED\F9\E8\79\80\A0\2D\A4\30\0E\79\65\CA\A8\1D\0E\97\55\10\82\0F\94\42\EE\A9\76\B3\A5\33\48\99\1D\19\50\C7\47\17\04\CB\35\EA\EF\92\73\7C\B7\BA\5C\72\05
\F0\9D\17\1E\9E\13\D0\5C\24\30\E3\E8\F2\95\F2\05\12\31\BD\A9\6C\33\80\10\E9\28\2A\6F\46\7E\50\4B\B4\AA\2E\FD\2C\27\B7\4A\2F\8F\D3\B2\8F\74\F0\10\11\8D\8B\64\90\3A\9A\97\6E\A7\5C\6E\0F\A9\F0\16\6A\86\81\59\AB\03\7A\EA\28\C6\03\F3\92\04\FC\0F
\93\77\18\B0\18\DD\12\A0\5A\EC\23\5A\1B\0F\CA\09\49\6F\02\1D\95\40\31\C6\CE\BB\0C\1A\17\5C\24\EF\F2\B1\A6\3D\56\1D\18\57\7A\95\09\6E\8E\42\0C\05\F8\17\61\14\7F\FA\9B\8F\41\BB\B5\71\AA\1D\40\99\B4\49\80\70\09\40\D1\35\D3\96\8D\6C\48\7B\55\BA
\DC\6F\58\16\F5\BF\66\F0\8E\D3\BF\5C\5C\7A\B5\D7\2E\A7\9A\B2\2C\2D\5C\5C\DA\97\5E\01\18\79\20\1F\6E\5E\C5\D7\13\CA\10\42\17\71\B7\FE\85\A4\07\1E\7A\58\E3\89\A1\83\0E\5C\24\0E\A8\2A\4A\13\37\32\D5\44\34\2E\86\D5\1E\90\85\21\A4\4D\30\B6\F3\44
\EB\EC\46\8A\E0\F3\E3\A0\47\A1\1C\CF\4C\88\6D\D8\63\2A\6D\EF\1D\63\49\A3\E5\35\C9\8C\BB\5E\97\74\BF\AA\92\6A\6C\8C\37\E6\9B\BF\53\1C\B6\51\A0\A2\2E\69\92\E9\D6\D4\68\A8\08\F5\4C\06\D0\16\DA\B1\42\36\D4\84\68\98\26\EF\4A\A0\85\6C\5C\5C\89\F0
\57\65\AA\63\CE\66\25\6B\6A\05\01\1C\99\C1\20\A6\70\C3\52\3D\8C\E4\19\13\69\92\40\2E\10\F5\A5\28\06\E4\32\8F\6B\6C\48\55\57\5C\22\99\6F\A5\6A\BD\A7\92\70\21\53\35\C6\E8\AD\70\4C\27\60\16\5C\30\A4\4F\20\2A\13\A6\51\33\58\05\C2\93\89\DE\6C\4A
\5C\30\14\38\5C\6E\85\5C\72\B7\B2\B8\2A\80\61\F1\FC\01\EB\96\9E\BC\FB\72\1B\99\60\3C\A4\26\01\DA\17\03\7F\58\42\68\D6\38\21\78\9A\AE\26\E4\0E\0C\42\68\74\A5\5C\24\FF\87\FE\5D\C9\6E\DF\86\E9\F3\C9\63\4C\80\80\5B\C6\B5\A9\1C\64\B8\E1\3C\60\9C
\81\AE\5C\30\9C\80\A2\CF\82\DE\61\77\E6\4F\19\25\3B\91\8D\F5\42\43\BB\85\51\92\5C\72\CC\AD\D3\1D\EC\7F\1D\8C\EC\80\13\81\70\8A\A4\AB\D8\50\51\B6\5A\92\B8\FA\5A\C1\41\75\3D\4E\26\D0\0E\69\61\5C\6E\D1\6D\4B\36\49\04\7D\D1\D7\6E\09\9A\C5\74\5C
\6E\03\64\29\ED\AE\D0\0F\C8\F7\62\70\CE\0F\05\03\80\5C\22\9E\F0\67\27\A6\30\9C\37\04\C3\75\C8\26\40\E2\0B\37\E5\38\58\A0\4E\9D\C0\02\78\13\C4\E1\1A\90\F6\AD\FA\13\5C\24\04\42\F9\DF\5A\42\12\2F\B6\4D\AF\67\14\42\BB\69\1C\A6\D6\D1\A7\B6\5C\5C
\E2\6D\83\6D\49\CC\C4\80\14\CA\E7\9D\03\3B\05\35\3D\23\26\34\98\CC\E7\FE\50\90\16\19\02\D5\8D\89\BD\E9\F0\71\ED\92\41\99\E4\9B\5C\5C\85\0E\2C\71\A4\63\DE\9F\5C\6E\63\E2\42\96\82\BE\D7\FA\77\5C\30\42\67\6A\44\8B\40\3B\81\04\0E\3D\30\6D\93\6B
\0E\1D\AE\C4\5C\72\C4\B2\8B\60\0B\C0\A4\04\10\27\35\A4\0F\95\B6\6B\2D\8C\1D\7B\A2\89\5C\30\10\AF\5F\9B\11\4D\75\EE\F8\83\81\32\93\D2\D7\86\A7\BB\A3\C0\71\F8\89\AC\F0\3E\1E\29\1A\39\12\C8\57\5C\6E\E4\0C\64\0E\2B\85\D4\D4\A7\C0\14\47\5C\72\1B
\FD\C3\6E\34\84\1B\8B\E4\4F\D8\3A\35\F6\12\86\DE\38\81\BB\31\B5\3A\CE\9A\3F\A5\87\28\79\47\67\57\1C\4B\8D\0B\5C\72\DD\37\AD\B2\93\97\6D\35\2E\9C\82\65\8C\48\D9\68\4A\1D\AB\41\6B\23\0C\BB\D3\4C\B6\2E\2E\9B\5C\5C\CE\0E\3D\D5\01\F1\55\D9\D0\84
\8F\98\83\D3\3A\D0\3E\37\BA\57\2B\5E\79\44\1B\82\93\9C\62\AD\FC\16\47\A1\91\4F\5A\02\CD\12\34\EF\8A\72\06\9D\28\7C\78\B5\C6\FD\50\72\B8\A3\2C\79\8E\A9\D0\38\71\61\DC\A9\10\4F\32\18\B5\81\6B\AA\6E\98\8A\23\70\32\BE\FB\C7\88\BA\D8\94\2E\BC\A3
\63\92\96\04\55\97\63\94\F6\E4\EB\C5\82\6A\F3\5C\24\F4\ED\38\C4\AC\7E\9D\9A\37\5A\52\0E\3A\1C\F0\D7\86\38\AD\39\CE\A8\77\28\61\94\4C\05\A4\25\AD\2D\2C\D4\04\C8\EC\BF\8C\23\17\08\F4\66\83\25\38\FE\C9\7C\DE\63\87\91\AC\9C\DA\D7\25\1B\58\91\57
\C2\5C\6E\7D\36\92\91\48\EC\FF\F1\E6\CB\9E\13\A4\A1\23\B9\26\4A\2C\27\7A\1A\93\4D\FC\4D\85\04\A2\89\01\8C\E0\E0\BA\91\DC\86\B2\20\91\98\AE\2F\10\1F\79\18\1D\36\59\51\AF\91\EC\B6\DA\BA\64\D3\99\64\C1\DE\F3\CF\3A\1C\F5\E3\F4\A3\45\83\17\8C\70
\32\67\9F\67\C1\2F\EE\2C\D2\1C\CB\E4\DA\D5\88\27\38\EC\0C\5E\3B\B4\55\57\4E\85\D1\C5\DE\D5\7B\C9\4F\43\F2\85\D1\16\A4\F4\A2\7A\C9\69\4B\58\A2\92\DA\94\4E\8C\64\47\A3\52\43\4A\59\F5\92\9D\91\69\14\B2\92\D7\79\23\3E\7A\53\B2\4D\55\63\A3\F5\83
\A8\FB\FF\EA\52\4F\52\D4\BE\14\A1\30\8D\29\D8\30\CA\FA\5D\3A\3D\CF\9E\99\74\83\91\C1\EB\E9\27\5C\24\99\73\D2\72\46\8E\F6\D9\36\37\09\0B\1C\0C\3D\5C\24\42\C4\17\D3\0C\21\71\73\09\31\5C\22\FC\9D\AC\76\C6\14\F7\25\91\8C\49\95\6C\3C\CA\02\62\21
\DB\AE\17\36\28\43\64\2D\CA\5E\3C\48\60\7E\32\B9\4B\EC\CD\7A\4B\DD\D9\9C\80\17\D4\B1\0C\AD\D9\D5\79\2C\71\41\E1\2A\BA\5C\30\0F\7D\82\DD\43\A8\70\62\80\5C\5C\D3\53\E5\35\DD\10\DF\F9\DA\27\18\28\9B\E1\D3\ED\7C\BB\4D\EB\F0\84\C0\57\DA\C0\35\3B
\1C\5C\24\35\0B\B5\54\7C\BA\F2\07\3B\6B\F5\F1\0F\C8\74\10\9D\EE\11\F1\0E\40\F2\91\E2\3B\39\B3\29\BD\F2\3B\69\90\2E\DB\3B\9B\B7\14\ED\5F\A5\EA\D7\CC\46\B6\3D\F1\90\9C\44\E4\A5\4D\60\48\DE\02\93\83\5C\30\88\09\20\4E\02\20\11\40\B0\02\25\1C\77
\87\AA\64\8D\E8\50\62\F0\5C\24\48\7C\6B\C6\5B\BE\DC\64\43\49\21\3A\6C\C5\FC\2C\A7\A8\FD\3C\F7\94\75\F2\13\19\02\74\94\F4\1B\1D\BC\1A\4E\7F\65\CF\9D\57\5E\A1\77\E8\27\36\12\95\9D\8C\44\BF\E1\66\FD\75\20\AC\69\68\49\F7\5A\3A\9F\D1\7E\FD\F7\CF
\A3\81\72\BE\85\C8\7A\01\C4\16\33\F5\2B\AF\75\6F\43\B7\73\32\15\D5\62\C6\75\61\94\58\90\F0\77\57\4B\19\A3\09\13\48\D4\B6\32\37\3E\E2\57\CF\CD\DD\79\C3\1D\A3\AC\DD\4D\EB\4A\8D\A3\72\70\54\BC\94\4C\F0\89\7C\60\66\99\85\3A\CA\F5\05\9A\41\B2\1D
\74\E4\8A\64\7C\69\BD\B3\5B\77\FC\E8\6A\03\9D\14\84\8A\57\98\20\37\91\A4\A3\61\02\75\8B\A9\A0\FA\EB\65\A0\F2\95\9A\41\35\AD\51\27\20\02\CA\90\1E\5C\30\C8\0C\A0\33\8B\D2\BE\5C\24\C2\06\E7\FD\8C\5C\72\17\6B\29\9D\61\3B\A0\F3\E6\48\3D\F9\99\D6
\90\7E\F3\49\47\8A\49\E6\B0\3C\F9\B4\95\5C\22\F9\AC\C9\49\31\27\E8\A0\99\A2\47\12\63\6D\5C\30\50\5C\6E\EF\77\E8\FC\23\04\CD\13\3E\8C\BD\DB\78\42\5C\22\05\F1\D2\45\6D\7C\85\F9\32\8A\5C\24\7D\3C\33\0F\50\8D\59\58\8D\67\14\6F\A3\64\DF\B6\80\3C
\81\7F\D4\FE\A3\BF\71\45\11\5C\22\10\60\D7\FA\C8\34\E1\11\7F\67\AB\38\72\1D\A3\5D\5C\6E\88\A1\97\F5\3A\F8\9B\71\1D\56\62\8F\54\EC\A3\D2\6D\B0\95\85\39\4B\26\D2\93\C4\A4\C3\02\6D\D4\37\29\40\A8\C0\51\7A\9B\C3\D3\3D\A2\BD\DF\B5\C5\B1\ED\9F\48
\5C\6E\D4\EB\F6\7D\4F\E7\69\7D\BB\5C\72\D9\A3\2E\A2\B9\76\8B\AE\70\BE\4A\57\26\DF\75\D7\35\35\81\30\09\D4\35\C0\EE\50\CB\49\1D\0F\8C\C1\5C\6E\BD\DB\ED\B8\B3\C6\E6\AD\7B\20\5C\72\B2\6D\9A\18\15\40\A0\04\40\20\81\50\08\A0\20\02\78\11\91\34\69
\34\86\2B\40\0F\5C\30\2C\03\CD\9B\5C\5C\96\43\31\D3\8E\06\E8\AA\95\4C\EA\C5\D3\3E\6E\82\02\5C\30\FF\E3\E2\09\20\23\8B\C7\DE\E9\C4\D2\23\40\5D\2F\34\4A\52\9C\20\49\02\03\52\B2\EF\72\08\B9\3C\A0\0E\C7\AF\F2\E1\6A\84\90\0B\3F\31\4D\76\F0\5C\6E
\0B\15\BC\5A\FC\60\76\5C\30\61\BA\2D\E8\62\AD\06\CF\88\9C\1A\9E\2B\F8\A9\19\2D\C2\1C\79\41\5B\7C\E0\37\5C\72\9A\92\5C\24\EE\80\DA\F3\5A\CA\AD\52\03\E0\74\F9\DE\93\BE\AC\AA\05\0F\CF\FD\43\45\72\17\4C\09\F6\D2\13\72\1B\D3\67\AB\65\A0\52\2F\84
\60\0C\A2\4A\09\37\E4\7E\93\25\1B\58\6F\9A\34\E1\B5\12\64\69\03\5C\22\A6\51\72\7F\0E\BA\87\49\EE\3A\51\44\E5\F2\15\80\A4\D0\E8\51\51\4D\7E\5C\30\51\BF\83\29\D8\A9\AD\2A\06\2C\69\5C\30\D0\5F\28\2C\BD\5E\E2\91\12\2B\63\AF\AE\88\0B\7F\8C\26\94
\53\F1\9B\F9\91\DD\7E\6F\EE\06\70\E1\E0\43\80\BA\03\AF\D1\01\DA\07\A9\C4\F9\F4\06\40\E1\F5\67\8C\D6\80\EF\88\BA\01\88\0F\42\DE\C9\E2\41\7E\73\F1\D6\A4\02\F2\1D\5C\30\5D\9A\F0\16\90\2F\AD\13\91\FB\7A\86\0C\E0\98\C3\83\28\5F\F5\7A\08\16\08\46
\BE\9E\07\4F\DA\BF\5C\5C\5C\72\03\80\76\45\FF\10\E9\4B\30\16\FF\3C\05\3F\B7\FC\E4\90\3F\9E\03\DF\E7\80\C4\50\03\B0\1C\A7\E7\3D\10\C8\60\9D\9A\8D\44\85\5E\92\03\F5\07\3D\FD\9F\DA\7F\8C\76\2A\A0\FE\7C\5C\6E\BF\A5\FD\40\90\DF\F3\F9\E0\2D\FE\B8
\5C\5C\3F\B6\7F\6B\F9\44\69\07\34\FE\FB\FE\AF\F9\3F\CA\FB\C8\30\E0\9A\02\6C\23\7B\FD\25\5C\72\33\80\46\9B\FD\C2\02\BF\E0\3C\A0\06\50\03\1F\1E\3C\C8\6B\EF\B4\10\34\96\08\EF\81\AF\9A\2A\40\D3\EF\A1\7D\3F\46\FC\20\D6\CF\DE\5C\30\5D\01\3B\F7\EA
\F3\3F\82\01\5B\5C\72\04\3A\5C\30\D8\9C\81\05\64\16\B0\06\8A\DB\F6\A5\4E\C0\44\FE\32\8E\8D\C8\3F\5C\5C\FA\F8\D2\68\AD\A0\55\01\B4\5C\30\2F\D6\A2\B6\FA\FB\F8\AA\09\3F\90\51\34\01\0F\03\96\63\01\F3\32\6F\EB\83\FC\35\2B\E8\5C\72\B4\C0\12\0C\4C
\01\83\E5\3F\D4\03\B3\FD\8D\AE\07\4E\83\28\07\AF\FB\84\A0\DA\8C\06\90\28\5C\30\E0\83\7C\02\C0\3E\C0\A4\FE\F1\17\41\5B\3F\9E\01\5B\FC\2F\C9\BF\C8\01\DC\0C\ED\AE\15\3B\02\E8\5D\2F\E9\86\5C\5C\0E\84\06\81\91\C0\7D\03\73\FE\6F\B3\84\60\15\32\9F
\8A\AD\04\76\0B\68\5D\30\01\04\CD\5C\30\21\17\50\0B\41\08\58\EC\0E\4A\CA\C0\6C\01\3C\5C\72\EA\2F\5C\22\E0\28\93\E3\44\E9\20\5C\5C\54\B2\76\61\F6\C1\16\FA\52\A6\4F\A6\98\A8\2E\23\F3\50\45\B9\10\48\23\90\EE\43\88\2A\0F\FB\29\8F\A9\3E\74\01\6B
\EB\C1\D8\5C\6E\A5\05\50\0E\8F\AA\08\1A\1D\80\2E\30\45\BE\96\A9\11\7F\49\48\B4\5C\24\B5\DA\66\25\50\8C\30\5D\11\25\CC\C9\BB\88\01\58\46\41\40\05\34\01\5B\FE\EA\B5\1C\0E\FD\5C\30\91\09\A6\29\90\01\50\06\20\18\41\A4\4D\60\05\F0\68\C1\A6\14\5C
\30\E1\70\64\40\EA\A4\E9\7E\EA\0E\41\40\FD\0C\19\C0\B8\41\A1\06\9C\1A\90\6B\41\A4\5C\6E\08\CB\6F\40\1D\48\F4\11\D6\A1\72\5C\6E\8C\5C\24\D3\43\CA\43\99\3B\5C\30\E9\F0\2D\A2\BE\84\1C\0B\FB\29\F6\05\38\98\B2\0E\CF\CB\C1\F8\87\73\35\40\2F\5C\30
\7A\C8\43\7E\20\15\8B\BC\20\E8\65\42\10\06\5E\F5\04\12\84\9C\86\5C\22\03\12\10\50\83\5C\30\58\01\99\E3\4B\31\AE\5E\02\7B\92\04\5C\6E\02\1A\03\80\09\21\6C\B2\FE\F8\B0\5A\0B\A2\13\A4\B9\51\52\C0\BD\84\34\15\31\0F\05\89\16\6A\E6\5A\9C\E4\DF\9F
\D2\E3\A9\8B\C3\A1\AF\2C\67\49\F1\8B\BA\1E\0C\3C\C2\E5\F0\8E\A6\48\4F\F8\BB\03\83\17\66\08\D4\5C\22\EE\48\2C\52\11\12\E5\ED\A2\AE\5E\14\E2\E5\E8\79\A0\A8\42\60\D2\89\F9\A2\EC\1A\9A\7E\E0\F0\B4\F3\08\DA\B4\0F\7D\90\E5\08\DB\96\E6\AD\20\4E\08
\E1\8D\A9\71\82\3A\1B\C1\7E\EE\4D\3E\5E\6B\98\27\5C\24\8D\83\CA\88\6A\01\A2\5C\6E\5C\22\1E\09\23\3B\60\1D\C2\92\92\04\0E\60\14\16\1C\1C\50\71\80\C7\BF\5C\5C\01\5C\5C\2B\82\3C\95\3A\9B\D8\63\61\60\80\7F\5C\6E\B9\8B\64\64\5C\6E\98\1D\40\6A\6E
\35\95\B4\F9\F0\70\88\32\88\1A\01\92\E8\70\8D\C3\04\40\84\30\80\8C\BF\26\7F\30\72\90\B7\B6\B8\FE\FC\2E\48\8C\C2\E8\1C\68\5C\72\8F\9A\11\77\0B\C8\B4\A3\CA\42\F9\09\40\07\F0\A4\BE\7C\7E\F0\5C\72\5C\30\1D\43\5C\30\03\84\31\E0\3A\43\51\0C\31\5C
\5C\70\D3\91\85\0C\59\5B\07\F2\9F\CF\04\90\28\D0\91\2E\52\47\12\E5\D0\8D\C2\30\5C\22\38\BC\50\9C\C2\3C\25\CA\3C\23\83\42\58\37\33\A2\E2\82\A4\F6\93\E9\97\C2\35\42\82\09\74\28\10\8D\B6\10\62\F8\88\07\F1\9E\34\3C\0C\26\5C\72\84\B6\1E\A5\83\8C
\E1\56\5C\30\47\5C\6E\3B\8D\AD\5C\5C\10\06\0C\A0");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("v0\9C\81\46\A3\A9\CC\D0\3D\3D\98\CE\46\53\09\D0\CA\5F\36\1A\4D\C6\B3\98\E8\E8\72\3A\99\45\87\43\49\B4\CA\6F\3A\9D\07\43\11\84\94\58\63\82\9D\5C\72\E6\D8\84\4A\28\3A\3D\9F\45\86\13\81\A6\61\32\38\1A\0E\03\A1\78\F0\B8\3F\14\0F\C4\27\83\69\B0\53\41
\1D\4E\4E\02\91\F9\F0\78\73\85\1A\4E\07\42\E1\CC\56\6C\30\9B\8C\E7\53\09\9C\CB\55\15\0F\6C\14\81\15\28\44\7C\13\D2\84\E7\CA\50\A6\C0\3E\17\9A\45\86\E3\A9\B6\79\48\18\1E\0B\63\01\68\E4\C2\2D\33\17\45\62\93\E5\20\B8\62\BD\DF\70\45\C1\70\FF\12
\39\2E\8A\8F\98\CC\7E\5C\6E\8E\3F\1D\19\4B\62\B1\69\77\1D\7C\C8\60\C7\F7\11\64\2E\BC\78\38\45\4E\A6\E3\21\94\CD\12\32\99\05\87\33\A9\88\E1\5C\72\87\1C\8D\D1\59\8E\CC\E8\79\36\19\47\46\6D\59\8E\38\6F\37\5C\6E\5C\72\10\B3\30\A4\F7\5C\30\81\44
\62\63\D3\21\BE\51\1E\37\1D\05\D0\A8\64\38\8B\C1\EC\1D\05\02\7E\91\AC\4E\29\1D\F9\45\D0\B3\60\F4\4E\73\DF\F0\60\C6\53\29\D0\4F\E9\97\0B\B7\E7\03\2F\BA\1C\3C\0E\81\78\C6\39\8E\6F\BB\D4\E5\B5\C1\EC\10\33\07\6E\AB\AE\32\BB\21\72\BC\3A\3B\E3\2B
\C2\39\88\43\C8\A8\AE\89\C3\5C\6E\3C\F1\8D\08\60\C8\F3\AF\62\E8\5C\5C\9A\3F\8D\60\86\34\5C\72\23\60\C8\14\3C\AF\42\65\16\0C\E3\42\23\1A\A4\4E\20\DC\E3\5C\72\2E\44\60\AC\AB\6A\EA\34\FF\8E\8E\70\E9\16\0E\61\72\B0\F8\0B\E3\A2\BA\F7\3E\F2\38\D3
\5C\24\C9\63\A0\BE\31\C9\63\9C\A0\1D\A1\63\A0\EA\DD\04\EA\7B\6E\37\04\12\C0\C3\02\07\A1\12\08\83\04\41\F0\4E\15\CA\52\4C\69\1B\5C\72\31\C0\BE\F8\21\A3\28\E6\14\0B\6A\C2\B4\AE\2B\C2\EA\36\32\C0\0F\58\CA\38\2B\03\18\CA\14\05\E2\E0\E4\2E\5C\72
\CD\18\CE\16\04\F4\83\CE\16\04\21\78\BC\E5\0E\83\68\F9\27\0C\E3\E2\88\36\53\F0\5C\30\52\12\05\EF\D4\F4\F1\4F\D2\5C\6E\BC\14\85\31\28\57\30\85\E3\9C\C7\37\07\71\9C\EB\3A\4E\C3\45\3A\36\38\6E\2B\8E\E4\D5\B4\02\35\5F\28\AE\73\A0\05\5C\72\E3\94
\EA\89\0C\2F\6D\90\36\50\D4\40\C3\45\51\81\E0\C4\39\05\5C\6E\A8\56\2D\8B\C1\F3\5C\22\A6\2E\03\3A\E5\4A\8D\CF\38\77\65\CE\71\BD\7C\D8\87\B3\58\D0\17\5D\B5\DD\59\20\58\C1\65\E5\7A\57\E2\FC\20\8E\37\E2\FB\5A\31\8D\ED\68\51\66\D9\E3\75\A3\6A\D1
\34\5A\7B\70\5C\5C\41\55\CB\4A\3C\F5\86\19\6B\E1\C1\40\BC\C9\8D\C3\E0\40\14\84\01\7D\26\13\84\81\88\4C\37\0C\55\B0\77\75\59\68\90\D4\32\B8\C8\40\FB\75\A0\20\50\E0\37\CB\41\86\68\E8\CC\F2\B0\DE\33\0C\C3\9B\EA\1E\E7\58\45\CD\85\5A\88\5D\AD\6C
\05\E1\40\4D\70\07\6C\10\76\C2\29\01\E6\20\C1\07\C1\48\57\91\05\91\D4\79\1F\3E\03\90\59\7F\8D\2D\F8\59\9F\E8\2F\AB\9D\9B\AA\C1\EE\0F\A0\68\43\A0\5B\2A\8B\FB\46\E3\AD\05\1B\23\7E\1F\86\21\D0\60\F4\5C\72\23\30\50\10\EF\43\CB\9D\97\66\03\A0\B7
\B6\0B\A1\EE\C3\5C\5C\EE\9B\B6\87\C9\0E\81\5E\C3\25\42\03\3C\8F\5C\5C\BD\1B\66\88\1D\DE\B1\C5\E1\D0\DD\E3\26\2F\A6\4F\82\F0\4C\1E\5C\5C\6A\46\9D\A8\6A\5A\A3\31\AB\5C\5C\3A\C6\B4\3E\04\81\4E\B9\AF\58\61\46\C3\41\C0\1B\1B\B3\B2\F0\C3\D8\CD\66
\85\19\68\7B\5C\22\73\5C\6E\D7\36\34\87\DC\F8\D2\16\85\BC\3F\05\C4\38\DC\5E\70\15\8D\5C\22\EB\9D\B0\F1\C8\B8\5C\5C\DA\65\28\B8\50\18\05\83\4E\B5\EC\71\5B\67\B8\C1\72\FF\26\C2\14\7D\50\68\CA\E0\A1\C0\57\D9\ED\2A\DE\ED\72\1F\5F\73\CB\50\87\68
\E0\BC\E0\D0\5C\6E\DB\CB\C3\6F\6D\F5\BF\A5\C3\EA\97\D3\23\8F\0F\A7\A1\2E\C1\5C\30\40\E9\08\70\64\57\20\B2\0C\5C\24\D2\BA\B0\51\DB\BD\54\04\6C\30\86\20\BE\1D\C3\48\64\48\EB\29\9A\87\02\16\DB\8F\D9\1F\0C\C0\29\50\03\D3\DC\D8\48\90\67\04\E0\FD
\07\17\55\FE\84\8F\AA\15\42\E8\65\5C\72\86\74\3A\87\D5\5C\30\29\5C\22\C5\74\F4\2C\B4\9C\18\92\DB\C7\5B\8F\28\14\44\F8\4F\5C\6E\52\38\21\86\C6\AC\D6\9A\F0\DC\6C\41\FC\56\85\10\A8\34\03\A0\68\E0\1E\A3\53\0F\71\3C\15\9E\E0\40\7D\C3\EB\CA\67\4B
\B1\5D\AE\E0\E8\0F\5D\E2\3D\39\30\B0\81\27\80\E5\1D\E2\F8\77\01\41\11\3C\82\83\D0\1D\D1\61\C1\7E\80\F2\17\06\57\9A\E6\83\44\7C\01\41\B4\86\86\32\0E\D3\58\D9\55\32\E0\E9\79\07\C5\8A\90\8A\08\3D\05\A1\70\29\AB\5C\30\50\09\0C\98\73\0F\80\B5\6E
\85\33\06\EE\81\72\84\66\5C\30\A2\46\85\B7\BA\76\D2\CC\47\0C\AE\01\C1\49\40\E9\25\A4\94\9F\2B\C0\F6\5F\49\60\B6\0C\CC\F4\C5\5C\72\13\1C\2E\83\A0\4E\B2\0F\BA\CB\4B\49\85\5B\15\94\CA\96\53\4A\F2\05\A9\BE\61\06\55\66\9B\53\7A\FB\83\AB\4D\1F\A7
\F4\84\0B\25\AC\B7\5C\22\51\7C\39\04\80\A8\13\42\63\A7\61\C1\71\5C\30\A9\38\9F\23\D2\3C\61\84\B3\3A\7A\31\55\66\0F\15\AA\B7\3E\EE\06\5A\10\B9\6C\89\89\01\B9\9D\D3\C0\13\02\65\35\23\55\40\69\55\47\C2\82\99\A9\6E\A8\25\D2\B0\0F\73\A6\84\12\10
\CB\3B\67\78\4C\07\B4\70\17\50\9A\3F\42\E7\8C\CA\51\8D\5C\5C\15\97\05\62\0C\1F\84\FF\05\E9\BE\92\51\84\3D\37\81\3A\B8\0F\AF\DD\A1\51\BA\5C\72\3A\83\74\EC\A5\0E\3A\79\28\C5\20\D7\13\5C\6E\DB\64\29\B9\19\07\D0\D2\5C\6E\C1\58\3B\A0\8B\EC\8E\11
\EA\13\43\61\41\AC\5C\72\E1\DD\F1\9F\50\A8\47\48\F9\21\A1\A0\A2\40\C8\39\5C\6E\5C\6E\41\6C\7E\48\A0\FA\AA\56\5C\6E\12\73\AA\C9\D5\AB\8D\C6\AF\D5\62\42\72\A3\AA\F6\05\84\92\06\AD\B2\18\1A\DF\FB\33\83\12\1A\5C\72\9E\50\BF\25\0B\A2\D1\84\5C\72
\7D\62\2F\89\CE\91\5C\24\93\04\35\A7\50\EB\43\E4\5C\22\77\13\CC\42\5F\E7\8E\C9\06\55\D5\67\41\74\EB\A4\F4\85\E5\A4\85\E9\5E\51\C4\E5\55\C9\0E\01\C4\D6\6A\99\C1\ED\A0\42\76\68\EC\A1\84\34\87\29\B9\E3\0C\2B\AA\29\3C\96\6A\1A\5E\90\3C\4C\F3\E0
\34\55\2A\A0\F5\81\42\67\A0\EB\D0\E6\1C\E8\2A\6E\81\05\CA\96\E8\2D\FF\DC\F5\D3\1C\09\39\0B\4F\5C\24\B4\89\D8\B7\7A\79\4D\99\33\0E\84\5C\5C\39\DC\E8\1E\98\2E\12\6F\8A\B6\9A\CC\10\EB\B8\45\28\69\E5\07\E0\9E\0B\9C\C4\D3\37\09\74\DF\9A\E9\9D\2D
\26\A2\5C\6E\1A\01\6A\21\5C\72\81\C0\11\02\79\9C\79\E0\44\31\67\F0\D2\F6\5D\AB\DC\79\52\D4\37\5C\22\F0\E6\1D\A7\13\B7\83\88\7E\10\C0\ED\E0\DC\07\29\54\5A\30\45\39\4D\E5\59\5A\06\1A\74\0B\03\58\65\0F\21\DD\66\86\40\E7\7B\C8\AC\79\6C\09\38\87
\1B\3B\90\A6\83\52\7B\84\EB\38\87\07\C4\AE\C1\65\D8\2B\55\14\4C\F1\27\82\1D\46\B2\31\FD\04\F8\E6\38\50\45\35\2D\09\D0\5F\0E\21\D4\37\85\F3\A0\5B\32\89\4A\CB\01\C1\3B\87\15\48\52\B2\E9\11\C7\B9\80\38\06\70\E7\97\B2\DD\87\40\99\A3\30\2C\D5\AE
\70\73\4B\30\5C\72\01\BF\34\94\A2\5C\24\1A\73\4A\BE\0E\81\C3\34\C9\44\5A\A9\D5\49\0E\A2\99\27\5C\24\63\4C\94\52\81\96\4D\70\59\26\1B\1E\FC\BD\8F\CD\69\E7\0F\7A\33\47\06\CD\15\7A\D2\9A\4A\25\C1\CC\19\50\DC\2D\84\01\90\5B\C9\2F\78\E7\B3\54\BE
\7B\70\B6\A7\0E\7A\8B\43\05\D6\76\02\B5\05\A5\D3\3A\83\56\27\9D\5C\5C\96\92\4B\4A\61\A8\C3\4D\83\26\BA\B0\A3\D3\BE\5C\22\E0\B2\65\03\13\9D\6F\5E\51\01\2B\68\5E\E2\02\D0\69\54\81\F0\31\AA\4F\52\E4\6C\AB\2C\1D\35\5B\DD\98\5C\24\B9\B7\29\AC\F4
\6A\4C\C6\81\55\60\A3\53\CB\60\5A\0C\5E\F0\7C\0F\80\87\72\BD\3D\D0\0F\F7\6E\E7\99\BB\96\98\54\55\1A\09\31\48\79\6B\9B\C7\74\2B\5C\30\76\1C\E1\44\BF\5C\72\1B\09\3C\9C\E0\C6\99\EC\F1\6A\07\47\94\1E\9E\AD\74\C6\2A\33\25\6B\9B\59\0B\DC\B2\54\13
\2A\DD\1F\08\7C\5C\22\43\1E\8A\FC\18\6C\07\07\68\45\A7\28\C8\1C\5C\72\C3\38\72\87\D7\7B\DC\18\F1\30\E5\B2\D7\FE\D9\44\DC\5F\8C\87\2E\36\D0\B8\E8\3B\E3\FC\87\84\72\42\6A\1B\83\4F\27\DB\9C\A5\A5\CF\3E\5C\24\A4\D4\60\5E\36\99\CC\39\91\23\19\B8
\A8\A7\14\E6\34\1D\58\03\FE\A5\6D\68\38\3A\EA\FB\63\8B\06\FE\30\1D\F8\D7\1C\05\3B\D8\2F\D4\89\B7\BF\B9\D8\3B\E4\5C\5C\27\28\A0\EE\84\74\FA\27\2B\0B\9D\1C\99\F2\FD\AF\CC\B7\B0\5E\0B\81\5D\AD\B1\4E\D1\76\B9\E7\23\C7\2C\08\EB\76\F0\D7\C3\4F\CF
\0F\69\9D\CF\96\A9\3E\B7\DE\3C\53\0E\EF\41\5C\5C\15\02\80\5C\5C\EE\B5\FC\21\D8\33\2A\74\6C\60\F7\75\81\5C\30\70\06\27\E8\37\85\50\E0\7F\39\B7\62\73\9C\7B\C0\76\AE\7B\B7\FC\37\88\5C\22\7B\DB\C6\72\EE\61\D6\28\BF\5E\E6\BC\DD\45\F7\FA\FF\EB\B9
\1E\67\D2\DC\2F\A1\F8\9E\55\C4\39\67\B6\EE\F7\2F\C8\D4\60\C4\5C\6E\02\08\4C\5C\6E\81\14\29\07\C0\86\14\82\28\41\FA\61\F0\5C\22\05\20\9E\14\03\E7\D8\09\C1\04\26\84\50\F8\14\C2\40\4F\5C\6E\E5\B8\AB\05\30\86\12\02\28\4D\08\26\1C\17\A9\46\4A\08
\02\27\DA\08\21\08\20\85\30\8A\3C\EF\48\EB\EE\C2\E7\0E\C6\F9\A5\1A\2A\CC\7C\EC\C6\2A\E7\4F\5A\ED\6D\2A\6E\2F\62\EE\2F\90\F6\AE\90\D4\0C\88\B9\2E\EC\E2\A9\6F\5C\30\CE\CA\64\6E\CE\29\8F\1E\F9\8F\8E\69\90\3A\52\8E\CE\EB\50\32\EA\6D\B5\5C\30\2F
\76\EC\4F\58\F7\F0\1C\F8\46\CA\B3\CF\88\EE\0F\8C\E8\AE\5C\22\F1\AE\EA\F6\EE\B8\F7\30\04\F5\30\08\F6\82\AC\A9\10\16\ED\30\62\CB\D0\67\02\10\6A\F0\F0\5C\24\F1\6E\E9\04\30\7D\05\B0\09\05\EE\40\F8\0B\3D\06\4D\04\C6\82\0B\02\30\6E\EE\50\9F\05\2F
\70\E6\6F\74\EC\10\80\F7\B0\A8\F0\2E\12\CC\CC\BD\0B\8F\67\5C\30\D0\29\07\6F\97\5C\6E\30\C8\F7\89\5C\72\08\46\B6\E9\0B\80\07\A0\62\BE\69\B6\C3\6F\7D\5C\6E\B0\1C\CC\AF\85\09\4E\51\0B\B0\27\0B\F0\78\F2\10\46\61\D0\4A\04\EE\CE\F4\8F\4C\F5\10\E9
\0F\F0\D0\04\E0\C6\5C\72\C0\CD\5C\72\80\D6\F6\91\11\0E\30\C5\07\F1\27\0C\F0\AC\C9\64\0B\09\6F\65\13\70\DD\13\B0\34\44\D0\DC\05\CA\90\A6\71\28\7E\C0\CC\0C\20\EA\5C\72\82\45\10\B0\DB\11\70\72\F9\51\56\46\48\9C\6C\A3\82\4B\6A\A6\BF\E4\4E\26\AD
\6A\21\CD\48\60\11\82\5F\62\68\5C\72\31\8E\0C\A0\BA\0B\6E\08\21\CD\1A\C9\8E\AD\0C\10\7A\99\B0\A1\13\F0\A5\0C\CD\5C\5C\0F\AB\AC\05\5C\72\8A\07\ED\8A\C3\60\56\5F\6B\DA\C3\5C\22\5C\5C\D7\82\27\0E\11\56\05\88\AB\18\5C\30\CA\BE\60\41\19\43\FA\C0
\B1\CF\18\85\A6\56\C6\60\5C\72\25\A2\92\C2\02\C5\EC\A6\5C\72\F1\E2\0E\83\82\6B\40\4E\C0\B0\FC\81\10\42\F1\ED\9A\99\11\AF\11\20\B7\21\C8\5C\6E\92\5C\30\5A\99\0C\36\B0\5C\24\64\A0\8C\2C\25\03\E0\25\6C\61\19\ED\48\D7\5C\6E\8B\23\A2\53\5C\24\0C
\21\5C\24\40\B6\DD\0F\32\B1\8D\84\0E\49\5C\24\72\80\7B\21\B1\B0\4A\87\32\48\E0\5A\06\4D\5C\5C\C9\C7\68\62\2C\87\0B\27\7C\7C\63\6A\7E\67\D0\72\85\60\BC\C4\BC\BA\08\5C\24\BA\C4\C2\0C\2B\EA\41\31\F0\9C\45\7F\1F\80\C7\1F\C0\D9\20\0C\3C\CA\4C\A8
\05\11\D1\5C\24\E2\59\25\2D\46\44\AA\8A\64\80\4C\04\E7\84\B3\A0\AA\5C\6E\40\92\08\62\56\66\E8\BE\3B\32\5F\28\EB\F4\4C\C4\D0\BF\C2\0C\05\B2\3C\25\40\DA\9C\07\2C\5C\22\EA\64\C4\C0\4E\82\65\72\F4\5C\30\E6\83\60\C4\0E\A4\5A\0C\80\BE\34\C5\08\27
\6C\64\39\2D\F2\23\60\E4\F3\C5\96\85\E0\B6\D6\E3\6A\36\EB\C6\A3\E3\76\07\A0\B6\04\E0\4E\D5\CD\90\66\A0\D6\7F\40\DC\86\93\26\92\42\5C\24\0B\E5\B6\0C\28\F0\5A\26\84\DF\F3\32\37\13\38\49\20\E0\BF\E0\50\5C\72\6B\5C\5C\8F\A7\97\32\60\B6\5C\72\64
\4C\0E\62\40\0E\45\14\F6\83\18\32\60\50\28\20\42\27\E3\08\0B\80\B6\0F\80\BA\30\B2\26\05\A0\F4\7B\C2\90\95\93\A7\3A\AE\AA\64\42\E5\31\F2\5E\D8\89\2A\5C\72\5C\30\63\3C\0E\04\06\4B\90\7C\06\DD\35\73\5A\BE\60\BA\C0\C0\4F\33\EA\35\3D\40\E5\35\C0
\43\3E\40\C2\57\2A\09\3D\5C\30\4E\3C\67\BF\36\73\36\37\53\6D\37\13\75\3F\09\7B\3C\26\4C\04\C2\2E\06\33\7E\44\C4\EA\5C\72\C5\9A\0C\AF\78\B9\13\ED\29\08\2C\72\EE\69\0E\6E\C5\2F\A0\E5\12\0F\4F\5C\30\6F\7B\30\6B\CE\5D\33\3E\05\6D\8B\05\94\31\5C
\30\94\49\40\D4\39\12\54\33\34\2B\D4\99\40\65\0F\94\47\46\14\4D\43\C9\5C\72\45\33\CB\45\74\6D\21\13\DB\23\31\C1\44\20\40\82\48\28\91\D3\6E\20\C3\C6\3C\67\2C\56\60\52\5D\40\FA\C2\C7\C9\33\43\72\37\73\7E\C5\47\1B\49\F3\69\40\5C\30\76\C2\D3\18
\35\5C\72\56\DF\27\1A\AC\A0\A4\0C\A0\CE\08\A3\50\05\02\16\05\C0\D4\5C\72\E2\5C\24\3C\62\D0\05\25\28\87\44\64\83\8B\50\57\C4\EE\D0\CC\62\D8\0C\66\4F\20\E6\78\5C\30\E8\7D\20\DC\0B\E2\94\6C\62\A0\26\89\76\0F\6A\08\04\34\B5\4C\53\1A\BC\A8\D6\B4
\D4\B6\35\26\64\07\73\46\20\4D\F3\34\CC\18\D3\5C\22\2E\48\CB\4D\30\F3\13\31\75\15\4C\B3\5C\22\C2\C2\2F\4A\60\F2\7B\C7\FE\A7\80\CA\78\C7\90\59\75\2A\5C\22\55\2E\49\35\33\51\AD\33\51\F4\BB\4A\84\94\67\A0\92\35\85\08\73\E0\FA\8E\26\6A\D1\8C\92
\D5\75\82\D9\AD\D0\AA\47\05\51\0B\4D\54\6D\47\42\83\74\0B\6C\2D\1F\63\F9\2A\B1\FE\5C\72\12\02\8A\AB\5A\37\D4\F5\1B\F3\2A\68\73\2F\52\55\56\B7\F0\F4\AA\42\9F\4E\CB\88\B8\C3\06\F3\E3\EA\05\D4\8A\E0\69\A8\4C\6B\F7\2E\A9\B4\C4\74\EC\A0\E9\BE\A9
\85\72\59\69\94\D5\E9\2D\53\B5\83\33\CD\5C\5C\9A\54\EB\4F\4D\5E\AD\47\3E\91\04\5A\51\6A\D4\07\87\99\5C\22\A4\8E\AC\69\94\D6\4D\73\53\E3\53\5C\24\49\62\0F\09\66\B2\13\E2\D1\75\E6\A6\08\B4\99\E5\3A\04\EA\1A\53\42\7C\69\A2\A0\59\C2\A6\0F\83\E0
\38\09\76\07\CA\23\02\E9\94\44\AA\34\60\87\86\2E\80\CB\5E\F3\48\C5\4D\89\5F\D5\BC\8A\75\C0\99\55\CA\7A\60\5A\8D\4A\09\65\E7\BA\DD\40\43\65\ED\EB\61\89\5C\22\0F\6D\F3\62\12\84\36\D4\AF\4A\52\C2\7F\D6\0C\91\54\9D\3F\D4\A3\58\4D\5A\DC\CD\D0\86
\CD\F2\70\E8\D2\0F\B6\AA\51\76\AF\6A\13\FF\6A\56\B6\7B\B6\BC\C5\43\9C\5C\72\B5\D5\37\16\89\54\CA\9E\AA\20\FA\ED\35\7B\50\F6\BF\5D\12\92\5C\72\D3\3F\51\E0\41\41\C0\E8\04\07\8E\8B\92\CD\32\F1\BE\A0\93\56\29\4A\1B\69\A3\DC\2D\4E\0C\39\02\39\66
\96\6C\20\4A\12\6D\CD\F2\3B\75\A8\0E\40\82\3C\46\FE\D1\A0\BE\65\86\6A\0C\80\D2\0E\C4\A6\8F\49\89\3C\2B\43\57\40\F0\81\17\18\E7\C0\BF\5A\91\6C\D1\31\C9\3C\32\C5\69\46\FD\37\60\14\4B\47\98\7E\4C\26\2B\4E\08\8F\E0\59\74\57\48\E9\A3\91\77\09\1A
\0E\D6\03\1A\95\83\19\F2\6C\80\D2\73\27\67\04\C9\E3\71\2B\4C\E9\7A\62\69\7A\AB\C6\CA\C5\A2\D0\10\2E\D0\8A\C7\7A\57\B2\C7\20\F9\7A\64\06\95\57\A6\DB\F7\B9\28\17\8F\79\29\76\DD\45\34\2C\5C\30\D4\0C\5C\22\01\64\A2\A4\5C\24\42\E3\7B\B2\8E\21\29
\13\31\55\86\35\62\0C\70\23\C5\7D\6D\18\3D\D7\C8\40\88\77\12\C4\09\50\5C\30\E4\5C\72\EC\0C\A2\B7\91\80\60\4F\7C\EB\C6\0E\18\0E\F6\09\9C\C9\8D\FC\C5\F5\FB\59\F4\E6\4A\D5\82\05\15\F6\45\D7\D9\4F\75\9E\5F\A7\5C\6E\60\46\60\C8\07\7D\4D\C2\2E\23
\31\E1\82\17\AC\66\EC\2A\B4\D5\A1\1F\B5\A7\20\20\BF\7A\E0\75\1A\63\FB\80\97\B3\20\78\66\D3\38\6B\5A\52\AF\73\32\04\CA\82\2D\86\92\A7\5A\32\AD\2B\18\8E\CA\B7\AF\28\E5\73\55\07\F5\63\44\F2\D1\B7\CA\0B\EC\98\DD\58\21\12\E0\CD\75\F8\26\2D\76\50
\D0\D8\B1\13\15\5C\30\27\4C\EF\8C\58\20\F8\4C\C3\02\18\B9\8C\88\6F\09\0B\DD\0B\04\F4\3E\B8\D5\8E\02\D3\5C\72\40\D9\50\18\F5\02\0E\5C\72\7F\78\46\05\D7\FC\45\80\CC\C8\AD\0C\EF\25\C0\0B\E3\04\EC\AE\FC\3D\18\35\4E\D6\9C\83\B8\3F\84\37\F9\4E\CB
\C3\85\A9\77\8A\60\D8\68\58\AB\39\38\20\CC\18\81\8D\F8\AF\71\AC\A3\7A\E3\CF\64\25\36\CC\82\74\CD\2F\85\95\98\E4\0C\AC\EB\8F\4C\FA\CD\6C\BE\CA\2C\DC\4B\19\61\95\4E\7E\CF\0C\C0\DB\EC\FA\0C\2C\FF\27\ED\C7\80\4D\5C\72\66\39\01\7F\A3\77\90\98\02
\21\78\1F\90\F7\78\5B\88\CF\91\D8\47\92\38\3B\84\78\41\98\F9\2D\49\CC\26\35\5C\24\96\44\5C\24\F6\BC\B3\25\85\D8\78\D1\AC\C1\94\C8\C2\B4\C0\C2\0C\8C\5D\9B\A4\F5\87\26\6F\89\2D\33\9D\39\D6\4C\F9\BD\7A\8D\FC\A7\79\36\0C\B9\3B\75\B9\7A\5A\20\E8
\D1\38\FF\5F\95\C9\90\78\5C\30\44\16\3F\9A\58\37\86\99\AB\92\79\B1\4F\59\2E\23\19\33\9F\19\38\A0\99\C7\80\98\65\94\51\A8\3D\D8\80\05\2A\1B\98\99\47\14\8C\77\06\6D\20\B3\DA\03\84\59\91\7F\F9\0B\A0\C0\DA\5D\59\1F\4F\59\A8\46\A8\ED\9A\D9\29\84
\7A\1E\23\5C\24\65\8A\9A\29\86\1A\2F\8C\7A\3F\A3\7A\3B\99\97\D9\1A\AC\5E\DB\FA\46\D2\5A\67\A4\F9\95\A0\CC\F7\A5\99\A7\83\9A\60\5E\DA\65\A1\AD\05\A6\BA\23\A7\07\05\93\D8\F1\94\0C\A9\8E\FA\3F\9C\B8\65\A3\80\4D\A3\DA\33\75\CC\E5\81\83\08\30\B9
\3E\CA\5C\22\3F\9F\F6\40\04\D7\97\58\76\95\5C\22\E7\1B\94\8C\B9\AC\A6\2A\D4\A2\04\5C\72\36\76\7E\87\C3\4F\56\7E\8D\26\D7\A8\15\81\5E\67\FC\A0\9A\C4\91\D9\9E\87\27\CE\05\80\66\05\36\3A\2D\5A\7E\0C\B9\9A\4F\36\3B\7A\78\81\B2\3B\26\21\DB\2B\7B
\39\4D\B3\17\D9\B3\64\AC\20\5C\72\2C\39\D6\ED\B0\E4\B7\57\C2\04\0C\C6\DD\AD\3A\EA\5C\72\FA\D9\9C\F9\E3\9D\40\E7\9D\82\2B\A2\B7\5D\9C\CC\2D\9E\5B\67\9E\99\DB\87\5B\73\B6\5B\69\9E\D9\1D\69\C8\71\9B\9B\79\9B\E9\78\E9\2B\93\7C\37\CD\7B\37\CB\7C
\77\B3\7D\19\84\A2\9B\0E\A3\45\96\0C\FB\57\B0\80\57\6B\B8\7C\4A\D8\81\B6\04\E5\89\78\6D\88\B8\71\20\78\77\79\6A\9F\BB\98\23\B3\98\65\BC\05\F8\28\B2\A9\89\B8\8D\9D\C0\DF\9E\1B\C3\BE\18\99\86\F2\B3\20\7B\E8\DF\DA\8F\A0\79\93\A0\BB\4D\BB\B8\B4
\40\AB\E6\C9\82\93\B0\59\9D\28\67\CD\9A\2D\FF\A9\BA\15\A9\E4\ED\A1\9A\05\A1\D8\4A\28\A5\FC\81\40\F3\85\0B\3B\85\79\C2\23\53\BC\87\02\B5\59\84\C8\70\40\CF\25\E8\73\9E\FA\6F\9F\39\3B\B0\EA\1B\BF\F4\F5\A4\B9\2B\AF\DA\09\A5\3B\AB\C1\FA\13\88\5A
\17\4E\D9\AF\C2\BA\A7\84\9A\20\6B\BC\56\A7\B7\75\89\5B\F1\BC\78\9D\85\7C\71\92\11\A4\4F\4E\0E\3F\80\7F\C9\D5\09\85\60\75\9C\07\06\A1\36\8D\7C\04\AD\7C\58\0B\B9\A4\AD\97\D8\B3\7C\4F\06\0E\EC\78\21\EB\3A\0F\8F\07\A8\9C\CF\97\59\5D\96\AC\B9\8E
\99\63\95\AC\C0\5C\72\B9\68\CD\39\6E\CE\0C\C1\AC\AC\EB\8D\0E\80\CF\38\27\97\F9\82\EA\19\0C\E0\A0\7F\C6\5C\72\04\07\53\2E\05\31\BF\A2\55\53\C8\B8\85\BC\58\89\C9\2B\CB\C9\7A\5D\C9\B5\07\CA\1C\A4\3F\9C\A9\CA\C0\43\CB\5C\72\D7\CB\5C\5C\0B\BA\04
\AD\B9\F8\5C\24\CF\60\F9\CC\29\55\CC\7C\CB\A4\7C\D1\A8\78\27\D5\9C\D8\CC\1C\E4\CA\3C\E0\CC\99\65\CE\7C\EA\CD\B3\E7\97\0C\E2\92\CC\E9\97\4C\EF\CF\DD\4D\CE\79\80\28\DB\A7\D0\6C\8F\D0\BA\A4\4F\5D\10\7B\D1\BE\D7\18\46\44\AE\D5\D9\7D\A1\79\75\8B
\D1\C4\92\DF\2C\58\0E\4C\5C\5C\C6\18\78\C6\C8\1C\3B\55\D7\C9\57\74\80\76\9F\C4\5C\5C\4F\78\57\4A\39\13\C8\92\D7\52\35\B7\57\69\04\4D\69\5B\87\1C\4B\88\07\80\66\28\5C\30\E6\BE\64\C4\9A\D2\E8\BF\A9\B4\5C\72\EC\08\4D\C4\E1\C8\D9\37\BF\3B\C8\C3
\C6\F3\D2\F1\E7\D3\36\10\89\4B\CA\A6\49\AA\5C\72\C4\DC\C3\78\76\5C\72\B2\56\33\D5\DB\DF\C9\B1\2E\CC\01\E0\52\F9\C2\FE\0F\C9\18\8D\E1\7C\9F\E1\BE\19\1C\5E\32\89\5E\30\DF\BE\5C\24\A0\51\CD\E4\5B\E3\BF\44\F7\E1\DC\A3\E5\3E\31\27\5E\58\0B\7E\74
\81\1E\31\5C\22\1E\36\4C\9D\FE\9B\2B\FE\05\BE\41\E0\9E\65\E1\1C\93\E6\DE\1D\E5\49\91\E7\7E\9F\E5\E2\B3\E2\B3\40\DF\D5\0E\AD\F5\0C\70\4D\3E\D3\6D\3C\B4\D2\53\4B\CA\1B\E7\2D\48\C9\C0\BC\54\1D\05\37\36\D9\53\4D\66\67\A8\3D\BB\1E\C5\47\50\CA\B0
\9B\50\D6\5C\72\B8\E9\3E\CD\02\F6\BE\A1\A5\32\53\62\5C\24\95\43\5B\D8\D7\EF\28\1E\C4\29\9E\DE\25\51\23\47\60\75\F0\B0\C7\47\77\70\5C\72\6B\DE\4B\65\97\7A\68\6A\D3\04\93\7A\69\28\F4\E8\72\4F\AB\F3\11\C4\DE\D3\FE\D8\54\03\3D\B7\37\B3\F2\EE\7E
\0C\FF\34\5C\22\65\66\9B\7E\0B\ED\64\99\F4\1B\ED\56\FF\5A\89\9A\F7\55\95\2D\EB\62\27\56\B5\4A\B9\17\5A\37\1A\DB\F6\C2\29\54\91\A3\38\10\2E\3C\BF\52\4D\FF\5C\24\89\9E\F4\DB\D8\27\DF\62\79\EF\5C\6E\35\F8\83\DD\F5\5F\8E\0C\E0\77\F1\CE\18\B0\16
\ED\55\1A\F0\92\60\65\69\DE\BF\4A\94\17\62\A9\67\F0\75\8D\1C\53\CD\EB\3F\CD\E5\60\F6\E1\9E\EC\2B\BE\CF\EF\20\4D\EF\67\E8\37\60\F9\EF\ED\5C\30\A2\5F\04\D4\2D\FB\1C\9F\F5\0C\5F\0E\F7\17\96\3F\F5\46\B0\5C\30\11\93\F5\8D\B8\58\02\82\1B\E5\B4\06
\92\5B\B2\AF\4A\9C\38\26\7E\19\44\23\C1\F6\7B\50\95\1E\D8\F4\34\DC\97\BD\F9\5C\22\9B\1A\10\1B\5C\30\CC\16\C0\80\8B\FD\A7\81\1C\03\1B\FD\40\D2\93\05\96\A5\5C\30\46\20\3F\0F\2A\8F\A0\12\5E\F1\EF\8D\B9\E5\AF\1A\77\EB\D0\9E\3A\F0\17\81\BE\75\E0
\CF\33\78\4B\CD\5E\18\F3\77\93\BC\A8\DF\AF\89\79\5B\D4\9E\28\9E\E6\96\11\B5\23\A6\18\2F\7A\72\5F\94\67\B7\E6\3F\BE\06\5C\30\3F\80\31\77\4D\52\07\26\4D\BF\01\13\86\F9\3F\AC\15\53\74\80\54\5D\1B\DD\B4\47\F5\3A\49\B7\E0\A2\F7\88\29\87\A9\42\EF
\88\11\8B\0B\20\76\F4\A7\92\BD\31\E7\0F\3C\1E\F4\11\1E\74\C8\E2\36\BD\3A\06\8F\13\57\7B\C0\1E\8A\F4\78\1D\3A\3D\C8\EE\91\83\8C\0F\DE\9A\F3\F8\3A\C2\21\21\05\5C\30\78\9B\D5\14\98\A3\F7\71\26\E1\E8\30\7D\7A\5C\22\5D\C4\DE\6F\95\7A\A5\99\D2\6A
\C3\77\1A\D7\DF\CA\DA\C1\7F\36\B8\D2\4A\A2\50\DB\9E\5B\5C\5C\03\20\17\01\7D\FB\AA\60\53\12\99\5C\30\E0\A4\71\48\05\1C\4D\EB\2F\37\42\92\80\50\03\B0\1F\C2\C4\5D\46\16\54\E3\08\95\1E\1E\38\53\35\B1\1E\0B\2F\49\D1\5C\72\8C\5C\6E\02\20\1F\81\EE
\15\4F\AF\1F\14\30\61\51\5C\6E\A0\3E\C3\32\14\AD\6A\85\3B\3D\DA\AC\DB\64\41\1A\3D\AD\70\A3\56\4C\29\58\F5\5C\6E\16\7F\C2\A6\15\60\65\5C\24\12\98\54\C6\A6\51\4A\9D\CE\16\6B\B4\37\AA\2A\4F\EB\0E\90\12\20\2E\17\89\88\85\F2\C4\A1\81\5C\72\F6\B5
\9A\5C\24\23\70\DD\57\54\3E\21\AA\AA\76\7C\BF\A2\14\10\13\7D\EB\D7\A0\2E\25\98\18\C1\2C\3B\A8\EA\08\9B\E5\19\05\05\85\AD\1A\DA\0B\66\2A\3F\AB\E7\84\98\EF\F4\84\5C\30\B8\C4\70\03\44\9B\B8\21\20\B6\F5\23\3A\4D\52\63\FA\01\E8\13\42\1A\2F\30\36
\A9\AD\AE\09\37\03\40\0B\5C\30\56\B9\76\67\80\A0\D8\C4\68\5A\5C\6E\52\5C\22\40\AE\C8\46\14\09\91\CA\E4\19\BC\2B\CA\9A\B0\45\9F\04\49\DE\5C\6E\38\26\32\D2\62\58\FE\50\10\C4\AC\80\CD\A4\3D\68\1F\5B\06\A7\A5\E6\2B\10\D5\CA\89\5C\72\3A\C4\CD\46
\FB\5C\30\3A\2A\E5\DE\5C\72\7D\23\FA\88\21\5C\22\A4\63\0B\3B\68\C5\A6\2F\30\83\B7\DE\92\F2\45\6A\AE\ED\C1\82\CE\5D\F1\5A\92\8E\1E\88\91\97\5C\30\DA\40\69\57\1B\5F\96\94\AE\68\9B\3B\8C\56\90\8D\52\62\B0\DA\50\1E\25\21\AD\EC\0B\62\5D\53\42\9A
\83\92\F5\55\6C\1A\09\1B\E5\E2\12\B3\E9\08\72\13\06\08\88\DC\5C\72\C0\2D\02\08\14\5C\30\A0\04\C0\5C\22\81\51\3D\C0\49\02\68\11\D2\CD\19\15\06\80\B4\09\20\46\02\91\F9\0F\FE\4C\E8\CE\46\78\52\82\D1\8D\08\12\40\9C\05\5C\30\2A\C6\6A\35\11\9D\8C
\FC\6B\5C\30\CF\19\30\27\81\08\09\40\45\02\1C\6C\80\4F\1A\98\DA\C6\48\05\A0\43\02\78\13\13\DC\05\40\5C\22\47\06\34\31\C4\02\60\11\CF\BC\05\50\28\47\1E\39\31\AB\8E\10\15\5C\30\84\04\F0\5C\22\01\66\3A\51\CA\8D\B8\0B\40\A8\04\60\27\81\3E\37\D1
\C8\8E\E4\64\C0\A8\04\88\ED\C7\52\34\31\E7\3E\CC\72\49\9D\1E\48\F5\47\74\5C\6E\80\52\8F\48\09\C0\C4\62\D2\8F\80\B6\37\31\BB\8D\EC\66\E3\68\29\44\AA\84\38\05\A0\42\02\60\13\C0\86\04\B0\28\81\56\3C\51\A7\01\38\14\63\3F\20\10\32\80\B4\08\80\45
\8E\34\6A\5C\30\9C\05\39\07\81\BC\5C\72\82\CD\90\19\FF\40\8B\1E\5C\30\27\46\FA\44\11\9A\14\A2\2C\C5\15\21\D3\FF\48\8D\3D\D2\2A\14\A0\88\45\ED\1A\28\D7\C6\C6\3F\D1\AA\26\78\19\64\5F\1E\48\F7\C7\A2\45\B2\36\11\C4\7E\A3\75\1B\C8\DF\47\5C\30\52
\81\58\03\10\FD\C0\5A\7E\50\27\01\55\3D\C7\DF\02\A0\12\40\9E\04\E8\CF\C8\6C\2B\41\AD\5C\6E\84\68\A3\49\1A\69\15\C6\94\FC\B1\9F\18\50\47\80\5A\04\60\5C\24\C8\50\08\87\FE\91\10\13\C0\A4\04\D9\2E\14\DE\3B\C0\45\02\C0\15\5C\30\82\7D\80\20\A7\B8
\08\51\B1\02\A4\93\E4\D3\25\E8\D1\C9\6A\41\92\57\92\D8\A5\5C\24\BB\21\18\FD\C9\02\33\72\31\91\20\7B\D3\89\25\69\3D\49\66\4B\02\94\21\8C\65\5C\24\E0\9E\E9\38\CA\30\0F\21\FC\01\68\13\23\5C\5C\04\B9\48\46\7C\8C\69\38\8D\74\6C\5C\24\83\1F\F0\13
\CA\6C\C0\12\81\8F\EC\6C\E4\69\2A\28\EF\47\B8\04\F1\E7\4C\09\07\1D\20\DF\5C\24\80\97\78\D8\2E\E8\71\5C\22\90\57\7A\06\73\7B\14\38\64\60\26\10\F0\1C\06\57\06\04\1C\04\F4\A9\5C\30\26\45\B4\AF\CD\EC\31\35\90\0E\6A\57\E4\1B\62\1C\AC\1B\F6\C4\87
\10\CA\DE\56\A9\52\84\1C\B3\99\BF\2D\23\7B\5C\30\8A\58\69\03\03\A4\B2\C4\67\2A\F7\9A\37\D2\56\46\33\8B\60\19\E5\A6\8F\A9\70\40\F5\C5\0E\23\37\B0\09\E5\86\02\30\19\80\E6\5B\D2\AE\96\AC\B8\5B\F8\C3\A9\68\CB\96\5C\5C\E1\06\6F\7B\C8\E1\08\DE\54
\AD\CA\D2\5D\B2\EF\97\8C\BC\C5\A6\E1\91\80\38\6C\60\66\40\97\18\72\65\68\B7\A5\5C\6E\CA\DE\57\32\C5\2A\40\0F\10\5C\30\80\60\13\4B\28\A9\05\4C\95\CC\B7\5C\30\76\54\83\02\CB\5C\30\E5\63\27\19\4C\AF\8A\90\05\C0\3A\84\94\08\20\30\98\BC\18\40\4C
\02\31\D7\06\54\30\62\A2\13\E0\68\02\FE\18\12\57\CC\7C\5C\5C\C9\2D\1D\E8\EF\CF\44\4E\87\F3\9E\80\5C\6E\73\12\03\33\02\C0\DA\5C\22\B0\80\A5\B0\60\C7\A2\01\F9\E8\82\92\90\10\32\AA\E5\80\26\BE\01\88\5C\72\9C\55\2B\99\5E\CC\E8\52\89\65\53\8B\6E
\9B\69\30\D9\75\CB\9A\62\09\4A\98\92\1B\80\B9\32\73\B9\CD\70\83\73\5E\6E\3C\B8\A5\F2\E2\99\B1\90\46\6C\B0\61\02\D8\17\5C\30\B8\9A\19\B4\5C\30\92\6D\41\32\9B\60\7C\D8\9F\36\09\87\A6\12\6E\72\C1\9B\A8\17\5C\30\44\05\D9\BC\CD\EC\37\CB\26\6D\DC
\DF\A7\01\2D\29\B8\CA\DA\5C\5C\A9\C6\13\E4\DD\8C\5C\6E\3D\E2\A4\0C\96\11\E0\3B\2A\A0\1C\82\10\DE\62\8D\84\E8\93\88\C4\54\0B\93\82\79\37\63\FA\81\7C\6F\A0\2F\96\D4\DF\19\DF\3A\10\9D\8B\EE\74\A1\50\9D\3C\D9\C0\59\3A\A0\9E\4B\B8\26\43\04\0B\B4
\EC\27\47\2F\C5\40\CE\E0\51\A0\2A\9B\38\0B\E7\76\92\02\2F\87\C0\26\13\BC\02\FC\F2\57\ED\36\70\2E\5C\30\AA\75\33\AB\9E\8C\F1\42\71\3A\28\65\4F\50\07\E1\70\09\94\E9\A7\B2\FC\D9\E3\5C\72\9C\8B\E1\30\9E\11\28\61\63\3E\10\BA\4E\F6\7C\A3\BA\09\93
\1B\18\74\07\B9\D3\5C\6E\36\76\C0\5F\01\84\EE\65\DD\3B\79\D5\CE\E8\36\66\8F\9D\04\FC\67\51\3B\79\FA\CE\B2\5B\53\F8\09\E4\EB\67\F6\C7\B0\E8\4F\92\75\64\A1\64\48\0B\80\48\17\F0\3D\01\04\05\A0\5A\5C\72\04\E6\27\DA\CA\F9\71\43\2A\80\29\A0\9E\9C
\EE\67\C2\C7\45\EA\4F\92\80\20\5C\22\A0\1C\F0\A8\0C\06\21\6B\D0\28\27\80\60\9F\5C\6E\6B\68\54\02\F9\C4\2A\F6\73\88\C4\35\52\A4\45\F6\61\5C\6E\1B\23\10\D6\21\31\A1\9C\BF\04\89\02\14\D7\5C\30\A1\3B\C6\C7\53\C2\69\C8\BC\06\40\28\0C\E0\6C\A6\C1
\1F\B8\49\D7\20\CC\02\76\5C\72\9C\6E\03\6A\7E\D8\E7\8A\36\33\81\BF\0C\CE\88\F4\49\3A\68\B0\D4\C2\12\83\0F\5C\6E\2E\89\AB\32\12\70\6C\06\C4\39\42\74\0C\E2\30\5C\24\16\1B\62\BA\86\70\2B\94\C7\80\2A\8B\74\4A\A2\F0\CC\04\BE\73\86\4A\51\38\3B\34
\50\28\FD\14\86\D2\A7\D1\B6\17\21\92\80\2E\50\70\6B\40\A9\29\36\1E\B6\35\FD\0C\94\21\B5\19\28\F8\93\5C\6E\2B\A6\D8\7B\60\3D\1C\A3\B8\48\2C\C9\81\5C\5C\D1\B4\80\34\83\12\5C\22\5B\03\B2\43\F8\BB\BA\31\93\B4\8C\2D\8D\13\E8\CC\6C\75\6F\B5\E4\B8
\34\95\5B\99\B1\E2\85\45\CA\25\87\5C\22\8B\F4\77\14\5D\20\D9\28\04\E3\20\1C\CA\8F\54\65\A2\8D\1A\29\03\15\EA\4B\B4\41\93\45\3D\7B\20\5C\6E\05\B7\02\60\3B\3F\DD\02\F4\9C\2D\C0\47\8A\35\49\A1\ED\AD\D2\2E\25\C1\A5\B2\FE\E9\71\25\45\9F\97\1D\FD
\14\73\A2\E9\1E\A9\67\46\17\1E\88\B9\73\09\89\A6\B8\9E\8A\0F\4B\BA\47\D1\F8\6E\34\69\2F\2C\AD\69\30\B7\75\E8\81\78\0E\10\29\37\1D\33\08\8C\53\7A\67\8C\E2\8D\C1\56\5B\A2\AF\68\E3\44\70\27\D1\4C\3C\54\4D\A4\0C\E4\6A\01\50\2A\6F\9C\E2\89\B4\91
\5C\6E\48\CE\13\04\07\DA\7F\C5\5C\6E\A0\34\7F\A8\4D\2D\57\F7\4E\CA\41\2F\EE\90\86\40\A4\38\7F\08\6D\48\A2\82\52\70\80\74\9E\08\70\84\56\94\3D\1A\68\2A\30\BA\C1\09\A5\31\3B\5C\30\75\47\91\CA\54\36\92\40\73\19\99\5C\30\29\F4\36\C0\16\96\C6\A3
\54\9D\5C\5C\85\28\5C\22\8E\E8\C5\55\2C\F2\95\43\3A\8B\A5\35\69\C9\4B\9A\6C\AB\9D\EC\82\DB\A7\A1\45\2A\8C\5C\22\EA\72\9D\E0\A6\D4\CE\2E\40\08\6A\52\E2\4A\96\51\EE\8C\D5\2F\A8\BD\4C\40\D3\53\5A\94\91\A5\50\F5\29\28\6A\1E\6A\9E\06\4A\A8\AB\12
\AB\14\8E\AA\DD\4C\2A\04\03\AA\AF\C4\5C\30\A7\AA\DB\5C\72\A2\2D\88\F1\51\2A\84\51\DA\9C\15\67\AA\8D\39\E9\7E\50\40\85\D5\D4\48\B3\91\AC\5C\6E\2D\65\BB\5C\30\EA\7F\51\15\77\25\5E\20\19\45\54\F8\3C\20\32\13\04\48\01\FE\10\01\40\DE\B4\EE\65\A5
\5C\30\F0\06\20\65\23\3B\F6\D6\1E\49\82\54\92\6C\93\A4\DD\2B\41\2B\43\06\2A\92\59\01\8C\A2\AA\68\2F\F8\15\08\07\44\02\5C\5C\17\F0\A3\21\E9\AC\9A\38\93\C2\BB\33\81\41\D0\99\C4\D0\45\F0\CD\45\A6\2F\14\7D\30\74\B5\4A\7C\99\12\04\C0\DD\31\51\6D
\AB\D8\6E\25\28\AC\70\B4\EB\1E\21\5C\6E\C8\D1\C2\B1\55\CB\29\5C\72\73\45\7F\58\FA\82\92\35\75\25\42\2D\20\B4\C0\77\5D\A1\2A\95\0E\BB\45\A2\29\01\3C\2B\BE\A6\71\79\56\B8\40\15\B0\6D\10\46\48\04\20\07\F2\D4\14\9A\42\4E\23\FD\5D\C3\59\51\31\B8
\D6\3A\AF\EC\56\23\F9\5C\24\93\E6\A0\FE\90\F4\3C\26\17\88\58\14\84\80\A1\FA\FF\85\78\AB\A0\74\9A\18\40\5D\06\47\F0\ED\D4\B6\8F\A5\6A\29\2D\40\97\71\01\D0\1E\88\4C\5C\6E\63\F7\1C\49\B0\59\1C\3F\71\43\01\B4\5C\72\E0\76\03\28\10\40\D8\06\CB\03\58\5C\30\4F\76\1F\16\A3\3C\AC\52
\15\E5\33\58\1C\A9\B5\10\AC\51\BE\4A\E4\1C\96\C9\0B\FC\39\D6\39\0E\C8\0F\6C\78\07\43\75\15\C4\AB\64\B1\B1\20\76\54\B2\5A\6B\1B\15\6C\5C\72\D3\4A\0F\ED\8F\C0\5C\5C\6F\9B\26\3F\94\6F\36\45\0E\D0\71\A0\B0\04\B3\15\1B\AA\C9\D0\13\03\5C\72\96\07
\0C\F7\AB\27\33\FA\CB\C9\AA\03\98\15\4A\B4\36\EB\27\59\40\C8\04\36\01\C9\03\46\5A\07\35\30\87\56\CD\16\54\B2\79\8A\AC\98\43\60\1C\5C\30\E4\DD\56\53\21\FD\9A\8B\26\03\DB\36\94\36\C9\D1\7F\B3\1B\72\44\A7\66\60\EA\9B\A8\4A\76\71\03\7A\84\AC\E0
\1B\1B\46\BF\A0\C2\C2\F2\B4\40\1B\E8\B8\DD\B5\85\16\9A\D2\85\5A\2E\5C\24\05\6B\58\10\6B\4A\DA\5C\5C\AA\5C\22\CB\5C\22\E0\1B\D6\9D\69\B0\EA\AB\3A\D3\45\FF\B5\08\CE\5C\72\6F\58\C1\5C\30\3E\50\05\96\A5\15\50\F0\6D\69\5D\5C\30\14\AA\F6\1A\F6\93
\B5\61\56\A8\B8\3D\11\BF\AA\C8\49\36\A8\B4\B0\CE\08\D3\6A\4B\33\DA\F2\D4\05\5A\B5\51\A6\6D\89\45\C4\E8\81\F0\0F\62\D3\30\3A\9F\0C\0E\33\32\BA\56\34\4E\36\B3\B4\E0\91\21\F7\6C\EB\5E\DA\A6\D9\40\68\B5\68\55\8D\D0\3E\3A\FA\09\16\98\05\D0\45\9B
\3E\6A\E4\E8\D0\FA\81\30\67\B4\5C\5C\7C\A1\53\68\E2\37\1B\79\07\C2\DE\84\8D\5C\24\95\86\2C\35\61\C4\97\37\26\03\A1\EB\B0\3A\5B\03\57\58\34\CA\D8\1C\71\D6\20\10\9D\8B\EC\4A\B9\C6\E4\D7\82\DE\63\38\21\B0\0F\48\B8\1A\E0\D8\56\44\A7\C4\8E\12\AD
\17\2B\ED\44\8A\3A\1B\04\91\A1\A5\B0\39\2C\44\55\61\21\B1\58\5C\24\91\D5\D0\AF\C0\DA\8B\03\47\12\C1\DC\8C\8A\42\8A\02\74\39\2D\2B\6F\DB\74\94\8D\4C\F7\1D\A3\7D\C4\AD\F5\71\4B\8B\91\78\36\26\AF\AF\25\78\94\CF\74\52\90\BF\96\E9\04\F0\5C\22\D5
\CF\80\E8\52\82\49\57\41\60\63\F7\B0\C8\7D\6C\36\1C\1B\80\C2\7E\C4\17\2A\B8\30\76\6B\FD\70\AB\81\DC\36\C0\EB\9B\1F\38\7A\2B\A1\71\FA\58\0E\F6\E4\77\2A\B7\45\83\AA\49\4E\9B\B6\15\AA\E5\B6\EA\2A\71\50\4B\46\4F\5C\30\1E\DD\2C\9E\28\06\16\D0\1C
\80\7C\9C\95\91\94\B0\6B\20\2A\59\19\0F\17\46\35\94\E5\0E\E5\3B\93\3C\36\08\B4\40\D8\1A\51\55\97\5C\22\D7\13\F0\5C\72\62\D8\4F\41\58\1A\C3\8E\76\E8\F7\76\AF\29\48\AE\F4\6F\60\1E\53\18\0E\54\C8\0B\70\62\07\6A\31\2B\C5\8B\A2\65\B2\C1\99\20\CA
\80\51\78\10\38\01\40\0B\A1\87\1D\D0\C8\E7\35\5C\5C\51\A6\2C\8C\0E\01\87\1A\B8\C4\89\4E\14\EB\DD\DE\98\62\23\59\BD\48\A5\AF\70\31\9B\D6\CA\F8\6B\42\A8\03\38\1B\4E\FC\6F\FB\58\33\2C\23\55\DA\A9\E5\27\C4\5C\22\86\E9\94\80\C2\65\65\48\23\7A\9B
\AD\71\5E\72\47\5B\10\B8\97\3A\BF\5C\72\B8\6D\8B\6E\67\F2\DC\CC\0C\B7\35\03\BD\A5\56\8D\5D\AB\F1\2D\28\DD\57\F0\BF\30\E2\EB\D1\7E\6B\68\5C\5C\98\0C\84\5A\8A\E5\60\EF\E9\6C\B0\EA\C4\DC\05\04\6B\20\1B\82\6F\CA\10\6A\F5\57\D0\21\80\2E\AF\68\46
\8A\D4\E5\5B\74\D6\41\87\77\EA\BF\65\A5\4D\E0\AB\AB\A1\01\90\33\21\AC\B5\CD\E6\B0\0F\6E\4B\5F\53\46\98\6A\A9\BF\FE\08\2D\53\82\5B\72\9C\CC\80\77\E4\B4\F8\1A\30\13\5E\C1\68\84\66\FC\18\2D\B4\AD\FD\B0\3F\82\9B\FD\58\F8\35\97\2F\B1\A9\8A\80\EB
\13\EB\49\59\20\C5\56\37\B2\61\16\80\64\03\20\1C\87\38\B0\62\71\B7\B5\62\83\6E\1F\5C\6E\31\59\52\C7\76\54\B1\F5\95\2C\83\14\2B\21\D8\FD\FC\B6\4E\12\C0\54\A3\EE\10\10\32\12\10\49\C3\DF\B7\8D\C4\C4\F7\84\C7\F2\D8\08\87\F5\A9\4B\60\1B\4B\10\5C
\22\F0\13\BD\F4\A3\F7\4F\29\5C\6E\59\AD\DA\34\21\7D\4B\A2\5E\B2\EA\C2\E0\44\40\E1\85\F7\6E\61\88\0C\5C\24\40\03\A6\20\83\C6\5C\24\41\8A\94\6A\C9\CB\C7\17\F8\11\03\5C\5C\8B\44\5B\3D\CB\09\62\48\70\F9\53\4F\41\47\1A\1F\97\68\6F\21\46\7F\40\08
\6C\84\55\CB\7F\DD\60\58\6E\5C\24\5C\5C\98\CD\88\5F\86\A2\CB\98\60\B6\81\E2\0B\48\42\C5\D5\5D\AA\32\0B\FC\08\AB\A2\5C\22\7A\30\69\31\8B\02\5C\5C\94\DE\C7\C2\D4\77\F9\2E\85\66\02\01\79\07\DE\BB\4B\29\0E\08\0B\A3\EE\ED\C2\8F\87\B8\06\20\70\03
\C0\08\30\E4\B8\10\11\81\8F\1A\58\C2\53\3E\31\09\1D\2A\2C\5D\92\E0\5C\72\5C\22\FF\02\B9\16\08\0E\16\90\3C\63\51\B1\01\F1\5C\24\74\8B\84\71\8D\9C\2E\8B\FC\09\12\3C\15\F0\AC\F1\99\8E\2B\74\2C\A9\5D\4C\F2\21\C8\7B\80\67\8E\FC\19\E3\58\A4\B6\5C
\24\03\90\19\A4\36\07\76\02\04\85\81\98\F9\C7\20\A1\8E\9A\07\A3\25\47\DC\48\F5\96\C4\D8\0B\9C\C8\13\45\8E\8D\A0\D2\58\C3\C8\2A\C1\82\1C\05\30\DB\8A\29\71\A1\0B\01\6E\43\D8\29\49\9B\FB\E0\5C\22\B5\E5\DA\C5\DE\0C\ED\88\B3\AC\14\60\84\4B\46\E7
\C1\9D\92\40\EF\64\BB\35\8C\EA\BB\41\C8\C9\70\1B\80\7B\93\5C\5C\19\E4\D3\07\C0\70\C9\BE\4E\F2\72\06\EC\27\A3\53\28\2B\35\AE\D0\8A\2B\A0\5C\22\B4\C4\80\A3\15\16\55\30\C6\02\69\CB\90\DC\06\9B\FA\E6\21\0B\6E\4D\88\11\F9\62\72\4B\0C\C0\F0\E4\36
\C3\BA\A1\72\96\02\EC\A5\E2\AC\7C\61\FC\CA\C0\88\40\C6\78\7C\AE\B2\6B\1E\61\0B\0E\CD\39\57\52\34\5C\22\3F\81\08\35\CA\0F\AC\70\FD\DB\93\95\F1\6B\84\72\C4\98\AB\B8\A8\FD\DF\92\1A\F0\E6\01\BC\0F\0F\81\37\18\C2\97\48\06\70\86\8B\35\90\59\70\02
\08\57\AE\BC\D8\12\47\0F\1D\23\CF\72\CA\B6\41\57\44\2B\60\AC\01\E4\3D\CA\0E\5C\22\F8\7D\CF\40\48\D1\5C\5C\8E\70\B0\93\9D\0F\D0\80\02\10\14\A9\DF\8B\CC\29\43\33\CD\21\8E\73\4F\3A\29\D9\04\E8\5F\46\2F\5C\72\34\E9\C0\E7\3C\41\A6\85\5C\6E\6E\A0
\2F\01\54\E6\33\66\37\50\31\01\AB\36\D3\C4\03\D9\FD\4F\06\59\D0\BB\CF\B2\87\A2\F3\1F\16\71\EC\D7\3B\EC\D8\81\C0\05\8D\E6\9D\61\FD\58\74\53\3C\E3\18\BC\39\01\C2\14\6E\77\73\B2\78\40\31\CE\9E\78\73\D1\3F\AC\EF\33\C5\9E\40\B9\85\D7\35\34\84\0B
\AE\6F\DC\C8\83\30\BB\DE\D0\05\19\EF\08\70\52\5C\30\D8\06\E0\A6\05\1C\0B\84\86\CE\F9\B7\F3\E2\79\71\DF\07\D5\4C\26\53\15\5E\3A\D9\D2\51\F0\3E\5C\5C\34\4F\49\6E\1A\16\81\83\5A\93\01\6E\E7\F2\76\E0\33\0B\B8\0F\33\F4\2B\50\A8\85\4C\28\F7\C4\0B
\94\F0\85\C0\02\E0\2E\0F\78\0F\A0\5C\24\02\E0\1D\C2\AB\43\1C\E5\87\E9\43\6E\AA\41\9E\6B\E7\63\3A\4C\D9\1E\0F\36\A8\07\CD\C2\72\B3\77\9B\D3\CC\68\B0\BD\D9\C8\1A\6E\72\B3\5A\EA\E3\3D\E8\BB\3D\6A\81\D1\92\98\B3\87\36\7D\1B\4D\9F\47\19\FD\75\7E
\8F\33\F9\9A\C4\62\67\34\C5\F9\F4\73\36\73\F3\51\9D\1C\E9\B1\23\3A\A1\33\67\7E\76\33\7F\9D\BC\F3\80\BF\3C\A1\2B\CF\3C\F4\B3\D2\17\61\7D\CF\A7\3D\CE\65\9D\38\A3\27\6E\03\29\D3\9E\63\43\C7\7A\D1\16\89\34\4C\07\3D\14\68\FD\8C\06\7B\69\1E\90\B4
\B1\9D\4A\01\E7\5E\7E\E7\83\D3\06\77\67\8B\44\E0\BB\6A\1B\4C\D3\E9\CF\5E\9A\9C\D2\C1\3D\36\CE\A7\4E\02\8D\D3\94\EA\C5\C1\A2\1B\5C\5C\E9\DB\44\F3\C6\D1\4E\94\86\EA\45\FD\3F\68\C3\3A\53\C2\2A\3E\84\F4\2B\A1\75\FA\68\68\05\1A\1C\D2\85\0F\B4\57
\9B\45\31\6A\86\78\19\B2\9F\F4\ED\B4\8A\06\74\D6\27\CE\74\E0\5B\A0\EE\77\53\B2\19\10\B8\EA\B7\39\9A\AF\54\F6\AE\13\5B\AB\2C\D5\6A\D2\76\93\F2\D5\EE\9E\74\A3\AC\41\07\04\23\54\99\B8\D4\E6\9E\82\03\39\EC\E8\6A\8B\4B\2D\F5\D2\DE\A0\B3\BF\A8\59
\E8\69\8B\51\1A\65\3F\AE\A3\34\D3\9E\D3\C1\EB\5F\57\7A\DF\CE\0C\E9\F3\8B\40\4A\18\6B\57\59\EA\68\CE\D6\70\75\90\AE\AD\18\E7\6A\7C\7A\34\D7\0E\98\F5\12\16\09\E8\69\98\F0\6D\A2\09\E0\4F\35\E0\16\5C\30\3E\E7\7C\DF\39\C9\D7\96\AB\B5\E8\BD\A0\F6
\EB\67\56\79\D2\D4\06\75\B4\BB\A8\3D\7D\67\73\5F\BA\E3\D4\56\B9\73\D5\AE\7B\E7\6B\A4\0E\40\72\D7\5E\97\F5\DA\28\DD\77\CF\08\05\81\85\01\F8\0F\48\27\B0\DD\61\EC\3D\69\BB\12\D6\4E\C5\34\B5\A8\1D\8B\EB\7F\5F\7B\1B\CF\36\C7\74\CF\A8\DC\F6\CF\97
\65\A0\5B\01\D0\1F\68\2D\A2\93\55\6C\3F\4A\81\EE\83\30\4F\5C\30\5E\1A\DB\12\48\6C\F5\5C\30\2E\B1\10\1E\84\5A\15\82\92\9C\BC\05\E2\10\DA\78\75\80\E6\02\F0\5C\22\01\3C\09\A0\2F\37\C1\8A\A8\1C\DA\20\FB\8B\EF\69\3A\8F\D2\5C\6E\C7\A0\A1\B4\E0\3B
\ED\C7\21\C0\33\DA\C8\19\C0\5F\1F\30\17\81\60\9E\5C\30\48\60\9E\80\C2\32\1F\5C\30\17\80\8C\48\F2\11\01\23\68\80\5B\B6\50\3C\ED\A6\86\91\10\D7\A2\67\B6\DC\1A\9D\A7\6D\40\7E\EF\02\28\FE\D5\5C\30\DF\B5\6B\13\E2\0C\59\BB\76\DA\E6\E2\23\3E\04\A5
\F9\01\84\5C\6E\7A\19\10\5C\6E\98\40\CC\51\F1\08\5C\6E\28\05\E0\47\90\DD\5C\6E\18\F6\04\FC\E0\8E\27\6B\F3\9A\14\A6\E8\02\01\BA\35\93\6E\94\35\DB\A8\11\D8\19\40\5F\60\D0\87\08\5F\6C\80\31\DC\FE\E8\77\70\BF\50\17\EE\9B\77\9B\AA\DE\5C\30\85\8E
\63\B5\D0\17\6F\45\6C\7B\C5\DD\BE\E9\37\93\BB\BC\B6\6F\30\D0\DB\C2\1C\0E\F4\49\62\CF\9D\EA\6E\8B\7A\DB\CA\DE\CE\EF\B7\9B\BC\20\8B\81\E7\7B\C7\07\38\16\F8\77\8E\15\3D\EB\EE\9F\7C\A0\2F\02\79\EA\33\12\61\ED\DF\BC\23\78\71\9F\DB\0E\D8\F2\BF\BB
\40\13\EF\F7\6B\61\E0\21\FF\5C\30\38\05\64\EE\03\6D\88\05\E4\52\5B\77\02\76\C7\8B\52\47\70\38\05\F8\9F\A0\76\F1\5C\24\5A\FC\BD\B8\6D\C8\0E\FB\74\DC\DE\DD\C0\A5\B7\9D\BD\ED\F4\0C\BA\04\DC\06\FB\B7\C7\BD\8D\D4\EE\FB\75\80\6F\DD\70\17\F7\60\32
\F0\E3\6D\7C\08\3B\23\03\08\1E\78\01\BB\6D\F1\6E\E7\7E\3B\CB\E1\56\EB\45\A3\C2\ED\D8\F0\C4\05\FC\33\4F\9F\5C\72\B8\2C\02\7E\1C\6F\BF\77\5B\F2\E1\4E\EA\F8\7D\BA\FE\20\9B\63\6C\02\79\E1\BE\F1\B8\4F\C4\CD\DE\F1\3B\85\9C\3F\E1\7E\EC\80\5E\04\6A
\5C\22\F1\57\7A\BC\3A\DF\27\13\78\57\C2\DE\2E\F1\08\09\C1\75\92\28\1C\B8\C5\C3\9D\E4\71\97\8B\3C\67\E2\E7\14\76\BF\0E\68\57\71\BF\89\5C\5C\3B\DF\9F\1D\38\A1\C3\0E\29\4D\0E\5C\5C\B3\9A\35\76\DA\B7\18\78\3D\68\A6\7F\69\BA\62\2D\90\1B\C0\DE\06
\7C\62\CE\F0\05\E0\70\01\79\8E\44\1C\02\D0\95\48\68\5C\72\63\65\E0\98\1A\79\37\B7\70\AE\EE\78\FE\DC\47\02\80\40\44\3D\19\F0\20\81\D6\F9\A7\31\8C\FF\21\34\52\61\5C\72\A5\39\94\21\5C\30\27\CA\59\81\8C\9F\A5\40\3E\69\53\3E\E6\80\D6\11\A6\9F\6F
\B0\F3\6F\F2\CE\02\66\73\11\18\4F\20\39\A0\2E\11\ED\FE\E9\E2\5C\22\D0\46\82\85\6C\1C\8D\06\F3\32\05\1B\30\E5\F0\45\21\51\9A\E1\A6\E7\CB\90\44\39\0C\64\D1\42\57\34\83\9B\19\5C\30\FB\82\79\0C\60\52\03\6F\46\10\3E\46\C4\08\61\84\89\30\91\F9\CA
\19\83\F3\01\30\09\C0\32\03\E7\3C\82\49\CF\50\27\81\1C\06\5C\5C\F1\E7\C8\49\0F\CC\05\5C\30\5C\24\9F\9C\5C\6E\20\52\02\A0\0C\61\55\D0\2E\82\73\D0\84\AB\E6\18\5C\22\F9\8E\9A\31\D0\86\85\65\BA\01\59\E7\A0\A2\84\5A\EA\71\9C\01\F1\31\A0\7C\C7\F7
\23\AF\47\21\B1\50\92\50\0F\5C\30\7C\89\48\C7\46\6E\07\70\3E\57\FC\3A\A2\9E\60\59\17\16\50\11\25\94\01\C4\8F\E2\9F\5C\6E\C8\61\38\89\C3\50\3E\01\0B\91\C1\C1\E8\96\18\99\60\04\5D\91\8B\34\0F\9C\60\3C\D0\72\5C\30\F9\C3\8E\9B\81\E7\A8\FB\A1\02
\18\96\7A\96\10\0E\34\D9\03\87\1C\A5\CB\38\90\80\F9\CE\D0\34\01\F3\8D\60\6D\E3\68\1F\3A\A2\07\CE\AA\01\AC\48\44\AA\E3\C0\6A\0F\CF\2B\70\3E\2A\E4\8B\C3\C4\EA\38\14\E4\9F\D5\A0\30\81\38\0F\97\41\B8\C8\1F\3A\80\C0\BB\D1\81\15\B4\5D\77\EA\15\C3
\BA\F9\7A\3E\39\5C\6E\2B\AF\E7\E7\03\CD\1E\C0\F1\D8\3A\8E\81\97\B0\69\69\93\0F\50\6F\47\30\B0\D6\F6\31\FE\AC\29\EC\8A\5A\B0\DA\96\E8\11\6E\A4\C8\1D\92\EC\D7\65\52\D6\96\DC\ED\87\67\A3\4D\A2\03\E0\94\C0\8C\67\73\1E\89\4C\43\BD\72\E7\38\D0\80
\8D\21\B0\86\C0\82\8C\33\52\0C\29\CE\FA\30\B3\30\8C\F4\73\A8\49\8F\E9\4A\88\56\50\70\12\4B\5C\6E\7C\39\65\5B\03\E1\95\D6\C7\CB\91\B2\92\44\30\A1\D5\1A\A0\E0\7A\34\CF\91\AA\6F\A5\D4\E9\E1\E8\E0\B4\2C\4E\38\6E\E5\D8\73\B5\23\1D\7B\E8\93\B7\7A
\33\F0\3E\12\07\B8\42\53\14\FD\5C\22\3B\C0\07\65\35\56\44\30\B1\AC\08\9A\5B\5C\24\37\7A\30\AC\BA\F8\C3\CB\E3\3D\38\FE\09\54\06\20\33\F7\BB\A8\51\F7\03\27\52\92\B1\97\92\8F\D8\6E\C8\13\BC\4C\D0\13\79\C5\8B\10\EC\F6\27\A3\5C\30\6F\E4\DB\2C\08
\BB\89\5C\30\3A\01\5B\1B\7D\28\92\A2\83\7C\0C\1A\D7\FA\87\58\86\3E\19\10\78\76\71\57\E1\93\3F\0C\74\42\D2\45\31\77\47\3B\F3\21\AE\DD\8B\35\CE\80\7C\C7\30\AF\BB\4A\49\40\AF\12\A8\23\A2\88\DE\75\1E\C5\86\49\E1\9E\F8\5C\5C\70\38\DB\03\21\27\82
\5D\DF\AE\8F\9A\6C\2D\80\6C\E5\53\DF\42\D8\F0\2C\1F\D3\97\B7\BB\F2\08\5D\E8\F1\AC\05\31\10\87\D4\95\48\F6\14\FF\4E\C2\38\07\0F\25\25\A4\09\9D\C5\0F\2F\90\3B\90\46\47\53\F4\F2\F4\68\E9\5C\5C\D9\84\D3\0E\63\D4\74\81\10\B2\A1\E1\02\32\7C\F9\57
\DA\5C\24\74\F8\7F\CE\3C\04\CB\68\14\DD\4F\8A\AC\2B\23\A6\42\EA\61\4E\10\1B\31\F9\E7\7B\02\D8\1F\D0\02\79\CA\77\81\F2\9A\10\B0\32\81\5C\5C\5A\26\29\BD\1B\64\B0\62\27\9E\8D\2C\58\0C\78\6D\C3\7E\82\48\83\E7\40\3A\08\64\09\3E\3D\2D\9F\A6\0B\6C
\4B\AF\17\8C\DC\8F\FE\4A\ED\80\19\5C\30\9F\8F\CC\CC\81\F3\40\80\72\03\CF\A5\02\B2\06\40\5C\22\8C\28\0C\41\C1\F1\EF\AA\FD\5A\12\BC\37\C5\68\3E\A5\1F\14\F7\AD\BD\5C\5C\1A\CD\E6\FA\A8\23\3E\AC\F5\F8\19\5C\30\AD\83\16\58\72\E3\97\59\F8\EF\59\78
\C5\9D\E6\71\3D\3A\9E\9A\D4\B9\F3\5C\72\6C\8A\6F\E6\1C\6D\87\67\1D\62\F6\F6\C0\BF\C0\98\1A\EF\01\84\44\5F\E0\54\78\17\B7\43\B3\8D\DF\30\2E\8A\F4\79\80\0F\86\52\04\5D\DA\5F\1E\DD\EB\C7\01\5A\F1\C7\BB\57\F6\49\E0\EB\0B\47\D4\12\7F\EF\09\4D\C9
\AA\28\AE\C9\11\7C\40\5C\30\53\03\4F\AC\C8\73\DE\13\20\7B\EE\A3\94\88\F8\40\6B\7D\8F\E4\46\58\0E\53\DB\62\38\03\E0\E5\3D\BE\C8\5F\8A\D4\0B\94\B9\6C\B2\5C\30\E5\3D\C8\67\C1\CA\7B\A0\48\FF\15\C9\79\47\FC\D5\E1\DB\20\73\9C\5F\FE\4A\5C\24\68\6B
\FA\46\BC\71\1E\84\17\E0\9F\06\F7\A2\C9\64\34\06\CF\89\F8\BB\E6\D6\27\F8\BD\90\3E\76\06\CF\8F\AC\A0\21\5F\37\F9\17\56\71\AD\D3\40\31\7A\EB\A4\75\53\65\85\F5\6A\4B\64\06\79\75\EB\DB\C2\53\A9\2E\82\32\8C\5C\22\AF\7B\FA\CC\4B\FE\D8\CB\3F\98\73
\B7\E4\AC\CB\A6\68\92\DF\52\ED\16\64\82\0B\E9\60\3A\79\97\D9\E5\1E\FB\47\DA\BE\5C\6E\51\E9\0B\FD\B7\D9\DF\6F\08\77\92\84\27\F6\EF\68\53\97\EE\3E\9D\F1\A9\B6\08\89\4C\D6\58\7D\F0\88\65\B7\A7\B8\47\BE\E2\AD\40\39\FD\E3\ED\9F\88\FC\57\DD\7C\ED
\F8\CF\B9\FB\40\95\5F\88\F7\75\5A\3D\A9\87\2C\B8\E5\CC\21\7D\A5\DE\0F\C2\5C\30\E4\49\40\88\E4\23\B7\B6\5C\22\B1\27\E3\59\60\10\BF\D2\5C\5C\3F\CC\DF\70\F3\B7\EA\2C\47\FA\AF\B5\FD\D7\9C\5F\AE\B1\27\E5\7F\47\FA\FF\B2\01\D0\09\9F\54\10\86\82\0F
\23\FB\6F\9F\CD\48\5C\72\FE\12\87\5C\22\CA\03\EB\FA\6F\E3\7D\A7\F2\3F\AC\FE\4F\E9\BC\94\37\1F\E7\7C\27\CE\C1\B4\3D\38\B3\4D\B1\F1\51\94\79\12\F4\61\C8\48\05\80\3F\B1\85\DF\AE\87\20\0C\9E\B3\FF\5C\30\1A\FF\B1\F6\62\55\64\E8\0F\36\37\FE\C1\BE
\49\1A\20\4F\F6\E4\EF\FB\16\5C\22\08\2D\A4\32\5F\FF\30\90\5C\72\0B\F5\3F\F8\FF\AB\96\03\90\FF\A0\68\4F\D7\BF\B6\03\74\5C\30\5C\30\30\30\32\B0\7E\FE\C2\B0\20\34\B2\10\1A\A2\CC\4B\2C\93\0E\03\13\D6\6F\68\BC\CE\09\50\63\A3\83\B7\7A\03\60\08\40
\DA\C0\5C\22\EE\9C\02\E2\12\8C\E0\C7\48\3B\20\2C\3D\CC\03\A0\0B\27\53\82\2E\03\62\CB\C7\53\84\BE\F8\E0\43\63\97\83\EA\EC\9A\8C\A1\52\2C\7E\02\83\F1\06\58\13\1A\08\8A\40\20\27\85\9C\1A\38\5A\30\16\84\26\ED\28\0E\6E\70\3C\70\03\C8\A3\F0\11\33
\32\28\FC\04\AB\2E\40\52\1A\33\BA\D0\1F\40\5E\5C\72\B8\2B\D0\11\40\A0\03\2C\04\A0\F6\04\F2\03\5C\24\09\CF\9F\03\B8\10\84\04\45\92\83\E8\03\74\04\AB\42\2C\B2\AF\A4\07\E2\AA\80\CA\B0\68\5C\72\A3\3E\3C\36\5D\23\F8\A5\83\3B\82\ED\43\F7\2E\D2\8E
\80\03\A2\CB\D0\38\BB\50\F0\33\FE\B0\3B\40\E6\02\AA\4C\2C\2B\12\3E\BD\89\81\70\28\02\1A\23\D0\2D\86\66\31\1A\C4\7A\B0\C1\AA\2C\38\10\BB\DF\A0\8F\17\C6\C6\90\50\E0\3A\39\C0\1B\8C\11\EF\1B\B7\52\F0\DB\B3\AF\83\B9\86\18\29\65\5C\30\DA\A2\52\B2
\02\B0\21\B5\03\5C\6E\72\7B\C6\EE\65\99\D2\14\F8\08\CE\47\41\40\2A\DB\CA\6E\9D\17\44\F6\8A\36\C1\8E\BB\F0\F2\F3\18\ED\07\9D\4E\1F\B8\5C\72\8E\52\99\D4\F8\38\51\4B\13\B2\30\16\BB\E0\E9\A2\BD\AE\08\C0\3E\50\4E\B0\DC\08\0B\A9\49\51\3D\06\08\72
\3C\E1\11\3B\26\1F\C0\0C\B0\66\C1\4E\47\4A\3B\F0\55\41\9E\F5\DC\1A\A6\D7\41\96\50\80\26\8F\1B\9E\FE\F5\D8\E3\60\A9\C1\08\FC\C0\0E\80\29\3B\89\06\F8\21\D0\73\5C\30\EE\1A\A3\C1\0F\70\86\70\5C\72\8B\B6\E0\8B\BE\6E\28\F8\95\40\85\25\26\09\53\B2
\64\59\AB\0C\DE\03\EC\EF\75\07\12\18\43\DA\2C\A5\BA\38\4F\98\23\CF\0F\C1\84\08\F3\F2\6F\AA\05\9A\EA\52\E8\AC\76\2C\80\AF\23\E8\AF\7C\37\D9\04\5C\22\43\70\89\83\90\A1\42\F4\60\EC\03\6A\08\0C\11\A6\58\33\0C\13\AB\7E\EF\8A\84\52\D0\40\A4\C2\76
\C2\1C\F8\A8\A3\C0\39\42\23\02\98\0B\0B\B9\A0\40\5C\6E\F0\0B\30\97\3E\54\ED\10\F5\04\E1\06\91\08\C0\2D\80\35\84\06\01\88\06\2F\A1\3D\10\E8\80\20\01\16\BE\82\DD\08\45\AF\9E\97\C7\5C\6E\0B\E7\10\93\C2\88\03\64\5C\22\21\82\3B\DE\C4\70\2A\6E\AC
\BC\5A\B2\5C\30\38\2F\8C\02\6A\58\B0\5C\72\90\A8\3E\46\09\50\CF\90\65\3E\7F\08\C0\95\4F\9F\A2\4C\03\C4\0B\AF\A1\AC\4F\0B\1C\0C\30\B3\5C\30\D9\0B\29\81\6B\13\C0\C2\1F\BA\03\E3\A6\83\5B\09\C0\C8\CF\B3\C2\EA\03\9C\27\0E\4C\80\D9\09\C3\13\E5\F1
\83\82\E9\9B\31\20\31\5C\30\F8\A1\43\EB\A0\31\02\54\03\0B\BA\60\A9\84\BE\EC\52\CA\90\7A\BC\C4\9A\90\A3\EE\D2\19\70\08\08\AE\A2\B0\C1\DC\1A\13\B6\EC\C0\05\3C\03\20\2E\A3\3E\1E\1C\EE\A8\35\8E\DD\5C\30\E4\03\BB\0C\0F\B9\3E\9F\04\20\42\6E\CB\8A
\3C\03\5C\22\68\65\95\3E\D0\BA\BA\C3\AE\A3\0C\E7\04\73\F5\21\0C\BA\48\FD\7B\DC\90\91\04\21\5C\72\D0\5C\72\C0\5C\22\12\AC\E4\7C\10\A0\89\3E\52\9A\31\64\E0\F6\02\18\1A\13\F7\5C\22\55\40\12\C8\44\36\D0\E5\C1\A2\33\A3\E7\F0\9F\3E\6F\5C\72\B3\E7
\E1\0C\BF\76\9E\4C\3A\4B\13\84\32\E5\2B\C6\30\EC\BE\81\0E\80\3E\B0\C8\5C\30\E4\ED\20\AE\82\B7\02\42\E9\7B\21\0F\72\2A\48\81\14\0F\EE\B9\A7\92\79\3B\AE\60\38\5C\30\C8\13\CB\D8\AF\F4\BD\64\FE\B3\FB\E9\5C\72\C3\30\FF\13\CD\C0\32\41\02\FE\C0\A3
\EE\BC\3F\B0\F5\2B\FB\5C\30\DB\C3\85\5C\30\41\8E\AF\8E\83\77\0B\53\FB\08\0E\87\13\10\6C\13\C1\B2\BF\B0\5C\72\5B\D4\A1\AA\36\F4\02\63\6F\83\3D\B6\FC\BC\88\30\A7\7A\2F\4A\0C\2B\9D\EA\86\8C\F8\57\5B\B7\AC\7E\43\30\8B\F9\65\10\FC\33\30\03\48\51
\50\F7\44\50\59\93\7D\87\34\23\0C\59\44\07\05\F6\85\BA\01\70\29\01\09\BA\7C\FB\40\90\8E\A5\04\26\E3\04\2D\C0\86\2F\46\10\98\09\04\E1\89\54\10\98\09\AD\AB\84\A6\61\48\35\91\23\83\EB\12\48\2E\83\41\3E\D0\F0\30\3B\2E\AC\AD\FE\59\93\C4\A1\09\C3
\2A\FB\44\32\A0\3D\33\B7\09\70\42\6E\75\44\77\13\08\5C\6E\80\21\C4\7A\FB\43\9D\51\20\5C\30\D8\02\CC\48\51\34\44\CB\12\2A\8E\F1\37\5C\30\87\12\4A\C4\F1\25\C4\B1\12\70\0E\8E\75\44\A0\28\F4\4F\11\3D\17\21\12\B0\3E\AE\75\2C\37\13\BB\F9\31\1D\86
\E3\13\54\4D\90\8E\2B\97\12\33\F9\31\3A\02\5C\22\1A\14\50\81\B8\C4\F7\12\94\52\51\3F\BF\93\14\1B\FC\50\B0\8A\BC\2B\03\F9\31\31\3D\20\1B\8C\4D\5C\24\5A\C4\D7\13\6C\54\11\37\C5\19\15\2C\4E\71\25\45\21\14\CC\53\B1\32\C5\26\F6\8C\55\11\2A\3E\47
\15\44\53\11\26\BC\AA\E9\F3\9B\6F\7A\0E\68\38\38\38\31\5C\5C\3A\D1\15\D8\5A\30\68\8A\C1\15\C8\54\20\95\43\2B\16\23\CA\B1\41\25\A4\1A\A4\44\21\14\5C\30\D8\EF\F2\F1\C1\58\44\41\11\C0\33\5C\30\95\21\5C\5C\ED\08\23\81\68\BC\AA\ED\39\62\CF\1E\82
\54\02\80\21\64\AA\97\88\CF\C4\59\91\6A\03\32\F4\90\53\EB\C8\C5\CA\5C\6E\41\2B\05\CD\BD\A4\9A\48\C8\11\77\44\60\ED\8A\28\41\42\2A\02\F7\AA\2B\25\D5\45\EF\08\AC\58\2E\CB\A0\42\E9\23\BA\83\C8\BF\8C\08\0B\B8\26\D9\C4\58\65\84\45\6F\9F\5C\22\D7
\04\E8\7C\A9\72\BC\AA\38\C4\57\80\32\91\40\38\44\61\EF\7C\83\82\7F\F8\F7\91\8A\94\4E\FA\68\F4\A5\0E\90\CA\4A\38\5B\AC\DB\B3\F6\1D\C2\F6\AE\57\8D\7A\D8\7B\5A\5C\22\4C\5C\30\B6\01\5C\30\9E\80\C8\86\38\D8\02\78\8C\DB\B6\58\08\40\94\C0\20\02\90
\45\A3\CD\EF\EB\91\68\12\3B\BF\61\66\98\16\03\BC\31\C2\FE\3B\6E\13\C3\CE\0E\68\18\5A\0E\33\A8\45\99\06\C2\03\AB\86\30\7C\BC\20\EC\98\91\AD\F6\41\E0\92\A3\74\90\42\2C\7E\F4\8A\57\A3\38\03\5E\1F\BB\C7\A0\D7\83\82\F5\3C\32\2F\09\BA\38\A2\2B\B4
\A8\DB\94\1F\03\90\9D\82\4F\2B\A0\25\50\23\CE\AE\5C\6E\3F\17\BB\DF\89\3F\BD\FE\65\CB\94\C1\4F\08\5C\5C\5D\1B\D2\02\17\37\28\23\FB\A9\44\DB\BE\0C\81\28\21\63\29\A0\4E\F6\88\BA\D1\4D\46\10\08\94\45\A3\23\44\58\EE\14\67\EF\29\BE\19\11\30\8F\41
\AA\5C\30\80\3A\DC\72\42\01\C6\D7\16\60\0F\60\20\20\DA\16\E8\0C\51\92\B3\48\3E\10\21\5C\72\42\87\A8\01\5C\30\0F\80\11\89\56\25\63\65\A1\48\46\48\D7\F1\A4\6D\32\80\42\0C\A8\32\49\EA\B5\C4\D9\EB\60\23\FA\98\D8\44\18\3E\AC\F8\B3\6E\5C\6E\3A\4C
\8C\FD\10\10\1D\C9\39\43\F1\8F\CA\02\98\30\E3\EB\5C\30\90\93\78\08\28\DE\8F\A9\1E\28\5C\6E\03\FE\80\A6\02\BA\4C\C0\5C\22\47\8A\5C\6E\40\08\E9\02\8F\F8\02\60\5B\C3\F3\80\8A\02\98\5C\6E\69\27\5C\30\9C\16\F0\29\88\F9\80\82\90\BC\79\29\26\A4\9F
\1E\28\08\01\70\5C\30\80\4E\88\09\C0\5C\22\80\AE\4E\3A\38\B1\E9\0F\2E\5C\72\21\8D\8D\27\34\7C\D7\9C\7E\AC\E7\A7\DC\D9\CA\80\EA\10\B4\B7\0C\5C\22\85\63\FA\C7\44\01\6C\74\91\D3\07\A8\9F\30\63\AB\C5\35\11\1D\6B\51\51\D7\A8\2B\1D\8B\5A\8D\8E\47
\6B\1F\EA\81\21\46\80\84\02\03\63\CD\34\11\88\D3\52\78\40\1D\83\26\3E\7A\3D\8E\B9\5C\24\28\3F\F3\9F\03\EF\8F\C2\02\28\5C\6E\03\EC\80\A8\3E\E0\09\EB\D2\B5\82\D4\E9\43\71\DB\8C\BC\1B\8C\74\2D\7D\C7\47\1D\2C\74\F2\04\47\57\20\92\78\71\DB\48\66
\0F\AB\62\5C\30\9E\5C\30\7A\D5\EC\83\C1\54\39\7A\1F\14\77\06\D0\85\A2\08\44\7F\6D\6E\27\EE\63\63\62\A0\16\48\5C\30\01\7A\85\89\F1\33\B9\21\BC\80\D1\D4\02\C5\20\48\F3\11\DA\48\7A\D7\80\05\8D\49\02\79\5C\22\2C\83\2D\A0\5C\30\DB\5C\22\3C\86\32
\1F\88\EE\A0\D0\27\92\23\48\60\1F\1C\86\64\2D\04\B5\23\63\6C\8E\6A\07\C4\9E\60\B3\AD\69\28\17\1F\BA\5F\8D\A4\C8\64\67\C8\8E\ED\C7\82\2A\D3\13\6A\5C\72\AA\5C\30\F2\3E\12\C2\20\36\B6\BA\03\18\05\E0\36\C9\0E\32\F3\6B\6A\E3\B7\3C\DA\43\71\91\D0
\39\14\E0\C4\90\86\C9\49\5C\72\5C\24\43\92\41\07\49\1B\5C\24\78\5C\72\92\48\B6\C8\37\CA\38\20\DC\80\5A\B2\70\5A\72\52\A3\F2\E0\82\5F\B2\55\5C\30\E4\01\6C\5C\72\82\AE\49\52\8D\58\69\5C\30\3C\B2\10\E4\C4\03\CC\72\85\7E\90\78\C3\12\53\AC\E9\25
\99\12\D2\5E\93\1F\25\6A\40\12\5E\C6\F4\14\54\33\85\33\C9\80\47\48\05\B1\7A\80\F1\26\5C\24\98\28\85\C9\71\5C\30\8C\9A\12\66\0C\26\03\38\2B\C5\5C\72\C9\97\25\EC\96\32\68\43\FC\78\14\99\A5\D5\49\BD\04\0C\9A\6C\62\C9\80\92\28\68\F2\53\83\59\26
\81\E0\42\AA\C0\14\90\8C\95\92\60\06\94\66\04\95\F2\78\C9\76\14\A0\6E\2E\4C\2B\FE\03\9B\2F\5C\22\3D\49\A0\08\30\AB\64\BC\5C\24\34\0B\A8\37\72\7F\8C\E6\03\BC\9D\41\A3\84\F5\28\34\A0\32\67\4A\19\28\44\98\E1\3D\46\0C\0F\84\A1\E2\B4\C8\E5\28\AB
\82\06\FB\8D\2D\27\C4\A0\F2\58\02\02\47\F4\02\32\8D\39\5A\3D\1C\98\01\92\CA\2C\13\CA\C0\72\60\07\03\29\3B\78\5C\22\1F\C9\E4\14\38\3B\B2\96\3E\FB\26\81\85\A1\1D\84\F3\27\2C\97\40\A2\A4\32\C3\70\6C\B2\7F\97\E4\14\3A\30\C3\6C\49\A1\08\A8\5C\72
\72\9C\4A\44\90\01\88\C0\FA\CA\04\BB\B0\B1\92\68\41\C8\7A\32\32\70\CE\05\11\11\60\4F\32\68\03\88\B1\38\48\82\B4\C4\84\77\74\98\01\42\46\B2\90\8C\67\60\37\C9\C2\0E\E4\A5\32\7B\91\2C\4B\6C\A3\F0\9B\1E\8C\DF\B0\25\43\0F\25\FA\01\1C\6F\6D\FB\80
\BE\E0\03\C0\92\B4\83\91\2B\58\A3\ED\FB\CA\34\01\19\31\F2\B9\B8\8E\5C\6E\C8\0F\32\70\8A\D2\09\5A\42\21\F2\3D\56\C6\DC\A8\E8\C8\80\D8\2B\48\36\B2\C3\CA\17\2A\E8\0F\0F\AA\5C\30\E6\01\6B\D5\E0\16\97\01\25\3C\B2\20\F8\4B\27\2C\33\D8\72\C4\49\A0
\03\3B\A5\A0\38\5C\30\5A\03\14\B0\2B\11\17\45\1A\DC\AD\D2\60\1D\D0\0C\02\88\B2\BD\CA\E3\2B\6C\AF\C8\CF\CB\57\2B\A8\59\D2\B5\13\1F\2D\74\AD\81\66\CB\62\14\A1\51\F2\B7\CB\5F\2D\D3\80\12\DE\85\A7\2B\84\B7\20\39\35\8A\4C\6A\4A\2E\47\CA\A9\2C\5C
\5C\B7\F2\D4\85\7F\2E\5C\24\AF\32\D8\4A\E8\5C\5C\84\2D\A0\C0\31\FF\2D\63\A8\B2\82\CB\87\2E\6C\B7\66\08\8C\78\03\42\02\71\16\4B\B0\2C\64\B7\12\E8\CB\80\E2\38\E4\41\B9\4B\6F\2D\F4\B8\B2\EE\C3\E6\90\14\B2\B0\33\4B\C6\16\1C\AF\72\BE\B8\01\2F\7C
\AC\0B\CA\CB\E5\2F\5C\5C\B8\72\BE\CB\F1\2C\A1\9D\48\CF\A4\B8\21\F0\59\C0\31\B9\30\A4\40\AD\2E\C2\84\9D\26\7C\98\12\FF\CB\E2\2B\04\C0\E9\4A\5C\30\E7\30\50\0C\33\06\4A\CD\2D\5A\51\B3\09\BB\5C\72\26\84\91\C3\E1\5C\6E\D2\4C\D1\2A\C0\16\CB\DE\08
\6A\91\12\C4\89\7C\11\08\97\D2\E5\CB\E6\23\D4\BE\AA\5C\22\CB\BA\08\93\81\90\41\CA\EF\2F\E4\B9\F2\FB\38\8F\29\31\23\EF\37\5C\24\5C\22\1C\C8\36\13\0E\5C\6E\3E\5C\6E\F4\A2\C3\37\4C\81\31\E0\8B\F2\68\39\CE\18\5C\30\8F\42\1C\80\5A\BB\64\98\13\23
\A9\62\3A\5C\30\2B\41\B9\BE\A9\32\32\C1\D3\27\CC\95\5C\6E\74\A0\92\C4\CC\9C\16\1C\C9\4F\C4\05\E7\32\6C\CA\B3\2E\4C\A2\0E\94\48\43\5C\30\99\E9\32\A0\8F\F3\2B\4C\A2\5C\5C\BC\99\72\B4\4B\6B\2B\BC\B9\B3\16\CB\B3\2E\EA\8C\92\EA\BA\3B\28\44\C6\80
\A2\CA\F9\31\73\80\12\D5\CC\F2\03\64\CF\73\39\CC\FA\95\BC\A0\50\34\CA\EC\8C\9C\CF\F3\40\8B\19\2E\EC\C4\E1\0B\41\07\15\E4\C5\6E\68\4A\DF\31\B2\33\F3\07\4B\F5\30\84\D1\33\4A\5C\24\5C\30\19\EC\D2\32\ED\4C\6B\33\E3\88\E1\51\CD\3B\33\94\D1\6E\5C
\30\5C\30\C4\1B\2C\D4\73\49\CD\40\8C\FB\75\2F\56\41\C5\31\9C\B5\B3\55\4D\04\E2\3C\C6\0F\15\4C\65\34\44\D6\32\FE\CD\56\14\A2\25\20\A8\41\70\5C\6E\C8\AC\32\C9\CD\33\35\D8\04\F2\D0\02\41\2D\14\B4\93\54\CD\75\35\9A\33\F2\DB\B9\31\2B\11\66\4C\7E
\06\E4\5C\6E\F4\B0\83\09\84\F5\2D\18\3E\A3\B0\04\20\0C\04\D6\D2\A1\4D\97\34\58\4C\F3\53\86\14\F5\64\D9\B2\D6\CD\9F\2A\5C\5C\DA\40\16\CD\A8\80\98\59\D3\6B\A4\8A\03\A4\DB\53\44\4D\BB\35\20\58\66\1C\B0\A0\AC\AA\44\B3\73\08\A4\E4\C0\55\73\25\09
\AB\16\CC\B1\70\2B\4B\E9\36\C4\DE\10\2F\CD\D4\08\FC\DD\92\F1\38\58\E4\04\DE\82\3D\4B\BB\36\70\48\E0\86\92\F1\25\E8\90\33\83\CD\AB\37\6C\D8\49\A3\4B\30\FA\A4\C9\4C\ED\CE\1A\0E\44\BB\B3\75\83\EA\F5\60\05\B1\BD\0F\50\5C\72\FC\D9\53\4F\CD\99\26
\28\3B\B3\7F\4C\40\16\8C\A3\CF\88\4E\3E\53\FC\B8\32\80\CB\38\28\FC\B3\D2\60\4A\AE\45\B0\80\72\AD\46\09\32\FC\E5\53\45\89\94\4D\0C\92\86\4D\C8\E1\5C\24\03\71\CE\45\B6\9F\5C\24\D4\C3\A3\2F\49\13\5C\24\5C\5C\93\E3\E1\49\44\E5\13\0E\5C\22\A0\86
\5C\6E\03\14\E4\B1\BA\BD\77\2E\74\CF\53\09\80\E6\0E\84\D1\92\50\12\F0\F2\23\5C\6E\12\57\C6\F5\2D\5C\30\43\D2\B5\CE\07\3A\6A\9C\52\ED\CD\5E\53\FC\ED\84\C5\38\01\3B\64\EC\60\94\A3\F2\35\D4\AA\81\61\CA\96\C7\F4\45\81\B9\2B\03\28\18\58\72\F6\4D
\EB\3B\8C\EC\33\0F\04\B1\3B\B4\95\F3\BC\42\2C\8C\98\2A\13\14\31\07\26\04\EE\93\C3\CE\CB\32\58\E5\53\BC\88\F5\29\3C\CD\20\AD\4C\39\3B\14\F2\52\53\4E\BC\DE\0C\A3\C1\67\49\73\2B\DC\EB\D3\B0\4B\83\3C\AC\F1\73\B5\4C\59\2D\18\5A\13\92\3A\41\3C\14
\E1\D3\C2\4F\4F\2A\9C\F5\32\76\CF\57\37\14\19\01\B9\B9\1F\2B\7C\F4\A0\80\CB\BB\3C\54\D6\F3\D5\39\A0\01\68\92\93\B2\CF\79\5C\24\3C\F4\CE\23\CF\81\3B\D4\F6\D3\E1\9B\76\B1\5C\24\F6\13\90\4F\08\E9\5C\30\AD\20\AC\2C\48\01\6B\07\F2\FC\04\0B\2D\E4
\F5\13\E0\CF\9A\5C\72\DC\FA\B2\9F\CF\A3\3B\84\94\13\B9\4F\95\3E\EC\F9\93\B7\CB\37\3E\B4\A7\33\40\4F\7B\2E\34\F6\70\1C\4F\BD\3F\54\FC\62\C3\CF\CB\2E\EB\2E\0C\7E\4F\85\34\F4\CF\53\EF\CF\EC\3E\11\31\53\53\80\CF\2A\34\B6\50\C8\A3\F3\3E\FC\B7\13
\C1\CF\EF\33\ED\5C\30\D2\57\CF\3E\10\B4\F4\32\90\03\E5\3E\3C\EB\F3\DF\50\19\0F\1A\3F\34\07\80\DB\40\8C\F4\74\5C\6E\4E\C0\C7\F9\81\41\1E\8C\78\70\DC\FB\25\3D\50\0B\40\C5\01\D2\43\CF\40\0E\85\02\52\C7\CB\9F\3F\78\B0\F3\5C\6E\98\B4\8C\30\4E\F2
\77\D0\4F\3F\D5\03\54\0E\4A\43\40\F5\02\CE\23\84\09\2E\64\FE\93\B7\4D\EA\CC\74\AF\26\3D\B9\5C\5C\E4\34\E8\C4\41\C8\E5\3A\4C\93\13\A5\80\ED\5C\24\DC\E9\D2\4E\83\AD\3A\8C\92\5C\72\CE\C9\49\27\C5\01\B2\96\02\0B\41\D5\02\72\E1\8C\8D\3B\03\5C\72
\A0\2F\80\F1\43\1D\06\F4\0C\C8\E5\42\E5\05\D3\AE\8C\69\3E\4C\E8\8A\1B\8D\37\3A\39\8D\A1\A1\80\F6|\A9C\$\CA\CB\29\D1\F9\A1\AD\B9\7A\40\B4\74\0E\6C\C7\3A\3E\80\FA\43\EA\03\0C\5C\6E\B2\42\69\30\47\DA\02\90\2C\5C\30\B1\46\44\25\70\29\81\6F\5C\30\8A\02\B0\08\A9\10\83\5C\6E\3E\88\FA\60\29\51\06\01\5A\49\E9\4B\47\DA\25\4D\13\5C\30\23\5C\30\8D\44\D0\08
\A0\A6\51\2E\02\48\08\E0\27\5C\24\CD\45\5C\6E\17\20\AB\5C\24\DC\90\25\14\34\49\D1\03\44\B0\33\01\6F\0F\A2\02\3A\4C\C0\5C\24\A3\CE\02\6D\11\20\B1\83\30\02\A8\09\D4\42\A3\5C\5C\02\28\08\8E\AB\8F\A8\02\38\FC\C3\E9\80\9A\02\85\15\68\CC\0E\AB\44
\BD\17\D4\43\D1\73\44\58\34\54\4B\80\A6\02\8C\7B\03\F6\A3\78\EC\60\5C\6E\80\2C\85\BC\5C\6E\45\19\A3\EA\3A\D2\02\70\5C\6E\C0\27\80\96\3E\A0\EA\A1\6F\5C\30\AC\93\08\FD\74\49\8F\C6\02\60\0B\20\2D\5C\30\8B\44\BD\14\C0\2F\80\AE\4B\50\FA\60\2F\A4
\EA\02\F8\08\48\D7\5C\24\5C\6E\02\3D\13\89\02\80\86\3E\8D\11\B4\55\0F\F7\46\50\30\A3\EB\C8\55\47\7D\16\34\42\5C\24\3F\45\FD\11\0C\DB\D1\14\9E\25\11\94\54\80\57\44\7D\12\20\2A\06\A9\48\30\FB\54\84\5C\30\74\16\F5\1B\B4\86\82\C2\D8\05\5C\22\21
\6F\5C\30\8D\45\E2\37\B1\EF\52\2E\93\80\FA\74\66\52\17\46\75\21\D4\90\03\44\16\F0\5C\6E\03\EF\5C\30\87\46\01\2D\34\56\80\51\48\C5\25\34\84\D1\30\02\75\14\14\4E\5C\30\9F\44\F5\14\14\51\52\75\45\E0\09\29\04\8F\CD\49\10\5C\6E\A0\26\51\02\93\6D
\13\80\29\C7\9A\92\6D\20\14\89\23\5C\5C\90\98\0B\14\93\D2\0F\44\BD\18\C0\28\5C\24\CC\93\78\0B\34\80\80\57\46\4D\26\D4\9C\52\35\48\E5\25\71\E5\D2\5B\46\85\2B\C8\F9\D1\49\46\20\5C\6E\54\AB\52\33\44\BA\4C\C1\6F\0F\B0\8C\BC\79\34\54\51\2F\45\9D
\16\B4\5B\D1\9E\3C\AD\17\74\5E\D2\CB\46\08\FC\A0\29\51\88\03\E5\2B\34\B0\51\97\49\D5\23\B4\BD\89\49\46\8D\27\54\69\D1\AA\01\58\FF\C0\21\D1\B1\46\D0\2A\D4\6E\52\CA\3E\AA\35\D4\70\D1\C7\4B\6D\2B\D4\73\C7\DC\1A\A0\FB\A3\EF\D2\E1\49\E5\17\F4\9F
\52\81\45\FD\2B\D4\A9\A4\D9\4D\5C\30\FB\C0\28\52\B0\3F\8D\2B\48\D2\80\A5\4A\ED\5C\22\54\C3\03\0B\44\88\08\81\AA\5C\24\98\8C\E0\09\34\77\51\E0\02\7D\1E\54\7A\5C\30\8B\47\B5\38\14\7C\D2\78\E7\CD\1F\A9\03\52\A2\16\F5\36\C0\14\52\E6\02\08\09\34
\58\52\36\5C\6E\B5\1E\34\79\D1\6D\4E\1D\1E\F4\E3\51\F7\4E\4D\1F\E0\26\52\D3\48\1D\26\C9\32\51\2F\1E\AA\37\23\E8\D2\9B\1E\DC\7B\A9\27\D2\D2\8D\2C\7C\94\92\C7\CE\5C\6E\B0\09\2E\B7\5C\30\98\3E\D4\7B\C1\6F\23\31\44\85\3B\C0\C2\8F\D0\3F\55\12\F4
\91\D2\95\4A\F2\39\80\2A\80\9A\90\B8\6A\94\FD\80\AF\46\92\4E\A8\D2\D1\89\4A\F5\12\20\23\D1\7E\25\2D\3F\43\F4\C7\DF\4C\A8\33\14\D5\40\45\50\B4\7B\60\3E\51\C6\02\C8\94\B5\02\D4\25\4F\ED\29\34\EF\52\25\49\8A\40\D4\F4\25\2C\02\9D\5C\22\D5\08\D3
\F9\49\D5\3C\91\EB\D3\CF\1E\E5\5C\24\D4\89\54\50\3E\D0\5C\6E\B5\08\5C\30\51\50\35\44\14\FF\D3\6B\4F\05\46\D5\1C\54\59\1E\B5\3C\C1\6F\0F\FD\51\85\3D\54\89\5C\30\AC\93\78\09\35\1E\06\A9\44\A5\2C\C2\04\03\30\3F\CD\15\69\0F\0F\CE\3F\78\FE\20\20
\BA\6D\45\7D\3E\CE\7C\A4\C0\8C\C0\5B\C8\E7\5C\30\9E\8E\80\0F\95\26\52\1B\4C\80\FA\94\48\0F\AB\53\15\39\95\1E\47\9B\49\9B\A7\31\E4\80\96\8E\85\4D\34\56\0F\AD\1E\48\FE\01\6F\54\2D\53\9D\29\51\E3\47\C7\46\20\5B\C3\F9\54\51\52\6A\4E\B1\E3\23\78
\02\5D\4E\28\CC\55\04\90\38\5C\6E\75\01\55\5C\6E\3F\35\2C\54\6D\D4\9E\3F\D0\FF\92\12\0F\DC\3F\80\FE\40\C2\55\1A\5C\6E\B5\1F\75\2D\80\8B\52\EA\39\E3\F0\55\2F\53\20\5C\6E\55\33\0F\AD\49\45\53\74\81\51\59\4A\75\2E\B5\51\D2\0E\16\F5\46\B4\6F\5C
\24\26\8C\C0\FB\69\09\8F\DC\4B\50\08\43\F3\36\C2\3E\E5\35\B5\47\5C\30\75\52\80\FF\75\29\55\27\52\A8\30\94\D0\80\A1\44\75\12\14\49\55\85\4A\40\09\D4\F7\3A\E5\56\38\2A\D5\12\52\66\02\25\26\B5\5C\5C\0F\BF\52\C8\08\F5\4D\55\39\52\F8\FC\15\66\55
\41\55\15\5B\54\B0\55\51\53\65\5B\A4\B5\5C\30\8F\4B\65\5A\55\61\82\AD\55\68\FA\B5\6D\53\3C\02\BB\AE\C0\2C\52\E8\8D\73\A8\60\26\54\6A\02\40\0F\88\E7\47\C7\21\5C\5C\78\F4\5E\A3\30\3E\A8\FE\5C\30\26\0F\C0\8D\70\FF\CE\82\51\BF\51\9D\29\54\98\55
\E5\50\73\AE\40\25\5C\30\9F\57\80\09\60\5C\24\D4\F2\90\28\08\31\E9\51\08\3F\D5\5C\24\43\EF\51\70\5C\6E\B5\4F\D4\4A\B9\F1\58\8D\23\83\FD\56\37\58\90\05\75\3B\D6\21\59\04\42\EE\B0\12\D3\53\E5\63\03\FE\D1\2B\56\A3\CE\C3\F1\23\4D\55\D5\57\95\48
\8F\CD\55\FD\52\B2\13\C7\85\55\2D\2B\F4\F0\56\6D\59\7D\5C\5C\F5\80\C8\4F\4B\A5\4D\83\EC\5C\24\C9\53\ED\65\54\6F\56\84\8C\CD\48\54\F9\D1\21\21\3C\7B\B4\52\D3\CD\5A\15\41\35\9C\52\C1\21\3D\33\55\99\A4\28\92\04\7B\40\2A\52\61\1E\74\7A\5C\30\29
\51\83\50\35\16\48\D8\8F\D2\02\93\CE\D5\B0\02\AD\4E\35\2B\95\96\0F\CF\50\90\5B\D4\ED\39\F3\56\25\5C\22\B5\B2\D6\D8\5C\6E\B0\FD\F1\E4\47\95\53\1A\4C\95\B5\8F\D4\16\F2\39\94\F9\C7\CC\EB\95\6C\C0\15\A3\88\91\5C\72\56\88\D8\A4\CD\5B\95\6F\75\BA
\55\49\59\85\52\15\5F\54\A9\59\AD\70\35\4F\D6\A7\5C\5C\8D\71\60\AB\55\D7\5B\D5\42\75\27\55\77\5C\5C\6D\52\55\C7\D4\AD\5C\5C\45\73\35\06\D3\4B\5C\5C\08\FA\83\EF\56\C9\5C\5C\C5\53\95\7B\D7\41\5A\25\4F\F5\BC\5C\24\DC\02\A5\46\B5\D4\02\AC\3E\FD
\12\35\45\D7\57\56\6D\60\F5\80\57\64\01\5D\26\20\5C\24\D1\CE\8C\C5\18\95\DB\D3\21\52\A5\5A\15\7D\D4\85\5D\7D\76\35\C0\80\A7\5A\55\67\03\F4\D4\51\5E\15\79\60\20\D1\21\5E\3D\46\95\E1\52\C1\5E\A5\76\15\EB\55\C5\4B\65\78\40\2B\A4\DE\02\72\35\C0
\23\D7\40\3F\3D\14\94\75\8F\CE\93\73\A0\95\A4\D7\A5\59\9A\4E\B5\73\53\21\5E\63\9D\35\F0\5C\24\2E\93\75\60\B5\DC\5C\30\AB\58\45\7E\31\EF\39\D2\02\85\4A\03\F3\55\5A\1A\A2\40\B2\13\23\31\5F\5B\AD\34\4A\D2\32\03\E0\5C\6E\E0\5C\24\56\1D\49\B2\34
\6E\BB\5C\30\98\3F\F2\34\61\AA\52\E7\21\55\7E\29\26\D3\F2\01\42\3E\74\92\52\DF\49\D5\30\C0\1F\D4\0B\5F\45\6B\54\55\53\D8\02\9C\7C\B5\FD\55\6B\5F\C2\38\80\26\80\9B\45\B0\FC\28\E2\80\98\3F\E2\40\F5\02\D7\D7\4A\D2\35\D2\15\8F\BD\4A\55\86\15\42
\51\54\02\7D\48\56\19\D6\16\91\08\6A\80\A4\51\78\5C\6E\65\1F\D6\1D\56\73\55\3D\83\D4\FD\56\91\4E\A2\34\D5\B2\D8\97\5C\5C\14\78\E8\D2\D6\EF\52\12\33\34\DD\47\BF\44\5C\22\3A\09\4B\51\FE\3E\98\5B\D5\5C\72\D5\59\5F\E5\23\21\AA\23\5D\5B\6A\3C\36
\01\D8\AE\01\58\09\A8\EC\0F\CD\63\1D\89\95\D8\23\4B\4C\7D\3E\60\27\5C\30\8E\02\A8\08\35\94\58\D1\63\55\81\14\5B\5C\30\90\16\F5\28\D4\D9\D1\1D\57\74\7C\74\F4\80\9D\52\5D\70\C0\2F\A3\5D\48\32\49\15\14\80\51\4F\8B\AD\31\E2\53\A9\51\08\6A\95\5A
\80\A8\02\B8\08\B4\48\BA\B4\8F\15\6D\A8\CC\D9\29\64\B5\5E\14\53\58\43\59\5C\72\90\74\75\40\4A\EB\70\FC\B5\25\D3\FF\4D\B8\0B\14\F8\80\A8\F3\B5\93\D6\3F\D9\55\51\B0\5C\6E\F6\3D\52\E5\61\72\3A\15\02\D4\BF\45\ED\91\C0\15\A5\2D\47\1D\80\5C\30\5C
\24\D1\C7\64\BD\93\F6\5D\D2\6D\65\68\2A\C3\EC\51\89\57\74\84\F6\63\80\A1\60\95\98\41\AA\59\3D\53\5C\72\17\AE\AF\0F\AB\09\6D\2D\B4\82\A4\3D\4D\05\77\D6\48\A3\5D\4A\E5\5C\22\E4\B4\8F\C4\02\A0\0B\F5\FE\8F\AD\66\F5\5C\22\B4\7B\23\39\54\65\9C\89
\10\D9\CD\1E\1A\4D\D4\63\B9\F1\4E\EA\49\A3\F2\D9\DF\44\A5\9C\F5\19\D9\DC\E7\55\9C\36\03\D9\F1\67\8D\7F\D1\32\D9\D7\1E\DD\9D\B6\65\83\0B\61\AD\4C\B4\80\51\26\02\1D\26\75\18\54\E5\58\8D\18\35\31\59\A0\3E\8D\1D\A3\F3\0F\FB\53\08\FD\D6\8A\51\23
\1E\EA\49\B5\A5\D5\6A\8F\5C\30\FB\0E\9C\A3\C5\57\A0\08\50\12\D1\FE\3F\75\62\35\46\55\F3\4C\1D\6E\B6\29\56\35\52\A2\40\E3\EB\5C\24\0B\21\25\6F\B6\03\D4\03\50\18\FA\C9\27\80\89\45\B5\7F\55\C1\D4\50\8D\2D\86\B6\9A\A4\42\8D\70\5C\6E\B5\46\5C\24
\9F\53\34\85\74\B1\55\46\02\7C\7B\96\71\D6\C8\93\30\FB\95\CE\55\6D\6A\73\CE\C3\FC\80\B2\02\F8\FD\5C\24\B4\DA\9B\6A\9D\85\63\EB\DA\90\8D\E5\A6\D6\AB\80\BF\61\5A\49\35\58\80\83\6A\9D\32\36\AE\A4\26\02\1D\3E\76\8E\D1\5C\6E\02\5C\72\29\32\15\D5
\5F\6B\1D\18\03\EE\47\B6\02\1D\AE\54\4A\DA\C1\65\51\2D\63\EE\5A\F1\56\4D\AD\D6\BD\A3\7A\3E\F5\5D\95\61\0F\B9\63\A3\CB\63\EC\8F\DF\60\74\84\94\48\DA\D1\6A\DD\18\36\B9\A3\2B\6B\8A\4D\96\16\5C\30\8C\3E\8C\84\80\23\23\33\6C\3D\13\E0\27\8F\B4\01
\A5\5E\36\CD\5C\30\A8\01\C3\A8\76\A6\5A\39\53\65\A3\80\5C\22\D7\CA\EA\1D\62\CE\A1\D4\42\3E\9D\29\95\2F\54\C1\1E\3D\1C\F6\39\5C\30\F9\60\50\08\E0\5C\24\5C\30\BF\5D\ED\2F\30\12\DA\AA\02\95\AB\E4\B5\8F\BD\6B\2D\9A\36\DD\DB\7B\6B\08\FC\D6\E1\5B
\81\46\5C\72\7C\B4\53\D1\BF\4A\A5\1B\F5\4D\51\BF\44\3D\1B\F5\2F\C8\57\58\05\A2\F6\9C\56\97\61\AC\27\B6\1A\B9\E9\61\A8\06\74\6F\80\A9\6C\E5\86\B6\D0\58\6A\02\7D\43\40\5C\22\C0\4B\50\DB\CE\D6\01\DA\6F\6D\92\33\5C\30\23\48\56\94\B5\85\76\F7\D1
\7E\93\7B\9E\B5\07\D6\3F\67\78\09\6E\7C\5B\D8\3F\55\B6\E4\B5\5B\72\EA\BD\68\B6\DE\47\B8\02\60\0B\F5\33\23\47\6B\25\4C\A3\EA\5C\30\BF\49\9D\60\43\F9\44\DE\EA\B8\09\20\5C\22\5C\30\88\8C\C5\A7\B6\B0\23\63\4E\1D\AB\36\DF\DA\B9\66\8D\C2\D4\7A\DB
\8E\EA\BA\3B\08\D1\A4\C3\65\65\46\96\37\D9\2F\4E\5C\72\3A\F4\E2\51\F1\47\D5\39\09\5C\24\D4\F3\49\F8\08\D5\BC\BA\DF\5D\A3\AE\54\DD\D8\57\47\73\AB\D4\64\57\F5\4D\DA\49\E3\E8\D1\D9\66\92\42\63\EA\DB\A4\EA\F5\C2\F7\21\23\63\6E\75\26\28\DE\53\E3
\5F\D5\77\A3\F9\53\66\EB\05\26\54\9A\5A\3A\8D\85\30\43\F3\53\D9\4C\1A\4E\14\60\DC\B3\59\6A\3D\B7\14\0F\B6\3E\C5\B2\C3\F1\5A\13\21\3D\80\72\12\56\5D\67\90\FB\09\04\D3\A3\72\B5\A0\0E\CB\58\6C\8C\C9\2D\2E\B9\55\C4\27\75\4A\75\4A\5C\30\83\73\AD
\4A\B6\27\57\06\02\25\B7\B6\AD\5C\5C\3E\3F\F2\42\F6\EB\56\AD\1E\6A\34\B5\04\8F\CF\4A\7D\49\2F\2D\D2\9D\72\52\4C\16\BA\53\1C\E8\12\33\5C\30\2C\52\67\71\D3\AD\F4\C7\54\66\3E\DD\31\D5\EF\5C\30\A5\5F\95\1F\94\C7\5C\5C\56\02\38\0B\F5\A1\5A\DB\74
\85\C1\63\E8\80\86\02\FA\3C\14\5E\5C\5C\F9\6C\05\6C\B4\6A\5C\30\BE\02\98\FE\54\A5\5D\43\1E\DD\D4\77\01\D7\CE\93\7A\49\B6\D9\5A\77\4E\85\B6\B6\70\56\15\57\85\6A\76\BB\59\B6\3E\9D\18\32\10\D3\09\6F\5C\24\7C\55\87\57\C3\4C\25\7B\74\6F\58\33\5F
\F5\17\B6\F2\52\89\4A\35\7E\36\5C\22\D7\E3\5A\6C\7D\B4\60\D4\6B\63\AD\7F\D1\EE\DB\65\52\3D\5E\55\0C\D4\8E\02\95\A5\31\F2\D1\BD\77\18\0B\37\65\D8\13\64\B5\DD\76\8E\D9\62\8F\3D\81\14\E1\5C\30\F9\66\A0\0F\80\2C\8F\B3\6D\E5\8D\29\10\D5\E9\47\70
\FB\D5\2D\D3\BC\BD\29\39\4C\FD\93\9A\3E\7C\D4\EB\20\17\5C\22\03\CC\40\E8\FB\A4\35\0C\1B\A7\60\86\06\3A\03\9B\F4\5C\30\E9\2C\80\08\F1\74\40\BA\C4\0F\78\BA\93\F2\6C\C3\06\18\4A\C8\0E\8E\BB\62\0E\A8\36\A0\E0\85\BD\1A\89\DD\61\8E\DE\41\5C\30\D8
\BB\41\52\06\06\08\EC\5B\41\81\BB\C3\30\5C\24\71\6F\97\41\E0\CA\53\D2\12\FC\40\CC\14\F8\AC\01\3C\40\D3\79\C4\11\D0\5C\22\02\03\07\61\73\2E\E2\CE\7F\08\E4\F7\0F\56\5E\84\03\95\E8\AE\A5\5E\0E\F5\9B\85\97\9C\5C\30\DC\03\C8\48\90\C1\B7\5B\17\48
\40\0E\92\03\62\03\4B\8D\97\A9\DE\29\7A\C0\5C\72\B7\A8\A4\A4\03\3D\E9\90\C1\5E\BF\7A\88\42\5C\30\BA\BF\92\1A\A4\E4\4E\E9\06\6F\10\3C\CC\87\74\3C\8F\16\78\0C\EE\A3\5C\30\DA\AC\30\2A\52\A0\BA\49\7B\A5\ED\AE\B4\5E\E6\45\B5\EE\B7\B8\3A\8D\7B\4B
\D5\90\A7\31\45\1C\88\30\B2\D3\59\BA\02\95\9B\E0\2F\D5\D1\63\14\EA\C0\5C\22\5C\30\84\EA\B8\0F\34\F8\8F\C9\46\15\8D\37\27\80\86\02\98\5C\6E\D5\30\DD\C9\60\55\A3\54\F9\A4\0E\3F\4D\50\D4\C0\D3\07\6C\B5\C8\34\8C\D3\72\0C\28\09\B4\C1\5A\BF\7C\8D
\84\80\26\86\A9\74\5C\22\49\B5\BF\D6\DB\4C\A0\05\77\2B\D2\6D\7D\85\A7\14\F7\80\57\69\5C\72\3E\D6\55\5F\5F\75\C5\F7\36\33\DF\79\5B\A2\38\B5\01\54\08\0C\2D\F7\17\D9\56\CF\7D\A4\78\E3\F4\5F\7E\E8\25\F8\37\D9\DF\7B\1F\6A\4D\E1\6F\5F\9A\02\45\F9
\F7\D8\D3\EB\7E\5D\12\F4\50\5C\24\DF\4A\F5\43\61\58\47\8A\0C\39\84\5C\30\30\30\37\C5\83\35\F3\41\23\0C\03\E1\02\5C\30\2E\8B\13\C0\E4\5C\72\CB\B4\8E\9E\5F\D6\1F\A2\03\E1\C0\DF\DA\15\25\FE\E1\C0\C0\18\5C\6E\80\5C\72\23\3C\4D\C5\78\D8\4A\CB\F9
\12\B1\17\7C\B8\D8\01\17\32\F0\06\5C\30\A8\96\3B\6F\11\8C\5E\61\2B\46\80\ED\B8\0E\CE\E7\AC\80\4C\6B\FA\C1\3B\C0\5F\1A\DB\DD\EA\23\80\BE\4D\5C\5C\12\93\18\AC\80\11\0B\A4\70\72\40\E4\1B\08\93\C3\B5\C6\D4\F8\C2\FE\4F\52\80\BF\1A\F1\96\11\7E\0C
\7A\C7\FB\41\03\01\C1\4E\45\B0\59\C1\4F\09\28\31\4E\02\D7\89\88\52\F8\A8\38\D8\1E\02\1D\80\0E\01\43\16\BC\8E\A6\EB\A8\C9\6E\3F\4F\29\83\B6\31\81\41\0C\E7\44\07\6F\17\5C\30\E4\5C\72\BB\C7\A2\3F\E0\6B\11\4A\E2\EE\91\93\84\5C\22\E2\2C\8E\4F\46
\10\C8\CC\61\11\85\9B\12\F9\AA\2D\62\1C\E0\36\5D\50\53\F8\29\C6\99\18\A0\35\78\10\43\E2\3D\40\6A\81\B0\80\C7\03\4C\01\81\94\C1\1E\E8\C8\4C\EE\98\3A\5C\22\E8\83\BB\CE\8A\A4\6C\15\23\A2\C0\E9\05\42\E8\6B\A3\0F\01\93\88\01\9B\9E\80\D6\CB\40\0F
\A0\95\4E\8D\BA\3A\EA\13\3E\EF\7C\05\42\E9\03\9E\8E\90\39\EE\09\AB\C8\EE\94\3A\4E\FD\F1\9D\5C\24\7F\1F\E8\E9\53\A5\20\90\43\42\3A\6A\36\EE\97\DE\1E\E9\95\E0\CE\89\4A\6B\1A\94\01\86\75\4B\F0\5F\19\9D\57\9B\CD\A2\C3\98\49\A0\3D\40\54\76\E3\D2
\5C\6E\30\5E\6F\85\5C\5C\BF\12\D3\A0\3F\2F\C1\87\26\75\1F\EA\2E\DE\03\D8\5F\98\E6\5C\72\AE\17\EE\A5\43\E6\EC\2B\DA\F8\63\86\7E\B1\14\4A\B8\62\86\7F\36\D3\FC\D8\65\5C\30\CD\79\F3\D1\A1\5C\30\1D\77\78\EA\68\C1\81\38\6A\25\53\9B\C0\96\03\56\03
\48\40\11\4E\04\27\81\5C\5C\DB\AF\16\13\87\17\C6\1B\4E\A5\60\6E\5C\72\8B\D2\18\75\DE\6E\89\4B\E8\71\55\C3\42\E9\2B\ED\98\66\3E\47\87\B0\5C\72\11\B8\BB\88\3D\40\47\A4\C5\19\E4\0B\64\E7\01\82\86\04\1C\5C\6E\03\E3\29\AC\1C\D0\46\1E\4F\1E\C5\20
\12\68\CA\B7\9B\86\C3\88\66\1B\43\1E\87\C9\85\58\7C\98\87\49\0F\85\5D\E6\F0\33\61\75\79\E0\55\69\5E\E2\39\79\D6\5C\6E\11\6F\5E\72\12\74\5C\72\38\8D\C0\CD\87\23\F3\EE\D8\E2\4E\09\56\02\C8\12\E2\59\86\3B\CA\63\2A\E2\12\25\56\1B\E0\3C\04\9B\89
\1E\23\D8\68\39\72\0F\A0\5C\72\78\63\E2\76\03\28\5C\72\61\9F\E1\A8\03\E6\28\78\6A\61\A1\07\60\67\B8\08\30\E7\04\56\1A\CC\BC\B0\1B\0F\8C\BF\01\51\86\A9\78\28\C7\EB\83\C0\18\67\6C\D5\B0\7B\97\C6\67\68\60\73\57\3C\06\4B\6A\B0\27\BF\3B\29\01\B0
\47\6E\71\5C\24\A8\70\E6\2B\CE\C9\8C\5F\8A\C9\64\F8\B6\5E\26\03\20\06\AF\8A\98\44\C2\78\E0\18\21\62\E8\76\DE\21\45\6A\16\50\56\A4\27\A0\E2\E2\C1\28\94\3D\CF\02\62\C2\5C\72\88\5C\22\08\96\62\A6\DD\4C\BC\5C\30\80\BF\CC\62\74\05\E1\82\5C\6E\3E
\4A\AC\D4\E3\31\3B\FC\F9\BC\D6\EE\DB\88\BF\34\5E\07\73\11\A8\51\0C\C1\70\60\D6\13\17\05\66\1D\10\72\60\37\82\88\AB\78\AA\BB\45\3C\6C\D1\CF\E3\04\09\38\73\FE\AF\27\50\54\10\B0\0B\F8\D6\BA\E6\CB\83\B8\B0\7A\5F\08\CA\54\11\04\5B\3E\D0\08\80\3A
\CF\F3\03\60\12\B3\31\2E\EE\08\BE\12\B0\3B\37\F3\40\81\81\5B\D1\18\DE\3E\BA\12\9E\36\21\A1\13\15\2A\5C\24\60\13\B2\95\5C\30\19\C0\84\E6\60\2C\80\93\F8\C7\E0\DD\C1\40\B0\E0\E1\18\E5\3F\CC\6D\98\3E\83\3E\5C\30\EA\4C\43\C7\B8\F1\88\52\13\B8\CE
\6E\99\B0\1A\2F\2B\BD\60\3B\05\43\8A\A3\D5\F8\5C\30\06\EA\BD\1E\2A\80\3C\46\93\84\F6\2B\EB\83\E2\06\0F\84\71\0B\20\4D\8C\C1\FE\3B\31\18\BA\4B\18\06\5C\6E\C0\3A\62\15\90\33\6A\06\31\99\D4\6C\96\3A\63\3E\03\E1\90\59\81\F8\8F\03\68\14\F4\EC\08
\9E\DE\8E\13\BE\23\D4\16\3B\E3\11\B4\DC\33\D6\BA\94\13\38\0E\E0\35\C7\3A\EF\5C\5C\DE\EF\A8\0E\5C\30\03\58\48\B7\C2\85\B6\AB\61\FE\8E\AE\1D\B8\12\99\4D\31\03\E4\5C\5C\E6\4C\5B\59\17\43\85\07\A3\76\4E\92\05\B7\5C\30\10\2B\5C\30\D4\E4\74\23\F8
\5C\24\0C\AC\C6\D8\16\D8\E0\21\16\40\2A\A9\6C\1E\A6\05\84\09\08\0E\46\17\BB\64\68\64\DD\FD\F9\1C\46\9B\91\E0\26\98\98\C6\98\66\F3\B9\01\29\3D\98\A6\30\0E\A1\A0\34\11\85\78\0F\5C\30\30\30\34\45\44\81\36\4B\CD\F2\E4\A2\A3\08\B1\85\94\5C\30\F2
\03\6E\17\4E\1E\06\A8\5D\10\3B\11\71\BA\34\03\73\6A\2D\CA\3D\2D\38\BD\EA\0F\86\5C\30\E6\16\73\C7\A8\FB\88\B9\06\44\08\01\0B\02\A7\08\66\35\70\34\8C\E0\E9\1B\A9\4A\E8\5E\D6\ED\13\92\18\05\27\D3\94\5B\FA\F9\48\5E\1E\B7\4E\52\10\20\46\1C\12\98
\4B\10\77\BC\7A\A2\03\D2\20\DC\D0\45\94\BA\93\E1\67\46\7C\21\C8\63\A9\F4\E4\6F\95\13\64\62\1C\C1\EA\17\F9\81\78\1D\DF\5C\30\EC\2D\E5\E0\36\DF\01\2C\45\ED\13\84\5F\05\86\ED\EA\33\75\E5\70\20\1B\C7\C2\2F\E5\77\7A\A8\28\A0\D8\65\7F\78\9E\52\19
\61\BA\48\19\BC\59\F9\63\65\8A\9A\35\EA\39\64\5C\30\F3\96\30\0C\40\32\40\D2\90\D6\59\F9\66\65\79\96\8E\59\D9\63\4D\D7\95\BA\68\D9\10\C3\05\95\D6\5B\B9\11\65\7A\5C\72\76\5C\5C\30\C1\65\83\95\F6\5C\5C\B9\63\CA\83\86\EE\5B\D9\75\65\93\97\4E\59
\60\95\E5\DB\96\CE\5D\39\68\E5\A7\97\7E\5E\59\71\65\B1\96\A6\5D\99\71\65\5F\7C\14\36\21\8E\DE\F3\18\75\EF\60\8E\66\07\04\D5\EE\99\4A\E6\0B\7B\E8\0F\37\B8\BA\4D\7B\B6\59\D9\87\06\A9\19\F8\6A\82\65\17\C6\CC\43\BB\A2\53\36\5C\30\01\44\75\61\73
\46\4C\7D\BA\15\12\5C\24\C8\87\1C\E0\28\E5\06\94\1E\4D\62\1E\85\C8\E0\C6\A4\2C\30\42\75\CE\AF\85\EC\1B\A5\D1\82\1F\32\F6\0C\67\78\46\D1\99\7B\1E\81\61\B8\7F\1B\6E\3A\69\5C\72\50\6A\FD\16\65\CF\F1\98\72\C8\14\72\D8\CF\47\10\FD\42\04\59\A0\88
\4D\2B\0C\71\18\EF\0B\0E\E7\16\69\59\94\64\CB\99\E9\8F\60\30\8E\C0\2C\3E\36\0E\AE\66\6F\9A\11\30\F9\A9\86\6F\99\F3\20\E6\58\66\A2\9D\E4\13\F9\5C\30\C0\56\DD\4C\21\93\AB\66\85\11\86\6C\E1\1D\9C\36\81\20\C5\2F\EB\E6\A3\31\1E\05\65\83\95\5C\30
\89\3E\6B\62\13\66\E9\5C\72\98\21\EF\75\66\F2\3C\25\E4\28\72\1C\CB\9B\F9\16\61\26\02\0C\09\0B\FD\99\A8\E0\59\80\DE\21\A1\04\19\D2\F1\96\6D\42\13\67\16\3D\40\83\D0\5C\72\E7\15\3B\20\5C\72\18\DE\35\70\08\68\49\A0\39\62\6D\9B\5C\24\42\59\CB\8B
\FF\9A\C4\67\8F\78\E7\23\89\40\51\45\4F\06\08\C7\E6\6D\39\96\04\AE\CB\30\5C\22\80\BA\E7\21\9D\74\A8\98\EA\86\CB\89\B8\AE\D0\87\E7\4F\2A\20\C5\E5\FF\5C\30\C2\DD\3E\25\04\D6\02\5C\24\E9\06\6F\EE\90\18\72\4E\26\73\39\BF\66\A3\9E\34\E7\F9\99\67
\8A\E4\7E\6A\4D\F9\66\7F\9B\16\77\79\E8\67\17\9B\0E\79\ED\5C\5C\60\58\31\79\35\78\FF\8C\F9\9E\5E\7A\19\EF\17\5F\2C\26\20\6B\D1\E6\A2\E9\16\7C\A1\80\C0\A6\31\78\0E\18\1E\E7\CF\41\91\36\F0\17\02\20\5C\6E\EE\6F\E8\94\BB\1D\8C\26\78\D9\EF\67\67
\99\7B\72\85\3F\E7\B7\9B\FC\2D\B0\BD\85\AE\7C\74\E4\10\33\1C\B1\9A\88\C8\CD\7D\67\48\67\4B\A2\39\BF\BF\A8\F5\10\4A\C0\3C\43\11\A0\43\B0\A0\31\84\EE\39\FE\37\87\81\67\F7\9A\13\82\18\EF\68\36\21\30\48\E2\ED\13\15\9B\63\64\79\B4\66\FF\A1\08\44
\41\3B\83\82\14\39\85\0F\54\E6\A2\FF\AE\30\AC\C4\5C\30\C6\70\D8\E0\F9\17\86\90\1E\21\87\20\36\5E\E3\2E\F8\53\C2\B2\3F\C6\02\D8\05\A6\45\28\50\AD\CE\88\20\2E\E6\C2\1A\A0\35\80\C4\68\8A\E9\06\88\06\45\50\4A\08\76\89\A0\2E\8B\95\A2\2B\97\1A\5C
\24\E7\35\8D\8C\3E\50\2B\B5\3F\16\7E\89\19\A1\67\8C\1A\36\5C\72\B3\F6\68\A2\BC\70\AB\7A\28\E8\86\57\D9\C4\60\C2\95\A8\B1\5C\22\79\AF\F1\CF\3A\D0\46\61\64\C5\AC\0F\8D\36\3A\F9\A1\66\98\11\DE\69\5C\30\EC\98\14\DD\D8\E0\41\3B\E1\65\A2\B0\E0\EC
\AC\E7\5E\CA\D6\77\10\8F\66\84\20\19\3E\79\CD\06\8E\15\0E\8A\CB\F5\60\2D\5C\72\0E\8A\DA\18\06\08\03\85\E1\5C\30\AD\68\72\5C\72\CE\72\A3\38\69\5C\22\1A\10\5F\DA\09\03\8D\A3\A3\BC\39\A1\43\49\9D\B9\66\58\CB\88\32\1A\A6\89\9A\5C\22\CD\C5\A2\89
\85\A0\F8\68\A2\4C\7E\8A\5C\22\F6\85\9A\25\56\95\3A\21\02\25\8A\9E\78\79\E8\69\02\11\0E\7A\79\02\67\84\03\76\78\DA\5D\82\1F\9E\C6\7D\13\71\67\8D\9E\C4\C3\5A\0B\69\8C\E4\7C\01\8C\81\60\C7\2B\20\5F\FA\67\E8\F2\FA\86\99\D9\A3\BE\FA\1B\AA\C2\C0
\C2\E8\AD\9E\36\50\41\80\CA\80\5C\24\B6\3D\81\18\39\1F\A2\8C\F9\E0\CD\68\8B\A2\7C\70\92\A0\08\FF\A2\88\E9\98\ED\E8\21\A2\8E\2E\F8\21\06\94\FE\B6\9E\10\FC\69\E7\A7\5E\9C\F8\DA\69\CB\A2\8E\38\7A\56\43\CC\F9\F6\8C\5A\5C\22\80\E6\E4\D8\0E\1A\28
\C4\03\A5\9B\B9\B0\39\E8\55\29\FB\A5\21\44\67\55\5C\30\11\C3\6A\FF\E3\BF\3F\60\C7\F0\34\E3\06\4C\54\6F\40\95\42\9D\11\A4\A7\FA\4E\86\61\9A\7B\C3\1A\72\E7\3A\5C\6E\CC\9F\93\45\84\BB\38\C3\A6\26\3D\EA\45\A8\18\2A\5A\3A\5C\6E\3F\98\A8\67\A2\8F
\E8\CC\8A\16\A3\8B\12\68\A2\F5\2E\95\98\92\A0\4E\FE\35\05\1A\28\88\53\83\68\D1\F4\01\69\32\13\D6\2A\63\84\66\FD\40\16\95\93\D1\DE\37\A6\06\9C\7A\5C\22\E1\83\7C\14\D6\FA\72\50\1B\86\16\13\2E\C7\80\CA\4C\38\54\27\BF\B8\6B\A2\88\DF\3A\28\B9\71
\32\26\9C\C6\45\44\B1\32\7E\9E\02\FF\BF\D8\B1\FE\9C\8C\AC\C3\39\0B\FB\D2\C2\76\05\A3\A9\BC\38\0E\FF\83\8D\A9\96\A0\40\FA\E9\5E\58\3D\03\58\02\60\11\AA\90\71\5A\BA\D0\51\AB\D6\AE\60\39\6A\F8\35\5E\88\B9\E5\40\E7\AB\B8\CE\02\6E\BC\71\01\76\9E
\0E\B1\E1\1D\A8\33\B1\DA\C7\E8\8A\28\49\36\F0\AA\6A\9A\64\54\B1\DA\C2\19\14\5C\5C\06\8A\20\82\9F\33\A2\2C\99\CF\68\E9\6B\A2\33\1F\FA\28\EB\33\AC\91\91\50\D2\03\75\95\56\11\CF\7C\5C\30\EF\A7\86\55\01\E2\6B\3B\A2\CC\4A\51\B6\E3\A0\E9\2E\A0\DA
\09\3A\4A\5C\72\8E\8A\31\9F\EA\6E\08\EC\42\49\5C\72\5C\30\C9\AC\68\40\98\BC\3F\D2\11\4E\B1\5C\6E\73\68\97\AE\03\E5\5C\22\14\EB\92\F2\3B\A6\72\7E\37\4F\A7\5C\24\A0\FA\28\E3\35\18\A4\52\10\C5\E8\C6\09\0B\E8\CA\BD\6A\C2\02\EE\05\9A\D8\17\46\59
\46\A0\9A\DC\94\A3\AB\7E\89\78\DE\BE\0F\A9\66\A0\BA\5C\22\E3\86\76\DB\93\6F\9A\EB\CB\A8\16\BA\BA\C2\BA\23\8C\DC\61\1A\D2\E8\8A\F5\B6\AE\01\50\93\84\CB\3C\05\E3\E1\68\A3\2D\33\E9\BA\9D\2F\47\1C\81\78\AE\F5\B2\05\9D\06\02\6E\C7\69\40\5C\22\92
\47\85\3F\8D\F3\A4\1B\2C\EF\19\03\5A\70\D6\04\78\58\60\76\1B\A6\34\58\1D\C6\F5\1A\F3\E0\FB\0F\84\5B\83\10\49\12\B6\9C\37\9E\C3\A5\58\0B\03\63\09\EE\C5\21\A1\03\62\E7\A2\7D\DA\6A\8C\5F\7F\BE\A5\39\E1\35\71\10\74\69\A6\36\66\BB\9E\92\B0\B8\DD
\18\D9\9E\35\FF\FB\1F\E7\A0\1B\46\C6\B9\E3\69\D1\B1\A9\70\11\58\27\F8\32\A1\8E\72\83\84\AE\30\C6\C6\BA\E9\02\1F\A7\44\2C\23\47\EB\55\32\80\CC\D8\8F\E2\49\8F\10\E8\5C\72\02\6C\28\08\A3\97\20\80\EC\B1\A3\A6\A8\06\3D\D0\41\1B\B8\61\01\80\EC\A9
\B3\2D\06\38\9B\64\62\53\FE\88\FB\05\12\F5\34\7E\82\F4\10\97\48\0E\0C\3B\B0\C2\1F\AD\0E\01\30\E0\36\1F\1D\8D\16\C7\62\8F\E9\7B\AA\84\DE\BA\52\E6\02\E8\C3\73\33\7A\EB\AF\0C\C3\C0\81\FC\4E\1C\F0\DE\84\8F\8E\60\C6\CB\86\2B\F2\A6\04\AD\A0\34\3C
\F8\5E\61\83\79\B0\AC\18\94\09\7D\1A\72\B0\C2\13\E2\79\B4\F5\E3\E1\FB\B8\6B\8C\26\34\40\88\C1\3F\06\7E\D4\E4\C5\63\45\B4\C2\C8\1A\AD\40\88\4C\53\40\80\8C\E9\7A\5E\16\8F\71\71\4E\1D\A6\B0\3C\2F\48\82\6A\08\5E\73\43\17\E2\60\E8\E6\73\1B\62\67
\47\79\B9\90\A4\D6\5E\1A\5C\6E\C8\4E\F3\5C\6E\3A\47\B6\4E\7D\18\BC\63\5C\6E\18\EE\DA\04\D5\ED\A4\20\2B\A3\86\EF\3D\86\70\D9\31\BA\92\4E\1D\B5\54\42\5B\64\C0\FF\B6\96\05\9A\B6\D0\8B\A2\BE\DC\B9\F1\60\1B\B3\6E\DA\6F\16\6A\3B\9E\6A\C4\9B\77\68
\D8\F5\9E\80\63\39\83\82\70\CC\A1\5B\79\34\AB\A8\B6\30\1A\35\9C\CD\8B\4E\DF\C1\2B\CE\BF\B7\D0\60\58\64\61\E1\8D\E6\13\2F\7A\6E\03\2A\F6\50\C0\87\EA\C1\B8\23\74\ED\07\E8\B5\B8\7E\E0\39\57\EE\09\9A\56\E2\F2\7E\05\3D\B8\08\23\D9\F9\6E\29\A8\EE
\7F\B4\1F\EE\09\32\DC\C9\3B\85\6A\3A\F5\B0\4A\E1\6B\84\43\B8\21\3E\78\1D\EE\03\19\F9\35\9A\A3\15\3D\3D\A6\32\BB\97\82\2E\0F\A0\0B\E3\7C\BF\27\A8\EE\E4\5B\80\CC\27\97\3B\FC\DA\76\BD\F9\AB\96\93\01\B8\84\AE\F7\13\CE\18\03\EB\03\81\CE\3B\3A\53
\41\09\BA\26\D0\5B\A3\6D\16\65\86\EA\12\E3\6E\8D\B1\EB\FA\FB\AA\EE\99\AB\CB\B5\1B\A6\C4\1F\95\3C\9F\BA\36\6D\61\11\91\3D\59\2E\E7\A5\9E\C0\C5\3A\16\67\B6\D4\FE\C9\E8\85\80\F9\B0\9E\D0\3B\AB\49\DF\BB\78\C5\5B\94\E9\04\12\10\49\A1\04\4A\5C\30
\F7\7E\C2\7A\61\13\59\9D\AE\ED\1B\BA\EE\FC\77\54\5C\5C\60\96\ED\56\5C\6E\C6\7E\50\29\E9\7A\4A\BE\90\A9\E6\BD\FC\F1\F0\51\40\DD\E0\5B\18\B6\0C\7B\72\CA\89\B5\44\EE\01\0B\42\17\84\76\97\EF\7C\69\2D\B9\45\E6\F8\18\4B\8C\3B\5E\6E\BB\7B\EA\F3\BD
\16\E5\3A\4E\68\3B\1B\96\97\DA\32\0E\C1\A8\C6\80\70\17\E7\D1\B4\36\93\FA\83\BB\E7\BD\98\39\1B\A7\39\A1\A5\F6\D6\58\C2\68\51\9C\7E\97\DB\DB\69\41\9F\40\44\20\9A\6A\87\A5\EE\7D\18\D1\6F\7A\4C\56\F7\EF\12\E7\D1\B3\7E\F9\14\19\16\95\9E\09\38\42
\3F\E2\23\0C\46\7D\02\46\BE\54\64\AD\EB\BB\E1\D0\65\02\B1\C3\7A\63\EE\E7\9F\46\C5\C0\8A\67\82\37\CE\97\DB\EA\E0\80\20\36\FD\23\2E\45\C2\A3\BC\E1\C0\D6\C2\A3\A5\F0\53\A3\2E\4A\33\A5\F6\35\BB\AF\4B\C9\A5\F3\4A\99\A7\06\08\B8\3B\A4\97\84\6E\35
\BE\BE\3A\79\53\EF\91\C0\10\43\DB\76\6F\D5\BD\2E\98\7B\F1\F0\10\09\64\5C\5C\30\01\06\EB\3F\57\5C\30\21\29\F0\13\27\9A\04\FB\BC\E8\45\1B\67\01\E1\3B\E0\2B\BB\8F\5C\30\FC\0B\02\59\A0\4E\74\8E\62\70\2B\C0\1E\86\10\63\8C\F8\93\FE\A3\5C\30\A9\42
\3D\5C\22\07\04\0B\F9\63\86\54\F1\9D\3A\42\9C\B1\C1\9E\A4\FA\1A\63\F0\EF\0C\88\1B\FE\EE\C6\EF\16\B8\50\91\49\DC\C8\44\B8\C2\17\03\56\30\CA\C7\21\52\4F\6C\89\4F\08\98\0B\4E\7E\61\46\FE\7C\25\C9\DF\BA\B3\B8\0E\AC\85\10\F2\29\4F\F9\BF\09\1B\81
\57\04\19\EC\6F\B4\81\0E\FB\87\51\F0\77\A8\C8\3A\D9\9F\6C\10\E9\30\68\40\3A\83\AB\C0\D6\85\38\1D\EE\51\A3\26\99\5B\C0\6E\E7\B9\46\EF\DB\70\2C\81\C3\A6\E5\40\87\BA\4A\54\F6\77\B0\39\BD\84\28\FE\86\9C\3C\E9\7B\C3\C6\90\4F\5C\72\F1\09\A5\E0\0E
\F9\DA\82\5C\24\6D\10\85\2F\48\6E\50\5C\24\6F\0E\1A\5E\AE\55\A1\CC\5C\22\BB\BF\E3\7B\C4\96\85\3C\2E\EE\E7\A1\16\8B\6E\A5\71\38\5C\72\D5\5C\30\3B\B3\6E\A3\C4\DE\D4\DB\F0\E7\A1\9F\88\2B\CE\DE\B3\33\A2\BC\6E\7B\C3\44\5C\24\08\37\0C\19\AC\2C\45
\7A\37\16\5C\30\85\93\15\1B\6C\21\7B\98\E9\38\F7\E1\B6\78\D2\82\B0\0E\2E\73\38\87\50\41\B9\46\78\DB\72\F0\17\C4\D3\F4\51\DB\AE\01\80\0E\B9\86\31\CC\85\B8\70\2B\40\D8\64\D4\11\DE\39\01\4F\50\35\BC\6C\4B\C2\2F\BE\91\B7\BE\98\5C\5C\6D\E6\FA\B8
\C4\0E\73\87\71\BB\A0\EE\76\BA\51\ED\2F\A7\FF\1B\DC\09\84\21\BB\B6\E5\7A\0E\BC\37\BE\6F\1D\9C\06\BF\45\C7\86\D2\3A\13\71\E0\56\A0\35\98\3F\47\19\A1\48\4F\0F\AE\E2\4F\86\0E\5C\24\FC\6C\BE\9A\2B\07\16\E2\8F\16\2C\F2\9C\5C\72\3B\E3\E7\B0\08\BE
\A4\92\7E\CE\41\C4\8D\E9\8C\B3\E9\7B\C8\60\37\7C\87\14\FF\C4\82\C4\E0\EB\72\27\89\B0\4A\69\5C\72\63\2B\A2\7C\97\23\2B\3C\26\D2\9B\B9\3C\57\2C\81\C3\3E\A2\BB\5E\F2\50\F0\26\6E\C2\4A\68\D0\65\87\25\64\B6\E6\EC\E8\CF\1C\DC\1B\02\43\83\69\B6\7A
\58\C3\11\41\FF\27\44\CD\3E\8D\C9\CE\88\A1\45\6B\A3\CA\06\AC\40\A9\04\42\F2\77\28\80\2E\96\BE\5C\6E\39\39\41\EA\AF\68\4E\E6\63\EE\6B\4E\8F\0B\BE\64\60\A3\D0\C2\01\70\05\60\C2\F2\B0\25\32\F6\A6\BD\33\48\86\CB\62\32\26\A8\3C\A0\39\A4\52\28\F2
\C0\87\02\74\E1\54\48\AC\09\E0\7A\91\D6\27\9C\D7\20\9D\08\6F\F2\C0\1B\8B\3E\34\3F\D4\5C\72\5A\CC\77\CA\D3\82\E4\D7\34\83\60\BA\C8\D0\87\E9\8D\86\B5\B3\4E\87\F1\9F\E9\D3\80\EE\9E\27\2D\49\F5\C8\EC\86\F7\30\28\53\A8\72\D8\77\2C\FC\B9\D0\E5\CB
\13\4B\CA\10\72\CD\CC\27\2D\32\01\48\6C\01\6F\2D\C1\55\F2\E1\CB\E2\5F\92\0E\27\57\23\27\2F\FC\C9\48\D6\9F\A4\8D\AE\6A\36\93\CC\89\8F\A1\A1\C9\04\E0\C8\AB\81\B6\5C\30\E9\84\3C\91\0E\0E\84\1C\DA\FA\8C\0F\8E\05\6A\31\A4\45\92\51\8C\54\DC\54\8F
\AD\C6\72\C1\42\63\6D\ED\31\36\E3\CD\88\67\1C\D9\AB\03\3A\77\36\CD\AF\04\05\9B\68\40\31\C5\49\19\3A\A4\C3\C1\92\C9\FE\32\F3\70\F2\92\4C\2F\CE\C1\9F\C2\8F\9E\04\77\FF\3A\F2\C5\91\D3\CE\F8\4B\3C\F0\CC\45\04\0F\3C\82\FE\4A\AD\37\36\D3\80\8F\73
\D7\2E\CC\B2\73\5A\F3\DF\2F\5C\24\F7\41\73\45\79\CF\9C\E0\72\DA\72\3A\03\77\3F\13\D5\89\94\21\CF\3F\B3\E1\EA\C7\99\D0\5A\93\9D\4D\CD\39\BB\D5\9D\5C\30\CF\C1\31\3F\41\52\CD\A6\25\D0\37\3E\13\D6\4D\C7\41\52\72\7D\08\73\E9\80\F1\72\29\5C\5C\74
\2D\38\1F\3D\B3\F6\CD\CB\D0\8E\55\FD\06\CB\2C\57\4F\43\73\D5\86\84\D0#w\BD\11\35\AE\E1\AF\45\52\6C\03\4D\2A\AF\44\B3\E7\31\FB\D1\17\3E\5D\18\CF\C0\67\4B\A4\B2\56\B9\5C\6E\DC\5C\5C\E8\DC\D3\73\88\DC\87\38\CD\B9\73\65\CD\A7\39\8D\AD\73\6F\CE\7E\84\A0\EC\F3\77\34\78\05\E0\8C\07\86\92\F1\66\40\D7\D0\06\DC\44\AD\F6
\39\80\87\CE\CA\36\AC\81\02\5C\30\09\40\2E\A9\07\EE\90\0F\B2\40\12\B4\02\39\5C\30\8A\43\3B\4B\08\F4\90\79\2B\D3\4A\F0\93\1B\DC\D9\A5\83\CF\75\3C\5C\5C\FB\60\F2\63\7B\D3\8B\A4\1A\45\A3\3E\FF\79\8E\C1\4A\3D\6C\8C\FC\EF\E1\2F\85\15\2D\97\37\98
\FE\04\06\94\D0\5A\34\36\A8\75\43\7F\35\99\91\50\E7\CE\A9\B4\52\56\D0\F2\E6\A1\02\DC\E1\D0\FD\CA\B3\6C\56\F8\D2\61\4E\78\FB\14\60\D5\B4\3F\55\DB\37\28\48\50\93\7D\6A\56\11\D8\4A\EB\7A\4E\15\18\51\4A\16\F7\53\96\B8\8F\B1\73\2D\67\16\12\51\21
\61\A5\12\56\1B\D8\5F\53\77\52\FD\4F\F5\33\61\6D\87\1D\5A\58\77\5A\CD\6F\89\27\DD\77\61\AD\89\D6\4F\D8\6F\5A\B5\93\F5\21\D9\05\5B\5C\6E\3C\F4\5A\80\B5\4F\A5\D2\B6\27\C7\C5\4F\6D\6F\F7\5B\D7\D3\61\15\90\3D\51\BA\E4\3E\82\3A\F5\81\54\D0\5C\6E
\B5\8E\A8\E7\5C\30\8A\02\3D\80\FD\6D\D7\05\6A\18\FA\96\41\54\C3\52\C5\62\75\28\C8\49\D7\13\7F\B4\E8\3A\E5\D7\15\5C\24\76\BE\57\F5\D7\15\B5\C3\F0\75\C5\53\BF\5C\5C\56\38\D8\E7\76\E7\5C\5C\F5\95\D7\67\21\4D\D0\B6\A6\75\C5\D6\1F\5F\B5\26\D6\69
\73\BF\5C\5C\43\FF\52\8D\56\4D\A2\5D\74\58\8F\54\37\5C\5C\55\6F\54\D7\D8\6F\5F\D4\AF\DD\9B\53\3F\61\D4\6C\C8\53\D8\2D\4C\75\74\5A\1F\47\65\C7\16\13\D5\E1\69\60\09\7D\58\5A\8B\69\7D\51\95\79\57\5B\69\AD\85\54\8A\F6\59\6F\8D\A6\A0\28\5A\45\5C
\5C\A8\05\7D\6E\D9\8D\69\97\66\96\91\DA\8B\D9\CF\57\D7\64\D1\25\54\FD\70\75\33\75\CD\54\FD\66\35\29\76\88\DB\17\5D\D5\55\52\33\56\45\59\5D\A5\58\B8\5C\6E\B7\5E\BD\A7\56\71\53\BD\53\FD\7D\58\E9\69\47\66\95\DA\76\02\3E\AD\53\FD\82\76\BB\4A\4D
\51\9D\9A\76\0F\DA\95\8A\9D\85\D4\D9\5C\5C\95\67\5D\B4\51\59\45\93\CE\DD\B5\23\31\56\FF\6C\35\55\D8\45\4B\5D\1B\D5\C9\5C\30\B3\D8\DD\53\FD\8F\55\3F\5C\5C\BA\42\77\1F\53\95\55\8A\37\96\B4\D5\6D\5A\BD\56\35\5C\5C\F5\B9\57\1F\66\FD\C2\D5\A7\5B
\A5\65\55\72\F5\7B\47\07\5C\5C\B5\FD\55\B5\DA\2C\84\9D\C9\F6\91\57\85\5B\5D\78\F6\9B\56\D7\6A\35\6D\54\EF\56\D7\6A\DD\7E\75\37\D8\5C\30\FB\56\A6\55\B5\D8\27\74\FD\B0\77\1C\3F\6D\73\DD\D5\D4\C9\DB\35\56\DD\C3\76\1F\DD\8F\71\7D\D9\F6\E1\DD\75
\2D\55\71\D5\5D\DD\97\63\5D\DA\57\DD\D8\F5\5D\54\74\3A\ED\66\8A\4D\94\6B\8F\B6\93\65\5D\EE\B9\5B\2D\70\7D\5E\D4\49\5B\A9\58\15\44\E3\E9\BA\E5\59\1D\BF\17\10\56\97\64\F5\C0\FD\4F\5D\09\73\65\4E\F5\A3\DC\DF\5A\AF\57\1D\59\DA\5B\D5\74\85\16\1F
\C8\56\3F\F2\33\08\DE\C7\B5\DF\4D\93\F6\F1\DD\99\60\D0\FB\74\5E\77\A3\64\B2\3A\16\71\54\8F\4C\95\40\40\3E\5D\C1\6A\5C\72\46\DD\71\76\B5\DD\2D\4C\76\B4\47\9D\4B\77\69\F4\4C\77\49\50\4D\6F\94\F9\C7\B9\4D\67\76\BD\FF\F8\11\5B\A7\81\55\1B\73\73
\A6\8E\15\7E\09\E8\F5\85\77\3A\1A\42\E2\41\08\91\9F\D1\4E\45\F9\7B\E4\21\1B\2D\D4\C3\64\FD\9F\81\6F\5C\30\B4\92\7D\26\DE\0B\04\AD\8D\90\68\58\D5\CE\41\8D\96\35\B5\25\D9\A3\66\7A\4C\D6\48\D9\35\64\AD\94\20\14\59\85\5F\25\85\76\B4\D3\99\21\6D
\9A\D2\12\5D\D6\EB\95\D8\D2\11\8F\CC\18\25\FC\F1\16\DF\F2\80\FE\10\E5\3D\42\A9\0E\3E\45\20\14\5B\23\5E\7D\1B\F6\68\59\46\DB\17\61\B7\7F\DF\C6\3E\7B\A1\67\53\85\B6\F0\1E\0F\70\5B\EC\46\F7\A6\10\CF\44\61\12\EB\36\11\6E\8F\E6\05\0E\04\B4\C0\B6
\19\78\39\AB\A5\38\4C\EA\49\E3\88\AB\4E\96\61\3D\88\53\CA\40\FA\62\14\50\6B\A6\2E\99\E1\4E\F2\F8\48\F9\94\6C\5C\30\FA\86\10\18\3A\E0\F0\E8\96\0E\EE\8A\BA\32\18\23\E7\CE\98\3B\BC\ED\AE\76\F8\03\4F\7D\80\10\39\13\69\6B\5D\09\26\AE\7B\F5\89\20
\F8\AB\D5\0E\9C\06\D9\32\7C\61\97\B7\0C\26\14\F3\07\E3\D4\17\C7\7F\E5\FF\DE\51\BD\A5\AA\B1\CC\EE\CE\E7\A8\1B\29\C9\F1\B5\6F\D9\81\93\C7\B8\1A\02\3A\E9\26\2E\5C\30\B6\35\71\01\5C\30\4A\D0\4C\BD\E9\82\36\34\68\11\79\80\33\15\08\AE\DE\A2\AB\B9
\98\61\AE\DE\83\F9\82\49\11\7A\86\C1\4F\82\97\96\F1\84\E6\EF\AE\88\5C\22\E1\B6\79\42\08\BB\CA\B3\7B\12\AA\33\C6\25\98\35\72\28\6D\D8\C8\E0\C2\E1\C7\78\2E\37\72\D2\62\25\C1\87\15\FC\18\5E\A0\65\86\4D\80\1A\BB\A2\32\AE\5C\30\78\97\BD\21\89\62
\7D\2E\AE\E2\59\03\36\5C\24\10\06\71\53\94\CF\5C\22\5E\7C\78\45\85\E4\C8\F8\61\02\1F\E3\FE\91\0C\BC\C0\80\EB\58\C7\A1\35\82\39\86\9E\1D\27\54\82\52\1C\09\C3\63\39\C4\E3\E8\57\A2\18\31\DF\E1\16\D1\41\CE\94\50\ED\A6\8F\9F\D8\8F\68\0C\03\36\27
\DE\6F\F2\2D\E0\D6\CB\70\06\0B\B5\05\BE\54\28\13\5C\6E\6E\5C\72\CB\C5\90\93\E5\31\0F\D4\1E\1C\8E\84\52\EF\0E\52\02\55\67\DB\E9\83\C8\FE\99\93\E7\78\A8\95\50\65\23\EE\E9\19\2A\A4\E2\6B\12\1A\10\54\3C\9F\3C\8F\10\3E\62\3B\04\8B\93\5C\30\81\99
\90\C1\98\16\67\4C\BD\2E\8E\04\3C\11\6B\A9\5A\76\E1\CC\0F\84\F8\AF\F3\7A\B3\B6\C6\38\7E\AC\F0\79\37\80\59\B8\EF\C8\81\EA\DC\37\77\A8\E1\4F\07\64\05\6E\D2\3E\04\03\A4\3C\80\FA\9B\45\E9\33\88\A6\77\04\53\94\DB\86\9C\40\BE\A1\EB\AE\20\6F\15\F4
\57\C5\31\0C\85\F1\FA\F1\BE\D2\BA\1E\BF\7A\E3\89\65\ED\DE\BD\E8\B1\E5\31\DD\18\88\7A\F7\5C\30\66\3D\D8\F9\63\E3\8A\A4\67\B9\9F\7B\1E\E9\DE\3E\6E\8C\70\5C\30\B1\CD\E8\CE\91\3A\48\E9\86\42\6E\8C\36\46\E8\C6\42\AF\72\E7\57\3D\F6\E3\43\3E\03\4D
\2E\31\7E\40\33\BA\47\ED\39\87\38\F7\71\3C\53\16\F4\7C\1D\FB\59\95\38\51\50\E2\FB\60\4C\5B\9E\9E\D6\71\7A\0F\E7\98\DB\AB\50\C7\ED\E8\4E\E0\3C\7B\5F\2D\06\D9\AE\A5\64\1F\90\4F\B8\F9\06\64\2D\EE\4E\42\37\9D\E4\34\DD\EE\42\F9\0B\4E\C1\ED\2E\56
\BA\B7\18\E7\39\C6\A8\90\51\F8\33\BA\9E\16\7B\49\63\50\5C\24\A7\BB\BA\68\FB\BE\13\3C\0E\52\20\79\79\85\EC\3F\DE\F2\9D\47\D2\FE\3A\6E\99\E3\7F\80\B5\05\1E\F4\67\CD\C1\9C\FF\3B\41\68\21\E5\D4\FE\C1\26\E5\04\13\BB\2B\3E\F0\0C\CB\80\DB\3B\4D\C1
\CB\8C\DE\09\CD\FE\FE\C3\11\EF\FF\36\53\E2\EE\8A\B7\4E\90\B8\DA\8C\3D\04\23\F1\1B\EB\EB\F1\B3\B1\60\FC\54\FC\23\2B\EC\6E\FB\3B\95\15\B7\72\2C\82\C7\02\BD\F0\A6\CF\06\58\7C\23\EF\1F\C4\1F\5C\72\FC\23\A0\EF\C3\3F\5C\6E\FC\44\13\3E\A8\7C\56\FC
\53\F1\0F\BF\1F\08\C2\DA\65\CF\97\7E\4A\E3\6D\39\06\39\85\E1\BE\5C\6E\73\C6\7B\53\17\7C\72\5D\2C\03\7E\FF\CB\B9\F1\F8\E9\BF\20\B5\71\CF\49\81\3F\5C\22\7C\77\F1\A6\F8\FF\25\7C\8C\12\6A\91\1F\5C\30\72\45\F2\2C\6B\53\6E\FC\A1\ED\E7\BF\F8\71\C6
\95\C8\64\38\42\2E\FB\F1\87\19\31\AB\D1\FC\B3\5C\22\04\99\DF\2F\7C\C6\12\B4\18\80\D8\83\5D\F2\FC\88\0C\B8\12\AD\80\B7\45\11\16\FC\CF\9C\E8\4E\B2\6C\FC\CC\D5\C6\1C\78\D6\CB\49\B0\F7\CF\12\20\49\63\F3\BF\C5\B8\2E\7C\5C\24\38\44\1E\B9\9F\46\A8
\DD\CC\10\93\85\98\50\D5\4B\C6\F2\80\33\83\F4\5C\5C\6A\BE\A5\78\55\81\CF\43\2F\E4\E3\B3\D2\97\BF\10\0B\41\7B\B9\8E\C0\10\D0\FB\FE\0F\65\FC\DA\11\83\90\80\FF\D3\E6\D7\0B\B6\E9\06\DC\BE\FF\8A\D5\F4\E0\5C\72\70\03\FD\55\5C\6E\E7\D5\9F\57\6C\6F
\C2\AD\0C\59\E2\7B\FF\F4\98\0F\19\E3\60\5D\04\27\D6\FE\0C\FD\73\9E\86\D5\2F\7C\BC\6F\EF\FF\D7\E0\33\E7\17\8E\C0\72\9E\FC\7D\8B\F6\3B\DA\FF\5B\CA\06\03\6E\CE\1B\B9\FB\FF\BA\9E\97\BF\4F\ED\4D\37\AF\0B\DB\1B\C9\DF\A3\D8\BC\71\BE\B5\71\28\CF\D0
\5F\6C\E2\18\12\71\8F\73\81\4E\1D\F7\11\93\79\F2\FB\F1\C4\E7\D5\3B\1B\8C\69\C0\67\BF\06\74\97\87\C5\CE\3A\1E\FF\FD\E5\C8\EB\D5\99\A7\71\6B\07\87\BF\ED\F4\E1\7B\F7\9F\DF\3F\7A\FD\BF\F7\CF\DE\FB\EA\F1\4D\C8\97\DF\6F\1E\FD\EC\03\27\E0\14\12\6A
\98\FA\EF\E1\7F\86\E3\63\F8\79\F1\DF\84\FD\E3\F8\67\DF\1F\87\67\6B\16\8C\77\C9\E2\66\38\BC\56\63\D4\37\66\41\CC\04\8D\59\91\B3\E5\2B\0F\4B\78\F1\85\3D\9E\67\4B\41\6B\FE\54\2C\39\35\72\64\E3\2B\F9\47\E5\C0\BA\ED\D9\AF\84\1E\85\F1\FE\5B\D2\E0
\25\81\85\41\C5\04\77\E6\9F\9E\17\B5\FA\16\85\1B\BD\E5\37\F9\DF\E5\E0\AC\85\A3\25\B7\A0\7B\BD\6D\ED\FA\38\25\5F\94\FE\6D\FA\97\04\71\88\E0\56\CB\CB\A8\5F\A0\FE\93\25\AB\21\1E\FE\45\83\FA\BC\69\0E\F8\7E\91\F9\B2\68\A0\FA\7E\BB\9F\43\AA\DF\AD
\7E\A7\F9\A8\25\8E\86\84\AD\B5\97\E7\5F\A8\FE\D9\FA\1F\E5\FF\B7\72\4C\6B\44\AB\79\CC\FA\8C\F0\7E\D4\3F\70\06\31\17\4F\21\3F\BF\05\15\07\AE\76\18\15\CC\5C\5C\EF\E4\B1\1B\50\11\6D\A9\1F\5C\22\B8\CC\3C\FB\8C\AF\EF\9F\C5\FA\45\A9\36\85\20\E4\45
\9F\8D\56\F0\B3\E5\CE\1D\F1\9A\04\7A\6B\EE\C7\FA\A6\39\1F\B3\7A\07\C9\0B\AA\DF\D0\7E\CA\03\2F\EC\E4\D5\BA\AC\15\1D\E9\21\51\02\8B\3E\FF\A0\4F\A3\E5\4E\6D\13\E8\F0\33\72\05\88\E7\20\46\1C\FA\98\6C\91\1F\D2\FA\65\3B\A4\4D\E3\DF\B7\85\9F\BA\CF
\BD\9E\5F\61\1F\A0\B4\21\12\7E\43\BB\BC\66\19\80\FA\E5\01\BC\62\7D\33\9C\20\4B\BC\66\16\F8\DC\ED\2E\20\1F\09\D9\E4\7D\2E\13\A9\FE\BB\83\44\58\09\69\35\BF\7C\FA\8C\1A\3F\F0\C0\3D\5C\30\F5\B1\3F\EF\3F\BB\F8\3F\A3\DE\05\40\88\FF\C3\95\A3\BD\66
\75\7E\61\8D\5E\92\D8\6E\FB\04\E1\AA\79\B1\51\3B\EF\A0\1A\71\B9\CC\E0\8C\FE\29\80\73\92\53\BD\2C\5C\22\47\86\5C\6E\75\25\CA\C7\55\AD\59\EF\41\4B\6C\5C\6E\D3\EB\1D\42\18\D8\04\49\CA\38\36\56\43\63\4F\5C\30\D6\18\60\7D\2E\78\A9\83\10\EE\84\2C
\2D\05\4E\E1\87\40\7E\BA\E8\9C\54\18\FF\47\9B\E7\03\1F\FC\96\27\05\FC\C4\18\64\DB\4A\83\F7\82\9F\C6\79\31\83\7A\6C\87\E1\BD\C3\A6\66\F7\67\F5\02\8F\B7\F9\41\42\A0\61\F5\14\03\21\FE\8C\4D\5C\5C\0F\3C\83\67\CA\83\FD\7A\34\03\C6\BF\EC\DC\40\2F
\B3\DE\43\DC\C3\82\01\EC\04\40\F5\09\AF\51\71\9D\F7\03\90\29\A4\12\FB\78\E4\11\C1\2F\C3\2E\37\69\03\6E\04\44\B1\23\3D\C0\0C\81\9C\20\2A\37\39\63\C2\46\B2\02\CB\D1\64\32\28\B6\A0\2E\C0\56\80\C0\33\B5\BF\F9\DA\5C\24\67\60\88\41\E1\A7\8B\72\6C
\7C\F8\6D\98\B2\81\B6\62\A7\82\2F\AF\71\45\B2\9B\D5\C3\B4\07\21\8F\62\55\40\9C\BF\39\69\E2\3B\70\70\CA\0F\64\ED\ED\DB\D7\A4\3D\F0\31\F9\01\79\96\78\B0\78\10\81\09\99\3D\80\76\3D\F8\01\AE\04\28\76\B1\EF\AC\73\5F\9C\B3\42\6F\F2\8D\C9\82\E3\D6
\81\23\E0\4B\19\5C\72\20\11\6E\8E\17\F1\EE\C8\5C\5C\97\23\20\1D\DB\66\98\50\02\58\D0\75\2D\33\16\26\AB\09\BD\9B\4A\26\2C\46\CA\28\39\B6\03\8D\76\B4\30\0B\C1\26\40\6B\68\5A\F2\79\B6\04\0B\67\EE\0E\43\19\D4\8B\80\7A\20\C1\94\18\C3\81\E3\A6\68
\69\06\3D\A1\73\39\54\01\F1\C2\20\65\54\3E\67\8C\18\C2\33\EB\64\DE\74\46\01\FB\F6\16\32\62\26\01\3A\BE\F0\5C\30\D0\50\A1\F7\80\42\96\9A\2D\B9\51\CB\01\BA\38\7E\04\D4\4C\53\02\C6\4D\E0\88\99\DA\B7\63\67\D0\CE\F0\54\03\68\27\F2\66\28\D1\0E\B3
\D0\5C\24\A8\2E\45\8C\AB\A7\56\0C\4C\C0\1F\B0\B7\9C\41\FD\03\49\BC\E3\02\C3\DF\8C\F1\86\05\B9\BC\72\1E\E2\A6\07\E3\EA\67\DB\5C\72\DC\D9\E3\30\A7\0B\B6\9C\82\07\EB\19\54\EB\CE\31\50\60\31\92\64\D4\E2\F4\D5\C4\5C\72\A6\34\E2\C1\DA\3D\36\04\40
\46\FC\C1\BC\C8\20\46\B1\CC\F1\9C\3D\BF\C9\82\36\CF\41\BE\11\8F\C2\3E\E5\17\4E\A5\41\1C\13\56\DF\09\E8\D9\DA\28\5C\24\CE\16\41\2F\A6\B7\17\D8\DA\F5\A6\0B\3B\07\A6\AD\E7\1B\DA\3F\BE\67\8C\66\5E\09\AC\5C\6E\E8\26\F0\4B\4F\1B\B3\C6\6E\84\7B\5D
\F5\D0\1B\06\8F\67\CB\9B\CE\38\E5\63\AC\D2\D1\9E\84\12\96\B2\CF\B7\DE\FD\B3\FF\82\5C\6E\15\81\C8\13\15\37\0E\4C\D0\17\8C\B6\82\74\3A\D2\D1\A0\B3\68\46\05\B0\56\4F\5C\72\B3\E8\4A\FA\1B\29\1B\62\83\28\5C\22\4F\42\CC\6D\B0\09\6F\D8\DF\5C\24\5D
\54\08\84\53\48\CE\5A\5E\BD\F5\4B\8C\FF\19\A9\E4\08\77\0C\F0\5C\5C\5B\41\39\28\27\D2\D9\84\63\DB\91\17\E2\AD\DC\E0\62\30\16\82\D8\D9\C4\20\4B\92\15\E0\A3\E5\E0\10\B2\73\72\42\99\78\5C\6E\E8\2A\10\42\10\61\C6\7A\36\6F\83\5C\72\02\79\26\74\18
\58\31\70\27\9B\8E\81\5E\83\1D\06\4D\B7\B9\3C\E2\43\67\B9\60\CC\34\C3\38\47\06\48\F5\93\7A\64\3F\10\67\58\9B\86\2E\40\2C\7F\18\03\8B\37\77\C3\EF\DB\9E\3A\1D\2B\83\54\69\55\7F\58\06\31\36\E0\93\4C\1F\B8\DC\73\92\3A\9E\5C\72\9A\4C\E8\36\87\8D
\03\1F\C1\B1\83\66\97\72\5C\72\60\1A\E3\74\E0\8F\1A\36\37\7E\67\B0\05\78\03\88\67\48\39\0C\E3\4A\C0\BF\4F\3D\2D\07\5C\24\17\F0\34\04\3F\10\72\D9\AA\34\BD\83\A8\A1\10\4F\9B\FB\E8\3A\8D\8E\13\7A\A6\A7\7B\C8\FE\44\60\F3\A8\12\04\81\8B\D0\32\31
\8D\46\8C\DC\B5\A3\D0\28\44\F2\4D\D3\CA\3B\A5\BA\04\BD\06\F1\06\13\26\96\1B\A1\8F\CD\CC\81\A9\11\D4\DA\AD\BE\83\55\08\3E\CE\49\98\36\8B\99\63\08\DD\C4\F2\9B\DF\B8\40\5C\72\2F\9C\2F\B8\B6\7F\18\D4\95\FD\F3\5F\07\16\48\C0\19\1B\83\5C\6E\37\7A
\10\9D\EB\0C\20\B6\FC\80\93\9C\89\37\F2\61\EE\A0\C9\BB\5B\39\44\A2\27\FC\1F\84\BF\EC\7D\42\FF\80\4F\9B\52\87\F4\0F\DD\9F\B8\42\23\73\93\06\BC\5D\7A\21\28\44\C0\93\1B\C5\40\4C\5E\84\FD\09\FB\B3\78\A3\DD\40\6F\E1\17\BF\75\84\4F\01\E4\EF\C1\A5
\44\B8\CF\DC\21\1C\8E\65\60\5C\6E\04\61\B3\6B\3E\B4\30\60\19\E1\1D\01\10\84\80\CC\2D\2A\99\A0\88\38\45\87\5A\36\02\3D\66\CC\E9\25\A1\99\DD\11\D7\63\E3\9B\B0\94\4B\3D\A3\02\F2\12\A4\1C\46\87\5C\72\CA\1C\85\C2\53\68\E8\79\4E\12\F2\5B\76\2A\01
\76\E1\5C\72\C1\E4\11\E4\40\8E\0F\23\DF\B8\1E\ED\89\81\AA\03\41\68\2A\E3\4C\5C\24\B0\C0\B1\41\C0\41\5C\5C\94\A2\12\82\FA\D3\25\C1\2A\09\C4\E7\70\8A\5C\72\2A\3D\3D\38\7F\08\0E\0B\EC\5C\24\57\EE\5C\72\83\20\5B\B1\93\4A\78\30\79\F1\DB\5A\C3\2B
\26\59\D9\48\41\7E\41\19\5C\6E\2C\03\5C\5C\28\D6\EC\70\A4\21\46\B6\8D\03\EA\DA\3C\36\53\18\D8\26\49\50\60\04\36\58\7A\FC\2B\ED\A3\64\11\66\DE\5C\72\BE\CF\4A\C2\A3\80\DE\CC\69\1C\EB\95\04\73\E3\2B\D2\26\14\18\35\BC\E5\90\2F\72\45\12\85\C0\A3
\4D\5E\5C\24\52\28\52\91\51\CC\D2\45\77\33\89\0F\0C\F4\0C\6C\48\2A\6D\10\02\5C\30\02\42\71\10\AC\1A\61\8C\AF\72\E8\EA\4C\01\42\93\15\8E\AA\A5\51\90\B9\7A\36\7E\6C\81\CB\F9\42\01\8E\89\5C\72\03\49\C2\AE\47\F8\E6\58\D9\B8\7F\58\56\62\73\A1\6D
\42\B7\48\AA\90\0C\D7\F3\99\F3\63\EE\5F\4B\E7\5C\24\1D\07\70\E6\2D\3A\38\84\95\0E\4E\6A\12\3A\C2\D1\85\8C\A1\2D\23\A2\46\E5\09\5C\30\92\61\69\42\C6\73\5C\5C\9D\29\CE\3C\2E\90\21\C6\DD\5C\5C\DF\1B\89\4E\8B\0B\D2\15\62\49\77\38\A7\04\CD\B9\0C
\74\85\F8\9D\50\15\6A\57\E4\A8\60\90\1B\B6\82\79\5C\30\EC\13\DD\26\04\30\98\1D\69\3F\A1\88\C3\0C\11\D2\94\3A\18\AB\49\61\1D\29\3D\92\9D\12\43\86\2C\18\61\26\BA\4D\98\61\70\C6\83\0C\5C\24\DD\49\80\49\46\18\63\E6\14\AD\E7\5C\30\21\84\83\04\03
\98\07\16\19\59\C4\78\61\29\7E\01\AF\43\31\86\50\D2\5A\0C\4C\33\54\B8\6A\11\DD\1E\43\5C\30\79\88\90\D2\18\13\A4\08\60\81\5C\5C\C6\57\C2\FC\08\5C\5C\05\74\5C\24\A4\32\B5\5C\6E\E6\2B\61\A4\5C\30\61\4B\62\E8\ED\CE\5C\6E\84\98\5D\E0\43\40\82\BA
\3F\49\07\5C\72\0E\17\D0\48\E3\83\AE\4B\12\73\25\CF\4E\A9\0C\F0\97\E1\CB\08\5E\B0\CF\D4\39\43\4C\2F\9A\9E\3D\25\DB\A8\F5\0F\68\C9\C6\3A\3F\26\50\FE\EC\45\59\D2\3E\35\A2\0B\8E\03\ED\12\6E\5B\0E\47\11\D9\92\D7\25\56\0E\E0\E1\BB\2A\F4\77\3C\A5
\F9\01\12\AD\D5\67\4A\B8\5D\BA\2A\E9\77\64\AE\5D\DE\42\9F\35\5E\0E\F3\D6\A2\92\4F\51\3E\25\AD\73\7B\BD\D4\85\0B\E7\95\AB\3B\EC\57\F6\B3\89\D6\7A\C2\47\69\AE\FD\C0\2A\BB\F9\52\6E\EC\D1\47\39\D0\45\B0\8A\A2\DE\1B\2C\28\75\2A\B0\B1\D5\92\C3\97
\80\8A\58\D5\73\AB\E0\52\8C\A6\A6\1C\04\3A\B5\35\EB\3B\94\E6\29\B0\52\B6\A6\CD\4E\FA\8A\C8\76\4B\07\14\D8\28\9C\52\B3\0E\DD\4D\A2\9C\C7\62\F0\EE\D4\E9\A9\5F\87\7B\0E\D5\46\3C\3C\05\33\AA\3A\15\25\BA\D9\48\56\EB\59\53\5C\6E\E1\25\4C\2B\7B\94
\6F\2E\3E\5A\28\B4\51\6B\A2\D6\C2\4E\AB\21\C3\EC\2C\89\3A\72\48\7D\6E\52\D2\15\4E\6B\49\09\09\AA\87\5B\F2\B4\CC\EB\92\D3\A7\67\CE\CE\D6\A4\3B\6D\59\D2\B3\81\67\12\99\25\F1\0B\39\56\7E\2D\4A\5F\12\B3\F1\67\B2\AD\95\A9\CB\5C\5C\96\C9\AE\A3\51
\5C\6E\AE\96\1C\19\21\F5\74\AB\5C\5C\55\59\2D\74\5A\6E\A8\A1\64\3A\42\B5\B0\CA\BD\14\DC\2A\ED\5D\27\10\29\74\93\B2\A5\77\C1\F9\96\C9\AB\0E\5B\42\1F\55\6D\2A\DA\72\34\86\D8\96\D5\2A\79\76\A2\B6\C1\76\5A\C0\D5\B9\2B\47\48\CE\07\E5\5A\6E\B0\1D
\50\C2\DC\85\7C\5C\6E\54\14\A5\20\25\23\5C\5C\B7\41\58\5C\30\7D\35\62\2B\77\9D\72\AB\58\77\DC\B2\31\75\F9\D7\25\43\67\3D\49\0F\AD\F2\76\60\1F\8D\63\72\9E\65\14\CB\30\16\60\2E\2E\3C\B7\11\18\EA\F0\04\68\89\2B\8C\48\CC\9D\5E\5C\5C\6A\AD\79\46
\F2\DD\25\1B\CA\5D\0E\B9\42\CA\5C\30\8E\1F\C9\72\81\19\C5\2B\80\1F\16\3E\A0\25\5A\78\B9\9A\20\12\E6\25\43\2E\AA\C3\EC\C4\60\56\6E\AD\31\4B\53\BE\A5\CE\6B\5C\72\83\F5\07\E7\58\7C\B4\F5\5B\CC\3B\F5\36\48\09\55\40\A9\44\3A\DE\BB\4D\6A\09\CE\95
\DB\CA\3F\1D\FD\AA\19\5D\DA\A4\D8\08\88\62\93\41\2B\D4\C5\47\A3\5C\30\0E\04\74\68\78\62\FE\C6\4C\60\94\C5\C0\36\34\4D\DE\9B\C4\F4\8A\59\23\BA\68\66\02\44\3D\65\80\D8\77\3D\B4\63\14\98\2B\48\1C\85\F1\A1\A1\3A\84\2E\01\7F\12\18\25\FC\8F\17\5E
\5C\24\01\F2\44\5A\72\41\7A\6A\FF\66\4C\6C\1A\9B\0E\37\92\6F\AC\8C\FD\B0\DB\5C\30\A8\90\2D\E4\DC\1A\B3\45\64\E4\DE\89\79\7A\27\56\20\AD\93\0F\D3\9E\AF\02\57\06\B4\09\5A\F6\16\13\A7\4B\98\2B\B0\64\28\41\05\CC\66\79\DE\50\3F\87\78\1E\52\9A\08
\5E\68\18\F5\85\B8\27\95\E6\E0\41\5C\30\88\9E\AF\3A\70\5C\72\84\64\28\56\07\B1\8C\1F\DC\1D\BD\9A\64\06\F6\74\09\53\EE\46\63\48\C8\9F\8F\B9\5D\72\A2\1A\72\1A\CA\43\48\59\09\58\5F\BA\2F\66\83\8C\DD\CD\BD\20\34\20\37\65\12\DA\36\44\B3\7B\2C\D1
\E8\FE\EA\1D\D8\3C\0E\3C\5A\5E\B4\DD\6A\5C\22\09\E9\B5\5C\6E\2B\C6\80\4D\85\59\39\85\92\41\82\28\3C\50\6C\16\A4\6C\70\09\93\2C\3E\D0\80\A4\7B\45\39\DC\26\E0\47\68\1C\9A\68\14\7B\28\10\FD\B1\11\90\41\06\67\67\38\A0\28\40\DE\6A\54\FB\6E\03\CB
\67\80\5A\E3\86\D9\C5\B0\C1\4A\88\C1\8A\08\B3\78\A6\98\8C\FC\1B\BC\40\69\63\B6\E0\D5\8B\F4\28\70\83\27\6F\4A\30\07\4D\6E\C4\80\ED\26\CA\1C\A7\B3\5C\72\27\5C\30\D5\91\F8\84\5C\72\07\71\14\D1\46\07\1B\E8\34\18\BD\B0\15\8A\1A\29\FD\BD\63\4C\98
\03\A7\FE\5F\C0\0E\6F\4A\DA\7D\35\EF\DA\63\96\6F\A8\E0\E0\7C\36\84\6D\BE\7D\51\AA\A3\E1\34\51\EB\C7\62\84\11\B7\81\10\04\B5\7F\5B\FA\78\AB\6D\28\20\DD\26\B5\40\E4\3B\C2\2B\01\F2\98\A5\AE\0E\DA\0E\C5\66\7C\49\05\CE\1A\E0\10\F5\01\0C\94\52\D0
\34\38\85\20\7B\09\11\60\F8\E8\AE\E7\6B\60\75\0E\BB\72\60\7F\8D\E8\1C\57\E3\B8\B1\60\5C\22\B4\8E\29\66\49\5C\6E\A9\D4\3B\F2\38\5A\6A\12\CD\1E\87\96\03\06\67\F0\7E\A1\9A\41\CE\88\E8\21\6A\BC\C4\25\C4\E6\54\A0\C2\45\18\5C\5C\10\AF\5C\72\33\45
\93\6A\82\6A\EA\15\A2\46\58\5A\09\1B\E2\CF\41\79\13\E6\6B\48\A0\08\05\D8\58\64\F0\8D\67\43\51\04\93\16\96\1A\B1\B4\E1\CE\80\19\1C\FE\30\F0\64\94\0C\FC\B2\A8\12\B0\05\EF\FB\A1\10\86\FA\74\A8\09\9C\C7\7A\6B\C0\0E\60\0C\40\1C\5C\30\30\30\31\5C
\30\6E\04\94\8C\F8\E7\48\B8\C0\0E\5C\30\1A\80\34\5C\30\67\17\26\2E\18\03\80\07\5C\30\0C\C0\1B\90\FA\5C\30\4F\17\28\B3\C8\03\50\06\40\5C\72\A2\E8\45\C4\5C\30\6C\5C\30\E0\01\B0\03\58\BB\A0\5C\72\E2\E6\45\E4\8B\C7\17\38\01\C0\03\78\BB\A5\9B\40
\19\C5\D4\8B\D6\5C\30\C0\01\A4\5E\98\BB\B1\7A\40\1C\45\F0\8B\E6\5C\30\DE\2E\A4\5E\A8\B8\51\71\5C\22\E9\C5\E0\8B\E6\59\E4\C2\44\5F\70\07\26\11\E2\FF\80\33\5C\30\6D\17\5A\2E\50\03\70\06\E0\5C\72\80\18\45\CF\8B\F7\17\14\01\90\03\73\88\F1\76\5C
\22\E9\C5\E1\8B\E7\17\1A\30\B4\60\F8\BF\11\77\E2\F1\C6\0C\2C\F3\17\FC\01\BC\5F\18\BC\60\5C\72\63\06\C5\E2\8C\1F\17\F6\2F\D4\5D\78\B8\71\82\80\1C\80\33\5C\30\71\17\CE\2E\70\03\98\C2\71\8A\E2\F0\5C\30\30\30\32\8C\5F\17\EC\B3\69\84\88\C4\D1\8A
\A2\E2\45\C6\5C\30\61\18\DE\31\E4\62\18\C0\D1\77\01\4A\20\10\5C\30\6C\5C\30\CE\31\2C\60\88\BA\31\79\5C\30\18\80\39\23\3F\19\1A\30\54\5E\D8\C7\71\91\A3\5C\24\46\36\8C\9D\18\9E\2F\5C\24\64\A8\B8\91\82\80\1A\46\44\8C\79\17\4A\30\1C\62\98\BB\5C
\30\0C\09\AA\C6\57\8C\BE\5C\30\E6\2E\9C\63\B8\C2\91\7B\63\20\45\D8\5C\30\73\18\86\33\6C\5D\10\06\40\5C\72\62\F9\46\0F\8C\5C\22\5C\30\C2\32\F4\60\98\C1\91\92\5C\22\F1\80\37\8B\B5\18\CE\2F\E0\03\5C\30\06\B1\9A\A2\E8\C5\D3\61\09\18\5E\30\34\65
\A8\BA\51\7B\63\3C\C5\D1\8C\C9\17\6A\2F\1C\5F\98\C1\D1\90\63\17\5C\30\30\30\31\8C\B5\18\2A\32\38\03\42\41\E0\18\E3\1B\5C\30\30\30\30\8C\17\19\78\C6\94\69\D8\BE\31\98\A3\1A\46\07\8D\35\18\9E\30\6C\6A\48\B8\91\99\5C\22\E9\46\02\8C\33\19\06\30
\5C\5C\5F\88\BE\71\99\5C\30\1C\C6\66\8C\A1\17\54\B3\6C\5F\30\06\D1\82\A3\42\45\C4\8C\23\17\1A\33\EC\5D\F8\D2\F1\73\80\19\C6\BD\8B\D3\18\86\36\34\5F\58\C0\31\96\5C\30\1C\C6\BD\8B\F1\17\E0\99\64\60\F8\D7\60\5C\72\A3\53\C6\5F\02\4A\4D\56\2F\1C
\66\80\06\B1\AD\80\31\5C\30\30\30\35\02\49\18\1E\36\74\66\80\07\11\B0\E3\34\46\AA\8B\C1\18\B6\33\34\66\E0\06\91\A0\E3\01\46\2D\8B\DF\18\92\36\8C\64\10\06\91\B1\5C\22\F7\80\34\8D\6B\17\BD\84\5C\24\68\A8\C2\B1\A0\23\45\C5\CC\8C\FA\5C\30\D6\36
\A4\5F\30\07\31\97\63\40\46\0B\8B\E1\1A\AA\2F\64\5D\58\D7\51\A3\23\01\47\5C\6E\8B\F7\18\86\35\AC\67\18\B9\71\91\E3\45\46\5C\6E\8C\6D\18\5C\5C\C2\44\6E\98\C5\71\BD\A3\59\46\76\8D\31\18\16\2F\34\60\F8\E0\71\BD\E3\13\80\34\8D\3D\1B\E2\38\04\62
\08\D7\71\7C\C0\19\5C\30\30\30\34\8B\89\18\8E\33\C4\6D\58\C1\31\8B\A3\65\91\F6\5C\30\C5\1A\EE\2E\AC\5C\5C\E8\E0\51\97\63\49\C6\09\8D\B7\18\2E\37\FC\5C\5C\78\D6\60\0C\5C\22\ED\C6\02\5C\30\69\1A\5E\33\F0\03\28\E7\B1\92\C0\19\C6\5C\22\8E\45\19
\76\34\6C\5F\C8\C8\71\AE\8C\5C\24\46\F1\8B\B1\17\E0\01\9C\6F\C8\BE\A0\5C\72\23\55\45\E4\8D\A9\1A\5E\39\FC\74\88\C1\91\B9\A2\EF\C6\2E\8E\04\5C\30\DE\33\7C\72\C8\C4\31\BF\5C\30\18\C6\F6\8D\F9\1B\36\39\6C\5E\78\B9\D1\BC\50\08\46\2D\8E\5D\1D\5C
\6E\30\D4\76\88\E2\51\79\5C\22\ED\47\12\8B\B3\18\12\32\2C\73\78\C1\51\71\23\99\46\2B\8C\18\5C\30\D9\2F\44\69\C8\EB\71\7D\A3\C0\C7\38\8E\5B\1C\16\36\2C\6A\F8\BB\5C\30\0C\63\6D\C7\6F\8D\D7\1A\4E\35\BC\65\68\E0\51\76\A3\AB\47\4C\8D\80\48\02\3C
\54\5F\08\D0\51\AE\A3\3F\46\C9\8B\C9\1D\2E\2E\5C\24\66\F8\DB\D1\79\E3\9A\45\F7\8C\43\1E\16\32\DC\6C\A8\DB\31\73\23\D8\45\E9\8C\07\1D\44\B3\6C\6F\68\D9\D1\B2\A3\6A\A0\10\8B\B2\C2\12\38\D4\65\B8\C5\B1\D4\62\F0\46\21\8D\F5\1C\C6\39\DC\60\78\D3
\71\A8\A3\A7\08\96\8F\43\1A\C6\37\C4\68\78\D5\11\D9\A3\13\C6\C5\8E\BB\19\FA\37\9C\5E\78\CD\F1\F0\4B\3C\C7\68\8F\83\19\F8\09\2C\75\D8\E9\B1\91\E3\01\47\29\8F\03\1D\DA\3B\6C\75\18\E0\C0\0C\23\EE\45\DF\8E\B9\1B\FE\3C\FC\6B\08\DB\D1\ED\62\FE\C6
\DC\5C\30\73\1B\52\2E\AC\77\B8\D6\B1\9E\23\7A\C6\7E\8E\77\18\92\32\7C\78\28\DA\11\F7\E2\F0\5C\30\30\30\31\8D\27\1A\86\3A\DC\76\89\5C\30\30\30\31\91\E3\A2\47\E6\8C\BF\17\A6\3F\7C\60\F8\F2\91\7F\A3\87\C6\F3\8E\DB\20\2E\32\A8\03\58\DC\C0\0E\23
\93\47\A8\90\38\4B\C6\40\3C\7A\18\BE\31\96\A3\1C\C6\B9\8E\1F\1E\5C\22\39\7C\6A\88\D2\D1\D0\E3\09\47\A4\8E\2F\1D\E6\36\DC\71\88\DE\D1\F6\80\1B\47\C1\8F\73\17\D6\37\F9\2F\19\5C\30\30\30\31\8B\62\FC\C7\DF\8D\ED\1A\B6\3A\7C\83\38\DA\51\DA\23\7E
\46\BB\8F\57\1E\82\34\E9\67\98\CC\D2\02\23\3C\46\5C\72\8F\B5\20\9A\32\FC\83\58\C1\51\CC\23\FF\46\76\90\6B\1D\EE\37\B4\7F\78\D2\31\DA\23\CE\C5\C6\8E\9B\1D\A6\40\AC\72\68\DC\D1\C0\E3\EA\46\94\8D\ED\17\5A\3B\AC\66\C8\E5\72\10\63\BF\16\79\8B\91
\21\5C\72\09\E4\5F\78\EB\31\BF\5C\22\FC\48\31\8F\CF\17\B6\30\54\77\E8\D9\B2\1C\63\5C\72\46\03\8F\31\20\5C\6E\38\64\81\58\BB\72\12\E3\D0\C6\D4\8C\A7\1C\DE\32\44\62\E8\FD\B1\7B\64\34\48\88\8C\1B\18\72\41\3C\7E\C8\D9\31\B1\64\42\48\49\90\5B\1B
\4A\3F\BC\81\B8\C5\D2\1E\A3\71\C7\7E\90\6B\17\BA\30\D4\74\D8\D8\D2\03\23\84\46\5C\72\90\23\19\9E\30\5C\5C\68\A8\EE\12\5C\72\A4\47\C8\7F\8E\ED\19\92\45\74\74\D8\E8\91\ED\63\37\C8\55\8C\BF\21\D6\3D\44\5F\88\E8\F2\08\63\4E\C7\5C\30\91\79\17\D6
\36\14\61\D9\11\F1\EB\A4\20\46\67\8D\E7\21\76\31\CC\71\D8\C8\31\D8\E3\4B\C7\87\90\BB\17\E2\40\E4\65\E8\F7\D1\B3\63\03\47\6F\90\F3\1C\5C\6E\2F\AC\8C\F8\C6\B2\18\E3\88\45\E3\8B\C1\5C\22\9E\33\74\60\A9\19\F1\F6\23\63\48\13\8E\B5\1F\82\3C\DC\63
\F8\D3\71\81\E2\FC\46\EE\90\25\18\86\3F\54\62\E8\B9\B1\B0\64\29\C7\0F\8B\A9\20\72\30\14\82\F8\CC\F1\71\63\BF\45\F8\8E\E3\18\3E\33\5C\24\74\79\0E\51\D2\A3\85\C9\04\8E\45\17\92\43\6C\60\39\19\12\29\A4\56\46\48\8F\4D\1F\4A\37\94\66\F8\F6\11\C4
\5C\24\48\48\51\8F\81\20\06\3B\FC\72\69\18\92\37\23\06\46\B3\8D\2D\1B\1A\46\A4\7F\48\C6\51\F7\23\5C\30\47\05\8D\B7\21\82\31\E4\5E\C8\FE\26\34\A4\76\47\26\91\FB\1B\16\37\D4\67\E8\E0\B1\83\5C\24\5C\30\47\0F\8E\5C\72\1F\72\2F\C4\64\D9\18\52\10
\A4\28\C6\E3\91\73\1D\36\40\A4\93\D9\27\52\41\E3\81\C7\AC\8D\9B\1D\C8\01\94\8C\F9\26\91\A2\A4\96\C7\67\5C\30\6B\20\7A\3D\B4\7C\48\D9\B1\C9\E3\87\C5\E0\8C\C9\18\5E\4A\B4\5D\08\C0\D1\73\64\A4\C7\2C\8D\07\5C\24\92\31\94\8D\A8\E0\12\3C\63\71\C7
\A6\92\9F\1A\EA\4A\9C\5F\F8\CF\11\C1\62\E7\47\88\8E\51\1D\76\4A\B4\90\B8\D8\B1\DE\E3\12\48\35\8C\0B\19\A2\46\F4\70\08\DC\C0\49\63\AC\C8\5B\8B\8B\1E\CE\40\D4\72\C8\CF\12\07\A4\76\48\E5\25\E3\1F\B6\33\44\94\A8\C7\F2\1B\63\3C\49\5C\24\8E\4D\1C
\16\2E\64\97\D9\08\72\31\63\3D\46\9E\8E\F7\18\2E\34\84\63\88\D5\32\17\62\E9\47\2E\8C\81\21\A6\4C\7C\7B\58\D7\D1\B3\A3\7B\49\1D\8F\AB\17\4E\46\F4\64\78\F7\71\73\63\DE\C6\DD\8D\BF\23\FE\45\BC\61\29\13\91\D1\23\B9\47\94\8D\83\1E\8E\4A\AC\6D\B9
\2E\91\FB\5C\24\3D\47\68\92\41\17\4E\3D\AC\73\89\03\D1\C5\A4\02\45\CD\91\47\1A\FE\47\5C\5C\61\19\31\F2\30\A4\DB\48\A1\91\C1\17\46\2E\74\67\38\EA\91\C3\A4\5B\C8\F2\8F\FF\18\A6\49\64\6E\B8\FE\F2\38\E3\06\46\80\8B\D9\1C\D6\2E\54\92\A8\FB\F1\B7
\80\19\46\33\91\45\1C\BA\36\1C\72\69\1C\71\B8\E3\73\46\BC\8E\0B\1A\D6\36\C4\78\18\BA\72\1E\E3\DA\C6\4C\90\3D\17\6E\46\54\9E\19\14\D2\6F\64\A0\C7\3E\8D\2D\1F\AA\33\F4\7C\A9\12\32\14\5C\24\FD\30\84\91\3D\19\20\E2\3A\01\06\10\91\78\63\92\48\CB
\02\49\5C\22\4E\50\5C\24\62\B8\DB\51\F1\5C\24\0E\46\11\8D\F1\20\AE\44\C4\82\98\E6\D1\EF\E4\7D\46\EA\8C\07\25\AA\3F\E4\9F\28\EE\12\0E\A3\EA\C9\47\94\33\5C\24\82\4F\5C\24\5E\78\C2\32\54\A2\E9\C6\F1\19\D5\1B\8E\30\8C\A1\F0\52\92\8B\CC\23\C8\44
\8C\3A\84\F2\45\A4\7C\69\2F\32\8C\A3\58\47\88\92\94\04\92\38\AC\95\B9\2D\11\F9\5C\24\48\C9\76\8D\A5\18\D6\3D\64\9A\89\20\11\E8\A4\1C\C7\60\92\F9\1E\92\3A\6C\61\78\E4\D1\FA\A2\F0\49\A6\90\1F\1D\A2\3A\EC\97\58\E2\52\4A\A4\D2\12\F1\94\01\19\D2
\52\CC\6D\78\EA\92\4A\23\5C\6E\47\47\93\39\21\12\4E\1C\90\A8\E4\12\7B\63\17\49\F5\92\D3\26\E6\49\AC\A0\E9\1D\52\3D\A3\80\49\5C\72\8C\F9\26\6A\3A\E4\91\38\C3\D2\67\23\B8\48\1B\8B\E1\27\0E\33\84\5F\78\B8\B2\62\A4\81\48\7D\94\A3\1C\3E\37\14\83
\E8\E8\F1\8A\63\CC\C7\D9\8F\1B\5C\22\26\4B\3C\78\D8\CA\32\A1\E3\E7\48\86\8B\A5\5C\22\36\40\64\62\E8\EB\B1\AD\65\3B\C9\29\8C\1B\21\96\2E\C4\5D\F9\2F\F2\91\64\97\CA\02\8E\6D\2A\66\36\2C\76\A9\14\11\97\C9\AA\CA\1D\8B\A3\1E\AA\4C\E4\81\C9\28\71
\B5\A3\41\49\38\94\17\1D\0E\37\64\84\39\54\11\74\63\F4\CA\14\92\03\18\82\55\4C\95\58\C8\F2\1D\25\1B\48\A1\94\49\2A\7A\3A\CC\7C\49\58\71\73\E1\A8\02\F3\10\2D\16\C2\16\42\D0\C5\12\E4\71\14\5E\28\95\52\BC\BB\61\71\28\7E\65\10\0B\05\D1\F1\AF\A7
\0F\A0\01\39\4A\E8\18\55\87\2B\2D\65\71\2A\6E\54\E0\AD\D0\3E\A1\5C\24\D5\D1\AB\18\65\72\92\07\95\CE\B1\A1\70\5C\6E\C5\D5\BC\CB\5C\24\65\73\2B\EE\56\02\A3\9D\49\9A\BA\C7\62\AB\F8\65\71\3A\DF\23\5D\0E\95\63\63\AE\37\72\5C\6E\D9\1D\66\2C\67\59
\F8\B3\54\01\43\B2\25\8C\F1\09\D4\7D\CB\5C\30\96\16\B2\A9\5C\5C\2A\EC\45\57\50\E6\61\E8\3A\CFE\A5\2C\26\57\F2\C6\70\29\12\C5\1D\A6\CB\16\78\6C\B2\4D\E1\C2\C4\10\33\5C\30\74\5C\30\A6\2F\49\69\70\F1\44\02\11\27\5C\30\09\6B\5C\24\54\A4\AC\46\87\18\A4\5D\66\BA\CD\64\4D\F2\C8\80\1D\4B\5C\24\1D\94\BC\FD\48\28\7F\02\40\EE\C9\94\8B\BB\28\96
\7A\B5\6E\57\D2\A4\D9\5F\8A\4D\DD\94\2A\BA\5C\30\A6\01\65\D9\6C\46\99\5E\48\09\57\1F\2A\42\96\90\1F\96\5A\50\15\65\BD\12\C5\D6\98\87\D3\52\2F\0E\9D\64\52\C2\97\52\CA\85\5C\30\1D\4B\1C\75\A3\2C\79\48\29\B6\5C\22\53\CA\58\49\27\AE\B9\5A\83\03
\3D\E7\0C\4C\F8\52\E5\33\8E\E5\C4\D2\5C\6E\C0\27\9A\5B\6B\03\F0\AD\CD\36\40\14\3B\7D\52\94\ED\FD\49\B2\F2\B3\F4\0C\AC\5F\E9\29\A0\77\02\EA\82\5B\F3\C0\20\FB\5C\6E\DF\04\B4\9D\6E\96\10\AA\BC\8C\CA\93\62\42\72\B8\16\6C\2C\5C\24\76\D6\ED\CD\DD
\D4\B0\87\88\C0\D5\14\48\A9\E0\87\85\0E\16\5C\5C\A2\8B\D9\73\2A\C8\1D\A0\BA\E5\96\0B\2E\51\74\92\42\85\BA\64\88\62\1A\91\BD\97\40\EF\18\3F\33\BC\53\9D\60\61\40\A4\4B\AA\5C\5C\2E\AB\B4\8D\E0\7E\C7\66\AA\8D\9E\29\AC\AB\06\A8\EF\2C\3F\7C\26\D3
\B6\11\4B\C0\A3\01\85\5A\39\2E\DD\58\B3\2B\53\91\E2\7C\C0\9C\9D\D8\5C\30\50\CA\BC\1A\A2\8C\45\93\F2\E7\65\82\2F\CA\5C\30\56\EB\D6\5E\4B\C4\5C\30\05\5C\6E\2D\09\3A\CB\C9\53\D8\B2\29\D7\AA\FB\30\6A\91\08\16\39\03\54\04\58\95\E5\9E\42\F0\83\BD
\4B\5C\22\E5\C5\AF\B1\95\C2\B2\2C\02\32\C6\27\87\32\CB\E5\D6\01\98\50\04\2C\A1\78\8A\F4\E0\70\C0\0F\D0\E1\4B\EA\97\AA\B4\0C\02\9A\9B\F5\5C\22\CA\44\A2\23\03\54\56\1A\B2\9C\01\44\BF\F5\31\F1\17\41\6F\3B\D8\95\D7\2F\39\54\48\04\25\56\60\12\57
\4A\3C\39\98\04\AF\61\65\CA\B0\A0\08\4B\2F\56\5E\2F\A8\51\86\A4\D8\5C\6E\42\F1\04\5A\5C\22\39\0C\ED\CB\C6\58\D2\AF\4D\7E\5C\24\B0\35\84\8A\DF\DA\5C\24\30\03\64\E8\BD\0C\49\80\18\55\93\CD\12\1E\B3\32\BC\5E\58\5C\6E\BC\0C\2A\E3\45\37\49\5C\6E
\56\33\AB\19\96\85\2B\CE\61\8C\C3\49\69\D2\D2\4E\CB\4B\4B\98\67\30\92\61\8C\B0\84\7A\2A\93\56\90\A9\BA\23\62\4A\79\4D\D2\A6\65\F5\E2\5A\96\20\01\85\56\A0\A2\9D\60\92\D0\05\14\F2\D0\55\31\CB\43\98\9F\2E\5C\72\46\B2\AA\11\2D\6A\CE\26\1B\4C\55
\98\70\A7\39\73\82\E9\B9\8A\2B\51\26\31\A8\E2\52\6D\0E\A5\D5\D3\B1\67\5A\AA\B2\96\09\2C\2E\58\72\0B\79\5A\EC\B2\B0\30\A8\CF\DC\33\AC\32\98\41\31\A9\D6\82\92\65\89\4E\FB\15\02\A9\B8\98\FA\B2\28\3F\41\1B\13\6C\20\15\DE\1C\CC\1A\2C\4E\E8\75\65
\B2\CF\5C\24\7C\72\F9\E1\5F\25\1F\02\B2\F1\45\03\30\35\45\7D\B3\5C\24\A1\DC\01\85\58\32\AB\25\DA\5A\AA\65\20\80\5C\6E\5C\22\3B\3C\39\61\BE\68\12\0B\19\E3\B6\A5\E0\61\5D\FA\CA\EC\99\38\B1\81\E0\2A\E9\75\AF\0B\E5\C1\AA\4C\A5\0F\A6\B6\B1\64\52
\BF\F0\30\AB\B8\C1\AA\2B\DE\51\6D\2E\FC\0C\2C\47\F9\96\AB\02\A6\4D\AE\EF\5F\B1\32\E5\65\90\15\64\42\EA\CD\DD\B8\2C\B0\53\85\32\C1\10\B2\3E\55\D5\EA\EB\D4\B0\BB\34\76\6C\EB\7E\65\32\A9\F2\32\A4\65\C4\B5\CB\05\59\67\32\6E\66\92\3D\C0\FE\5C\24
\81\25\F3\CC\D9\96\9E\46\66\61\EC\B5\29\8B\EA\A7\E5\94\CC\66\54\C6\B6\E1\47\A4\CD\D7\67\32\BA\57\11\2C\5B\99\9A\ED\CA\58\12\3E\29\74\CA\41\5D\9C\BA\99\52\2A\BA\26\1D\5A\B7\C5\36\6A\32\0E\7C\91\A5\5C\30\A0\B0\28\02\1B\A9\70\09\EA\39\D7\20\CC
\F9\75\D2\AA\F4\3F\F4\D0\60\05\6E\E5\15\9C\2D\6C\5A\6E\EB\15\21\48\04\39\9D\B2\E7\E6\7A\4C\F0\9A\18\A2\39\56\4C\CF\B9\79\D2\D0\DD\A2\12\1F\5A\D8\1F\4A\68\52\9B\89\67\93\45\66\4C\A9\13\55\8A\B2\7E\60\34\CD\59\88\10\E7\E6\78\29\14\5C\24\42\B1
\51\52\23\C3\95\53\EA\7F\94\A5\CB\CB\0F\F5\2C\36\69\23\C0\59\A6\93\2C\15\3B\43\B1\9A\72\AC\E2\69\D9\26\C7\58\AA\FB\5D\E8\CD\5C\6E\77\35\34\AD\4B\12\89\78\8F\5C\6E\2A\26\9E\A9\54\9A\14\A3\EE\57\FC\D3\F9\8A\93\0F\A6\A9\2B\18\53\D0\BB\71\4E\63
\B7\79\9D\F3\49\57\E4\AF\DB\5C\30\57\35\1E\63\D4\D2\C9\AB\8B\F0\26\04\2B\8F\9A\B6\F0\15\56\72\E5\29\AC\EA\CE\14\A3\4B\67\9A\AA\BE\D4\3F\89\20\B5\8A\93\16\A5\7C\AB\67\52\A6\AF\86\68\52\B4\25\4B\EB\B9\15\9C\29\5A\23\8B\35\E4\8E\2C\D6\B5\96\6B
\85\E6\BC\BB\60\9A\14\EC\1E\6C\3A\E0\95\4C\73\43\94\5B\4D\89\55\42\A9\36\6C\64\D1\05\D1\93\4A\A6\B0\AA\9F\95\EF\31\6E\6C\3A\BA\F9\95\6A\8D\A6\CB\4C\DF\96\A2\5C\30\AE\68\E3\B6\20\0B\2A\29\A5\70\2F\AE\9A\DE\A7\35\5C\5C\94\3C\39\B4\F3\56\A6\85
\2F\8B\9A\DE\AB\AE\68\54\C7\15\64\6A\B5\E5\72\4D\62\78\5C\6E\88\5D\52\12\B9\E7\57\AA\52\89\20\4D\61\55\B5\33\3D\D7\04\B5\60\30\B3\6F\C8\CB\2C\5A\99\AC\B3\16\6C\0B\C0\C5\7D\C8\F3\A6\6D\A8\EC\9B\94\ED\B2\6C\F4\CE\19\B4\13\17\D5\6D\4C\E5\53\36
\EA\5C\5C\92\74\CE\99\B9\F2\BA\17\E8\4C\07\97\14\EE\C9\5C\5C\1C\CF\25\91\4A\B6\94\83\4B\E5\99\F1\37\0E\6F\04\D1\A9\9F\A4\65\66\80\4D\02\9A\08\A3\92\6F\43\BB\59\A1\93\76\E6\85\AD\4E\56\C3\34\3D\52\14\D1\19\A2\73\4A\DD\C9\CD\F6\02\AC\B6\2A\68
\D4\D5\E9\68\6E\E4\E6\8F\2D\6D\9B\E9\34\89\DF\34\E0\79\A4\F3\01\48\F1\4D\FB\9B\7C\EE\CA\69\73\AC\55\3D\13\83\DD\DA\CD\41\5C\24\DA\AD\F2\69\B9\CF\99\BE\93\85\9D\F6\CD\3E\96\EA\EE\CA\70\E2\BC\70\FB\F3\51\66\F8\AB\EE\9A\C0\A7\AA\71\2C\D4\D5\35
\73\8A\55\4C\1C\F9\9A\A3\38\7D\DD\AC\C5\D9\AA\93\8C\15\F7\23\C3\58\48\B1\D9\DD\EC\DF\49\AB\AB\EE\A7\13\BC\39\55\B5\38\ED\63\3A\B3\49\BB\EE\ED\66\B4\AA\D0\0F\B1\37\D2\6B\6C\E4\35\7D\D0\F7\66\B9\4C\59\95\F0\AC\E1\4E\32\DE\B0\08\F3\7D\26\BD\09
\69\9A\EA\AE\F1\63\2C\E5\49\B9\33\8B\17\DA\C4\52\9C\A9\36\1A\72\E4\D8\89\CC\33\62\A6\FB\CD\8D\9C\C7\36\3E\6C\58\05\59\BF\01\FB\66\FD\4C\07\9C\29\2B\D9\53\2C\D9\89\CC\2A\F9\65\6C\CD\F4\99\55\10\5C\22\65\64\E6\19\BA\5C\22\5A\E7\19\AA\DA\96\8F
\36\92\5A\44\DF\45\39\B0\E1\25\C8\CE\82\9B\59\39\72\6D\74\E3\45\1C\D0\F3\27\2E\4D\B2\5B\34\AC\82\5E\84\E5\C9\B7\0E\EB\17\3B\4D\BB\77\D9\35\85\D7\14\CD\39\B8\D2\F3\9D\61\AC\A6\76\2B\37\30\02\6C\CD\C9\D3\D3\64\25\A3\CC\3C\9C\F9\33\8A\5F\3C\E9
\95\6C\4E\B2\A6\8A\28\80\76\2B\37\59\52\6C\CE\85\16\D3\AA\5D\87\2E\0C\95\D5\34\A9\49\B3\AE\29\BC\B3\3D\D6\83\4E\AE\54\9A\1F\5D\DB\B9\27\55\5E\D3\3F\E7\53\AB\BC\0F\BD\37\BE\58\43\AE\C5\A9\D3\A8\D5\31\CD\17\75\B9\39\A9\45\B4\DF\99\B2\6B\16\E7
\4C\3B\0E\9D\9C\A4\4E\68\CC\EC\19\C0\53\17\DD\71\4E\08\58\6B\3B\31\5B\84\D2\F5\1A\D3\4C\67\70\01\56\9C\42\EE\31\5F\A4\E1\A5\15\CE\C5\67\73\AC\A0\9A\9D\3B\AD\52\6C\EE\D5\45\13\88\D7\DF\4E\F0\54\C7\38\F6\77\2C\EE\E9\C5\73\AF\95\31\CD\50\78\72
\EB\8A\71\94\EA\89\DF\33\8D\A6\AC\28\AA\9D\0F\3B\F1\5A\DA\FD\09\79\D3\BE\27\7B\4F\09\5F\B4\BE\EA\72\14\EF\99\C8\AA\4D\67\7C\CE\49\9D\F3\39\32\65\4C\E7\19\CA\F3\94\66\BC\4F\5C\72\59\8A\8F\6E\6B\DC\E5\75\16\8A\99\94\53\4E\C9\76\1D\39\56\6B\E2
\93\09\CB\33\C7\A7\2E\CC\9B\76\07\39\7A\79\64\E6\29\E1\13\93\A6\C8\4E\D0\59\14\EC\26\73\5C\24\EC\F9\CD\6A\64\27\36\CD\94\9C\51\3C\CD\56\DC\E7\29\E8\13\65\E7\2B\CF\01\9B\A7\3A\D1\D8\AC\EA\59\6A\13\74\A5\A1\C3\70\87\75\3C\B1\DD\CA\96\C9\DF\33
\A2\5D\71\4D\B0\9E\59\3A\39\58\E3\B5\05\53\B3\BE\67\49\AB\C3\9D\2A\BF\12\6D\E4\C6\C4\43\EB\F9\03\FD\9E\76\0F\A0\47\11\DF\EC\DC\52\40\C0\12\D6\AF\AC\6A\54\97\3D\A8\90\3A\8F\65\A0\13\DB\C0\28\5C\30\5F\56\6E\A9\2C\3F\70\04\90\09\33\DE\27\17\CE
\A0\99\B8\A8\91\D8\02\8D\99\EF\12\D2\15\5C\72\AC\86\95\BC\1F\F6\7C\5C\22\DE\69\F0\12\BA\67\54\92\6E\9D\FE\01\50\E7\9A\A4\B0\5C\6E\D3\94\E5\71\2C\DB\53\66\B8\2E\59\D0\04\B5\51\20\13\41\8F\BC\41\87\1B\2C\0E\5A\CA\DA\65\13\53\E5\14\9B\98\73\45
\C0\8D\EC\5C\72\FA\91\76\16\0B\84\54\8B\AC\51\9F\5A\A9\5C\22\70\F3\B2\49\F3\73\EB\55\41\CF\9B\5C\30\BE\EB\76\5A\B8\7D\15\AE\72\D9\14\A5\4B\05\9F\16\74\12\66\E9\1C\50\0B\E4\66\16\39\11\E7\96\AE\B8\12\7B\BC\B6\15\5E\4A\80\E7\DF\CF\82\9F\94\BF
\18\02\9A\F8\A9\95\5C\6E\30\25\AB\80\4E\47\DA\AB\2A\7E\6C\FC\12\44\2E\BB\A6\CE\4B\65\9F\B9\36\A2\5B\2C\D4\25\90\C0\13\88\F0\4F\D5\98\C9\2D\86\7E\EC\B5\95\96\F3\FA\A5\6A\AE\9F\52\4F\3B\04\02\FA\8C\40\09\CB\A8\65\6E\9B\62\5F\0E\BE\25\73\4B\BF
\C5\9C\13\EB\14\82\C3\EF\59\FF\0F\E6\7F\BA\CE\59\D1\30\FC\A5\C3\4C\CB\57\AA\A6\81\6A\72\DF\D5\90\F3\03\03\E8\CF\86\A0\10\EB\A9\21\42\9A\D9\F1\94\03\E6\84\50\11\76\B4\A3\66\77\DA\AB\C9\F8\80\11\E7\E3\4D\C3\52\32\B4\32\80\7A\8C\02\34\72\FA\68
\0F\3B\D2\23\4D\40\85\7D\85\5C\30\89\7C\EB\E3\A8\07\4D\C3\5C\30\85\3D\DA\81\3D\02\E5\A1\12\E0\66\8D\2D\21\9F\10\01\36\70\19\1B\CA\06\A0\16\67\5B\50\34\9D\82\B4\86\81\CC\EC\05\19\14\10\16\F3\43\DA\5B\35\3A\96\82\5C\72\03\B5\43\74\11\A8\1E\CD
\C3\A0\75\40\FD\DB\BA\3C\E9\9F\E4\69\66\84\D0\4E\75\BC\8F\6E\5B\F1\21\75\38\6A\7B\26\39\4B\75\A0\46\1F\51\6C\52\93\69\C0\14\14\28\1B\CB\43\A0\C7\41\0E\81\E4\AE\99\73\34\10\88\EB\5C\30\59\A0\CD\3B\66\83\42\3C\D4\7B\94\14\E5\98\BC\52\5F\10\49
\9A\7E\1A\9A\85\36\F4\1D\D7\7C\4D\57\54\17\41\ED\5D\34\F7\65\40\4A\AD\65\C9\50\7C\5B\FA\A8\96\72\35\06\2A\10\C1\FF\97\03\4F\CE\A0\ED\42\05\74\BD\06\29\A4\EA\AF\25\D0\2D\02\5C\30\50\AA\6A\81\6D\09\75\81\73\E1\A7\7D\D0\98\9F\93\42\69\5E\02\A9
\DA\13\2A\A6\9D\7A\D0\30\59\4B\2E\F9\60\5B\AF\59\FB\32\ED\D6\05\D0\AB\97\7C\B0\06\58\42\D1\C5\C1\D3\C1\28\3F\D0\97\0F\B1\2E\5C\24\93\6C\BC\05\92\B3\2C\14\E6\CE\1C\58\B6\1F\44\E7\CD\5C\6E\EA\12\EB\6A\E6\A1\4F\44\A0\2D\3E\06\5F\3C\BC\A5\D5\0B
\02\D6\9D\87\D9\5C\30\9A\A3\D9\D5\12\AC\A5\C1\73\F8\68\5C\5C\81\85\A1\95\0E\65\61\5C\5C\D3\1A\5C\30\CA\F6\65\E4\91\99\59\02\B5\02\60\04\BC\A5\7F\B4\37\55\D8\5C\22\65\A1\C7\43\59\54\EC\F1\D9\7A\74\3A\56\39\50\99\5F\9A\B3\85\61\82\D0\95\46\D4
\3B\DD\80\5C\30\4D\9F\A2\B4\86\85\32\93\65\FA\EB\48\43\E9\D0\F3\5A\91\3F\EE\56\F2\BC\E5\9C\14\27\D7\08\AC\E5\87\E4\B3\7D\63\14\BE\59\FC\61\F5\E8\84\AC\E5\0F\FD\3F\51\68\1C\38\09\F0\B4\30\95\0B\51\14\87\01\43\4D\60\BA\9F\15\AB\F3\36\E6\F8\2C
\8B\9F\A2\4A\91\65\5A\BE\5A\5C\22\14\47\97\57\AA\A1\75\86\1F\96\75\5C\72\11\D5\3E\34\39\E8\8F\4B\FD\97\F0\49\25\4C\08\96\B9\7F\CD\DD\56\39\CF\FC\98\02\DD\D6\89\B4\F8\5A\13\EB\7B\56\45\4F\C4\58\01\3B\A9\E1\D1\CF\D0\6F\E0\61\67\7F\50\C2\5C\24
\5C\6E\B2\52\58\40\7D\21\2D\53\69\80\14\07\F2\52\AA\BE\A2\71\7A\D6\09\F6\EA\49\54\48\2E\A1\0F\D4\ED\5C\6E\6B\5C\6E\EF\9A\03\A0\5C\6E\15\64\CF\AE\98\54\8F\BA\89\B2\3E\D0\5C\6E\EE\C2\96\A0\AD\3F\0F\A3\45\85\60\B2\CC\35\44\2B\04\66\18\92\3F\23
\7A\B3\85\49\5A\FC\15\37\54\5B\A8\80\51\73\23\F9\44\0E\81\88\02\8A\5C\24\0B\AB\D5\CF\50\F9\A2\EC\49\02\86\15\12\09\FB\33\BE\D7\1A\2A\BC\3A\DD\39\59\49\B2\E3\48\8B\B3\0C\D4\48\AE\AC\58\AB\30\E5\44\8A\21\75\37\4A\B8\96\6D\AE\04\A0\59\42\7D\45
\AA\B0\8A\01\B3\BF\97\E7\AE\80\A2\F2\72\94\12\38\51\95\F9\5C\6E\7D\27\0F\50\F5\53\E2\B2\09\51\B1\D0\05\F5\E1\FA\A8\8E\91\B0\5C\24\08\A7\C5\60\52\C7\29\5E\E1\F5\28\4F\80\50\5C\30\AE\01\11\61\4B\BD\B5\F5\F4\6D\E8\33\AC\8A\5C\24\12\48\2E\84\F9
\1A\58\84\EB\F1\D4\E7\29\D0\56\02\AE\99\60\94\AD\DA\39\20\13\A8\2E\AE\59\99\91\31\38\8D\E2\DA\65\12\13\14\55\C1\92\60\58\E7\39\1E\8E\82\B4\09\8C\F0\E4\E7\5C\5C\4C\63\88\6A\B0\49\45\20\4E\E9\8D\AB\AA\A6\36\80\57\A1\05\44\A6\58\42\D8\09\5A\8B
\3A\94\7C\CF\A4\3A\09\45\2D\50\2D\17\DA\26\CE\C1\E8\BF\29\FA\86\F0\A7\0E\88\2A\D3\FA\11\D4\6C\C0\29\50\C2\75\8C\8F\79\7C\52\B0\19\8F\B3\4C\68\FF\2E\70\A4\04\A7\E9\5F\2A\A0\51\41\A0\86\40\20\B7\3F\2C\C6\A7\EA\90\59\EA\D6\29\74\82\1E\1C\D1\87
\9C\3C\ED\C1\50\2A\EA\E5\DC\6A\92\56\75\51\FE\3A\07\32\5C\30\90\4C\B8\05\3F\4A\EB\E7\E8\D1\2C\54\50\48\4C\02\B2\C1\FA\45\14\25\96\9D\AC\1F\5C\30\AA\A2\79\50\28\05\59\81\4A\5A\A5\EE\A9\FA\54\05\48\C5\58\5C\72\09\95\51\34\8E\68\4F\D2\3B\5C\5C
\14\8F\76\56\F5\23\E5\C0\54\8F\57\77\87\EF\5C\5C\60\8E\F5\4F\D2\A1\C5\7F\AB\3F\15\02\D2\4A\52\32\B3\F2\92\3D\18\F5\46\F3\E2\5D\BB\D0\12\9F\81\49\35\54\4D\0E\6A\49\EB\39\E9\2C\28\C6\A4\03\44\76\7C\74\C9\29\9D\8A\57\14\79\2D\A6\5D\7A\A8\DA\65
\82\8C\89\61\13\2C\17\70\51\36\5C\24\EB\49\2D\67\3D\25\15\91\53\D4\57\05\23\ED\54\50\A7\DC\90\A4\C9\29\AB\54\26\5D\DE\D1\F5\58\31\35\6A\86\12\94\42\38\84\84\E6\56\CF\D3\A5\5C\6E\EC\02\65\6D\20\79\93\94\8E\68\9B\2A\E8\A4\FC\BB\8E\84\B0\05\64
\E7\0C\34\CF\82\11\B7\03\62\08\64\02\1D\21\30\05\14\A4\81\67\52\94\14\1B\4A\5C\5C\03\CD\20\D6\4D\74\83\C0\14\31\52\03\5C\6E\5C\6E\8D\EF\E2\78\E8\A1\E8\DC\C1\AA\2E\F6\5F\BE\FC\75\19\1B\F2\07\2B\C6\BC\C7\3B\81\FD\8B\2A\34\88\CE\B8\29\12\5D\C0
\5C\5C\A1\6C\1A\DC\28\07\16\6D\5C\22\F1\9E\83\51\86\6E\54\8D\81\88\28\2A\5C\30\AC\0C\60\19\F0\31\48\EC\40\17\13\32\09\36\06\68\0C\E0\19\EA\59\C0\63\9E\90\01\9E\48\5F\0B\CC\DA\C8\66\F0\3F\B0\D0\61\AB\96\37\3D\4B\4B\64\65\C2\74\F7\48\E0\18\C0
\32\5C\30\2F\5C\30\85\19\36\32\40\03\62\7E\81\CB\60\B7\5C\30\2E\94\80\5C\30\BC\03\14\76\D9\29\20\0C\21\7E\BA\80\4A\50\1C\C4\9D\54\97\C1\BD\F4\BD\92\96\85\B5\A5\F3\17\C2\97\DA\4F\83\7B\74\BE\02\BE\5C\30\30\30\35\A6\02\07\BE\98\1D\2F\E0\AF\80
\5C\72\A9\83\C1\4A\0C\5E\15\F0\01\BD\30\DA\61\21\B6\29\7F\80\38\A6\25\4B\DE\98\50\12\50\07\34\C5\E9\7E\D3\14\02\48\04\92\98\E1\F7\D0\C5\F4\BC\DC\ED\5C\72\2B\A6\05\4C\62\98\A5\2F\32\15\01\34\29\93\D3\1D\A6\47\4B\EA\99\65\30\8A\65\14\CB\E9\80
\53\31\A6\1C\42\A8\09\2D\30\6A\66\D4\C4\E9\9A\53\0C\A6\77\4C\CE\99\C4\69\EA\64\20\85\E9\A0\D3\16\A6\7F\4C\BA\9A\5C\72\31\BA\68\F4\C8\A9\9C\53\20\A6\97\4D\12\4A\4A\13\CA\68\74\BE\29\A8\D3\2B\16\3F\4C\B6\9A\65\35\13\6E\94\D3\E9\7C\46\48\8C\C9
\4D\4E\97\F5\35\EA\6A\D4\C9\A9\99\53\48\93\D5\4C\96\97\E5\34\C9\3D\54\D8\E9\B4\D3\44\93\D5\4D\6E\9A\BD\36\5A\6D\40\49\40\1A\53\60\A6\29\27\AA\99\D5\37\1A\66\F2\7A\A9\9F\53\7A\A6\78\01\7E\4F\55\31\1A\6B\94\BF\A4\F5\53\46\A6\FD\4D\02\4F\55\34
\AA\70\F4\D9\A3\32\5C\30\30\30\30\A6\EC\18\BE\37\85\36\8A\6B\14\D1\23\78\53\6C\A7\27\4B\E2\37\85\37\5C\6E\6C\94\CD\E3\78\53\75\A7\07\4C\52\37\85\37\9A\73\74\DF\E3\78\53\7D\A7\47\4D\02\37\85\38\2A\71\74\D3\23\78\53\86\A7\4F\4D\5C\22\37\85\38
\AA\75\F4\EB\29\C6\D3\8F\5C\30\BF\18\92\9A\95\39\FA\72\11\99\29\CB\53\72\A6\89\18\32\9A\FD\3B\A0\0B\F4\F0\29\DE\D3\37\A7\81\4E\6A\9B\6D\2F\8A\78\14\E7\A9\D5\D3\BF\A6\73\4E\DA\9E\05\3A\6A\79\34\BF\A9\E0\53\AA\A7\67\4F\3A\31\FD\3D\5C\6E\63\54
\F6\A9\A7\53\CD\A7\95\19\92\9C\95\3B\EA\7B\F1\A5\A9\EE\53\C8\A7\2F\4F\52\48\5C\72\3D\CA\74\54\F4\E9\8A\49\DD\A7\A5\4F\9E\98\A4\5C\5C\7A\78\34\F7\A9\7F\53\F2\A7\8B\4D\FE\9F\95\3E\6A\7C\54\FD\69\BA\53\B6\91\B3\4F\86\99\BC\8D\9A\7E\F4\D0\5C\24
\6C\D3\FA\A8\03\4F\F6\9E\14\8D\9A\7D\74\FC\03\17\C8\D9\A7\DF\4F\EE\98\A4\8D\9A\7A\D4\FB\2A\06\81\25\A7\5D\50\50\02\FC\8D\9A\76\55\06\5C\22\FA\D3\DD\A7\AF\4B\E2\A0\ED\40\5C\6E\6F\F5\07\6A\01\D3\48\A8\3B\50\1A\A1\1D\3E\9A\81\31\A3\E9\FF\46\64
\A8\1F\50\1E\2E\35\42\D8\B8\95\0C\AA\5C\72\D4\0C\A8\33\1D\12\9C\75\42\B9\3C\B5\0B\4C\23\D4\3C\A8\51\50\12\45\9D\43\CA\81\75\04\2A\5C\6E\C5\DB\A8\79\50\4E\A1\B4\6C\AA\82\F5\5C\72\8B\36\D3\F3\A8\3F\4B\FA\A2\6D\42\5A\69\95\13\6A\1F\D3\48\A8\9B
\4F\32\A2\7D\31\4A\89\B5\10\E9\9B\D4\4D\A8\5F\4D\FE\A2\6D\44\8A\88\80\17\EA\26\D4\4B\A8\C7\51\36\A1\AD\46\7A\76\B4\F0\8B\36\D3\B9\A7\E9\51\6A\9D\E5\3B\6A\8D\B5\15\6A\29\D4\2A\A8\DE\18\BE\A3\6D\45\CA\8C\15\0B\AA\39\46\64\A8\C5\51\76\35\65\47
\D8\C9\B5\1F\64\A4\D4\84\A8\45\4D\5C\30\2B\E5\44\EA\83\15\5C\22\6A\29\53\44\A9\13\51\D2\A4\70\12\5A\66\B5\1D\E9\7F\C6\82\A7\6D\52\26\A2\FD\48\8A\92\55\18\92\DB\81\25\A7\7B\52\76\30\6D\30\7A\94\15\16\1D\0F\A5\E4\A7\9F\4C\C6\A5\05\40\FA\94\15
\27\12\D6\D4\16\A9\45\52\B6\3F\65\4A\F7\3E\15\1A\E9\B8\D4\9D\A8\DD\4D\92\A5\B5\49\FA\95\B2\01\AA\59\54\A6\8E\DB\52\F5\2F\A5\42\CA\95\15\2E\EA\55\54\BB\A9\59\52\CE\A1\9D\4C\3A\99\15\1A\6A\4E\D4\85\A9\95\52\9A\A1\DD\4C\FA\98\35\0F\6A\69\26\2C
\8E\89\4F\EA\A6\6D\4A\44\DF\35\2C\E3\39\D4\C0\A9\AD\51\1A\A6\A9\CD\08\E8\95\31\EA\68\54\66\A9\9B\4E\C8\01\18\06\98\D2\D1\DE\A5\51\80\27\A9\CE\37\BE\A7\4C\69\68\B8\B2\5C\72\63\6A\D4\9D\8C\91\53\7A\A7\14\75\9A\9F\5C\30\6E\E3\06\D4\BA\A9\67\17
\B6\A7\D8\07\39\14\D5\40\63\12\D5\04\8C\5C\72\54\1A\A7\25\4C\18\C5\D5\41\AA\66\54\AD\8E\4D\54\12\39\75\51\5C\6E\9F\D5\29\A2\E7\55\10\A9\B5\53\BA\A8\75\44\3A\93\B1\97\6A\88\55\09\A9\AD\17\C6\A8\85\50\DA\96\71\89\2A\82\45\DA\AA\4B\53\62\A5\6C
\5C\5C\DA\A4\B5\46\AA\94\D4\C5\AA\47\54\7A\A7\14\67\4A\A4\B5\48\AA\53\46\0C\AA\09\1E\5C\22\A9\BD\51\3A\98\31\91\EA\9B\D5\17\A9\3B\17\86\A9\BD\52\EA\A6\B5\4C\2A\7E\45\DF\AA\6F\54\D2\A6\0C\5C\5C\7A\A0\91\84\AA\A5\D5\3A\A9\AD\17\E2\AA\5D\53\EA
\95\B1\9F\AA\A5\D5\42\AA\93\55\12\A8\14\5E\4A\A9\75\52\2A\6B\45\F5\AA\09\17\16\AA\FD\54\EA\9C\51\74\EA\AF\D5\52\A9\67\17\32\AA\FD\55\6A\AB\B5\56\5C\24\C5\D5\5F\AA\B9\53\88\B3\6D\50\48\C6\55\5C\5C\AA\B1\54\FC\8C\5B\55\CA\AB\35\4A\68\D9\B5\5C
\5C\AA\B5\55\70\AA\D9\19\A2\AB\95\56\F0\37\61\5F\2A\80\D3\1F\AB\0B\1D\12\AC\3D\52\87\3E\5C\30\49\2A\BC\A5\F4\94\1F\56\1E\AB\ED\58\3A\68\55\38\6A\C9\54\E6\4B\5A\04\92\AC\14\5C\5C\3A\83\D5\29\6A\C7\54\B7\AB\38\98\B1\09\E5\57\5A\B3\55\62\92\F2
\4A\38\AB\0B\1E\52\AD\3D\59\1A\B3\55\56\10\9E\55\96\AB\17\52\0E\AC\A4\5C\5C\3A\99\D5\2D\6A\CB\D4\D1\AB\69\56\2E\A6\A5\5B\7A\B4\B1\D2\AA\C2\C7\2D\AB\7B\54\B2\AD\C5\5A\AA\9D\75\6F\6A\D7\55\BB\AB\33\20\1A\A1\CD\5B\AA\B1\D5\3E\AA\D8\C8\06\AB\45
\20\1A\AD\25\5C\5C\BA\B1\B5\68\23\62\D5\85\8B\A9\57\5A\AE\2D\5C\5C\BA\B8\F5\43\EA\E6\D5\11\AB\BB\57\3E\A8\AD\5D\DA\BA\67\34\23\B6\D5\C0\AB\4B\54\72\AE\ED\5A\CA\A4\15\77\6A\E3\D5\5C\24\AB\9B\1B\7A\AC\2D\52\6A\BD\F5\74\6A\D0\55\2A\AB\DF\57\9A
\AC\74\70\5C\6E\BE\34\F5\80\11\81\F0\04\17\27\96\4E\95\4D\BA\B4\B2\06\AA\78\55\FE\03\99\58\02\33\32\5B\78\F2\95\7F\2B\03\01\AE\93\CB\5C\24\42\B0\55\53\2A\BD\F5\71\EA\9B\55\CD\AA\71\58\5A\AE\7D\53\CA\C2\D5\78\EA\C1\D5\40\AC\2D\57\5C\6E\35\DD
\58\5A\A8\D5\85\AA\E3\D5\4A\AB\9B\55\32\B1\3D\5C\5C\FA\AA\15\89\EB\0E\46\2B\AB\F1\56\82\30\5D\58\58\C1\55\8C\AA\EC\D6\30\AB\8F\1B\8E\AC\2D\56\4A\B9\B2\07\2B\1C\D6\2F\AB\C9\17\82\B1\CD\5A\CA\AE\35\73\6A\B9\D6\44\AB\9F\55\DE\B2\25\62\D8\C9\B5
\8F\AA\C1\C7\F7\AB\0B\56\02\B2\25\59\9A\5E\75\40\64\A4\D5\A2\92\93\57\D0\E6\84\94\9A\C5\B2\52\6B\26\06\9C\8C\F1\59\52\AC\9D\5C\5C\A4\C5\92\52\6B\1A\D6\59\A9\63\56\C6\4F\2D\5C\5C\9A\97\09\6B\64\F2\D3\E1\4B\6F\58\02\B2\A5\4B\CA\CD\15\2F\EB\39
\D6\5D\93\CB\56\AA\4F\2D\55\89\3C\B5\99\40\DD\C9\E5\AC\A5\56\CE\B3\5B\9F\03\08\F5\9B\AB\36\55\B9\AD\02\97\90\C2\3D\65\8A\CF\B5\6F\AB\34\54\DD\AD\1B\59\E2\30\8D\65\48\C6\D5\A4\AA\5C\72\CA\CD\39\AB\13\A2\95\AC\36\E0\28\F3\AE\9D\95\2B\1A\9E\81
\37\CE\79\62\D3\72\49\0B\20\A7\7C\C4\07\5C\30\97\3A\46\7A\04\F0\C9\E8\5C\6E\85\A7\7C\AA\16\9C\73\3C\B0\02\52\BD\25\4A\D3\CB\17\07\07\D4\5D\12\A6\F5\46\04\E8\B5\33\F5\AD\14\8C\89\6A\A2\CE\A3\B9\59\02\AE\B5\5A\93\BE\5E\07\3C\35\9E\58\B7\49\4A
\0C\F2\C5\4D\60\12\D7\6E\4F\12\5C\5C\A3\42\26\B6\72\93\F5\81\73\C5\E7\90\51\88\75\7A\A8\A2\78\BC\E5\B9\E8\13\1A\09\03\AC\54\88\AE\A4\56\77\CD\16\4A\0C\35\B8\67\09\CF\3F\76\12\A8\71\46\34\EF\95\39\B3\D3\9D\B7\BB\13\AD\D5\36\AA\7A\05\6A\F9\E8
\13\D5\1D\87\4F\56\95\BF\5C\72\CE\75\CA\3D\C2\40\CA\92\66\54\CD\9A\9C\F0\EF\F6\79\B4\B3\09\80\12\D6\AB\70\4B\61\58\55\39\9A\6D\B2\B3\85\AD\5C\6E\8D\65\6B\4D\6F\9B\C3\35\5C\6E\68\54\DE\15\86\EA\A6\A6\85\56\A0\AE\12\AC\76\80\82\FD\3A\0B\AE\D1
\16\73\AE\81\9E\7F\5C\5C\70\3E\C1\1B\D2\4C\D3\3A\A6\8B\29\F1\AD\4F\3D\6E\6B\7D\6A\A5\53\F5\AB\26\B7\D6\AE\9E\0E\AA\7E\B5\8A\A4\79\A9\E0\12\65\94\AC\DC\9A\DF\5A\D6\B5\F1\29\6A\D8\15\AE\94\74\D7\17\56\52\A2\56\B5\BD\73\B5\72\CA\3A\2B\61\CD\6F
\AD\8B\2C\21\54\FD\6C\8A\0F\55\CF\95\DE\2A\6E\AD\9B\35\BE\B6\5C\5C\F0\55\F7\64\76\2B\92\4D\5C\5C\AE\29\5D\42\B6\7C\F1\4A\EB\15\B4\A6\6C\3B\34\98\AF\35\F6\70\4C\D6\F9\D3\B5\D8\A6\37\4C\69\0F\FD\5B\7E\62\6D\74\C9\E6\53\65\80\5C\22\BB\B0\9B\0E
\01\42\BA\BD\76\A9\B4\64\93\E7\40\CD\A7\53\C1\34\29\D8\92\97\5A\EF\15\BC\1D\BB\5C\24\29\AE\F1\35\69\63\21\1D\99\B5\B4\A2\9D\BD\CE\8C\96\EA\EE\12\5C\5C\52\F9\2A\DF\53\44\A6\92\CE\77\5C\24\9B\39\E6\74\53\C1\5C\6E\E1\94\47\66\F2\50\D4\9B\C6\EE
\CA\B8\B4\DF\DA\E3\2A\A6\09\4B\CD\F4\AD\44\B7\56\79\FB\B9\35\CD\75\C8\A6\4A\D7\91\9A\17\5C\5C\9A\B5\43\B9\95\5C\24\93\7F\1D\D9\57\2C\AF\4D\5C\5C\BA\BB\F4\E5\CA\E6\35\AC\EB\D3\12\96\AE\6B\5E\95\56\D5\73\8A\E8\35\AE\6B\A1\D6\BB\AF\4D\5E\EA\B5
\FD\7B\C0\05\75\B0\A7\16\CF\A4\77\46\1F\51\E0\04\DF\4A\E9\48\FB\67\1D\57\4E\A1\6B\38\FE\BA\CD\1D\8A\F4\CA\89\2B\B8\BB\A7\98\A5\31\62\72\C4\ED\F9\CB\95\D8\EB\D3\56\DC\58\8D\5D\9D\64\4C\E7\6A\ED\B4\59\54\99\CE\76\AE\E7\36\96\74\15\77\79\CB\95
\DE\6B\F2\D7\EB\AD\E0\AB\76\78\3D\7F\04\85\35\E0\68\15\BB\B2\9D\12\EF\06\BD\F4\38\97\5D\CA\C1\91\F1\CB\B7\78\14\01\5C\22\63\7C\D0\75\66\55\FF\83\FE\D8\5C\30\98\D2\A7\35\DE\6A\C8\A9\7D\94\50\6B\6E\CC\9A\52\6C\BE\89\66\1A\D9\AA\E0\2B\F2\15\93
\D1\DB\A3\82\A2\3E\63\34\C6\D7\57\2B\0C\54\FD\44\6F\AE\D2\EF\A0\92\04\C7\F7\71\EE\AF\C9\10\80\53\58\92\A8\DD\62\7D\7D\C5\68\6E\B5\26\3C\CF\3F\99\2F\33\BA\94\2D\12\C3\A1\68\03\0E\86\B0\A9\71\6E\89\FD\A7\09\F5\70\0C\83\25\29\53\05\C9\79\50\5C
\72\85\7F\DB\CD\B5\FF\6D\2D\CF\66\9D\35\B0\8A\01\BA\5B\80\5C\5C\96\3D\CC\54\E0\7D\14\F8\79\20\29\FD\E7\A0\17\59\64\E7\AB\D8\A4\34\36\23\59\3E\A5\05\18\33\D4\1D\8C\1E\D7\A0\16\0E\05\9A\15\6D\A9\FA\5C\6E\30\39\68\3B\13\B2\34\98\B0\C2\30\82\C3
\2B\DF\61\81\65\5C\6E\18\C8\83\C4\B0\C8\9E\21\81\CA\0E\C5\FC\D1\29\91\1B\40\F4\78\A2\78\11\07\7D\87\5C\24\A6\D6\1D\DF\1B\15\FD\41\46\8C\FA\C3\91\B2\30\4E\F6\20\52\E3\09\BA\B0\FE\D3\84\E8\69\DC\A5\FC\AC\55\AC\3F\BD\A1\02\97\62\35\ED\21\2B\D7
\AD\5C\30\47\98\FD\D8\77\7B\B6\1C\15\EE\D3\A4\97\1C\EF\08\6C\49\20\A3\29\92\77\2D\0C\34\15\03\3B\70\38\C2\CE\D8\A4\3B\40\5C\72\5C\6E\07\1A\5C\72\0B\07\AD\85\DA\4E\35\12\81\C6\85\46\07\18\5C\5C\D3\B9\68\67\50\45\20\69\06\02\01\6C\03\10\06\30
\0B\A6\EB\58\A6\25\92\29\5C\6E\88\D8\4C\6B\14\C8\17\8F\14\5E\82\81\C6\32\A2\06\14\DD\3C\35\46\D8\16\19\EC\64\89\49\83\3C\F1\46\C6\6A\18\B3\62\03\4D\AC\64\10\27\03\E1\09\B6\C6\B2\44\A3\E2\12\EE\8E\8F\42\6D\61\B2\01\D0\03\D2\F6\85\FD\4F\14\59
\F1\58\67\67\BC\38\A5\E7\12\5A\16\0C\56\19\D8\10\25\6D\66\AC\D4\25\E5\80\13\46\A1\2D\A5\2C\1E\02\C9\03\5C\6E\83\91\FD\61\F9\A4\46\C7\77\66\14\83\F4\03\73\04\B9\E7\AC\CA\30\47\E4\B9\91\0E\D8\5A\B2\5C\6E\09\31\86\3B\4A\81\ED\96\31\C1\18\02\5C
\22\69\50\F1\42\C8\79\14\B4\43\AC\96\CC\FB\B2\74\97\7A\D3\89\15\E3\D1\D6\0E\10\3B\6C\82\34\E2\10\C8\D2\A1\82\83\4A\87\94\6D\4C\18\1C\58\B2\2B\6C\01\E1\98\AA\F5\7B\08\C2\38\AC\5C\22\08\E2\06\5C\6E\CC\56\C1\C0\9A\C4\DB\28\17\DA\5C\24\01\59\5C
\30\ED\64\5C\5C\11\DD\86\36\9B\44\39\1A\42\B4\48\7F\B1\64\25\A6\D3\EE\96\31\8F\DB\C1\98\36\66\04\20\D1\5C\22\CA\12\54\90\4A\D6\19\DA\60\06\2F\B2\87\14\3E\CA\43\3D\C4\0E\63\93\EC\A8\B1\BC\B2\3F\65\04\10\21\FD\6B\2A\B1\33\6C\7E\83\C3\12\0E\D3
\69\15\12\FF\AB\2C\0B\D7\41\82\9D\0F\7A\2F\64\E0\0B\A8\12\A6\4D\6F\EC\C5\ED\B4\DA\B2\6E\D1\5C\22\C9\BD\84\90\CD\C2\EB\C6\7A\03\54\72\7D\65\D9\8C\7B\4D\1B\15\C0\61\43\D4\37\91\66\0C\69\54\BA\F5\97\CB\2F\36\57\A2\A9\81\50\B2\EC\1C\D6\CC\38\86
\46\61\60\DD\EC\BE\07\35\B3\16\F3\A9\B9\4D\85\66\32\56\5D\9C\5B\27\7D\63\6E\12\34\5D\12\68\B7\ED\D6\65\17\AB\A6\8B\03\5A\80\C5\A7\5C\72\99\8B\32\C9\C8\11\BD\58\6C\6C\47\61\60\28\AD\99\97\DB\08\28\82\8A\C4\F2\5C\30\E8\15\06\C4\FD\9A\D0\5F\F6
\6C\4F\98\1F\F9\66\26\05\66\C4\31\63\10\38\EC\44\1A\7B\BC\51\13\E6\01\DC\09\53\02\0B\36\F6\70\5C\30\E4\59\C2\98\E6\06\B9\98\99\EE\5C\30\5C\72\F6\71\85\33\0B\12\6D\26\2A\66\CE\3B\CC\70\F2\36\72\5E\63\8C\CF\B3\A8\97\1A\60\C9\B5\26\7A\80\6E\5E
\DA\B1\F9\3B\44\01\C8\E8\53\1E\E3\A4\6F\6A\5E\E3\3D\BF\4C\27\67\94\1C\35\9C\93\C4\26\83\EC\E4\87\45\66\26\F1\DE\CF\7C\5C\6E\4B\20\36\3F\62\58\04\2A\03\AC\2E\66\CF\88\45\83\FB\96\7E\26\39\D9\21\98\E7\64\8C\6B\40\89\76\5C\22\16\46\AC\47\9A\01
\78\5C\5C\E9\3D\FD\45\8A\37\EF\0F\14\58\50\32\5B\3A\1E\C1\B6\5C\30\83\06\D7\8E\E0\A1\1A\A0\58\7E\11\A6\18\BD\37\10\12\B7\CD\E2\16\58\36\86\34\B2\9C\C9\28\13\C3\5C\22\3B\42\EC\5C\6E\DE\FD\58\D7\1A\D1\68\79\B9\CC\26\9B\44\D6\88\DB\02\5A\1D\02
\1A\18\BC\03\6C\5C\6E\4B\43\96\89\ED\17\9A\9F\02\1E\86\90\70\D8\15\92\C4\60\18\6D\17\53\14\7F\AE\09\32\D0\55\A2\3B\47\E0\95\91\03\38\B6\B4\7B\07\92\D1\2D\94\B1\57\42\6D\EC\13\B8\5C\24\46\80\F8\5C\72\10\E0\6C\26\42\16\87\59\08\32\5C\72\B4\A8
\6D\41\90\C5\91\B0\77\C4\5A\D8\36\D8\52\1A\D0\92\1D\BF\D0\25\64\B4\8C\DD\C2\15\DA\5F\B2\9C\54\F4\15\35\A6\60\60\42\61\D0\1D\D9\47\B4\D5\63\15\E1\58\4B\F6\5C\72\B6\98\5C\30\AD\D8\67\4E\BC\F9\5C\5C\91\B4\BE\3B\4E\E0\A8\E0\C4\DA\73\0C\5E\5C\6E
\8C\CC\75\A7\E4\BF\16\9F\AD\02\1D\D1\B2\56\77\7A\C4\55\A0\46\5C\22\5C\30\54\19\2D\B1\2C\5E\92\CE\01\5C\30\8B\CE\F6\97\E8\32\20\06\2F\E6\99\20\F3\C2\CF\E0\45\57\9E\16\2F\5C\30\C2\BC\F2\96\D2\C4\BE\CB\34\06\3B\5C\22\EC\4B\2D\4E\5A\9A\0B\0E\BD
\D0\4D\63\CE\BB\52\56\4E\65\9C\5A\A6\04\77\6A\96\C2\8A\36\EB\1F\AF\61\02\1C\B6\F7\79\CC\88\D9\E7\BB\13\8B\4B\56\AE\6C\4E\3F\81\B1\C3\6A\74\32\AD\96\B6\54\2F\5B\ED\4E\A4\FB\02\B1\6A\7C\30\74\25\20\23\B0\94\80\E2\9D\D1\5C\30\F4\D3\60\A3\F8\35
\46\3C\96\B4\83\A0\58\40\03\5C\6E\D3\A2\C1\ED\95\CB\5A\46\5C\5C\2D\6D\9B\BC\B3\63\64\32\C4\70\35\47\BA\76\27\42\DF\27\A2\37\7B\6B\8A\0C\01\2A\27\90\4C\DC\41\AA\5A\7C\49\B1\6B\B4\5C\6E\2D\2E\43\A2\36\BC\04\AB\B9\1E\0B\C7\6B\12\95\2D\AF\13\D7
\05\8E\A9\53\DA\FA\B0\F7\6B\D1\04\5D\AF\CB\5F\5C\24\07\85\07\DA\2B\05\47\15\F2\D7\A0\13\5B\5E\87\AD\AD\7A\0C\0B\1B\5D\6B\D1\D1\38\11\9B\5C\5C\F6\BF\46\7C\A7\A2\3F\42\88\D8\15\19\C1\0B\5E\90\08\CF\15\42\A8\89\CC\8E\7C\F1\99\EB\40\8A\14\AD\C2
\F7\42\AF\A5\7A\50\16\16\E9\9E\18\57\07\2F\52\3F\5B\21\03\62\11\42\96\E1\B9\13\6B\C0\89\D1\A0\02\27\09\28\E3\65\3A\78\04\1B\66\E0\72\0F\82\37\5C\72\5F\1D\16\ED\E2\71\B6\07\4D\61\EA\5C\30\23\B1\E4\37\7C\E9\51\26\5C\30\05\16\C9\81\0E\40\29\08
\B5\04\F4\86\C0\0E\31\19\F2\EB\AE\86\4C\41\5B\50\74\C0\5C\30\9C\02\99\FD\60\87\36\D5\5C\5C\65\91\9F\B6\7A\78\D2\DA\53\DD\80\0E\76\D5\88\CF\80\55\3A\1E\01\9E\DA\B1\BF\54\BC\C1\87\88\CF\97\0E\3E\1E\04\66\DB\5C\6E\71\8B\6C\80\C5\2B\4B\28\7C\B6
\5C\5C\7F\8E\B4\D1\A0\13\14\47\8F\9B\55\D8\8B\B3\02\0C\1C\C6\40\28\F0\2A\C9\69\1E\53\90\25\46\A8\5C\72\52\5C\24\A9\95\43\B6\B6\4C\D0\DD\C4\F6\3B\C9\64\B5\EC\C4\BC\67\EB\2D\5C\24\10\6D\3F\F6\6C\68\CA\9D\14\81\8A\33\3F\50\AA\59\8F\0");}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo"GIF89a\0\0\81\0001\EE\EE\EE\5C\30\5C\30\80\99\99\99\5C\30\5C\30\5C\30\21\F9\04\01\5C\30\5C\30\01\5C\30\2C\5C\30\5C\30\5C\30\5C\30\12\5C\30\12\5C\30\01\02\21\84\8F\A9\CB\ED\0F\4D\08\F1\CC\2A\29\BE\6F\FA\AF\29\20\08\71\95\19\A1\65\88\B5\EE\23\C4\F2\4C\CB\05\5C\30
\3B\22\3B\62\72\65\61\6B\3B\63\61\73\65\22\63\72\6F\73\73\2E\67\69\66\22\3A\65\63\68\6F\22\47\49\46\38\39\61\12\5C\30\12\5C\30\81\5C\30\30\30\31\EE\EE\EE\5C\30\5C\30\80\99\99\99\5C\30\5C\30\5C\30\21\F9\04\01\5C\30\5C\30\01\5C\30\2C\5C\30\5C
\30\5C\30\5C\30\12\5C\30\12\5C\30\01\02\23\84\8F\A9\CB\ED\0F\23\5C\6E\61\D6\46\6F\7E\79\C3\2E\81\5F\77\61\94\E1\31\E7\B1\4A\EE\0B\47\C2\4C\D7\36\5D\5C\30\5C\30\3B\22\3B\62\72\65\61\6B\3B\63\61\73\65\22\75\70\2E\67\69\66\22\3A\65\63\68\6F\22
\47\49\46\38\39\61\12\5C\30\12\5C\30\81\5C\30\30\30\31\EE\EE\EE\5C\30\5C\30\80\99\99\99\5C\30\5C\30\5C\30\21\F9\04\01\5C\30\5C\30\01\5C\30\2C\5C\30\5C\30\5C\30\5C\30\12\5C\30\12\5C\30\01\02\20\84\8F\A9\CB\ED\0F\4D\08\51\4E\5C\6E\EF\7D\13\F4
\9E\61\15\38\8A\11\79\9A\61\C5\B6\AE\5C\30\C7\F2\1C\17\5C\30\3B\22\3B\62\72\65\61\6B\3B\63\61\73\65\22\64\6F\77\6E\2E\67\69\66\22\3A\65\63\68\6F\22\47\49\46\38\39\61\12\5C\30\12\5C\30\81\5C\30\30\30\31\EE\EE\EE\5C\30\5C\30\80\99\99\99\5C\30
\5C\30\5C\30\21\F9\04\01\5C\30\5C\30\01\5C\30\2C\5C\30\5C\30\5C\30\5C\30\12\5C\30\12\5C\30\01\02\20\84\8F\A9\CB\ED\0F\4D\08\F1\CC\2A\29\BE\5B\57\FE\5C\5C\A2\C7\4C\26\D9\9C\1D\C6\B6\95\5C\30\C7\F2\1C\17\5C\30\3B\22\3B\62\72\65\61\6B\3B\63\61
\73\65\22\61\72\72\6F\77\2E\67\69\66\22\3A\65\63\68\6F\22\47\49\46\38\39\61\08\5C\30\5C\6E\5C\30\80\5C\30\5C\30\80\80\80\FF\FF\FF\21\F9\04\01\5C\30\5C\30\01\5C\30\2C\5C\30\5C\30\5C\30\5C\30\08\5C\30\5C\6E\5C\30\5C\30\02\0F\04\82\69\96\B1\8B
\9E\94\11\AAӲ޻\0\0;";break;}}exit;}if($_GET["script"]=="version"){$r=file_open_lock(get_temp_dir()."/adminer.version");if($r)file_write_unlock($r,serialize(array("signature"=>$_POST["signature"],"version"=>$_POST["version"])));exit;}global$b,$f,$l,$hc,$pc,$zc,$m,$ld,$rd,$ba,$Sd,$y,$ca,$le,$of,$ag,$Fh,$wd,$mi,$si,$U,$Gi,$ia;if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];$ba=($_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off"))||ini_bool("session.cookie_secure");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_cache_limiter("");session_name("adminer_sid");$Nf=array(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",$ba);if(version_compare(PHP_VERSION,'5.2.0')>=0)$Nf[]=true;call_user_func_array('session_set_cookie_params',$Nf);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$Xc);if(function_exists("get_magic_quotes_runtime")&&get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",15);function
get_lang(){return'en';}function
lang($ri,$df=null){if(is_array($ri)){$dg=($df==1?0:1);$ri=$ri[$dg];}$ri=str_replace("%d","%s",$ri);$df=format_number($df);return
sprintf($ri,$df);}if(extension_loaded('pdo')){class
Min_PDO{var$_result,$server_info,$affected_rows,$errno,$error,$pdo;function
__construct(){global$b;$dg=array_search("SQL",$b->operators);if($dg!==false)unset($b->operators[$dg]);}function
dsn($mc,$V,$F,$wf=array()){try{$this->pdo=new
PDO($mc,$V,$F,$wf);}catch(Exception$Ec){auth_error(h($Ec->getMessage()));}$this->pdo->setAttribute(3,1);$this->pdo->setAttribute(13,array('Min_PDOStatement'));$this->server_info=@$this->pdo->getAttribute(4);}function
quote($P){return$this->pdo->quote($P);}function
query($G,$Ai=false){$H=$this->pdo->query($G);$this->error="";if(!$H){list(,$this->errno,$this->error)=$this->pdo->errorInfo();if(!$this->error)$this->error='Unknown error.';return
false;}$this->store_result($H);return$H;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result($H=null){if(!$H){$H=$this->_result;if(!$H)return
false;}if($H->columnCount()){$H->num_rows=$H->rowCount();return$H;}$this->affected_rows=$H->rowCount();return
true;}function
next_result(){if(!$this->_result)return
false;$this->_result->_offset=0;return@$this->_result->nextRowset();}function
result($G,$n=0){$H=$this->query($G);if(!$H)return
false;$J=$H->fetch();return$J[$n];}}class
Min_PDOStatement
extends
PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch(2);}function
fetch_row(){return$this->fetch(3);}function
fetch_field(){$J=(object)$this->getColumnMeta($this->_offset++);$J->orgtable=$J->table;$J->orgname=$J->name;$J->charsetnr=(in_array("blob",(array)$J->flags)?63:0);return$J;}}}$hc=array();function
add_driver($u,$D){global$hc;$hc[$u]=$D;}class
Min_SQL{var$_conn;function
__construct($f){$this->_conn=$f;}function
select($Q,$L,$Z,$od,$yf=array(),$_=1,$E=0,$lg=false){global$b,$y;$Zd=(count($od)<count($L));$G=$b->selectQueryBuild($L,$Z,$od,$yf,$_,$E);if(!$G)$G="SELECT".limit(($_GET["page"]!="last"&&$_!=""&&$od&&$Zd&&$y=="sql"?"SQL_CALC_FOUND_ROWS ":"").implode(", ",$L)."\nFROM ".table($Q),($Z?"\nWHERE ".implode(" AND ",$Z):"").($od&&$Zd?"\nGROUP BY ".implode(", ",$od):"").($yf?"\nORDER BY ".implode(", ",$yf):""),($_!=""?+$_:null),($E?$_*$E:0),"\n");$Bh=microtime(true);$I=$this->_conn->query($G);if($lg)echo$b->selectQuery($G,$Bh,!$I);return$I;}function
delete($Q,$vg,$_=0){$G="FROM ".table($Q);return
queries("DELETE".($_?limit1($Q,$G,$vg):" $G$vg"));}function
update($Q,$N,$vg,$_=0,$gh="\n"){$Si=array();foreach($N
as$z=>$X)$Si[]="$z = $X";$G=table($Q)." SET$gh".implode(",$gh",$Si);return
queries("UPDATE".($_?limit1($Q,$G,$vg,$gh):" $G$vg"));}function
insert($Q,$N){return
queries("INSERT INTO ".table($Q).($N?" (".implode(", ",array_keys($N)).")\nVALUES (".implode(", ",$N).")":" DEFAULT VALUES"));}function
insertUpdate($Q,$K,$jg){return
false;}function
begin(){return
queries("BEGIN");}function
commit(){return
queries("COMMIT");}function
rollback(){return
queries("ROLLBACK");}function
slowQuery($G,$di){}function
convertSearch($v,$X,$n){return$v;}function
value($X,$n){return(method_exists($this->_conn,'value')?$this->_conn->value($X,$n):(is_resource($X)?stream_get_contents($X):$X));}function
quoteBinary($Wg){return
q($Wg);}function
warnings(){return'';}function
tableHelp($D){}}$hc["sqlite"]="SQLite 3";$hc["sqlite2"]="SQLite 2";if(isset($_GET["sqlite"])||isset($_GET["sqlite2"])){define("DRIVER",(isset($_GET["sqlite"])?"sqlite":"sqlite2"));if(class_exists(isset($_GET["sqlite"])?"SQLite3":"SQLiteDatabase")){if(isset($_GET["sqlite"])){class
Min_SQLite{var$extension="SQLite3",$server_info,$affected_rows,$errno,$error,$_link;function
__construct($p){$this->_link=new
SQLite3($p);$Vi=$this->_link->version();$this->server_info=$Vi["versionString"];}function
query($G){$H=@$this->_link->query($G);$this->error="";if(!$H){$this->errno=$this->_link->lastErrorCode();$this->error=$this->_link->lastErrorMsg();return
false;}elseif($H->numColumns())return
new
Min_Result($H);$this->affected_rows=$this->_link->changes();return
true;}function
quote($P){return(is_utf8($P)?"'".$this->_link->escapeString($P)."'":"x'".reset(unpack('H*',$P))."'");}function
store_result(){return$this->_result;}function
result($G,$n=0){$H=$this->query($G);if(!is_object($H))return
false;$J=$H->_result->fetchArray();return$J[$n];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($H){$this->_result=$H;}function
fetch_assoc(){return$this->_result->fetchArray(SQLITE3_ASSOC);}function
fetch_row(){return$this->_result->fetchArray(SQLITE3_NUM);}function
fetch_field(){$d=$this->_offset++;$T=$this->_result->columnType($d);return(object)array("name"=>$this->_result->columnName($d),"type"=>$T,"charsetnr"=>($T==SQLITE3_BLOB?63:0),);}function
__desctruct(){return$this->_result->finalize();}}}else{class
Min_SQLite{var$extension="SQLite",$server_info,$affected_rows,$error,$_link;function
__construct($p){$this->server_info=sqlite_libversion();$this->_link=new
SQLiteDatabase($p);}function
query($G,$Ai=false){$Oe=($Ai?"unbufferedQuery":"query");$H=@$this->_link->$Oe($G,SQLITE_BOTH,$m);$this->error="";if(!$H){$this->error=$m;return
false;}elseif($H===true){$this->affected_rows=$this->changes();return
true;}return
new
Min_Result($H);}function
quote($P){return"'".sqlite_escape_string($P)."'";}function
store_result(){return$this->_result;}function
result($G,$n=0){$H=$this->query($G);if(!is_object($H))return
false;$J=$H->_result->fetch();return$J[$n];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($H){$this->_result=$H;if(method_exists($H,'numRows'))$this->num_rows=$H->numRows();}function
fetch_assoc(){$J=$this->_result->fetch(SQLITE_ASSOC);if(!$J)return
false;$I=array();foreach($J
as$z=>$X)$I[($z[0]=='"'?idf_unescape($z):$z)]=$X;return$I;}function
fetch_row(){return$this->_result->fetch(SQLITE_NUM);}function
fetch_field(){$D=$this->_result->fieldName($this->_offset++);$Yf='(\[.*]|"(?:[^"]|"")*"|(.+))';if(preg_match("~^($Yf\\.)?$Yf\$~",$D,$C)){$Q=($C[3]!=""?$C[3]:idf_unescape($C[2]));$D=($C[5]!=""?$C[5]:idf_unescape($C[4]));}return(object)array("name"=>$D,"orgname"=>$D,"orgtable"=>$Q,);}}}}elseif(extension_loaded("pdo_sqlite")){class
Min_SQLite
extends
Min_PDO{var$extension="PDO_SQLite";function
__construct($p){$this->dsn(DRIVER.":$p","","");}}}if(class_exists("Min_SQLite")){class
Min_DB
extends
Min_SQLite{function
__construct(){parent::__construct(":memory:");$this->query("PRAGMA foreign_keys = 1");}function
select_db($p){if(is_readable($p)&&$this->query("ATTACH ".$this->quote(preg_match("~(^[/\\\\]|:)~",$p)?$p:dirname($_SERVER["SCRIPT_FILENAME"])."/$p")." AS a")){parent::__construct($p);$this->query("PRAGMA foreign_keys = 1");$this->query("PRAGMA busy_timeout = 500");return
true;}return
false;}function
multi_query($G){return$this->_result=$this->query($G);}function
next_result(){return
false;}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$K,$jg){$Si=array();foreach($K
as$N)$Si[]="(".implode(", ",$N).")";return
queries("REPLACE INTO ".table($Q)." (".implode(", ",array_keys(reset($K))).") VALUES\n".implode(",\n",$Si));}function
tableHelp($D){if($D=="sqlite_sequence")return"fileformat2.html#seqtab";if($D=="sqlite_master")return"fileformat2.html#$D";}}function
idf_escape($v){return'"'.str_replace('"','""',$v).'"';}function
table($v){return
idf_escape($v);}function
connect(){global$b;list(,,$F)=$b->credentials();if($F!="")return'Database does not support password.';return
new
Min_DB;}function
get_databases(){return
array();}function
limit($G,$Z,$_,$gf=0,$gh=" "){return" $G$Z".($_!==null?$gh."LIMIT $_".($gf?" OFFSET $gf":""):"");}function
limit1($Q,$G,$Z,$gh="\n"){global$f;return(preg_match('~^INTO~',$G)||$f->result("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')")?limit($G,$Z,1,0,$gh):" $G WHERE rowid = (SELECT rowid FROM ".table($Q).$Z.$gh."LIMIT 1)");}function
db_collation($k,$mb){global$f;return$f->result("PRAGMA encoding");}function
engines(){return
array();}function
logged_user(){return
get_current_user();}function
tables_list(){return
get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name");}function
count_tables($j){return
array();}function
table_status($D=""){global$f;$I=array();foreach(get_rows("SELECT name AS Name, type AS Engine, 'rowid' AS Oid, '' AS Auto_increment FROM sqlite_master WHERE type IN ('table', 'view') ".($D!=""?"AND name = ".q($D):"ORDER BY name"))as$J){$J["Rows"]=$f->result("SELECT COUNT(*) FROM ".idf_escape($J["Name"]));$I[$J["Name"]]=$J;}foreach(get_rows("SELECT * FROM sqlite_sequence",null,"")as$J)$I[$J["name"]]["Auto_increment"]=$J["seq"];return($D!=""?$I[$D]:$I);}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){global$f;return!$f->result("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");}function
fields($Q){global$f;$I=array();$jg="";foreach(get_rows("PRAGMA table_info(".table($Q).")")as$J){$D=$J["name"];$T=strtolower($J["type"]);$Wb=$J["dflt_value"];$I[$D]=array("field"=>$D,"type"=>(preg_match('~int~i',$T)?"integer":(preg_match('~char|clob|text~i',$T)?"text":(preg_match('~blob~i',$T)?"blob":(preg_match('~real|floa|doub~i',$T)?"real":"numeric")))),"full_type"=>$T,"default"=>(preg_match("~'(.*)'~",$Wb,$C)?str_replace("''","'",$C[1]):($Wb=="NULL"?null:$Wb)),"null"=>!$J["notnull"],"privileges"=>array("select"=>1,"insert"=>1,"update"=>1),"primary"=>$J["pk"],);if($J["pk"]){if($jg!="")$I[$jg]["auto_increment"]=false;elseif(preg_match('~^integer$~i',$T))$I[$D]["auto_increment"]=true;$jg=$D;}}$xh=$f->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));preg_match_all('~(("[^"]*+")+|[a-z0-9_]+)\s+text\s+COLLATE\s+(\'[^\']+\'|\S+)~i',$xh,$Be,PREG_SET_ORDER);foreach($Be
as$C){$D=str_replace('""','"',preg_replace('~^"|"$~','',$C[1]));if($I[$D])$I[$D]["collation"]=trim($C[3],"'");}return$I;}function
indexes($Q,$g=null){global$f;if(!is_object($g))$g=$f;$I=array();$xh=$g->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));if(preg_match('~\bPRIMARY\s+KEY\s*\((([^)"]+|"[^"]*"|`[^`]*`)++)~i',$xh,$C)){$I[""]=array("type"=>"PRIMARY","columns"=>array(),"lengths"=>array(),"descs"=>array());preg_match_all('~((("[^"]*+")+|(?:`[^`]*+`)+)|(\S+))(\s+(ASC|DESC))?(,\s*|$)~i',$C[1],$Be,PREG_SET_ORDER);foreach($Be
as$C){$I[""]["columns"][]=idf_unescape($C[2]).$C[4];$I[""]["descs"][]=(preg_match('~DESC~i',$C[5])?'1':null);}}if(!$I){foreach(fields($Q)as$D=>$n){if($n["primary"])$I[""]=array("type"=>"PRIMARY","columns"=>array($D),"lengths"=>array(),"descs"=>array(null));}}$_h=get_key_vals("SELECT name, sql FROM sqlite_master WHERE type = 'index' AND tbl_name = ".q($Q),$g);foreach(get_rows("PRAGMA index_list(".table($Q).")",$g)as$J){$D=$J["name"];$w=array("type"=>($J["unique"]?"UNIQUE":"INDEX"));$w["lengths"]=array();$w["descs"]=array();foreach(get_rows("PRAGMA index_info(".idf_escape($D).")",$g)as$Vg){$w["columns"][]=$Vg["name"];$w["descs"][]=null;}if(preg_match('~^CREATE( UNIQUE)? INDEX '.preg_quote(idf_escape($D).' ON '.idf_escape($Q),'~').' \((.*)\)$~i',$_h[$D],$Fg)){preg_match_all('/("[^"]*+")+( DESC)?/',$Fg[2],$Be);foreach($Be[2]as$z=>$X){if($X)$w["descs"][$z]='1';}}if(!$I[""]||$w["type"]!="UNIQUE"||$w["columns"]!=$I[""]["columns"]||$w["descs"]!=$I[""]["descs"]||!preg_match("~^sqlite_~",$D))$I[$D]=$w;}return$I;}function
foreign_keys($Q){$I=array();foreach(get_rows("PRAGMA foreign_key_list(".table($Q).")")as$J){$q=&$I[$J["id"]];if(!$q)$q=$J;$q["source"][]=$J["from"];$q["target"][]=$J["to"];}return$I;}function
adm_view($D){global$f;return
array("select"=>preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\s+~iU','',$f->result("SELECT sql FROM sqlite_master WHERE name = ".q($D))));}function
collations(){return(isset($_GET["create"])?get_vals("PRAGMA collation_list",1):array());}function
information_schema($k){return
false;}function
error(){global$f;return
h($f->error);}function
check_sqlite_name($D){global$f;$Nc="db|sdb|sqlite";if(!preg_match("~^[^\\0]*\\.($Nc)\$~",$D)){$f->error=sprintf('Please use one of the extensions %s.',str_replace("|",", ",$Nc));return
false;}return
true;}function
create_database($k,$lb){global$f;if(file_exists($k)){$f->error='File exists.';return
false;}if(!check_sqlite_name($k))return
false;try{$A=new
Min_SQLite($k);}catch(Exception$Ec){$f->error=$Ec->getMessage();return
false;}$A->query('PRAGMA encoding = "UTF-8"');$A->query('CREATE TABLE adminer (i)');$A->query('DROP TABLE adminer');return
true;}function
drop_databases($j){global$f;$f->__construct(":memory:");foreach($j
as$k){if(!@unlink($k)){$f->error='File exists.';return
false;}}return
true;}function
rename_database($D,$lb){global$f;if(!check_sqlite_name($D))return
false;$f->__construct(":memory:");$f->error='File exists.';return@rename(DB,$D);}function
auto_increment(){return" PRIMARY KEY".(DRIVER=="sqlite"?" AUTOINCREMENT":"");}function
alter_table($Q,$D,$o,$ed,$rb,$xc,$lb,$Ka,$Sf){global$f;$Li=($Q==""||$ed);foreach($o
as$n){if($n[0]!=""||!$n[1]||$n[2]){$Li=true;break;}}$c=array();$Gf=array();foreach($o
as$n){if($n[1]){$c[]=($Li?$n[1]:"ADD ".implode($n[1]));if($n[0]!="")$Gf[$n[0]]=$n[1][0];}}if(!$Li){foreach($c
as$X){if(!queries("ALTER TABLE ".table($Q)." $X"))return
false;}if($Q!=$D&&!queries("ALTER TABLE ".table($Q)." RENAME TO ".table($D)))return
false;}elseif(!recreate_table($Q,$D,$c,$Gf,$ed,$Ka))return
false;if($Ka){queries("BEGIN");queries("UPDATE sqlite_sequence SET seq = $Ka WHERE name = ".q($D));if(!$f->affected_rows)queries("INSERT INTO sqlite_sequence (name, seq) VALUES (".q($D).", $Ka)");queries("COMMIT");}return
true;}function
recreate_table($Q,$D,$o,$Gf,$ed,$Ka,$x=array()){global$f;if($Q!=""){if(!$o){foreach(fields($Q)as$z=>$n){if($x)$n["auto_increment"]=0;$o[]=process_field($n,$n);$Gf[$z]=idf_escape($z);}}$kg=false;foreach($o
as$n){if($n[6])$kg=true;}$kc=array();foreach($x
as$z=>$X){if($X[2]=="DROP"){$kc[$X[1]]=true;unset($x[$z]);}}foreach(indexes($Q)as$fe=>$w){$e=array();foreach($w["columns"]as$z=>$d){if(!$Gf[$d])continue
2;$e[]=$Gf[$d].($w["descs"][$z]?" DESC":"");}if(!$kc[$fe]){if($w["type"]!="PRIMARY"||!$kg)$x[]=array($w["type"],$fe,$e);}}foreach($x
as$z=>$X){if($X[0]=="PRIMARY"){unset($x[$z]);$ed[]="  PRIMARY KEY (".implode(", ",$X[2]).")";}}foreach(foreign_keys($Q)as$fe=>$q){foreach($q["source"]as$z=>$d){if(!$Gf[$d])continue
2;$q["source"][$z]=idf_unescape($Gf[$d]);}if(!isset($ed[" $fe"]))$ed[]=" ".format_foreign_key($q);}queries("BEGIN");}foreach($o
as$z=>$n)$o[$z]="  ".implode($n);$o=array_merge($o,array_filter($ed));$Xh=($Q==$D?"adminer_$D":$D);if(!queries("CREATE TABLE ".table($Xh)." (\n".implode(",\n",$o)."\n)"))return
false;if($Q!=""){if($Gf&&!queries("INSERT INTO ".table($Xh)." (".implode(", ",$Gf).") SELECT ".implode(", ",array_map('idf_escape',array_keys($Gf)))." FROM ".table($Q)))return
false;$yi=array();foreach(triggers($Q)as$wi=>$ei){$vi=trigger($wi);$yi[]="CREATE TRIGGER ".idf_escape($wi)." ".implode(" ",$ei)." ON ".table($D)."\n$vi[Statement]";}$Ka=$Ka?0:$f->result("SELECT seq FROM sqlite_sequence WHERE name = ".q($Q));if(!queries("DROP TABLE ".table($Q))||($Q==$D&&!queries("ALTER TABLE ".table($Xh)." RENAME TO ".table($D)))||!alter_indexes($D,$x))return
false;if($Ka)queries("UPDATE sqlite_sequence SET seq = $Ka WHERE name = ".q($D));foreach($yi
as$vi){if(!queries($vi))return
false;}queries("COMMIT");}return
true;}function
index_sql($Q,$T,$D,$e){return"CREATE $T ".($T!="INDEX"?"INDEX ":"").idf_escape($D!=""?$D:uniqid($Q."_"))." ON ".table($Q)." $e";}function
alter_indexes($Q,$c){foreach($c
as$jg){if($jg[0]=="PRIMARY")return
recreate_table($Q,$Q,array(),array(),array(),0,$c);}foreach(array_reverse($c)as$X){if(!queries($X[2]=="DROP"?"DROP INDEX ".idf_escape($X[1]):index_sql($Q,$X[0],$X[1],"(".implode(", ",$X[2]).")")))return
false;}return
true;}function
truncate_tables($S){return
apply_queries("DELETE FROM",$S);}function
drop_views($Xi){return
apply_queries("DROP VIEW",$Xi);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
move_tables($S,$Xi,$Vh){return
false;}function
trigger($D){global$f;if($D=="")return
array("Statement"=>"BEGIN\n\t;\nEND");$v='(?:[^`"\s]+|`[^`]*`|"[^"]*")+';$xi=trigger_options();preg_match("~^CREATE\\s+TRIGGER\\s*$v\\s*(".implode("|",$xi["Timing"]).")\\s+([a-z]+)(?:\\s+OF\\s+($v))?\\s+ON\\s*$v\\s*(?:FOR\\s+EACH\\s+ROW\\s)?(.*)~is",$f->result("SELECT sql FROM sqlite_master WHERE type = 'trigger' AND name = ".q($D)),$C);$ff=$C[3];return
array("Timing"=>strtoupper($C[1]),"Event"=>strtoupper($C[2]).($ff?" OF":""),"Of"=>($ff[0]=='`'||$ff[0]=='"'?idf_unescape($ff):$ff),"Trigger"=>$D,"Statement"=>$C[4],);}function
triggers($Q){$I=array();$xi=trigger_options();foreach(get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q))as$J){preg_match('~^CREATE\s+TRIGGER\s*(?:[^`"\s]+|`[^`]*`|"[^"]*")+\s*('.implode("|",$xi["Timing"]).')\s*(.*?)\s+ON\b~i',$J["sql"],$C);$I[$J["name"]]=array($C[1],$C[2]);}return$I;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
begin(){return
queries("BEGIN");}function
last_id(){global$f;return$f->result("SELECT LAST_INSERT_ROWID()");}function
explain($f,$G){return$f->query("EXPLAIN QUERY PLAN $G");}function
found_rows($R,$Z){}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($Zg){return
true;}function
create_sql($Q,$Ka,$Gh){global$f;$I=$f->result("SELECT sql FROM sqlite_master WHERE type IN ('table', 'view') AND name = ".q($Q));foreach(indexes($Q)as$D=>$w){if($D=='')continue;$I.=";\n\n".index_sql($Q,$w['type'],$D,"(".implode(", ",array_map('idf_escape',$w['columns'])).")");}return$I;}function
truncate_sql($Q){return"DELETE FROM ".table($Q);}function
use_sql($i){}function
trigger_sql($Q){return
implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q)));}function
show_variables(){global$f;$I=array();foreach(array("auto_vacuum","cache_size","count_changes","default_cache_size","empty_result_callbacks","encoding","foreign_keys","full_column_names","fullfsync","journal_mode","journal_size_limit","legacy_file_format","locking_mode","page_size","max_page_count","read_uncommitted","recursive_triggers","reverse_unordered_selects","secure_delete","short_column_names","synchronous","temp_store","temp_store_directory","schema_version","integrity_check","quick_check")as$z)$I[$z]=$f->result("PRAGMA $z");return$I;}function
show_status(){$I=array();foreach(get_vals("PRAGMA compile_options")as$vf){list($z,$X)=explode("=",$vf,2);$I[$z]=$X;}return$I;}function
convert_field($n){}function
unconvert_field($n,$I){return$I;}function
support($Sc){return
preg_match('~^(columns|database|drop_col|dump|indexes|descidx|move_col|sql|status|table|trigger|variables|view|view_trigger)$~',$Sc);}function
driver_config(){return
array('possible_drivers'=>array((isset($_GET["sqlite"])?"SQLite3":"SQLite"),"PDO_SQLite"),'jush'=>"sqlite",'types'=>array("integer"=>0,"real"=>0,"numeric"=>0,"text"=>0,"blob"=>0),'structured_types'=>array_keys($U),'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL"),'functions'=>array("hex","length","lower","round","unixepoch","upper"),'grouping'=>array("avg","count","count distinct","group_concat","max","min","sum"),'edit_functions'=>array(array(),array("integer|real|numeric"=>"+/-","text"=>"||",)),);}}$hc["pgsql"]="PostgreSQL";if(isset($_GET["pgsql"])){define("DRIVER","pgsql");if(extension_loaded("pgsql")){class
Min_DB{var$extension="PgSQL",$_link,$_result,$_string,$_database=true,$server_info,$affected_rows,$error,$timeout;function
_error($_c,$m){if(ini_bool("html_errors"))$m=html_entity_decode(strip_tags($m));$m=preg_replace('~^[^:]*: ~','',$m);$this->error=$m;}function
connect($M,$V,$F){global$b;$k=$b->database();set_error_handler(array($this,'_error'));$this->_string="host='".str_replace(":","' port='",addcslashes($M,"'\\"))."' user='".addcslashes($V,"'\\")."' password='".addcslashes($F,"'\\")."'";$this->_link=@pg_connect("$this->_string dbname='".($k!=""?addcslashes($k,"'\\"):"postgres")."'",PGSQL_CONNECT_FORCE_NEW);if(!$this->_link&&$k!=""){$this->_database=false;$this->_link=@pg_connect("$this->_string dbname='postgres'",PGSQL_CONNECT_FORCE_NEW);}restore_error_handler();if($this->_link){$Vi=pg_version($this->_link);$this->server_info=$Vi["server"];pg_set_client_encoding($this->_link,"UTF8");}return(bool)$this->_link;}function
quote($P){return"'".pg_escape_string($this->_link,$P)."'";}function
value($X,$n){return($n["type"]=="bytea"&&$X!==null?pg_unescape_bytea($X):$X);}function
quoteBinary($P){return"'".pg_escape_bytea($this->_link,$P)."'";}function
select_db($i){global$b;if($i==$b->database())return$this->_database;$I=@pg_connect("$this->_string dbname='".addcslashes($i,"'\\")."'",PGSQL_CONNECT_FORCE_NEW);if($I)$this->_link=$I;return$I;}function
close(){$this->_link=@pg_connect("$this->_string dbname='postgres'");}function
query($G,$Ai=false){$H=@pg_query($this->_link,$G);$this->error="";if(!$H){$this->error=pg_last_error($this->_link);$I=false;}elseif(!pg_num_fields($H)){$this->affected_rows=pg_affected_rows($H);$I=true;}else$I=new
Min_Result($H);if($this->timeout){$this->timeout=0;$this->query("RESET statement_timeout");}return$I;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$n=0){$H=$this->query($G);if(!$H||!$H->num_rows)return
false;return
pg_fetch_result($H->_result,0,$n);}function
warnings(){return
h(pg_last_notice($this->_link));}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($H){$this->_result=$H;$this->num_rows=pg_num_rows($H);}function
fetch_assoc(){return
pg_fetch_assoc($this->_result);}function
fetch_row(){return
pg_fetch_row($this->_result);}function
fetch_field(){$d=$this->_offset++;$I=new
stdClass;if(function_exists('pg_field_table'))$I->orgtable=pg_field_table($this->_result,$d);$I->name=pg_field_name($this->_result,$d);$I->orgname=$I->name;$I->type=pg_field_type($this->_result,$d);$I->charsetnr=($I->type=="bytea"?63:0);return$I;}function
__destruct(){pg_free_result($this->_result);}}}elseif(extension_loaded("pdo_pgsql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_PgSQL",$timeout;function
connect($M,$V,$F){global$b;$k=$b->database();$this->dsn("pgsql:host='".str_replace(":","' port='",addcslashes($M,"'\\"))."' client_encoding=utf8 dbname='".($k!=""?addcslashes($k,"'\\"):"postgres")."'",$V,$F);return
true;}function
select_db($i){global$b;return($b->database()==$i);}function
quoteBinary($Wg){return
q($Wg);}function
query($G,$Ai=false){$I=parent::query($G,$Ai);if($this->timeout){$this->timeout=0;parent::query("RESET statement_timeout");}return$I;}function
warnings(){return'';}function
close(){}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$K,$jg){global$f;foreach($K
as$N){$Hi=array();$Z=array();foreach($N
as$z=>$X){$Hi[]="$z = $X";if(isset($jg[idf_unescape($z)]))$Z[]="$z = $X";}if(!(($Z&&queries("UPDATE ".table($Q)." SET ".implode(", ",$Hi)." WHERE ".implode(" AND ",$Z))&&$f->affected_rows)||queries("INSERT INTO ".table($Q)." (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).")")))return
false;}return
true;}function
slowQuery($G,$di){$this->_conn->query("SET statement_timeout = ".(1000*$di));$this->_conn->timeout=1000*$di;return$G;}function
convertSearch($v,$X,$n){return(preg_match('~char|text'.(!preg_match('~LIKE~',$X["op"])?'|date|time(stamp)?|boolean|uuid|'.number_type():'').'~',$n["type"])?$v:"CAST($v AS text)");}function
quoteBinary($Wg){return$this->_conn->quoteBinary($Wg);}function
warnings(){return$this->_conn->warnings();}function
tableHelp($D){$ve=array("information_schema"=>"infoschema","pg_catalog"=>"catalog",);$A=$ve[$_GET["ns"]];if($A)return"$A-".str_replace("_","-",$D).".html";}}function
idf_escape($v){return'"'.str_replace('"','""',$v).'"';}function
table($v){return
idf_escape($v);}function
connect(){global$b,$U,$Fh;$f=new
Min_DB;$Kb=$b->credentials();if($f->connect($Kb[0],$Kb[1],$Kb[2])){if(min_version(9,0,$f)){$f->query("SET application_name = 'Adminer'");if(min_version(9.2,0,$f)){$Fh['Strings'][]="json";$U["json"]=4294967295;if(min_version(9.4,0,$f)){$Fh['Strings'][]="jsonb";$U["jsonb"]=4294967295;}}}return$f;}return$f->error;}function
get_databases(){return
get_vals("SELECT datname FROM pg_database WHERE has_database_privilege(datname, 'CONNECT') ORDER BY datname");}function
limit($G,$Z,$_,$gf=0,$gh=" "){return" $G$Z".($_!==null?$gh."LIMIT $_".($gf?" OFFSET $gf":""):"");}function
limit1($Q,$G,$Z,$gh="\n"){return(preg_match('~^INTO~',$G)?limit($G,$Z,1,0,$gh):" $G".(is_view(table_status1($Q))?$Z:" WHERE ctid = (SELECT ctid FROM ".table($Q).$Z.$gh."LIMIT 1)"));}function
db_collation($k,$mb){global$f;return$f->result("SELECT datcollate FROM pg_database WHERE datname = ".q($k));}function
engines(){return
array();}function
logged_user(){global$f;return$f->result("SELECT user");}function
tables_list(){$G="SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema()";if(support('materializedview'))$G.="
UNION ALL
SELECT matviewname, 'MATERIALIZED VIEW'
FROM pg_matviews
WHERE schemaname = current_schema()";$G.="
ORDER BY 1";return
get_key_vals($G);}function
count_tables($j){return
array();}function
table_status($D=""){$I=array();foreach(get_rows("SELECT c.relname AS \"Name\", CASE c.relkind WHEN 'r' THEN 'table' WHEN 'm' THEN 'materialized view' ELSE 'view' END AS \"Engine\", pg_relation_size(c.oid) AS \"Data_length\", pg_total_relation_size(c.oid) - pg_relation_size(c.oid) AS \"Index_length\", obj_description(c.oid, 'pg_class') AS \"Comment\", ".(min_version(12)?"''":"CASE WHEN c.relhasoids THEN 'oid' ELSE '' END")." AS \"Oid\", c.reltuples as \"Rows\", n.nspname
FROM pg_class c
JOIN pg_namespace n ON(n.nspname = current_schema() AND n.oid = c.relnamespace)
WHERE relkind IN ('r', 'm', 'v', 'f', 'p')
".($D!=""?"AND relname = ".q($D):"ORDER BY relname"))as$J)$I[$J["Name"]]=$J;return($D!=""?$I[$D]:$I);}function
is_view($R){return
in_array($R["Engine"],array("view","materialized view"));}function
fk_support($R){return
true;}function
fields($Q){$I=array();$Ba=array('timestamp without time zone'=>'timestamp','timestamp with time zone'=>'timestamptz',);$Ed=min_version(10)?'a.attidentity':'0';foreach(get_rows("SELECT a.attname AS field, format_type(a.atttypid, a.atttypmod) AS full_type, pg_get_expr(d.adbin, d.adrelid) AS default, a.attnotnull::int, col_description(c.oid, a.attnum) AS comment, $Ed AS identity
FROM pg_class c
JOIN pg_namespace n ON c.relnamespace = n.oid
JOIN pg_attribute a ON c.oid = a.attrelid
LEFT JOIN pg_attrdef d ON c.oid = d.adrelid AND a.attnum = d.adnum
WHERE c.relname = ".q($Q)."
AND n.nspname = current_schema()
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum")as$J){preg_match('~([^([]+)(\((.*)\))?([a-z ]+)?((\[[0-9]*])*)$~',$J["full_type"],$C);list(,$T,$se,$J["length"],$wa,$Ea)=$C;$J["length"].=$Ea;$bb=$T.$wa;if(isset($Ba[$bb])){$J["type"]=$Ba[$bb];$J["full_type"]=$J["type"].$se.$Ea;}else{$J["type"]=$T;$J["full_type"]=$J["type"].$se.$wa.$Ea;}if(in_array($J['identity'],array('a','d')))$J['default']='GENERATED '.($J['identity']=='d'?'BY DEFAULT':'ALWAYS').' AS IDENTITY';$J["null"]=!$J["attnotnull"];$J["auto_increment"]=$J['identity']||preg_match('~^nextval\(~i',$J["default"]);$J["privileges"]=array("insert"=>1,"select"=>1,"update"=>1);if(preg_match('~(.+)::[^,)]+(.*)~',$J["default"],$C))$J["default"]=($C[1]=="NULL"?null:(($C[1][0]=="'"?idf_unescape($C[1]):$C[1]).$C[2]));$I[$J["field"]]=$J;}return$I;}function
indexes($Q,$g=null){global$f;if(!is_object($g))$g=$f;$I=array();$Oh=$g->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($Q));$e=get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $Oh AND attnum > 0",$g);foreach(get_rows("SELECT relname, indisunique::int, indisprimary::int, indkey, indoption, (indpred IS NOT NULL)::int as indispartial FROM pg_index i, pg_class ci WHERE i.indrelid = $Oh AND ci.oid = i.indexrelid",$g)as$J){$Gg=$J["relname"];$I[$Gg]["type"]=($J["indispartial"]?"INDEX":($J["indisprimary"]?"PRIMARY":($J["indisunique"]?"UNIQUE":"INDEX")));$I[$Gg]["columns"]=array();foreach(explode(" ",$J["indkey"])as$Od)$I[$Gg]["columns"][]=$e[$Od];$I[$Gg]["descs"]=array();foreach(explode(" ",$J["indoption"])as$Pd)$I[$Gg]["descs"][]=($Pd&1?'1':null);$I[$Gg]["lengths"]=array();}return$I;}function
foreign_keys($Q){global$of;$I=array();foreach(get_rows("SELECT conname, condeferrable::int AS deferrable, pg_get_constraintdef(oid) AS definition
FROM pg_constraint
WHERE conrelid = (SELECT pc.oid FROM pg_class AS pc INNER JOIN pg_namespace AS pn ON (pn.oid = pc.relnamespace) WHERE pc.relname = ".q($Q)." AND pn.nspname = current_schema())
AND contype = 'f'::char
ORDER BY conkey, conname")as$J){if(preg_match('~FOREIGN KEY\s*\((.+)\)\s*REFERENCES (.+)\((.+)\)(.*)$~iA',$J['definition'],$C)){$J['source']=array_map('trim',explode(',',$C[1]));if(preg_match('~^(("([^"]|"")+"|[^"]+)\.)?"?("([^"]|"")+"|[^"]+)$~',$C[2],$Ae)){$J['ns']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$Ae[2]));$J['table']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$Ae[4]));}$J['target']=array_map('trim',explode(',',$C[3]));$J['on_delete']=(preg_match("~ON DELETE ($of)~",$C[4],$Ae)?$Ae[1]:'NO ACTION');$J['on_update']=(preg_match("~ON UPDATE ($of)~",$C[4],$Ae)?$Ae[1]:'NO ACTION');$I[$J['conname']]=$J;}}return$I;}function
constraints($Q){global$of;$I=array();foreach(get_rows("SELECT conname, consrc
FROM pg_catalog.pg_constraint
INNER JOIN pg_catalog.pg_namespace ON pg_constraint.connamespace = pg_namespace.oid
INNER JOIN pg_catalog.pg_class ON pg_constraint.conrelid = pg_class.oid AND pg_constraint.connamespace = pg_class.relnamespace
WHERE pg_constraint.contype = 'c'
AND conrelid != 0 -- handle only CONSTRAINTs here, not TYPES
AND nspname = current_schema()
AND relname = ".q($Q)."
ORDER BY connamespace, conname")as$J)$I[$J['conname']]=$J['consrc'];return$I;}function
adm_view($D){global$f;return
array("select"=>trim($f->result("SELECT pg_get_viewdef(".$f->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($D)).")")));}function
collations(){return
array();}function
information_schema($k){return($k=="information_schema");}function
error(){global$f;$I=h($f->error);if(preg_match('~^(.*\n)?([^\n]*)\n( *)\^(\n.*)?$~s',$I,$C))$I=$C[1].preg_replace('~((?:[^&]|&[^;]*;){'.strlen($C[3]).'})(.*)~','\1<b>\2</b>',$C[2]).$C[4];return
nl_br($I);}function
create_database($k,$lb){return
queries("CREATE DATABASE ".idf_escape($k).($lb?" ENCODING ".idf_escape($lb):""));}function
drop_databases($j){global$f;$f->close();return
apply_queries("DROP DATABASE",$j,'idf_escape');}function
rename_database($D,$lb){return
queries("ALTER DATABASE ".idf_escape(DB)." RENAME TO ".idf_escape($D));}function
auto_increment(){return"";}function
alter_table($Q,$D,$o,$ed,$rb,$xc,$lb,$Ka,$Sf){$c=array();$ug=array();if($Q!=""&&$Q!=$D)$ug[]="ALTER TABLE ".table($Q)." RENAME TO ".table($D);foreach($o
as$n){$d=idf_escape($n[0]);$X=$n[1];if(!$X)$c[]="DROP $d";else{$Ri=$X[5];unset($X[5]);if($n[0]==""){if(isset($X[6]))$X[1]=($X[1]==" bigint"?" big":($X[1]==" smallint"?" small":" "))."serial";$c[]=($Q!=""?"ADD ":"  ").implode($X);if(isset($X[6]))$c[]=($Q!=""?"ADD":" ")." PRIMARY KEY ($X[0])";}else{if($d!=$X[0])$ug[]="ALTER TABLE ".table($D)." RENAME $d TO $X[0]";$c[]="ALTER $d TYPE$X[1]";if(!$X[6]){$c[]="ALTER $d ".($X[3]?"SET$X[3]":"DROP DEFAULT");$c[]="ALTER $d ".($X[2]==" NULL"?"DROP NOT":"SET").$X[2];}}if($n[0]!=""||$Ri!="")$ug[]="COMMENT ON COLUMN ".table($D).".$X[0] IS ".($Ri!=""?substr($Ri,9):"''");}}$c=array_merge($c,$ed);if($Q=="")array_unshift($ug,"CREATE TABLE ".table($D)." (\n".implode(",\n",$c)."\n)");elseif($c)array_unshift($ug,"ALTER TABLE ".table($Q)."\n".implode(",\n",$c));if($Q!=""||$rb!="")$ug[]="COMMENT ON TABLE ".table($D)." IS ".q($rb);if($Ka!=""){}foreach($ug
as$G){if(!queries($G))return
false;}return
true;}function
alter_indexes($Q,$c){$h=array();$ic=array();$ug=array();foreach($c
as$X){if($X[0]!="INDEX")$h[]=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");elseif($X[2]=="DROP")$ic[]=idf_escape($X[1]);else$ug[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q)." (".implode(", ",$X[2]).")";}if($h)array_unshift($ug,"ALTER TABLE ".table($Q).implode(",",$h));if($ic)array_unshift($ug,"DROP INDEX ".implode(", ",$ic));foreach($ug
as$G){if(!queries($G))return
false;}return
true;}function
truncate_tables($S){return
queries("TRUNCATE ".implode(", ",array_map('table',$S)));return
true;}function
drop_views($Xi){return
drop_tables($Xi);}function
drop_tables($S){foreach($S
as$Q){$O=table_status($Q);if(!queries("DROP ".strtoupper($O["Engine"])." ".table($Q)))return
false;}return
true;}function
move_tables($S,$Xi,$Vh){foreach(array_merge($S,$Xi)as$Q){$O=table_status($Q);if(!queries("ALTER ".strtoupper($O["Engine"])." ".table($Q)." SET SCHEMA ".idf_escape($Vh)))return
false;}return
true;}function
trigger($D,$Q=null){if($D=="")return
array("Statement"=>"EXECUTE PROCEDURE ()");if($Q===null)$Q=$_GET['trigger'];$K=get_rows('SELECT t.trigger_name AS "Trigger", t.action_timing AS "Timing", (SELECT STRING_AGG(event_manipulation, \' OR \') FROM information_schema.triggers WHERE event_object_table = t.event_object_table AND trigger_name = t.trigger_name ) AS "Events", t.event_manipulation AS "Event", \'FOR EACH \' || t.action_orientation AS "Type", t.action_statement AS "Statement" FROM information_schema.triggers t WHERE t.event_object_table = '.q($Q).' AND t.trigger_name = '.q($D));return
reset($K);}function
triggers($Q){$I=array();foreach(get_rows("SELECT * FROM information_schema.triggers WHERE trigger_schema = current_schema() AND event_object_table = ".q($Q))as$J)$I[$J["trigger_name"]]=array($J["action_timing"],$J["event_manipulation"]);return$I;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW","FOR EACH STATEMENT"),);}function
routine($D,$T){$K=get_rows('SELECT routine_definition AS definition, LOWER(external_language) AS language, *
FROM information_schema.routines
WHERE routine_schema = current_schema() AND specific_name = '.q($D));$I=$K[0];$I["returns"]=array("type"=>$I["type_udt_name"]);$I["fields"]=get_rows('SELECT parameter_name AS field, data_type AS type, character_maximum_length AS length, parameter_mode AS inout
FROM information_schema.parameters
WHERE specific_schema = current_schema() AND specific_name = '.q($D).'
ORDER BY ordinal_position');return$I;}function
routines(){return
get_rows('SELECT specific_name AS "SPECIFIC_NAME", routine_type AS "ROUTINE_TYPE", routine_name AS "ROUTINE_NAME", type_udt_name AS "DTD_IDENTIFIER"
FROM information_schema.routines
WHERE routine_schema = current_schema()
ORDER BY SPECIFIC_NAME');}function
routine_languages(){return
get_vals("SELECT LOWER(lanname) FROM pg_catalog.pg_language");}function
routine_id($D,$J){$I=array();foreach($J["fields"]as$n)$I[]=$n["type"];return
idf_escape($D)."(".implode(", ",$I).")";}function
last_id(){return
0;}function
explain($f,$G){return$f->query("EXPLAIN $G");}function
found_rows($R,$Z){global$f;if(preg_match("~ rows=([0-9]+)~",$f->result("EXPLAIN SELECT * FROM ".idf_escape($R["Name"]).($Z?" WHERE ".implode(" AND ",$Z):"")),$Fg))return$Fg[1];return
false;}function
types(){return
get_vals("SELECT typname
FROM pg_type
WHERE typnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())
AND typtype IN ('b','d','e')
AND typelem = 0");}function
schemas(){return
get_vals("SELECT nspname FROM pg_namespace ORDER BY nspname");}function
get_schema(){global$f;return$f->result("SELECT current_schema()");}function
set_schema($Yg,$g=null){global$f,$U,$Fh;if(!$g)$g=$f;$I=$g->query("SET search_path TO ".idf_escape($Yg));foreach(types()as$T){if(!isset($U[$T])){$U[$T]=0;$Fh['User types'][]=$T;}}return$I;}function
foreign_keys_sql($Q){$I="";$O=table_status($Q);$bd=foreign_keys($Q);ksort($bd);foreach($bd
as$ad=>$Zc)$I.="ALTER TABLE ONLY ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." ADD CONSTRAINT ".idf_escape($ad)." $Zc[definition] ".($Zc['deferrable']?'DEFERRABLE':'NOT DEFERRABLE').";\n";return($I?"$I\n":$I);}function
create_sql($Q,$Ka,$Gh){global$f;$I='';$Og=array();$ih=array();$O=table_status($Q);if(is_view($O)){$Wi=adm_view($Q);return
rtrim("CREATE VIEW ".idf_escape($Q)." AS $Wi[select]",";");}$o=fields($Q);$x=indexes($Q);ksort($x);$Ab=constraints($Q);if(!$O||empty($o))return
false;$I="CREATE TABLE ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." (\n    ";foreach($o
as$Uc=>$n){$Pf=idf_escape($n['field']).' '.$n['full_type'].default_value($n).($n['attnotnull']?" NOT NULL":"");$Og[]=$Pf;if(preg_match('~nextval\(\'([^\']+)\'\)~',$n['default'],$Be)){$hh=$Be[1];$wh=reset(get_rows(min_version(10)?"SELECT *, cache_size AS cache_value FROM pg_sequences WHERE schemaname = current_schema() AND sequencename = ".q($hh):"SELECT * FROM $hh"));$ih[]=($Gh=="DROP+CREATE"?"DROP SEQUENCE IF EXISTS $hh;\n":"")."CREATE SEQUENCE $hh INCREMENT $wh[increment_by] MINVALUE $wh[min_value] MAXVALUE $wh[max_value]".($Ka&&$wh['last_value']?" START $wh[last_value]":"")." CACHE $wh[cache_value];";}}if(!empty($ih))$I=implode("\n\n",$ih)."\n\n$I";foreach($x
as$Jd=>$w){switch($w['type']){case'UNIQUE':$Og[]="CONSTRAINT ".idf_escape($Jd)." UNIQUE (".implode(', ',array_map('idf_escape',$w['columns'])).")";break;case'PRIMARY':$Og[]="CONSTRAINT ".idf_escape($Jd)." PRIMARY KEY (".implode(', ',array_map('idf_escape',$w['columns'])).")";break;}}foreach($Ab
as$xb=>$zb)$Og[]="CONSTRAINT ".idf_escape($xb)." CHECK $zb";$I.=implode(",\n    ",$Og)."\n) WITH (oids = ".($O['Oid']?'true':'false').");";foreach($x
as$Jd=>$w){if($w['type']=='INDEX'){$e=array();foreach($w['columns']as$z=>$X)$e[]=idf_escape($X).($w['descs'][$z]?" DESC":"");$I.="\n\nCREATE INDEX ".idf_escape($Jd)." ON ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." USING btree (".implode(', ',$e).");";}}if($O['Comment'])$I.="\n\nCOMMENT ON TABLE ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." IS ".q($O['Comment']).";";foreach($o
as$Uc=>$n){if($n['comment'])$I.="\n\nCOMMENT ON COLUMN ".idf_escape($O['nspname']).".".idf_escape($O['Name']).".".idf_escape($Uc)." IS ".q($n['comment']).";";}return
rtrim($I,';');}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
trigger_sql($Q){$O=table_status($Q);$I="";foreach(triggers($Q)as$ui=>$ti){$vi=trigger($ui,$O['Name']);$I.="\nCREATE TRIGGER ".idf_escape($vi['Trigger'])." $vi[Timing] $vi[Events] ON ".idf_escape($O["nspname"]).".".idf_escape($O['Name'])." $vi[Type] $vi[Statement];;\n";}return$I;}function
use_sql($i){return"\connect ".idf_escape($i);}function
show_variables(){return
get_key_vals("SHOW ALL");}function
process_list(){return
get_rows("SELECT * FROM pg_stat_activity ORDER BY ".(min_version(9.2)?"pid":"procpid"));}function
show_status(){}function
convert_field($n){}function
unconvert_field($n,$I){return$I;}function
support($Sc){return
preg_match('~^(database|table|columns|sql|indexes|descidx|comment|view|'.(min_version(9.3)?'materializedview|':'').'scheme|routine|processlist|sequence|trigger|type|variables|drop_col|kill|dump)$~',$Sc);}function
kill_process($X){return
queries("SELECT pg_terminate_backend(".number($X).")");}function
connection_id(){return"SELECT pg_backend_pid()";}function
max_connections(){global$f;return$f->result("SHOW max_connections");}function
driver_config(){$U=array();$Fh=array();foreach(array('Numbers'=>array("smallint"=>5,"integer"=>10,"bigint"=>19,"boolean"=>1,"numeric"=>0,"real"=>7,"double precision"=>16,"money"=>20),'Date and time'=>array("date"=>13,"time"=>17,"timestamp"=>20,"timestamptz"=>21,"interval"=>0),'Strings'=>array("character"=>0,"character varying"=>0,"text"=>0,"tsquery"=>0,"tsvector"=>0,"uuid"=>0,"xml"=>0),'Binary'=>array("bit"=>0,"bit varying"=>0,"bytea"=>0),'Network'=>array("cidr"=>43,"inet"=>43,"macaddr"=>17,"txid_snapshot"=>0),'Geometry'=>array("box"=>0,"circle"=>0,"line"=>0,"lseg"=>0,"path"=>0,"point"=>0,"polygon"=>0),)as$z=>$X){$U+=$X;$Fh[$z]=array_keys($X);}return
array('possible_drivers'=>array("PgSQL","PDO_PgSQL"),'jush'=>"pgsql",'types'=>$U,'structured_types'=>$Fh,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","ILIKE","ILIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL"),'functions'=>array("char_length","lower","round","to_hex","to_timestamp","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("char"=>"md5","date|time"=>"now",),array(number_type()=>"+/-","date|time"=>"+ interval/- interval","char|text"=>"||",)),);}}$hc["oracle"]="Oracle (beta)";if(isset($_GET["oracle"])){define("DRIVER","oracle");if(extension_loaded("oci8")){class
Min_DB{var$extension="oci8",$_link,$_result,$server_info,$affected_rows,$errno,$error;var$_current_db;function
_error($_c,$m){if(ini_bool("html_errors"))$m=html_entity_decode(strip_tags($m));$m=preg_replace('~^[^:]*: ~','',$m);$this->error=$m;}function
connect($M,$V,$F){$this->_link=@oci_new_connect($V,$F,$M,"AL32UTF8");if($this->_link){$this->server_info=oci_server_version($this->_link);return
true;}$m=oci_error();$this->error=$m["message"];return
false;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($i){$this->_current_db=$i;return
true;}function
query($G,$Ai=false){$H=oci_parse($this->_link,$G);$this->error="";if(!$H){$m=oci_error($this->_link);$this->errno=$m["code"];$this->error=$m["message"];return
false;}set_error_handler(array($this,'_error'));$I=@oci_execute($H);restore_error_handler();if($I){if(oci_num_fields($H))return
new
Min_Result($H);$this->affected_rows=oci_num_rows($H);oci_free_statement($H);}return$I;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$n=1){$H=$this->query($G);if(!is_object($H)||!oci_fetch($H->_result))return
false;return
oci_result($H->_result,$n);}}class
Min_Result{var$_result,$_offset=1,$num_rows;function
__construct($H){$this->_result=$H;}function
_convert($J){foreach((array)$J
as$z=>$X){if(is_a($X,'OCI-Lob'))$J[$z]=$X->load();}return$J;}function
fetch_assoc(){return$this->_convert(oci_fetch_assoc($this->_result));}function
fetch_row(){return$this->_convert(oci_fetch_row($this->_result));}function
fetch_field(){$d=$this->_offset++;$I=new
stdClass;$I->name=oci_field_name($this->_result,$d);$I->orgname=$I->name;$I->type=oci_field_type($this->_result,$d);$I->charsetnr=(preg_match("~raw|blob|bfile~",$I->type)?63:0);return$I;}function
__destruct(){oci_free_statement($this->_result);}}}elseif(extension_loaded("pdo_oci")){class
Min_DB
extends
Min_PDO{var$extension="PDO_OCI";var$_current_db;function
connect($M,$V,$F){$this->dsn("oci:dbname=//$M;charset=AL32UTF8",$V,$F);return
true;}function
select_db($i){$this->_current_db=$i;return
true;}}}class
Min_Driver
extends
Min_SQL{function
begin(){return
true;}function
insertUpdate($Q,$K,$jg){global$f;foreach($K
as$N){$Hi=array();$Z=array();foreach($N
as$z=>$X){$Hi[]="$z = $X";if(isset($jg[idf_unescape($z)]))$Z[]="$z = $X";}if(!(($Z&&queries("UPDATE ".table($Q)." SET ".implode(", ",$Hi)." WHERE ".implode(" AND ",$Z))&&$f->affected_rows)||queries("INSERT INTO ".table($Q)." (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).")")))return
false;}return
true;}}function
idf_escape($v){return'"'.str_replace('"','""',$v).'"';}function
table($v){return
idf_escape($v);}function
connect(){global$b;$f=new
Min_DB;$Kb=$b->credentials();if($f->connect($Kb[0],$Kb[1],$Kb[2]))return$f;return$f->error;}function
get_databases(){return
get_vals("SELECT tablespace_name FROM user_tablespaces ORDER BY 1");}function
limit($G,$Z,$_,$gf=0,$gh=" "){return($gf?" * FROM (SELECT t.*, rownum AS rnum FROM (SELECT $G$Z) t WHERE rownum <= ".($_+$gf).") WHERE rnum > $gf":($_!==null?" * FROM (SELECT $G$Z) WHERE rownum <= ".($_+$gf):" $G$Z"));}function
limit1($Q,$G,$Z,$gh="\n"){return" $G$Z";}function
db_collation($k,$mb){global$f;return$f->result("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");}function
engines(){return
array();}function
logged_user(){global$f;return$f->result("SELECT USER FROM DUAL");}function
get_current_db(){global$f;$k=$f->_current_db?$f->_current_db:DB;unset($f->_current_db);return$k;}function
where_owner($hg,$Jf="owner"){if(!$_GET["ns"])return'';return"$hg$Jf = sys_context('USERENV', 'CURRENT_SCHEMA')";}function
views_table($e){$Jf=where_owner('');return"(SELECT $e FROM all_views WHERE ".($Jf?$Jf:"rownum < 0").")";}function
tables_list(){$Wi=views_table("view_name");$Jf=where_owner(" AND ");return
get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = ".q(DB)."$Jf
UNION SELECT view_name, 'view' FROM $Wi
ORDER BY 1");}function
count_tables($j){global$f;$I=array();foreach($j
as$k)$I[$k]=$f->result("SELECT COUNT(*) FROM all_tables WHERE tablespace_name = ".q($k));return$I;}function
table_status($D=""){$I=array();$ah=q($D);$k=get_current_db();$Wi=views_table("view_name");$Jf=where_owner(" AND ");foreach(get_rows('SELECT table_name "Name", \'table\' "Engine", avg_row_len * num_rows "Data_length", num_rows "Rows" FROM all_tables WHERE tablespace_name = '.q($k).$Jf.($D!=""?" AND table_name = $ah":"")."
UNION SELECT view_name, 'view', 0, 0 FROM $Wi".($D!=""?" WHERE view_name = $ah":"")."
ORDER BY 1")as$J){if($D!="")return$J;$I[$J["Name"]]=$J;}return$I;}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){return
true;}function
fields($Q){$I=array();$Jf=where_owner(" AND ");foreach(get_rows("SELECT * FROM all_tab_columns WHERE table_name = ".q($Q)."$Jf ORDER BY column_id")as$J){$T=$J["DATA_TYPE"];$se="$J[DATA_PRECISION],$J[DATA_SCALE]";if($se==",")$se=$J["CHAR_COL_DECL_LENGTH"];$I[$J["COLUMN_NAME"]]=array("field"=>$J["COLUMN_NAME"],"full_type"=>$T.($se?"($se)":""),"type"=>strtolower($T),"length"=>$se,"default"=>$J["DATA_DEFAULT"],"null"=>($J["NULLABLE"]=="Y"),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);}return$I;}function
indexes($Q,$g=null){$I=array();$Jf=where_owner(" AND ","aic.table_owner");foreach(get_rows("SELECT aic.*, ac.constraint_type
FROM all_ind_columns aic
LEFT JOIN all_constraints ac ON aic.index_name = ac.constraint_name AND aic.table_name = ac.table_name AND aic.index_owner = ac.owner
WHERE aic.table_name = ".q($Q)."$Jf
ORDER BY ac.constraint_type, aic.column_position",$g)as$J){$Jd=$J["INDEX_NAME"];$I[$Jd]["type"]=($J["CONSTRAINT_TYPE"]=="P"?"PRIMARY":($J["CONSTRAINT_TYPE"]=="U"?"UNIQUE":"INDEX"));$I[$Jd]["columns"][]=$J["COLUMN_NAME"];$I[$Jd]["lengths"][]=($J["CHAR_LENGTH"]&&$J["CHAR_LENGTH"]!=$J["COLUMN_LENGTH"]?$J["CHAR_LENGTH"]:null);$I[$Jd]["descs"][]=($J["DESCEND"]?'1':null);}return$I;}function
adm_view($D){$Wi=views_table("view_name, text");$K=get_rows('SELECT text "select" FROM '.$Wi.' WHERE view_name = '.q($D));return
reset($K);}function
collations(){return
array();}function
information_schema($k){return
false;}function
error(){global$f;return
h($f->error);}function
explain($f,$G){$f->query("EXPLAIN PLAN FOR $G");return$f->query("SELECT * FROM plan_table");}function
found_rows($R,$Z){}function
auto_increment(){return"";}function
alter_table($Q,$D,$o,$ed,$rb,$xc,$lb,$Ka,$Sf){$c=$ic=array();$Df=($Q?fields($Q):array());foreach($o
as$n){$X=$n[1];if($X&&$n[0]!=""&&idf_escape($n[0])!=$X[0])queries("ALTER TABLE ".table($Q)." RENAME COLUMN ".idf_escape($n[0])." TO $X[0]");$Cf=$Df[$n[0]];if($X&&$Cf){$if=process_field($Cf,$Cf);if($X[2]==$if[2])$X[2]="";}if($X)$c[]=($Q!=""?($n[0]!=""?"MODIFY (":"ADD ("):"  ").implode($X).($Q!=""?")":"");else$ic[]=idf_escape($n[0]);}if($Q=="")return
queries("CREATE TABLE ".table($D)." (\n".implode(",\n",$c)."\n)");return(!$c||queries("ALTER TABLE ".table($Q)."\n".implode("\n",$c)))&&(!$ic||queries("ALTER TABLE ".table($Q)." DROP (".implode(", ",$ic).")"))&&($Q==$D||queries("ALTER TABLE ".table($Q)." RENAME TO ".table($D)));}function
alter_indexes($Q,$c){$h=array();$ic=array();$ug=array();foreach($c
as$X){$X[2]=preg_replace('~ DESC$~','',$X[2]);if($X[0]!="INDEX")$h[]=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");elseif($X[2]=="DROP")$ic[]=idf_escape($X[1]);else$ug[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q)." (".implode(", ",$X[2]).")";}if($h)array_unshift($ug,"ALTER TABLE ".table($Q).implode(",",$h));if($ic)array_unshift($ug,"DROP INDEX ".implode(", ",$ic));foreach($ug
as$G){if(!queries($G))return
false;}return
true;}function
foreign_keys($Q){$I=array();$G="SELECT c_list.CONSTRAINT_NAME as NAME,
c_src.COLUMN_NAME as SRC_COLUMN,
c_dest.OWNER as DEST_DB,
c_dest.TABLE_NAME as DEST_TABLE,
c_dest.COLUMN_NAME as DEST_COLUMN,
c_list.DELETE_RULE as ON_DELETE
FROM ALL_CONSTRAINTS c_list, ALL_CONS_COLUMNS c_src, ALL_CONS_COLUMNS c_dest
WHERE c_list.CONSTRAINT_NAME = c_src.CONSTRAINT_NAME
AND c_list.R_CONSTRAINT_NAME = c_dest.CONSTRAINT_NAME
AND c_list.CONSTRAINT_TYPE = 'R'
AND c_src.TABLE_NAME = ".q($Q);foreach(get_rows($G)as$J)$I[$J['NAME']]=array("db"=>$J['DEST_DB'],"table"=>$J['DEST_TABLE'],"source"=>array($J['SRC_COLUMN']),"target"=>array($J['DEST_COLUMN']),"on_delete"=>$J['ON_DELETE'],"on_update"=>null,);return$I;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Xi){return
apply_queries("DROP VIEW",$Xi);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
last_id(){return
0;}function
schemas(){$I=get_vals("SELECT DISTINCT owner FROM dba_segments WHERE owner IN (SELECT username FROM dba_users WHERE default_tablespace NOT IN ('SYSTEM','SYSAUX')) ORDER BY 1");return($I?$I:get_vals("SELECT DISTINCT owner FROM all_tables WHERE tablespace_name = ".q(DB)." ORDER BY 1"));}function
get_schema(){global$f;return$f->result("SELECT sys_context('USERENV', 'SESSION_USER') FROM dual");}function
set_schema($Zg,$g=null){global$f;if(!$g)$g=$f;return$g->query("ALTER SESSION SET CURRENT_SCHEMA = ".idf_escape($Zg));}function
show_variables(){return
get_key_vals('SELECT name, display_value FROM v$parameter');}function
process_list(){return
get_rows('SELECT sess.process AS "process", sess.username AS "user", sess.schemaname AS "schema", sess.status AS "status", sess.wait_class AS "wait_class", sess.seconds_in_wait AS "seconds_in_wait", sql.sql_text AS "sql_text", sess.machine AS "machine", sess.port AS "port"
FROM v$session sess LEFT OUTER JOIN v$sql sql
ON sql.sql_id = sess.sql_id
WHERE sess.type = \'USER\'
ORDER BY PROCESS
');}function
show_status(){$K=get_rows('SELECT * FROM v$instance');return
reset($K);}function
convert_field($n){}function
unconvert_field($n,$I){return$I;}function
support($Sc){return
preg_match('~^(columns|database|drop_col|indexes|descidx|processlist|scheme|sql|status|table|variables|view)$~',$Sc);}function
driver_config(){$U=array();$Fh=array();foreach(array('Numbers'=>array("number"=>38,"binary_float"=>12,"binary_double"=>21),'Date and time'=>array("date"=>10,"timestamp"=>29,"interval year"=>12,"interval day"=>28),'Strings'=>array("char"=>2000,"varchar2"=>4000,"nchar"=>2000,"nvarchar2"=>4000,"clob"=>4294967295,"nclob"=>4294967295),'Binary'=>array("raw"=>2000,"long raw"=>2147483648,"blob"=>4294967295,"bfile"=>4294967296),)as$z=>$X){$U+=$X;$Fh[$z]=array_keys($X);}return
array('possible_drivers'=>array("OCI8","PDO_OCI"),'jush'=>"oracle",'types'=>$U,'structured_types'=>$Fh,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL"),'functions'=>array("length","lower","round","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("date"=>"current_date","timestamp"=>"current_timestamp",),array("number|float|double"=>"+/-","date|timestamp"=>"+ interval/- interval","char|clob"=>"||",)),);}}$hc["mssql"]="MS SQL (beta)";if(isset($_GET["mssql"])){define("DRIVER","mssql");if(extension_loaded("sqlsrv")){class
Min_DB{var$extension="sqlsrv",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_get_error(){$this->error="";foreach(sqlsrv_errors()as$m){$this->errno=$m["code"];$this->error.="$m[message]\n";}$this->error=rtrim($this->error);}function
connect($M,$V,$F){global$b;$k=$b->database();$yb=array("UID"=>$V,"PWD"=>$F,"CharacterSet"=>"UTF-8");if($k!="")$yb["Database"]=$k;$this->_link=@sqlsrv_connect(preg_replace('~:~',',',$M),$yb);if($this->_link){$Qd=sqlsrv_server_info($this->_link);$this->server_info=$Qd['SQLServerVersion'];}else$this->_get_error();return(bool)$this->_link;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($i){return$this->query("USE ".idf_escape($i));}function
query($G,$Ai=false){$H=sqlsrv_query($this->_link,$G);$this->error="";if(!$H){$this->_get_error();return
false;}return$this->store_result($H);}function
multi_query($G){$this->_result=sqlsrv_query($this->_link,$G);$this->error="";if(!$this->_result){$this->_get_error();return
false;}return
true;}function
store_result($H=null){if(!$H)$H=$this->_result;if(!$H)return
false;if(sqlsrv_field_metadata($H))return
new
Min_Result($H);$this->affected_rows=sqlsrv_rows_affected($H);return
true;}function
next_result(){return$this->_result?sqlsrv_next_result($this->_result):null;}function
result($G,$n=0){$H=$this->query($G);if(!is_object($H))return
false;$J=$H->fetch_row();return$J[$n];}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($H){$this->_result=$H;}function
_convert($J){foreach((array)$J
as$z=>$X){if(is_a($X,'DateTime'))$J[$z]=$X->format("Y-m-d H:i:s");}return$J;}function
fetch_assoc(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_ASSOC));}function
fetch_row(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_NUMERIC));}function
fetch_field(){if(!$this->_fields)$this->_fields=sqlsrv_field_metadata($this->_result);$n=$this->_fields[$this->_offset++];$I=new
stdClass;$I->name=$n["Name"];$I->orgname=$n["Name"];$I->type=($n["Type"]==1?254:0);return$I;}function
seek($gf){for($t=0;$t<$gf;$t++)sqlsrv_fetch($this->_result);}function
__destruct(){sqlsrv_free_stmt($this->_result);}}}elseif(extension_loaded("mssql")){class
Min_DB{var$extension="MSSQL",$_link,$_result,$server_info,$affected_rows,$error;function
connect($M,$V,$F){$this->_link=@mssql_connect($M,$V,$F);if($this->_link){$H=$this->query("SELECT SERVERPROPERTY('ProductLevel'), SERVERPROPERTY('Edition')");if($H){$J=$H->fetch_row();$this->server_info=$this->result("sp_server_info 2",2)." [$J[0]] $J[1]";}}else$this->error=mssql_get_last_message();return(bool)$this->_link;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($i){return
mssql_select_db($i);}function
query($G,$Ai=false){$H=@mssql_query($G,$this->_link);$this->error="";if(!$H){$this->error=mssql_get_last_message();return
false;}if($H===true){$this->affected_rows=mssql_rows_affected($this->_link);return
true;}return
new
Min_Result($H);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
mssql_next_result($this->_result->_result);}function
result($G,$n=0){$H=$this->query($G);if(!is_object($H))return
false;return
mssql_result($H->_result,0,$n);}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($H){$this->_result=$H;$this->num_rows=mssql_num_rows($H);}function
fetch_assoc(){return
mssql_fetch_assoc($this->_result);}function
fetch_row(){return
mssql_fetch_row($this->_result);}function
num_rows(){return
mssql_num_rows($this->_result);}function
fetch_field(){$I=mssql_fetch_field($this->_result);$I->orgtable=$I->table;$I->orgname=$I->name;return$I;}function
seek($gf){mssql_data_seek($this->_result,$gf);}function
__destruct(){mssql_free_result($this->_result);}}}elseif(extension_loaded("pdo_dblib")){class
Min_DB
extends
Min_PDO{var$extension="PDO_DBLIB";function
connect($M,$V,$F){$this->dsn("dblib:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$M)),$V,$F);return
true;}function
select_db($i){return$this->query("USE ".idf_escape($i));}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$K,$jg){foreach($K
as$N){$Hi=array();$Z=array();foreach($N
as$z=>$X){$Hi[]="$z = $X";if(isset($jg[idf_unescape($z)]))$Z[]="$z = $X";}if(!queries("MERGE ".table($Q)." USING (VALUES(".implode(", ",$N).")) AS source (c".implode(", c",range(1,count($N))).") ON ".implode(" AND ",$Z)." WHEN MATCHED THEN UPDATE SET ".implode(", ",$Hi)." WHEN NOT MATCHED THEN INSERT (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).");"))return
false;}return
true;}function
begin(){return
queries("BEGIN TRANSACTION");}}function
idf_escape($v){return"[".str_replace("]","]]",$v)."]";}function
table($v){return($_GET["ns"]!=""?idf_escape($_GET["ns"]).".":"").idf_escape($v);}function
connect(){global$b;$f=new
Min_DB;$Kb=$b->credentials();if($f->connect($Kb[0],$Kb[1],$Kb[2]))return$f;return$f->error;}function
get_databases(){return
get_vals("SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')");}function
limit($G,$Z,$_,$gf=0,$gh=" "){return($_!==null?" TOP (".($_+$gf).")":"")." $G$Z";}function
limit1($Q,$G,$Z,$gh="\n"){return
limit($G,$Z,1,0,$gh);}function
db_collation($k,$mb){global$f;return$f->result("SELECT collation_name FROM sys.databases WHERE name = ".q($k));}function
engines(){return
array();}function
logged_user(){global$f;return$f->result("SELECT SUSER_NAME()");}function
tables_list(){return
get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ORDER BY name");}function
count_tables($j){global$f;$I=array();foreach($j
as$k){$f->select_db($k);$I[$k]=$f->result("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");}return$I;}function
table_status($D=""){$I=array();foreach(get_rows("SELECT ao.name AS Name, ao.type_desc AS Engine, (SELECT value FROM fn_listextendedproperty(default, 'SCHEMA', schema_name(schema_id), 'TABLE', ao.name, null, null)) AS Comment FROM sys.all_objects AS ao WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ".($D!=""?"AND name = ".q($D):"ORDER BY name"))as$J){if($D!="")return$J;$I[$J["Name"]]=$J;}return$I;}function
is_view($R){return$R["Engine"]=="VIEW";}function
fk_support($R){return
true;}function
fields($Q){$tb=get_key_vals("SELECT objname, cast(value as varchar(max)) FROM fn_listextendedproperty('MS_DESCRIPTION', 'schema', ".q(get_schema()).", 'table', ".q($Q).", 'column', NULL)");$I=array();foreach(get_rows("SELECT c.max_length, c.precision, c.scale, c.name, c.is_nullable, c.is_identity, c.collation_name, t.name type, CAST(d.definition as text) [default]
FROM sys.all_columns c
JOIN sys.all_objects o ON c.object_id = o.object_id
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.parent_column_id
WHERE o.schema_id = SCHEMA_ID(".q(get_schema()).") AND o.type IN ('S', 'U', 'V') AND o.name = ".q($Q))as$J){$T=$J["type"];$se=(preg_match("~char|binary~",$T)?$J["max_length"]:($T=="decimal"?"$J[precision],$J[scale]":""));$I[$J["name"]]=array("field"=>$J["name"],"full_type"=>$T.($se?"($se)":""),"type"=>$T,"length"=>$se,"default"=>$J["default"],"null"=>$J["is_nullable"],"auto_increment"=>$J["is_identity"],"collation"=>$J["collation_name"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"primary"=>$J["is_identity"],"comment"=>$tb[$J["name"]],);}return$I;}function
indexes($Q,$g=null){$I=array();foreach(get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name, is_descending_key
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = ".q($Q),$g)as$J){$D=$J["name"];$I[$D]["type"]=($J["is_primary_key"]?"PRIMARY":($J["is_unique"]?"UNIQUE":"INDEX"));$I[$D]["lengths"]=array();$I[$D]["columns"][$J["key_ordinal"]]=$J["column_name"];$I[$D]["descs"][$J["key_ordinal"]]=($J["is_descending_key"]?'1':null);}return$I;}function
adm_view($D){global$f;return
array("select"=>preg_replace('~^(?:[^[]|\[[^]]*])*\s+AS\s+~isU','',$f->result("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = ".q($D))));}function
collations(){$I=array();foreach(get_vals("SELECT name FROM fn_helpcollations()")as$lb)$I[preg_replace('~_.*~','',$lb)][]=$lb;return$I;}function
information_schema($k){return
false;}function
error(){global$f;return
nl_br(h(preg_replace('~^(\[[^]]*])+~m','',$f->error)));}function
create_database($k,$lb){return
queries("CREATE DATABASE ".idf_escape($k).(preg_match('~^[a-z0-9_]+$~i',$lb)?" COLLATE $lb":""));}function
drop_databases($j){return
queries("DROP DATABASE ".implode(", ",array_map('idf_escape',$j)));}function
rename_database($D,$lb){if(preg_match('~^[a-z0-9_]+$~i',$lb))queries("ALTER DATABASE ".idf_escape(DB)." COLLATE $lb");queries("ALTER DATABASE ".idf_escape(DB)." MODIFY NAME = ".idf_escape($D));return
true;}function
auto_increment(){return" IDENTITY".($_POST["Auto_increment"]!=""?"(".number($_POST["Auto_increment"]).",1)":"")." PRIMARY KEY";}function
alter_table($Q,$D,$o,$ed,$rb,$xc,$lb,$Ka,$Sf){$c=array();$tb=array();foreach($o
as$n){$d=idf_escape($n[0]);$X=$n[1];if(!$X)$c["DROP"][]=" COLUMN $d";else{$X[1]=preg_replace("~( COLLATE )'(\\w+)'~",'\1\2',$X[1]);$tb[$n[0]]=$X[5];unset($X[5]);if($n[0]=="")$c["ADD"][]="\n  ".implode("",$X).($Q==""?substr($ed[$X[0]],16+strlen($X[0])):"");else{unset($X[6]);if($d!=$X[0])queries("EXEC sp_rename ".q(table($Q).".$d").", ".q(idf_unescape($X[0])).", 'COLUMN'");$c["ALTER COLUMN ".implode("",$X)][]="";}}}if($Q=="")return
queries("CREATE TABLE ".table($D)." (".implode(",",(array)$c["ADD"])."\n)");if($Q!=$D)queries("EXEC sp_rename ".q(table($Q)).", ".q($D));if($ed)$c[""]=$ed;foreach($c
as$z=>$X){if(!queries("ALTER TABLE ".idf_escape($D)." $z".implode(",",$X)))return
false;}foreach($tb
as$z=>$X){$rb=substr($X,9);queries("EXEC sp_dropextendedproperty @name = N'MS_Description', @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table', @level1name = ".q($D).", @level2type = N'Column', @level2name = ".q($z));queries("EXEC sp_addextendedproperty @name = N'MS_Description', @value = ".$rb.", @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table', @level1name = ".q($D).", @level2type = N'Column', @level2name = ".q($z));}return
true;}function
alter_indexes($Q,$c){$w=array();$ic=array();foreach($c
as$X){if($X[2]=="DROP"){if($X[0]=="PRIMARY")$ic[]=idf_escape($X[1]);else$w[]=idf_escape($X[1])." ON ".table($Q);}elseif(!queries(($X[0]!="PRIMARY"?"CREATE $X[0] ".($X[0]!="INDEX"?"INDEX ":"").idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q):"ALTER TABLE ".table($Q)." ADD PRIMARY KEY")." (".implode(", ",$X[2]).")"))return
false;}return(!$w||queries("DROP INDEX ".implode(", ",$w)))&&(!$ic||queries("ALTER TABLE ".table($Q)." DROP ".implode(", ",$ic)));}function
last_id(){global$f;return$f->result("SELECT SCOPE_IDENTITY()");}function
explain($f,$G){$f->query("SET SHOWPLAN_ALL ON");$I=$f->query($G);$f->query("SET SHOWPLAN_ALL OFF");return$I;}function
found_rows($R,$Z){}function
foreign_keys($Q){$I=array();foreach(get_rows("EXEC sp_fkeys @fktable_name = ".q($Q))as$J){$q=&$I[$J["FK_NAME"]];$q["db"]=$J["PKTABLE_QUALIFIER"];$q["table"]=$J["PKTABLE_NAME"];$q["source"][]=$J["FKCOLUMN_NAME"];$q["target"][]=$J["PKCOLUMN_NAME"];}return$I;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Xi){return
queries("DROP VIEW ".implode(", ",array_map('table',$Xi)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$Xi,$Vh){return
apply_queries("ALTER SCHEMA ".idf_escape($Vh)." TRANSFER",array_merge($S,$Xi));}function
trigger($D){if($D=="")return
array();$K=get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = ".q($D));$I=reset($K);if($I)$I["Statement"]=preg_replace('~^.+\s+AS\s+~isU','',$I["text"]);return$I;}function
triggers($Q){$I=array();foreach(get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = ".q($Q))as$J)$I[$J["name"]]=array($J["Timing"],$J["Event"]);return$I;}function
trigger_options(){return
array("Timing"=>array("AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("AS"),);}function
schemas(){return
get_vals("SELECT name FROM sys.schemas");}function
get_schema(){global$f;if($_GET["ns"]!="")return$_GET["ns"];return$f->result("SELECT SCHEMA_NAME()");}function
set_schema($Yg){return
true;}function
use_sql($i){return"USE ".idf_escape($i);}function
show_variables(){return
array();}function
show_status(){return
array();}function
convert_field($n){}function
unconvert_field($n,$I){return$I;}function
support($Sc){return
preg_match('~^(comment|columns|database|drop_col|indexes|descidx|scheme|sql|table|trigger|view|view_trigger)$~',$Sc);}function
driver_config(){$U=array();$Fh=array();foreach(array('Numbers'=>array("tinyint"=>3,"smallint"=>5,"int"=>10,"bigint"=>20,"bit"=>1,"decimal"=>0,"real"=>12,"float"=>53,"smallmoney"=>10,"money"=>20),'Date and time'=>array("date"=>10,"smalldatetime"=>19,"datetime"=>19,"datetime2"=>19,"time"=>8,"datetimeoffset"=>10),'Strings'=>array("char"=>8000,"varchar"=>8000,"text"=>2147483647,"nchar"=>4000,"nvarchar"=>4000,"ntext"=>1073741823),'Binary'=>array("binary"=>8000,"varbinary"=>8000,"image"=>2147483647),)as$z=>$X){$U+=$X;$Fh[$z]=array_keys($X);}return
array('possible_drivers'=>array("SQLSRV","MSSQL","PDO_DBLIB"),'jush'=>"mssql",'types'=>$U,'structured_types'=>$Fh,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL"),'functions'=>array("len","lower","round","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("date|time"=>"getdate",),array("int|decimal|real|float|money|datetime"=>"+/-","char|text"=>"+",)),);}}$hc["mongo"]="MongoDB (alpha)";if(isset($_GET["mongo"])){define("DRIVER","mongo");if(class_exists('MongoDB')){class
Min_DB{var$extension="Mongo",$server_info=MongoClient::VERSION,$error,$last_id,$_link,$_db;function
connect($Ii,$wf){try{$this->_link=new
MongoClient($Ii,$wf);if($wf["password"]!=""){$wf["password"]="";try{new
MongoClient($Ii,$wf);$this->error='Database does not support password.';}catch(Exception$oc){}}}catch(Exception$oc){$this->error=$oc->getMessage();}}function
query($G){return
false;}function
select_db($i){try{$this->_db=$this->_link->selectDB($i);return
true;}catch(Exception$Ec){$this->error=$Ec->getMessage();return
false;}}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($H){foreach($H
as$ce){$J=array();foreach($ce
as$z=>$X){if(is_a($X,'MongoBinData'))$this->_charset[$z]=63;$J[$z]=(is_a($X,'MongoId')?"ObjectId(\"$X\")":(is_a($X,'MongoDate')?gmdate("Y-m-d H:i:s",$X->sec)." GMT":(is_a($X,'MongoBinData')?$X->bin:(is_a($X,'MongoRegex')?"$X":(is_object($X)?get_class($X):$X)))));}$this->_rows[]=$J;foreach($J
as$z=>$X){if(!isset($this->_rows[0][$z]))$this->_rows[0][$z]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$J=current($this->_rows);if(!$J)return$J;$I=array();foreach($this->_rows[0]as$z=>$X)$I[$z]=$J[$z];next($this->_rows);return$I;}function
fetch_row(){$I=$this->fetch_assoc();if(!$I)return$I;return
array_values($I);}function
fetch_field(){$ge=array_keys($this->_rows[0]);$D=$ge[$this->_offset++];return(object)array('name'=>$D,'charsetnr'=>$this->_charset[$D],);}}class
Min_Driver
extends
Min_SQL{public$jg="_id";function
select($Q,$L,$Z,$od,$yf=array(),$_=1,$E=0,$lg=false){$L=($L==array("*")?array():array_fill_keys($L,true));$th=array();foreach($yf
as$X){$X=preg_replace('~ DESC$~','',$X,1,$Gb);$th[$X]=($Gb?-1:1);}return
new
Min_Result($this->_conn->_db->selectCollection($Q)->find(array(),$L)->sort($th)->limit($_!=""?+$_:0)->skip($E*$_));}function
insert($Q,$N){try{$I=$this->_conn->_db->selectCollection($Q)->insert($N);$this->_conn->errno=$I['code'];$this->_conn->error=$I['err'];$this->_conn->last_id=$N['_id'];return!$I['err'];}catch(Exception$Ec){$this->_conn->error=$Ec->getMessage();return
false;}}}function
get_databases($cd){global$f;$I=array();$Ub=$f->_link->listDBs();foreach($Ub['databases']as$k)$I[]=$k['name'];return$I;}function
count_tables($j){global$f;$I=array();foreach($j
as$k)$I[$k]=count($f->_link->selectDB($k)->getCollectionNames(true));return$I;}function
tables_list(){global$f;return
array_fill_keys($f->_db->getCollectionNames(true),'table');}function
drop_databases($j){global$f;foreach($j
as$k){$Kg=$f->_link->selectDB($k)->drop();if(!$Kg['ok'])return
false;}return
true;}function
indexes($Q,$g=null){global$f;$I=array();foreach($f->_db->selectCollection($Q)->getIndexInfo()as$w){$bc=array();foreach($w["key"]as$d=>$T)$bc[]=($T==-1?'1':null);$I[$w["name"]]=array("type"=>($w["name"]=="_id_"?"PRIMARY":($w["unique"]?"UNIQUE":"INDEX")),"columns"=>array_keys($w["key"]),"lengths"=>array(),"descs"=>$bc,);}return$I;}function
fields($Q){return
fields_from_edit();}function
found_rows($R,$Z){global$f;return$f->_db->selectCollection($_GET["select"])->count($Z);}$tf=array("=");}elseif(class_exists('MongoDB\Driver\Manager')){class
Min_DB{var$extension="MongoDB",$server_info=MONGODB_VERSION,$affected_rows,$error,$last_id;var$_link;var$_db,$_db_name;function
connect($Ii,$wf){$gb='MongoDB\Driver\Manager';$this->_link=new$gb($Ii,$wf);$this->executeCommand('admin',array('ping'=>1));}function
executeCommand($k,$pb){$gb='MongoDB\Driver\Command';try{return$this->_link->executeCommand($k,new$gb($pb));}catch(Exception$oc){$this->error=$oc->getMessage();return
array();}}function
executeBulkWrite($Ve,$Wa,$Hb){try{$Ng=$this->_link->executeBulkWrite($Ve,$Wa);$this->affected_rows=$Ng->$Hb();return
true;}catch(Exception$oc){$this->error=$oc->getMessage();return
false;}}function
query($G){return
false;}function
select_db($i){$this->_db_name=$i;return
true;}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($H){foreach($H
as$ce){$J=array();foreach($ce
as$z=>$X){if(is_a($X,'MongoDB\BSON\Binary'))$this->_charset[$z]=63;$J[$z]=(is_a($X,'MongoDB\BSON\ObjectID')?'MongoDB\BSON\ObjectID("'."$X\")":(is_a($X,'MongoDB\BSON\UTCDatetime')?$X->toDateTime()->format('Y-m-d H:i:s'):(is_a($X,'MongoDB\BSON\Binary')?$X->getData():(is_a($X,'MongoDB\BSON\Regex')?"$X":(is_object($X)||is_array($X)?json_encode($X,256):$X)))));}$this->_rows[]=$J;foreach($J
as$z=>$X){if(!isset($this->_rows[0][$z]))$this->_rows[0][$z]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$J=current($this->_rows);if(!$J)return$J;$I=array();foreach($this->_rows[0]as$z=>$X)$I[$z]=$J[$z];next($this->_rows);return$I;}function
fetch_row(){$I=$this->fetch_assoc();if(!$I)return$I;return
array_values($I);}function
fetch_field(){$ge=array_keys($this->_rows[0]);$D=$ge[$this->_offset++];return(object)array('name'=>$D,'charsetnr'=>$this->_charset[$D],);}}class
Min_Driver
extends
Min_SQL{public$jg="_id";function
select($Q,$L,$Z,$od,$yf=array(),$_=1,$E=0,$lg=false){global$f;$L=($L==array("*")?array():array_fill_keys($L,1));if(count($L)&&!isset($L['_id']))$L['_id']=0;$Z=where_to_query($Z);$th=array();foreach($yf
as$X){$X=preg_replace('~ DESC$~','',$X,1,$Gb);$th[$X]=($Gb?-1:1);}if(isset($_GET['limit'])&&is_numeric($_GET['limit'])&&$_GET['limit']>0)$_=$_GET['limit'];$_=min(200,max(1,(int)$_));$qh=$E*$_;$gb='MongoDB\Driver\Query';try{return
new
Min_Result($f->_link->executeQuery("$f->_db_name.$Q",new$gb($Z,array('projection'=>$L,'limit'=>$_,'skip'=>$qh,'sort'=>$th))));}catch(Exception$oc){$f->error=$oc->getMessage();return
false;}}function
update($Q,$N,$vg,$_=0,$gh="\n"){global$f;$k=$f->_db_name;$Z=sql_query_where_parser($vg);$gb='MongoDB\Driver\BulkWrite';$Wa=new$gb(array());if(isset($N['_id']))unset($N['_id']);$Hg=array();foreach($N
as$z=>$Y){if($Y=='NULL'){$Hg[$z]=1;unset($N[$z]);}}$Hi=array('$set'=>$N);if(count($Hg))$Hi['$unset']=$Hg;$Wa->update($Z,$Hi,array('upsert'=>false));return$f->executeBulkWrite("$k.$Q",$Wa,'getModifiedCount');}function
delete($Q,$vg,$_=0){global$f;$k=$f->_db_name;$Z=sql_query_where_parser($vg);$gb='MongoDB\Driver\BulkWrite';$Wa=new$gb(array());$Wa->delete($Z,array('limit'=>$_));return$f->executeBulkWrite("$k.$Q",$Wa,'getDeletedCount');}function
insert($Q,$N){global$f;$k=$f->_db_name;$gb='MongoDB\Driver\BulkWrite';$Wa=new$gb(array());if($N['_id']=='')unset($N['_id']);$Wa->insert($N);return$f->executeBulkWrite("$k.$Q",$Wa,'getInsertedCount');}}function
get_databases($cd){global$f;$I=array();foreach($f->executeCommand('admin',array('listDatabases'=>1))as$Ub){foreach($Ub->databases
as$k)$I[]=$k->name;}return$I;}function
count_tables($j){$I=array();return$I;}function
tables_list(){global$f;$nb=array();foreach($f->executeCommand($f->_db_name,array('listCollections'=>1))as$H)$nb[$H->name]='table';return$nb;}function
drop_databases($j){return
false;}function
indexes($Q,$g=null){global$f;$I=array();foreach($f->executeCommand($f->_db_name,array('listIndexes'=>$Q))as$w){$bc=array();$e=array();foreach(get_object_vars($w->key)as$d=>$T){$bc[]=($T==-1?'1':null);$e[]=$d;}$I[$w->name]=array("type"=>($w->name=="_id_"?"PRIMARY":(isset($w->unique)?"UNIQUE":"INDEX")),"columns"=>$e,"lengths"=>array(),"descs"=>$bc,);}return$I;}function
fields($Q){global$l;$o=fields_from_edit();if(!$o){$H=$l->select($Q,array("*"),null,null,array(),10);if($H){while($J=$H->fetch_assoc()){foreach($J
as$z=>$X){$J[$z]=null;$o[$z]=array("field"=>$z,"type"=>"string","null"=>($z!=$l->primary),"auto_increment"=>($z==$l->primary),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1,),);}}}}return$o;}function
found_rows($R,$Z){global$f;$Z=where_to_query($Z);$li=$f->executeCommand($f->_db_name,array('count'=>$R['Name'],'query'=>$Z))->toArray();return$li[0]->n;}function
sql_query_where_parser($vg){$vg=preg_replace('~^\sWHERE \(?\(?(.+?)\)?\)?$~','\1',$vg);$hj=explode(' AND ',$vg);$ij=explode(') OR (',$vg);$Z=array();foreach($hj
as$fj)$Z[]=trim($fj);if(count($ij)==1)$ij=array();elseif(count($ij)>1)$Z=array();return
where_to_query($Z,$ij);}function
where_to_query($dj=array(),$ej=array()){global$b;$Pb=array();foreach(array('and'=>$dj,'or'=>$ej)as$T=>$Z){if(is_array($Z)){foreach($Z
as$Kc){list($jb,$rf,$X)=explode(" ",$Kc,3);if($jb=="_id"&&preg_match('~^(MongoDB\\\\BSON\\\\ObjectID)\("(.+)"\)$~',$X,$C)){list(,$gb,$X)=$C;$X=new$gb($X);}if(!in_array($rf,$b->operators))continue;if(preg_match('~^\(f\)(.+)~',$rf,$C)){$X=(float)$X;$rf=$C[1];}elseif(preg_match('~^\(date\)(.+)~',$rf,$C)){$Rb=new
DateTime($X);$gb='MongoDB\BSON\UTCDatetime';$X=new$gb($Rb->getTimestamp()*1000);$rf=$C[1];}switch($rf){case'=':$rf='$eq';break;case'!=':$rf='$ne';break;case'>':$rf='$gt';break;case'<':$rf='$lt';break;case'>=':$rf='$gte';break;case'<=':$rf='$lte';break;case'regex':$rf='$regex';break;default:continue
2;}if($T=='and')$Pb['$and'][]=array($jb=>array($rf=>$X));elseif($T=='or')$Pb['$or'][]=array($jb=>array($rf=>$X));}}}return$Pb;}$tf=array("=","!=",">","<",">=","<=","regex","(f)=","(f)!=","(f)>","(f)<","(f)>=","(f)<=","(date)=","(date)!=","(date)>","(date)<","(date)>=","(date)<=",);}function
table($v){return$v;}function
idf_escape($v){return$v;}function
table_status($D="",$Rc=false){$I=array();foreach(tables_list()as$Q=>$T){$I[$Q]=array("Name"=>$Q);if($D==$Q)return$I[$Q];}return$I;}function
create_database($k,$lb){return
true;}function
last_id(){global$f;return$f->last_id;}function
error(){global$f;return
h($f->error);}function
collations(){return
array();}function
logged_user(){global$b;$Kb=$b->credentials();return$Kb[1];}function
connect(){global$b;$f=new
Min_DB;list($M,$V,$F)=$b->credentials();$wf=array();if($V.$F!=""){$wf["username"]=$V;$wf["password"]=$F;}$k=$b->database();if($k!="")$wf["db"]=$k;if(($Ja=getenv("MONGO_AUTH_SOURCE")))$wf["authSource"]=$Ja;$f->connect("mongodb://$M",$wf);if($f->error)return$f->error;return$f;}function
alter_indexes($Q,$c){global$f;foreach($c
as$X){list($T,$D,$N)=$X;if($N=="DROP")$I=$f->_db->command(array("deleteIndexes"=>$Q,"index"=>$D));else{$e=array();foreach($N
as$d){$d=preg_replace('~ DESC$~','',$d,1,$Gb);$e[$d]=($Gb?-1:1);}$I=$f->_db->selectCollection($Q)->ensureIndex($e,array("unique"=>($T=="UNIQUE"),"name"=>$D,));}if($I['errmsg']){$f->error=$I['errmsg'];return
false;}}return
true;}function
support($Sc){return
preg_match("~database|indexes|descidx~",$Sc);}function
db_collation($k,$mb){}function
information_schema(){}function
is_view($R){}function
convert_field($n){}function
unconvert_field($n,$I){return$I;}function
foreign_keys($Q){return
array();}function
fk_support($R){}function
engines(){return
array();}function
alter_table($Q,$D,$o,$ed,$rb,$xc,$lb,$Ka,$Sf){global$f;if($Q==""){$f->_db->createCollection($D);return
true;}}function
drop_tables($S){global$f;foreach($S
as$Q){$Kg=$f->_db->selectCollection($Q)->drop();if(!$Kg['ok'])return
false;}return
true;}function
truncate_tables($S){global$f;foreach($S
as$Q){$Kg=$f->_db->selectCollection($Q)->remove();if(!$Kg['ok'])return
false;}return
true;}function
driver_config(){global$tf;return
array('possible_drivers'=>array("mongo","mongodb"),'jush'=>"mongo",'operators'=>$tf,'functions'=>array(),'grouping'=>array(),'edit_functions'=>array(array("json")),);}}$hc["elastic"]="Elasticsearch (beta)";if(isset($_GET["elastic"])){define("DRIVER","elastic");if(function_exists('json_decode')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="JSON",$server_info,$errno,$error,$_url,$_db;function
rootQuery($Wf,$Bb=array(),$Oe='GET'){@ini_set('track_errors',1);$Wc=@file_get_contents("$this->_url/".ltrim($Wf,'/'),false,stream_context_create(array('http'=>array('method'=>$Oe,'content'=>$Bb===null?$Bb:json_encode($Bb),'header'=>'Content-Type: application/json','ignore_errors'=>1,))));if(!$Wc){$this->error=$php_errormsg;return$Wc;}if(!preg_match('~^HTTP/[0-9.]+ 2~i',$http_response_header[0])){$this->error='Invalid credentials.'." $http_response_header[0]";return
false;}$I=json_decode($Wc,true);if($I===null){$this->errno=json_last_error();if(function_exists('json_last_error_msg'))$this->error=json_last_error_msg();else{$_b=get_defined_constants(true);foreach($_b['json']as$D=>$Y){if($Y==$this->errno&&preg_match('~^JSON_ERROR_~',$D)){$this->error=$D;break;}}}}return$I;}function
query($Wf,$Bb=array(),$Oe='GET'){return$this->rootQuery(($this->_db!=""?"$this->_db/":"/").ltrim($Wf,'/'),$Bb,$Oe);}function
connect($M,$V,$F){preg_match('~^(https?://)?(.*)~',$M,$C);$this->_url=($C[1]?$C[1]:"http://")."$V:$F@$C[2]";$I=$this->query('');if($I)$this->server_info=$I['version']['number'];return(bool)$I;}function
select_db($i){$this->_db=$i;return
true;}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows;function
__construct($K){$this->num_rows=count($K);$this->_rows=$K;reset($this->_rows);}function
fetch_assoc(){$I=current($this->_rows);next($this->_rows);return$I;}function
fetch_row(){return
array_values($this->fetch_assoc());}}}class
Min_Driver
extends
Min_SQL{function
select($Q,$L,$Z,$od,$yf=array(),$_=1,$E=0,$lg=false){global$b;$Pb=array();$G="$Q/_search";if($L!=array("*"))$Pb["fields"]=$L;if($yf){$th=array();foreach($yf
as$jb){$jb=preg_replace('~ DESC$~','',$jb,1,$Gb);$th[]=($Gb?array($jb=>"desc"):$jb);}$Pb["sort"]=$th;}if($_){$Pb["size"]=+$_;if($E)$Pb["from"]=($E*$_);}foreach($Z
as$X){list($jb,$rf,$X)=explode(" ",$X,3);if($jb=="_id")$Pb["query"]["ids"]["values"][]=$X;elseif($jb.$X!=""){$Yh=array("term"=>array(($jb!=""?$jb:"_all")=>$X));if($rf=="=")$Pb["query"]["filtered"]["filter"]["and"][]=$Yh;else$Pb["query"]["filtered"]["query"]["bool"]["must"][]=$Yh;}}if($Pb["query"]&&!$Pb["query"]["filtered"]["query"]&&!$Pb["query"]["ids"])$Pb["query"]["filtered"]["query"]=array("match_all"=>array());$Bh=microtime(true);$ah=$this->_conn->query($G,$Pb);if($lg)echo$b->selectQuery("$G: ".json_encode($Pb),$Bh,!$ah);if(!$ah)return
false;$I=array();foreach($ah['hits']['hits']as$Ad){$J=array();if($L==array("*"))$J["_id"]=$Ad["_id"];$o=$Ad['_source'];if($L!=array("*")){$o=array();foreach($L
as$z)$o[$z]=$Ad['fields'][$z];}foreach($o
as$z=>$X){if($Pb["fields"])$X=$X[0];$J[$z]=(is_array($X)?json_encode($X):$X);}$I[]=$J;}return
new
Min_Result($I);}function
update($T,$zg,$vg,$_=0,$gh="\n"){$Uf=preg_split('~ *= *~',$vg);if(count($Uf)==2){$u=trim($Uf[1]);$G="$T/$u";return$this->_conn->query($G,$zg,'POST');}return
false;}function
insert($T,$zg){$u="";$G="$T/$u";$Kg=$this->_conn->query($G,$zg,'POST');$this->_conn->last_id=$Kg['_id'];return$Kg['created'];}function
delete($T,$vg,$_=0){$Fd=array();if(is_array($_GET["where"])&&$_GET["where"]["_id"])$Fd[]=$_GET["where"]["_id"];if(is_array($_POST['check'])){foreach($_POST['check']as$ab){$Uf=preg_split('~ *= *~',$ab);if(count($Uf)==2)$Fd[]=trim($Uf[1]);}}$this->_conn->affected_rows=0;foreach($Fd
as$u){$G="{$T}/{$u}";$Kg=$this->_conn->query($G,'{}','DELETE');if(is_array($Kg)&&$Kg['found']==true)$this->_conn->affected_rows++;}return$this->_conn->affected_rows;}}function
connect(){global$b;$f=new
Min_DB;list($M,$V,$F)=$b->credentials();if($F!=""&&$f->connect($M,$V,""))return'Database does not support password.';if($f->connect($M,$V,$F))return$f;return$f->error;}function
support($Sc){return
preg_match("~database|table|columns~",$Sc);}function
logged_user(){global$b;$Kb=$b->credentials();return$Kb[1];}function
get_databases(){global$f;$I=$f->rootQuery('_aliases');if($I){$I=array_keys($I);sort($I,SORT_STRING);}return$I;}function
collations(){return
array();}function
db_collation($k,$mb){}function
engines(){return
array();}function
count_tables($j){global$f;$I=array();$H=$f->query('_stats');if($H&&$H['indices']){$Nd=$H['indices'];foreach($Nd
as$Md=>$Ch){$Ld=$Ch['total']['indexing'];$I[$Md]=$Ld['index_total'];}}return$I;}function
tables_list(){global$f;if(min_version(6))return
array('_doc'=>'table');$I=$f->query('_mapping');if($I)$I=array_fill_keys(array_keys($I[$f->_db]["mappings"]),'table');return$I;}function
table_status($D="",$Rc=false){global$f;$ah=$f->query("_search",array("size"=>0,"aggregations"=>array("count_by_type"=>array("terms"=>array("field"=>"_type")))),"POST");$I=array();if($ah){$S=$ah["aggregations"]["count_by_type"]["buckets"];foreach($S
as$Q){$I[$Q["key"]]=array("Name"=>$Q["key"],"Engine"=>"table","Rows"=>$Q["doc_count"],);if($D!=""&&$D==$Q["key"])return$I[$D];}}return$I;}function
error(){global$f;return
h($f->error);}function
information_schema(){}function
is_view($R){}function
indexes($Q,$g=null){return
array(array("type"=>"PRIMARY","columns"=>array("_id")),);}function
fields($Q){global$f;$ye=array();if(min_version(6)){$H=$f->query("_mapping");if($H)$ye=$H[$f->_db]['mappings']['properties'];}else{$H=$f->query("$Q/_mapping");if($H){$ye=$H[$Q]['properties'];if(!$ye)$ye=$H[$f->_db]['mappings'][$Q]['properties'];}}$I=array();if($ye){foreach($ye
as$D=>$n){$I[$D]=array("field"=>$D,"full_type"=>$n["type"],"type"=>$n["type"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);if($n["properties"]){unset($I[$D]["privileges"]["insert"]);unset($I[$D]["privileges"]["update"]);}}}return$I;}function
foreign_keys($Q){return
array();}function
table($v){return$v;}function
idf_escape($v){return$v;}function
convert_field($n){}function
unconvert_field($n,$I){return$I;}function
fk_support($R){}function
found_rows($R,$Z){return
null;}function
create_database($k){global$f;return$f->rootQuery(urlencode($k),null,'PUT');}function
drop_databases($j){global$f;return$f->rootQuery(urlencode(implode(',',$j)),array(),'DELETE');}function
alter_table($Q,$D,$o,$ed,$rb,$xc,$lb,$Ka,$Sf){global$f;$rg=array();foreach($o
as$Pc){$Uc=trim($Pc[1][0]);$Vc=trim($Pc[1][1]?$Pc[1][1]:"text");$rg[$Uc]=array('type'=>$Vc);}if(!empty($rg))$rg=array('properties'=>$rg);return$f->query("_mapping/{$D}",$rg,'PUT');}function
drop_tables($S){global$f;$I=true;foreach($S
as$Q)$I=$I&&$f->query(urlencode($Q),array(),'DELETE');return$I;}function
last_id(){global$f;return$f->last_id;}function
driver_config(){$U=array();$Fh=array();foreach(array('Numbers'=>array("long"=>3,"integer"=>5,"short"=>8,"byte"=>10,"double"=>20,"float"=>66,"half_float"=>12,"scaled_float"=>21),'Date and time'=>array("date"=>10),'Strings'=>array("string"=>65535,"text"=>65535),'Binary'=>array("binary"=>255),)as$z=>$X){$U+=$X;$Fh[$z]=array_keys($X);}return
array('possible_drivers'=>array("json + allow_url_fopen"),'jush'=>"elastic",'operators'=>array("=","query"),'functions'=>array(),'grouping'=>array(),'edit_functions'=>array(array("json")),'types'=>$U,'structured_types'=>$Fh,);}}class
Adminer{var$operators;function
name(){return"<a href='https://www.adminer.org/'".target_blank()." id='h1'>Adminer</a>";}function
credentials(){return
array(SERVER,$_GET["username"],get_password());}function
connectSsl(){}function
permanentLogin($h=false){return
password_file($h);}function
bruteForceKey(){return$_SERVER["REMOTE_ADDR"];}function
serverName($M){return
h($M);}function
database(){return
DB;}function
databases($cd=true){return
get_databases($cd);}function
schemas(){return
schemas();}function
queryTimeout(){return
2;}function
headers(){}function
csp(){return
csp();}function
head(){return
true;}function
css(){$I=array();$p="adminer.css";if(file_exists($p))$I[]="$p?v=".crc32(file_get_contents($p));return$I;}function
loginForm(){global$hc;echo"<table cellspacing='0' class='layout'>\n",$this->loginFormField('driver','<tr><th>'.'System'.'<td>',html_select("auth[driver]",$hc,DRIVER,"loginDriver(this);")."\n"),$this->loginFormField('server','<tr><th>'.'Server'.'<td>','<input name="auth[server]" value="'.h(SERVER).'" title="hostname[:port]" placeholder="localhost" autocapitalize="off">'."\n"),$this->loginFormField('username','<tr><th>'.'Username'.'<td>','<input name="auth[username]" id="username" value="'.h($_GET["username"]).'" autocomplete="username" autocapitalize="off">'.script("focus(qs('#username')); qs('#username').form['auth[driver]'].onchange();")),$this->loginFormField('password','<tr><th>'.'Password'.'<td>','<input type="password" name="auth[password]" autocomplete="current-password">'."\n"),$this->loginFormField('db','<tr><th>'.'Database'.'<td>','<input name="auth[db]" value="'.h($_GET["db"]).'" autocapitalize="off">'."\n"),"</table>\n","<p><input type='submit' value='".'Login'."'>\n",checkbox("auth[permanent]",1,$_COOKIE["adminer_permanent"],'Permanent login')."\n";}function
loginFormField($D,$yd,$Y){return$yd.$Y;}function
login($we,$F){if($F=="")return
sprintf('Adminer does not support accessing a database without a password, <a href="https://www.adminer.org/en/password/"%s>more information</a>.',target_blank());return
true;}function
tableName($Mh){return
h($Mh["Name"]);}function
fieldName($n,$yf=0){return'<span title="'.h($n["full_type"]).'">'.h($n["field"]).'</span>';}function
selectLinks($Mh,$N=""){global$y,$l;echo'<p class="links">';$ve=array("select"=>'Select data');if(support("table")||support("indexes"))$ve["table"]='Show structure';if(support("table")){if(is_view($Mh))$ve["view"]='Alter view';else$ve["create"]='Alter table';}if($N!==null)$ve["edit"]='New item';$D=$Mh["Name"];foreach($ve
as$z=>$X)echo" <a href='".h(ME)."$z=".urlencode($D).($z=="edit"?$N:"")."'".bold(isset($_GET[$z])).">$X</a>";echo
doc_link(array($y=>$l->tableHelp($D)),"?"),"\n";}function
foreignKeys($Q){return
foreign_keys($Q);}function
backwardKeys($Q,$Lh){return
array();}function
backwardKeysPrint($Na,$J){}function
selectQuery($G,$Bh,$Qc=false){global$y,$l;$I="</p>\n";if(!$Qc&&($aj=$l->warnings())){$u="warnings";$I=", <a href='#$u'>".'Warnings'."</a>".script("qsl('a').onclick = partial(toggle, '$u');","")."$I<div id='$u' class='hidden'>\n$aj</div>\n";}return"<p><code class='jush-$y'>".h(str_replace("\n"," ",$G))."</code> <span class='time'>(".format_time($Bh).")</span>".(support("sql")?" <a href='".h(ME)."sql=".urlencode($G)."'>".'Edit'."</a>":"").$I;}function
sqlCommandQuery($G){return
shorten_utf8(trim($G),1000);}function
rowDescription($Q){return"";}function
rowDescriptions($K,$fd){return$K;}function
selectLink($X,$n){}function
selectVal($X,$A,$n,$Ff){$I=($X===null?"<i>NULL</i>":(preg_match("~char|binary|boolean~",$n["type"])&&!preg_match("~var~",$n["type"])?"<code>$X</code>":$X));if(preg_match('~blob|bytea|raw|file~',$n["type"])&&!is_utf8($X))$I="<i>".lang(array('%d byte','%d bytes'),strlen($Ff))."</i>";if(preg_match('~json~',$n["type"]))$I="<code class='jush-js'>$I</code>";return($A?"<a href='".h($A)."'".(is_url($A)?target_blank():"").">$I</a>":$I);}function
editVal($X,$n){return$X;}function
tableStructurePrint($o){echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap'>\n","<thead><tr><th>".'Column'."<td>".'Type'.(support("comment")?"<td>".'Comment':"")."</thead>\n";foreach($o
as$n){echo"<tr".odd()."><th>".h($n["field"]),"<td><span title='".h($n["collation"])."'>".h($n["full_type"])."</span>",($n["null"]?" <i>NULL</i>":""),($n["auto_increment"]?" <i>".'Auto Increment'."</i>":""),(isset($n["default"])?" <span title='".'Default value'."'>[<b>".h($n["default"])."</b>]</span>":""),(support("comment")?"<td>".h($n["comment"]):""),"\n";}echo"</table>\n","</div>\n";}function
tableIndexesPrint($x){echo"<table cellspacing='0'>\n";foreach($x
as$D=>$w){ksort($w["columns"]);$lg=array();foreach($w["columns"]as$z=>$X)$lg[]="<i>".h($X)."</i>".($w["lengths"][$z]?"(".$w["lengths"][$z].")":"").($w["descs"][$z]?" DESC":"");echo"<tr title='".h($D)."'><th>$w[type]<td>".implode(", ",$lg)."\n";}echo"</table>\n";}function
selectColumnsPrint($L,$e){global$ld,$rd;print_fieldset("select",'Select',$L);$t=0;$L[""]=array();foreach($L
as$z=>$X){$X=$_GET["columns"][$z];$d=select_input(" name='columns[$t][col]'",$e,$X["col"],($z!==""?"selectFieldChange":"selectAddRow"));echo"<div>".($ld||$rd?"<select name='columns[$t][fun]'>".optionlist(array(-1=>"")+array_filter(array('Functions'=>$ld,'Aggregation'=>$rd)),$X["fun"])."</select>".on_help("getTarget(event).value && getTarget(event).value.replace(/ |\$/, '(') + ')'",1).script("qsl('select').onchange = function () { helpClose();".($z!==""?"":" qsl('select, input', this.parentNode).onchange();")." };","")."($d)":$d)."</div>\n";$t++;}echo"</div></fieldset>\n";}function
selectSearchPrint($Z,$e,$x){print_fieldset("search",'Search',$Z);foreach($x
as$t=>$w){if($w["type"]=="FULLTEXT"){echo"<div>(<i>".implode("</i>, <i>",array_map('h',$w["columns"]))."</i>) AGAINST"," <input type='search' name='fulltext[$t]' value='".h($_GET["fulltext"][$t])."'>",script("qsl('input').oninput = selectFieldChange;",""),checkbox("boolean[$t]",1,isset($_GET["boolean"][$t]),"BOOL"),"</div>\n";}}$Ya="this.parentNode.firstChild.onchange();";foreach(array_merge((array)$_GET["where"],array(array()))as$t=>$X){if(!$X||("$X[col]$X[val]"!=""&&in_array($X["op"],$this->operators))){echo"<div>".select_input(" name='where[$t][col]'",$e,$X["col"],($X?"selectFieldChange":"selectAddRow"),"(".'anywhere'.")"),html_select("where[$t][op]",$this->operators,$X["op"],$Ya),"<input type='search' name='where[$t][val]' value='".h($X["val"])."'>",script("mixin(qsl('input'), {oninput: function () { $Ya }, onkeydown: selectSearchKeydown, onsearch: selectSearchSearch});",""),"</div>\n";}}echo"</div></fieldset>\n";}function
selectOrderPrint($yf,$e,$x){print_fieldset("sort",'Sort',$yf);$t=0;foreach((array)$_GET["order"]as$z=>$X){if($X!=""){echo"<div>".select_input(" name='order[$t]'",$e,$X,"selectFieldChange"),checkbox("desc[$t]",1,isset($_GET["desc"][$z]),'descending')."</div>\n";$t++;}}echo"<div>".select_input(" name='order[$t]'",$e,"","selectAddRow"),checkbox("desc[$t]",1,false,'descending')."</div>\n","</div></fieldset>\n";}function
selectLimitPrint($_){echo"<fieldset><legend>".'Limit'."</legend><div>";echo"<input type='number' name='limit' class='size' value='".h($_)."'>",script("qsl('input').oninput = selectFieldChange;",""),"</div></fieldset>\n";}function
selectLengthPrint($bi){if($bi!==null){echo"<fieldset><legend>".'Text length'."</legend><div>","<input type='number' name='text_length' class='size' value='".h($bi)."'>","</div></fieldset>\n";}}function
selectActionPrint($x){echo"<fieldset><legend>".'Action'."</legend><div>","<input type='submit' value='".'Select'."'>"," <span id='noindex' title='".'Full table scan'."'></span>","<script".nonce().">\n","var indexColumns = ";$e=array();foreach($x
as$w){$Ob=reset($w["columns"]);if($w["type"]!="FULLTEXT"&&$Ob)$e[$Ob]=1;}$e[""]=1;foreach($e
as$z=>$X)json_row($z);echo";\n","selectFieldChange.call(qs('#form')['select']);\n","</script>\n","</div></fieldset>\n";}function
selectCommandPrint(){return!information_schema(DB);}function
selectImportPrint(){return!information_schema(DB);}function
selectEmailPrint($uc,$e){}function
selectColumnsProcess($e,$x){global$ld,$rd;$L=array();$od=array();foreach((array)$_GET["columns"]as$z=>$X){if($X["fun"]=="count"||($X["col"]!=""&&(!$X["fun"]||in_array($X["fun"],$ld)||in_array($X["fun"],$rd)))){$L[$z]=apply_sql_function($X["fun"],($X["col"]!=""?idf_escape($X["col"]):"*"));if(!in_array($X["fun"],$rd))$od[]=$L[$z];}}return
array($L,$od);}function
selectSearchProcess($o,$x){global$f,$l;$I=array();foreach($x
as$t=>$w){if($w["type"]=="FULLTEXT"&&$_GET["fulltext"][$t]!="")$I[]="MATCH (".implode(", ",array_map('idf_escape',$w["columns"])).") AGAINST (".q($_GET["fulltext"][$t]).(isset($_GET["boolean"][$t])?" IN BOOLEAN MODE":"").")";}foreach((array)$_GET["where"]as$z=>$X){if("$X[col]$X[val]"!=""&&in_array($X["op"],$this->operators)){$hg="";$ub=" $X[op]";if(preg_match('~IN$~',$X["op"])){$Id=process_length($X["val"]);$ub.=" ".($Id!=""?$Id:"(NULL)");}elseif($X["op"]=="SQL")$ub=" $X[val]";elseif($X["op"]=="LIKE %%")$ub=" LIKE ".$this->processInput($o[$X["col"]],"%$X[val]%");elseif($X["op"]=="ILIKE %%")$ub=" ILIKE ".$this->processInput($o[$X["col"]],"%$X[val]%");elseif($X["op"]=="FIND_IN_SET"){$hg="$X[op](".q($X["val"]).", ";$ub=")";}elseif(!preg_match('~NULL$~',$X["op"]))$ub.=" ".$this->processInput($o[$X["col"]],$X["val"]);if($X["col"]!="")$I[]=$hg.$l->convertSearch(idf_escape($X["col"]),$X,$o[$X["col"]]).$ub;else{$ob=array();foreach($o
as$D=>$n){if((preg_match('~^[-\d.'.(preg_match('~IN$~',$X["op"])?',':'').']+$~',$X["val"])||!preg_match('~'.number_type().'|bit~',$n["type"]))&&(!preg_match("~[\x80-\xFF]~",$X["val"])||preg_match('~char|text|enum|set~',$n["type"]))&&(!preg_match('~date|timestamp~',$n["type"])||preg_match('~^\d+-\d+-\d+~',$X["val"])))$ob[]=$hg.$l->convertSearch(idf_escape($D),$X,$n).$ub;}$I[]=($ob?"(".implode(" OR ",$ob).")":"1 = 0");}}}return$I;}function
selectOrderProcess($o,$x){$I=array();foreach((array)$_GET["order"]as$z=>$X){if($X!="")$I[]=(preg_match('~^((COUNT\(DISTINCT |[A-Z0-9_]+\()(`(?:[^`]|``)+`|"(?:[^"]|"")+")\)|COUNT\(\*\))$~',$X)?$X:idf_escape($X)).(isset($_GET["desc"][$z])?" DESC":"");}return$I;}function
selectLimitProcess(){return(isset($_GET["limit"])?$_GET["limit"]:"50");}function
selectLengthProcess(){return(isset($_GET["text_length"])?$_GET["text_length"]:"100");}function
selectEmailProcess($Z,$fd){return
false;}function
selectQueryBuild($L,$Z,$od,$yf,$_,$E){return"";}function
messageQuery($G,$ci,$Qc=false){global$y,$l;restart_session();$zd=&get_session("queries");if(!$zd[$_GET["db"]])$zd[$_GET["db"]]=array();if(strlen($G)>1e6)$G=preg_replace('~[\x80-\xFF]+$~','',substr($G,0,1e6))."\n…";$zd[$_GET["db"]][]=array($G,time(),$ci);$zh="sql-".count($zd[$_GET["db"]]);$I="<a href='#$zh' class='toggle'>".'SQL command'."</a>\n";if(!$Qc&&($aj=$l->warnings())){$u="warnings-".count($zd[$_GET["db"]]);$I="<a href='#$u' class='toggle'>".'Warnings'."</a>, $I<div id='$u' class='hidden'>\n$aj</div>\n";}return" <span class='time'>".@date("H:i:s")."</span>"." $I<div id='$zh' class='hidden'><pre><code class='jush-$y'>".shorten_utf8($G,1000)."</code></pre>".($ci?" <span class='time'>($ci)</span>":'').(support("sql")?'<p><a href="'.h(str_replace("db=".urlencode(DB),"db=".urlencode($_GET["db"]),ME).'sql=&history='.(count($zd[$_GET["db"]])-1)).'">'.'Edit'.'</a>':'').'</div>';}function
editRowPrint($Q,$o,$J,$Hi){}function
editFunctions($n){global$pc;$I=($n["null"]?"NULL/":"");$Hi=isset($_GET["select"])||where($_GET);foreach($pc
as$z=>$ld){if(!$z||(!isset($_GET["call"])&&$Hi)){foreach($ld
as$Yf=>$X){if(!$Yf||preg_match("~$Yf~",$n["type"]))$I.="/$X";}}if($z&&!preg_match('~set|blob|bytea|raw|file|bool~',$n["type"]))$I.="/SQL";}if($n["auto_increment"]&&!$Hi)$I='Auto Increment';return
explode("/",$I);}function
editInput($Q,$n,$Ha,$Y){if($n["type"]=="enum")return(isset($_GET["select"])?"<label><input type='radio'$Ha value='-1' checked><i>".'original'."</i></label> ":"").($n["null"]?"<label><input type='radio'$Ha value=''".($Y!==null||isset($_GET["select"])?"":" checked")."><i>NULL</i></label> ":"").enum_input("radio",$Ha,$n,$Y,0);return"";}function
editHint($Q,$n,$Y){return"";}function
processInput($n,$Y,$s=""){if($s=="SQL")return$Y;$D=$n["field"];$I=q($Y);if(preg_match('~^(now|getdate|uuid)$~',$s))$I="$s()";elseif(preg_match('~^current_(date|timestamp)$~',$s))$I=$s;elseif(preg_match('~^([+-]|\|\|)$~',$s))$I=idf_escape($D)." $s $I";elseif(preg_match('~^[+-] interval$~',$s))$I=idf_escape($D)." $s ".(preg_match("~^(\\d+|'[0-9.: -]') [A-Z_]+\$~i",$Y)?$Y:$I);elseif(preg_match('~^(addtime|subtime|concat)$~',$s))$I="$s(".idf_escape($D).", $I)";elseif(preg_match('~^(md5|sha1|password|encrypt)$~',$s))$I="$s($I)";return
unconvert_field($n,$I);}function
dumpOutput(){$I=array('text'=>'open','file'=>'save');if(function_exists('gzencode'))$I['gz']='gzip';return$I;}function
dumpFormat(){return
array('sql'=>'SQL','csv'=>'CSV,','csv;'=>'CSV;','tsv'=>'TSV');}function
dumpDatabase($k){}function
dumpTable($Q,$Gh,$be=0){if($_POST["format"]!="sql"){echo"\xef\xbb\xbf";if($Gh)dump_csv(array_keys(fields($Q)));}else{if($be==2){$o=array();foreach(fields($Q)as$D=>$n)$o[]=idf_escape($D)." $n[full_type]";$h="CREATE TABLE ".table($Q)." (".implode(", ",$o).")";}else$h=create_sql($Q,$_POST["auto_increment"],$Gh);set_utf8mb4($h);if($Gh&&$h){if($Gh=="DROP+CREATE"||$be==1)echo"DROP ".($be==2?"VIEW":"TABLE")." IF EXISTS ".table($Q).";\n";if($be==1)$h=remove_definer($h);echo"$h;\n\n";}}}function
dumpData($Q,$Gh,$G){global$f,$y;$De=($y=="sqlite"?0:1048576);if($Gh){if($_POST["format"]=="sql"){if($Gh=="TRUNCATE+INSERT")echo
truncate_sql($Q).";\n";$o=fields($Q);}$H=$f->query($G,1);if($H){$Ud="";$Va="";$ge=array();$Ih="";$Tc=($Q!=''?'fetch_assoc':'fetch_row');while($J=$H->$Tc()){if(!$ge){$Si=array();foreach($J
as$X){$n=$H->fetch_field();$ge[]=$n->name;$z=idf_escape($n->name);$Si[]="$z = VALUES($z)";}$Ih=($Gh=="INSERT+UPDATE"?"\nON DUPLICATE KEY UPDATE ".implode(", ",$Si):"").";\n";}if($_POST["format"]!="sql"){if($Gh=="table"){dump_csv($ge);$Gh="INSERT";}dump_csv($J);}else{if(!$Ud)$Ud="INSERT INTO ".table($Q)." (".implode(", ",array_map('idf_escape',$ge)).") VALUES";foreach($J
as$z=>$X){$n=$o[$z];$J[$z]=($X!==null?unconvert_field($n,preg_match(number_type(),$n["type"])&&!preg_match('~\[~',$n["full_type"])&&is_numeric($X)?$X:q(($X===false?0:$X))):"NULL");}$Wg=($De?"\n":" ")."(".implode(",\t",$J).")";if(!$Va)$Va=$Ud.$Wg;elseif(strlen($Va)+4+strlen($Wg)+strlen($Ih)<$De)$Va.=",$Wg";else{echo$Va.$Ih;$Va=$Ud.$Wg;}}}if($Va)echo$Va.$Ih;}elseif($_POST["format"]=="sql")echo"-- ".str_replace("\n"," ",$f->error)."\n";}}function
dumpFilename($Dd){return
friendly_url($Dd!=""?$Dd:(SERVER!=""?SERVER:"localhost"));}function
dumpHeaders($Dd,$Re=false){$If=$_POST["output"];$Lc=(preg_match('~sql~',$_POST["format"])?"sql":($Re?"tar":"csv"));header("Content-Type: ".($If=="gz"?"application/x-gzip":($Lc=="tar"?"application/x-tar":($Lc=="sql"||$If!="file"?"text/plain":"text/csv")."; charset=utf-8")));if($If=="gz")ob_start('ob_gzencode',1e6);return$Lc;}function
importServerPath(){return"adminer.sql";}function
homepage(){echo'<p class="links">'.($_GET["ns"]==""&&support("database")?'<a href="'.h(ME).'database=">'.'Alter database'."</a>\n":""),(support("scheme")?"<a href='".h(ME)."scheme='>".($_GET["ns"]!=""?'Alter schema':'Create schema')."</a>\n":""),($_GET["ns"]!==""?'<a href="'.h(ME).'schema=">'.'Database schema'."</a>\n":""),(support("privileges")?"<a href='".h(ME)."privileges='>".'Privileges'."</a>\n":"");return
true;}function
navigation($Qe){global$ia,$y,$hc,$f;echo'<h1>
',$this->name(),' <span class="version">',$ia,'</span>
<a href="https://www.adminer.org/#download"',target_blank(),' id="version">',(version_compare($ia,$_COOKIE["adminer_version"])<0?h($_COOKIE["adminer_version"]):""),'</a>
</h1>
';if($Qe=="auth"){$If="";foreach((array)$_SESSION["pwds"]as$Ui=>$kh){foreach($kh
as$M=>$Pi){foreach($Pi
as$V=>$F){if($F!==null){$Ub=$_SESSION["db"][$Ui][$M][$V];foreach(($Ub?array_keys($Ub):array(""))as$k)$If.="<li><a href='".h(auth_url($Ui,$M,$V,$k))."'>($hc[$Ui]) ".h($V.($M!=""?"@".$this->serverName($M):"").($k!=""?" - $k":""))."</a>\n";}}}}if($If)echo"<ul id='logins'>\n$If</ul>\n".script("mixin(qs('#logins'), {onmouseover: menuOver, onmouseout: menuOut});");}else{if($_GET["ns"]!==""&&!$Qe&&DB!=""){$f->select_db(DB);$S=table_status('',true);}echo
script_src(preg_replace("~\\?.*~","",ME)."?file=jush.js&version=4.8.0");if(support("sql")){echo'<script',nonce(),'>
';if($S){$ve=array();foreach($S
as$Q=>$T)$ve[]=preg_quote($Q,'/');echo"var jushLinks = { $y: [ '".js_escape(ME).(support("table")?"table=":"select=")."\$&', /\\b(".implode("|",$ve).")\\b/g ] };\n";foreach(array("bac","bra","sqlite_quo","mssql_bra")as$X)echo"jushLinks.$X = jushLinks.$y;\n";}$jh=$f->server_info;echo'bodyLoad(\'',(is_object($f)?preg_replace('~^(\d\.?\d).*~s','\1',$jh):""),'\'',(preg_match('~MariaDB~',$jh)?", true":""),');
</script>
';}$this->databasesPrint($Qe);if(DB==""||!$Qe){echo"<p class='links'>".(support("sql")?"<a href='".h(ME)."sql='".bold(isset($_GET["sql"])&&!isset($_GET["import"])).">".'SQL command'."</a>\n<a href='".h(ME)."import='".bold(isset($_GET["import"])).">".'Import'."</a>\n":"")."";if(support("dump"))echo"<a href='".h(ME)."dump=".urlencode(isset($_GET["table"])?$_GET["table"]:$_GET["select"])."' id='dump'".bold(isset($_GET["dump"])).">".'Export'."</a>\n";}if($_GET["ns"]!==""&&!$Qe&&DB!=""){echo'<a href="'.h(ME).'create="'.bold($_GET["create"]==="").">".'Create table'."</a>\n";if(!$S)echo"<p class='message'>".'No tables.'."\n";else$this->tablesPrint($S);}}}function
databasesPrint($Qe){global$b,$f;$j=$this->databases();if(DB&&$j&&!in_array(DB,$j))array_unshift($j,DB);echo'<form action="">
<p id="dbs">
';hidden_fields_get();$Sb=script("mixin(qsl('select'), {onmousedown: dbMouseDown, onchange: dbChange});");echo"<span title='".'database'."'>".'DB'."</span>: ".($j?"<select name='db'>".optionlist(array(""=>"")+$j,DB)."</select>$Sb":"<input name='db' value='".h(DB)."' autocapitalize='off'>\n"),"<input type='submit' value='".'Use'."'".($j?" class='hidden'":"").">\n";if($Qe!="db"&&DB!=""&&$f->select_db(DB)){if(support("scheme")){echo"<br>".'Schema'.": <select name='ns'>".optionlist(array(""=>"")+$b->schemas(),$_GET["ns"])."</select>$Sb";if($_GET["ns"]!="")set_schema($_GET["ns"]);}}foreach(array("import","sql","schema","dump","privileges")as$X){if(isset($_GET[$X])){echo"<input type='hidden' name='$X' value=''>";break;}}echo"</p></form>\n";}function
tablesPrint($S){echo"<ul id='tables'>".script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");foreach($S
as$Q=>$O){$D=$this->tableName($O);if($D!=""){echo'<li><a href="'.h(ME).'select='.urlencode($Q).'"'.bold($_GET["select"]==$Q||$_GET["edit"]==$Q,"select")." title='".'Select data'."'>".'select'."</a> ",(support("table")||support("indexes")?'<a href="'.h(ME).'table='.urlencode($Q).'"'.bold(in_array($Q,array($_GET["table"],$_GET["create"],$_GET["indexes"],$_GET["foreign"],$_GET["trigger"])),(is_view($O)?"view":"structure"))." title='".'Show structure'."'>$D</a>":"<span>$D</span>")."\n";}}echo"</ul>\n";}}$b=(function_exists('adminer_object')?adminer_object():new
Adminer);$hc=array("server"=>"MySQL")+$hc;if(!defined("DRIVER")){define("DRIVER","server");if(extension_loaded("mysqli")){class
Min_DB
extends
MySQLi{var$extension="MySQLi";function
__construct(){parent::init();}function
connect($M="",$V="",$F="",$i=null,$cg=null,$sh=null){global$b;mysqli_report(MYSQLI_REPORT_OFF);list($Bd,$cg)=explode(":",$M,2);$Ah=$b->connectSsl();if($Ah)$this->ssl_set($Ah['key'],$Ah['cert'],$Ah['ca'],'','');$I=@$this->real_connect(($M!=""?$Bd:ini_get("mysqli.default_host")),($M.$V!=""?$V:ini_get("mysqli.default_user")),($M.$V.$F!=""?$F:ini_get("mysqli.default_pw")),$i,(is_numeric($cg)?$cg:ini_get("mysqli.default_port")),(!is_numeric($cg)?$cg:$sh),($Ah?64:0));$this->options(MYSQLI_OPT_LOCAL_INFILE,false);return$I;}function
set_charset($Za){if(parent::set_charset($Za))return
true;parent::set_charset('utf8');return$this->query("SET NAMES $Za");}function
result($G,$n=0){$H=$this->query($G);if(!$H)return
false;$J=$H->fetch_array();return$J[$n];}function
quote($P){return"'".$this->escape_string($P)."'";}}}elseif(extension_loaded("mysql")&&!((ini_bool("sql.safe_mode")||ini_bool("mysql.allow_local_infile"))&&extension_loaded("pdo_mysql"))){class
Min_DB{var$extension="MySQL",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($M,$V,$F){if(ini_bool("mysql.allow_local_infile")){$this->error=sprintf('Disable %s or enable %s or %s extensions.',"'mysql.allow_local_infile'","MySQLi","PDO_MySQL");return
false;}$this->_link=@mysql_connect(($M!=""?$M:ini_get("mysql.default_host")),("$M$V"!=""?$V:ini_get("mysql.default_user")),("$M$V$F"!=""?$F:ini_get("mysql.default_password")),true,131072);if($this->_link)$this->server_info=mysql_get_server_info($this->_link);else$this->error=mysql_error();return(bool)$this->_link;}function
set_charset($Za){if(function_exists('mysql_set_charset')){if(mysql_set_charset($Za,$this->_link))return
true;mysql_set_charset('utf8',$this->_link);}return$this->query("SET NAMES $Za");}function
quote($P){return"'".mysql_real_escape_string($P,$this->_link)."'";}function
select_db($i){return
mysql_select_db($i,$this->_link);}function
query($G,$Ai=false){$H=@($Ai?mysql_unbuffered_query($G,$this->_link):mysql_query($G,$this->_link));$this->error="";if(!$H){$this->errno=mysql_errno($this->_link);$this->error=mysql_error($this->_link);return
false;}if($H===true){$this->affected_rows=mysql_affected_rows($this->_link);$this->info=mysql_info($this->_link);return
true;}return
new
Min_Result($H);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$n=0){$H=$this->query($G);if(!$H||!$H->num_rows)return
false;return
mysql_result($H->_result,0,$n);}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($H){$this->_result=$H;$this->num_rows=mysql_num_rows($H);}function
fetch_assoc(){return
mysql_fetch_assoc($this->_result);}function
fetch_row(){return
mysql_fetch_row($this->_result);}function
fetch_field(){$I=mysql_fetch_field($this->_result,$this->_offset++);$I->orgtable=$I->table;$I->orgname=$I->name;$I->charsetnr=($I->blob?63:0);return$I;}function
__destruct(){mysql_free_result($this->_result);}}}elseif(extension_loaded("pdo_mysql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_MySQL";function
connect($M,$V,$F){global$b;$wf=array(PDO::MYSQL_ATTR_LOCAL_INFILE=>false);$Ah=$b->connectSsl();if($Ah){if(!empty($Ah['key']))$wf[PDO::MYSQL_ATTR_SSL_KEY]=$Ah['key'];if(!empty($Ah['cert']))$wf[PDO::MYSQL_ATTR_SSL_CERT]=$Ah['cert'];if(!empty($Ah['ca']))$wf[PDO::MYSQL_ATTR_SSL_CA]=$Ah['ca'];}$this->dsn("mysql:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$M)),$V,$F,$wf);return
true;}function
set_charset($Za){$this->query("SET NAMES $Za");}function
select_db($i){return$this->query("USE ".idf_escape($i));}function
query($G,$Ai=false){$this->pdo->setAttribute(1000,!$Ai);return
parent::query($G,$Ai);}}}class
Min_Driver
extends
Min_SQL{function
insert($Q,$N){return($N?parent::insert($Q,$N):queries("INSERT INTO ".table($Q)." ()\nVALUES ()"));}function
insertUpdate($Q,$K,$jg){$e=array_keys(reset($K));$hg="INSERT INTO ".table($Q)." (".implode(", ",$e).") VALUES\n";$Si=array();foreach($e
as$z)$Si[$z]="$z = VALUES($z)";$Ih="\nON DUPLICATE KEY UPDATE ".implode(", ",$Si);$Si=array();$se=0;foreach($K
as$N){$Y="(".implode(", ",$N).")";if($Si&&(strlen($hg)+$se+strlen($Y)+strlen($Ih)>1e6)){if(!queries($hg.implode(",\n",$Si).$Ih))return
false;$Si=array();$se=0;}$Si[]=$Y;$se+=strlen($Y)+2;}return
queries($hg.implode(",\n",$Si).$Ih);}function
slowQuery($G,$di){if(min_version('5.7.8','10.1.2')){if(preg_match('~MariaDB~',$this->_conn->server_info))return"SET STATEMENT max_statement_time=$di FOR $G";elseif(preg_match('~^(SELECT\b)(.+)~is',$G,$C))return"$C[1] /*+ MAX_EXECUTION_TIME(".($di*1000).") */ $C[2]";}}function
convertSearch($v,$X,$n){return(preg_match('~char|text|enum|set~',$n["type"])&&!preg_match("~^utf8~",$n["collation"])&&preg_match('~[\x80-\xFF]~',$X['val'])?"CONVERT($v USING ".charset($this->_conn).")":$v);}function
warnings(){$H=$this->_conn->query("SHOW WARNINGS");if($H&&$H->num_rows){ob_start();select($H);return
ob_get_clean();}}function
tableHelp($D){$ze=preg_match('~MariaDB~',$this->_conn->server_info);if(information_schema(DB))return
strtolower(($ze?"information-schema-$D-table/":str_replace("_","-",$D)."-table.html"));if(DB=="mysql")return($ze?"mysql$D-table/":"system-database.html");}}function
idf_escape($v){return"`".str_replace("`","``",$v)."`";}function
table($v){return
idf_escape($v);}function
connect(){global$b,$U,$Fh;$f=new
Min_DB;$Kb=$b->credentials();if($f->connect($Kb[0],$Kb[1],$Kb[2])){$f->set_charset(charset($f));$f->query("SET sql_quote_show_create = 1, autocommit = 1");if(min_version('5.7.8',10.2,$f)){$Fh['Strings'][]="json";$U["json"]=4294967295;}return$f;}$I=$f->error;if(function_exists('iconv')&&!is_utf8($I)&&strlen($Wg=iconv("windows-1250","utf-8",$I))>strlen($I))$I=$Wg;return$I;}function
get_databases($cd){$I=get_session("dbs");if($I===null){$G=(min_version(5)?"SELECT SCHEMA_NAME FROM information_schema.SCHEMATA ORDER BY SCHEMA_NAME":"SHOW DATABASES");$I=($cd?slow_query($G):get_vals($G));restart_session();set_session("dbs",$I);stop_session();}return$I;}function
limit($G,$Z,$_,$gf=0,$gh=" "){return" $G$Z".($_!==null?$gh."LIMIT $_".($gf?" OFFSET $gf":""):"");}function
limit1($Q,$G,$Z,$gh="\n"){return
limit($G,$Z,1,0,$gh);}function
db_collation($k,$mb){global$f;$I=null;$h=$f->result("SHOW CREATE DATABASE ".idf_escape($k),1);if(preg_match('~ COLLATE ([^ ]+)~',$h,$C))$I=$C[1];elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$h,$C))$I=$mb[$C[1]][-1];return$I;}function
engines(){$I=array();foreach(get_rows("SHOW ENGINES")as$J){if(preg_match("~YES|DEFAULT~",$J["Support"]))$I[]=$J["Engine"];}return$I;}function
logged_user(){global$f;return$f->result("SELECT USER()");}function
tables_list(){return
get_key_vals(min_version(5)?"SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME":"SHOW TABLES");}function
count_tables($j){$I=array();foreach($j
as$k)$I[$k]=count(get_vals("SHOW TABLES IN ".idf_escape($k)));return$I;}function
table_status($D="",$Rc=false){$I=array();foreach(get_rows($Rc&&min_version(5)?"SELECT TABLE_NAME AS Name, ENGINE AS Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ".($D!=""?"AND TABLE_NAME = ".q($D):"ORDER BY Name"):"SHOW TABLE STATUS".($D!=""?" LIKE ".q(addcslashes($D,"%_\\")):""))as$J){if($J["Engine"]=="InnoDB")$J["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\1',$J["Comment"]);if(!isset($J["Engine"]))$J["Comment"]="";if($D!="")return$J;$I[$J["Name"]]=$J;}return$I;}function
is_view($R){return$R["Engine"]===null;}function
fk_support($R){return
preg_match('~InnoDB|IBMDB2I~i',$R["Engine"])||(preg_match('~NDB~i',$R["Engine"])&&min_version(5.6));}function
fields($Q){$I=array();foreach(get_rows("SHOW FULL COLUMNS FROM ".table($Q))as$J){preg_match('~^([^( ]+)(?:\((.+)\))?( unsigned)?( zerofill)?$~',$J["Type"],$C);$I[$J["Field"]]=array("field"=>$J["Field"],"full_type"=>$J["Type"],"type"=>$C[1],"length"=>$C[2],"unsigned"=>ltrim($C[3].$C[4]),"default"=>($J["Default"]!=""||preg_match("~char|set~",$C[1])?(preg_match('~text~',$C[1])?stripslashes(preg_replace("~^'(.*)'\$~",'\1',$J["Default"])):$J["Default"]):null),"null"=>($J["Null"]=="YES"),"auto_increment"=>($J["Extra"]=="auto_increment"),"on_update"=>(preg_match('~^on update (.+)~i',$J["Extra"],$C)?$C[1]:""),"collation"=>$J["Collation"],"privileges"=>array_flip(preg_split('~, *~',$J["Privileges"])),"comment"=>$J["Comment"],"primary"=>($J["Key"]=="PRI"),"generated"=>preg_match('~^(VIRTUAL|PERSISTENT|STORED)~',$J["Extra"]),);}return$I;}function
indexes($Q,$g=null){$I=array();foreach(get_rows("SHOW INDEX FROM ".table($Q),$g)as$J){$D=$J["Key_name"];$I[$D]["type"]=($D=="PRIMARY"?"PRIMARY":($J["Index_type"]=="FULLTEXT"?"FULLTEXT":($J["Non_unique"]?($J["Index_type"]=="SPATIAL"?"SPATIAL":"INDEX"):"UNIQUE")));$I[$D]["columns"][]=$J["Column_name"];$I[$D]["lengths"][]=($J["Index_type"]=="SPATIAL"?null:$J["Sub_part"]);$I[$D]["descs"][]=null;}return$I;}function
foreign_keys($Q){global$f,$of;static$Yf='(?:`(?:[^`]|``)+`|"(?:[^"]|"")+")';$I=array();$Ib=$f->result("SHOW CREATE TABLE ".table($Q),1);if($Ib){preg_match_all("~CONSTRAINT ($Yf) FOREIGN KEY ?\\(((?:$Yf,? ?)+)\\) REFERENCES ($Yf)(?:\\.($Yf))? \\(((?:$Yf,? ?)+)\\)(?: ON DELETE ($of))?(?: ON UPDATE ($of))?~",$Ib,$Be,PREG_SET_ORDER);foreach($Be
as$C){preg_match_all("~$Yf~",$C[2],$uh);preg_match_all("~$Yf~",$C[5],$Vh);$I[idf_unescape($C[1])]=array("db"=>idf_unescape($C[4]!=""?$C[3]:$C[4]),"table"=>idf_unescape($C[4]!=""?$C[4]:$C[3]),"source"=>array_map('idf_unescape',$uh[0]),"target"=>array_map('idf_unescape',$Vh[0]),"on_delete"=>($C[6]?$C[6]:"RESTRICT"),"on_update"=>($C[7]?$C[7]:"RESTRICT"),);}}return$I;}function
adm_view($D){global$f;return
array("select"=>preg_replace('~^(?:[^`]|`[^`]*`)*\s+AS\s+~isU','',$f->result("SHOW CREATE VIEW ".table($D),1)));}function
collations(){$I=array();foreach(get_rows("SHOW COLLATION")as$J){if($J["Default"])$I[$J["Charset"]][-1]=$J["Collation"];else$I[$J["Charset"]][]=$J["Collation"];}ksort($I);foreach($I
as$z=>$X)asort($I[$z]);return$I;}function
information_schema($k){return(min_version(5)&&$k=="information_schema")||(min_version(5.5)&&$k=="performance_schema");}function
error(){global$f;return
h(preg_replace('~^You have an error.*syntax to use~U',"Syntax error",$f->error));}function
create_database($k,$lb){return
queries("CREATE DATABASE ".idf_escape($k).($lb?" COLLATE ".q($lb):""));}function
drop_databases($j){$I=apply_queries("DROP DATABASE",$j,'idf_escape');restart_session();set_session("dbs",null);return$I;}function
rename_database($D,$lb){$I=false;if(create_database($D,$lb)){$Ig=array();foreach(tables_list()as$Q=>$T)$Ig[]=table($Q)." TO ".idf_escape($D).".".table($Q);$I=(!$Ig||queries("RENAME TABLE ".implode(", ",$Ig)));if($I)queries("DROP DATABASE ".idf_escape(DB));restart_session();set_session("dbs",null);}return$I;}function
auto_increment(){$La=" PRIMARY KEY";if($_GET["create"]!=""&&$_POST["auto_increment_col"]){foreach(indexes($_GET["create"])as$w){if(in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"],$w["columns"],true)){$La="";break;}if($w["type"]=="PRIMARY")$La=" UNIQUE";}}return" AUTO_INCREMENT$La";}function
alter_table($Q,$D,$o,$ed,$rb,$xc,$lb,$Ka,$Sf){$c=array();foreach($o
as$n)$c[]=($n[1]?($Q!=""?($n[0]!=""?"CHANGE ".idf_escape($n[0]):"ADD"):" ")." ".implode($n[1]).($Q!=""?$n[2]:""):"DROP ".idf_escape($n[0]));$c=array_merge($c,$ed);$O=($rb!==null?" COMMENT=".q($rb):"").($xc?" ENGINE=".q($xc):"").($lb?" COLLATE ".q($lb):"").($Ka!=""?" AUTO_INCREMENT=$Ka":"");if($Q=="")return
queries("CREATE TABLE ".table($D)." (\n".implode(",\n",$c)."\n)$O$Sf");if($Q!=$D)$c[]="RENAME TO ".table($D);if($O)$c[]=ltrim($O);return($c||$Sf?queries("ALTER TABLE ".table($Q)."\n".implode(",\n",$c).$Sf):true);}function
alter_indexes($Q,$c){foreach($c
as$z=>$X)$c[$z]=($X[2]=="DROP"?"\nDROP INDEX ".idf_escape($X[1]):"\nADD $X[0] ".($X[0]=="PRIMARY"?"KEY ":"").($X[1]!=""?idf_escape($X[1])." ":"")."(".implode(", ",$X[2]).")");return
queries("ALTER TABLE ".table($Q).implode(",",$c));}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Xi){return
queries("DROP VIEW ".implode(", ",array_map('table',$Xi)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$Xi,$Vh){$Ig=array();foreach(array_merge($S,$Xi)as$Q)$Ig[]=table($Q)." TO ".idf_escape($Vh).".".table($Q);return
queries("RENAME TABLE ".implode(", ",$Ig));}function
copy_tables($S,$Xi,$Vh){queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");foreach($S
as$Q){$D=($Vh==DB?table("copy_$Q"):idf_escape($Vh).".".table($Q));if(($_POST["overwrite"]&&!queries("\nDROP TABLE IF EXISTS $D"))||!queries("CREATE TABLE $D LIKE ".table($Q))||!queries("INSERT INTO $D SELECT * FROM ".table($Q)))return
false;foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$J){$vi=$J["Trigger"];if(!queries("CREATE TRIGGER ".($Vh==DB?idf_escape("copy_$vi"):idf_escape($Vh).".".idf_escape($vi))." $J[Timing] $J[Event] ON $D FOR EACH ROW\n$J[Statement];"))return
false;}}foreach($Xi
as$Q){$D=($Vh==DB?table("copy_$Q"):idf_escape($Vh).".".table($Q));$Wi=adm_view($Q);if(($_POST["overwrite"]&&!queries("DROP VIEW IF EXISTS $D"))||!queries("CREATE VIEW $D AS $Wi[select]"))return
false;}return
true;}function
trigger($D){if($D=="")return
array();$K=get_rows("SHOW TRIGGERS WHERE `Trigger` = ".q($D));return
reset($K);}function
triggers($Q){$I=array();foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$J)$I[$J["Trigger"]]=array($J["Timing"],$J["Event"]);return$I;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
routine($D,$T){global$f,$zc,$Sd,$U;$Ba=array("bool","boolean","integer","double precision","real","dec","numeric","fixed","national char","national varchar");$vh="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$_i="((".implode("|",array_merge(array_keys($U),$Ba)).")\\b(?:\\s*\\(((?:[^'\")]|$zc)++)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";$Yf="$vh*(".($T=="FUNCTION"?"":$Sd).")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$_i";$h=$f->result("SHOW CREATE $T ".idf_escape($D),2);preg_match("~\\(((?:$Yf\\s*,?)*)\\)\\s*".($T=="FUNCTION"?"RETURNS\\s+$_i\\s+":"")."(.*)~is",$h,$C);$o=array();preg_match_all("~$Yf\\s*,?~is",$C[1],$Be,PREG_SET_ORDER);foreach($Be
as$Mf)$o[]=array("field"=>str_replace("``","`",$Mf[2]).$Mf[3],"type"=>strtolower($Mf[5]),"length"=>preg_replace_callback("~$zc~s",'normalize_enum',$Mf[6]),"unsigned"=>strtolower(preg_replace('~\s+~',' ',trim("$Mf[8] $Mf[7]"))),"null"=>1,"full_type"=>$Mf[4],"inout"=>strtoupper($Mf[1]),"collation"=>strtolower($Mf[9]),);if($T!="FUNCTION")return
array("fields"=>$o,"definition"=>$C[11]);return
array("fields"=>$o,"returns"=>array("type"=>$C[12],"length"=>$C[13],"unsigned"=>$C[15],"collation"=>$C[16]),"definition"=>$C[17],"language"=>"SQL",);}function
routines(){return
get_rows("SELECT ROUTINE_NAME AS SPECIFIC_NAME, ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB));}function
routine_languages(){return
array();}function
routine_id($D,$J){return
idf_escape($D);}function
last_id(){global$f;return$f->result("SELECT LAST_INSERT_ID()");}function
explain($f,$G){return$f->query("EXPLAIN ".(min_version(5.1)&&!min_version(5.7)?"PARTITIONS ":"").$G);}function
found_rows($R,$Z){return($Z||$R["Engine"]!="InnoDB"?null:$R["Rows"]);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($Yg,$g=null){return
true;}function
create_sql($Q,$Ka,$Gh){global$f;$I=$f->result("SHOW CREATE TABLE ".table($Q),1);if(!$Ka)$I=preg_replace('~ AUTO_INCREMENT=\d+~','',$I);return$I;}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
use_sql($i){return"USE ".idf_escape($i);}function
trigger_sql($Q){$I="";foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")),null,"-- ")as$J)$I.="\nCREATE TRIGGER ".idf_escape($J["Trigger"])." $J[Timing] $J[Event] ON ".table($J["Table"])." FOR EACH ROW\n$J[Statement];;\n";return$I;}function
show_variables(){return
get_key_vals("SHOW VARIABLES");}function
process_list(){return
get_rows("SHOW FULL PROCESSLIST");}function
show_status(){return
get_key_vals("SHOW STATUS");}function
convert_field($n){if(preg_match("~binary~",$n["type"]))return"HEX(".idf_escape($n["field"]).")";if($n["type"]=="bit")return"BIN(".idf_escape($n["field"])." + 0)";if(preg_match("~geometry|point|linestring|polygon~",$n["type"]))return(min_version(8)?"ST_":"")."AsWKT(".idf_escape($n["field"]).")";}function
unconvert_field($n,$I){if(preg_match("~binary~",$n["type"]))$I="UNHEX($I)";if($n["type"]=="bit")$I="CONV($I, 2, 10) + 0";if(preg_match("~geometry|point|linestring|polygon~",$n["type"]))$I=(min_version(8)?"ST_":"")."GeomFromText($I, SRID($n[field]))";return$I;}function
support($Sc){return!preg_match("~scheme|sequence|type|view_trigger|materializedview".(min_version(8)?"":"|descidx".(min_version(5.1)?"":"|event|partitioning".(min_version(5)?"":"|routine|trigger|view")))."~",$Sc);}function
kill_process($X){return
queries("KILL ".number($X));}function
connection_id(){return"SELECT CONNECTION_ID()";}function
max_connections(){global$f;return$f->result("SELECT @@max_connections");}function
driver_config(){$U=array();$Fh=array();foreach(array('Numbers'=>array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"decimal"=>66,"float"=>12,"double"=>21),'Date and time'=>array("date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4),'Strings'=>array("char"=>255,"varchar"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295),'Lists'=>array("enum"=>65535,"set"=>64),'Binary'=>array("bit"=>20,"binary"=>255,"varbinary"=>65535,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295),'Geometry'=>array("geometry"=>0,"point"=>0,"linestring"=>0,"polygon"=>0,"multipoint"=>0,"multilinestring"=>0,"multipolygon"=>0,"geometrycollection"=>0),)as$z=>$X){$U+=$X;$Fh[$z]=array_keys($X);}return
array('possible_drivers'=>array("MySQLi","MySQL","PDO_MySQL"),'jush'=>"sql",'types'=>$U,'structured_types'=>$Fh,'unsigned'=>array("unsigned","zerofill","unsigned zerofill"),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","REGEXP","IN","FIND_IN_SET","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL"),'functions'=>array("char_length","date","from_unixtime","lower","round","floor","ceil","sec_to_time","time_to_sec","upper"),'grouping'=>array("avg","count","count distinct","group_concat","max","min","sum"),'edit_functions'=>array(array("char"=>"md5/sha1/password/encrypt/uuid","binary"=>"md5/sha1","date|time"=>"now",),array(number_type()=>"+/-","date"=>"+ interval/- interval","time"=>"addtime/subtime","char|text"=>"concat",)),);}}$vb=driver_config();$gg=$vb['possible_drivers'];$y=$vb['jush'];$U=$vb['types'];$Fh=$vb['structured_types'];$Gi=$vb['unsigned'];$tf=$vb['operators'];$ld=$vb['functions'];$rd=$vb['grouping'];$pc=$vb['edit_functions'];if($b->operators===null)$b->operators=$tf;define("SERVER",$_GET[DRIVER]);define("DB",$_GET["db"]);define("ME",preg_replace('~\?.*~','',relative_uri()).'?'.(sid()?SID.'&':'').(SERVER!==null?DRIVER."=".urlencode(SERVER).'&':'').(isset($_GET["username"])?"username=".urlencode($_GET["username"]).'&':'').(DB!=""?'db='.urlencode(DB).'&'.(isset($_GET["ns"])?"ns=".urlencode($_GET["ns"])."&":""):''));$ia="4.8.0";function
page_header($fi,$m="",$Ua=array(),$gi=""){global$ca,$ia,$b,$hc,$y;page_headers();if(is_ajax()&&$m){page_messages($m);exit;}$hi=$fi.($gi!=""?": $gi":"");$ii=strip_tags($hi.(SERVER!=""&&SERVER!="localhost"?h(" - ".SERVER):"")." - ".$b->name());echo'<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<title>',$ii,'</title>
<link rel="stylesheet" type="text/css" href="',h(preg_replace("~\\?.*~","",ME)."?file=default.css&version=4.8.0"),'">
',script_src(preg_replace("~\\?.*~","",ME)."?file=functions.js&version=4.8.0");if($b->head()){echo'<link rel="shortcut icon" type="image/x-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.8.0"),'">
<link rel="apple-touch-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.8.0"),'">
';foreach($b->css()as$Mb){echo'<link rel="stylesheet" type="text/css" href="',h($Mb),'">
';}}echo'
<body class="ltr nojs">
';$p=get_temp_dir()."/adminer.version";if(!$_COOKIE["adminer_version"]&&function_exists('openssl_verify')&&file_exists($p)&&filemtime($p)+86400>time()){$Vi=unserialize(file_get_contents($p));$sg="-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwqWOVuF5uw7/+Z70djoK
RlHIZFZPO0uYRezq90+7Amk+FDNd7KkL5eDve+vHRJBLAszF/7XKXe11xwliIsFs
DFWQlsABVZB3oisKCBEuI71J4kPH8dKGEWR9jDHFw3cWmoH3PmqImX6FISWbG3B8
h7FIx3jEaw5ckVPVTeo5JRm/1DZzJxjyDenXvBQ/6o9DgZKeNDgxwKzH+sw9/YCO
jHnq1cFpOIISzARlrHMa/43YfeNRAm/tsBXjSxembBPo7aQZLAWHmaj5+K19H10B
nCpz9Y++cipkVEiKRGih4ZEvjoFysEOdRLj6WiD/uUNky4xGeA6LaJqh5XpkFkcQ
fQIDAQAB
-----END PUBLIC KEY-----
";if(openssl_verify($Vi["version"],base64_decode($Vi["signature"]),$sg)==1)$_COOKIE["adminer_version"]=$Vi["version"];}echo'<script',nonce(),'>
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick',(isset($_COOKIE["adminer_version"])?"":", onload: partial(verifyVersion, '$ia', '".js_escape(ME)."', '".get_token()."')");?>});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = '<?php echo
js_escape('You are offline.'),'\';
var thousandsSeparator = \'',js_escape(','),'\';
</script>

<div id="help" class="jush-',$y,' jsonly hidden"></div>
',script("mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});"),'
<div id="content">
';if($Ua!==null){$A=substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1);echo'<p id="breadcrumb"><a href="'.h($A?$A:".").'">'.$hc[DRIVER].'</a> &raquo; ';$A=substr(preg_replace('~\b(db|ns)=[^&]*&~','',ME),0,-1);$M=$b->serverName(SERVER);$M=($M!=""?$M:'Server');if($Ua===false)echo"$M\n";else{echo"<a href='".h($A)."' accesskey='1' title='Alt+Shift+1'>$M</a> &raquo; ";if($_GET["ns"]!=""||(DB!=""&&is_array($Ua)))echo'<a href="'.h($A."&db=".urlencode(DB).(support("scheme")?"&ns=":"")).'">'.h(DB).'</a> &raquo; ';if(is_array($Ua)){if($_GET["ns"]!="")echo'<a href="'.h(substr(ME,0,-1)).'">'.h($_GET["ns"]).'</a> &raquo; ';foreach($Ua
as$z=>$X){$ac=(is_array($X)?$X[1]:h($X));if($ac!="")echo"<a href='".h(ME."$z=").urlencode(is_array($X)?$X[0]:$X)."'>$ac</a> &raquo; ";}}echo"$fi\n";}}echo"<h2>$hi</h2>\n","<div id='ajaxstatus' class='jsonly hidden'></div>\n";restart_session();page_messages($m);$j=&get_session("dbs");if(DB!=""&&$j&&!in_array(DB,$j,true))$j=null;stop_session();define("PAGE_HEADER",1);}function
page_headers(){global$b;header("Content-Type: text/html; charset=utf-8");header("Cache-Control: no-cache");header("X-Frame-Options: deny");header("X-XSS-Protection: 0");header("X-Content-Type-Options: nosniff");header("Referrer-Policy: origin-when-cross-origin");foreach($b->csp()as$Lb){$xd=array();foreach($Lb
as$z=>$X)$xd[]="$z $X";header("Content-Security-Policy: ".implode("; ",$xd));}$b->headers();}function
csp(){return
array(array("script-src"=>"'self' 'unsafe-inline' 'nonce-".get_nonce()."' 'strict-dynamic'","connect-src"=>"'self'","frame-src"=>"https://www.adminer.org","object-src"=>"'none'","base-uri"=>"'none'","form-action"=>"'self'",),);}function
get_nonce(){static$af;if(!$af)$af=base64_encode(rand_string());return$af;}function
page_messages($m){$Ii=preg_replace('~^[^?]*~','',$_SERVER["REQUEST_URI"]);$Ne=$_SESSION["messages"][$Ii];if($Ne){echo"<div class='message'>".implode("</div>\n<div class='message'>",$Ne)."</div>".script("messagesPrint();");unset($_SESSION["messages"][$Ii]);}if($m)echo"<div class='error'>$m</div>\n";}function
page_footer($Qe=""){global$b,$mi;echo'</div>

';if($Qe!="auth"){echo'<form action="" method="post">
<p class="logout">
<input type="submit" name="logout" value="Logout" id="logout">
<input type="hidden" name="token" value="',$mi,'">
</p>
</form>
';}echo'<div id="menu">
';$b->navigation($Qe);echo'</div>
',script("setupSubmitHighlight(document);");}function
int32($Te){while($Te>=2147483648)$Te-=4294967296;while($Te<=-2147483649)$Te+=4294967296;return(int)$Te;}function
long2str($W,$Zi){$Wg='';foreach($W
as$X)$Wg.=pack('V',$X);if($Zi)return
substr($Wg,0,end($W));return$Wg;}function
str2long($Wg,$Zi){$W=array_values(unpack('V*',str_pad($Wg,4*ceil(strlen($Wg)/4),"\0")));if($Zi)$W[]=strlen($Wg);return$W;}function
xxtea_mx($lj,$kj,$Jh,$ee){return
int32((($lj>>5&0x7FFFFFF)^$kj<<2)+(($kj>>3&0x1FFFFFFF)^$lj<<4))^int32(($Jh^$kj)+($ee^$lj));}function
encrypt_string($Eh,$z){if($Eh=="")return"";$z=array_values(unpack("V*",pack("H*",md5($z))));$W=str2long($Eh,true);$Te=count($W)-1;$lj=$W[$Te];$kj=$W[0];$tg=floor(6+52/($Te+1));$Jh=0;while($tg-->0){$Jh=int32($Jh+0x9E3779B9);$oc=$Jh>>2&3;for($Kf=0;$Kf<$Te;$Kf++){$kj=$W[$Kf+1];$Se=xxtea_mx($lj,$kj,$Jh,$z[$Kf&3^$oc]);$lj=int32($W[$Kf]+$Se);$W[$Kf]=$lj;}$kj=$W[0];$Se=xxtea_mx($lj,$kj,$Jh,$z[$Kf&3^$oc]);$lj=int32($W[$Te]+$Se);$W[$Te]=$lj;}return
long2str($W,false);}function
decrypt_string($Eh,$z){if($Eh=="")return"";if(!$z)return
false;$z=array_values(unpack("V*",pack("H*",md5($z))));$W=str2long($Eh,false);$Te=count($W)-1;$lj=$W[$Te];$kj=$W[0];$tg=floor(6+52/($Te+1));$Jh=int32($tg*0x9E3779B9);while($Jh){$oc=$Jh>>2&3;for($Kf=$Te;$Kf>0;$Kf--){$lj=$W[$Kf-1];$Se=xxtea_mx($lj,$kj,$Jh,$z[$Kf&3^$oc]);$kj=int32($W[$Kf]-$Se);$W[$Kf]=$kj;}$lj=$W[$Te];$Se=xxtea_mx($lj,$kj,$Jh,$z[$Kf&3^$oc]);$kj=int32($W[0]-$Se);$W[0]=$kj;$Jh=int32($Jh-0x9E3779B9);}return
long2str($W,true);}$f='';$wd=$_SESSION["token"];if(!$wd)$_SESSION["token"]=rand(1,1e6);$mi=get_token();$ag=array();if($_COOKIE["adminer_permanent"]){foreach(explode(" ",$_COOKIE["adminer_permanent"])as$X){list($z)=explode(":",$X);$ag[$z]=$X;}}function
add_invalid_login(){global$b;$r=file_open_lock(get_temp_dir()."/adminer.invalid");if(!$r)return;$Xd=unserialize(stream_get_contents($r));$ci=time();if($Xd){foreach($Xd
as$Yd=>$X){if($X[0]<$ci)unset($Xd[$Yd]);}}$Wd=&$Xd[$b->bruteForceKey()];if(!$Wd)$Wd=array($ci+30*60,0);$Wd[1]++;file_write_unlock($r,serialize($Xd));}function
check_invalid_login(){global$b;$Xd=unserialize(@file_get_contents(get_temp_dir()."/adminer.invalid"));$Wd=$Xd[$b->bruteForceKey()];$Ze=($Wd[1]>29?$Wd[0]-time():0);if($Ze>0)auth_error(lang(array('Too many unsuccessful logins, try again in %d minute.','Too many unsuccessful logins, try again in %d minutes.'),ceil($Ze/60)));}$Ia=$_POST["auth"];if($Ia){session_regenerate_id();$Ui=$Ia["driver"];$M=$Ia["server"];$V=$Ia["username"];$F=(string)$Ia["password"];$k=$Ia["db"];set_password($Ui,$M,$V,$F);$_SESSION["db"][$Ui][$M][$V][$k]=true;if($Ia["permanent"]){$z=base64_encode($Ui)."-".base64_encode($M)."-".base64_encode($V)."-".base64_encode($k);$mg=$b->permanentLogin(true);$ag[$z]="$z:".base64_encode($mg?encrypt_string($F,$mg):"");adm_cookie("adminer_permanent",implode(" ",$ag));}if(count($_POST)==1||DRIVER!=$Ui||SERVER!=$M||$_GET["username"]!==$V||DB!=$k)adm_redirect(auth_url($Ui,$M,$V,$k));}elseif($_POST["logout"]&&(!$wd||verify_token())){foreach(array("pwds","db","dbs","queries")as$z)set_session($z,null);unset_permanent();adm_redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1),'Logout successful.'.' '.'Thanks for using Adminer, consider <a href="https://www.adminer.org/en/donation/">donating</a>.');}elseif($ag&&!$_SESSION["pwds"]){session_regenerate_id();$mg=$b->permanentLogin();foreach($ag
as$z=>$X){list(,$fb)=explode(":",$X);list($Ui,$M,$V,$k)=array_map('base64_decode',explode("-",$z));set_password($Ui,$M,$V,decrypt_string(base64_decode($fb),$mg));$_SESSION["db"][$Ui][$M][$V][$k]=true;}}function
unset_permanent(){global$ag;foreach($ag
as$z=>$X){list($Ui,$M,$V,$k)=array_map('base64_decode',explode("-",$z));if($Ui==DRIVER&&$M==SERVER&&$V==$_GET["username"]&&$k==DB)unset($ag[$z]);}adm_cookie("adminer_permanent",implode(" ",$ag));}function
auth_error($m){global$b,$wd;$lh=session_name();if(isset($_GET["username"])){header("HTTP/1.1 403 Forbidden");if(($_COOKIE[$lh]||$_GET[$lh])&&!$wd)$m='Session expired, please login again.';else{restart_session();add_invalid_login();$F=get_password();if($F!==null){if($F===false)$m.=($m?'<br>':'').sprintf('Master password expired. <a href="https://www.adminer.org/en/extension/"%s>Implement</a> %s method to make it permanent.',target_blank(),'<code>permanentLogin()</code>');set_password(DRIVER,SERVER,$_GET["username"],null);}unset_permanent();}}if(!$_COOKIE[$lh]&&$_GET[$lh]&&ini_bool("session.use_only_cookies"))$m='Session support must be enabled.';$Nf=session_get_cookie_params();adm_cookie("adminer_key",($_COOKIE["adminer_key"]?$_COOKIE["adminer_key"]:rand_string()),$Nf["lifetime"]);page_header('Login',$m,null);echo"<form action='' method='post'>\n","<div>";if(hidden_fields($_POST,array("auth")))echo"<p class='message'>".'The action will be performed after successful login with the same credentials.'."\n";echo"</div>\n";$b->loginForm();echo"</form>\n";page_footer("auth");exit;}if(isset($_GET["username"])&&!class_exists("Min_DB")){unset($_SESSION["pwds"][DRIVER]);unset_permanent();page_header('No extension',sprintf('None of the supported PHP extensions (%s) are available.',implode(", ",$gg)),false);page_footer("auth");exit;}stop_session(true);if(isset($_GET["username"])&&is_string(get_password())){list($Bd,$cg)=explode(":",SERVER,2);if(preg_match('~^\s*([-+]?\d+)~',$cg,$C)&&($C[1]<1024||$C[1]>65535))auth_error('Connecting to privileged ports is not allowed.');check_invalid_login();$f=connect();$l=new
Min_Driver($f);}$we=null;if(!is_object($f)||($we=$b->login($_GET["username"],get_password()))!==true){$m=(is_string($f)?h($f):(is_string($we)?$we:'Invalid credentials.'));auth_error($m.(preg_match('~^ | $~',get_password())?'<br>'.'There is a space in the input password which might be the cause.':''));}if($_POST["logout"]&&$wd&&!verify_token()){page_header('Logout','Invalid CSRF token. Send the form again.');page_footer("db");exit;}if($Ia&&$_POST["token"])$_POST["token"]=$mi;$m='';if($_POST){if(!verify_token()){$Rd="max_input_vars";$He=ini_get($Rd);if(extension_loaded("suhosin")){foreach(array("suhosin.request.max_vars","suhosin.post.max_vars")as$z){$X=ini_get($z);if($X&&(!$He||$X<$He)){$Rd=$z;$He=$X;}}}$m=(!$_POST["token"]&&$He?sprintf('Maximum number of allowed fields exceeded. Please increase %s.',"'$Rd'"):'Invalid CSRF token. Send the form again.'.' '.'If you did not send this request from Adminer then close this page.');}}elseif($_SERVER["REQUEST_METHOD"]=="POST"){$m=sprintf('Too big POST data. Reduce the data or increase the %s configuration directive.',"'post_max_size'");if(isset($_GET["sql"]))$m.=' '.'You can upload a big SQL file via FTP and import it from server.';}function
select($H,$g=null,$Af=array(),$_=0){global$y;$ve=array();$x=array();$e=array();$Sa=array();$U=array();$I=array();odd('');for($t=0;(!$_||$t<$_)&&($J=$H->fetch_row());$t++){if(!$t){echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap'>\n","<thead><tr>";for($de=0;$de<count($J);$de++){$n=$H->fetch_field();$D=$n->name;$_f=$n->orgtable;$zf=$n->orgname;$I[$n->table]=$_f;if($Af&&$y=="sql")$ve[$de]=($D=="table"?"table=":($D=="possible_keys"?"indexes=":null));elseif($_f!=""){if(!isset($x[$_f])){$x[$_f]=array();foreach(indexes($_f,$g)as$w){if($w["type"]=="PRIMARY"){$x[$_f]=array_flip($w["columns"]);break;}}$e[$_f]=$x[$_f];}if(isset($e[$_f][$zf])){unset($e[$_f][$zf]);$x[$_f][$zf]=$de;$ve[$de]=$_f;}}if($n->charsetnr==63)$Sa[$de]=true;$U[$de]=$n->type;echo"<th".($_f!=""||$n->name!=$zf?" title='".h(($_f!=""?"$_f.":"").$zf)."'":"").">".h($D).($Af?doc_link(array('sql'=>"explain-output.html#explain_".strtolower($D),'mariadb'=>"explain/#the-columns-in-explain-select",)):"");}echo"</thead>\n";}echo"<tr".odd().">";foreach($J
as$z=>$X){$A="";if(isset($ve[$z])&&!$e[$ve[$z]]){if($Af&&$y=="sql"){$Q=$J[array_search("table=",$ve)];$A=ME.$ve[$z].urlencode($Af[$Q]!=""?$Af[$Q]:$Q);}else{$A=ME."edit=".urlencode($ve[$z]);foreach($x[$ve[$z]]as$jb=>$de)$A.="&where".urlencode("[".bracket_escape($jb)."]")."=".urlencode($J[$de]);}}elseif(is_url($X))$A=$X;if($X===null)$X="<i>NULL</i>";elseif($Sa[$z]&&!is_utf8($X))$X="<i>".lang(array('%d byte','%d bytes'),strlen($X))."</i>";else{$X=h($X);if($U[$z]==254)$X="<code>$X</code>";}if($A)$X="<a href='".h($A)."'".(is_url($A)?target_blank():'').">$X</a>";echo"<td>$X";}}echo($t?"</table>\n</div>":"<p class='message'>".'No rows.')."\n";return$I;}function
referencable_primary($eh){$I=array();foreach(table_status('',true)as$Nh=>$Q){if($Nh!=$eh&&fk_support($Q)){foreach(fields($Nh)as$n){if($n["primary"]){if($I[$Nh]){unset($I[$Nh]);break;}$I[$Nh]=$n;}}}}return$I;}function
adminer_settings(){parse_str($_COOKIE["adminer_settings"],$nh);return$nh;}function
adminer_setting($z){$nh=adminer_settings();return$nh[$z];}function
set_adminer_settings($nh){return
adm_cookie("adminer_settings",http_build_query($nh+adminer_settings()));}function
textarea($D,$Y,$K=10,$ob=80){global$y;echo"<textarea name='$D' rows='$K' cols='$ob' class='sqlarea jush-$y' spellcheck='false' wrap='off'>";if(is_array($Y)){foreach($Y
as$X)echo
h($X[0])."\n\n\n";}else
echo
h($Y);echo"</textarea>";}function
edit_type($z,$n,$mb,$gd=array(),$Oc=array()){global$Fh,$U,$Gi,$of;$T=$n["type"];echo'<td><select name="',h($z),'[type]" class="type" aria-labelledby="label-type">';if($T&&!isset($U[$T])&&!isset($gd[$T])&&!in_array($T,$Oc))$Oc[]=$T;if($gd)$Fh['Foreign keys']=$gd;echo
optionlist(array_merge($Oc,$Fh),$T),'</select><td><input name="',h($z),'[length]" value="',h($n["length"]),'" size="3"',(!$n["length"]&&preg_match('~var(char|binary)$~',$T)?" class='required'":"");echo' aria-labelledby="label-length"><td class="options">',"<select name='".h($z)."[collation]'".(preg_match('~(char|text|enum|set)$~',$T)?"":" class='hidden'").'><option value="">('.'collation'.')'.optionlist($mb,$n["collation"]).'</select>',($Gi?"<select name='".h($z)."[unsigned]'".(!$T||preg_match(number_type(),$T)?"":" class='hidden'").'><option>'.optionlist($Gi,$n["unsigned"]).'</select>':''),(isset($n['on_update'])?"<select name='".h($z)."[on_update]'".(preg_match('~timestamp|datetime~',$T)?"":" class='hidden'").'>'.optionlist(array(""=>"(".'ON UPDATE'.")","CURRENT_TIMESTAMP"),(preg_match('~^CURRENT_TIMESTAMP~i',$n["on_update"])?"CURRENT_TIMESTAMP":$n["on_update"])).'</select>':''),($gd?"<select name='".h($z)."[on_delete]'".(preg_match("~`~",$T)?"":" class='hidden'")."><option value=''>(".'ON DELETE'.")".optionlist(explode("|",$of),$n["on_delete"])."</select> ":" ");}function
process_length($se){global$zc;return(preg_match("~^\\s*\\(?\\s*$zc(?:\\s*,\\s*$zc)*+\\s*\\)?\\s*\$~",$se)&&preg_match_all("~$zc~",$se,$Be)?"(".implode(",",$Be[0]).")":preg_replace('~^[0-9].*~','(\0)',preg_replace('~[^-0-9,+()[\]]~','',$se)));}function
process_type($n,$kb="COLLATE"){global$Gi;return" $n[type]".process_length($n["length"]).(preg_match(number_type(),$n["type"])&&in_array($n["unsigned"],$Gi)?" $n[unsigned]":"").(preg_match('~char|text|enum|set~',$n["type"])&&$n["collation"]?" $kb ".q($n["collation"]):"");}function
process_field($n,$zi){return
array(idf_escape(trim($n["field"])),process_type($zi),($n["null"]?" NULL":" NOT NULL"),default_value($n),(preg_match('~timestamp|datetime~',$n["type"])&&$n["on_update"]?" ON UPDATE $n[on_update]":""),(support("comment")&&$n["comment"]!=""?" COMMENT ".q($n["comment"]):""),($n["auto_increment"]?auto_increment():null),);}function
default_value($n){$Wb=$n["default"];return($Wb===null?"":" DEFAULT ".(preg_match('~char|binary|text|enum|set~',$n["type"])||preg_match('~^(?![a-z])~i',$Wb)?q($Wb):$Wb));}function
type_class($T){foreach(array('char'=>'text','date'=>'time|year','binary'=>'blob','enum'=>'set',)as$z=>$X){if(preg_match("~$z|$X~",$T))return" class='$z'";}}function
edit_fields($o,$mb,$T="TABLE",$gd=array()){global$Sd;$o=array_values($o);$Xb=(($_POST?$_POST["defaults"]:adminer_setting("defaults"))?"":" class='hidden'");$sb=(($_POST?$_POST["comments"]:adminer_setting("comments"))?"":" class='hidden'");echo'<thead><tr>
';if($T=="PROCEDURE"){echo'<td>';}echo'<th id="label-name">',($T=="TABLE"?'Column name':'Parameter name'),'<td id="label-type">Type<textarea id="enum-edit" rows="4" cols="12" wrap="off" style="display: none;"></textarea>',script("qs('#enum-edit').onblur = editingLengthBlur;"),'<td id="label-length">Length
<td>','Options';if($T=="TABLE"){echo'<td id="label-null">NULL
<td><input type="radio" name="auto_increment_col" value=""><acronym id="label-ai" title="Auto Increment">AI</acronym>',doc_link(array('sql'=>"example-auto-increment.html",'mariadb'=>"auto_increment/",'sqlite'=>"autoinc.html",'pgsql'=>"datatype.html#DATATYPE-SERIAL",'mssql'=>"ms186775.aspx",)),'<td id="label-default"',$Xb,'>Default value
',(support("comment")?"<td id='label-comment'$sb>".'Comment':"");}echo'<td>',"<input type='image' class='icon' name='add[".(support("move_col")?0:count($o))."]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.8.0")."' alt='+' title='".'Add next'."'>".script("row_count = ".count($o).";"),'</thead>
<tbody>
',script("mixin(qsl('tbody'), {onclick: editingClick, onkeydown: editingKeydown, oninput: editingInput});");foreach($o
as$t=>$n){$t++;$Bf=$n[($_POST?"orig":"field")];$ec=(isset($_POST["add"][$t-1])||(isset($n["field"])&&!$_POST["drop_col"][$t]))&&(support("drop_col")||$Bf=="");echo'<tr',($ec?"":" style='display: none;'"),'>
',($T=="PROCEDURE"?"<td>".html_select("fields[$t][inout]",explode("|",$Sd),$n["inout"]):""),'<th>';if($ec){echo'<input name="fields[',$t,'][field]" value="',h($n["field"]),'" data-maxlength="64" autocapitalize="off" aria-labelledby="label-name">';}echo'<input type="hidden" name="fields[',$t,'][orig]" value="',h($Bf),'">';edit_type("fields[$t]",$n,$mb,$gd);if($T=="TABLE"){echo'<td>',checkbox("fields[$t][null]",1,$n["null"],"","","block","label-null"),'<td><label class="block"><input type="radio" name="auto_increment_col" value="',$t,'"';if($n["auto_increment"]){echo' checked';}echo' aria-labelledby="label-ai"></label><td',$Xb,'>',checkbox("fields[$t][has_default]",1,$n["has_default"],"","","","label-default"),'<input name="fields[',$t,'][default]" value="',h($n["default"]),'" aria-labelledby="label-default">',(support("comment")?"<td$sb><input name='fields[$t][comment]' value='".h($n["comment"])."' data-maxlength='".(min_version(5.5)?1024:255)."' aria-labelledby='label-comment'>":"");}echo"<td>",(support("move_col")?"<input type='image' class='icon' name='add[$t]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.8.0")."' alt='+' title='".'Add next'."'> "."<input type='image' class='icon' name='up[$t]' src='".h(preg_replace("~\\?.*~","",ME)."?file=up.gif&version=4.8.0")."' alt='↑' title='".'Move up'."'> "."<input type='image' class='icon' name='down[$t]' src='".h(preg_replace("~\\?.*~","",ME)."?file=down.gif&version=4.8.0")."' alt='↓' title='".'Move down'."'> ":""),($Bf==""||support("drop_col")?"<input type='image' class='icon' name='drop_col[$t]' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.8.0")."' alt='x' title='".'Remove'."'>":"");}}function
process_fields(&$o){$gf=0;if($_POST["up"]){$me=0;foreach($o
as$z=>$n){if(key($_POST["up"])==$z){unset($o[$z]);array_splice($o,$me,0,array($n));break;}if(isset($n["field"]))$me=$gf;$gf++;}}elseif($_POST["down"]){$id=false;foreach($o
as$z=>$n){if(isset($n["field"])&&$id){unset($o[key($_POST["down"])]);array_splice($o,$gf,0,array($id));break;}if(key($_POST["down"])==$z)$id=$n;$gf++;}}elseif($_POST["add"]){$o=array_values($o);array_splice($o,key($_POST["add"]),0,array(array()));}elseif(!$_POST["drop_col"])return
false;return
true;}function
normalize_enum($C){return"'".str_replace("'","''",addcslashes(stripcslashes(str_replace($C[0][0].$C[0][0],$C[0][0],substr($C[0],1,-1))),'\\'))."'";}function
grant($md,$og,$e,$nf){if(!$og)return
true;if($og==array("ALL PRIVILEGES","GRANT OPTION"))return($md=="GRANT"?queries("$md ALL PRIVILEGES$nf WITH GRANT OPTION"):queries("$md ALL PRIVILEGES$nf")&&queries("$md GRANT OPTION$nf"));return
queries("$md ".preg_replace('~(GRANT OPTION)\([^)]*\)~','\1',implode("$e, ",$og).$e).$nf);}function
drop_create($ic,$h,$jc,$Zh,$lc,$B,$Me,$Ke,$Le,$kf,$Xe){if($_POST["drop"])query_redirect($ic,$B,$Me);elseif($kf=="")query_redirect($h,$B,$Le);elseif($kf!=$Xe){$Jb=queries($h);queries_redirect($B,$Ke,$Jb&&queries($ic));if($Jb)queries($jc);}else
queries_redirect($B,$Ke,queries($Zh)&&queries($lc)&&queries($ic)&&queries($h));}function
create_trigger($nf,$J){global$y;$ei=" $J[Timing] $J[Event]".($J["Event"]=="UPDATE OF"?" ".idf_escape($J["Of"]):"");return"CREATE TRIGGER ".idf_escape($J["Trigger"]).($y=="mssql"?$nf.$ei:$ei.$nf).rtrim(" $J[Type]\n$J[Statement]",";").";";}function
create_routine($Sg,$J){global$Sd,$y;$N=array();$o=(array)$J["fields"];ksort($o);foreach($o
as$n){if($n["field"]!="")$N[]=(preg_match("~^($Sd)\$~",$n["inout"])?"$n[inout] ":"").idf_escape($n["field"]).process_type($n,"CHARACTER SET");}$Yb=rtrim("\n$J[definition]",";");return"CREATE $Sg ".idf_escape(trim($J["name"]))." (".implode(", ",$N).")".(isset($_GET["function"])?" RETURNS".process_type($J["returns"],"CHARACTER SET"):"").($J["language"]?" LANGUAGE $J[language]":"").($y=="pgsql"?" AS ".q($Yb):"$Yb;");}function
remove_definer($G){return
preg_replace('~^([A-Z =]+) DEFINER=`'.preg_replace('~@(.*)~','`@`(%|\1)',logged_user()).'`~','\1',$G);}function
format_foreign_key($q){global$of;$k=$q["db"];$bf=$q["ns"];return" FOREIGN KEY (".implode(", ",array_map('idf_escape',$q["source"])).") REFERENCES ".($k!=""&&$k!=$_GET["db"]?idf_escape($k).".":"").($bf!=""&&$bf!=$_GET["ns"]?idf_escape($bf).".":"").table($q["table"])." (".implode(", ",array_map('idf_escape',$q["target"])).")".(preg_match("~^($of)\$~",$q["on_delete"])?" ON DELETE $q[on_delete]":"").(preg_match("~^($of)\$~",$q["on_update"])?" ON UPDATE $q[on_update]":"");}function
tar_file($p,$ji){$I=pack("a100a8a8a8a12a12",$p,644,0,0,decoct($ji->size),decoct(time()));$eb=8*32;for($t=0;$t<strlen($I);$t++)$eb+=ord($I[$t]);$I.=sprintf("%06o",$eb)."\0 ";echo$I,str_repeat("\0",512-strlen($I));$ji->send();echo
str_repeat("\0",511-($ji->size+511)%512);}function
ini_bytes($Rd){$X=ini_get($Rd);switch(strtolower(substr($X,-1))){case'g':$X*=1024;case'm':$X*=1024;case'k':$X*=1024;}return$X;}function
doc_link($Xf,$ai="<sup>?</sup>"){global$y,$f;$jh=$f->server_info;$Vi=preg_replace('~^(\d\.?\d).*~s','\1',$jh);$Ki=array('sql'=>"https://dev.mysql.com/doc/refman/$Vi/en/",'sqlite'=>"https://www.sqlite.org/",'pgsql'=>"https://www.postgresql.org/docs/$Vi/",'mssql'=>"https://msdn.microsoft.com/library/",'oracle'=>"https://www.oracle.com/pls/topic/lookup?ctx=db".preg_replace('~^.* (\d+)\.(\d+)\.\d+\.\d+\.\d+.*~s','\1\2',$jh)."&id=",);if(preg_match('~MariaDB~',$jh)){$Ki['sql']="https://mariadb.com/kb/en/library/";$Xf['sql']=(isset($Xf['mariadb'])?$Xf['mariadb']:str_replace(".html","/",$Xf['sql']));}return($Xf[$y]?"<a href='$Ki[$y]$Xf[$y]'".target_blank().">$ai</a>":"");}function
ob_gzencode($P){return
gzencode($P);}function
db_size($k){global$f;if(!$f->select_db($k))return"?";$I=0;foreach(table_status()as$R)$I+=$R["Data_length"]+$R["Index_length"];return
format_number($I);}function
set_utf8mb4($h){global$f;static$N=false;if(!$N&&preg_match('~\butf8mb4~i',$h)){$N=true;echo"SET NAMES ".charset($f).";\n\n";}}function
connect_error(){global$b,$f,$mi,$m,$hc;if(DB!=""){header("HTTP/1.1 404 Not Found");page_header('Database'.": ".h(DB),'Invalid database.',true);}else{if($_POST["db"]&&!$m)queries_redirect(substr(ME,0,-1),'Databases have been dropped.',drop_databases($_POST["db"]));page_header('Select database',$m,false);echo"<p class='links'>\n";foreach(array('database'=>'Create database','privileges'=>'Privileges','processlist'=>'Process list','variables'=>'Variables','status'=>'Status',)as$z=>$X){if(support($z))echo"<a href='".h(ME)."$z='>$X</a>\n";}echo"<p>".sprintf('%s version: %s through PHP extension %s',$hc[DRIVER],"<b>".h($f->server_info)."</b>","<b>$f->extension</b>")."\n","<p>".sprintf('Logged as: %s',"<b>".h(logged_user())."</b>")."\n";$j=$b->databases();if($j){$Zg=support("scheme");$mb=collations();echo"<form action='' method='post'>\n","<table cellspacing='0' class='checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),"<thead><tr>".(support("database")?"<td>":"")."<th>".'Database'." - <a href='".h(ME)."refresh=1'>".'Refresh'."</a>"."<td>".'Collation'."<td>".'Tables'."<td>".'Size'." - <a href='".h(ME)."dbsize=1'>".'Compute'."</a>".script("qsl('a').onclick = partial(ajaxSetHtml, '".js_escape(ME)."script=connect');","")."</thead>\n";$j=($_GET["dbsize"]?count_tables($j):array_flip($j));foreach($j
as$k=>$S){$Rg=h(ME)."db=".urlencode($k);$u=h("Db-".$k);echo"<tr".odd().">".(support("database")?"<td>".checkbox("db[]",$k,in_array($k,(array)$_POST["db"]),"","","",$u):""),"<th><a href='$Rg' id='$u'>".h($k)."</a>";$lb=h(db_collation($k,$mb));echo"<td>".(support("database")?"<a href='$Rg".($Zg?"&amp;ns=":"")."&amp;database=' title='".'Alter database'."'>$lb</a>":$lb),"<td align='right'><a href='$Rg&amp;schema=' id='tables-".h($k)."' title='".'Database schema'."'>".($_GET["dbsize"]?$S:"?")."</a>","<td align='right' id='size-".h($k)."'>".($_GET["dbsize"]?db_size($k):"?"),"\n";}echo"</table>\n",(support("database")?"<div class='footer'><div>\n"."<fieldset><legend>".'Selected'." <span id='selected'></span></legend><div>\n"."<input type='hidden' name='all' value=''>".script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^db/)); };")."<input type='submit' name='drop' value='".'Drop'."'>".confirm()."\n"."</div></fieldset>\n"."</div></div>\n":""),"<input type='hidden' name='token' value='$mi'>\n","</form>\n",script("tableCheck();");}}page_footer("db");}if(isset($_GET["status"]))$_GET["variables"]=$_GET["status"];if(isset($_GET["import"]))$_GET["sql"]=$_GET["import"];if(!(DB!=""?$f->select_db(DB):isset($_GET["sql"])||isset($_GET["dump"])||isset($_GET["database"])||isset($_GET["processlist"])||isset($_GET["privileges"])||isset($_GET["user"])||isset($_GET["variables"])||$_GET["script"]=="connect"||$_GET["script"]=="kill")){if(DB!=""||$_GET["refresh"]){restart_session();set_session("dbs",null);}connect_error();exit;}if(support("scheme")&&DB!=""&&$_GET["ns"]!==""){if(!isset($_GET["ns"]))adm_redirect(preg_replace('~ns=[^&]*&~','',ME)."ns=".get_schema());if(!set_schema($_GET["ns"])){header("HTTP/1.1 404 Not Found");page_header('Schema'.": ".h($_GET["ns"]),'Invalid schema.',true);page_footer("ns");exit;}}$of="RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";class
TmpFile{var$handler;var$size;function
__construct(){$this->handler=tmpfile();}function
write($Cb){$this->size+=strlen($Cb);fwrite($this->handler,$Cb);}function
send(){fseek($this->handler,0);fpassthru($this->handler);fclose($this->handler);}}$zc="'(?:''|[^'\\\\]|\\\\.)*'";$Sd="IN|OUT|INOUT";if(isset($_GET["select"])&&($_POST["edit"]||$_POST["clone"])&&!$_POST["save"])$_GET["edit"]=$_GET["select"];if(isset($_GET["callf"]))$_GET["call"]=$_GET["callf"];if(isset($_GET["function"]))$_GET["procedure"]=$_GET["function"];if(isset($_GET["download"])){$a=$_GET["download"];$o=fields($a);header("Content-Type: application/octet-stream");header("Content-Disposition: attachment; filename=".friendly_url("$a-".implode("_",$_GET["where"])).".".friendly_url($_GET["field"]));$L=array(idf_escape($_GET["field"]));$H=$l->select($a,$L,array(where($_GET,$o)),$L);$J=($H?$H->fetch_row():array());echo$l->value($J[0],$o[$_GET["field"]]);exit;}elseif(isset($_GET["table"])){$a=$_GET["table"];$o=fields($a);if(!$o)$m=error();$R=table_status1($a,true);$D=$b->tableName($R);page_header(($o&&is_view($R)?$R['Engine']=='materialized view'?'Materialized view':'View':'Table').": ".($D!=""?$D:h($a)),$m);$b->selectLinks($R);$rb=$R["Comment"];if($rb!="")echo"<p class='nowrap'>".'Comment'.": ".h($rb)."\n";if($o)$b->tableStructurePrint($o);if(!is_view($R)){if(support("indexes")){echo"<h3 id='indexes'>".'Indexes'."</h3>\n";$x=indexes($a);if($x)$b->tableIndexesPrint($x);echo'<p class="links"><a href="'.h(ME).'indexes='.urlencode($a).'">'.'Alter indexes'."</a>\n";}if(fk_support($R)){echo"<h3 id='foreign-keys'>".'Foreign keys'."</h3>\n";$gd=foreign_keys($a);if($gd){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Source'."<td>".'Target'."<td>".'ON DELETE'."<td>".'ON UPDATE'."<td></thead>\n";foreach($gd
as$D=>$q){echo"<tr title='".h($D)."'>","<th><i>".implode("</i>, <i>",array_map('h',$q["source"]))."</i>","<td><a href='".h($q["db"]!=""?preg_replace('~db=[^&]*~',"db=".urlencode($q["db"]),ME):($q["ns"]!=""?preg_replace('~ns=[^&]*~',"ns=".urlencode($q["ns"]),ME):ME))."table=".urlencode($q["table"])."'>".($q["db"]!=""?"<b>".h($q["db"])."</b>.":"").($q["ns"]!=""?"<b>".h($q["ns"])."</b>.":"").h($q["table"])."</a>","(<i>".implode("</i>, <i>",array_map('h',$q["target"]))."</i>)","<td>".h($q["on_delete"])."\n","<td>".h($q["on_update"])."\n",'<td><a href="'.h(ME.'foreign='.urlencode($a).'&name='.urlencode($D)).'">'.'Alter'.'</a>';}echo"</table>\n";}echo'<p class="links"><a href="'.h(ME).'foreign='.urlencode($a).'">'.'Add foreign key'."</a>\n";}}if(support(is_view($R)?"view_trigger":"trigger")){echo"<h3 id='triggers'>".'Triggers'."</h3>\n";$yi=triggers($a);if($yi){echo"<table cellspacing='0'>\n";foreach($yi
as$z=>$X)echo"<tr valign='top'><td>".h($X[0])."<td>".h($X[1])."<th>".h($z)."<td><a href='".h(ME.'trigger='.urlencode($a).'&name='.urlencode($z))."'>".'Alter'."</a>\n";echo"</table>\n";}echo'<p class="links"><a href="'.h(ME).'trigger='.urlencode($a).'">'.'Add trigger'."</a>\n";}}elseif(isset($_GET["schema"])){page_header('Database schema',"",array(),h(DB.($_GET["ns"]?".$_GET[ns]":"")));$Ph=array();$Qh=array();$ea=($_GET["schema"]?$_GET["schema"]:$_COOKIE["adminer_schema-".str_replace(".","_",DB)]);preg_match_all('~([^:]+):([-0-9.]+)x([-0-9.]+)(_|$)~',$ea,$Be,PREG_SET_ORDER);foreach($Be
as$t=>$C){$Ph[$C[1]]=array($C[2],$C[3]);$Qh[]="\n\t'".js_escape($C[1])."': [ $C[2], $C[3] ]";}$ni=0;$Pa=-1;$Yg=array();$Dg=array();$qe=array();foreach(table_status('',true)as$Q=>$R){if(is_view($R))continue;$dg=0;$Yg[$Q]["fields"]=array();foreach(fields($Q)as$D=>$n){$dg+=1.25;$n["pos"]=$dg;$Yg[$Q]["fields"][$D]=$n;}$Yg[$Q]["pos"]=($Ph[$Q]?$Ph[$Q]:array($ni,0));foreach($b->foreignKeys($Q)as$X){if(!$X["db"]){$oe=$Pa;if($Ph[$Q][1]||$Ph[$X["table"]][1])$oe=min(floatval($Ph[$Q][1]),floatval($Ph[$X["table"]][1]))-1;else$Pa-=.1;while($qe[(string)$oe])$oe-=.0001;$Yg[$Q]["references"][$X["table"]][(string)$oe]=array($X["source"],$X["target"]);$Dg[$X["table"]][$Q][(string)$oe]=$X["target"];$qe[(string)$oe]=true;}}$ni=max($ni,$Yg[$Q]["pos"][0]+2.5+$dg);}echo'<div id="schema" style="height: ',$ni,'em;">
<script',nonce(),'>
qs(\'#schema\').onselectstart = function () { return false; };
var tablePos = {',implode(",",$Qh)."\n",'};
var em = qs(\'#schema\').offsetHeight / ',$ni,';
document.onmousemove = schemaMousemove;
document.onmouseup = partialArg(schemaMouseup, \'',js_escape(DB),'\');
</script>
';foreach($Yg
as$D=>$Q){echo"<div class='table' style='top: ".$Q["pos"][0]."em; left: ".$Q["pos"][1]."em;'>",'<a href="'.h(ME).'table='.urlencode($D).'"><b>'.h($D)."</b></a>",script("qsl('div').onmousedown = schemaMousedown;");foreach($Q["fields"]as$n){$X='<span'.type_class($n["type"]).' title="'.h($n["full_type"].($n["null"]?" NULL":'')).'">'.h($n["field"]).'</span>';echo"<br>".($n["primary"]?"<i>$X</i>":$X);}foreach((array)$Q["references"]as$Wh=>$Eg){foreach($Eg
as$oe=>$Ag){$pe=$oe-$Ph[$D][1];$t=0;foreach($Ag[0]as$uh)echo"\n<div class='references' title='".h($Wh)."' id='refs$oe-".($t++)."' style='left: $pe"."em; top: ".$Q["fields"][$uh]["pos"]."em; padding-top: .5em;'><div style='border-top: 1px solid Gray; width: ".(-$pe)."em;'></div></div>";}}foreach((array)$Dg[$D]as$Wh=>$Eg){foreach($Eg
as$oe=>$e){$pe=$oe-$Ph[$D][1];$t=0;foreach($e
as$Vh)echo"\n<div class='references' title='".h($Wh)."' id='refd$oe-".($t++)."' style='left: $pe"."em; top: ".$Q["fields"][$Vh]["pos"]."em; height: 1.25em; background: url(".h(preg_replace("~\\?.*~","",ME)."?file=arrow.gif) no-repeat right center;&version=4.8.0")."'><div style='height: .5em; border-bottom: 1px solid Gray; width: ".(-$pe)."em;'></div></div>";}}echo"\n</div>\n";}foreach($Yg
as$D=>$Q){foreach((array)$Q["references"]as$Wh=>$Eg){foreach($Eg
as$oe=>$Ag){$Pe=$ni;$Fe=-10;foreach($Ag[0]as$z=>$uh){$eg=$Q["pos"][0]+$Q["fields"][$uh]["pos"];$fg=$Yg[$Wh]["pos"][0]+$Yg[$Wh]["fields"][$Ag[1][$z]]["pos"];$Pe=min($Pe,$eg,$fg);$Fe=max($Fe,$eg,$fg);}echo"<div class='references' id='refl$oe' style='left: $oe"."em; top: $Pe"."em; padding: .5em 0;'><div style='border-right: 1px solid Gray; margin-top: 1px; height: ".($Fe-$Pe)."em;'></div></div>\n";}}}echo'</div>
<p class="links"><a href="',h(ME."schema=".urlencode($ea)),'" id="schema-link">Permanent link</a>
';}elseif(isset($_GET["dump"])){$a=$_GET["dump"];if($_POST&&!$m){$Fb="";foreach(array("output","format","db_style","routines","events","table_style","auto_increment","triggers","data_style")as$z)$Fb.="&$z=".urlencode($_POST[$z]);adm_cookie("adminer_export",substr($Fb,1));$S=array_flip((array)$_POST["tables"])+array_flip((array)$_POST["data"]);$Lc=dump_headers((count($S)==1?key($S):DB),(DB==""||count($S)>1));$ae=preg_match('~sql~',$_POST["format"]);if($ae){echo"-- Adminer $ia ".$hc[DRIVER]." ".str_replace("\n"," ",$f->server_info)." dump\n\n";if($y=="sql"){echo"SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
".($_POST["data_style"]?"SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
":"")."
";$f->query("SET time_zone = '+00:00'");$f->query("SET sql_mode = ''");}}$Gh=$_POST["db_style"];$j=array(DB);if(DB==""){$j=$_POST["databases"];if(is_string($j))$j=explode("\n",rtrim(str_replace("\r","",$j),"\n"));}foreach((array)$j
as$k){$b->dumpDatabase($k);if($f->select_db($k)){if($ae&&preg_match('~CREATE~',$Gh)&&($h=$f->result("SHOW CREATE DATABASE ".idf_escape($k),1))){set_utf8mb4($h);if($Gh=="DROP+CREATE")echo"DROP DATABASE IF EXISTS ".idf_escape($k).";\n";echo"$h;\n";}if($ae){if($Gh)echo
use_sql($k).";\n\n";$Hf="";if($_POST["routines"]){foreach(array("FUNCTION","PROCEDURE")as$Sg){foreach(get_rows("SHOW $Sg STATUS WHERE Db = ".q($k),null,"-- ")as$J){$h=remove_definer($f->result("SHOW CREATE $Sg ".idf_escape($J["Name"]),2));set_utf8mb4($h);$Hf.=($Gh!='DROP+CREATE'?"DROP $Sg IF EXISTS ".idf_escape($J["Name"]).";;\n":"")."$h;;\n\n";}}}if($_POST["events"]){foreach(get_rows("SHOW EVENTS",null,"-- ")as$J){$h=remove_definer($f->result("SHOW CREATE EVENT ".idf_escape($J["Name"]),3));set_utf8mb4($h);$Hf.=($Gh!='DROP+CREATE'?"DROP EVENT IF EXISTS ".idf_escape($J["Name"]).";;\n":"")."$h;;\n\n";}}if($Hf)echo"DELIMITER ;;\n\n$Hf"."DELIMITER ;\n\n";}if($_POST["table_style"]||$_POST["data_style"]){$Xi=array();foreach(table_status('',true)as$D=>$R){$Q=(DB==""||in_array($D,(array)$_POST["tables"]));$Pb=(DB==""||in_array($D,(array)$_POST["data"]));if($Q||$Pb){if($Lc=="tar"){$ji=new
TmpFile;ob_start(array($ji,'write'),1e5);}$b->dumpTable($D,($Q?$_POST["table_style"]:""),(is_view($R)?2:0));if(is_view($R))$Xi[]=$D;elseif($Pb){$o=fields($D);$b->dumpData($D,$_POST["data_style"],"SELECT *".convert_fields($o,$o)." FROM ".table($D));}if($ae&&$_POST["triggers"]&&$Q&&($yi=trigger_sql($D)))echo"\nDELIMITER ;;\n$yi\nDELIMITER ;\n";if($Lc=="tar"){ob_end_flush();tar_file((DB!=""?"":"$k/")."$D.csv",$ji);}elseif($ae)echo"\n";}}if(function_exists('foreign_keys_sql')){foreach(table_status('',true)as$D=>$R){$Q=(DB==""||in_array($D,(array)$_POST["tables"]));if($Q&&!is_view($R))echo
foreign_keys_sql($D);}}foreach($Xi
as$Wi)$b->dumpTable($Wi,$_POST["table_style"],1);if($Lc=="tar")echo
pack("x512");}}}if($ae)echo"-- ".$f->result("SELECT NOW()")."\n";exit;}page_header('Export',$m,($_GET["export"]!=""?array("table"=>$_GET["export"]):array()),h(DB));echo'
<form action="" method="post">
<table cellspacing="0" class="layout">
';$Tb=array('','USE','DROP+CREATE','CREATE');$Rh=array('','DROP+CREATE','CREATE');$Qb=array('','TRUNCATE+INSERT','INSERT');if($y=="sql")$Qb[]='INSERT+UPDATE';parse_str($_COOKIE["adminer_export"],$J);if(!$J)$J=array("output"=>"text","format"=>"sql","db_style"=>(DB!=""?"":"CREATE"),"table_style"=>"DROP+CREATE","data_style"=>"INSERT");if(!isset($J["events"])){$J["routines"]=$J["events"]=($_GET["dump"]=="");$J["triggers"]=$J["table_style"];}echo"<tr><th>".'Output'."<td>".html_select("output",$b->dumpOutput(),$J["output"],0)."\n";echo"<tr><th>".'Format'."<td>".html_select("format",$b->dumpFormat(),$J["format"],0)."\n";echo($y=="sqlite"?"":"<tr><th>".'Database'."<td>".html_select('db_style',$Tb,$J["db_style"]).(support("routine")?checkbox("routines",1,$J["routines"],'Routines'):"").(support("event")?checkbox("events",1,$J["events"],'Events'):"")),"<tr><th>".'Tables'."<td>".html_select('table_style',$Rh,$J["table_style"]).checkbox("auto_increment",1,$J["auto_increment"],'Auto Increment').(support("trigger")?checkbox("triggers",1,$J["triggers"],'Triggers'):""),"<tr><th>".'Data'."<td>".html_select('data_style',$Qb,$J["data_style"]),'</table>
<p><input type="submit" value="Export">
<input type="hidden" name="token" value="',$mi,'">

<table cellspacing="0">
',script("qsl('table').onclick = dumpClick;");$ig=array();if(DB!=""){$cb=($a!=""?"":" checked");echo"<thead><tr>","<th style='text-align: left;'><label class='block'><input type='checkbox' id='check-tables'$cb>".'Tables'."</label>".script("qs('#check-tables').onclick = partial(formCheck, /^tables\\[/);",""),"<th style='text-align: right;'><label class='block'>".'Data'."<input type='checkbox' id='check-data'$cb></label>".script("qs('#check-data').onclick = partial(formCheck, /^data\\[/);",""),"</thead>\n";$Xi="";$Sh=tables_list();foreach($Sh
as$D=>$T){$hg=preg_replace('~_.*~','',$D);$cb=($a==""||$a==(substr($a,-1)=="%"?"$hg%":$D));$lg="<tr><td>".checkbox("tables[]",$D,$cb,$D,"","block");if($T!==null&&!preg_match('~table~i',$T))$Xi.="$lg\n";else
echo"$lg<td align='right'><label class='block'><span id='Rows-".h($D)."'></span>".checkbox("data[]",$D,$cb)."</label>\n";$ig[$hg]++;}echo$Xi;if($Sh)echo
script("ajaxSetHtml('".js_escape(ME)."script=db');");}else{echo"<thead><tr><th style='text-align: left;'>","<label class='block'><input type='checkbox' id='check-databases'".($a==""?" checked":"").">".'Database'."</label>",script("qs('#check-databases').onclick = partial(formCheck, /^databases\\[/);",""),"</thead>\n";$j=$b->databases();if($j){foreach($j
as$k){if(!information_schema($k)){$hg=preg_replace('~_.*~','',$k);echo"<tr><td>".checkbox("databases[]",$k,$a==""||$a=="$hg%",$k,"","block")."\n";$ig[$hg]++;}}}else
echo"<tr><td><textarea name='databases' rows='10' cols='20'></textarea>";}echo'</table>
</form>
';$Yc=true;foreach($ig
as$z=>$X){if($z!=""&&$X>1){echo($Yc?"<p>":" ")."<a href='".h(ME)."dump=".urlencode("$z%")."'>".h($z)."</a>";$Yc=false;}}}elseif(isset($_GET["privileges"])){page_header('Privileges');echo'<p class="links"><a href="'.h(ME).'user=">'.'Create user'."</a>";$H=$f->query("SELECT User, Host FROM mysql.".(DB==""?"user":"db WHERE ".q(DB)." LIKE Db")." ORDER BY Host, User");$md=$H;if(!$H)$H=$f->query("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1) AS User, SUBSTRING_INDEX(CURRENT_USER, '@', -1) AS Host");echo"<form action=''><p>\n";hidden_fields_get();echo"<input type='hidden' name='db' value='".h(DB)."'>\n",($md?"":"<input type='hidden' name='grant' value=''>\n"),"<table cellspacing='0'>\n","<thead><tr><th>".'Username'."<th>".'Server'."<th></thead>\n";while($J=$H->fetch_assoc())echo'<tr'.odd().'><td>'.h($J["User"])."<td>".h($J["Host"]).'<td><a href="'.h(ME.'user='.urlencode($J["User"]).'&host='.urlencode($J["Host"])).'">'.'Edit'."</a>\n";if(!$md||DB!="")echo"<tr".odd()."><td><input name='user' autocapitalize='off'><td><input name='host' value='localhost' autocapitalize='off'><td><input type='submit' value='".'Edit'."'>\n";echo"</table>\n","</form>\n";}elseif(isset($_GET["sql"])){if(!$m&&$_POST["export"]){dump_headers("sql");$b->dumpTable("","");$b->dumpData("","table",$_POST["query"]);exit;}restart_session();$_d=&get_session("queries");$zd=&$_d[DB];if(!$m&&$_POST["clear"]){$zd=array();adm_redirect(remove_from_uri("history"));}page_header((isset($_GET["import"])?'Import':'SQL command'),$m);if(!$m&&$_POST){$r=false;if(!isset($_GET["import"]))$G=$_POST["query"];elseif($_POST["webfile"]){$yh=$b->importServerPath();$r=@fopen((file_exists($yh)?$yh:"compress.zlib://$yh.gz"),"rb");$G=($r?fread($r,1e6):false);}else$G=get_file("sql_file",true);if(is_string($G)){if(function_exists('memory_get_usage'))@ini_set("memory_limit",max(ini_bytes("memory_limit"),2*strlen($G)+memory_get_usage()+8e6));if($G!=""&&strlen($G)<1e6){$tg=$G.(preg_match("~;[ \t\r\n]*\$~",$G)?"":";");if(!$zd||reset(end($zd))!=$tg){restart_session();$zd[]=array($tg,time());set_session("queries",$_d);stop_session();}}$vh="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$Zb=";";$gf=0;$wc=true;$g=connect();if(is_object($g)&&DB!=""){$g->select_db(DB);if($_GET["ns"]!="")set_schema($_GET["ns"],$g);}$qb=0;$Ac=array();$Of='[\'"'.($y=="sql"?'`#':($y=="sqlite"?'`[':($y=="mssql"?'[':''))).']|/\*|-- |$'.($y=="pgsql"?'|\$[^$]*\$':'');$oi=microtime(true);parse_str($_COOKIE["adminer_export"],$xa);$nc=$b->dumpFormat();unset($nc["sql"]);while($G!=""){if(!$gf&&preg_match("~^$vh*+DELIMITER\\s+(\\S+)~i",$G,$C)){$Zb=$C[1];$G=substr($G,strlen($C[0]));}else{preg_match('('.preg_quote($Zb)."\\s*|$Of)",$G,$C,PREG_OFFSET_CAPTURE,$gf);list($id,$dg)=$C[0];if(!$id&&$r&&!feof($r))$G.=fread($r,1e5);else{if(!$id&&rtrim($G)=="")break;$gf=$dg+strlen($id);if($id&&rtrim($id)!=$Zb){while(preg_match('('.($id=='/*'?'\*/':($id=='['?']':(preg_match('~^-- |^#~',$id)?"\n":preg_quote($id)."|\\\\."))).'|$)s',$G,$C,PREG_OFFSET_CAPTURE,$gf)){$Wg=$C[0][0];if(!$Wg&&$r&&!feof($r))$G.=fread($r,1e5);else{$gf=$C[0][1]+strlen($Wg);if($Wg[0]!="\\")break;}}}else{$wc=false;$tg=substr($G,0,$dg);$qb++;$lg="<pre id='sql-$qb'><code class='jush-$y'>".$b->sqlCommandQuery($tg)."</code></pre>\n";if($y=="sqlite"&&preg_match("~^$vh*+ATTACH\\b~i",$tg,$C)){echo$lg,"<p class='error'>".'ATTACH queries are not supported.'."\n";$Ac[]=" <a href='#sql-$qb'>$qb</a>";if($_POST["error_stops"])break;}else{if(!$_POST["only_errors"]){echo$lg;ob_flush();flush();}$Bh=microtime(true);if($f->multi_query($tg)&&is_object($g)&&preg_match("~^$vh*+USE\\b~i",$tg))$g->query($tg);do{$H=$f->store_result();if($f->error){echo($_POST["only_errors"]?$lg:""),"<p class='error'>".'Error in query'.($f->errno?" ($f->errno)":"").": ".error()."\n";$Ac[]=" <a href='#sql-$qb'>$qb</a>";if($_POST["error_stops"])break
2;}else{$ci=" <span class='time'>(".format_time($Bh).")</span>".(strlen($tg)<1000?" <a href='".h(ME)."sql=".urlencode(trim($tg))."'>".'Edit'."</a>":"");$za=$f->affected_rows;$aj=($_POST["only_errors"]?"":$l->warnings());$bj="warnings-$qb";if($aj)$ci.=", <a href='#$bj'>".'Warnings'."</a>".script("qsl('a').onclick = partial(toggle, '$bj');","");$Ic=null;$Jc="explain-$qb";if(is_object($H)){$_=$_POST["limit"];$Af=select($H,$g,array(),$_);if(!$_POST["only_errors"]){echo"<form action='' method='post'>\n";$cf=$H->num_rows;echo"<p>".($cf?($_&&$cf>$_?sprintf('%d / ',$_):"").lang(array('%d row','%d rows'),$cf):""),$ci;if($g&&preg_match("~^($vh|\\()*+SELECT\\b~i",$tg)&&($Ic=explain($g,$tg)))echo", <a href='#$Jc'>Explain</a>".script("qsl('a').onclick = partial(toggle, '$Jc');","");$u="export-$qb";echo", <a href='#$u'>".'Export'."</a>".script("qsl('a').onclick = partial(toggle, '$u');","")."<span id='$u' class='hidden'>: ".html_select("output",$b->dumpOutput(),$xa["output"])." ".html_select("format",$nc,$xa["format"])."<input type='hidden' name='query' value='".h($tg)."'>"." <input type='submit' name='export' value='".'Export'."'><input type='hidden' name='token' value='$mi'></span>\n"."</form>\n";}}else{if(preg_match("~^$vh*+(CREATE|DROP|ALTER)$vh++(DATABASE|SCHEMA)\\b~i",$tg)){restart_session();set_session("dbs",null);stop_session();}if(!$_POST["only_errors"])echo"<p class='message' title='".h($f->info)."'>".lang(array('Query executed OK, %d row affected.','Query executed OK, %d rows affected.'),$za)."$ci\n";}echo($aj?"<div id='$bj' class='hidden'>\n$aj</div>\n":"");if($Ic){echo"<div id='$Jc' class='hidden'>\n";select($Ic,$g,$Af);echo"</div>\n";}}$Bh=microtime(true);}while($f->next_result());}$G=substr($G,$gf);$gf=0;}}}}if($wc)echo"<p class='message'>".'No commands to execute.'."\n";elseif($_POST["only_errors"]){echo"<p class='message'>".lang(array('%d query executed OK.','%d queries executed OK.'),$qb-count($Ac))," <span class='time'>(".format_time($oi).")</span>\n";}elseif($Ac&&$qb>1)echo"<p class='error'>".'Error in query'.": ".implode("",$Ac)."\n";}else
echo"<p class='error'>".upload_error($G)."\n";}echo'
<form action="" method="post" enctype="multipart/form-data" id="form">
';$Gc="<input type='submit' value='".'Execute'."' title='Ctrl+Enter'>";if(!isset($_GET["import"])){$tg=$_GET["sql"];if($_POST)$tg=$_POST["query"];elseif($_GET["history"]=="all")$tg=$zd;elseif($_GET["history"]!="")$tg=$zd[$_GET["history"]][0];echo"<p>";textarea("query",$tg,20);echo
script(($_POST?"":"qs('textarea').focus();\n")."qs('#form').onsubmit = partial(sqlSubmit, qs('#form'), '".js_escape(remove_from_uri("sql|limit|error_stops|only_errors|history"))."');"),"<p>$Gc\n",'Limit rows'.": <input type='number' name='limit' class='size' value='".h($_POST?$_POST["limit"]:$_GET["limit"])."'>\n";}else{echo"<fieldset><legend>".'File upload'."</legend><div>";$sd=(extension_loaded("zlib")?"[.gz]":"");echo(ini_bool("file_uploads")?"SQL$sd (&lt; ".ini_get("upload_max_filesize")."B): <input type='file' name='sql_file[]' multiple>\n$Gc":'File uploads are disabled.'),"</div></fieldset>\n";$Hd=$b->importServerPath();if($Hd){echo"<fieldset><legend>".'From server'."</legend><div>",sprintf('Webserver file %s',"<code>".h($Hd)."$sd</code>"),' <input type="submit" name="webfile" value="'.'Run file'.'">',"</div></fieldset>\n";}echo"<p>";}echo
checkbox("error_stops",1,($_POST?$_POST["error_stops"]:isset($_GET["import"])||$_GET["error_stops"]),'Stop on error')."\n",checkbox("only_errors",1,($_POST?$_POST["only_errors"]:isset($_GET["import"])||$_GET["only_errors"]),'Show only errors')."\n","<input type='hidden' name='token' value='$mi'>\n";if(!isset($_GET["import"])&&$zd){print_fieldset("history",'History',$_GET["history"]!="");for($X=end($zd);$X;$X=prev($zd)){$z=key($zd);list($tg,$ci,$rc)=$X;echo'<a href="'.h(ME."sql=&history=$z").'">'.'Edit'."</a>"." <span class='time' title='".@date('Y-m-d',$ci)."'>".@date("H:i:s",$ci)."</span>"." <code class='jush-$y'>".shorten_utf8(ltrim(str_replace("\n"," ",str_replace("\r","",preg_replace('~^(#|-- ).*~m','',$tg)))),80,"</code>").($rc?" <span class='time'>($rc)</span>":"")."<br>\n";}echo"<input type='submit' name='clear' value='".'Clear'."'>\n","<a href='".h(ME."sql=&history=all")."'>".'Edit all'."</a>\n","</div></fieldset>\n";}echo'</form>
';}elseif(isset($_GET["edit"])){$a=$_GET["edit"];$o=fields($a);$Z=(isset($_GET["select"])?($_POST["check"]&&count($_POST["check"])==1?where_check($_POST["check"][0],$o):""):where($_GET,$o));$Hi=(isset($_GET["select"])?$_POST["edit"]:$Z);foreach($o
as$D=>$n){if(!isset($n["privileges"][$Hi?"update":"insert"])||$b->fieldName($n)==""||$n["generated"])unset($o[$D]);}if($_POST&&!$m&&!isset($_GET["select"])){$B=$_POST["referer"];if($_POST["insert"])$B=($Hi?null:$_SERVER["REQUEST_URI"]);elseif(!preg_match('~^.+&select=.+$~',$B))$B=ME."select=".urlencode($a);$x=indexes($a);$Ci=unique_array($_GET["where"],$x);$wg="\nWHERE $Z";if(isset($_POST["delete"]))queries_redirect($B,'Item has been deleted.',$l->delete($a,$wg,!$Ci));else{$N=array();foreach($o
as$D=>$n){$X=process_input($n);if($X!==false&&$X!==null)$N[idf_escape($D)]=$X;}if($Hi){if(!$N)adm_redirect($B);queries_redirect($B,'Item has been updated.',$l->update($a,$N,$wg,!$Ci));if(is_ajax()){page_headers();page_messages($m);exit;}}else{$H=$l->insert($a,$N);$ne=($H?last_id():0);queries_redirect($B,sprintf('Item%s has been inserted.',($ne?" $ne":"")),$H);}}}$J=null;if($_POST["save"])$J=(array)$_POST["fields"];elseif($Z){$L=array();foreach($o
as$D=>$n){if(isset($n["privileges"]["select"])){$Fa=convert_field($n);if($_POST["clone"]&&$n["auto_increment"])$Fa="''";if($y=="sql"&&preg_match("~enum|set~",$n["type"]))$Fa="1*".idf_escape($D);$L[]=($Fa?"$Fa AS ":"").idf_escape($D);}}$J=array();if(!support("table"))$L=array("*");if($L){$H=$l->select($a,$L,array($Z),$L,array(),(isset($_GET["select"])?2:1));if(!$H)$m=error();else{$J=$H->fetch_assoc();if(!$J)$J=false;}if(isset($_GET["select"])&&(!$J||$H->fetch_assoc()))$J=null;}}if(!support("table")&&!$o){if(!$Z){$H=$l->select($a,array("*"),$Z,array("*"));$J=($H?$H->fetch_assoc():false);if(!$J)$J=array($l->primary=>"");}if($J){foreach($J
as$z=>$X){if(!$Z)$J[$z]=null;$o[$z]=array("field"=>$z,"null"=>($z!=$l->primary),"auto_increment"=>($z==$l->primary));}}}edit_form($a,$o,$J,$Hi);}elseif(isset($_GET["create"])){$a=$_GET["create"];$Qf=array();foreach(array('HASH','LINEAR HASH','KEY','LINEAR KEY','RANGE','LIST')as$z)$Qf[$z]=$z;$Cg=referencable_primary($a);$gd=array();foreach($Cg
as$Nh=>$n)$gd[str_replace("`","``",$Nh)."`".str_replace("`","``",$n["field"])]=$Nh;$Df=array();$R=array();if($a!=""){$Df=fields($a);$R=table_status($a);if(!$R)$m='No tables.';}$J=$_POST;$J["fields"]=(array)$J["fields"];if($J["auto_increment_col"])$J["fields"][$J["auto_increment_col"]]["auto_increment"]=true;if($_POST)set_adminer_settings(array("comments"=>$_POST["comments"],"defaults"=>$_POST["defaults"]));if($_POST&&!process_fields($J["fields"])&&!$m){if($_POST["drop"])queries_redirect(substr(ME,0,-1),'Table has been dropped.',drop_tables(array($a)));else{$o=array();$Ca=array();$Li=false;$ed=array();$Cf=reset($Df);$Aa=" FIRST";foreach($J["fields"]as$z=>$n){$q=$gd[$n["type"]];$zi=($q!==null?$Cg[$q]:$n);if($n["field"]!=""){if(!$n["has_default"])$n["default"]=null;if($z==$J["auto_increment_col"])$n["auto_increment"]=true;$qg=process_field($n,$zi);$Ca[]=array($n["orig"],$qg,$Aa);if(!$Cf||$qg!=process_field($Cf,$Cf)){$o[]=array($n["orig"],$qg,$Aa);if($n["orig"]!=""||$Aa)$Li=true;}if($q!==null)$ed[idf_escape($n["field"])]=($a!=""&&$y!="sqlite"?"ADD":" ").format_foreign_key(array('table'=>$gd[$n["type"]],'source'=>array($n["field"]),'target'=>array($zi["field"]),'on_delete'=>$n["on_delete"],));$Aa=" AFTER ".idf_escape($n["field"]);}elseif($n["orig"]!=""){$Li=true;$o[]=array($n["orig"]);}if($n["orig"]!=""){$Cf=next($Df);if(!$Cf)$Aa="";}}$Sf="";if($Qf[$J["partition_by"]]){$Tf=array();if($J["partition_by"]=='RANGE'||$J["partition_by"]=='LIST'){foreach(array_filter($J["partition_names"])as$z=>$X){$Y=$J["partition_values"][$z];$Tf[]="\n  PARTITION ".idf_escape($X)." VALUES ".($J["partition_by"]=='RANGE'?"LESS THAN":"IN").($Y!=""?" ($Y)":" MAXVALUE");}}$Sf.="\nPARTITION BY $J[partition_by]($J[partition])".($Tf?" (".implode(",",$Tf)."\n)":($J["partitions"]?" PARTITIONS ".(+$J["partitions"]):""));}elseif(support("partitioning")&&preg_match("~partitioned~",$R["Create_options"]))$Sf.="\nREMOVE PARTITIONING";$Je='Table has been altered.';if($a==""){adm_cookie("adminer_engine",$J["Engine"]);$Je='Table has been created.';}$D=trim($J["name"]);queries_redirect(ME.(support("table")?"table=":"select=").urlencode($D),$Je,alter_table($a,$D,($y=="sqlite"&&($Li||$ed)?$Ca:$o),$ed,($J["Comment"]!=$R["Comment"]?$J["Comment"]:null),($J["Engine"]&&$J["Engine"]!=$R["Engine"]?$J["Engine"]:""),($J["Collation"]&&$J["Collation"]!=$R["Collation"]?$J["Collation"]:""),($J["Auto_increment"]!=""?number($J["Auto_increment"]):""),$Sf));}}page_header(($a!=""?'Alter table':'Create table'),$m,array("table"=>$a),h($a));if(!$_POST){$J=array("Engine"=>$_COOKIE["adminer_engine"],"fields"=>array(array("field"=>"","type"=>(isset($U["int"])?"int":(isset($U["integer"])?"integer":"")),"on_update"=>"")),"partition_names"=>array(""),);if($a!=""){$J=$R;$J["name"]=$a;$J["fields"]=array();if(!$_GET["auto_increment"])$J["Auto_increment"]="";foreach($Df
as$n){$n["has_default"]=isset($n["default"]);$J["fields"][]=$n;}if(support("partitioning")){$kd="FROM information_schema.PARTITIONS WHERE TABLE_SCHEMA = ".q(DB)." AND TABLE_NAME = ".q($a);$H=$f->query("SELECT PARTITION_METHOD, PARTITION_ORDINAL_POSITION, PARTITION_EXPRESSION $kd ORDER BY PARTITION_ORDINAL_POSITION DESC LIMIT 1");list($J["partition_by"],$J["partitions"],$J["partition"])=$H->fetch_row();$Tf=get_key_vals("SELECT PARTITION_NAME, PARTITION_DESCRIPTION $kd AND PARTITION_NAME != '' ORDER BY PARTITION_ORDINAL_POSITION");$Tf[""]="";$J["partition_names"]=array_keys($Tf);$J["partition_values"]=array_values($Tf);}}}$mb=collations();$yc=engines();foreach($yc
as$xc){if(!strcasecmp($xc,$J["Engine"])){$J["Engine"]=$xc;break;}}echo'
<form action="" method="post" id="form">
<p>
';if(support("columns")||$a==""){echo'Table name: <input name="name" data-maxlength="64" value="',h($J["name"]),'" autocapitalize="off">
';if($a==""&&!$_POST)echo
script("focus(qs('#form')['name']);");echo($yc?"<select name='Engine'>".optionlist(array(""=>"(".'engine'.")")+$yc,$J["Engine"])."</select>".on_help("getTarget(event).value",1).script("qsl('select').onchange = helpClose;"):""),' ',($mb&&!preg_match("~sqlite|mssql~",$y)?html_select("Collation",array(""=>"(".'collation'.")")+$mb,$J["Collation"]):""),' <input type="submit" value="Save">
';}echo'
';if(support("columns")){echo'<div class="scrollable">
<table cellspacing="0" id="edit-fields" class="nowrap">
';edit_fields($J["fields"],$mb,"TABLE",$gd);echo'</table>
',script("editFields();"),'</div>
<p>
Auto Increment: <input type="number" name="Auto_increment" size="6" value="',h($J["Auto_increment"]),'">
',checkbox("defaults",1,($_POST?$_POST["defaults"]:adminer_setting("defaults")),'Default values',"columnShow(this.checked, 5)","jsonly"),(support("comment")?checkbox("comments",1,($_POST?$_POST["comments"]:adminer_setting("comments")),'Comment',"editingCommentsClick(this, true);","jsonly").' <input name="Comment" value="'.h($J["Comment"]).'" data-maxlength="'.(min_version(5.5)?2048:60).'">':''),'<p>
<input type="submit" value="Save">
';}echo'
';if($a!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$a));}if(support("partitioning")){$Rf=preg_match('~RANGE|LIST~',$J["partition_by"]);print_fieldset("partition",'Partition by',$J["partition_by"]);echo'<p>
',"<select name='partition_by'>".optionlist(array(""=>"")+$Qf,$J["partition_by"])."</select>".on_help("getTarget(event).value.replace(/./, 'PARTITION BY \$&')",1).script("qsl('select').onchange = partitionByChange;"),'(<input name="partition" value="',h($J["partition"]),'">)
Partitions: <input type="number" name="partitions" class="size',($Rf||!$J["partition_by"]?" hidden":""),'" value="',h($J["partitions"]),'">
<table cellspacing="0" id="partition-table"',($Rf?"":" class='hidden'"),'>
<thead><tr><th>Partition name<th>Values</thead>
';foreach($J["partition_names"]as$z=>$X){echo'<tr>','<td><input name="partition_names[]" value="'.h($X).'" autocapitalize="off">',($z==count($J["partition_names"])-1?script("qsl('input').oninput = partitionNameChange;"):''),'<td><input name="partition_values[]" value="'.h($J["partition_values"][$z]).'">';}echo'</table>
</div></fieldset>
';}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["indexes"])){$a=$_GET["indexes"];$Kd=array("PRIMARY","UNIQUE","INDEX");$R=table_status($a,true);if(preg_match('~MyISAM|M?aria'.(min_version(5.6,'10.0.5')?'|InnoDB':'').'~i',$R["Engine"]))$Kd[]="FULLTEXT";if(preg_match('~MyISAM|M?aria'.(min_version(5.7,'10.2.2')?'|InnoDB':'').'~i',$R["Engine"]))$Kd[]="SPATIAL";$x=indexes($a);$jg=array();if($y=="mongo"){$jg=$x["_id_"];unset($Kd[0]);unset($x["_id_"]);}$J=$_POST;if($_POST&&!$m&&!$_POST["add"]&&!$_POST["drop_col"]){$c=array();foreach($J["indexes"]as$w){$D=$w["name"];if(in_array($w["type"],$Kd)){$e=array();$te=array();$bc=array();$N=array();ksort($w["columns"]);foreach($w["columns"]as$z=>$d){if($d!=""){$se=$w["lengths"][$z];$ac=$w["descs"][$z];$N[]=idf_escape($d).($se?"(".(+$se).")":"").($ac?" DESC":"");$e[]=$d;$te[]=($se?$se:null);$bc[]=$ac;}}if($e){$Hc=$x[$D];if($Hc){ksort($Hc["columns"]);ksort($Hc["lengths"]);ksort($Hc["descs"]);if($w["type"]==$Hc["type"]&&array_values($Hc["columns"])===$e&&(!$Hc["lengths"]||array_values($Hc["lengths"])===$te)&&array_values($Hc["descs"])===$bc){unset($x[$D]);continue;}}$c[]=array($w["type"],$D,$N);}}}foreach($x
as$D=>$Hc)$c[]=array($Hc["type"],$D,"DROP");if(!$c)adm_redirect(ME."table=".urlencode($a));queries_redirect(ME."table=".urlencode($a),'Indexes have been altered.',alter_indexes($a,$c));}page_header('Indexes',$m,array("table"=>$a),h($a));$o=array_keys(fields($a));if($_POST["add"]){foreach($J["indexes"]as$z=>$w){if($w["columns"][count($w["columns"])]!="")$J["indexes"][$z]["columns"][]="";}$w=end($J["indexes"]);if($w["type"]||array_filter($w["columns"],'strlen'))$J["indexes"][]=array("columns"=>array(1=>""));}if(!$J){foreach($x
as$z=>$w){$x[$z]["name"]=$z;$x[$z]["columns"][]="";}$x[]=array("columns"=>array(1=>""));$J["indexes"]=$x;}echo'
<form action="" method="post">
<div class="scrollable">
<table cellspacing="0" class="nowrap">
<thead><tr>
<th id="label-type">Index Type
<th><input type="submit" class="wayoff">Column (length)
<th id="label-name">Name
<th><noscript>',"<input type='image' class='icon' name='add[0]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.8.0")."' alt='+' title='".'Add next'."'>",'</noscript>
</thead>
';if($jg){echo"<tr><td>PRIMARY<td>";foreach($jg["columns"]as$z=>$d){echo
select_input(" disabled",$o,$d),"<label><input disabled type='checkbox'>".'descending'."</label> ";}echo"<td><td>\n";}$de=1;foreach($J["indexes"]as$w){if(!$_POST["drop_col"]||$de!=key($_POST["drop_col"])){echo"<tr><td>".html_select("indexes[$de][type]",array(-1=>"")+$Kd,$w["type"],($de==count($J["indexes"])?"indexesAddRow.call(this);":1),"label-type"),"<td>";ksort($w["columns"]);$t=1;foreach($w["columns"]as$z=>$d){echo"<span>".select_input(" name='indexes[$de][columns][$t]' title='".'Column'."'",($o?array_combine($o,$o):$o),$d,"partial(".($t==count($w["columns"])?"indexesAddColumn":"indexesChangeColumn").", '".js_escape($y=="sql"?"":$_GET["indexes"]."_")."')"),($y=="sql"||$y=="mssql"?"<input type='number' name='indexes[$de][lengths][$t]' class='size' value='".h($w["lengths"][$z])."' title='".'Length'."'>":""),(support("descidx")?checkbox("indexes[$de][descs][$t]",1,$w["descs"][$z],'descending'):"")," </span>";$t++;}echo"<td><input name='indexes[$de][name]' value='".h($w["name"])."' autocapitalize='off' aria-labelledby='label-name'>\n","<td><input type='image' class='icon' name='drop_col[$de]' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.8.0")."' alt='x' title='".'Remove'."'>".script("qsl('input').onclick = partial(editingRemoveRow, 'indexes\$1[type]');");}$de++;}echo'</table>
</div>
<p>
<input type="submit" value="Save">
<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["database"])){$J=$_POST;if($_POST&&!$m&&!isset($_POST["add_x"])){$D=trim($J["name"]);if($_POST["drop"]){$_GET["db"]="";queries_redirect(remove_from_uri("db|database"),'Database has been dropped.',drop_databases(array(DB)));}elseif(DB!==$D){if(DB!=""){$_GET["db"]=$D;queries_redirect(preg_replace('~\bdb=[^&]*&~','',ME)."db=".urlencode($D),'Database has been renamed.',rename_database($D,$J["collation"]));}else{$j=explode("\n",str_replace("\r","",$D));$Hh=true;$me="";foreach($j
as$k){if(count($j)==1||$k!=""){if(!create_database($k,$J["collation"]))$Hh=false;$me=$k;}}restart_session();set_session("dbs",null);queries_redirect(ME."db=".urlencode($me),'Database has been created.',$Hh);}}else{if(!$J["collation"])adm_redirect(substr(ME,0,-1));query_redirect("ALTER DATABASE ".idf_escape($D).(preg_match('~^[a-z0-9_]+$~i',$J["collation"])?" COLLATE $J[collation]":""),substr(ME,0,-1),'Database has been altered.');}}page_header(DB!=""?'Alter database':'Create database',$m,array(),h(DB));$mb=collations();$D=DB;if($_POST)$D=$J["name"];elseif(DB!="")$J["collation"]=db_collation(DB,$mb);elseif($y=="sql"){foreach(get_vals("SHOW GRANTS")as$md){if(preg_match('~ ON (`(([^\\\\`]|``|\\\\.)*)%`\.\*)?~',$md,$C)&&$C[1]){$D=stripcslashes(idf_unescape("`$C[2]`"));break;}}}echo'
<form action="" method="post">
<p>
',($_POST["add_x"]||strpos($D,"\n")?'<textarea id="name" name="name" rows="10" cols="40">'.h($D).'</textarea><br>':'<input name="name" id="name" value="'.h($D).'" data-maxlength="64" autocapitalize="off">')."\n".($mb?html_select("collation",array(""=>"(".'collation'.")")+$mb,$J["collation"]).doc_link(array('sql'=>"charset-charsets.html",'mariadb'=>"supported-character-sets-and-collations/",'mssql'=>"ms187963.aspx",)):""),script("focus(qs('#name'));"),'<input type="submit" value="Save">
';if(DB!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',DB))."\n";elseif(!$_POST["add_x"]&&$_GET["db"]=="")echo"<input type='image' class='icon' name='add' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.8.0")."' alt='+' title='".'Add next'."'>\n";echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["scheme"])){$J=$_POST;if($_POST&&!$m){$A=preg_replace('~ns=[^&]*&~','',ME)."ns=";if($_POST["drop"])query_redirect("DROP SCHEMA ".idf_escape($_GET["ns"]),$A,'Schema has been dropped.');else{$D=trim($J["name"]);$A.=urlencode($D);if($_GET["ns"]=="")query_redirect("CREATE SCHEMA ".idf_escape($D),$A,'Schema has been created.');elseif($_GET["ns"]!=$D)query_redirect("ALTER SCHEMA ".idf_escape($_GET["ns"])." RENAME TO ".idf_escape($D),$A,'Schema has been altered.');else
adm_redirect($A);}}page_header($_GET["ns"]!=""?'Alter schema':'Create schema',$m);if(!$J)$J["name"]=$_GET["ns"];echo'
<form action="" method="post">
<p><input name="name" id="name" value="',h($J["name"]),'" autocapitalize="off">
',script("focus(qs('#name'));"),'<input type="submit" value="Save">
';if($_GET["ns"]!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',$_GET["ns"]))."\n";echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["call"])){$da=($_GET["name"]?$_GET["name"]:$_GET["call"]);page_header('Call'.": ".h($da),$m);$Sg=routine($_GET["call"],(isset($_GET["callf"])?"FUNCTION":"PROCEDURE"));$Id=array();$Hf=array();foreach($Sg["fields"]as$t=>$n){if(substr($n["inout"],-3)=="OUT")$Hf[$t]="@".idf_escape($n["field"])." AS ".idf_escape($n["field"]);if(!$n["inout"]||substr($n["inout"],0,2)=="IN")$Id[]=$t;}if(!$m&&$_POST){$Xa=array();foreach($Sg["fields"]as$z=>$n){if(in_array($z,$Id)){$X=process_input($n);if($X===false)$X="''";if(isset($Hf[$z]))$f->query("SET @".idf_escape($n["field"])." = $X");}$Xa[]=(isset($Hf[$z])?"@".idf_escape($n["field"]):$X);}$G=(isset($_GET["callf"])?"SELECT":"CALL")." ".table($da)."(".implode(", ",$Xa).")";$Bh=microtime(true);$H=$f->multi_query($G);$za=$f->affected_rows;echo$b->selectQuery($G,$Bh,!$H);if(!$H)echo"<p class='error'>".error()."\n";else{$g=connect();if(is_object($g))$g->select_db(DB);do{$H=$f->store_result();if(is_object($H))select($H,$g);else
echo"<p class='message'>".lang(array('Routine has been called, %d row affected.','Routine has been called, %d rows affected.'),$za)." <span class='time'>".@date("H:i:s")."</span>\n";}while($f->next_result());if($Hf)select($f->query("SELECT ".implode(", ",$Hf)));}}echo'
<form action="" method="post">
';if($Id){echo"<table cellspacing='0' class='layout'>\n";foreach($Id
as$z){$n=$Sg["fields"][$z];$D=$n["field"];echo"<tr><th>".$b->fieldName($n);$Y=$_POST["fields"][$D];if($Y!=""){if($n["type"]=="enum")$Y=+$Y;if($n["type"]=="set")$Y=array_sum($Y);}input($n,$Y,(string)$_POST["function"][$D]);echo"\n";}echo"</table>\n";}echo'<p>
<input type="submit" value="Call">
<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["foreign"])){$a=$_GET["foreign"];$D=$_GET["name"];$J=$_POST;if($_POST&&!$m&&!$_POST["add"]&&!$_POST["change"]&&!$_POST["change-js"]){$Je=($_POST["drop"]?'Foreign key has been dropped.':($D!=""?'Foreign key has been altered.':'Foreign key has been created.'));$B=ME."table=".urlencode($a);if(!$_POST["drop"]){$J["source"]=array_filter($J["source"],'strlen');ksort($J["source"]);$Vh=array();foreach($J["source"]as$z=>$X)$Vh[$z]=$J["target"][$z];$J["target"]=$Vh;}if($y=="sqlite")queries_redirect($B,$Je,recreate_table($a,$a,array(),array(),array(" $D"=>($_POST["drop"]?"":" ".format_foreign_key($J)))));else{$c="ALTER TABLE ".table($a);$ic="\nDROP ".($y=="sql"?"FOREIGN KEY ":"CONSTRAINT ").idf_escape($D);if($_POST["drop"])query_redirect($c.$ic,$B,$Je);else{query_redirect($c.($D!=""?"$ic,":"")."\nADD".format_foreign_key($J),$B,$Je);$m='Source and target columns must have the same data type, there must be an index on the target columns and referenced data must exist.'."<br>$m";}}}page_header('Foreign key',$m,array("table"=>$a),h($a));if($_POST){ksort($J["source"]);if($_POST["add"])$J["source"][]="";elseif($_POST["change"]||$_POST["change-js"])$J["target"]=array();}elseif($D!=""){$gd=foreign_keys($a);$J=$gd[$D];$J["source"][]="";}else{$J["table"]=$a;$J["source"]=array("");}echo'
<form action="" method="post">
';$uh=array_keys(fields($a));if($J["db"]!="")$f->select_db($J["db"]);if($J["ns"]!="")set_schema($J["ns"]);$Bg=array_keys(array_filter(table_status('',true),'fk_support'));$Vh=array_keys(fields(in_array($J["table"],$Bg)?$J["table"]:reset($Bg)));$pf="this.form['change-js'].value = '1'; this.form.submit();";echo"<p>".'Target table'.": ".html_select("table",$Bg,$J["table"],$pf)."\n";if($y=="pgsql")echo'Schema'.": ".html_select("ns",$b->schemas(),$J["ns"]!=""?$J["ns"]:$_GET["ns"],$pf);elseif($y!="sqlite"){$Ub=array();foreach($b->databases()as$k){if(!information_schema($k))$Ub[]=$k;}echo'DB'.": ".html_select("db",$Ub,$J["db"]!=""?$J["db"]:$_GET["db"],$pf);}echo'<input type="hidden" name="change-js" value="">
<noscript><p><input type="submit" name="change" value="Change"></noscript>
<table cellspacing="0">
<thead><tr><th id="label-source">Source<th id="label-target">Target</thead>
';$de=0;foreach($J["source"]as$z=>$X){echo"<tr>","<td>".html_select("source[".(+$z)."]",array(-1=>"")+$uh,$X,($de==count($J["source"])-1?"foreignAddRow.call(this);":1),"label-source"),"<td>".html_select("target[".(+$z)."]",$Vh,$J["target"][$z],1,"label-target");$de++;}echo'</table>
<p>
ON DELETE: ',html_select("on_delete",array(-1=>"")+explode("|",$of),$J["on_delete"]),' ON UPDATE: ',html_select("on_update",array(-1=>"")+explode("|",$of),$J["on_update"]),doc_link(array('sql'=>"innodb-foreign-key-constraints.html",'mariadb'=>"foreign-keys/",'pgsql'=>"sql-createtable.html#SQL-CREATETABLE-REFERENCES",'mssql'=>"ms174979.aspx",'oracle'=>"https://docs.oracle.com/cd/B19306_01/server.102/b14200/clauses002.htm#sthref2903",)),'<p>
<input type="submit" value="Save">
<noscript><p><input type="submit" name="add" value="Add column"></noscript>
';if($D!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$D));}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["view"])){$a=$_GET["view"];$J=$_POST;$Ef="VIEW";if($y=="pgsql"&&$a!=""){$O=table_status($a);$Ef=strtoupper($O["Engine"]);}if($_POST&&!$m){$D=trim($J["name"]);$Fa=" AS\n$J[select]";$B=ME."table=".urlencode($D);$Je='View has been altered.';$T=($_POST["materialized"]?"MATERIALIZED VIEW":"VIEW");if(!$_POST["drop"]&&$a==$D&&$y!="sqlite"&&$T=="VIEW"&&$Ef=="VIEW")query_redirect(($y=="mssql"?"ALTER":"CREATE OR REPLACE")." VIEW ".table($D).$Fa,$B,$Je);else{$Xh=$D."_adminer_".uniqid();drop_create("DROP $Ef ".table($a),"CREATE $T ".table($D).$Fa,"DROP $T ".table($D),"CREATE $T ".table($Xh).$Fa,"DROP $T ".table($Xh),($_POST["drop"]?substr(ME,0,-1):$B),'View has been dropped.',$Je,'View has been created.',$a,$D);}}if(!$_POST&&$a!=""){$J=adm_view($a);$J["name"]=$a;$J["materialized"]=($Ef!="VIEW");if(!$m)$m=error();}page_header(($a!=""?'Alter view':'Create view'),$m,array("table"=>$a),h($a));echo'
<form action="" method="post">
<p>Name: <input name="name" value="',h($J["name"]),'" data-maxlength="64" autocapitalize="off">
',(support("materializedview")?" ".checkbox("materialized",1,$J["materialized"],'Materialized view'):""),'<p>';textarea("select",$J["select"]);echo'<p>
<input type="submit" value="Save">
';if($a!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$a));}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["event"])){$aa=$_GET["event"];$Vd=array("YEAR","QUARTER","MONTH","DAY","HOUR","MINUTE","WEEK","SECOND","YEAR_MONTH","DAY_HOUR","DAY_MINUTE","DAY_SECOND","HOUR_MINUTE","HOUR_SECOND","MINUTE_SECOND");$Dh=array("ENABLED"=>"ENABLE","DISABLED"=>"DISABLE","SLAVESIDE_DISABLED"=>"DISABLE ON SLAVE");$J=$_POST;if($_POST&&!$m){if($_POST["drop"])query_redirect("DROP EVENT ".idf_escape($aa),substr(ME,0,-1),'Event has been dropped.');elseif(in_array($J["INTERVAL_FIELD"],$Vd)&&isset($Dh[$J["STATUS"]])){$Xg="\nON SCHEDULE ".($J["INTERVAL_VALUE"]?"EVERY ".q($J["INTERVAL_VALUE"])." $J[INTERVAL_FIELD]".($J["STARTS"]?" STARTS ".q($J["STARTS"]):"").($J["ENDS"]?" ENDS ".q($J["ENDS"]):""):"AT ".q($J["STARTS"]))." ON COMPLETION".($J["ON_COMPLETION"]?"":" NOT")." PRESERVE";queries_redirect(substr(ME,0,-1),($aa!=""?'Event has been altered.':'Event has been created.'),queries(($aa!=""?"ALTER EVENT ".idf_escape($aa).$Xg.($aa!=$J["EVENT_NAME"]?"\nRENAME TO ".idf_escape($J["EVENT_NAME"]):""):"CREATE EVENT ".idf_escape($J["EVENT_NAME"]).$Xg)."\n".$Dh[$J["STATUS"]]." COMMENT ".q($J["EVENT_COMMENT"]).rtrim(" DO\n$J[EVENT_DEFINITION]",";").";"));}}page_header(($aa!=""?'Alter event'.": ".h($aa):'Create event'),$m);if(!$J&&$aa!=""){$K=get_rows("SELECT * FROM information_schema.EVENTS WHERE EVENT_SCHEMA = ".q(DB)." AND EVENT_NAME = ".q($aa));$J=reset($K);}echo'
<form action="" method="post">
<table cellspacing="0" class="layout">
<tr><th>Name<td><input name="EVENT_NAME" value="',h($J["EVENT_NAME"]),'" data-maxlength="64" autocapitalize="off">
<tr><th title="datetime">Start<td><input name="STARTS" value="',h("$J[EXECUTE_AT]$J[STARTS]"),'">
<tr><th title="datetime">End<td><input name="ENDS" value="',h($J["ENDS"]),'">
<tr><th>Every<td><input type="number" name="INTERVAL_VALUE" value="',h($J["INTERVAL_VALUE"]),'" class="size"> ',html_select("INTERVAL_FIELD",$Vd,$J["INTERVAL_FIELD"]),'<tr><th>Status<td>',html_select("STATUS",$Dh,$J["STATUS"]),'<tr><th>Comment<td><input name="EVENT_COMMENT" value="',h($J["EVENT_COMMENT"]),'" data-maxlength="64">
<tr><th><td>',checkbox("ON_COMPLETION","PRESERVE",$J["ON_COMPLETION"]=="PRESERVE",'On completion preserve'),'</table>
<p>';textarea("EVENT_DEFINITION",$J["EVENT_DEFINITION"]);echo'<p>
<input type="submit" value="Save">
';if($aa!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$aa));}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["procedure"])){$da=($_GET["name"]?$_GET["name"]:$_GET["procedure"]);$Sg=(isset($_GET["function"])?"FUNCTION":"PROCEDURE");$J=$_POST;$J["fields"]=(array)$J["fields"];if($_POST&&!process_fields($J["fields"])&&!$m){$Bf=routine($_GET["procedure"],$Sg);$Xh="$J[name]_adminer_".uniqid();drop_create("DROP $Sg ".routine_id($da,$Bf),create_routine($Sg,$J),"DROP $Sg ".routine_id($J["name"],$J),create_routine($Sg,array("name"=>$Xh)+$J),"DROP $Sg ".routine_id($Xh,$J),substr(ME,0,-1),'Routine has been dropped.','Routine has been altered.','Routine has been created.',$da,$J["name"]);}page_header(($da!=""?(isset($_GET["function"])?'Alter function':'Alter procedure').": ".h($da):(isset($_GET["function"])?'Create function':'Create procedure')),$m);if(!$_POST&&$da!=""){$J=routine($_GET["procedure"],$Sg);$J["name"]=$da;}$mb=get_vals("SHOW CHARACTER SET");sort($mb);$Tg=routine_languages();echo'
<form action="" method="post" id="form">
<p>Name: <input name="name" value="',h($J["name"]),'" data-maxlength="64" autocapitalize="off">
',($Tg?'Language'.": ".html_select("language",$Tg,$J["language"])."\n":""),'<input type="submit" value="Save">
<div class="scrollable">
<table cellspacing="0" class="nowrap">
';edit_fields($J["fields"],$mb,$Sg);if(isset($_GET["function"])){echo"<tr><td>".'Return type';edit_type("returns",$J["returns"],$mb,array(),($y=="pgsql"?array("void","trigger"):array()));}echo'</table>
',script("editFields();"),'</div>
<p>';textarea("definition",$J["definition"]);echo'<p>
<input type="submit" value="Save">
';if($da!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$da));}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["sequence"])){$fa=$_GET["sequence"];$J=$_POST;if($_POST&&!$m){$A=substr(ME,0,-1);$D=trim($J["name"]);if($_POST["drop"])query_redirect("DROP SEQUENCE ".idf_escape($fa),$A,'Sequence has been dropped.');elseif($fa=="")query_redirect("CREATE SEQUENCE ".idf_escape($D),$A,'Sequence has been created.');elseif($fa!=$D)query_redirect("ALTER SEQUENCE ".idf_escape($fa)." RENAME TO ".idf_escape($D),$A,'Sequence has been altered.');else
adm_redirect($A);}page_header($fa!=""?'Alter sequence'.": ".h($fa):'Create sequence',$m);if(!$J)$J["name"]=$fa;echo'
<form action="" method="post">
<p><input name="name" value="',h($J["name"]),'" autocapitalize="off">
<input type="submit" value="Save">
';if($fa!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',$fa))."\n";echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["type"])){$ga=$_GET["type"];$J=$_POST;if($_POST&&!$m){$A=substr(ME,0,-1);if($_POST["drop"])query_redirect("DROP TYPE ".idf_escape($ga),$A,'Type has been dropped.');else
query_redirect("CREATE TYPE ".idf_escape(trim($J["name"]))." $J[as]",$A,'Type has been created.');}page_header($ga!=""?'Alter type'.": ".h($ga):'Create type',$m);if(!$J)$J["as"]="AS ";echo'
<form action="" method="post">
<p>
';if($ga!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',$ga))."\n";else{echo"<input name='name' value='".h($J['name'])."' autocapitalize='off'>\n";textarea("as",$J["as"]);echo"<p><input type='submit' value='".'Save'."'>\n";}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["trigger"])){$a=$_GET["trigger"];$D=$_GET["name"];$xi=trigger_options();$J=(array)trigger($D)+array("Trigger"=>$a."_bi");if($_POST){if(!$m&&in_array($_POST["Timing"],$xi["Timing"])&&in_array($_POST["Event"],$xi["Event"])&&in_array($_POST["Type"],$xi["Type"])){$nf=" ON ".table($a);$ic="DROP TRIGGER ".idf_escape($D).($y=="pgsql"?$nf:"");$B=ME."table=".urlencode($a);if($_POST["drop"])query_redirect($ic,$B,'Trigger has been dropped.');else{if($D!="")queries($ic);queries_redirect($B,($D!=""?'Trigger has been altered.':'Trigger has been created.'),queries(create_trigger($nf,$_POST)));if($D!="")queries(create_trigger($nf,$J+array("Type"=>reset($xi["Type"]))));}}$J=$_POST;}page_header(($D!=""?'Alter trigger'.": ".h($D):'Create trigger'),$m,array("table"=>$a));echo'
<form action="" method="post" id="form">
<table cellspacing="0" class="layout">
<tr><th>Time<td>',html_select("Timing",$xi["Timing"],$J["Timing"],"triggerChange(/^".preg_quote($a,"/")."_[ba][iud]$/, '".js_escape($a)."', this.form);"),'<tr><th>Event<td>',html_select("Event",$xi["Event"],$J["Event"],"this.form['Timing'].onchange();"),(in_array("UPDATE OF",$xi["Event"])?" <input name='Of' value='".h($J["Of"])."' class='hidden'>":""),'<tr><th>Type<td>',html_select("Type",$xi["Type"],$J["Type"]),'</table>
<p>Name: <input name="Trigger" value="',h($J["Trigger"]),'" data-maxlength="64" autocapitalize="off">
',script("qs('#form')['Timing'].onchange();"),'<p>';textarea("Statement",$J["Statement"]);echo'<p>
<input type="submit" value="Save">
';if($D!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$D));}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["user"])){$ha=$_GET["user"];$og=array(""=>array("All privileges"=>""));foreach(get_rows("SHOW PRIVILEGES")as$J){foreach(explode(",",($J["Privilege"]=="Grant option"?"":$J["Context"]))as$Db)$og[$Db][$J["Privilege"]]=$J["Comment"];}$og["Server Admin"]+=$og["File access on server"];$og["Databases"]["Create routine"]=$og["Procedures"]["Create routine"];unset($og["Procedures"]["Create routine"]);$og["Columns"]=array();foreach(array("Select","Insert","Update","References")as$X)$og["Columns"][$X]=$og["Tables"][$X];unset($og["Server Admin"]["Usage"]);foreach($og["Tables"]as$z=>$X)unset($og["Databases"][$z]);$We=array();if($_POST){foreach($_POST["objects"]as$z=>$X)$We[$X]=(array)$We[$X]+(array)$_POST["grants"][$z];}$nd=array();$lf="";if(isset($_GET["host"])&&($H=$f->query("SHOW GRANTS FOR ".q($ha)."@".q($_GET["host"])))){while($J=$H->fetch_row()){if(preg_match('~GRANT (.*) ON (.*) TO ~',$J[0],$C)&&preg_match_all('~ *([^(,]*[^ ,(])( *\([^)]+\))?~',$C[1],$Be,PREG_SET_ORDER)){foreach($Be
as$X){if($X[1]!="USAGE")$nd["$C[2]$X[2]"][$X[1]]=true;if(preg_match('~ WITH GRANT OPTION~',$J[0]))$nd["$C[2]$X[2]"]["GRANT OPTION"]=true;}}if(preg_match("~ IDENTIFIED BY PASSWORD '([^']+)~",$J[0],$C))$lf=$C[1];}}if($_POST&&!$m){$mf=(isset($_GET["host"])?q($ha)."@".q($_GET["host"]):"''");if($_POST["drop"])query_redirect("DROP USER $mf",ME."privileges=",'User has been dropped.');else{$Ye=q($_POST["user"])."@".q($_POST["host"]);$Vf=$_POST["pass"];if($Vf!=''&&!$_POST["hashed"]&&!min_version(8)){$Vf=$f->result("SELECT PASSWORD(".q($Vf).")");$m=!$Vf;}$Jb=false;if(!$m){if($mf!=$Ye){$Jb=queries((min_version(5)?"CREATE USER":"GRANT USAGE ON *.* TO")." $Ye IDENTIFIED BY ".(min_version(8)?"":"PASSWORD ").q($Vf));$m=!$Jb;}elseif($Vf!=$lf)queries("SET PASSWORD FOR $Ye = ".q($Vf));}if(!$m){$Pg=array();foreach($We
as$ef=>$md){if(isset($_GET["grant"]))$md=array_filter($md);$md=array_keys($md);if(isset($_GET["grant"]))$Pg=array_diff(array_keys(array_filter($We[$ef],'strlen')),$md);elseif($mf==$Ye){$jf=array_keys((array)$nd[$ef]);$Pg=array_diff($jf,$md);$md=array_diff($md,$jf);unset($nd[$ef]);}if(preg_match('~^(.+)\s*(\(.*\))?$~U',$ef,$C)&&(!grant("REVOKE",$Pg,$C[2]," ON $C[1] FROM $Ye")||!grant("GRANT",$md,$C[2]," ON $C[1] TO $Ye"))){$m=true;break;}}}if(!$m&&isset($_GET["host"])){if($mf!=$Ye)queries("DROP USER $mf");elseif(!isset($_GET["grant"])){foreach($nd
as$ef=>$Pg){if(preg_match('~^(.+)(\(.*\))?$~U',$ef,$C))grant("REVOKE",array_keys($Pg),$C[2]," ON $C[1] FROM $Ye");}}}queries_redirect(ME."privileges=",(isset($_GET["host"])?'User has been altered.':'User has been created.'),!$m);if($Jb)$f->query("DROP USER $Ye");}}page_header((isset($_GET["host"])?'Username'.": ".h("$ha@$_GET[host]"):'Create user'),$m,array("privileges"=>array('','Privileges')));if($_POST){$J=$_POST;$nd=$We;}else{$J=$_GET+array("host"=>$f->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', -1)"));$J["pass"]=$lf;if($lf!="")$J["hashed"]=true;$nd[(DB==""||$nd?"":idf_escape(addcslashes(DB,"%_\\"))).".*"]=array();}echo'<form action="" method="post">
<table cellspacing="0" class="layout">
<tr><th>Server<td><input name="host" data-maxlength="60" value="',h($J["host"]),'" autocapitalize="off">
<tr><th>Username<td><input name="user" data-maxlength="80" value="',h($J["user"]),'" autocapitalize="off">
<tr><th>Password<td><input name="pass" id="pass" value="',h($J["pass"]),'" autocomplete="new-password">
';if(!$J["hashed"])echo
script("typePassword(qs('#pass'));");echo(min_version(8)?"":checkbox("hashed",1,$J["hashed"],'Hashed',"typePassword(this.form['pass'], this.checked);")),'</table>

';echo"<table cellspacing='0'>\n","<thead><tr><th colspan='2'>".'Privileges'.doc_link(array('sql'=>"grant.html#priv_level"));$t=0;foreach($nd
as$ef=>$md){echo'<th>'.($ef!="*.*"?"<input name='objects[$t]' value='".h($ef)."' size='10' autocapitalize='off'>":"<input type='hidden' name='objects[$t]' value='*.*' size='10'>*.*");$t++;}echo"</thead>\n";foreach(array(""=>"","Server Admin"=>'Server',"Databases"=>'Database',"Tables"=>'Table',"Columns"=>'Column',"Procedures"=>'Routine',)as$Db=>$ac){foreach((array)$og[$Db]as$ng=>$rb){echo"<tr".odd()."><td".($ac?">$ac<td":" colspan='2'").' lang="en" title="'.h($rb).'">'.h($ng);$t=0;foreach($nd
as$ef=>$md){$D="'grants[$t][".h(strtoupper($ng))."]'";$Y=$md[strtoupper($ng)];if($Db=="Server Admin"&&$ef!=(isset($nd["*.*"])?"*.*":".*"))echo"<td>";elseif(isset($_GET["grant"]))echo"<td><select name=$D><option><option value='1'".($Y?" selected":"").">".'Grant'."<option value='0'".($Y=="0"?" selected":"").">".'Revoke'."</select>";else{echo"<td align='center'><label class='block'>","<input type='checkbox' name=$D value='1'".($Y?" checked":"").($ng=="All privileges"?" id='grants-$t-all'>":">".($ng=="Grant option"?"":script("qsl('input').onclick = function () { if (this.checked) formUncheck('grants-$t-all'); };"))),"</label>";}$t++;}}}echo"</table>\n",'<p>
<input type="submit" value="Save">
';if(isset($_GET["host"])){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',"$ha@$_GET[host]"));}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["processlist"])){if(support("kill")&&$_POST&&!$m){$ie=0;foreach((array)$_POST["kill"]as$X){if(kill_process($X))$ie++;}queries_redirect(ME."processlist=",lang(array('%d process has been killed.','%d processes have been killed.'),$ie),$ie||!$_POST["kill"]);}page_header('Process list',$m);echo'
<form action="" method="post">
<div class="scrollable">
<table cellspacing="0" class="nowrap checkable">
',script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});");$t=-1;foreach(process_list()as$t=>$J){if(!$t){echo"<thead><tr lang='en'>".(support("kill")?"<th>":"");foreach($J
as$z=>$X)echo"<th>$z".doc_link(array('sql'=>"show-processlist.html#processlist_".strtolower($z),'pgsql'=>"monitoring-stats.html#PG-STAT-ACTIVITY-VIEW",'oracle'=>"REFRN30223",));echo"</thead>\n";}echo"<tr".odd().">".(support("kill")?"<td>".checkbox("kill[]",$J[$y=="sql"?"Id":"pid"],0):"");foreach($J
as$z=>$X)echo"<td>".(($y=="sql"&&$z=="Info"&&preg_match("~Query|Killed~",$J["Command"])&&$X!="")||($y=="pgsql"&&$z=="current_query"&&$X!="<IDLE>")||($y=="oracle"&&$z=="sql_text"&&$X!="")?"<code class='jush-$y'>".shorten_utf8($X,100,"</code>").' <a href="'.h(ME.($J["db"]!=""?"db=".urlencode($J["db"])."&":"")."sql=".urlencode($X)).'">'.'Clone'.'</a>':h($X));echo"\n";}echo'</table>
</div>
<p>
';if(support("kill")){echo($t+1)."/".sprintf('%d in total',max_connections()),"<p><input type='submit' value='".'Kill'."'>\n";}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
',script("tableCheck();");}elseif(isset($_GET["select"])){$a=$_GET["select"];$R=table_status1($a);$x=indexes($a);$o=fields($a);$gd=column_foreign_keys($a);$hf=$R["Oid"];parse_str($_COOKIE["adminer_import"],$ya);$Qg=array();$e=array();$bi=null;foreach($o
as$z=>$n){$D=$b->fieldName($n);if(isset($n["privileges"]["select"])&&$D!=""){$e[$z]=html_entity_decode(strip_tags($D),ENT_QUOTES);if(is_shortable($n))$bi=$b->selectLengthProcess();}$Qg+=$n["privileges"];}list($L,$od)=$b->selectColumnsProcess($e,$x);$Zd=count($od)<count($L);$Z=$b->selectSearchProcess($o,$x);$yf=$b->selectOrderProcess($o,$x);$_=$b->selectLimitProcess();if($_GET["val"]&&is_ajax()){header("Content-Type: text/plain; charset=utf-8");foreach($_GET["val"]as$Di=>$J){$Fa=convert_field($o[key($J)]);$L=array($Fa?$Fa:idf_escape(key($J)));$Z[]=where_check($Di,$o);$I=$l->select($a,$L,$Z,$L);if($I)echo
reset($I->fetch_row());}exit;}$jg=$Fi=null;foreach($x
as$w){if($w["type"]=="PRIMARY"){$jg=array_flip($w["columns"]);$Fi=($L?$jg:array());foreach($Fi
as$z=>$X){if(in_array(idf_escape($z),$L))unset($Fi[$z]);}break;}}if($hf&&!$jg){$jg=$Fi=array($hf=>0);$x[]=array("type"=>"PRIMARY","columns"=>array($hf));}if($_POST&&!$m){$gj=$Z;if(!$_POST["all"]&&is_array($_POST["check"])){$db=array();foreach($_POST["check"]as$ab)$db[]=where_check($ab,$o);$gj[]="((".implode(") OR (",$db)."))";}$gj=($gj?"\nWHERE ".implode(" AND ",$gj):"");if($_POST["export"]){adm_cookie("adminer_import","output=".urlencode($_POST["output"])."&format=".urlencode($_POST["format"]));dump_headers($a);$b->dumpTable($a,"");$kd=($L?implode(", ",$L):"*").convert_fields($e,$o,$L)."\nFROM ".table($a);$qd=($od&&$Zd?"\nGROUP BY ".implode(", ",$od):"").($yf?"\nORDER BY ".implode(", ",$yf):"");if(!is_array($_POST["check"])||$jg)$G="SELECT $kd$gj$qd";else{$Bi=array();foreach($_POST["check"]as$X)$Bi[]="(SELECT".limit($kd,"\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$o).$qd,1).")";$G=implode(" UNION ALL ",$Bi);}$b->dumpData($a,"table",$G);exit;}if(!$b->selectEmailProcess($Z,$gd)){if($_POST["save"]||$_POST["delete"]){$H=true;$za=0;$N=array();if(!$_POST["delete"]){foreach($e
as$D=>$X){$X=process_input($o[$D]);if($X!==null&&($_POST["clone"]||$X!==false))$N[idf_escape($D)]=($X!==false?$X:idf_escape($D));}}if($_POST["delete"]||$N){if($_POST["clone"])$G="INTO ".table($a)." (".implode(", ",array_keys($N)).")\nSELECT ".implode(", ",$N)."\nFROM ".table($a);if($_POST["all"]||($jg&&is_array($_POST["check"]))||$Zd){$H=($_POST["delete"]?$l->delete($a,$gj):($_POST["clone"]?queries("INSERT $G$gj"):$l->update($a,$N,$gj)));$za=$f->affected_rows;}else{foreach((array)$_POST["check"]as$X){$cj="\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$o);$H=($_POST["delete"]?$l->delete($a,$cj,1):($_POST["clone"]?queries("INSERT".limit1($a,$G,$cj)):$l->update($a,$N,$cj,1)));if(!$H)break;$za+=$f->affected_rows;}}}$Je=lang(array('%d item has been affected.','%d items have been affected.'),$za);if($_POST["clone"]&&$H&&$za==1){$ne=last_id();if($ne)$Je=sprintf('Item%s has been inserted.'," $ne");}queries_redirect(remove_from_uri($_POST["all"]&&$_POST["delete"]?"page":""),$Je,$H);if(!$_POST["delete"]){edit_form($a,$o,(array)$_POST["fields"],!$_POST["clone"]);page_footer();exit;}}elseif(!$_POST["import"]){if(!$_POST["val"])$m='Ctrl+click on a value to modify it.';else{$H=true;$za=0;foreach($_POST["val"]as$Di=>$J){$N=array();foreach($J
as$z=>$X){$z=bracket_escape($z,1);$N[idf_escape($z)]=(preg_match('~char|text~',$o[$z]["type"])||$X!=""?$b->processInput($o[$z],$X):"NULL");}$H=$l->update($a,$N," WHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($Di,$o),!$Zd&&!$jg," ");if(!$H)break;$za+=$f->affected_rows;}queries_redirect(remove_from_uri(),lang(array('%d item has been affected.','%d items have been affected.'),$za),$H);}}elseif(!is_string($Wc=get_file("csv_file",true)))$m=upload_error($Wc);elseif(!preg_match('~~u',$Wc))$m='File must be in UTF-8 encoding.';else{adm_cookie("adminer_import","output=".urlencode($ya["output"])."&format=".urlencode($_POST["separator"]));$H=true;$ob=array_keys($o);preg_match_all('~(?>"[^"]*"|[^"\r\n]+)+~',$Wc,$Be);$za=count($Be[0]);$l->begin();$gh=($_POST["separator"]=="csv"?",":($_POST["separator"]=="tsv"?"\t":";"));$K=array();foreach($Be[0]as$z=>$X){preg_match_all("~((?>\"[^\"]*\")+|[^$gh]*)$gh~",$X.$gh,$Ce);if(!$z&&!array_diff($Ce[1],$ob)){$ob=$Ce[1];$za--;}else{$N=array();foreach($Ce[1]as$t=>$jb)$N[idf_escape($ob[$t])]=($jb==""&&$o[$ob[$t]]["null"]?"NULL":q(str_replace('""','"',preg_replace('~^"|"$~','',$jb))));$K[]=$N;}}$H=(!$K||$l->insertUpdate($a,$K,$jg));if($H)$H=$l->commit();queries_redirect(remove_from_uri("page"),lang(array('%d row has been imported.','%d rows have been imported.'),$za),$H);$l->rollback();}}}$Nh=$b->tableName($R);if(is_ajax()){page_headers();ob_start();}else
page_header('Select'.": $Nh",$m);$N=null;if(isset($Qg["insert"])||!support("table")){$N="";foreach((array)$_GET["where"]as$X){if($gd[$X["col"]]&&count($gd[$X["col"]])==1&&($X["op"]=="="||(!$X["op"]&&!preg_match('~[_%]~',$X["val"]))))$N.="&set".urlencode("[".bracket_escape($X["col"])."]")."=".urlencode($X["val"]);}}$b->selectLinks($R,$N);if(!$e&&support("table"))echo"<p class='error'>".'Unable to select the table'.($o?".":": ".error())."\n";else{echo"<form action='' id='form'>\n","<div style='display: none;'>";hidden_fields_get();echo(DB!=""?'<input type="hidden" name="db" value="'.h(DB).'">'.(isset($_GET["ns"])?'<input type="hidden" name="ns" value="'.h($_GET["ns"]).'">':""):"");echo'<input type="hidden" name="select" value="'.h($a).'">',"</div>\n";$b->selectColumnsPrint($L,$e);$b->selectSearchPrint($Z,$e,$x);$b->selectOrderPrint($yf,$e,$x);$b->selectLimitPrint($_);$b->selectLengthPrint($bi);$b->selectActionPrint($x);echo"</form>\n";$E=$_GET["page"];if($E=="last"){$jd=$f->result(count_rows($a,$Z,$Zd,$od));$E=floor(max(0,$jd-1)/$_);}$bh=$L;$pd=$od;if(!$bh){$bh[]="*";$Eb=convert_fields($e,$o,$L);if($Eb)$bh[]=substr($Eb,2);}foreach($L
as$z=>$X){$n=$o[idf_unescape($X)];if($n&&($Fa=convert_field($n)))$bh[$z]="$Fa AS $X";}if(!$Zd&&$Fi){foreach($Fi
as$z=>$X){$bh[]=idf_escape($z);if($pd)$pd[]=idf_escape($z);}}$H=$l->select($a,$bh,$Z,$pd,$yf,$_,$E,true);if(!$H)echo"<p class='error'>".error()."\n";else{if($y=="mssql"&&$E)$H->seek($_*$E);$vc=array();echo"<form action='' method='post' enctype='multipart/form-data'>\n";$K=array();while($J=$H->fetch_assoc()){if($E&&$y=="oracle")unset($J["RNUM"]);$K[]=$J;}if($_GET["page"]!="last"&&$_!=""&&$od&&$Zd&&$y=="sql")$jd=$f->result(" SELECT FOUND_ROWS()");if(!$K)echo"<p class='message'>".'No rows.'."\n";else{$Oa=$b->backwardKeys($a,$Nh);echo"<div class='scrollable'>","<table id='table' cellspacing='0' class='nowrap checkable'>",script("mixin(qs('#table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true), onkeydown: editingKeydown});"),"<thead><tr>".(!$od&&$L?"":"<td><input type='checkbox' id='all-page' class='jsonly'>".script("qs('#all-page').onclick = partial(formCheck, /check/);","")." <a href='".h($_GET["modify"]?remove_from_uri("modify"):$_SERVER["REQUEST_URI"]."&modify=1")."'>".'Modify'."</a>");$Ue=array();$ld=array();reset($L);$yg=1;foreach($K[0]as$z=>$X){if(!isset($Fi[$z])){$X=$_GET["columns"][key($L)];$n=$o[$L?($X?$X["col"]:current($L)):$z];$D=($n?$b->fieldName($n,$yg):($X["fun"]?"*":$z));if($D!=""){$yg++;$Ue[$z]=$D;$d=idf_escape($z);$Cd=remove_from_uri('(order|desc)[^=]*|page').'&order%5B0%5D='.urlencode($z);$ac="&desc%5B0%5D=1";echo"<th id='th[".h(bracket_escape($z))."]'>".script("mixin(qsl('th'), {onmouseover: partial(columnMouse), onmouseout: partial(columnMouse, ' hidden')});",""),'<a href="'.h($Cd.($yf[0]==$d||$yf[0]==$z||(!$yf&&$Zd&&$od[0]==$d)?$ac:'')).'">';echo
apply_sql_function($X["fun"],$D)."</a>";echo"<span class='column hidden'>","<a href='".h($Cd.$ac)."' title='".'descending'."' class='text'> ↓</a>";if(!$X["fun"]){echo'<a href="#fieldset-search" title="'.'Search'.'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($z)."');");}echo"</span>";}$ld[$z]=$X["fun"];next($L);}}$te=array();if($_GET["modify"]){foreach($K
as$J){foreach($J
as$z=>$X)$te[$z]=max($te[$z],min(40,strlen(utf8_decode($X))));}}echo($Oa?"<th>".'Relations':"")."</thead>\n";if(is_ajax()){if($_%2==1&&$E%2==1)odd();ob_end_clean();}foreach($b->rowDescriptions($K,$gd)as$Te=>$J){$Ci=unique_array($K[$Te],$x);if(!$Ci){$Ci=array();foreach($K[$Te]as$z=>$X){if(!preg_match('~^(COUNT\((\*|(DISTINCT )?`(?:[^`]|``)+`)\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\(`(?:[^`]|``)+`\))$~',$z))$Ci[$z]=$X;}}$Di="";foreach($Ci
as$z=>$X){if(($y=="sql"||$y=="pgsql")&&preg_match('~char|text|enum|set~',$o[$z]["type"])&&strlen($X)>64){$z=(strpos($z,'(')?$z:idf_escape($z));$z="MD5(".($y!='sql'||preg_match("~^utf8~",$o[$z]["collation"])?$z:"CONVERT($z USING ".charset($f).")").")";$X=md5($X);}$Di.="&".($X!==null?urlencode("where[".bracket_escape($z)."]")."=".urlencode($X):"null%5B%5D=".urlencode($z));}echo"<tr".odd().">".(!$od&&$L?"":"<td>".checkbox("check[]",substr($Di,1),in_array(substr($Di,1),(array)$_POST["check"])).($Zd||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($a).$Di)."' class='edit'>".'edit'."</a>"));foreach($J
as$z=>$X){if(isset($Ue[$z])){$n=$o[$z];$X=$l->value($X,$n);if($X!=""&&(!isset($vc[$z])||$vc[$z]!=""))$vc[$z]=(is_mail($X)?$Ue[$z]:"");$A="";if(preg_match('~blob|bytea|raw|file~',$n["type"])&&$X!="")$A=ME.'download='.urlencode($a).'&field='.urlencode($z).$Di;if(!$A&&$X!==null){foreach((array)$gd[$z]as$q){if(count($gd[$z])==1||end($q["source"])==$z){$A="";foreach($q["source"]as$t=>$uh)$A.=where_link($t,$q["target"][$t],$K[$Te][$uh]);$A=($q["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\1'.urlencode($q["db"]),ME):ME).'select='.urlencode($q["table"]).$A;if($q["ns"])$A=preg_replace('~([?&]ns=)[^&]+~','\1'.urlencode($q["ns"]),$A);if(count($q["source"])==1)break;}}}if($z=="COUNT(*)"){$A=ME."select=".urlencode($a);$t=0;foreach((array)$_GET["where"]as$W){if(!array_key_exists($W["col"],$Ci))$A.=where_link($t++,$W["col"],$W["val"],$W["op"]);}foreach($Ci
as$ee=>$W)$A.=where_link($t++,$ee,$W);}$X=select_value($X,$A,$n,$bi);$u=h("val[$Di][".bracket_escape($z)."]");$Y=$_POST["val"][$Di][bracket_escape($z)];$qc=!is_array($J[$z])&&is_utf8($X)&&$K[$Te][$z]==$J[$z]&&!$ld[$z];$ai=preg_match('~text|lob~',$n["type"]);echo"<td id='$u'";if(($_GET["modify"]&&$qc)||$Y!==null){$td=h($Y!==null?$Y:$J[$z]);echo">".($ai?"<textarea name='$u' cols='30' rows='".(substr_count($J[$z],"\n")+1)."'>$td</textarea>":"<input name='$u' value='$td' size='$te[$z]'>");}else{$xe=strpos($X,"<i>…</i>");echo" data-text='".($xe?2:($ai?1:0))."'".($qc?"":" data-warning='".h('Use edit link to modify this value.')."'").">$X</td>";}}}if($Oa)echo"<td>";$b->backwardKeysPrint($Oa,$K[$Te]);echo"</tr>\n";}if(is_ajax())exit;echo"</table>\n","</div>\n";}if(!is_ajax()){if($K||$E){$Fc=true;if($_GET["page"]!="last"){if($_==""||(count($K)<$_&&($K||!$E)))$jd=($E?$E*$_:0)+count($K);elseif($y!="sql"||!$Zd){$jd=($Zd?false:found_rows($R,$Z));if($jd<max(1e4,2*($E+1)*$_))$jd=reset(slow_query(count_rows($a,$Z,$Zd,$od)));else$Fc=false;}}$Lf=($_!=""&&($jd===false||$jd>$_||$E));if($Lf){echo(($jd===false?count($K)+1:$jd-$E*$_)>$_?'<p><a href="'.h(remove_from_uri("page")."&page=".($E+1)).'" class="loadmore">'.'Load more data'.'</a>'.script("qsl('a').onclick = partial(selectLoadMore, ".(+$_).", '".'Loading'."…');",""):''),"\n";}}echo"<div class='footer'><div>\n";if($K||$E){if($Lf){$Ee=($jd===false?$E+(count($K)>=$_?2:1):floor(($jd-1)/$_));echo"<fieldset>";if($y!="simpledb"){echo"<legend><a href='".h(remove_from_uri("page"))."'>".'Page'."</a></legend>",script("qsl('a').onclick = function () { pageClick(this.href, +prompt('".'Page'."', '".($E+1)."')); return false; };"),pagination(0,$E).($E>5?" …":"");for($t=max(1,$E-4);$t<min($Ee,$E+5);$t++)echo
pagination($t,$E);if($Ee>0){echo($E+5<$Ee?" …":""),($Fc&&$jd!==false?pagination($Ee,$E):" <a href='".h(remove_from_uri("page")."&page=last")."' title='~$Ee'>".'last'."</a>");}}else{echo"<legend>".'Page'."</legend>",pagination(0,$E).($E>1?" …":""),($E?pagination($E,$E):""),($Ee>$E?pagination($E+1,$E).($Ee>$E+1?" …":""):"");}echo"</fieldset>\n";}echo"<fieldset>","<legend>".'Whole result'."</legend>";$fc=($Fc?"":"~ ").$jd;echo
checkbox("all",1,0,($jd!==false?($Fc?"":"~ ").lang(array('%d row','%d rows'),$jd):""),"var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$fc' : checked); selectCount('selected2', this.checked || !checked ? '$fc' : checked);")."\n","</fieldset>\n";if($b->selectCommandPrint()){echo'<fieldset',($_GET["modify"]?'':' class="jsonly"'),'><legend>Modify</legend><div>
<input type="submit" value="Save"',($_GET["modify"]?'':' title="'.'Ctrl+click on a value to modify it.'.'"'),'>
</div></fieldset>
<fieldset><legend>Selected <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="Edit">
<input type="submit" name="clone" value="Clone">
<input type="submit" name="delete" value="Delete">',confirm(),'</div></fieldset>
';}$hd=$b->dumpFormat();foreach((array)$_GET["columns"]as$d){if($d["fun"]){unset($hd['sql']);break;}}if($hd){print_fieldset("export",'Export'." <span id='selected2'></span>");$If=$b->dumpOutput();echo($If?html_select("output",$If,$ya["output"])." ":""),html_select("format",$hd,$ya["format"])," <input type='submit' name='export' value='".'Export'."'>\n","</div></fieldset>\n";}$b->selectEmailPrint(array_filter($vc,'strlen'),$e);}echo"</div></div>\n";if($b->selectImportPrint()){echo"<div>","<a href='#import'>".'Import'."</a>",script("qsl('a').onclick = partial(toggle, 'import');",""),"<span id='import' class='hidden'>: ","<input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$ya["format"],1);echo" <input type='submit' name='import' value='".'Import'."'>","</span>","</div>";}echo"<input type='hidden' name='token' value='$mi'>\n","</form>\n",(!$od&&$L?"":script("tableCheck();"));}}}if(is_ajax()){ob_end_clean();exit;}}elseif(isset($_GET["variables"])){$O=isset($_GET["status"]);page_header($O?'Status':'Variables');$Ti=($O?show_status():show_variables());if(!$Ti)echo"<p class='message'>".'No rows.'."\n";else{echo"<table cellspacing='0'>\n";foreach($Ti
as$z=>$X){echo"<tr>","<th><code class='jush-".$y.($O?"status":"set")."'>".h($z)."</code>","<td>".h($X);}echo"</table>\n";}}elseif(isset($_GET["script"])){header("Content-Type: text/javascript; charset=utf-8");if($_GET["script"]=="db"){$Kh=array("Data_length"=>0,"Index_length"=>0,"Data_free"=>0);foreach(table_status()as$D=>$R){json_row("Comment-$D",h($R["Comment"]));if(!is_view($R)){foreach(array("Engine","Collation")as$z)json_row("$z-$D",h($R[$z]));foreach($Kh+array("Auto_increment"=>0,"Rows"=>0)as$z=>$X){if($R[$z]!=""){$X=format_number($R[$z]);json_row("$z-$D",($z=="Rows"&&$X&&$R["Engine"]==($xh=="pgsql"?"table":"InnoDB")?"~ $X":$X));if(isset($Kh[$z]))$Kh[$z]+=($R["Engine"]!="InnoDB"||$z!="Data_free"?$R[$z]:0);}elseif(array_key_exists($z,$R))json_row("$z-$D");}}}foreach($Kh
as$z=>$X)json_row("sum-$z",format_number($X));json_row("");}elseif($_GET["script"]=="kill")$f->query("KILL ".number($_POST["kill"]));else{foreach(count_tables($b->databases())as$k=>$X){json_row("tables-$k",$X);json_row("size-$k",db_size($k));}json_row("");}exit;}else{$Th=array_merge((array)$_POST["tables"],(array)$_POST["views"]);if($Th&&!$m&&!$_POST["search"]){$H=true;$Je="";if($y=="sql"&&$_POST["tables"]&&count($_POST["tables"])>1&&($_POST["drop"]||$_POST["truncate"]||$_POST["copy"]))queries("SET foreign_key_checks = 0");if($_POST["truncate"]){if($_POST["tables"])$H=truncate_tables($_POST["tables"]);$Je='Tables have been truncated.';}elseif($_POST["move"]){$H=move_tables((array)$_POST["tables"],(array)$_POST["views"],$_POST["target"]);$Je='Tables have been moved.';}elseif($_POST["copy"]){$H=copy_tables((array)$_POST["tables"],(array)$_POST["views"],$_POST["target"]);$Je='Tables have been copied.';}elseif($_POST["drop"]){if($_POST["views"])$H=drop_views($_POST["views"]);if($H&&$_POST["tables"])$H=drop_tables($_POST["tables"]);$Je='Tables have been dropped.';}elseif($y!="sql"){$H=($y=="sqlite"?queries("VACUUM"):apply_queries("VACUUM".($_POST["optimize"]?"":" ANALYZE"),$_POST["tables"]));$Je='Tables have been optimized.';}elseif(!$_POST["tables"])$Je='No tables.';elseif($H=queries(($_POST["optimize"]?"OPTIMIZE":($_POST["check"]?"CHECK":($_POST["repair"]?"REPAIR":"ANALYZE")))." TABLE ".implode(", ",array_map('idf_escape',$_POST["tables"])))){while($J=$H->fetch_assoc())$Je.="<b>".h($J["Table"])."</b>: ".h($J["Msg_text"])."<br>";}queries_redirect(substr(ME,0,-1),$Je,$H);}page_header(($_GET["ns"]==""?'Database'.": ".h(DB):'Schema'.": ".h($_GET["ns"])),$m,true);if($b->homepage()){if($_GET["ns"]!==""){echo"<h3 id='tables-views'>".'Tables and views'."</h3>\n";$Sh=tables_list();if(!$Sh)echo"<p class='message'>".'No tables.'."\n";else{echo"<form action='' method='post'>\n";if(support("table")){echo"<fieldset><legend>".'Search data in tables'." <span id='selected2'></span></legend><div>","<input type='search' name='query' value='".h($_POST["query"])."'>",script("qsl('input').onkeydown = partialArg(bodyKeydown, 'search');","")," <input type='submit' name='search' value='".'Search'."'>\n","</div></fieldset>\n";if($_POST["search"]&&$_POST["query"]!=""){$_GET["where"][0]["op"]="LIKE %%";search_tables();}}echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),'<thead><tr class="wrap">','<td><input id="check-all" type="checkbox" class="jsonly">'.script("qs('#check-all').onclick = partial(formCheck, /^(tables|views)\[/);",""),'<th>'.'Table','<td>'.'Engine'.doc_link(array('sql'=>'storage-engines.html')),'<td>'.'Collation'.doc_link(array('sql'=>'charset-charsets.html','mariadb'=>'supported-character-sets-and-collations/')),'<td>'.'Data Length'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'functions-admin.html#FUNCTIONS-ADMIN-DBOBJECT','oracle'=>'REFRN20286')),'<td>'.'Index Length'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'functions-admin.html#FUNCTIONS-ADMIN-DBOBJECT')),'<td>'.'Data Free'.doc_link(array('sql'=>'show-table-status.html')),'<td>'.'Auto Increment'.doc_link(array('sql'=>'example-auto-increment.html','mariadb'=>'auto_increment/')),'<td>'.'Rows'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'catalog-pg-class.html#CATALOG-PG-CLASS','oracle'=>'REFRN20286')),(support("comment")?'<td>'.'Comment'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'functions-info.html#FUNCTIONS-INFO-COMMENT-TABLE')):''),"</thead>\n";$S=0;foreach($Sh
as$D=>$T){$Wi=($T!==null&&!preg_match('~table~i',$T));$u=h("Table-".$D);echo'<tr'.odd().'><td>'.checkbox(($Wi?"views[]":"tables[]"),$D,in_array($D,$Th,true),"","","",$u),'<th>'.(support("table")||support("indexes")?"<a href='".h(ME)."table=".urlencode($D)."' title='".'Show structure'."' id='$u'>".h($D).'</a>':h($D));if($Wi){echo'<td colspan="6"><a href="'.h(ME)."view=".urlencode($D).'" title="'.'Alter view'.'">'.(preg_match('~materialized~i',$T)?'Materialized view':'View').'</a>','<td align="right"><a href="'.h(ME)."select=".urlencode($D).'" title="'.'Select data'.'">?</a>';}else{foreach(array("Engine"=>array(),"Collation"=>array(),"Data_length"=>array("create",'Alter table'),"Index_length"=>array("indexes",'Alter indexes'),"Data_free"=>array("edit",'New item'),"Auto_increment"=>array("auto_increment=1&create",'Alter table'),"Rows"=>array("select",'Select data'),)as$z=>$A){$u=" id='$z-".h($D)."'";echo($A?"<td align='right'>".(support("table")||$z=="Rows"||(support("indexes")&&$z!="Data_length")?"<a href='".h(ME."$A[0]=").urlencode($D)."'$u title='$A[1]'>?</a>":"<span$u>?</span>"):"<td id='$z-".h($D)."'>");}$S++;}echo(support("comment")?"<td id='Comment-".h($D)."'>":"");}echo"<tr><td><th>".sprintf('%d in total',count($Sh)),"<td>".h($y=="sql"?$f->result("SELECT @@default_storage_engine"):""),"<td>".h(db_collation(DB,collations()));foreach(array("Data_length","Index_length","Data_free")as$z)echo"<td align='right' id='sum-$z'>";echo"</table>\n","</div>\n";if(!information_schema(DB)){echo"<div class='footer'><div>\n";$Qi="<input type='submit' value='".'Vacuum'."'> ".on_help("'VACUUM'");$uf="<input type='submit' name='optimize' value='".'Optimize'."'> ".on_help($y=="sql"?"'OPTIMIZE TABLE'":"'VACUUM OPTIMIZE'");echo"<fieldset><legend>".'Selected'." <span id='selected'></span></legend><div>".($y=="sqlite"?$Qi:($y=="pgsql"?$Qi.$uf:($y=="sql"?"<input type='submit' value='".'Analyze'."'> ".on_help("'ANALYZE TABLE'").$uf."<input type='submit' name='check' value='".'Check'."'> ".on_help("'CHECK TABLE'")."<input type='submit' name='repair' value='".'Repair'."'> ".on_help("'REPAIR TABLE'"):"")))."<input type='submit' name='truncate' value='".'Truncate'."'> ".on_help($y=="sqlite"?"'DELETE'":"'TRUNCATE".($y=="pgsql"?"'":" TABLE'")).confirm()."<input type='submit' name='drop' value='".'Drop'."'>".on_help("'DROP TABLE'").confirm()."\n";$j=(support("scheme")?$b->schemas():$b->databases());if(count($j)!=1&&$y!="sqlite"){$k=(isset($_POST["target"])?$_POST["target"]:(support("scheme")?$_GET["ns"]:DB));echo"<p>".'Move to other database'.": ",($j?html_select("target",$j,$k):'<input name="target" value="'.h($k).'" autocapitalize="off">')," <input type='submit' name='move' value='".'Move'."'>",(support("copy")?" <input type='submit' name='copy' value='".'Copy'."'> ".checkbox("overwrite",1,$_POST["overwrite"],'overwrite'):""),"\n";}echo"<input type='hidden' name='all' value=''>";echo
script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^(tables|views)\[/));".(support("table")?" selectCount('selected2', formChecked(this, /^tables\[/) || $S);":"")." }"),"<input type='hidden' name='token' value='$mi'>\n","</div></fieldset>\n","</div></div>\n";}echo"</form>\n",script("tableCheck();");}echo'<p class="links"><a href="'.h(ME).'create=">'.'Create table'."</a>\n",(support("view")?'<a href="'.h(ME).'view=">'.'Create view'."</a>\n":"");if(support("routine")){echo"<h3 id='routines'>".'Routines'."</h3>\n";$Ug=routines();if($Ug){echo"<table cellspacing='0'>\n",'<thead><tr><th>'.'Name'.'<td>'.'Type'.'<td>'.'Return type'."<td></thead>\n";odd('');foreach($Ug
as$J){$D=($J["SPECIFIC_NAME"]==$J["ROUTINE_NAME"]?"":"&name=".urlencode($J["ROUTINE_NAME"]));echo'<tr'.odd().'>','<th><a href="'.h(ME.($J["ROUTINE_TYPE"]!="PROCEDURE"?'callf=':'call=').urlencode($J["SPECIFIC_NAME"]).$D).'">'.h($J["ROUTINE_NAME"]).'</a>','<td>'.h($J["ROUTINE_TYPE"]),'<td>'.h($J["DTD_IDENTIFIER"]),'<td><a href="'.h(ME.($J["ROUTINE_TYPE"]!="PROCEDURE"?'function=':'procedure=').urlencode($J["SPECIFIC_NAME"]).$D).'">'.'Alter'."</a>";}echo"</table>\n";}echo'<p class="links">'.(support("procedure")?'<a href="'.h(ME).'procedure=">'.'Create procedure'.'</a>':'').'<a href="'.h(ME).'function=">'.'Create function'."</a>\n";}if(support("sequence")){echo"<h3 id='sequences'>".'Sequences'."</h3>\n";$ih=get_vals("SELECT sequence_name FROM information_schema.sequences WHERE sequence_schema = current_schema() ORDER BY sequence_name");if($ih){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Name'."</thead>\n";odd('');foreach($ih
as$X)echo"<tr".odd()."><th><a href='".h(ME)."sequence=".urlencode($X)."'>".h($X)."</a>\n";echo"</table>\n";}echo"<p class='links'><a href='".h(ME)."sequence='>".'Create sequence'."</a>\n";}if(support("type")){echo"<h3 id='user-types'>".'User types'."</h3>\n";$Oi=types();if($Oi){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Name'."</thead>\n";odd('');foreach($Oi
as$X)echo"<tr".odd()."><th><a href='".h(ME)."type=".urlencode($X)."'>".h($X)."</a>\n";echo"</table>\n";}echo"<p class='links'><a href='".h(ME)."type='>".'Create type'."</a>\n";}if(support("event")){echo"<h3 id='events'>".'Events'."</h3>\n";$K=get_rows("SHOW EVENTS");if($K){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Name'."<td>".'Schedule'."<td>".'Start'."<td>".'End'."<td></thead>\n";foreach($K
as$J){echo"<tr>","<th>".h($J["Name"]),"<td>".($J["Execute at"]?'At given time'."<td>".$J["Execute at"]:'Every'." ".$J["Interval value"]." ".$J["Interval field"]."<td>$J[Starts]"),"<td>$J[Ends]",'<td><a href="'.h(ME).'event='.urlencode($J["Name"]).'">'.'Alter'.'</a>';}echo"</table>\n";$Dc=$f->result("SELECT @@event_scheduler");if($Dc&&$Dc!="ON")echo"<p class='error'><code class='jush-sqlset'>event_scheduler</code>: ".h($Dc)."\n";}echo'<p class="links"><a href="'.h(ME).'event=">'.'Create event'."</a>\n";}if($Sh)echo
script("ajaxSetHtml('".js_escape(ME)."script=db');");}}}page_footer();
