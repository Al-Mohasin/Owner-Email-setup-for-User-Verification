<?php
/*******************************************************************************
Owner Email setup for Registered user Verification & Password reset
*******************************************************************************/

//go Gmail--"manage your google account-> setting.security"--make 2 step verify & create app password
//then use that Password

//==============================================================================
//--go env file & set like this
APP_URL=  //null

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=example_name@gmail.com       //Email Address
MAIL_PASSWORD=                             //Gmail app password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=example_name@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

//==============================================================================
//add this code in "User" Model
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable    //add here
implements MustVerifyEmail            //add it like this
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    // ...
}

//==============================================================================
//go -- "routes/web.php" & add this
Auth::routes();                     //replace (delete) it
Auth::routes(['verify' => true]);   //Set (paste) it

//==============================================================================
//now go all Authenticate controller & add this in "function __construct()"
$this->middleware('verified');

//like this
public function __construct()
{
    $this->middleware('auth');
    $this->middleware('verified');
}


/*******************************************************************************
Now when register a user OR unverified user try to login user need to verified by Gmail
Now  when User click forgot password, then input email and send a reset link from Owner Gmail account
********************************/

//=====  END  =====//
