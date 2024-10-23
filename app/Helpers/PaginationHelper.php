<?php

namespace App\Helpers;

class PaginationHelper
{
    public static function paginate(array $items, int $perPage = 10)
    {
        $currentPage = request()->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $pagedItems = array_slice($items, $offset, $perPage);
        $total = count($items);

        return [
            'data' => $pagedItems,
            'meta' => [
                'current_page' => $currentPage,
                'last_page' => ceil($total / $perPage),
                'per_page' => $perPage,
                'total' => $total,
            ]
        ];
    }
}
