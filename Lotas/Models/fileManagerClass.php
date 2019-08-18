<?php
class fileManger
{
    /*
    **function take file and allowed extentions and upload dirctory and return file name 
    **after edit
    */
    public function upload($file,$allowedExts,$uploadsDirectory)
    {
        $error        = array();
        $fileName     = $file['name'];
        $fileex       = explode(".",$fileName);
        $fileext      = strtolower(array_pop($fileex));
        $filetempname = $file['tmp_name'];
        if(in_array($fileext,$allowedExts) == FALSE)
        {
            $errors[] = "Extension is not allowed!";
        }
        if(empty($error))
        {
            $random = rand(0, 9999);
            $fileUrl = $random . "_" . date("d-m-Y") . "_" . $fileName;
            $destination = $uploadsDirectory. $random . "_" . date("d-m-Y") . "_" . $fileName;
            
            if(move_uploaded_file($filetempname, $destination))
            {
                $fileName = $fileUrl;
            }
        }
        else 
        {                
            foreach ($errors as $error) 
            {
                throw new Exception($error);
            }
        }
        return $fileName;
    }
    /*
    **function take file directory and delete file
    */
    public function delete($fileDir)
    {
        if (@!unlink($fileDir))
        {
            return true;
        }
        else
        {
            return true;
        }
    }
}