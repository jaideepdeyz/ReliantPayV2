<?php

namespace App\Livewire\Dealer;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\Organization;
use App\Models\SaleBooking;
use App\Models\ServiceMaster;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DealerDashboard extends Component
{

    public $processes = [];
    public $performingAgents = [];
    public $options;
    public $charttype = '10';
    public $totalrevenueoptions;

    public function mount()
    {
        $this->last10days();
        $this->totalRevenue();
    }

    public function updateChart($type)
    {
        switch ($type) {
            case '10':
                $this->last10days();
                break;
            case '30':
                $this->last30days();
                break;
            case '60':
                $this->last60days();
                break;
            default:
                $this->last10days();
                break;
        }
    }


    public function last10days()
    {
        $days = [];
        $currentDate = date('Y-m-d');
        for ($i = 0; $i < 10; $i++) {
            $day = date('Y-m-d', strtotime('-' . $i . ' days', strtotime($currentDate)));
            $days[] = $day;
        }
        $last10DaysAmountChargedSumArray = [];
        foreach ($days as $day) {
            $last10DaysAmountChargedSumArray[] = [
                'day' => Carbon::parse($day)->format('d M Y'),
                'amount' => SaleBooking::where('organization_id', Auth::User()->organization_id)
                ->where('app_status', StatusEnum::PAYMENT_DONE->value)
                    ->whereDate('updated_at', $day)
                    ->sum('amount_charged')
            ];
        }
        $this->options = [
            'series' => [
                [
                    'name' => 'Sales',
                    'type' => 'column',
                    'data' => array_column($last10DaysAmountChargedSumArray, 'amount'),
                ],

            ],
            'chart' => [
                'height' => 378,
                'type' => 'line',
                'offsetY' => 10,
            ],
            'stroke' => [
                'width' => [2, 3],
            ],
            'plotOptions' => [
                'bar' => [
                    'columnWidth' => '50%',
                ],
            ],
            'colors' => ['#1abc9c', '#4a81d4'],
            'dataLabels' => [
                'enabled' => true,
                'enabledOnSeries' => [1],
            ],
            'labels' => array_column($last10DaysAmountChargedSumArray, 'day'),
            'xaxis' => [
                'type' => 'datetime',
            ],
            'legend' => [
                'offsetY' => 7,
            ],
            'grid' => [
                'padding' => [
                    'bottom' => 20,
                ],
            ],
            'yaxis' => [
                [
                    'title' => [
                        'text' => 'Net Sales',
                    ],
                ],

            ],
        ];
    }

    public function last30days()
    {
        $days = [];
        $currentDate = date('Y-m-d');
        for ($i = 0; $i < 30; $i++) {
            $day = date('Y-m-d', strtotime('-' . $i . ' days', strtotime($currentDate)));
            $days[] = $day;
        }
        $last30DaysAmountChargedSumArray = [];
        foreach ($days as $day) {
            $last30DaysAmountChargedSumArray[] = [
                'day' => Carbon::parse($day)->format('d M Y'),
                'amount' => SaleBooking::where('organization_id', Auth::User()->organization_id)
                ->where('app_status', StatusEnum::PAYMENT_DONE->value)
                    ->whereDate('updated_at', $day)
                    ->sum('amount_charged')
            ];
        }
        $this->options = [
            'series' => [
                [
                    'name' => 'Sales',
                    'type' => 'column',
                    'data' => array_column($last30DaysAmountChargedSumArray, 'amount'),
                ],

            ],
            'chart' => [
                'height' => 378,
                'type' => 'line',
                'offsetY' => 10,
            ],
            'stroke' => [
                'width' => [2, 3],
            ],
            'plotOptions' => [
                'bar' => [
                    'columnWidth' => '50%',
                ],
            ],
            'colors' => ['#1abc9c', '#4a81d4'],
            'dataLabels' => [
                'enabled' => true,
                'enabledOnSeries' => [1],
            ],
            'labels' => array_column($last30DaysAmountChargedSumArray, 'day'),
            'xaxis' => [
                'type' => 'datetime',
            ],
            'legend' => [
                'offsetY' => 7,
            ],
            'grid' => [
                'padding' => [
                    'bottom' => 20,
                ],
            ],
            'yaxis' => [
                [
                    'title' => [
                        'text' => 'Net Sales',
                    ],
                ],

            ],
        ];
    }

    public function last60Days()
    {
        $days = [];
        $currentDate = date('Y-m-d');

        for ($i = 0; $i < 60; $i++) {
            $day = date('Y-m-d', strtotime('-' . $i . ' days', strtotime($currentDate)));
            $days[] = $day;
        }

        $last60DaysAmountChargedSumArray = [];
        foreach ($days as $day) {
            $last60DaysAmountChargedSumArray[] = [
                'day' => Carbon::parse($day)->format('d M Y'),
                'amount' => SaleBooking::where('organization_id', Auth::User()->organization_id)
                ->where('app_status', StatusEnum::PAYMENT_DONE->value)
                    ->whereDate('updated_at', $day)
                    ->sum('amount_charged')
            ];
        }

        $this->options = [
            'series' => [
                [
                    'name' => 'Sales',
                    'type' => 'column',
                    'data' => array_column($last60DaysAmountChargedSumArray, 'amount'),
                ],

            ],
            'chart' => [
                'height' => 378,
                'type' => 'line',
                'offsetY' => 10,
            ],
            'stroke' => [
                'width' => [2, 3],
            ],
            'plotOptions' => [
                'bar' => [
                    'columnWidth' => '50%',
                ],
            ],
            'colors' => ['#1abc9c', '#4a81d4'],
            'dataLabels' => [
                'enabled' => true,
                'enabledOnSeries' => [1],
            ],
            'labels' => array_column($last60DaysAmountChargedSumArray, 'day'),
            'xaxis' => [
                'type' => 'datetime',
            ],
            'legend' => [
                'offsetY' => 7,
            ],
            'grid' => [
                'padding' => [
                    'bottom' => 20,
                ],
            ],
            'yaxis' => [
                [
                    'title' => [
                        'text' => 'Net Sales',
                    ],
                ],

            ],
        ];
    }

    public function render()
    {
        $agents = User::where('organization_id', Auth::User()->organization_id)->where('role', RoleEnum::AGENT->value)->count();
        $customers = SaleBooking::where('organization_id', Auth::User()->organization_id)->where('app_status', StatusEnum::PAYMENT_DONE->value)->count();
        $pendingAuthorizations = SaleBooking::where('app_status', StatusEnum::SENT_FOR_AUTH->value)->where('organization_id', Auth::User()->organization_id)->count();

        $revenue = SaleBooking::where('organization_id', Auth::User()->organization_id)->where('app_status', StatusEnum::PAYMENT_DONE->value)
        ->whereYear('updated_at', date('Y'))
        ->get();
        $revenueThisDay = 0;
        $revenueThisWeek = 0;
        $revenueThisMonth = 0;
        $revenueThisYear = 0;
        $revenueMonthly = 0;
        $inc = 1;

        foreach ($revenue as $rev) {
            $revenueThisDay += $rev->totalPaymentsDay();
            $revenueThisMonth += $rev->totalPaymentsMonth();
            $revenueThisYear += $rev->totalPaymentsYear();
            $revenueThisWeek += $rev->totalPaymentsWeek();
            $revenueMonthly += $rev->totalPaymentsMonthly('02');
            $inc++;
        }

        $availableServices = ServiceMaster::all();

        foreach ($availableServices as $service) {
            //store total revenue for each service
            $processes = [
                'service' => $service->service_name,
                'totalRevenue' => $service->totalRevenueByMerchant(),
            ];
            array_push($this->processes, $processes);
        }

        $availableAgents = User::where('organization_id', Auth::User()->organization_id)->where('role', RoleEnum::AGENT->value)->where('is_active', 'Yes')->get();

        foreach ($availableAgents as $perFormAgent) {

            //store total revenue for each agent
            $perFormAgent = [
                'agentName' => $perFormAgent->name,
                'totalAgentRevenue' => $perFormAgent->totalAgentRevenue(),
            ];
            array_push($this->performingAgents, $perFormAgent);
        }

        return view('livewire.dealer.dealer-dashboard', [
            'agents' => $agents,
            'customers' => $customers,
            'pendingAuthorizations' => $pendingAuthorizations,
            'revenueThisDay' => $revenueThisDay,
            'revenueThisWeek' => $revenueThisWeek,
            'revenueThisMonth' => $revenueThisMonth,
            'revenueThisYear' => $revenueThisYear,
            'revenueMonthly' => $revenueMonthly,
        ])->layout('layouts.dashboard-layout');
    }

    public function totalRevenue()
    {

        $totalRevenue=SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)->sum('amount_charged');
        $totalRevenueThisDay=SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)->where('organization_id', auth()->user()->organization_id)->whereDay('updated_at',date('d'))->sum('amount_charged');
        $totalRevenueThisWeek=SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)->where('organization_id', auth()->user()->organization_id)->whereBetween('updated_at',[date('Y-m-d', strtotime('monday this week')),date('Y-m-d', strtotime('sunday this week'))])->sum('amount_charged');
        $totalRevenueThisMonth=SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)->where('organization_id', auth()->user()->organization_id)->whereMonth('updated_at',date('m'))->sum('amount_charged');
        $totalRevenueThisYear=SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)->where('organization_id', auth()->user()->organization_id)->whereYear('updated_at',date('Y'))->sum('amount_charged');

        $this->totalrevenueoptions = [
            'series' => [$totalRevenue,$totalRevenueThisDay,$totalRevenueThisWeek,$totalRevenueThisMonth,$totalRevenueThisYear],
            'chart' => [
                'type' => 'donut',
            ],
            'labels' => ['Total Revenue','Today','This Week','This Month','This Year'],
            'responsive' => [
                [
                    'breakpoint' => 480,
                    'options' => [
                        'chart' => [
                            'width' => 200,
                        ],

                    ],
                ],
            ],
            'legend' => [
                'show' => false,
            ],
        ];



    }
}
