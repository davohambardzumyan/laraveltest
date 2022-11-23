<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketCreateRequest;
use App\Services\TicketService;
use App\Services\UserService;

class TicketController extends Controller
{
    /**
     * Get tickets
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $ticketService = new TicketService();

        return $ticketService->index();
    }

    /**
     * Get user list with roles
     *
     * @return mixed
     */
    public function getAllUsers(): mixed
    {
        $userService = new UserService();

        return response()->json($userService->getAllUsers());
    }

    /**
     * Store new ticket
     *
     * @param TicketCreateRequest $request
     * @param TicketService $ticketService
     * @return mixed
     */
    public function store(TicketCreateRequest $request, TicketService $ticketService): mixed
    {
        return $ticketService->store($request);
    }
}
