<?php

namespace App\Livewire\Agents;

use App\Mail\TicketConfirmationMail;
use App\Models\ConfirmedTicket;
use App\Models\SaleBooking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class UploadConfirmedTicket extends Component
{
    use WithFileUploads;

    public $booking;
    public $confirmation_number;
    public $ticket_filepath;


    public function mount($appID)
    {
        $this->booking = SaleBooking::find($appID);
    }

    public function saveConfirmation()
    {
        $this->validate([
            'confirmation_number' => 'required',
            'ticket_filepath' => 'required|file|mimes:pdf|max:6000',
        ]);

        try {
            DB::beginTransaction();
            $ticket = ConfirmedTicket::updateOrCreate([
                'app_id' => $this->booking->id,
            ], [
                'confirmation_number' => $this->confirmation_number,
                'ticket_filepath' => $this->ticket_filepath->storeAs('public/Tickets/' . $this->booking->id, 'Ticket' . '.' . $this->ticket_filepath->getClientOriginalExtension()),
            ]);
            DB::commit();
            $mailData = [
                'logo' => public_path('website/images/reservation_assistance_logo.png'),
                'app_id' => $this->booking->id,
                'name' => $this->booking->customer->customer_name,
                'passengers' => $this->booking->passengers,
                'agent' => $this->booking->agent->name,
            ];

            dd($mailData);

            Mail::to($this->booking->customer->customer_email)->send(new TicketConfirmationMail($mailData));
            Session::flash('message', ['heading' => 'success', 'text' => 'Ticket uploaded and mailed successfully.']);
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            Session::flash('message', ['heading' => 'error', 'text' => $e->getMessage()]);
            return;
        }
    }

    public function render()
    {
        return view('livewire.agents.upload-confirmed-ticket')->layout('layouts.dashboard-layout');
    }
}
