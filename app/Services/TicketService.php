<?php

namespace App\Services;

use App\Http\Resources\TicketResource;
use App\Mail\TicketMail;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketService
{
    /**
     * Get tickets
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index() {

        if (auth()->user()->isAdmin()) {

            return $this->getTicketsCreatedByAuthUser();
        }

        return $this->getTickets();
    }

    /**
     * Get tickets which created by admin
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    private function getTicketsCreatedByAuthUser(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        $tickets = Ticket::createdByAuthUser()->with('creator')->with('users')->get();

        return TicketResource::collection($tickets);
    }

    /**
     * Get ticket for auth user, which assigned to auth user too
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    private function getTickets(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $tickets = Ticket::whereHas('users', function ($query) {

            return $query->where('users.id', auth()->id());

        })->with('creator')->with('users')->get();

        return TicketResource::collection($tickets);
    }

    /**
     * Store new ticket
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $ticket = Ticket::create(array_merge($request->only((new Ticket())->getFillable()), ['creator_id' => auth()->id()]));

        $users = User::find($request->users);

        $ticket->users()->attach($users);

        $this->sendEmail($users, request()->input('subject'), request()->input('content'));

        return $ticket;
    }

    /**
     * Notify user about new ticket
     *
     * @return void
     */
    private function sendEmail($users, $subject, $content)
    {
        foreach ($users as $user) {
            Mail::to($user->email)->send(new TicketMail($user, $subject, $content));
        }
    }
}
