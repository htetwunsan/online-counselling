<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PreferLanguage
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PreferLanguageFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PreferLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PreferLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PreferLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder|PreferLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PreferLanguage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PreferLanguage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PreferLanguage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PreferLanguage extends Model
{
    use HasFactory;

    public function clientDetails()
    {
        return $this->belongsToMany(ClientDetail::class)->using(ClientDetailPreferLanguage::class);
    }

    public function counsellorDetails()
    {
        return $this->belongsToMany(CounsellorDetail::class)->using(CounsellorDetailPreferLanguage::class);
    }
}
