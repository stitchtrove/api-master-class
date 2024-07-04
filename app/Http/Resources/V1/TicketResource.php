<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{

    // public static $wrap = 'ticket';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'ticket',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'description' => $this->when(
                    $request->routeIs('api.v1.tickets.show'), // only include when on the show route
                    $this->description,
                ),
                'status' => $this->status,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at
            ],
            'relationships' => [
                'author' => [
                    'data' => [
                        'type' => 'user',
                        'id' => $this->user_id
                    ],
                    'links' => [
                        'self' => route('api.v1.authors.show', ['author' => $this->user_id])
                    ]
                ]
            ],
            'includes' => new UserResource($this->whenLoaded('author')), // only include when a relationship is requested
            'links' => [
                'self' => route('api.v1.tickets.show', ['ticket' => $this->id])
            ]
        ];
    }
}
