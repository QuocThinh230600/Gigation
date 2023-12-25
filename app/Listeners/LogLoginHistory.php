<?php

namespace App\Listeners;

use App\Repositories\LoginHistory\LoginHistoryRepository;
use Illuminate\Support\Carbon;

class LogLoginHistory
{

    private $loginHistory;

    /**
     * Create the event listener.
     *
     * @param LoginHistoryRepository $loginHistory
     */
    public function __construct(LoginHistoryRepository $loginHistory)
    {
        $this->loginHistory = $loginHistory;
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return mixed
     * @throws \Throwable
     */
    public function handle($event)
    {
        $data = array(
            'user_uuid'  => auth()->user()->uuid,
            'login_at'   => Carbon::now(),
            'login_ip'   => request()->getClientIp(),
            'session_id' => request()->session()->getId(),
            'device'     => get_device(),
            'browser'    => get_browsers(),
            'os'         => get_os()
        );

        $this->loginHistory->deleteHistoryByUser(auth()->user()->uuid);

        $this->loginHistory->create($data);
    }
}
