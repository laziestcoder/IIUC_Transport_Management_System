<?php

namespace Bestmomo\LaravelEmailConfirmation\Traits;

use Bestmomo\LaravelEmailConfirmation\Notifications\ConfirmEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Console\DetectsApplicationNamespace;
use Illuminate\Foundation\Auth\RegistersUsers as BaseRegistersUsers;
use Illuminate\Http\Request;

trait RegistersUsers
{
    use BaseRegistersUsers, DetectsApplicationNamespace;

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        $user->confirmation_code = str_random(30);
        $user->save();

        event(new Registered($user));

        $this->notifyUser($user);

        return $this->registered($request, $user)
            ?: back()->with('confirmation-success', trans('confirmation::confirmation.message'));
    }

    /**
     * Notify user with email
     *
     * @param  Model $user
     * @return void
     */
    protected function notifyUser($user)
    {
        $class = $this->getAppNamespace() . 'Notifications\ConfirmEmail';

        if (!class_exists($class)) {
            $class = ConfirmEmail::class;
        }

        $user->notify(new $class);
    }

    /**
     * Handle a confirmation request
     *
     * @param  integer $id
     * @param  string $confirmation_code
     * @return \Illuminate\Http\Response
     */
    public function confirm($id, $confirmation_code)
    {
        $model = $this->guard()->getProvider()->createModel();
        $user = $model->whereId($id)->whereConfirmationCode($confirmation_code)->firstOrFail();
        $user->confirmation_code = null;
        $user->confirmed = true;
        $user->save();

        return redirect(route('login'))->with('confirmation-success', trans('confirmation::confirmation.success'));
    }

    /**
     * Handle a resend request
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->session()->has('user_id')) {

            $model = config('auth.providers.users.model');

            $user = $model::findOrFail($request->session()->get('user_id'));
            if (empty($user->confirmation_code)) {
                $user->confirmation_code = str_random(30);
                $user->save();
            }

            $this->notifyUser($user);

            return redirect(route('login'))->with('confirmation-success', trans('confirmation::confirmation.resend'));
        }

        return redirect('/');
    }
}
