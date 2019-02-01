<?php

namespace App\Console\Commands;

use App\Mail\AdministrationMail;
use App\Mail\PasswordMail;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Picqer\Financials\Exact\Employee;

class SyncEmployees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:employees';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync employees';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $connection = $this->connect();
        $employees = new Employee($connection);

        $exactEmployees   = $employees->get();

        /**
         * @todo:
         * exact online ID toevoegen aan users
         * employee ophalen op basis van exact online ID
         * naam / email toevoegen
         */

        foreach($exactEmployees as $exactEmployee){

            $newEmployee = false;
            $id = $exactEmployee->HID;
            $employee = User::where('exact_id', $id)->first();
            if(!$employee){
                $newEmployee = true;
                $employee = new User();
                $employee->exact_id = $id;
                $administration = User::all()->where('role_id', '=', '5');
                $administration = $administration[0];
            }

            $employee->lastname =  $exactEmployee->LastName;
            $employee->firstname = $exactEmployee->FirstName;

            if(strlen($exactEmployee->Email) > 0){
                $employee->email = $exactEmployee->Email;
            } else if (strlen($employee->email) == 0) {
                $employee->email = strtolower($employee->firstname) . '@doitonlinemedia.nl';
            }

            if($newEmployee){

                // generate password
                // mail naar deze gebruiker: username + password to user, username = $employee->email
                // mail naar marleen dat er een nieuwe gebruiker is aangemaakt met het verzoek of ze een afdeling wil kiezen

                $password = Str::random(8);
                $employee->password = bcrypt($password);

                Mail::to($employee->email)->send(new PasswordMail($employee, $password));
                Mail::to($administration->email)->send(new AdministrationMail($employee, $administration));
            }

            $employee->save();

            // Mail administratie

        }
    }

    public function connect()
    {
        $connection = new \Picqer\Financials\Exact\Connection();
        $connection->setRedirectUrl(env('EXACT_ONLINE_REDIRECT_URL'));
        $connection->setExactClientId(env('EXACT_ONLINE_CLIENT_ID'));
        $connection->setExactClientSecret(env('EXACT_ONLINE_CLIENT_SECRET'));

        // Retrieves authorizationcode from database
        if (getValue('authorizationcode')) {
            $connection->setAuthorizationCode(getValue('authorizationcode'));
        }
        // Retrieves accesstoken from database
        if (getValue('accesstoken')) {
            $connection->setAccessToken(getValue('accesstoken'));
        }
        // Retrieves refreshtoken from database
        if (getValue('refreshtoken')) {
            $connection->setRefreshToken(getValue('refreshtoken'));
        }
        // Retrieves expires timestamp from database
        if (getValue('expires_in')) {
            $connection->setTokenExpires(getValue('expires_in'));
        }
        // Set callback to save newly generated tokens
        $connection->setTokenUpdateCallback('tokenUpdateCallback');
        // Make the client connect and exchange tokens
        try {
            $connection->connect();
        } catch (\Exception $e) {
            throw new Exception('Could not connect to Exact: ' . $e->getMessage());
        }
        return $connection;
    }

}
