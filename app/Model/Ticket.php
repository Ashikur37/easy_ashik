<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Ticket
 *
 * @property int $id
 * @property int $ticket_category_id
 * @property string $subject
 * @property int $status
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\TicketMessage[] $messages
 * @property-read int|null $messages_count
 * @property-read \App\Model\TicketCategory $ticketCategory
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereTicketCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUserId($value)
 * @mixin \Eloquent
 */
class Ticket extends Model
{
    protected $fillable = ['ticket_category_id','subject','status','user_id'];
    public function ticketCategory()
    {
        return $this->belongsTo(TicketCategory::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }
}
