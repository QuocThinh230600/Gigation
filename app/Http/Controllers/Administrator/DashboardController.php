<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Support\Facades\Session;
use Spatie\Analytics\Period;

class DashboardController extends AdminController
{
    private $view = 'administrator.modules.dashboard.';

    /**
     * DashboardController constructor.
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show view dashboard
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function index()
    {
        if (env('ANALYTICS_VIEW_ID') == NULL) {
            return view($this->view . 'index');
        } else {
            $data["peferrersData"] = \Analytics::fetchTopReferrers(Period::days(7));

            $topBrowser         = \Analytics::fetchTopBrowsers(Period::days(7), 5);
            $data['topBrowser'] = json_encode($topBrowser);
            $data['browser']    = json_encode($topBrowser->pluck('browser'));

            $data["mostVisitedPages"] = \Analytics::fetchMostVisitedPages(Period::days(7));

            $visitedPages         = \Analytics::fetchUserTypes(Period::months(1));
            $data['visitedPages'] = json_encode($visitedPages);
            $data['type']         = json_encode($visitedPages->pluck('type'));

            $analyticsData = \Analytics::performQuery(
                Period::months(1),
                'ga:sessions',
                [
                    'metrics'    => 'ga:sessions',
                    'dimensions' => 'ga:country',
                    'sort'       => '-ga:sessions'
                ]
            );

            $nation = array();

            foreach ($analyticsData->rows as $item) {
                $nation[$item[0]] = (int)$item[1];
            }

            $data['nation'] = json_encode($nation);

            $totalVisitedPages         = \Analytics::fetchTotalVisitorsAndPageViews(Period::days(14));
            $data['totalVisitorsDate'] = json_encode($totalVisitedPages->pluck('date')->map(function ($date) {
                return $date->format('d/m');
            }));
            $data['totalVisitors']     = $totalVisitedPages->pluck('visitors');
            $data['totalPageViewes']   = $totalVisitedPages->pluck('pageViews');

            return view($this->view . 'index', $data);
        }

    }

    /**
     * Set locale to switch language
     * @param string $locale
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function locale(string $locale)
    {
        Session::put('locale', $locale);
        return redirect()->back();
    }
}
