<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| EMAIL SENDING SETTINGS
| -------------------------------------------------------------------
*/

$config['protocol'] = 'sendmail';  // 'mail', 'sendmail', or 'smtp'
$config['protocol']='smtp';
$config['smtp_host']='ssl://smtp.gmail.com.'; //(SMTP server)
$config['smtp_port']='465'; //(SMTP port)
$config['smtp_timeout']='30';
$config['smtp_user']='dev.emailtest1234@gmail.com'; //(user@gmail.com)
$config['smtp_pass']='testtrident'; // (gmail password)
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";


/* End of file email.php */
/* Location: ./application/config/email.php */