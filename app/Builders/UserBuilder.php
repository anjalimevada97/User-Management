<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
    public function whereName($name)
    {
        return $this->where('name', 'LIKE', '%'.$name.'%');
    }

    public function whereEmail($email)
    {
        return $this->where('email', 'LIKE', '%'.$email.'%');
    }

    public function whereStatus($status)
    {
        return $this->where('status', $status);
    }

    public function whereSearch($search)
    {
        foreach (explode(' ', $search) as $term) {
            $this->where(function ($builder) use ($term): void {
                $builder->where('name', 'LIKE', '%'.$term.'%')
                    ->orWhere('email', 'LIKE', '%'.$term.'%');
            });
        }

        return $this;
    }

    public function whereOrder($orderByField, $orderBy)
    {
        return $this->orderBy($orderByField, $orderBy);
    }

    public function applyFilters(array $filters)
    {
        $filters = collect($filters);

        if ($filters->get('search')) {
            $this->whereSearch($filters->get('search'));
        }

        if ($filters->get('name')) {
            $this->whereName($filters->get('name'));
        }

        if ($filters->get('email')) {
            $this->whereEmail($filters->get('email'));
        }

        if ($filters->get('status')) {
            $this->whereStatus($filters->get('status'));
        }

        if ($filters->get('orderByField') || $filters->get('orderBy')) {
            $field = $filters->get('orderByField') ? $filters->get('orderByField') : 'created_at';
            $orderBy = $filters->get('orderBy') ? $filters->get('orderBy') : 'asc';
            $this->whereOrder($field, $orderBy);
        }

        return $this;
    }
}
