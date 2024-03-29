<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Auth,Validator,Redirect,Lang;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    // use RedirectsUsers;
    use ThrottlesLogins;
    // use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    public function getLogin()
    {
        return $this->showLoginForm();
    }

    public function showLoginForm()
    {
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }

        return view('auth.login');
    }


    public function postLogin(Request $request)
    {
        return $this->login($request);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function login(Request $request)
    // {
    //     $this->validate($request, [
    //         $this->loginUsername() => 'required', 'password' => 'required',
    //     ]);
    //
    //     // If the class is using the ThrottlesLogins trait, we can automatically throttle
    //     // the login attempts for this application. We'll key this by the username and
    //     // the IP address of the client making these requests into this application.
    //     $throttles = $this->isUsingThrottlesLoginsTrait();
    //
    //     if ($throttles && $this->hasTooManyLoginAttempts($request)) {
    //         return $this->sendLockoutResponse($request);
    //     }
    //
    //     $credentials = $this->getCredentials($request);
    //
    //     if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
    //         return $this->handleUserWasAuthenticated($request, $throttles);
    //     }
    //
    //     // If the login attempt was unsuccessful we will increment the number of attempts
    //     // to login and redirect the user back to the login form. Of course, when this
    //     // user surpasses their maximum number of attempts they will get locked out.
    //     if ($throttles) {
    //         $this->incrementLoginAttempts($request);
    //     }
    //
    //     return $this->sendFailedLoginResponse($request);
    // }



    public function login(Request $request){

        if (Auth::attempt(array('name' => $request->name, 'password' => $request->password)))
        // if (Auth::attempt(array('email' => $request->email, 'password' => $request->password)))
        {
            return Redirect()->intended('admin');
        }else{
            return redirect()->back()->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
        }
    }


    protected function handleUserWasAuthenticated(Request $request, $throttles)
        {
            if ($throttles) {
                $this->clearLoginAttempts($request);
            }

            if (method_exists($this, 'authenticated')) {
                return $this->authenticated($request, Auth::user());
            }

            return redirect()->intended($this->redirectPath());
        }

        /**
         * Get the failed login response instance.
         *
         * @param \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        protected function sendFailedLoginResponse(Request $request)
        {
            return redirect()->back()
                ->withInput($request->only($this->loginUsername(), 'remember'))
                ->withErrors([
                    $this->loginUsername() => $this->getFailedLoginMessage(),
                ]);
        }

        /**
         * Get the failed login message.
         *
         * @return string
         */
        protected function getFailedLoginMessage()
        {
            return "账号或密码错误";
        }

        /**
         * Get the needed authorization credentials from the request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return array
         */
        protected function getCredentials(Request $request)
        {
            return $request->only($this->loginUsername(), 'password');
        }

        /**
         * Log the user out of the application.
         *
         * @return \Illuminate\Http\Response
         */
        public function getLogout()
        {
            return $this->logout();
        }

        /**
         * Log the user out of the application.
         *
         * @return \Illuminate\Http\Response
         */
        public function logout()
        {
            Auth::guard($this->getGuard())->logout();

            return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
        }

        /**
         * Get the login username to be used by the controller.
         *
         * @return string
         */
        public function loginUsername()
        {
            return property_exists($this, 'username') ? $this->username : 'email';
        }

        /**
         * Determine if the class is using the ThrottlesLogins trait.
         *
         * @return bool
         */
        protected function isUsingThrottlesLoginsTrait()
        {
            return in_array(
                ThrottlesLogins::class, class_uses_recursive(get_class($this))
            );
        }

        /**
         * Get the guard to be used during authentication.
         *
         * @return string|null
         */
        protected function getGuard()
        {
            return property_exists($this, 'guard') ? $this->guard : null;
        }






}
