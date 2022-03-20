<?php

namespace App\Repositories;

use App\Models\CounsellorDetail;
use App\Models\PreferLanguage;
use App\Models\Service;
use App\Models\Speciality;
use Illuminate\Pagination\LengthAwarePaginator;

class CounsellorRepository
{

    public function calculateSpecialities($allSpecialities, $checked)
    {
        return $allSpecialities->each(function (Speciality $s) use ($checked) {
            $s->setAttribute('checked', $checked->contains($s->id));
        });
    }

    public function calculateServices($allServices, $checked)
    {
        return $allServices->each(function (Service $s) use ($checked) {
            $s->setAttribute('checked', $checked->contains($s->id));
        });
    }

    public function calculatePreferLanguages($allPreferLanguages, $checked)
    {
        return $allPreferLanguages->each(function (PreferLanguage $pl) use ($checked) {
            $pl->setAttribute('checked', $checked->contains($pl->id));
        });
    }

    public function paginateCounsellors($specialities, $services, $preferLanguages, $sort)
    {
        $counsellorDetails = CounsellorDetail::whereHas('specialities', function ($query) use ($specialities) {
            $query->whereIn('id', $specialities);
        })->orWhereHas('services', function ($query) use ($services) {
            $query->whereIn('id', $services);
        })->orWhereHas('preferLanguages', function ($query) use ($preferLanguages) {
            $query->whereIn('id', $preferLanguages);
        })->with(['user', 'latestImage', 'specialities', 'services', 'preferLanguages'])->get();

        foreach ($counsellorDetails as $detail) {
            $detail->rank += $detail->specialities->pluck('id')->merge($specialities)->duplicates()->count();
            $detail->rank += $detail->services->pluck('id')->merge($services)->duplicates()->count();
            $detail->rank += $detail->preferLanguages->pluck('id')->merge($preferLanguages)->duplicates()->count();
        }

        if ($sort === 'most_relavant') {
            $sorted = $counsellorDetails->sortByDesc('id')->sortByDesc('rank');
        } else {
            $sorted = $counsellorDetails->sortBy('id')->sortBy('rank');
        }

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;

        return new LengthAwarePaginator($sorted->forPage($page, $perPage), $sorted->count(), $perPage);
    }
}
