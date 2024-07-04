<?php

namespace App\Http\Filters\V1;

use App\Http\Filters\V1\QueryFilter;

class TicketFilter extends QueryFilter
{

    protected $sortable = [
        'title',
        'status',
        'createdAt' => 'created_at'
    ];

    public function include($value)
    {
        return $this->builder->with($value);
    }

    public function status($value)
    {
        // allows for multiple values in a filter 
        // ?filter[status]=C,X
        return $this->builder->whereIn('status', explode(',', $value));
    }

    public function title($value)
    {
        // allows for ?filter[title]=*eum*
        // you don't need to know the specific title
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('title', 'like', $likeStr);
    }

    public function createdAt($value)
    {
        // can filter by multiple dates
        // filter[createdAt]=2024-07-02,2024-07-06
        $dates = explode(',', $value);
        if (count($dates) > 1) {
            return $this->builder->whereBetween('created_at', $dates);
        }
        return $this->builder->whereDate('created_at', $value);
    }

    public function updatedAt($value)
    {
        // can filter by multiple dates
        // filter[updatedAt]=2024-07-02,2024-07-06
        $dates = explode(',', $value);
        if (count($dates) > 1) {
            return $this->builder->whereBetween('updated_at', $dates);
        }
        return $this->builder->whereDate('updated_at', $value);
    }
}
