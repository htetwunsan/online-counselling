<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\CounsellorDetailService
 *
 * @property int $counsellor_detail_id
 * @property int $service_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailService query()
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailService whereCounsellorDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailService whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailService whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CounsellorDetailService extends Pivot
{
    //
}
