<?php

namespace App\Livewire\Admin;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\Organization;
use App\Models\SaleBooking;
use App\Models\ServiceMaster;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $processes = [];
    public $merchants = [];
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

    public function render()
    {
        $authorizations = SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)->latest()->take(5)->get();
        $bookings = SaleBooking::latest()->take(5)->get();
        $agents = User::where('role', RoleEnum::AGENT->value)->count();
        $dealers = User::where('role', RoleEnum::DEALER->value)->count();
        $pendingRegistrations = User::where('role', RoleEnum::DEALER->value)->whereIn('is_approved', ['No', null])->where('organization_id', '!=', NULL)->count();

        $revenue = SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)
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
                'totalRevenue' => $service->totalRevenue(),
            ];
            array_push($this->processes, $processes);
        }

        $availableMerchants = Organization::where('status', 'Approved')->get();
        foreach ($availableMerchants as $merchant) {
            //store total revenue for each service
            $merchant = [
                'merchant' => $merchant->business_name,
                'totalMerchRevenue' => $merchant->totalMerchantRevenue(),
            ];
            array_push($this->merchants, $merchant);
        }


        return view('livewire.admin.admin-dashboard', [
            'authorizations' => $authorizations,
            'bookings' => $bookings,
            'agents' => $agents,
            'dealers' => $dealers,
            'pendingRegistrations' => $pendingRegistrations,
            'revenueThisDay' => $revenueThisDay,
            'revenueThisWeek' => $revenueThisWeek,
            'revenueThisMonth' => $revenueThisMonth,
            'revenueThisYear' => $revenueThisYear,
            'revenueMonthly' => $revenueMonthly,
            'processes' => $this->processes,
            'merchants' => $this->merchants,
        ])->layout('layouts.dashboard-layout');
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
                'amount' => SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)
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
                'amount' => SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)
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
    public function last60Days(){
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
                'amount' => SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)
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
}
