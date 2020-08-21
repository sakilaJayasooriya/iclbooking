<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Common;
use App\Http\Requests;
use App\Models\Accounts;
use App\Models\Admin;
use App\Models\Bookings;
use App\Models\Currency;
use App\Models\EmailTemplate;
use App\Models\PasswordResets;
use App\Models\Payouts;
use App\Models\Rooms;
use App\Models\Settings;
use App\Models\User;
use Session;
use Auth;
use Config;
use DB;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Mail;
use PHPMailer\PHPMailer\PHPMailer;

class EmailController extends Controller
{
    private $helper;

    public function __construct(){
      $this->helper = new Common;
    }

   public function welcome_email($user)
    {
        //New Code starts here 
        $emailSettings               = Settings::where('type','email')->get()->toArray();
        $emailConfig                 = $this->helper->key_value('name','value',$emailSettings);
        $adminDetails                = Admin::where('status','active')->first();
        $emailConfig['email_address']= $adminDetails->email;
        $emailConfig['username']     = $adminDetails->username;
        //New Code Ends here
        $token                       = $this->helper->randomCode(100);
        $password_resets             = new PasswordResets;
        $password_resets->email      = $user->email;
        $password_resets->token      = $token;
        $password_resets->created_at = date('Y-m-d H:i:s');
        $password_resets->save();

        $data['first_name'] = $user->first_name;
        $data['email']      = $user->email;
        $data['token']      = $token;
        $data['type']       = 'register';
        $data['url']        = url('/').'/';

        //$data['subject']    = "Please confirm your e-mail address";
        //$data['view']       = resource_path('views/sendmail/email_confirm.blade.php');
        $data['view']       = resource_path('views/sendmail/email_confirm.blade.php');

        $data['link']       = $data['url'].'users/confirm_email?code='.$data['token'];
        $data['link_text']   = trans('messages.email_template.confirm_email');
        $data['user_name']    = '';

        //Email Template Starts
        //if other language's subject and body not set, get en sub and body for mail
        $englishTemplate = EmailTemplate::where(['temp_id' => 5, 'lang_id' => '1', 'type' => 'email'])->select('subject', 'body')->first();

        $emailTemplatefromDB = EmailTemplate::where([['temp_id',5],['lang', session()->get('language')],['type','email']])->first();
        if (!empty($emailTemplatefromDB->subject) && !empty($emailTemplatefromDB->body))
        {
            $subject_string = $emailTemplatefromDB->subject;
            $body_string    = $emailTemplatefromDB->body;
        }
        else
        {
            $subject_string = $englishTemplate->subject;
            $body_string    = $englishTemplate->body;
        }
       
        $body_string     = str_replace('{first_name}', $user->first_name,$body_string);
        $body_string     = str_replace('{site_name}', SITE_NAME,$body_string);
        
        
        $data['subject']        =   $subject = $subject_string;
        $data['content']        =   $content = $body_string;
        $data['message_body']   =   $content;
        

        //Email Template Ends

        if(env('APP_MODE', '') != 'test'){
            if($emailConfig['driver']=='smtp' && $emailConfig['email_status']==1){
            
                @Mail::send('emails.email_confirm_template', $data, function($message) use($data,$subject,$content) {
                    $message->to($data['email'], $data['first_name'])->subject($subject)->content($content);
                });
            }else if($emailConfig['driver']=='sendmail'){
                $this->sendPhpEmail($data,$emailConfig);
            }
        }
        return true;
    }

   
    public function forgot_password($user)
    {
        
        $emailSettings   = Settings::where('type','email')->get()->toArray();
        $emailConfig     = $this->helper->key_value('name','value',$emailSettings);
        $adminDetails    = Admin::where('status','active')->first();
        $emailConfig['email_address']= $adminDetails->email;
        $emailConfig['username']     = $adminDetails->username;
        $token = $this->helper->randomCode(100);
        $exist = PasswordResets::where('token', $token)->count();
        while ($exist) {
            $token = $this->helper->randomCode(100);
            $exist = PasswordResets::where('token', $token)->count();
        }

        $password_resets = new PasswordResets;
        $password_resets->email      = $user->email;
        $password_resets->token      = $token;
        $password_resets->created_at = date('Y-m-d H:i:s');
        $password_resets->save();

        $data['first_name'] = $user->first_name;
        $data['email']      = $user->email;
        $data['token']      = $token;
        $data['url']        = url('/').'/';
        $data['view']       = resource_path('views/sendmail/forget_password.blade.php');
        $data['subject']    = "Reset your Password";
        $data['link']       = $data['url'].'users/reset_password?secret='.$token;
        $data['link_text']       = trans('messages.email_template.reset_password');

        //Email Template Starts
        //if other language's subject and body not set, get en sub and body for mail
        $englishTemplate = EmailTemplate::where(['temp_id' => 6, 'lang_id' => '1', 'type' => 'email'])->select('subject', 'body')->first();

        $emailTemplatefromDB = EmailTemplate::where([['temp_id',6],['lang', session()->get('language')],['type','email']])->first();
        if (!empty($emailTemplatefromDB->subject) && !empty($emailTemplatefromDB->body))
        {
            $subject_string = $emailTemplatefromDB->subject;
            $body_string    = $emailTemplatefromDB->body;
        }
        else
        {
            $subject_string = $englishTemplate->subject;
            $body_string    = $englishTemplate->body;
        }
        
        $body_string = str_replace('{first_name}', $user->first_name,$body_string);

        $data['subject']    =   $subject = $subject_string;
        $data['content']    =   $content = $body_string;
        //Email Template Ends

        $data['message_body'] = $content;
        $data['user_name']    = '';
        if(env('APP_MODE', '') != 'test'){
                    
        if($emailConfig['driver']=='smtp' && $emailConfig['email_status']==1){

             
             @Mail::send('emails.forgot_password_template', $data, function($message) use($user,$data,$subject,$content) {
                $message->to($user->email, $user->first_name)->subject($subject)->content($content);
            });
         }else if($emailConfig['driver']=='sendmail'){
            
             $this->sendPhpEmail($data,$emailConfig);
         } 
        }
        return true;
    }
    //Email Should be unchangeable so this function is redundant
    public function change_email_confirmation($user)
    {

        $emailSettings   = Settings::where('type','email')->get()->toArray();
        $emailConfig     = $this->helper->key_value('name','value',$emailSettings);
        $adminDetails    = Admin::where('status','active')->first();
        $emailConfig['email_address']= $adminDetails->email;
        $emailConfig['username']     = $adminDetails->username;
        $token = $this->helper->randomCode(100);

        $password_resets = new PasswordResets;
        $password_resets->email      = $user->email;
        $password_resets->token      = $token;
        $password_resets->created_at = date('Y-m-d H:i:s');
        $password_resets->save();

        $data['first_name']  = $user->first_name;
        $data['email']       = $user->email;
        $data['token']       = $token;
        $data['type']        = 'change';
        $data['url']         = url('/').'/';

        $data['subject']     = "Please confirm your e-mail address";
        $data['view']        = resource_path('views/sendmail/email_confirm.blade.php');
        $data['link']        = $data['url'].'users/confirm_email?code='.$data['token'];
        $data['link_text']   = trans('messages.email_template.confirm_email');
        // $data['message_body'] ="";
        // $data['user_name']    = '';
        //Email Template Starts
        //if other language's subject and body not set, get en sub and body for mail
        $englishTemplate = EmailTemplate::where(['temp_id' => 5, 'lang_id' => '1', 'type' => 'email'])->select('subject', 'body')->first();

        $emailTemplatefromDB = EmailTemplate::where([['temp_id',5],['lang', session()->get('language')],['type','email']])->first();
        if (!empty($emailTemplatefromDB->subject) && !empty($emailTemplatefromDB->body))
        {
            $subject_string = $emailTemplatefromDB->subject;
            $body_string    = $emailTemplatefromDB->body;
        }
        else
        {
            $subject_string = $englishTemplate->subject;
            $body_string    = $englishTemplate->body;
        }
       
        $body_string     = str_replace('{first_name}', $user->first_name,$body_string);
        $body_string     = str_replace('{site_name}', SITE_NAME,$body_string);
        
        
        $data['subject']        =   $subject = $subject_string;
        $data['content']        =   $content = $body_string;
        $data['message_body']   =   $content;
        

        //Email Template Ends

        if(env('APP_MODE', '') != 'test'){
            if($emailConfig['driver']=='smtp' && $emailConfig['email_status']==1){
                @Mail::send('emails.email_confirm', $data, function($message) use($user) {
                $message->to($user->email, $user->first_name)->subject('Please confirm your e-mail address');
            });
            }
            else if($emailConfig['driver']=='sendmail'){
              $this->sendPhpEmail($data,$emailConfig);
            }
            
        }
        return true;
    }

    //Email Should be unchangeable so this function is redundant
    public function new_email_confirmation($user)
    {

        $emailSettings   = Settings::where('type','email')->get()->toArray();
        $emailConfig     = $this->helper->key_value('name','value',$emailSettings);
        $adminDetails    = Admin::where('status','active')->first();
        $emailConfig['email_address']= $adminDetails->email;
        $emailConfig['username']     = $adminDetails->username;
        $token = $this->helper->randomCode(100);

        $password_resets = new PasswordResets;
        $password_resets->email      = $user->email;
        $password_resets->token      = $token;
        $password_resets->created_at = date('Y-m-d H:i:s');
        $password_resets->save();

        $data['first_name']   = $user->first_name;
        $data['email']        = $user->email;
        $data['token']        = $token;
        $data['type']         = 'new_confirm';
        $data['url']          = url('/').'/';

        $data['subject']      = "Please confirm your e-mail address";
        $data['view']         = resource_path('views/sendmail/email_confirm.blade.php');
        $data['link']         = $data['url'].'users/confirm_email?code='.$data['token'];
        $data['link_text']    = trans('messages.email_template.confirm_email');

        // $data['message_body'] = '';
        // $data['user_name']    = '';
        //Email Template Starts
        //if other language's subject and body not set, get en sub and body for mail
        $englishTemplate = EmailTemplate::where(['temp_id' => 5, 'lang_id' => '1', 'type' => 'email'])->select('subject', 'body')->first();

        $emailTemplatefromDB = EmailTemplate::where([['temp_id',5],['lang', session()->get('language')],['type','email']])->first();
        if (!empty($emailTemplatefromDB->subject) && !empty($emailTemplatefromDB->body))
        {
            $subject_string = $emailTemplatefromDB->subject;
            $body_string    = $emailTemplatefromDB->body;
        }
        else
        {
            $subject_string = $englishTemplate->subject;
            $body_string    = $englishTemplate->body;
        }
       
        $body_string     = str_replace('{first_name}', $user->first_name,$body_string);
        $body_string     = str_replace('{site_name}', SITE_NAME,$body_string);
        
        
        $data['subject']        =   $subject = $subject_string;
        $data['content']        =   $content = $body_string;
        $data['message_body']   =   $content;
        

        //Email Template Ends
        
        if(env('APP_MODE', '') != 'test'){
             if($emailConfig['driver']=='smtp' && $emailConfig['email_status']==1){
                @Mail::send('emails.email_confirm', $data, function($message) use($user) {
                $message->to($user->email, $user->first_name)->subject('Please confirm your e-mail address');
            });
            }else if($emailConfig['driver']=='sendmail'){
              $this->sendPhpEmail($data,$emailConfig);
            }
        }

        return true;
    }

   public function account_preferences($account_id, $type = 'update', $updateTime )
    {
        $emailSettings   = Settings::where('type', 'email')->get()->toArray();
        $emailConfig     = $this->helper->key_value('name', 'value', $emailSettings);
        $adminDetails    = Admin::where('status', 'active')->first();
        $emailConfig['email_address']= $adminDetails->email;
        $emailConfig['username']     = $adminDetails->username;
        if ($type != 'delete') {
            $result               = Accounts::find($account_id);
            $user                 = $result->users;
            $data['first_name']   = $user->first_name;
            $data['email']        = $user->email;
            $data['updated_time'] = $result->updated_at_time;
            $data['updated_date'] = $result->updated_at_date;
        } else {
            $user = Auth::user();
            $data['first_name'] = $user->first_name;
            $data['email']      = $user->email;
            $now_dt = new DateTime(date('Y-m-d H:i:s'));
            $data['deleted_time'] = $now_dt->format('d M').' at '.$now_dt->format('H:i');
        }

        $data['type']      = $type;
        $data['url']       = url('/').'/';
        $data['view']      = resource_path('views/sendmail/account_preferences.blade.php');
        $data['link']      = $data['url'].'users/account-preferences';

        if ($type == 'update') {
            //if other language's subject and body not set, get en sub and body for mail
            $englishTemplate = EmailTemplate::where(['temp_id' => 2, 'lang_id' => '1', 'type' => 'email'])->select('subject', 'body')->first();

            $emailTemplatefromDB = EmailTemplate::where([['temp_id',2],['lang', session()->get('language')],['type','email']])->first();
            if (!empty($emailTemplatefromDB->subject) && !empty($emailTemplatefromDB->body)) {
                $subjectFromDB = $emailTemplatefromDB->subject;
                $bodyFromDB    = $emailTemplatefromDB->body;
            } else {
                $subjectFromDB = $englishTemplate->subject;
                $bodyFromDB    = $englishTemplate->body;
            }
            
            $subjectFromDB  = str_replace('{site_name}', SITE_NAME, $subjectFromDB);
            $bodyFromDB     = str_replace('{first_name}', $user->first_name, $bodyFromDB);
            $bodyFromDB     = str_replace('{site_name}', SITE_NAME, $bodyFromDB);
            $bodyFromDB     = str_replace('{date_time}', $updateTime, $bodyFromDB);

            $data['subject'] = $subject = $subjectFromDB;
            $data['content'] = $content = $bodyFromDB;
            $data['message_body'] = $bodyFromDB;

          
        } elseif ($type == 'delete') {
            $englishTemplate = EmailTemplate::where(['temp_id' => 3, 'lang_id' => '1', 'type' => 'email'])->select('subject', 'body')->first();

            $emailTemplatefromDB = EmailTemplate::where([['temp_id',3],['lang', session()->get('language')],['type','email']])->first();
            if (!empty($emailTemplatefromDB->subject) && !empty($emailTemplatefromDB->body)) {
                $subjectFromDB = $emailTemplatefromDB->subject;
                $bodyFromDB    = $emailTemplatefromDB->body;
            } else {
                $subjectFromDB = $englishTemplate->subject;
                $bodyFromDB    = $englishTemplate->body;
            }
            
            $subjectFromDB  = str_replace('{site_name}', SITE_NAME, $subjectFromDB);
            $bodyFromDB     = str_replace('{first_name}', $user->first_name, $bodyFromDB);
            $bodyFromDB     = str_replace('{site_name}', SITE_NAME, $bodyFromDB);
            $bodyFromDB     = str_replace('{date_time}', $updateTime, $bodyFromDB);

            $data['subject'] = $subject = $subjectFromDB;
            $data['content'] = $content = $bodyFromDB;
            $data['message_body'] = $bodyFromDB;

          
        } elseif ($type == 'default_update') {
         
            $englishTemplate = EmailTemplate::where(['temp_id' => 1, 'lang_id' => '1', 'type' => 'email'])->select('subject', 'body')->first();

            $emailTemplatefromDB = EmailTemplate::where([['temp_id',1],['lang', session()->get('language')],['type','email']])->first();
            if (!empty($emailTemplatefromDB->subject) && !empty($emailTemplatefromDB->body)) {
                $subjectFromDB = $emailTemplatefromDB->subject;
                $bodyFromDB    = $emailTemplatefromDB->body;
            } else {
                $subjectFromDB = $englishTemplate->subject;
                $bodyFromDB    = $englishTemplate->body;
            }

            $subjectFromDB  = str_replace('{site_name}', SITE_NAME, $subjectFromDB);
            $bodyFromDB     = str_replace('{site_name}', SITE_NAME, $bodyFromDB);
            $bodyFromDB     = str_replace('{first_name}', $user->first_name, $bodyFromDB);
            $bodyFromDB     = str_replace('{date_time}', $updateTime, $bodyFromDB);


            $data['subject'] = $subject = $subjectFromDB;
            $data['content'] = $content = $bodyFromDB;
            $data['message_body'] = $bodyFromDB;
        }

         $data['user_name']    = '';
        
        if (env('APP_MODE', '') != 'test') {
            if ($emailConfig['driver']=='smtp' && $emailConfig['email_status']==1) {
                @Mail::send('emails.account_preferences_template', $data, function ($message) use ($user, $data, $subject, $content) {
                    $message->to($user->email, $user->first_name)->subject($subject)->content($content);
                });
            } elseif ($emailConfig['driver']=='sendmail') {
                $this->sendPhpEmail($data, $emailConfig);
            }
        }
        return true;
    }

    public function booking($booking_id, $checkinDate)
    {

        $emailSettings   = Settings::where('type', 'email')->get()->toArray();
        $emailConfig     = $this->helper->key_value('name', 'value', $emailSettings);
        $adminDetails    = Admin::where('status', 'active')->first();
        $emailConfig['email_address']= $adminDetails->email;
        $emailConfig['username']     = $adminDetails->username;
        $booking         = Bookings::find($booking_id);
        $user            = $booking->host;
        $data['url']     = url('/').'/';
        $data['result']  = Bookings::where('bookings.id', $booking_id)->with(['users', 'properties', 'host', 'currency', 'messages'])->first()->toArray();
        $data['url']        = url('/').'/';
        $data['view']       = resource_path('views/sendmail/booking.blade.php');
        $data['link']       = $data['url'].'booking/'.$data['result']['id'];
        $data['user_name']  = $data['result']['users']['first_name'];
        $data['first_name'] = $data['result']['host']['first_name'];
        $data['email']      = $user->email;
        $total_night = $data['result']['total_night']>1?"nights":"night";
        $data["total_night"]=$data['result']['total_night'].' '.$total_night;

        $guest = $data['result']['guest']>1?"guests":"guest";
        $data["total_guest"]=$data['result']['guest'].' '.$guest;


        $englishTemplate = EmailTemplate::where(['temp_id' => 4, 'lang_id' => '1', 'type' => 'email'])->select('subject', 'body')->first();

        //As this mail will be sent to admin check admin's default language
        $emailTemplatefromDB = EmailTemplate::where([['temp_id',4],['lang', session()->get('language')],['type','email']])->first();
        if (!empty($emailTemplatefromDB->subject) && !empty($emailTemplatefromDB->body)) {
            $subjectFromDB = $emailTemplatefromDB->subject;
            $bodyFromDB    = $emailTemplatefromDB->body;
        } else {
            $subjectFromDB = $englishTemplate->subject;
            $bodyFromDB    = $englishTemplate->body;
        }
        $subjectFromDB  = str_replace('{property_name}', $data['result']['properties']['name'], $subjectFromDB);
        $bodyFromDB     = str_replace('{owner_first_name}', $user->first_name, $bodyFromDB);
        $bodyFromDB     = str_replace('{user_first_name}', $data['result']['users']['first_name'], $bodyFromDB);
        $bodyFromDB     = str_replace('{total_night}', $data['result']['total_night'], $bodyFromDB);
        if ($data['result']['total_night']>1) {
            $myStr = 'nights';
        }
        if ($data['result']['total_night']=1) {
            $myStr = 'night';
        }
        $bodyFromDB     = str_replace('{night/nights}', $myStr, $bodyFromDB);
        $bodyFromDB     = str_replace('{property_name}', $data['result']['properties']['name'], $bodyFromDB);
        $bodyFromDB     = str_replace('{messages_message}', $data['result']['messages'][0]['message'], $bodyFromDB);
        $bodyFromDB     = str_replace('{total_guest}', $data['result']['guest'], $bodyFromDB);
        $bodyFromDB     = str_replace('{start_date}', $checkinDate, $bodyFromDB);

        $data['subject'] = $subject = $subjectFromDB;
        $data['content'] = $content = $bodyFromDB;
        $data['message_body'] = $content;

        if (env('APP_MODE', '') != 'test') {
            if ($emailConfig['driver']=='smtp' && $emailConfig['email_status']==1) {
                    @Mail::send('emails.booking_template', $data, function ($message) use ($user, $data, $subject, $content) {
                        $message->to($user->email, $user->first_name)->subject($subject)->content($content);
                    });
            } elseif ($emailConfig['driver']=='sendmail') {
                $this->sendPhpEmail($data, $emailConfig);
            }
        }
        return true;
    }



    public function need_pay_account($booking_id, $type)
    {
        $emailSettings   = Settings::where('type','email')->get()->toArray();
        $emailConfig     = $this->helper->key_value('name','value',$emailSettings);
        $adminDetails                = Admin::where('status','active')->first();
        $emailConfig['email_address']= $adminDetails->email;
        $emailConfig['username']     = $adminDetails->username;
        $result       = Bookings::find($booking_id);
        $data['type'] = $type;
        
        if($type == 'guest') {
            $user                  = $result->users;
            $data['email']         = $user->email;
            $data['payout_amount'] = $result->original_admin_guest_payment;
        }
        else {
            $user                  = $result->host;
            $data['email']         = $user->email;
            $data['payout_amount'] = $result->original_admin_host_payment;
        }

        $data['currency_symbol'] = $result->currency->org_symbol;
        $data['first_name']      = $user->first_name;
        $data['user_id']         = $user->id;
        $data['url'] = url('/').'/';

        //$data['subject']    = "Please set a payment account";
        $data['link']       = $data['url'].'users/account_preferences';
        $data['link_text']  = trans('messages.email_template.add_payment_method');

        $data['view']       = resource_path('views/sendmail/need_pay_account.blade.php');
        
        /*$data['message_body']= "Amount ".$data['currency_symbol']." ".$data['payout_amount']." is waiting for you but you did not add any payment account to send the money. Please log in to your ".SITE_NAME." account and";
        $data['user_name']    = '';*/

        //New By Arif (04/02/2019) Starts
        //if other language's subject and body not set, get en sub and body for mail
        $englishTemplate = EmailTemplate::where(['temp_id' => 7, 'lang_id' => '1', 'type' => 'email'])->select('subject', 'body')->first();

        $emailTemplatefromDB = EmailTemplate::where([['temp_id',7],['lang_id', $this->getDefaultLanguage()],['type','email']])->first();
        if (!empty($emailTemplatefromDB->subject) && !empty($emailTemplatefromDB->body))
        {
            $subjectFromDB = $emailTemplatefromDB->subject;
            $bodyFromDB    = $emailTemplatefromDB->body;
        }
        else
        {
            $subjectFromDB = $englishTemplate->subject;
            $bodyFromDB    = $englishTemplate->body;

        }
        $bodyFromDB     = str_replace('{first_name}', $data['first_name'],$bodyFromDB);
        $bodyFromDB     = str_replace('{site_name}', SITE_NAME,$bodyFromDB);
        $bodyFromDB     = str_replace('{currency_symbol}', $data['currency_symbol'], $bodyFromDB);
        $bodyFromDB     = str_replace('{payout_amount}', $data['payout_amount'], $bodyFromDB);

        $data['subject'] = $subject = $subjectFromDB;
        $data['content'] = $content = $bodyFromDB;
        $data['message_body'] = $content;
        

        //Ends

        if(env('APP_MODE', '') != 'test'){
            if($emailConfig['driver']=='smtp' && $emailConfig['email_status']==1){
            @Mail::send('emails.need_pay_account_template', $data, function($message) use($user, $data,$subject,$content) {
                $message->to($user->email, $user->first_name)->subject($subject)->content($content);
            });
        }else if($emailConfig['driver']=='sendmail'){
              $this->sendPhpEmail($data,$emailConfig);
            }
        }
        return true;
    }

    /* New By Arif (06/03/2019) Starts
    Need to recheck as booking cancel has some issues in frontend */
    public function bookingCancellation($booking_id)
    {
        $emailSettings   = Settings::where('type','email')->get()->toArray();
        $emailConfig     = $this->helper->key_value('name','value',$emailSettings);
        $adminDetails    = Admin::where('status','active')->first();
        $emailConfig['email_address']= $adminDetails->email;
        $emailConfig['username']     = $adminDetails->username;
        $booking         = Bookings::find($booking_id);
        $user            = $booking->host;
        $data['url']     = url('/').'/';
        $data['result']  = Bookings::where('bookings.id', $booking_id)->with(['users', 'properties', 'host', 'currency', 'messages'])->first()->toArray();
        $data['url']        = url('/').'/';
        $data['view']       = resource_path('views/sendmail/booking_cancel.blade.php');
        $data['link']       = $data['url'].'booking/'.$data['result']['id'];
        $data['user_name']  = $data['result']['users']['first_name'];
        $data['first_name'] = $data['result']['host']['first_name'];
        $data['email']      = $user->email;
        
        //if other language's subject and body not set, get en sub and body for mail
        $englishTemplate = EmailTemplate::where(['temp_id' => 9, 'lang_id' => '1', 'type' => 'email'])->select('subject', 'body')->first();

        $emailTemplatefromDB = EmailTemplate::where([['temp_id',9],['lang_id', $this->getDefaultLanguage()],['type','email']])->first();
        if (!empty($emailTemplatefromDB->subject) && !empty($emailTemplatefromDB->body))
        {
            $subjectFromDB = $emailTemplatefromDB->subject;
            $bodyFromDB    = $emailTemplatefromDB->body;
        }
        else
        {
            $subjectFromDB = $englishTemplate->subject;
            $bodyFromDB    = $englishTemplate->body;
        }
        
        $subjectFromDB  = str_replace('{property_name}', $data['result']['properties']['name'],$subjectFromDB);
        $bodyFromDB     = str_replace('{owner_first_name}', $user->first_name,$bodyFromDB);
        $bodyFromDB     = str_replace('{user_first_name}', $data['user_name'],$bodyFromDB);
        $bodyFromDB     = str_replace('{property_name}',$data['result']['properties']['name'],$bodyFromDB);
        $data['subject'] = $subject = $subjectFromDB;
        $data['content'] = $content = $bodyFromDB;
        $data['message_body'] = $content;
       
        if(env('APP_MODE', '') != 'test'){
            if($emailConfig['driver']=='smtp' && $emailConfig['email_status']==1){
                    @Mail::send('emails.booking_cancel_template', $data, function($message) use($user, $data,$subject,$content) {
                    $message->to($user->email, $user->first_name)->subject($subject)->content($content);
            });
            }
            else if($emailConfig['driver']=='sendmail'){
              $this->sendPhpEmail($data,$emailConfig);
            }
            
        }
        return true;
    }


    // New By Kalam (21/04/2019) Booking accepted/declined by host. Send to guest
    public function bookingAcceptedOrDeclined($booking_id, $status)
    {
        $emailSettings   = Settings::where('type','email')->get()->toArray();
        $emailConfig     = $this->helper->key_value('name','value',$emailSettings);
        $adminDetails    = Admin::where('status','active')->first();
        $emailConfig['email_address']= $adminDetails->email;
        $emailConfig['username']     = $adminDetails->username;
        $booking         = Bookings::find($booking_id);
        $user            = $booking->users;
        $data['url']     = url('/').'/';
        $data['result']  = Bookings::where('bookings.id', $booking_id)->with(['users', 'properties', 'host', 'currency', 'messages'])->first()->toArray();
        $data['url']        = url('/').'/';
        $data['view']       = resource_path('views/sendmail/booking_accept_decline.blade.php');
        $data['link']       = $data['url'].'booking/'.$data['result']['id'];
        $data['user_name']  = $data['result']['users']['first_name'];
        $data['first_name'] = $data['result']['host']['first_name'];
        $data['email']      = $user->email;
        
        //if other language's subject and body not set, get en sub and body for mail
        $englishTemplate = EmailTemplate::where(['temp_id' => 10, 'lang_id' => '1', 'type' => 'email'])->select('subject', 'body')->first();
        $emailTemplatefromDB = EmailTemplate::where([['temp_id',10],['lang_id', $this->getDefaultLanguage()],['type','email']])->first();

        if (!empty($emailTemplatefromDB->subject) && !empty($emailTemplatefromDB->body))
        {
            $subjectFromDB = $emailTemplatefromDB->subject;
            $bodyFromDB    = $emailTemplatefromDB->body;
        }
        else
        {
            $subjectFromDB = $englishTemplate->subject;
            $bodyFromDB    = $englishTemplate->body;
        }

        if ($status == 'Accepted') {
            $subjectFromDB  = str_replace('{Accepted/Declined}', 'Accepted', $subjectFromDB); 
            $bodyFromDB     = str_replace('{guest_first_name}', $user->first_name,$bodyFromDB);
            $bodyFromDB     = str_replace('{host_first_name}', $data['first_name'],$bodyFromDB);
            $bodyFromDB     = str_replace('{Accepted/Declined}', 'Accepted', $bodyFromDB);
            $bodyFromDB     = str_replace('{property_name}',$data['result']['properties']['name'],$bodyFromDB);

        }elseif($status == 'Declined'){
            $subjectFromDB  = str_replace('{Accepted/Declined}', 'Declined', $subjectFromDB); 
            $bodyFromDB     = str_replace('{guest_first_name}', $user->first_name,$bodyFromDB);
            $bodyFromDB     = str_replace('{host_first_name}', $data['first_name'],$bodyFromDB);
            $bodyFromDB     = str_replace('{Accepted/Declined}', 'Declined', $bodyFromDB);
            $bodyFromDB     = str_replace('{property_name}',$data['result']['properties']['name'],$bodyFromDB);
        }

        $data['subject'] = $subject = $subjectFromDB;
        $data['content'] = $content = $bodyFromDB;
        $data['message_body'] = $content;
    
        if(env('APP_MODE', '') != 'test'){
            if($emailConfig['driver']=='smtp' && $emailConfig['email_status']==1){
                @Mail::send('emails.booking_cancel_template', $data, function($message) use($user, $data,$subject,$content) {
                $message->to($user->email, $user->first_name)->subject($subject)->content($content);
            });
            }
            else if($emailConfig['driver']=='sendmail'){
              $this->sendPhpEmail($data,$emailConfig);
            }            
        }
        return true;
    }

    public function payout_sent($booking_id)
    {
        $emailSettings   = Settings::where('type','email')->get()->toArray();
        $emailConfig     = $this->helper->key_value('name','value',$emailSettings);
        $adminDetails                = Admin::where('status','active')->first();
        $emailConfig['email_address']= $adminDetails->email;
        $emailConfig['username']     = $adminDetails->username;
        $result       = Bookings::find($booking_id);

        if($result->status=="Cancelled" || $result->status=="Declined" || $result->status=="Expired")
        {
            $user        = $result->users;
            $amount      = $result->original_guest_payout;            
        } else {
            $user        = $result->host;
            $amount      = $result->original_host_payout;
        }
        $data['email']           = $user->email;

        $payout_payment_methods          = $result->payment_methods;
        $data['payout_payment_method']   = $payout_payment_methods->name;
        $data['payout_amount']           = $amount;
        $data['currency_symbol']         = $result->currency->org_symbol;
        $data['first_name']              = $user->first_name;
        $data['user_id']                 = $user->id;
        $data['url']                     = url('/').'/';
        
        $data['link']       = $data['url'].'users/transaction_history';
        $data['link_text']  = trans('messages.email_template.transaction_history');
        $data['view']       = resource_path('views/sendmail/payout_sent.blade.php');
        //if other language's subject and body not set, get en sub and body for mail
        $englishTemplate = EmailTemplate::where(['temp_id' => 8, 'lang_id' => '1', 'type' => 'email'])->select('subject', 'body')->first();

        $emailTemplatefromDB = EmailTemplate::where([['temp_id',8],['lang_id', $this->getDefaultLanguage()],['type','email']])->first();
        if (!empty($emailTemplatefromDB->subject) && !empty($emailTemplatefromDB->body))
        {
            $subjectFromDB = $emailTemplatefromDB->subject;
            $bodyFromDB    = $emailTemplatefromDB->body;

        }
        else
        {
            $subjectFromDB = $englishTemplate->subject;
            $bodyFromDB    = $englishTemplate->body;
        }
        $bodyFromDB     = str_replace('{site_name}', SITE_NAME,$bodyFromDB);
        $bodyFromDB     = str_replace('{first_name}', $data['first_name'], $bodyFromDB);
        $bodyFromDB     = str_replace('{currency_symbol}', $data['currency_symbol'], $bodyFromDB);
        $bodyFromDB     = str_replace('{payout_amount}', $data['payout_amount'], $bodyFromDB);
        $bodyFromDB     = str_replace('{payout_payment_method}', $data['payout_payment_method'], $bodyFromDB);
        
        $data['subject'] = $subject = $subjectFromDB;
        $data['content'] = $content = $bodyFromDB;
        $data['message_body'] = $content;
        
        if(env('APP_MODE', '') != 'test'){
            if($emailConfig['driver']=='smtp' && $emailConfig['email_status']==1){
            @Mail::send('emails.payout_sent_template', $data, function($message) use($user, $data,$subject,$content) {
                $message->to($user->email, $user->first_name)->subject($subject)->content($content);
            });
        }else if($emailConfig['driver']=='sendmail'){
              $this->sendPhpEmail($data,$emailConfig);
            }
        }
        return true;
    } 


    /*public function sendPhpEmail($data,$configEmail)
    {
        require 'vendor/autoload.php';
        $mail            = new PHPMailer(true);
        $mail->SetFrom($configEmail['email_address'], ucfirst($configEmail['username']));
        $mail->AddAddress($data['email'], $data['first_name']);
        $mail->WordWrap  = 50;
        $mail->Subject   = $data['subject'];
        $link            = $data['link'];
        $message         = file_get_contents($data['view']); 
        $message         = str_replace('#site_name#', $configEmail['from_name'], $message); 
        $message         = str_replace('#first_name#', $data['first_name'], $message); 
        $message         = str_replace('#link#', $link, $message); 
        $message         = str_replace('#message_body#',$data['message_body'], $message); 
        $message         = str_replace('#user_name#',$data['user_name'], $message); 
        $mail->MsgHTML($message);
        $mail->IsHTML(true); 
        $mail->CharSet="utf-8";        
        $mail->Send();
    }*/
    


    public function sendPhpEmail($data,$configEmail)
    {
        require 'vendor/autoload.php';
        $mail            = new PHPMailer(true);
        $mail->SetFrom($configEmail['email_address'], SITE_NAME);
        //        $mail->SetFrom($configEmail['email_address'], ucfirst($configEmail['username']));

        $mail->AddAddress($data['email'], $data['first_name']);
        $mail->WordWrap  = 50;
        $mail->Subject   = $data['subject'];
        $link            = @$data['link'];
        $lang            = @$data['link_text'];
        $message         = file_get_contents($data['view']); 
        
        /* some has # and some has {} because {} are from template(DB) and # from hard coded in view file
        first_name & $data['first_name'] represents host first name
        user_first_name $ $data['user_name'] represents user first name */
        $message         = str_replace('#message_body#',$data['message_body'], $message);
        $message         = str_replace('#site_name#', $configEmail['from_name'], $message); 
        $message         = str_replace('{first_name}', $data['first_name'], $message); 
        $message         = str_replace('#lang#', $lang, $message); 
        $message         = str_replace('#link#', $link, $message); 
        // $message         = str_replace('{user_first_name}',$data['user_name'], $message);
        $mail->MsgHTML($message);
        $mail->IsHTML(true); 
        $mail->CharSet="utf-8";        
        $mail->Send();
    }

    public function getDefaultLanguage()
    {
        return Settings::where(['type' => 'general', 'name' => 'default_language'])
                                ->select('value')
                                ->first()
                                ->value;
        
    }

}
