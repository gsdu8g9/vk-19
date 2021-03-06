<?php

namespace Helldar\Vk\Controllers\Ads;

use Helldar\Vk\Controllers\Controller;

/**
 * Returns a list of campaigns in an advertising account.
 *
 * @see    https://vk.com/dev/ads.getCampaigns
 *
 * @author Andrey Helldar <helldar@ai-rus.com>
 */
class GetCampaignsController extends Controller
{
    /**
     * Available method parameters.
     *
     * @var array
     */
    protected $parameters = array('account_id', 'client_id', 'include_deleted', 'campaign_ids');
}
