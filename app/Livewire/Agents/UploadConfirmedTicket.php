<?php

namespace App\Livewire\Agents;

use App\Enums\StatusEnum;
use App\Mail\TicketConfirmationMail;
use App\Models\ConfirmedTicket;
use App\Models\SaleBooking;
use App\Models\TicketBookingMode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class UploadConfirmedTicket extends Component
{
    use WithFileUploads;

    public $booking;
    public $bookingID;
    public $confirmation_number;
    public $ticket_filepath;


    public function mount($appID)
    {
        $this->bookingID = $appID;
        $this->booking = SaleBooking::find($appID);
    }

    public function saveConfirmation()
    {
        $this->validate([
            'confirmation_number' => 'required',
            'ticket_filepath' => 'required|file|mimes:pdf|max:6000',
        ], [
            'confirmation_number.required' => 'Confirmation number is required.',
            'ticket_filepath.required' => 'Ticket file is required.',
            'ticket_filepath.file' => 'Ticket file must be a file.',
            'ticket_filepath.mimes' => 'Ticket file must be a pdf file.',
            'ticket_filepath.max' => 'Ticket file must be less than 6MB.',

        ]);

        try {
            DB::beginTransaction();
            $ticket = TicketBookingMode::updateOrCreate([
                'app_id' => $this->bookingID,
            ], [
                'confirmation_number' => $this->confirmation_number,
                'ticket_filepath' => $this->ticket_filepath->storeAs('public/Tickets/' . $this->booking->id, 'Ticket' . '.' . $this->ticket_filepath->getClientOriginalExtension()),
            ]);

            $booking = SaleBooking::where('id', $this->bookingID)->first();
            $booking->update([
                'app_status' => StatusEnum::TICKET_ISSUED->value,
            ]);

            DB::commit();
            $mailData = [
                'app_id' => $this->booking->id,
                'name' => $this->booking->customer->customer_name,
                'passengers' => $this->booking->passengers,
                'agent' => $this->booking->agent->name,
            ];


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
