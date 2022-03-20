<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\CounsellorDetailPreferLanguage
 *
 * @property int $counsellor_detail_id
 * @property int $prefer_language_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailPreferLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailPreferLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailPreferLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailPreferLanguage whereCounsellorDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailPreferLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailPreferLanguage wherePreferLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CounsellorDetailPreferLanguage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CounsellorDetailPreferLanguage extends Pivot
{
    //
}
