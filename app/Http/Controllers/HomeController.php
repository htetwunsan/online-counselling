<?php

namespace App\Http\Controllers;

use App\Models\CounsellorDetail;
use App\Models\PreferLanguage;
use App\Models\Service;
use App\Models\Speciality;
use App\Repositories\CounsellorRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, CounsellorRepository $cr)
    {
        $allSpecialities = Speciality::all();
        $allServices = Service::all();
        $allPreferLanguages = PreferLanguage::all();

        if (empty($request->sort)) {
            $request->sort = 'most_relavant';
        }

        $request->validate([
            'sort' => ['in:most_relavant,most_irrelevant'],
            'specialities.*' => [Rule::in($allSpecialities->pluck('id')), 'integer'],
            'services.*' => [Rule::in($allServices->pluck('id')), 'integer'],
            'languages.*' => [Rule::in($allPreferLanguages->pluck('id')), 'integer']
        ]);

        $sort = $request->sort;
        $checkedSpecialities = collect($request->specialities);
        $checkedServices = collect($request->services);
        $checkedPreferLanguages = collect($request->languages);

        $recommend = $checkedSpecialities->isEmpty() && $checkedServices->isEmpty() && $checkedServices->isEmpty();

        if ($recommend) {
            $d = Auth::user()->detail;
            $checkedSpecialities = $d->specialities()->pluck('id');
            $checkedServices = $d->services()->pluck('id');
            $checkedPreferLanguages = $d->preferLanguages()->pluck('id');
        }

        $specialities = $cr->calculateSpecialities($allSpecialities, $checkedSpecialities);
        $services = $cr->calculateServices($allServices, $checkedServices);
        $preferLanguages = $cr->calculatePreferLanguages($allPreferLanguages, $checkedPreferLanguages);

        $counsellors = $cr->paginateCounsellors($checkedSpecialities, $checkedServices, $checkedPreferLanguages, $sort);

        return view('home', compact('specialities', 'services', 'preferLanguages', 'counsellors', 'sort'));
    }
}
