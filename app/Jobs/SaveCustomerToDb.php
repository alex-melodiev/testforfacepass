<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Customer;

class SaveCustomerToDb implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $name, $email, $phone, $photo;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $email, $phone, $photo)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->photo = $photo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $customer = Customer::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
        ]);

        $customer->addMediaFromUrl('http://uztransgaz.botfactory.pro/photo.png')->toMediaCollection('converted_photos');

    }
}
