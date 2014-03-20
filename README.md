Sentry2-Laravel
==============

This is a simple implementation of [Sentry2](https://cartalyst.com/manual/sentry) in [Laravel4](http://laravel.com). 

#### Features:
1. Workflow for new user registration with activation.
2. User login and authentication.
3. Forgot password and reset password option.
4. Remember me option.

#### To include this in your app: 
1. Configure your mail.php and database.php.
2. Modify routes to suit your requirement after login or authentication. Default routes redirect to homepage with a flash status message in the homepage itself.
3. Implementation uses Twitter Bootstrap by default and comes up with a UI. Change it as per your requirement.

*Note: The default Auth Provider in Laravel and Sentry are independent. Auth will not work while using Sentry.*

#### Helpers for Sentry 

To get the Logged in user:
    
    Sentry::getUser();

To check if the user is logged in or not:

    Sentry::check();

To check if the user is activated:

    $user = Sentry::findUserByLogin(Input::get('email'));
    $activated = $user->isActivated(); //returns true or false.

For other helpers and workflows, refer the [Sentry2 documentation here](https://cartalyst.com/manual/sentry). It has an exhaustive list of resources.