<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\ClientDetailQuestion
 *
 * @property int $client_detail_id
 * @property int $question_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailQuestion whereClientDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailQuestion whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailQuestion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClientDetailQuestion extends Pivot
{
    //
}
