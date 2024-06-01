<?php
require_once(file_location('inc_path','connection.inc.php'));
@$conn = dbconnect('admin','PDO');

//ADMIN
//CREATE ADMIN TABLE AND INSERT ADMIN
$sql = "CREATE TABLE IF NOT EXISTS admin_table(
    ad_id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    ad_email VARCHAR(50) NOT NULL,
    ad_username VARCHAR(50) NOT NULL,
    ad_password VARCHAR(100) NOT NULL,
    ad_fullname VARCHAR(50) NOT NULL,
    ad_level ENUM('1','2','3'),
    ad_status ENUM('suspended','active') DEFAULT 'active',
    ad_registered_by INT(100) NOT NULL,
    
    UNIQUE(ad_id),
    UNIQUE(ad_email),
    UNIQUE(ad_username),
    FULLTEXT KEY (ad_email,ad_username,ad_fullname)
    ) ENGINE=InnoDB";
@$conn->exec($sql);
    
// CREATE ADMIN MEDIA TABLE
$sql = "CREATE TABLE IF NOT EXISTS admin_media_table(
    am_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    am_link_name VARCHAR(100) NOT NULL,
    am_extension VARCHAR(50) NOT NULL,
    ad_id INT(100) NOT NULL,
            
    UNIQUE(am_id),
    UNIQUE(am_link_name),
    UNIQUE(ad_id),
    FOREIGN KEY (ad_id) REFERENCES admin_table(ad_id) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB";
@$conn->exec($sql);
// insert the grand admin
$admin = new admin('admin');
$admin->id = get_xml_data('id');
$admin->new_email = get_xml_data('email');
$admin->new_username = get_xml_data('username');
$admin->new_password = hash_pass(get_xml_data('pass'));
$admin->fullname = get_xml_data('fullname');
$admin->level = get_xml_data('level');
$admin->registered_by = get_xml_data('registered_by');
$admin->auto_insert_update();

//CREATE LOG TABLE
$sql = "CREATE TABLE IF NOT EXISTS log_table(
    l_id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    l_brief VARCHAR(100) NOT NULL,
	l_details VARCHAR(200) NOT NULL,
	l_regdatetime DATETIME DEFAULT NOW(),
	l_ip_address VARCHAR(200) NOT NULL,
	ad_username VARCHAR(50) NOT NULL,
    ad_id INT(100) NOT NULL,
    
    UNIQUE(l_id),
	FULLTEXT KEY (l_brief,l_details,l_ip_address,ad_username)
    ) ENGINE=InnoDB";
@$conn->exec($sql);

//CREATE SOCIAL MEDIA TABLE
$sql = "CREATE TABLE IF NOT EXISTS social_handle_table(
    s_id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    s_name VARCHAR(50) NOT NULL,
    s_icon VARCHAR(20) NOT NULL,
    s_link VARCHAR(50) NOT NULL,
    s_color VARCHAR(10),
    s_bgcolor VARCHAR(10),
    
    UNIQUE(s_id),
    UNIQUE(s_name),
    UNIQUE(s_link),
    FULLTEXT KEY (s_name)
    ) ENGINE=InnoDB";
@$conn->exec($sql);

//CREATE MESSAGE TABLE
$sql = "CREATE TABLE IF NOT EXISTS message_table(
    m_id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    m_name VARCHAR(50) NOT NULL,
    m_email VARCHAR(50) NOT NULL,
    m_subject VARCHAR(70) NOT NULL,
    m_message TEXT NOT NULL,
    m_status ENUM('new','seen') DEFAULT 'new',
    m_datetime DATETIME DEFAULT NOW(),
    
    UNIQUE(m_id),
    FULLTEXT KEY (m_name,m_email,m_subject,m_message)
    ) ENGINE=InnoDB";
@$conn->exec($sql);

//CREATE DISEASE TABLE
$sql = "CREATE TABLE IF NOT EXISTS disease_table(
    d_id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    d_disease VARCHAR(50) NOT NULL,
    
    UNIQUE(d_id),
    UNIQUE(d_disease),
    FULLTEXT KEY (d_disease)
    ) ENGINE=InnoDB";
@$conn->exec($sql);


// PATIENT
// CREATE PATIENT TABLE
$sql = "CREATE TABLE IF NOT EXISTS patient_table(
    p_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
	p_unique_id VARCHAR(100) NOT NULL,
    p_email VARCHAR(70) NOT NULL,
    p_fullname VARCHAR(30) NOT NULL,
	p_password VARCHAR(200) NOT NULL,
    p_gender ENUM('prefer not to say','male','female'),
	p_country VARCHAR(50),
	p_state VARCHAR(50),
	p_address VARCHAR(200),
	p_phnumber VARCHAR(15),
    p_status ENUM('suspended','active') DEFAULT 'active',
    p_regdatetime DATETIME DEFAULT NOW(),
         
    UNIQUE(p_id),
	UNIQUE(p_unique_id),
    UNIQUE(p_email),
    FULLTEXT KEY (p_unique_id,p_email,p_fullname,p_country,p_state,p_phnumber)
    ) ENGINE=InnoDB";
@$conn->exec($sql);

// CREATE PATIENT MEDIA TABLE
$sql = "CREATE TABLE IF NOT EXISTS patient_media_table(
    pm_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    pm_link_name VARCHAR(100) NOT NULL,
    pm_extension VARCHAR(50) NOT NULL,
    p_id INT(100) NOT NULL,
            
    UNIQUE(pm_id),
    UNIQUE(pm_link_name),
    UNIQUE(p_id),
    FOREIGN KEY (p_id) REFERENCES patient_table(p_id) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB";
@$conn->exec($sql);

// CREATE PATIENT COOKIE DATA TABLE
$sql ="CREATE TABLE IF NOT EXISTS patient_cookie_data_table(
    cd_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    cd_token VARCHAR(70) NOT NULL,
    cd_ipaddress VARCHAR(70) NOT NULL,
    cd_login_time DATETIME DEFAULT NOW(),
    cd_expiretime VARCHAR(70) NOT NULL,
    p_id INT(100) NOT NULL,
    
    UNIQUE(cd_id),
    FOREIGN KEY (p_id) REFERENCES patient_table(p_id) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB";
@$conn->exec($sql);

// CREATE PATIENT HEALTH TABLE
$sql = "CREATE TABLE IF NOT EXISTS patient_health_table(
    ph_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
	ph_illness VARCHAR(50) NOT NULL,
	ph_stage ENUM('none','early','mild','late') NOT NULL,
	ph_note VARCHAR(100),
	p_id INT(100) NOT NULL,
    
    UNIQUE(ph_id),
	FOREIGN KEY (p_id) REFERENCES patient_table(p_id) ON UPDATE CASCADE ON DELETE CASCADE
    ) ENGINE=InnoDB";
@$conn->exec($sql);

// CREATE PATIENT MEDICATION DATA TABLE
$sql = "CREATE TABLE IF NOT EXISTS patient_medication_table(
    pmd_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
	pmd_name VARCHAR(70) NOT NULL,
	pmd_duration VARCHAR(5) NOT NULL,
	pmd_dosage_interval VARCHAR(3) NOT NULL,
	pmd_first_intake_time DATETIME NOT NULL,
	pmd_regdatetime DATETIME DEFAULT NOW(),
	ph_id INT(100) NOT NULL,
	p_id INT(100) NOT NULL,
         
    UNIQUE(pmd_id),
	FOREIGN KEY (ph_id) REFERENCES patient_health_table(ph_id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (p_id) REFERENCES patient_table(p_id) ON UPDATE CASCADE ON DELETE CASCADE
    ) ENGINE=InnoDB";
@$conn->exec($sql);

// CREATE PATIENT ADHERENCE DATA TABLE
$sql = "CREATE TABLE IF NOT EXISTS patient_adherence_table(
    pma_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
	pma_status ENUM('pending','notified','taken','missed') DEFAULT 'pending',
	pma_datetime DATETIME NOT NULL,
	pmd_id INT(100) NOT NULL,
	ph_id INT(100) NOT NULL,
	p_id INT(100) NOT NULL,
         
    UNIQUE(pma_id),
	FOREIGN KEY (pmd_id) REFERENCES patient_medication_table(pmd_id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (ph_id) REFERENCES patient_health_table(ph_id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (p_id) REFERENCES patient_table(p_id) ON UPDATE CASCADE ON DELETE CASCADE
    ) ENGINE=InnoDB";
@$conn->exec($sql);


//DOCTOR
// CREATE DOCTOR TABLE
$sql = "CREATE TABLE IF NOT EXISTS doctor_table(
    d_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    d_email VARCHAR(70) NOT NULL,
    d_fullname VARCHAR(30) NOT NULL,
	d_password VARCHAR(200) NOT NULL,
	d_reg_id VARCHAR(30) NOT NULL,
	d_profession VARCHAR(30),
	d_specialization_keyword VARCHAR(100),
	d_details VARCHAR(200),
    d_gender ENUM('prefer not to say','male','female'),
	d_country VARCHAR(50),
	d_state VARCHAR(50),
	d_phnumber VARCHAR(15),
    d_status ENUM('pending','active','suspended') DEFAULT 'pending',
    d_regdatetime DATETIME DEFAULT NOW(),
	ad_validate_by INT(100),
         
    UNIQUE(d_id),
	UNIQUE(d_reg_id),
    UNIQUE(d_email),
	UNIQUE(d_phnumber),
    FULLTEXT KEY (d_email,d_fullname,d_country,d_state,d_profession,d_specialization_keyword,d_details)
    ) ENGINE=InnoDB";
@$conn->exec($sql);

// CREATE DOCTOR MEDIA TABLE
$sql = "CREATE TABLE IF NOT EXISTS doctor_media_table(
    dm_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    dm_link_name VARCHAR(100) NOT NULL,
    dm_extension VARCHAR(50) NOT NULL,
    d_id INT(100) NOT NULL,
            
    UNIQUE(dm_id),
    UNIQUE(dm_link_name),
    UNIQUE(d_id),
    FOREIGN KEY (d_id) REFERENCES doctor_table(d_id) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB";
@$conn->exec($sql);

// CREATE DOCTOR COOKIE DATA TABLE
$sql ="CREATE TABLE IF NOT EXISTS doctor_cookie_data_table(
    cd_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    cd_token VARCHAR(70) NOT NULL,
    cd_ipaddress VARCHAR(70) NOT NULL,
    cd_login_time DATETIME DEFAULT NOW(),
    cd_expiretime VARCHAR(70) NOT NULL,
    d_id INT(100) NOT NULL,
    
    UNIQUE(cd_id),
    FOREIGN KEY (d_id) REFERENCES doctor_table(d_id) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB";
@$conn->exec($sql);


//MISC
// CREATE GUIDANCE REQUEST DATA TABLE
$sql = "CREATE TABLE IF NOT EXISTS guidance_request_table(
    gr_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
	gr_status ENUM('pending','accepted') DEFAULT 'pending',
	gr_regdatetime DATETIME DEFAULT NOW(),
	ph_id INT(100) NOT NULL,
	p_id INT(100) NOT NULL,
	d_id INT(100) NOT NULL,
         
    UNIQUE(gr_id),
	FOREIGN KEY (ph_id) REFERENCES patient_health_table(ph_id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (p_id) REFERENCES patient_table(p_id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (d_id) REFERENCES doctor_table(d_id) ON UPDATE CASCADE ON DELETE CASCADE
    ) ENGINE=InnoDB";
@$conn->exec($sql);
?>