<?php

namespace App\Listeners;

use App\Repositories\LoginHistory\LoginHistoryRepository;
use Illuminate\Support\Carbon;

class LogLogoutHistory
{
    /**
     * @var LoginHistoryRepository
     */
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
     * @return void
     */
    public function handle($event)
    {
        $session_id = request()->session()->getId();
        $data = array('logout_at' => Carbon::now());

        $this->loginHistory->updateBySessionId($session_id, $data);
    }
}
