<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\ClientDetailPreferLanguage
 *
 * @property int $client_detail_id
 * @property int $prefer_language_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailPreferLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailPreferLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailPreferLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailPreferLanguage whereClientDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailPreferLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailPreferLanguage wherePreferLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDetailPreferLanguage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClientDetailPreferLanguage extends Pivot
{
    //
}
