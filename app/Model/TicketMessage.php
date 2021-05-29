<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\TicketMessage
 *
 * @property int $id
 * @property int $ticket_id
 * @property string $message
 * @property string|null $attachment
 * @property int $sender_id
 * @property int $sender_type
 * @property int $seen
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Ticket $ticket
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereSenderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TicketMessage extends Model
{
    protected $fillable = ['ticket_id','message','attachment','sender_id','sender_type','seen'];
    public function user()
    {
        return $this->belongsTo(User::class,'sender_id');
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
