<?php

namespace Helldar\Vk\Controllers\Likes;

/**
 * Checks for the object in the Likes list of the specified user.
 *
 * @see     https://vk.com/dev/likes.isLiked
 *
 * @author  Andrey Helldar <helldar@ai-rus.com>
 */
class IsLikedController
{
    /**
     * Available method parameters.
     *
     * @var array
     */
    protected $parameters = array('user_id', 'type', 'owner_id', 'item_id');
}
