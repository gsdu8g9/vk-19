<?php

namespace Helldar\Vk\Controllers\Account;

use Helldar\Vk\Controllers\Controller;

/**
 * Adds user to the banlist.
 *
 * @see     https://vk.com/dev/account.banUser
 *
 * @author  Andrey Helldar <helldar@ai-rus.com>
 */
class BanUserController extends Controller
{
    /**
     * Available method parameters.
     *
     * @var array
     */
    protected $parameters = array('user_id');
}
