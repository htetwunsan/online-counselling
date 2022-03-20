<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\CounsellorDetailSpeciality
 *
 * @property int $counsellor_detail_id
 * @property int $speciality_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailSpeciality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailSpeciality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailSpeciality query()
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailSpeciality whereCounsellorDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailSpeciality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailSpeciality whereSpecialityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailSpeciality whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CounsellorDetailSpeciality extends Pivot
{
    //
}
