<?php

namespace App\Http\Controllers\Authentication;

use Pusher\Pusher;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\TestNotification;
use App\Http\Requests\Authentication\RegisterRequest;
// use Pusher\Pusher;

class RegisterController extends Controller
{
    private $view = 'authentication.pages.';

    /**
     * Display member registration interface
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function showRegisterForm()
    {
        return view($this->view . 'register');
    }

    /**
     * Member registration process
     * @param RegisterRequest $request
     * @return mixed
     * @throws \Throwable
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();

        try {
            $data                      = $request->except('_token', '_method', 'password_confirmation', 'accept_condition', 'captcha');
            $data['password']          = bcrypt($request->password);
            $data['level']             = 2;
            $data['token']             = Str::random(40);
            $data['email_verified_at'] = Carbon::now()->addMinutes(15);
            $data['status']            = 'off';

            $user = User::create($data);

            $admin = User::where('level',1)->get();

            $notify['link'] = route('admin.user.index');
            $notify['message'] = message('pusher.mesage_register');
            $notify['type']  = message('pusher.register');

            foreach($admin as $row)
            {
                $row->notify(new TestNotification($notify));
            }

            $options = array(
                'cluster' => 'ap1',
                'encrypted' => true
            );

            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );

            $pusher->trigger('NotificationEvent', 'send-message', $notify);
            // $user->sendVerificationEmail();

            DB::commit();

            return response()->json([
                'status'   => 'success',
                'message'  => message('register.sent'),
                'redirect' => route('auth.showRegisterForm')
            ], 200);
        } catch (\Error $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
