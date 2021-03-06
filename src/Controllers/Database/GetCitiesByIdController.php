<?php

namespace Helldar\Vk\Controllers\Database;

use Helldar\Vk\Controllers\Controller;

/**
 * Returns information about cities by their IDs.
 *
 * @see    https://vk.com/dev/database.getCitiesById
 *
 * @author Andrey Helldar <helldar@ai-rus.com>
 */
class GetCitiesByIdController extends Controller
{
    /**
     * Available method parameters.
     *
     * @var array
     */
    protected $parameters = array('city_ids');
}
