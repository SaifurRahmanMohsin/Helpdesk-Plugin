<?php namespace Mohsin\Helpdesk\Components;

use Auth;
use Validator;
use ValidationException;
use Cms\Classes\ComponentBase;
use Mohsin\Helpdesk\Models\Ticket;

class Tickets extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Tickets',
            'description' => 'User ticket management section.'
        ];
    }

    public function onRun()
    {
        /*
         * Get user login
         */
        if (!$user = $this->user())
          return;

        $this -> page['tickets'] = $user -> tickets;
    }

    public function onTicketCreate()
    {
        /*
         * Get user login
         */
        if (!$user = $this->user())
          return;

        /*
         * Validate input
         */
        $data = post();
        $rules = [
            'subject'    => 'required',
            'message'    => 'required|min:20',
        ];

        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        /*
         * Add the ticket to the user model
         */
        $ticket = new Ticket;
        $ticket -> user_id = $user -> id;
        $ticket -> subject = post('subject');
        $ticket -> notes = post('message');

        $user -> tickets() -> save($ticket);

        /*
         * Push updates to client-side browser
         */
        $this -> page['tickets'] = $user -> tickets;
        return ['#ticketList' => $this->renderPartial('@list')];
    }

    /**
     * Returns the logged in user, if available
     */
    public function user()
    {
        if (!Auth::check())
            return null;
        return Auth::getUser();
    }

}
