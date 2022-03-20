<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CounsellorDetail
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CounsellorDetailFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @property string $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PreferLanguage[] $preferLanguages
 * @property-read int|null $prefer_languages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Service[] $services
 * @property-read int|null $services_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Speciality[] $specialities
 * @property-read int|null $specialities_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetail whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetail whereUserId($value)
 * @property string $summary
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetail whereSummary($value)
 * @property-read \App\Models\Image|null $latestImage
 */
class CounsellorDetail extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function latestImage()
    {
        return $this->morphOne(Image::class, 'imageable')->latestOfMany();
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function specialities()
    {
        return $this->belongsToMany(Speciality::class)->using(CounsellorDetailSpeciality::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class)->using(CounsellorDetailService::class);
    }

    public function preferLanguages()
    {
        return $this->belongsToMany(PreferLanguage::class)->using(CounsellorDetailPreferLanguage::class);
    }

    public function bookedBy(ClientDetail $client)
    {
        return Booking::whereBookerId($client->user_id)->whereBookedId($this->user_id)->exists();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'booked_id', 'user_id');
    }
}
