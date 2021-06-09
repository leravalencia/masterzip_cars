<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Affiliate;
use App\AffiliateLink;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/reports';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(Request $request)
    {

        if ($this->validator($request->all())->fails()) {
            return redirect('/register')->with([
                'errors' => $this->validator($request->all())->errors(),
            ])->withInput(
                $request->except('password')
            );
        }

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        $this->affiliateUser($request, $user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return \Validator::make($data, [
            'name' => 'string|max:255|nullable',
            'last_name' => 'string|max:255|nullable',
            'company' => 'string|max:255|nullable',
            'title' => 'string|max:255|nullable',
            'country' => 'string|max:255|nullable',
            'industry' => 'string|max:255|nullable',
            'phone' => 'string|max:255|nullable',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'] ?? null,
            'last_name' => $data['last_name'] ?? null,
            'company' => $data['company'] ?? null,
            'title' => $data['title'] ?? null,
            'country' => $data['country'] ?? null,
            'industry' => $data['industry'] ?? null,
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * @param Request $request
     * @param $user
     */
    private function affiliateUser(Request $request, $user): void
    {
        if (null !== ($cookieLink = $request->cookie('link'))) {
            $link = AffiliateLink::where('link', $cookieLink)->first();
            if (!$link) {
                $msg = "User registered with link: {$cookieLink}, but it doesn't belong to anybody. Cookies: {$request->cookie()}";
                \Mail::raw($msg, function ($mail) {
                    /** @var \Illuminate\Mail\Message $mail */
                    $mail->to(env('NOTIFY_MAIL', 'valeeva.valeria@gmail.com'));
                });
                \Log::notice($msg);
            } else {
                \Log::info("Affiliate created for partner_id: {$link->user_id}. Registered user_id: {$user->id}");
                Affiliate::create([
                    'partner_id' => $link->user_id,
                    'link' => $cookieLink,
                    'link_id' => $link->id,
                    'affiliate_id' => $user->id,
                ]);
                $link->registers++;
                $link->save();
            }
        }
    }
}
