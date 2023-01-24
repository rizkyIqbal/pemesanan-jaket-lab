<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Bank
 *
 * @property int $id
 * @property string $bank
 * @property string $name
 * @property string $account_number
 * @property string $generation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereGeneration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperBank {}
}

namespace App\Models{
/**
 * App\Models\Countdown
 *
 * @property int $id
 * @property string $name
 * @property string $started_at
 * @property string $finish_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Countdown newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Countdown newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Countdown query()
 * @method static \Illuminate\Database\Eloquent\Builder|Countdown whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Countdown whereFinishAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Countdown whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Countdown whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Countdown whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Countdown whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperCountdown {}
}

namespace App\Models{
/**
 * App\Models\Jacket
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $custom_price
 * @property string $image
 * @property string $image2
 * @property string $image_size_chart
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Jacket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jacket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jacket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Jacket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jacket whereCustomPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jacket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jacket whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jacket whereImage2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jacket whereImageSizeChart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jacket whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jacket wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jacket whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperJacket {}
}

namespace App\Models{
/**
 * App\Models\Size
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stock[] $stock
 * @property-read int|null $stock_count
 * @method static \Illuminate\Database\Eloquent\Builder|Size newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Size newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Size query()
 * @method static \Illuminate\Database\Eloquent\Builder|Size whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Size whereName($value)
 * @mixin \Eloquent
 */
	class IdeHelperSize {}
}

namespace App\Models{
/**
 * App\Models\Stock
 *
 * @property int $id
 * @property int $stock
 * @property int $size_id
 * @property-read \App\Models\Size $size
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereStock($value)
 * @mixin \Eloquent
 */
	class IdeHelperStock {}
}

namespace App\Models{
/**
 * App\Models\Timeline
 *
 * @property int $id
 * @property int $track_id
 * @property int $transaction_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Timeline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timeline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timeline query()
 * @method static \Illuminate\Database\Eloquent\Builder|Timeline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timeline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timeline whereTrackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timeline whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timeline whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperTimeline {}
}

namespace App\Models{
/**
 * App\Models\Track
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Track newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Track newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Track query()
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereName($value)
 * @mixin \Eloquent
 */
	class IdeHelperTrack {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $jacket_id
 * @property int $size_id
 * @property string|null $custom
 * @property string $user_id
 * @property string $phone_number
 * @property int $price
 * @property int|null $bank_id
 * @property string|null $transfer_from
 * @property string|null $proof
 * @property int $track_id
 * @property int $status
 * @property int $order_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Track $track
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCustom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereJacketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereProof($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTrackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransferFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperTransaction {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperUser {}
}

