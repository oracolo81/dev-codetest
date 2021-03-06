<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Helpers\AffiliatesHelper;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class AffiliatesController extends BaseController
{
    public const FILE_NAME = 'updated-affiliates.txt';
    public const MAX_DISTANCE = 100;
    public const OFFICE_LAT = 53.3340285;
    public const OFFICE_LON = -6.2535495;
    public const SHOW_ALL = false; // true to show all the records
    public const SORT_BY = 'affiliate_id'; // can be sorted by affiliate_id|name|distance
    public const ORDER = 'asc'; // asc|desc

    private $affiliates = [];

    // Controller method definition...
    public function show()
    {
        $affiliates = AffiliatesHelper::loadJson(self::FILE_NAME);

        if (empty($affiliates)) {
            return view('error', ['error' => AffiliatesHelper::getError()]);
        }

        foreach ($affiliates as $affiliate) {
            $distance = AffiliatesHelper::distance(self::OFFICE_LAT, self::OFFICE_LON, $affiliate->latitude, $affiliate->longitude);
            $affiliate->distance = $distance;
            if (self::SHOW_ALL) {
                $this->affiliates[] = $affiliate;
            } else {
                if ($distance <= self::MAX_DISTANCE) {
                    $this->affiliates[] = $affiliate;
                }
            }

            $this->affiliates = AffiliatesHelper::sortBy($this->affiliates, self::SORT_BY, self::ORDER);
            $data = $this->paginate($this->affiliates);
        }

        return view('affiliates', ['affiliates' => $data]);
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
