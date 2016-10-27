<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotificationCollection;

class DatabaseNotification extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notifications';

    /**
     * The guarded attributes on the model.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];

    public function associatedTo($notifiable)
    {
        return $this->notifiable_id == $notifiable->id && $this->notifiable_type == get_class($notifiable);
    }

    public function getKeyAttribute()
    {
        return snake_case(class_basename($this->type), '-');
    }

    public function getDescriptionAttribute()
    {
        return trans('notifications.'.$this->key, $this->data);
    }

    public function getIsNewAttribute()
    {
        return $this->read_at == null;
    }

    public function getUrlAttribute()
    {
        return url('notifications/'.$this->id);
    }

    public function getDateAttribute()
    {
        return $this->created_at->format('d/m/Y H:ia');
    }

    public function getRedirectUrlAttribute()
    {
        return $this->data['redirect_url'];
    }
    /**
     * Get the notifiable entity that the notification belongs to.
     */
    public function notifiable()
    {
        return $this->morphTo();
    }

    /**
     * Mark the notification as read.
     *
     * @return void
     */
    public function markAsRead()
    {
        if (is_null($this->read_at)) {
            $this->forceFill(['read_at' => $this->freshTimestamp()])->save();
        }
    }

    /**
     * Create a new database notification collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Notifications\DatabaseNotificationCollection
     */
    public function newCollection(array $models = [])
    {
        return new DatabaseNotificationCollection($models);
    }
}
