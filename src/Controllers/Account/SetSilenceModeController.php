<?php

namespace Helldar\Vk\Controllers\Account;

use Helldar\Vk\Controllers\Controller;

/**
 * Mutes push notifications for the set period of time.
 *
 * @see     https://vk.com/dev/account.setSilenceMode
 *
 * @author  Andrey Helldar <helldar@ai-rus.com>
 */
class SetSilenceModeController extends Controller
{
    /**
     * Available method parameters.
     *
     * @var array
     */
    protected $parameters = array('device_id', 'time', 'peer_id', 'sound');
}
