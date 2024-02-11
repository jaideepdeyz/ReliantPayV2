<?php

namespace App\Livewire\Agents;

use App\Enums\StatusEnum;
use App\Models\AgentPasswordChangeLogs;
use App\Models\SaleBooking;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AgentDashboard extends Component
{

    public $processes = [];
    public $performingAgents = [];
    public $options;
    public $charttype = '10';
    public $firstPasswordChanged = 'No';
    public $currentPassword;
    public $newPassword;
    public $confirmPassword;
    public $totalrevenueoptions;

    public function mount()
    {
        $this->last10days();
        $this->totalRevenue();
        $passChangeStatus = AgentPasswordChangeLogs::where('user_id', Auth::User()->id)->first();
        if($passChangeStatus->first_password_changed == 'Yes'){
            $this->firstPasswordChanged = 'Yes';
        } else {
            $this->firstPasswordChanged = 'No';
        }
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

    public function changePassword()
    {
        if($this->currentPassword == $this->newPassword){
            $this->dispatch('message', heading:'error', text: 'New Password cannot be same as Old Password')->self();
            return;
        } else {
            $this->validate([
                'currentPassword' => 'required',
                'newPassword' => 'required|min:8',
                'confirmPassword' => 'required|min:8|same:newPassword',
            ], [
                'currentPassword.required' => 'Current Password is required',
                'newPassword.required' => 'New Password is required',
                'newPassword.min' => 'New Password must be at least 8 characters',
                'confirmPassword.required' => 'Confirm Password is required',
                'confirmPassword.min' => 'Confirm Password must be at least 8 characters',
                'confirmPassword.same' => 'The passwords provided do not match',
            ]);

            try
            {
                DB::beginTransaction();
                $user = User::where('id', Auth::User()->id)->first();
                $user->password = Hash::make($this->newPassword);
                $user->save();

                $agentLogs = AgentPasswordChangeLogs::where('user_id', Auth::User()->id)->first();
                $agentLogs->first_password_changed = 'Yes';
                $agentLogs->save();
                DB::commit();
                $this->firstPasswordChanged = 'Yes';
                $this->dispatch('message', heading:'success',text:'Password Updated successfully')->self();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->dispatch('message', heading:'error', text: $e->getMessage())->self();
                return;
            }
        }
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

    public function totalRevenue()
    {

        $totalRevenue=SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)->where('agent_id', auth()->user()->id)->sum('amount_charged');
        $totalRevenueThisDay=SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)->where('agent_id', auth()->user()->id)->whereDay('updated_at',date('d'))->sum('amount_charged');
        $totalRevenueThisWeek=SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)->where('agent_id', auth()->user()->id)->whereBetween('updated_at',[date('Y-m-d', strtotime('monday this week')),date('Y-m-d', strtotime('sunday this week'))])->sum('amount_charged');
        $totalRevenueThisMonth=SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)->where('agent_id', auth()->user()->id)->whereMonth('updated_at',date('m'))->sum('amount_charged');
        $totalRevenueThisYear=SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)->where('agent_id', auth()->user()->id)->whereYear('updated_at',date('Y'))->sum('amount_charged');

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
