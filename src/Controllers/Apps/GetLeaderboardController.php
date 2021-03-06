<?php

namespace Helldar\Vk\Controllers\Apps;

use Helldar\Vk\Controllers\Controller;

/**
 * Returns players rating in the game.
 *
 * @see    https://vk.com/dev/apps.getLeaderboard
 *
 * @author Andrey Helldar <helldar@ai-rus.com>
 */
class GetLeaderboardController extends Controller
{
    /**
     * Available method parameters.
     *
     * @var array
     */
    protected $parameters = array('type', 'global', 'extended');
}
