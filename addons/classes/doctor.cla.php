<?php
class doctor{
    private $table = 'doctor_table';
    private $table2 = 'guidance_request_table';
    private $table3 = 'patient_medication_table';
    private $media_table = 'doctor_media_table';
    private $dbconn;
	private $dbstmt;
	private $dbsql;
    private $dbnumRow;
    
    public $id;
    public $email;
    public $fullname;
    public $gender;
    public $password;
    public $status;
    
    public $new_password;
    public $current_password;
    
    private $current_doctor;
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
    
    public function re_hash_pass(){
        $this->new_password = hash_pass($this->current_password);
        $this->dbsql = "UPDATE {$this->table} SET d_password = :password WHERE d_email = :email LIMIT 1";
        $this->dbstmt =  $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':password',$this->new_password,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':email',$this->email,PDO::PARAM_INT);
        $this->dbstmt->execute();
    }
    
    public function sign_up(){
        $this->dbsql = "INSERT INTO {$this->table}(d_email,d_fullname,d_password,d_reg_id)
            VALUES(:email,:fullname,:password,:reg_id)";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':email',$this->email,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':fullname',$this->fullname,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':password',$this->password,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':reg_id',$this->reg_id,PDO::PARAM_STR);
        if($this->dbstmt->execute()){return $this->dbconn->lastInsertId();}else{return false;} 
    }//end of sign up
    
    public function authenticate_login(){
        //check if admin exists
        $this->id = content_data($this->table,'d_id',$this->email,'d_email');
        if($this->id !== false){
            $this->status = content_data($this->table,'d_status',$this->id,'d_id');
            $this->password = content_data($this->table,'d_password',$this->id,'d_id');
            if(password_verify($this->current_password,$this->password)){// verify
                if(password_needs_rehash($this->password,PASSWORD_DEFAULT)){$this->re_hash_pass();}//end of if need rehash
                if($this->status === "suspended"){return 'suspended';}elseif($this->status === "active" || $this->status === "pending"){return $this->id;}
            }else{//if password doesnt match
                return false;
            }//end of if passowrd match
        }else{// if doctor does not exits
            return false;
        }
    }// end of authenticate_login
    
    public function sign_out(){
        require_once(file_location('doctor_inc_path','session_destroy.inc.php'));
        return 'success';
    }
    
    public function update_doctor_data($type='current_doctor'){
        $this->dbsql = "UPDATE {$this->table} SET {$this->col} = :value WHERE d_id = :id LIMIT 1";
        $this->dbstmt =  $this->dbconn->prepare($this->dbsql);
		$this->dbstmt->bindParam(':value',$this->data,PDO::PARAM_STR);
        if($type === 'current_doctor'){
            $this->dbstmt->bindParam(':id',$this->current_doctor,PDO::PARAM_INT);
        }else{
            $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        }
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return 'success';}else{return 'fail';} 
    }//end of update doctor data
    
    public function delete_account(){
        $this->dbsql = "DELETE FROM {$this->table} WHERE d_id = :id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':id',$this->current_doctor,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return 'success';}else{return 'fail';}
    }
    
    public function update_profile(){
        $this->dbsql = "UPDATE {$this->table} SET d_phnumber = :phnumber,d_gender = :gender,d_country = :country,d_state = :state,d_address = :address WHERE d_id = :id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':phnumber',$this->phnumber,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':gender',$this->gender,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':country',$this->country,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':state',$this->state,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':address',$this->address,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':id',$this->current_doctor,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return 'success';}else{return 'fail';}
    }

    public function change_image(){
        $default = "home/avatar.png";
        $type_link = "dm_link_name";
        $type_extension = "dm_extension";
        $this->full_file_name = get_media('doctor',$this->current_doctor);
        $this->full_path = file_location('media_path',$this->full_file_name);
        if(content_data($this->media_table,'d_id',$this->current_doctor,'d_id') !== false){
            $this->dbsql = "UPDATE {$this->media_table} SET {$type_link} = :link_name,{$type_extension} = :extension WHERE d_id = :id LIMIT 1";
        }else{
            $this->dbsql = "INSERT INTO {$this->media_table}({$type_link},{$type_extension},d_id)VALUES(:link_name,:extension,:id)";
        }
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':link_name',$this->file_name,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':extension',$this->extension,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':id',$this->current_doctor,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){
            //delete the current image
            if(file_exists($this->full_path) && $this->full_file_name !== $default && is_file($this->full_path)){unlink($this->full_path);}
            return 'success';
        }else{
            //delete image
            $this->full_file_name = $this->file_name.".".$this->extension;
            $this->full_path = file_location('media_path',"doctor/".$this->full_file_name);
            if(file_exists($this->full_path) && $this->full_file_name !== $default && is_file($this->full_path)){unlink($this->full_path);}
            return 'fail';
        }
    }//end of store doctor image
    
    public function return_quidance_request(){
        if($this->status === 'accepted'){
            $this->dbsql = "UPDATE {$this->table2} SET gr_status = :status WHERE gr_id = :gr_id AND d_id = :id LIMIT 1";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':status',$this->status,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':gr_id',$this->gr_id,PDO::PARAM_INT);
            $this->dbstmt->bindParam(':id',$this->current_doctor,PDO::PARAM_INT);
            if($this->dbstmt->execute()){return 'success';}else{return 'fail';}
        }elseif($this->status === 'rejected'){
            $this->dbsql = "DELETE FROM {$this->table2} WHERE gr_id = :gr_id AND d_id = :id LIMIT 1";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':gr_id',$this->gr_id,PDO::PARAM_INT);
            $this->dbstmt->bindParam(':id',$this->current_doctor,PDO::PARAM_INT);
            if($this->dbstmt->execute()){return 'success';}else{return 'fail';}
        }
    }
}
?>