<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClientDetail
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ClientDetailFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $checkedQuestions
 * @property-read int|null $checked_questions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PreferLanguage[] $preferLanguages
 * @property-read int|null $prefer_languages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Service[] $services
 * @property-read int|null $services_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Speciality[] $specialities
 * @property-read int|null $specialities_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetail whereUserId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 */
class ClientDetail extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class)->using(ClientDetailQuestion::class);
    }

    public function specialities()
    {
        return $this->belongsToMany(Speciality::class)->using(ClientDetailSpeciality::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, ClientDetailService::class);
    }

    public function preferLanguages()
    {
        return $this->belongsToMany(PreferLanguage::class, ClientDetailPreferLanguage::class);
    }

    public function hasBooked(CounsellorDetail $counsellor)
    {
        return Booking::whereBookerId($this->user_id)->whereBookedId($counsellor->user_id)->exists();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'booker_id', 'user_id');
    }
}
