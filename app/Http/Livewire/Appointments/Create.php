<?php

namespace App\Http\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\Information;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\Specialist;
use App\Services\MailerService;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Create extends Component
{
    public $services = [];
    public $schedules = [];

    public $service_id;
    public $schedule_id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $email;
    public $gender;
    public $contact_number;
    public $address;


    public $specialist;
    public $schedule_time_start;
    public $schedule_time_end;
    public $schedule_date;
    public $information;

    protected $rules = [
        'service_id' => 'required',
        'schedule_id' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'gender' => 'required',
        'contact_number' => 'required',
        'address' => 'required'
    ];

    public function updatedServiceId() 
    {
        $this->schedules = Schedule::where('service_id', $this->service_id)->where('flag', 0)->whereDate('date', '>=', now())->with('service')->get();
    }

    public function updatedScheduleId()
    {
        $schedule = Schedule::find($this->schedule_id);
        $this->schedule_time_start = Carbon::parse($schedule->time_start);
        $this->schedule_time_end = Carbon::parse($schedule->time_end);
        $this->schedule_date = $schedule->date;

        $info = Information::where('user_id', $schedule->specialist_id)->where('account_type', 2)->first();
        $this->specialist = $info->getFullName();
    }

    public function updatedInformation()
    {
        if(!$this->information) {
            $this->first_name = $this->middle_name = $this->last_name = $this->email = $this->gender = $this->contact_number = $this->address = "";
        }

        $user = auth()->user();
        $info = Information::where('user_id', $user->user_id)->where('account_type', $user->account_type)->first();
        
        $this->first_name = $info->first_name;
        $this->middle_name = $info->middle_name;
        $this->last_name = $info->last_name;
        $this->email = $info->email;
        $this->gender = $info->gender;
        $this->contact_number = $info->contact_number;
        $this->address = $info->getFullAddress();
    }

    public function render()
    {
        $this->services = Service::all();
        return view('livewire.appointments.create');
    }

    public function setAppointment()
    {
        $this->validate();

        $schedule = Schedule::find($this->schedule_id);

        $schedule->update([
            'flag' => 1
        ]);

        Appointment::create([
            'patient_id' => auth()->user()->user_id,
            'schedule_id' => $this->schedule_id,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'gender' => $this->gender,
            'contact_number' => $this->contact_number,
            'address' => $this->address,
        ]);

        $user = Information::where('user_id', auth()->user()->user_id)->where('account_type', 3)->first();
        MailerService::send($user->getFullName(), $this->email, 1);

        redirect(route('appointments.index'))->with('success', 'Successfully set appointment!');
    }
}

