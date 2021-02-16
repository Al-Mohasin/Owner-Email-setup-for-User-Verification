<?php
/*******************************************************************************
             Mailtrap Email setup
-- Fake email verification testing for Developer --
*******************************************************************************/

// create a Mailtrap email account & follow up SMTP setting information

//==============================================================================
// go env file & set like this

APP_URL=  //null

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=          //--given from Mailtrap
MAIL_PASSWORD=          //--given from Mailtrap
MAIL_ENCRYPTION=tls
//MAIL_FROM_ADDRESS=hello@example.com
//MAIL_FROM_NAME="${APP_NAME}"

//==============================================================================
//add this code in User Model
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable     //add here
implements MustVerifyEmail             //add it like this
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    // ...
}

//==============================================================================
//go -- routes/web.php & add this
Auth::routes();                     //replace it
Auth::routes(['verify' => true]);   //paste it

//==============================================================================
//now go all Authenticate controller & add this
$this->middleware('verified');

//like this
public function __construct()
{
    $this->middleware('auth');
    $this->middleware('verified');
}


/*******************************************************************************
Now when register a user OR unverified user try to login user need to verified by Mailtrap email
Now when click forgot password then input email and send a reset link from Mailtrap
***************/

//==========//
