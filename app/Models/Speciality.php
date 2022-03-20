<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Speciality
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @method static \Database\Factories\SpecialityFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Speciality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Speciality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Speciality query()
 * @method static \Illuminate\Database\Eloquent\Builder|Speciality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speciality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speciality whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speciality whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CounsellorDetail[] $counsellorDetails
 * @property-read int|null $counsellor_details_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClientDetail[] $clientDetails
 * @property-read int|null $client_details_count
 */
class Speciality extends Model
{
    use HasFactory;

    public function questions()
    {
        return $this->belongsToMany(Question::class)->using(QuestionSpeciality::class);
    }

    public function clientDetails()
    {
        return $this->belongsToMany(ClientDetail::class)->using(ClientDetailSpeciality::class);
    }

    public function counsellorDetails()
    {
        return $this->belongsToMany(CounsellorDetail::class)->using(CounsellorDetailSpeciality::class);
    }
}
