<?php
class Moon2_Files_FileManager{
    protected $_mimeType;
    protected $_name;
    protected $_size;
    protected $_message;
    protected $_tmp;
    protected $_folder;
    protected $_realName;
    protected $_hiddName;
    protected $_ext;

public function __construct(){
    $this->_size = 0;
    $this->_name = "";
    $this->_folder = "";
    $this->_realName = "";
    $this->_hiddName = "";
    $this->_message = "";
    $this->_ext = "";
    $this->_mimetype = "application/zip";
}

public function loadFile($objFile){
    $this->_tmp =  $objFile["tmp_name"];
    $this->_realName =  $objFile["name"];
    $this->_size =  $objFile["size"];
    $this->_ext = strtolower(substr(strrchr($this->_realName,"."),1));
    $this->_hiddName = uniqid(rand(), true).str_replace(" ","",microtime()).".".$this->_ext;
    
    if (!is_uploaded_file($this->_tmp)){
        $this->_message = "No se puede cargar el Achivo";
        return false;
    }
    
    $pathFile = $this->_folder."/".$this->_hiddName;
    if(!move_uploaded_file($this->_tmp, $pathFile)) {
        $this->_message = "Error al intentar copia el archivo en la ruta: ".$this->_folder;
        return false;
    }
    //La siguiente función queda comentada pues PHP ya provee la variable type
    ////quedan pendientes las pruebas de linux
    //$this->_mimetype = $this->getMime($pathFile);
    $this->_mimetype = $objFile["type"];
    return true;
}

public function set_folder($value){
    if (is_dir($value)){
        $this->_folder = $value;        
    }else{
        echo "MOON2 Message: La carpeta destino ".$value."<br />";
        echo "<div style=\"color:#FF0000;\"><strong>NO</strong> existe</div>";
        exit();
    }
}

public function get_realName(){
    return $this->_realName;
}

public function get_mimetype(){
    return $this->_mimetype;
}

public function get_hiddName(){
    return $this->_hiddName;
}

public function get_size(){
    return $this->_size;
}

public function get_message(){
    return $this->_message;
}

public function set_realName($value){
    $this->_realName = $value;
}

public function get_extension(){
    $this->_ext = strtolower(substr(strrchr($this->_realName,"."),1));
    return $this->_ext;
}

/*
public function getMime($pathFile){
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $pathFile);
    finfo_close($finfo);
    return $mime;
}
 *
 */

public function download($fileName, $pathFile, $mime, $size) {
    //ob_clean();
    if(!is_file($pathFile)) {
        echo "<h1>File not Found</h1>";
        die();
    }
    header("Content-Description: File Transfer");
    header("Content-Type: {$mime}");
    header("Content-Size: {$size}");
    header("Content-Disposition: attachment; filename={$fileName}");
    ob_clean();
    flush();
    readfile($pathFile);
    exit();
}

public function imagePreview($fileName, $pathFile, $mime, $size) {
    if(!is_file($pathFile)) {
        echo "<h1>File not Found</h1>";
        die();
    }
    header("Content-Description: File Transfer");
    header("Content-Type: {$mime}");
    header("Content-Size: {$size}");
    header("Content-Disposition: inline; filename={$fileName}");
    ob_clean();
    flush();
    readfile($pathFile);
    exit();
}

function deleteFile($file) {
    $value = $this->_folder."/".$file;
    return unlink($value);
}

public function deleteDir($dir){
if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object){
        if ($object != "." && $object != ".."){
            if (filetype($dir."/".$object) == "dir") $this->deleteDir($dir."/".$object); else unlink($dir."/".$object);
        }
    }
    reset($objects);
    rmdir($dir);
    }
}

function sizeFortmat($size){
    $size = floatval($size);
    if ($size > 1048576) {
        return $re_sized = sprintf("%01.2f", $size / 1048576) . " MB";
    }elseif ($size > 1024) {
        return $re_sized = sprintf("%01.2f", $size / 1024) . " KB";
    }else{
        return $re_sized = $size . " Bytes";
    }
}

function icon($name) {
    $ctype = "";
    $this->_ext = strtolower(substr(strrchr($name,"."),1));
    switch($this->_ext) {
        case "pdm": $ctype="pdm.png"; break;
        case "pdf": $ctype="pdf.png"; break;
        case "doc": $ctype="pdf.png"; break;
        case "rtf": $ctype="rtf.png"; break;
        case "docx": $ctype="doc.png"; break;
        case "mpeg":
        case "mpg":
        case "mpe":
        case "wmv":
        case "avi": $ctype="avi.gif"; break;
        case "bmp": $ctype="img.png"; break;
        case "gif": $ctype="img.png"; break;
        case "jpeg": $ctype="img.png"; break;
        case "jpg": $ctype="img.png"; break;
        case "png": $ctype="img.png"; break;
        case "log": $ctype="log.png"; break;
        case "htm":
        case "html":
        case "php": $ctype="php.png"; break;
        case "ppt": $ctype="ppt.png"; break;    
        case "pptx": $ctype="ppt.png"; break;
        case "rar": $ctype="rar.png"; break;
        case "zip": $ctype="rar.png"; break;
        case "swf":
        case "txt": $ctype="txt.png"; break;
        case "xls": $ctype="xls.png"; break;
        case "xlsx": $ctype="xls.png"; break;
        case "accdb": $ctype="accdb.png"; break;
        default: $ctype="desconocido.png";
    }
    return $ctype;
}

}//End class
?>