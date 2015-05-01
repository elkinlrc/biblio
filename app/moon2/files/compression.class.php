<?php
class Moon2_Files_Compression extends Moon_Files_FileManager {
    private $_Data;
    
public function __construct($mimeType = ""){
    $this->_Data = "";
    $this->_mimeType = $mimeType;
    switch($this->_mimeType){
        case "application/zip":
        case "application/x-zip":
        case "application/x-zip-compressed";
            if (!function_exists("zip_open")){
                echo "library not found";
                exit();
            }
        break;
        default:
            if (!function_exists("rar_open")){
                echo "library not found";
                exit();
            }
        break;
    }
}

public function folder($pathFolder, $outputName){
    $this->get_strFiles($pathFolder);
    $arrFilesnew = $this->get_arrFiles();
    switch($this->_mimeType){
        case "application/zip":
        case "application/x-zip":
        case "application/x-zip-compressed";
            $Zip = new ZipArchive;
            if ($Zip->open($outputName, ZipArchive::CREATE) === TRUE){
                foreach($arrFilesnew as $index => $fileName){
                    $newName = substr_replace($fileName, "", 0, strlen($pathFolder));
                    $Zip->addFile($fileName, $newName);
                }
                $Zip->close();
            }else{
                echo "File is not created.";
                exit();
            }
        break;
        default:
            echo "MOON Compress does not yet Support for this library";
            exit();
        break;
    }
}

private function get_arrFiles(){
    $arr = array();
    $arrNew = array();
    $arr = explode(";",$this->_Data);
    foreach ($arr as $index => $value){
        if (!empty($value)){
            $arrNew[] = $value;
        }
    }
    return $arrNew;
}

private function get_strFiles($folderName){
    $arrData = scandir($folderName);
    $arrFolders = $this->processData($folderName, $arrData, true);
    $arrFiles = $this->processData($folderName, $arrData, false);
    $this->_Data.= ";".implode(";", $arrFiles);
    foreach($arrFolders as $index => $value){
        $this->get_strFiles($value);
    }
}

private function processData($folderName, $arr, $folders = true){
    $arrFiles = array();
    $arrFolders = array();
    foreach($arr as $index => $value){
        $newDir = $folderName."/".$value;
        if ($value != "." && $value != ".."){
            if (is_dir($newDir)){
                $arrFolders[] = $folderName."/".$value;
            }else{
                $arrFiles[] = $folderName."/".$value;
            }
        }
    }
    if ($folders){
        return $arrFolders;
    }
    return $arrFiles;
}

}//End class
?>