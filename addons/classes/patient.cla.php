<?php
class patient{
    private $table = 'patient_table';
    private $media_table = 'patient_media_table';
    private $table2 = 'patient_health_table';
    private $table3 = 'patient_medication_table';
    private $table4 = 'patient_adherence_table';
    private $table5 = 'guidance_request_table';
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
    public $pod;
    public $regdatetime;
    
    public $new_email;
    public $new_password;
    public $current_password;
    
    private $current_patient;
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
        $this->dbsql = "UPDATE {$this->table} SET p_password = :password WHERE p_email = :email LIMIT 1";
        $this->dbstmt =  $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':password',$this->new_password,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':email',$this->email,PDO::PARAM_INT);
        $this->dbstmt->execute();
    }
    
    public function sign_up(){
        $this->dbsql = "INSERT INTO {$this->table}(p_unique_id,p_email,p_fullname,p_password)
            VALUES(:unique_id,:email,:fullname,:password)";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':unique_id',$this->unique_id,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':email',$this->email,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':fullname',$this->fullname,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':password',$this->password,PDO::PARAM_STR);
        if($this->dbstmt->execute()){return $this->dbconn->lastInsertId();}else{return false;} 
    }//end of sign up
    
    public function authenticate_login(){
        //check if admin exists
        $this->id = content_data($this->table,'p_id',$this->email,'p_email');
        if($this->id !== false){
            $this->status = content_data($this->table,'p_status',$this->id,'p_id');
            $this->password = content_data($this->table,'p_password',$this->id,'p_id');
            if(password_verify($this->current_password,$this->password)){// verify
                if(password_needs_rehash($this->password,PASSWORD_DEFAULT)){$this->re_hash_pass();}//end of if need rehash
                if($this->status === "suspended"){return 'suspended';}elseif($this->status === "active"){return $this->id;}
            }else{//if password doesnt match
                return false;
            }//end of if passowrd match
        }else{// if patient does not exits
            return false;
        }
    }// end of authenticate_login
    
    public function sign_out(){
        require_once(file_location('inc_path','session_destroy.inc.php'));
        return 'success';
    }
    
    public function update_patient_data($type='current_patient'){
        $this->dbsql = "UPDATE {$this->table} SET {$this->col} = :value WHERE p_id = :id LIMIT 1";
        $this->dbstmt =  $this->dbconn->prepare($this->dbsql);
		$this->dbstmt->bindParam(':value',$this->data,PDO::PARAM_STR);
        if($type === 'current_patient'){
            $this->dbstmt->bindParam(':id',$this->current_patient,PDO::PARAM_INT);
        }else{
            $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        }
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return 'success';}else{return 'fail';} 
    }//end of update patient data
    
    public function delete_account(){
        $this->dbsql = "DELETE FROM {$this->table} WHERE p_id = :id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':id',$this->current_patient,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return 'success';}else{return 'fail';}
    }
    
    public function update_profile(){
        $this->dbsql = "UPDATE {$this->table} SET p_phnumber = :phnumber,p_gender = :gender,p_country = :country,p_state = :state,p_address = :address WHERE p_id = :id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':phnumber',$this->phnumber,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':gender',$this->gender,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':country',$this->country,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':state',$this->state,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':address',$this->address,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':id',$this->current_patient,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return 'success';}else{return 'fail';}
    }

    public function change_image(){
        $default = "home/avatar.png";
        $type_link = "pm_link_name";
        $type_extension = "pm_extension";
        $this->full_file_name = get_media('patient',$this->current_patient);
        $this->full_path = file_location('media_path',$this->full_file_name);
        if(content_data($this->media_table,'p_id',$this->current_patient,'p_id') !== false){
            $this->dbsql = "UPDATE {$this->media_table} SET {$type_link} = :link_name,{$type_extension} = :extension WHERE p_id = :id LIMIT 1";
        }else{
            $this->dbsql = "INSERT INTO {$this->media_table}({$type_link},{$type_extension},p_id)VALUES(:link_name,:extension,:id)";
        }
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':link_name',$this->file_name,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':extension',$this->extension,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':id',$this->current_patient,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){
            //delete the current image
            if(file_exists($this->full_path) && $this->full_file_name !== $default && is_file($this->full_path)){unlink($this->full_path);}
            return 'success';
        }else{
            //delete image
            $this->full_file_name = $this->file_name.".".$this->extension;
            $this->full_path = file_location('media_path',"patient/".$this->full_file_name);
            if(file_exists($this->full_path) && $this->full_file_name !== $default && is_file($this->full_path)){unlink($this->full_path);}
            return 'fail';
        }
    }//end of store patient image
    
    
    public function add_health_condition(){
        $this->dbsql = "INSERT INTO {$this->table2}(ph_illness,ph_stage,ph_note,p_id)
            VALUES(:illness,:stage,:note,:id)";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':illness',$this->illness,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':stage',$this->stage,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':note',$this->note,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':id',$this->current_patient,PDO::PARAM_INT);
        if($this->dbstmt->execute()){return 'success';}else{return 'fail';} 
    }//end of add health condition
    
    public function add_medication(){
        $this->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        try{
            //begin transaction
            $this->dbconn->beginTransaction();
            //insert medication
            $this->dbsql = "INSERT INTO {$this->table3}(pmd_name,pmd_duration,pmd_dosage_interval,pmd_first_intake_time,ph_id,p_id)
                VALUES(:name,:duration,:interval,:last_intake_time,:ph_id,:id)";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':name',$this->name,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':duration',$this->duration,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':interval',$this->interval,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':last_intake_time',$this->last_intake_time,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':ph_id',$this->ph_id,PDO::PARAM_INT);
            $this->dbstmt->bindParam(':id',$this->current_patient,PDO::PARAM_INT);
            $this->dbstmt->execute();
            $this->last_id = $this->dbconn->lastInsertId(); //last id
            //insert last and next adherence data
            foreach($this->adhere_array AS $this->status => $this->datetime){
                $this->dbsql = "INSERT INTO {$this->table4}(pma_status,pma_datetime,pmd_id,ph_id,p_id)
                VALUES(:status,:datetime,:pmd_id,:ph_id,:id)";
                $this->dbstmt = $this->dbconn->prepare($this->dbsql);
                $this->dbstmt->bindParam(':status',$this->status,PDO::PARAM_STR);
                $this->dbstmt->bindParam(':datetime',$this->datetime,PDO::PARAM_STR);
                $this->dbstmt->bindParam(':pmd_id',$this->last_id,PDO::PARAM_STR);
                $this->dbstmt->bindParam(':ph_id',$this->ph_id,PDO::PARAM_INT);
                $this->dbstmt->bindParam(':id',$this->current_patient,PDO::PARAM_INT);
                $this->dbstmt->execute();
            }
            // commit the transation
            if($this->dbconn->commit()){return 'success';}//if commit
        }catch(PDOException $e){
            //rollback
            if($this->dbconn->rollback()){return 'fail';}
        }
    }//end of add medication
    
    public function confirm_adherence(){
        $this->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        try{
            //begin transaction
            $this->dbconn->beginTransaction();
            //update status
            $this->dbsql = "UPDATE {$this->table4} SET pma_status = :status WHERE pma_id = :pma_id AND p_id = :id LIMIT 1";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':status',$this->status,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':pma_id',$this->pma_id,PDO::PARAM_INT);
            $this->dbstmt->bindParam(':id',$this->current_patient,PDO::PARAM_INT);
            $this->dbstmt->execute();
            //insert next adherence data
            if($this->expired_status === false){
                $this->dbsql = "INSERT INTO {$this->table4}(pma_datetime,pmd_id,ph_id,p_id) VALUES(:datetime,:pmd_id,:ph_id,:id)";
                $this->dbstmt = $this->dbconn->prepare($this->dbsql);
                $this->dbstmt->bindParam(':datetime',$this->datetime,PDO::PARAM_STR);
                $this->dbstmt->bindParam(':pmd_id',$this->pmd_id,PDO::PARAM_INT);
                $this->dbstmt->bindParam(':ph_id',$this->ph_id,PDO::PARAM_INT);
                $this->dbstmt->bindParam(':id',$this->current_patient,PDO::PARAM_INT);
                $this->dbstmt->execute();
            }
            // commit the transation
            if($this->dbconn->commit()){return 'success';}//if commit
        }catch(PDOException $e){
            //rollback
            if($this->dbconn->rollback()){return 'fail';}
        }
    }//end of confirm adherence
    
    public function send_quidance_request(){
        $this->dbsql = "INSERT INTO {$this->table5}(ph_id,d_id,p_id) VALUES(:ph_id,:d_id,:id)";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':ph_id',$this->ph_id,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':d_id',$this->d_id,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':id',$this->current_patient,PDO::PARAM_INT);
        if($this->dbstmt->execute()){return 'success';}else{return 'fail';}
    }//end of send quidance request

    public function delete_quidance_request(){
        $this->dbsql = "DELETE FROM {$this->table5} WHERE gr_id = :gr_id AND p_id = :id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':gr_id',$this->gr_id,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':id',$this->current_patient,PDO::PARAM_INT);
        if($this->dbstmt->execute()){return 'success';}else{return 'fail';}
    }
}
?>