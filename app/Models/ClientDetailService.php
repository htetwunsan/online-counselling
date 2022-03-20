<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\ClientDetailService
 *
 * @property int $client_detail_id
 * @property int $service_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailService query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailService whereClientDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailService whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailService whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClientDetailService extends Pivot
{
    //
}
