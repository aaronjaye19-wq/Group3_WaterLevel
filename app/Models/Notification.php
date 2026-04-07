<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'message',
        'read',
    ];

    protected $casts = [
        'read' => 'boolean',
    ];

    /**
     * Get the user that owns this notification
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get unread notifications for a user
     */
    public static function getUnreadForUser($userId)
    {
        return self::where('user_id', $userId)
            ->where('read', false)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Mark notification as read
     */
    public function markAsRead()
    {
        $this->update(['read' => true]);
    }

    /**
     * Create a login notification
     */
    public static function createLoginNotification($userId)
    {
        return self::create([
            'user_id' => $userId,
            'type' => 'login',
            'message' => 'You have successfully logged in.',
            'read' => false,
        ]);
    }
}
