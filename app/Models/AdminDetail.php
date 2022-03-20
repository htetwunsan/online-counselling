<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdminDetail
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\AdminDetailFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|AdminDetail whereUserId($value)
 */
class AdminDetail extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];
}
