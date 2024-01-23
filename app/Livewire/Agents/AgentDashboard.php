<?php

namespace App\Livewire\Agents;

use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AgentDashboard extends Component
{

    public $processes = [];
    public $performingAgents = [];
    public $options;
    public $charttype = '10';
    
    public function mount()
    {
        $this->last10days();
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
                'amount' => SaleBooking::where('agent_id', Auth::User()->id)
                ->where('organization_id', Auth::User()->organization_id)
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
                'amount' => SaleBooking::where('agent_id', Auth::User()->id)
                ->where('organization_id', Auth::User()->organization_id)
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
                'amount' => SaleBooking::where('agent_id', Auth::User()->id)
                ->where('organization_id', Auth::User()->organization_id)
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
        $authorizations = SaleBooking::where('agent_id', auth()->user()->id)->where('app_status', StatusEnum::AUTHORIZED->value)->latest()->take(5)->get();
        $bookings = SaleBooking::where('agent_id', auth()->user()->id)->latest()->take(5)->get();
        $customers = SaleBooking::where('agent_id', Auth::User()->id)->where('app_status',StatusEnum::PAYMENT_DONE->value)->count();
        $topCustomers = SaleBooking::where('agent_id', Auth::User()->id)->where('app_status',StatusEnum::PAYMENT_DONE->value)->orderBy('amount_charged', 'DESC')->paginate(10);
        $pendingPayment = SaleBooking::where('agent_id', Auth::User()->id)->where('app_status',StatusEnum::AUTHORIZED->value)->count();
        $pendingAuthorization = SaleBooking::where('agent_id', Auth::User()->id)->where('app_status',StatusEnum::PENDING->value)->count();
        $revenue = SaleBooking::where('agent_id', Auth::User()->id)
        ->where('app_status',StatusEnum::PAYMENT_DONE->value)
        ->whereYear('updated_at',date('Y'))
        ->get();
        $revenueThisDay= 0;
        $revenueThisWeek= 0;
        $revenueThisMonth = 0;
        $revenueThisYear = 0;
        $revenueMonthly=0;
        $inc = 1;
        foreach($revenue as $rev){
            $revenueThisDay += $rev->totalPaymentsDay();
            $revenueThisMonth += $rev->totalPaymentsMonth();
            $revenueThisYear += $rev->totalPaymentsYear();
            $revenueThisWeek += $rev->totalPaymentsWeek();
            $revenueMonthly += $rev->totalPaymentsMonthly('02');
            $inc++;
        }
        return view('livewire.agents.agent-dashboard', [
            'authorizations' => $authorizations,
            'bookings' => $bookings,
            'customers' => $customers,
            'pendingPayment' => $pendingPayment,
            'pendingAuthorization' => $pendingAuthorization,
            'revenueThisDay' => $revenueThisDay,
            'revenueThisWeek' => $revenueThisWeek,
            'revenueThisMonth' => $revenueThisMonth,
            'revenueThisYear' => $revenueThisYear,
            'revenueMonthly' => $revenueMonthly,
            'topCustomers' => $topCustomers,
        ])->layout('layouts.dashboard-layout');
    }
}
