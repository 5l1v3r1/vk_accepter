<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static updateOrCreate(array $array, array $array1)
 * @property string post_type
 * @property \App\Group group
 * @property  int|null user_id
 * @property \stdClass object
 * @property int post_id
 */
class Post extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'post_type' => 'suggested',
    ];


    /**
     * Get the group that owns the post.
     */
    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id', 'vk_group_id');
    }


    public static function postTypeMapper(string $in)
    {
        switch ($in) {
            case 'suggest':
                return 'suggested';
            case 'post':
                return 'to_update';

        }
        return '';
    }


    /**
     * Get the attachment string.
     *
     * @return string
     */
    public function getAttachmentAttribute()
    {
        return "wall-{$this->group->vk_group_id}_{$this->post_id}";
    }


}
