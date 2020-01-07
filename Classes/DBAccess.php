<?php
class DBAccess{
    private $_dsn;
    private $_username;
    private $_password;
    private $_pdo;

    public function __construct($d,$u,$p){
        $this->_dsn = $d;
        $this->_username = $u;
        $this->_password = $p;
    }
    // 连接到数据库的函数
    public function connect(){
        try{
            $this->_pdo = new PDO($this->_dsn, $this->_username, $this->_password);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo "Connection error: ".$e->getMessage()." on line ".$e->getLine();
        }
        return $this->_pdo;
    }
    // 从数据库断开的函数
    public function disconnect(){
        $this->_pdo = '';
    }

    // prepare函数，prepare函数本身应该会返回一个$this，所以能够继续链式调用bindValue()。prepare后必须赋值给一个变量！！然后这个变量再分别执行bindValue，execute，fetchAll等函数。
    //在这里由于prepare是PDO自带的函数，所以就不单独写进class中了。后面的preExe中包含prepare函数。
    // public function pre($sql){
    //     return $this->_pdo->prepare($sql);
    // }
    
    //bindValue函数，暂时不在此写入。
    
    //只有$this->_pdo是object，所以只有它能执行prepare，及后续的bindValue和execute等语句。在后面的命令中，$this->_pdo在外面已经被赋值给$m，所以可以直接应用execute等语句。

    //execute函数并返回所有结果。导入的$m需要在外面被赋值为: $名字->pre($sql)，并且已执行过bindValue()。
    public function exe($m){
        try{
            $m->execute();
            $result = $m->fetchAll();
        }
        catch(PDOException $e){
            die("Query error: ".$e->getMessage()." on line ".$e->getLine());
        }
        return $result;
    }

    //excute函数，如果$pkid是false，返回结果的行数，如果是true，返回最后一个加入的记录的id。
    public function exeNoQuery($m, $pkid=false){
        try{
            $result = $m->execute();
            if($pkid==true){
                $result = $this->_pdo->lastInsertId();
            }
        }
        catch(PDOException $e){
            if($e->getCode() == 23000){
                $result = 'foreignKey';
            }else{
                die('Query error: '.$e->getMessage());
            }            
        }
        return $result;
    }
   
    // 在查询后只返回一个一个值
    public function singleValue($m, $c=0){
        try{            
            $m->execute();
            $result = $m->fetchColumn($c);
        }
        catch(PDOException $e){
            die("Query error: ".$e->getMessage()." on line ".$e->getLine());
        }
        return $result;
    }   

    // prepare和execute命令，可以应用于无变量的查询语句。
    public function preExe($sql){
        try{
            $m = $this->_pdo->prepare($sql);
            $m->execute();
            $result = $m->fetchAll();
        }
        catch(PDOException $e){
            die("Query error: ".$e->getMessage()." on line ".$e->getLine());
        }
        return $result;
    }
}

?>

