<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class DB{
	private $dbHost     = "localhost";
    private $dbUsername = "virtuizm_onsitebadging";
    private $dbPassword = "Vdo@2021";
    private $dbName     = "virtuizm_onsitebadging";
    
    public function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
    
    public function getCustomerPoints($customerId) {
        $result = $this->db->query("select id, points from registration where id='$customerId'");
		if ($result->num_rows > 0) {
			$data = $result->fetch_assoc();
			return $data['points'];
		}
		return false;
    }
    
    public function getRows($table, $conditions = array()){
        $sql = 'SELECT ';
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
        $sql .= ' FROM '.$table;
        if(array_key_exists("where",$conditions)){
            $sql .= ' WHERE ';
            $i = 0;
            foreach($conditions['where'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        
        if(array_key_exists("order_by",$conditions)){
            $sql .= ' ORDER BY '.$conditions['order_by']; 
        }else{
            $sql .= ' ORDER BY id asc '; 
        }
        
        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['limit']; 
        }
        //echo $sql;
        $result = $this->db->query($sql);
        
        if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
            switch($conditions['return_type']){
                case 'count':
                    $data = $result->num_rows;
                    break;
                case 'single':
                    $data = $result->fetch_assoc();
                    break;
                default:
                    $data = '';
            }
        }else{
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
            }
        }
        return !empty($data)?$data:false;
    }
    
    public function deleteRecord($tableName, $whereCond, $value) {
        $result = $this->db->query("delete from $tableName where $whereCond='$value'");
		if ($result) {
		    return true;
		}
		return false;
    }
	
	public function getFieldValue($tableName, $fieldName,$whereCond, $value) {
    $result = $this->db->query("select $fieldName from $tableName where $whereCond='$value'");
		if ($result->num_rows > 0) {
			$data = $result->fetch_assoc();
			return $data[$fieldName];
		}
		return false;
    }
    
    public function getFieldCount($tableName, $fieldName, $value) {
    $result = $this->db->query("select $fieldName from $tableName where $fieldName='$value'");
		if ($result->num_rows > 0) {
			return $result->num_rows;
		}
		return false;
    }
    
    public function getFieldId($tableName, $fieldName, $value) {
    $result = $this->db->query("select id from $tableName where $fieldName='$value'");
		if ($result->num_rows > 0) {
			$data = $result->fetch_assoc();
			return $data['id'];
		}
    }
    
    public function genAppId() {
        $qry = "SELECT uid FROM registration where uid!='Pending Registartion' ORDER by CAST(SUBSTRING(uid,7) AS SIGNED) desc";
        $result = $this->db->query($qry);
        $number = 0;
        if ($result->num_rows > 0) {
        $fetchResults = $result->fetch_assoc();
        $explode = explode('-',$fetchResults['uid']);
        $number = $explode[1];
        }
        $unique_code = str_pad($number+1,3,0, STR_PAD_LEFT);
        return $reg_status='EIAMM-'.$unique_code;
    }
    
    
        public function getAbsNumber() {
        
        $preFix = "ABS";
        $qry = "SELECT abstract_no FROM abstract_submission where abstract_no !='' ORDER by id desc limit 1";
        
        $result = $this->db->query($qry);
        $number = 0;
        if ($result->num_rows > 0) {
        $fetchResults = $result->fetch_assoc();
        $explode = explode($preFix,$fetchResults['abstract_no']);
        $number = $explode[1];
        }
        $unique_code = str_pad($number+1, 3 ,0, STR_PAD_LEFT);
        return $reg_status='ABS'.$unique_code;
    }

    
    public function generateRandomString($length = 6) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return strtoupper($randomString);
	}
	
	
	public function seo_friendly_url($string){
		$string = str_replace(array('[\', \']'), '', $string);
		$string = preg_replace('/\[.*\]/U', '', $string);
		$string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
		$string = htmlentities($string, ENT_COMPAT, 'utf-8');
		$string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
		$string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
		return strtolower(trim($string, '-'));
	}
    
    public function sendMail($subject, $message,$email, $name, $mail_header, $mail_footer, $eventName) {
        $html=$mail_header;
        $html.=$message;
        $html.=$mail_footer;
        $path='phpmailer/vendor/autoload.php';
        require $path;
        
        $mail = new PHPMailer();
        $mail->SMTPDebug = 0;  
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.hostinger.com';
        $mail->Port = '587';
        $mail->Username = 'noreply@virtualcme.live';
        $mail->Password = 'Noreply123!@#';
        $mail->SetFrom('noreply@virtualcme.live', $eventName);
        $mail->Subject =$subject;
        $mail->MsgHTML($html);
        $mail->AddAddress($email, $name);
        $mail->AddBCC('basheeruddin92@gmail.com');
        // $mail->AddBCC('anilkumar365.c@gmail.com');
        $mail->Send();
    }
    
}
$db = new DB();


$connect = new mysqli("localhost","virtuizm_onsitebadging","Vdo@2021","virtuizm_onsitebadging");
//Check connection
if ($connect -> connect_errno) {
  echo "Failed to connect to MySQL: " . $connect -> connect_error;
  exit();
}

$base_url = "https://virtualcme.live/onsite_registration/";
$mail_bg="#f7941d";
$cur_symbol='INR';
$event_name="VDO Technologies";
$event_venue = "Hyderabad";
$event_date = "29th - 31st October 2021";
$bankCahrges = 0.025;
$website_logo = "http://eiammtapc2021.in/cms_admin/assets/images/logo.png";
$banner_image = "http://eiammtapc2021.in/cms_admin/assets/images/logo.png";

date_default_timezone_set('Asia/Kolkata');
$dateTime = date("Y-m-d h:i:s");
ob_start();
session_start();

$loginPoints = 50;
$auditoriumPoints = 250;
$eposterPoints = 25;
$exhibitionBooth = 200;
$photoBooth = 25;

$mail_header="<div style='width:600px;margin:0;text-align:center;background:$mail_bg;color:#000;font-size:14px;padding:30px 30px 20px;font-family:Georgia,Times New Roman,Times,serif'>
<div style='background:#fff;border-bottom:4px solid #000000;border-radius:5px;overflow:hidden'>
<div style='text-align:center;margin:0;padding:0;line-height:0;overflow:hidden'>
	  <img src='$banner_image' width='100%' class='CToWUd'></div>
      <div style=padding:10px;margin:20px;border-radius:5px;border:1px dashed #d6d6d6;text-align:left>
        <font color='#888888'>
          </font><font color='#888888'>
        </font><table width='100%' border='0' cellpadding='10' cellspacing='10' style='border-collapse:collapse;border:0px solid #e4e4e4'>
          <tbody><tr><td style='padding:10px;line-height:31px;text-align: left;'>";
            
            
$mail_footer="<br>
              <br>
              <strong> With Warm Regards</strong><br>
              <strong>Organizing Team </strong><br><font color='#888888'>
              <strong><span class='il'><b>$event_name</b></span></strong><br></font></td></tr></tbody></table><font color='#888888'></font></div><font color='#888888'></font></div><font color='#888888'>
    <a href='$base_url' style='color:#000000;font-size:12px;text-decoration:none;text-align:center;margin:20px auto 0;display:inline-block' target='_blank' >$base_url</a> </font>
	</div>";
?>