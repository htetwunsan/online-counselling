<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\ClientDetailSpeciality
 *
 * @property int $client_detail_id
 * @property int $speciality_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailSpeciality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailSpeciality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailSpeciality query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailSpeciality whereClientDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailSpeciality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailSpeciality whereSpecialityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailSpeciality whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClientDetailSpeciality extends Pivot
{
    //
}
