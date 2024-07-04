<?php

namespace App\Http\Filters\V1;

use App\Http\Filters\V1\QueryFilter;

class AuthorFilter extends QueryFilter
{

    protected $sortable = [
        'name',
        'email',
        'createdAt' => 'created_at'
    ];

    public function include($value)
    {
        return $this->builder->with($value);
    }

    public function id($value)
    {
        // allows for multiple values in a filter 
        // ?filter[id]=1,2
        return $this->builder->whereIn('id', explode(',', $value));
    }

    public function email($value)
    {
        // allows for ?filter[email]=*eum*
        // you don't need to know the full email
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('email', 'like', $likeStr);
    }


    public function name($value)
    {
        // allows for ?filter[name]=*eum*
        // you don't need to know the full name
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('name', 'like', $likeStr);
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
