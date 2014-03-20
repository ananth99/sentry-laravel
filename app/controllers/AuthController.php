<?php

class AuthController extends BaseController {

	/**
	 * Use this controller action to print the authenticated user.
	 * Route is yourappname/auth
	 * @return credentials of the logged in user.
	 */
	public function index()
	{
		if(Sentry::getUser()!=null)
			return Redirect::to('/')->with('message', Sentry::getUser()->first_name.' '.Sentry::getUser()->last_name);
		else{
			return Redirect::to('/')->with('message','No one is logged in.');
		}
	}

	public function postLogin()
    {
        $credentials = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );
        try
		{
	    	$user = Sentry::findUserByLogin(Input::get('email'));
	    	if ($user->isActivated())
	    	{
		    	try 
	        	{
				    $user = Sentry::authenticate($credentials, false);
		            if ($user)
		            {
		          		if(Input::get('remember')=='on'){
		        			Sentry::loginAndRemember($user);  
		          		}
		        		else
		        			Sentry::login($user,false);   
		            }
	        	}
      
				catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
				{
				    return Redirect::to('/')->with('message','Login field is required.');
				}
				catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
				{
				    return Redirect::to('/')->with('message','Password field is required.');
				}
				catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
				{
				    return Redirect::to('/')->with('message','Wrong password, try again.');
				}
				catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
				{
				    return Redirect::to('/')->with('message','User was not found.');
				}
				catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
				{
				    return Redirect::to('/')->with('message','User is not activated.');
				}

				catch(\Exception $e)
		        {
		            return View::make('hello')->withErrors(array('login' => $e->getMessage()));
		        }

		        return Redirect::to('/')->with('message','Login Successful');    
	    	}
	    	else
		    {
		     	return Redirect::to('/')->with('message','Account not activated!');       
		    }
		}	
		
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
    		echo 'User was not found.';
		}
        
    }

   	public function postRegister(){
   		try
		{
		    $user = Sentry::register(array(
		        'first_name' => Input::get('firstname'),
		        'last_name' => Input::get('lastname'),
		        'email'    => Input::get('email'),
		        'password' => Input::get('password'),
		    ));
		    $activationCode = $user->getActivationCode();
		    $data = array(
			    'detail'=>'Account activation mail',
			    'name'  => $user['first_name']." ".$user['last_name'],
			    'activation_code'=>$activationCode,
			    'email'=>$user['email'],
			);

			Mail::send('welcome', $data, function($message) use ($user)
			{
			  $message->from('admin@org.com', 'Organisation');
			  $message->to('ananthmadhavan6@gmail.com', $user['name'])->subject('Welcome!');
			});
			return Redirect::to('/')->with('message', 'Registration successful. Activation email sent to your inbox!');
		    
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    return Redirect::to('/')->with('message', 'Login field is required.');
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    return Redirect::to('/')->with('message', 'Password field is required.');
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
		     return Redirect::to('/')->with('message', 'User with this login already exists.');
		}
   	}

   	public function getActivate(){
   		 $user = Sentry::findUserByCredentials(array(
        'email'=> $_REQUEST['useremail']
        ));
        if($user->activation_code == $_REQUEST['activationcode']){
        	$user->activated = 1;
        	$user->activated_at = new DateTime;
        	$user->save();
        	return Redirect::to('/')->with('message', 'Activation successful. You may login now.');
        }
   		
   	}
    
    public function getLogout()
    {
        Sentry::logout();
        return Redirect::to('/')->with('message', 'Logout successful.');
    }

    public function postForgotPassword(){
    	try
		{
		    // Find the user using the user email address
		    $user = Sentry::findUserByLogin(Input::get('email'));

		    // Get the password reset code
		    $resetCode = $user->getResetPasswordCode();
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    echo 'User was not found.';
		}

		$data = array(
			    'detail'=>'Account activation mail',
			    'name'  => $user['first_name']." ".$user['last_name'],
			    'reset_code'=>$resetCode,
			    'email'=>$user['email'],
			);
			 
			// use Mail::send function to send email passing the data and using the $user variable in the closure
			Mail::send('passwordReset', $data, function($message) use ($user)
			{
			  $message->from('admin@org.com', 'Organisation');
			  $message->to('ananthmadhavan6@gmail.com', $user['name'])->subject('Password Reset');
			});

		return Redirect::to('/')->with('message','Reset password code has been sent to your inbox!');

    }

    public function getResetPassword(){
	    // var_dump("expression");die;
	    $user = Sentry::findUserByLogin(Input::get('useremail'));
	    if($user->reset_password_code == Input::get('reset_code')){
	    	return View::make('resetPassword',array('email'=> Input::get('useremail')));    
	    }	
    }

    public function postResetPassword(){
    	// var_dump("expression");die;
    	try
		{
		    $user = Sentry::findUserByLogin(Input::get('email'));
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    echo 'User was not found.';
		}
		$user->password = Input::get('password');
		$user->save();
		return Redirect::to('/')->with('message', 'Password succesfully changed.');

    }
}