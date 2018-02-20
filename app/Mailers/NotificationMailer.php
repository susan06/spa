<?php

namespace App\Mailers;

use Settings;
use App\User;
use App\BranchOffice;
use App\Reservation;
use App\Tour;
use App\TourReservation;

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

     public function sendTourReservationOwner(TourReservation $tour_reservation)
    {
        $local = $tour_reservation->tour->branchOffice;
        $owner = $local->company->owner;
        $client = $tour_reservation->client;
        $view = 'emails.notifications.new_tour_reservation_owner';
        $data = ['client' => $client, 'local' => $local, 'tour' => $tour_reservation->tour];
        $subject = 'Reservación para tour '.$tour_reservation->tour->title;
        $email_to = [$owner->email, $local->email];

        $this->sendTo($email_to, $subject, $view, $data);
    }

    public function sendReservationTourStatusOwner(TourReservation $tour_reservation, $status = 'rejected')
    {
        $local = $tour_reservation->tour->branchOffice;
        $owner = $local->company->owner;
        $client = $tour_reservation->client;
        $view = 'emails.notifications.reservation_tour_status_owner';
        $data = [
            'client' => $client, 
            'local' => $local, 
            'reservation' => $tour_reservation->tour, 
            'status' => ($status == 'rejected') ? 'CANCELADO' : 'APROBADO'
        ];
        if($status == 'rejected') {
            $subject = 'Se ha cancelado una reservación de su tour';
        } else {
            $subject = 'Se ha aprobado una reservación de su tour';
        }

        $this->sendTo($owner->email, $subject, $view, $data);
    }
}