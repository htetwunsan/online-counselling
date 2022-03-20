<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\QuestionSpeciality
 *
 * @property int $question_id
 * @property int $speciality_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionSpeciality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionSpeciality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionSpeciality query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionSpeciality whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionSpeciality whereSpecialityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionSpeciality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionSpeciality whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class QuestionSpeciality extends Pivot
{
    //
}
