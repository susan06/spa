<?php

namespace App\Mailers;

use Settings;
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
        $subject = 'Reservación para el local '.$local->name;
        $email_to = [$owner->email, $local->email];

        $this->sendTo($email_to, $subject, $view, $data);
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

    public function sendRecommendation($id_local, $email, $friend)
    {
        $local = BranchOffice::find($id_local);
        $view = 'emails.notifications.recommendation_friends';
        $data = ['local' => $local, 'email' => $email, 'friend' => $friend, 'site' => Settings::get('app_name')];
        $subject = trans('app.invite_email', ['client' => $friend, 'site' => Settings::get('app_name') ]);

        $this->sendTo($email, $subject, $view, $data);
    }
}