<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialiteController extends Controller
{
    protected $provider = [ "google", "facebook" ];

    /**
     * Redirect the user to specific provider authentication page.
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function redirect(Request $request)
    {
        $provider = strtolower($request->provider);

        if (in_array($provider, $this->provider)) {
            return Socialite::driver($provider)->redirect();
        }
        abort(404);
    }

    /**
     * Obtain the user information from provider
     * @param  Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function callback(Request $request)
    {
        $provider = strtolower($request->provider);

        if (in_array($provider, $this->provider)) {
            $data = Socialite::driver($request->provider)->user();

            if ($provider === "google") {
                $user = User::where('google_id', $data->getId())->first();
            } else if ($provider === "facebook") {
                $user = User::where('facebook_id', $data->getId())->first();
            }

            if ($user) {
                Auth::login($user);
                return redirect()->route("site.boutique");
            } else {
                $userNewData = [
                    'email' => $data->getEmail(),
                    'email_verified_at' => now(),
                    'password' => bcrypt('azeazeaze'),
                ];
                if ($provider === "google") {
                    $userNewData["name"] = $data->user['given_name'] + ' ' + $data->user['family_name'];
                    $userNewData["google_id"] = $data->getId();
                } else if ($provider === "facebook") {
                    $userNewData["name"] = $data->getName();
                    $userNewData["facebook_id"] = $data->getId();
                }
                $newUser = User::create($userNewData);
                Auth::login($newUser);
                return redirect()->route("profile.edit-password");
            }
        }
        abort(404);
    }
}
