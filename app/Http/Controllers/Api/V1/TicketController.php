<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Ticket;
use App\Http\Filters\V1\TicketFilter;
use App\Http\Resources\V1\TicketResource;
use App\Http\Requests\Api\V1\UpdateTicketRequest;

class TicketController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(TicketFilter $filters)
    {
        // This array tells the QueryFilter/Filter function what can be included
        // ?filter[status]=C&include=author
        [
            'include' => 'author',
            'filter' => [
                'status' => 'C',
                'title' => 'title filter',
                'createdAt' => ''
            ]
        ];

        return TicketResource::collection(Ticket::filter($filters)->paginate());
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        if ($this->include('author')) {
            return new TicketResource($ticket->load('user'));
        }
        return new TicketResource($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
