<?php
    class Validation {
        //定义缺失的部分，以便后期更改颜色。    
        public $_errorField = [];

        //对input输入的内容进行预处理。
        protected function test($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //检验输入的first name和last name是否合法
        public function name($n){
            if (isset($_POST[$n]) && strlen($this->test($_POST[$n]))==0) {                
                $this->_errorField[] = $n;
                return 'Please supply the required content';                
            }
        }

        //检验输入的手机号码是否合法
        public function number($n){
            if(isset($_POST[$n])){
                if(strlen($this->test($_POST[$n]))==0){
                    $this->_errorField[] = $n;
                    return 'Please supply the required content';
                }elseif(!preg_match('/^[(+{0,1}61)0]4\d{8}$/', $_POST[$n])){
                    $this->_errorField[] = $n;
                    return 'Invalid cell phone number';
                }
            }
        }

        //检验输入的Email是否合法
        public function email($n){
            if(isset($_POST[$n])){
                if(strlen($this->test($_POST[$n]))==0){
                    $this->_errorField[] = $n;
                    return 'Please supply the required content';
                }elseif(!filter_var($_POST[$n], FILTER_VALIDATE_EMAIL)){
                    $this->_errorField[] = $n;
                    return 'Invalid Email';
                }
            }
        }

        //检验其他类型的数据是否设定且不为空
        public function checkSet($n){
            if(!isset($_POST[$n]) || strlen($this->test($_POST[$n]))==0){
                $this->_errorField[] = $n;
                return 'Please supply the required content';
            }
        }

        //$_errorField complete!!

        //获取errorField长度
        public function errLength(){
            return count($this->_errorField);
        }

        //设定class为error，用于标红
        public function setClass($n){
            if(in_array($n, $this->_errorField)){
                return 'error';
            }
        }

        //设定顶部class为error，用于显示提示
        public function setTop(){
            if($this->errLength()){
                return 'Please fill the required content correctly.';
            }
        }

        //设定text属性的input，避免重新输入
        public function setValue($n){
            if(isset($_POST[$n])){
                return htmlentities($_POST[$n]);
            }
        }

        //为radio和checkbox类型的input设定value，方便用户不用重新选择。
        public function setChecked($n,$v){
            if(isset($_POST[$n]) && $_POST[$n]==$v){
                return 'checked';
            }
        }

        //为select中的option设定value，方便用户不用重新选择。
        public function setSelected($n,$v){
            if(isset($_POST[$n]) && $_POST[$n]==$v){
                return 'selected';
            }
        }

    }
?>