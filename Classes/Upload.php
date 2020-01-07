<?php
    // 别忘了在form中加enctype='multipart/form-data'！！！！！
    class Upload{        
        private $_err = 0; 
        public $msg;    //返回的信息
        public $fn;     //上传文件的basename
        private $_fe;   //$_FILES[$this->f]['error']，错误代码
        private $_tf;   //最终的文件路径和文件名
        private $_ft;   //文件的扩展名
        
        public function __construct($targetDirectory, $fileToUpload){
            $this->td = $targetDirectory;
            $this->f = $fileToUpload; //对应表单中input的name
        }

        // 查看文件的扩展名，如果不是某些名字，展示错误信息
        public function extTest(){
            $this->fn = basename($_FILES["$this->f"]['name']);
            $this->_tf = $this->td.$this->fn;
            $this->_ft = pathinfo($this->_tf, PATHINFO_EXTENSION);

            if($this->_ft != 'jpg' && $this->_ft != 'png' && $this->_ft != 'jpeg' && $this->_ft != 'gif'){
                $this->_err++;
                $this->msg = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
                return false;             
            }
            return true;
        }

        // 查看内置的error code，如果为1，说明文件过大，展示错误信息。
        public function sizeTest(){
            $this->_fe = $_FILES[$this->f]['error'];
            if($this->_fe == 1){
                $this->_err++;
                $this->msg = 'Sorry, your file is too large. Max of 2M is allowed.';
                return false;               
            }
            return true;
        }

        // 如果目标文件夹中已经存在要上传的文件，则把新的文件名后面加上数字
        // $fileName是用于放到数据库中的名字，$targetfile是放到目标文件夹中的路径和名字，两者需要对应。        
        public function nameTest(){            
            $i = 2;            
            while (file_exists($this->_tf)) {
                $this->fn = str_replace('.'.$this->_ft, '('.$i.').'.$this->_ft, $this->fn);
                $this->_tf = $this->td.$this->fn;
                $i++;
            }            
            return $this->_tf;
        }

        // 如果没有错误，将文件从临时文件夹转入目标文件夹，不成功的话，展示内置的error code。
        public function upload(){
            if($this->_err == 0){                
                if(move_uploaded_file($_FILES[$this->f]['tmp_name'],$this->_tf)){
                    $this->msg = "The file $this->fn has been uploaded.";
                    return true;
                }else{
                    $this->msg = 'There is an error uploading your file, error code: '.$this->_fe;
                    return false;
                }
            }else{                
                return false;
            }            
        }
    }

    
?>