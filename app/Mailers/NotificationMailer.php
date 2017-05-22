<?php

namespace App\Mailers;

use App\User;
use App\BranchOffice;
use App\Reservation;

class NotificationMailer extends AbstractMailer
{
    public function newUserRegistration(User $recipient, User $newUser)
    {
        $view = 'emails.notifications.new-registration';
        $data = ['user' => $recipient, 'newUser' => $newUser];
        $subject = 'New User Registration';

        $this->sendTo($recipient->email, $subject, $view, $data);
    }

     public function sendReservationOwner(Reservation $reservation)
    {
    	$local = BranchOffice::find($reservation->branch_office_id);
    	$owner = $local->company->owner;
    	$client = $reservation->client;
        $view = 'emails.notifications.new_reservation_owner';
        $data = ['client' => $client, 'local' => $local, 'reservation' => $reservation];
        $subject = 'Tienes una nueva reservación para el local '.$local->name;

        $this->sendTo($owner->email, $subject, $view, $data);
    }

    public function sendReservationStatusOwner(Reservation $reservation)
    {
    	$local = BranchOffice::find($reservation->branch_office_id);
    	$owner = $local->company->owner;
    	$client = $reservation->client;
        $view = 'emails.notifications.reservation_status_owner';
        $data = ['client' => $client, 'local' => $local, 'reservation' => $reservation];
        $subject = 'Se ha cancelado una reservación';

        $this->sendTo($owner->email, $subject, $view, $data);
    }
}