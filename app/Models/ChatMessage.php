<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ChatMessage
 *
 * @property int $id
 * @property string $author_name 傳送者名稱
 * @property string $message 訊息內容
 * @property string $lang 語言代碼
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static Builder|ChatMessage newModelQuery()
 * @method static Builder|ChatMessage newQuery()
 * @method static Builder|ChatMessage query()
 * @method static Builder|ChatMessage whereAuthorName($value)
 * @method static Builder|ChatMessage whereCreatedAt($value)
 * @method static Builder|ChatMessage whereId($value)
 * @method static Builder|ChatMessage whereLang($value)
 * @method static Builder|ChatMessage whereMessage($value)
 * @method static Builder|ChatMessage whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_name',
        'message',
        'lang',
    ];
}
