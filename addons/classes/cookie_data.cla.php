<?php
class cookie_data{
    private $table = 'patient_cookie_data_table';
    private $table2 = 'doctor_cookie_data_table';
    private $dbconn;
	private $dbstmt;
	private $dbsql;
    private $dbnumRow;
    
    public $id;
    public $token;
    public $ipaddress;
    public $login_time;
    public $expiretime;
    public $pid;
    
    public $current_patient;
    private $last_id;
    
    public function __construct($conn = ''){
        if(!empty($conn)){
            //CREATE CONNECTION
            require_once(file_location('inc_path','connection.inc.php'));
            $this->dbconn = dbconnect($conn,'PDO');
        }
        require_once(file_location('inc_path','class_all_session.inc.php'));
        $this->current_admin = all_session('admin');
        $this->current_doctor = all_session('doctor');
        $this->current_patient = all_session('patient');
    }
    
    public function __destruct(){
    	//CLOSES ALL CONNECTION
        if(is_resource($this->dbconn)){
            closeconnect('db', $this->dbconn);
        }
        if(is_resource($this->dbstmt)){
            closeconnect('stmt',$this->dbstmt);
        }
    }
    
    
    public function insert_cookie(){
        $this->dbsql = "INSERT INTO {$this->table}(cd_token,cd_ipaddress,cd_expiretime,p_id)
        VALUES(:token,:ipaddress,:exptime,:patient_id)";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':ipaddress',$this->ipaddress,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':exptime',$this->expiretime,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':patient_id',$this->current_patient,PDO::PARAM_STR);
        if($this->dbstmt->execute()){return true;}else{return false;}
    }//end insert cookie
    
    public function delete_cookie($type){
        if($type === 'current'){
            $this->dbsql = "DELETE FROM {$this->table} WHERE p_id = :patient_id AND cd_token = :token AND cd_ipaddress = :ipaddress";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':ipaddress',$this->ipaddress,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':patient_id',$this->pid,PDO::PARAM_INT);
            if($this->dbstmt->execute()){return true;}else{return false;}
        }elseif($type === 'all'){
            $this->dbsql = "DELETE FROM {$this->table} WHERE p_id = :patient_id";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':patient_id',$this->pid,PDO::PARAM_INT);
            $this->dbstmt->execute();
            $this->dbnumRow = $this->dbstmt->rowCount();
            if($this->dbnumRow > 0){return true;}else{return false;}
        }
    }//end delete cookie
    
    public function insert_doctor_cookie(){
        $this->dbsql = "INSERT INTO {$this->table2}(cd_token,cd_ipaddress,cd_expiretime,d_id)
        VALUES(:token,:ipaddress,:exptime,:doctor_id)";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':ipaddress',$this->ipaddress,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':exptime',$this->expiretime,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':doctor_id',$this->current_doctor,PDO::PARAM_STR);
        if($this->dbstmt->execute()){return true;}else{return false;}
    }//end insert cookie
    
    public function delete_doctor_cookie($type){
        if($type === 'current'){
            $this->dbsql = "DELETE FROM {$this->table2} WHERE d_id = :doctor_id AND cd_token = :token AND cd_ipaddress = :ipaddress";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':ipaddress',$this->ipaddress,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':doctor_id',$this->did,PDO::PARAM_INT);
            if($this->dbstmt->execute()){return true;}else{return false;}
        }elseif($type === 'all'){
            $this->dbsql = "DELETE FROM {$this->table2} WHERE d_id = :doctor_id";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':doctor_id',$this->did,PDO::PARAM_INT);
            $this->dbstmt->execute();
            $this->dbnumRow = $this->dbstmt->rowCount();
            if($this->dbnumRow > 0){return true;}else{return false;}
        }
    }//end delete cookie
}
?>