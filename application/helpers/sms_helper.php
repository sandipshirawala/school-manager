<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('get_sms'))
{
	function get_sms($template,$student_name = '',$father_name='',$class='') {
                 $msg = $template;
                 if($student_name!='')
                 {
                     $msg = str_replace("%student%", $student_name, $msg);
                 }
                 if($father_name!='')
                 {
                    $msg = str_replace("%father%", $father_name, $msg);
                 }
                 if($class!='')
                 {
                   $msg = str_replace("%class%", $class, $msg);
                 }
		return $msg;
	}
}

if ( ! function_exists('get_students_by_class_id'))
{
     function get_students_by_class_id($class_id,$format='json')
     {
                $CI	= &get_instance();
		$CI->load->database();
                $CI->db->select('student_id as value,name as text');
                $CI->db->from('student');
                $CI->db->where('class_id',$class_id);
                $query = $CI->db->get();
                $students_data = $query->result();
                return json_encode($students_data);

     }
}
if(!function_exists('send_sms'))
{
   function send_sms($to,$msg)
   {
       $url = "https://site2sms.p.mashape.com/index.php?uid=8790074116&pwd=killer1234&phone=%s&msg=%s";
       //$msg = urlencode ( $msg );
       $url = sprintf($url,$to,$msg);
       echo $url;
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch,CURLOPT_HTTPHEADER,array('X-Mashape-Authorization: YEOmdmfwvW4kIbLLCYYCL3BqRSX9inDp'));
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
   }
}


if(! function_exists('send_sms_template'))
{
   function send_sms_template($student_id,$class_id,$msg)
   {
                  $CI	= &get_instance();
		  $CI->load->database();
                  $student_name =  $CI->db->select('name')->from('student')->where('student_id', $student_id)->get()->row()->name;
                  $father_name = $CI->db->select('name')->from('parent')->where('student_id', $student_id)->get()->row()->name;
                  $class_name = $CI->db->select('name')->from('class')->where('class_id', $class_id)->get()->row()->name;
                 if(strpos($msg,'%student%') !== false)
                 {
                     $msg = str_replace("%student%", $student_name, $msg);
                 }
                 if(strpos($msg,'%father%') !== false)
                 {
                    $msg = str_replace("%father%", $father_name, $msg);
                 }
                 if(strpos($msg,'%class%') !== false)
                 {
                   $msg = str_replace("%class%", $class, $msg);
                 }
                 //echo $msg;
                 $to = get_parent_number($student_id);
                 if($to !=NULL && $to != "" )
                 {
                     //echo sprintf("sent to %s successfully message is %s",$to,$msg); 
                 }
                 
                 //print_r(send_sms($to,$msg));
		 return $msg;
   }

}

if(!function_exists('send_sms_to_class')){
    function send_sms_to_class($class_id,$msg){
         $CI	= &get_instance();
   $CI->load->database();
   $students = $CI->db->select('student_id')->from('student')->where('class_id', $class_id)->get()->result();
   foreach($students as $student){
       $to = get_parent_number($student->student_id);
       send_sms_template($student->student_id,$class_id,$msg);
   }
       return 0;
    }
}

if(!function_exists('get_parent_number')){
    function get_parent_number($student_id){
       //$students = $this->db->get
       $CI	= &get_instance();
       $CI->load->database();
       return $CI->db->select('phone')->from('parent')->where('student_id', $student_id)->get()->row()->phone;
    }
}