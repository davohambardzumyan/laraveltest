<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\TicketCreateRequest;
use App\Http\Resources\TicketResource;
use App\Mail\TicketMail;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $tickets = Ticket::createdByAuthUser()->with('creator')->with('users')->get();
            return TicketResource::collection($tickets);
        } else {
            dd(2);
        }
    }

    public function getAllUsers()
    {
        return User::where('role', UserRole::USER)->get();
    }

    public function create(TicketCreateRequest $request)
    {
        $ticket = Ticket::create(array_merge($request->only((new Ticket())->getFillable()), ['creator_id' => auth()->id()]));

        $users = User::find($request->users);

        $ticket->users()->attach($users);

        foreach ($users as $key => $user) {
            Mail::to($user->email)->send(new TicketMail($user,request()->input('subject'),request()->input('content')));
        }

        return true;
    }
}
