<?php

namespace Helldar\Vk\Controllers;

use BadMethodCallException;
use Helldar\Vk\Jobs\ProcessVkQueue;
use Helldar\Vk\Models\VkRequest;
use Helldar\Vk\Models\VkUser;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    /**
     * @var
     */
    protected $user;

    /**
     * @var null|string
     */
    protected $method = null;

    /**
     * Available parameters.
     *
     * @var array
     */
    protected $parameters = array();

    /**
     * @var array
     */
    protected $params = array();

    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * @author Andrey Helldar <helldar@ai-rus.com>
     *
     * @since  2017-03-29
     *
     * @param string|null $method
     *
     * @return $this
     */
    public function start($method = null)
    {
        $this->method = trim($method);

        return $this;
    }

    /**
     * Add request to queue with return ID of new row.
     *
     * @author Andrey Helldar <helldar@ai-rus.com>
     *
     * @since  2017-03-29
     *
     * @return mixed
     */
    public function send()
    {
        $item = VkRequest::firstOrNew(array(
            'user_id' => $this->user->id,
            'method' => $this->method,
        ));

        $item->request = $this->makeParams();
        $item->response = null;
        $item->deleted_at = null;
        $item->save();

        // Add to queue.
        dispatch(new ProcessVkQueue($item));

        return $item->id;
    }

    /**
     * Get base params.
     *
     * @author Andrey Helldar <helldar@ai-rus.com>
     *
     * @since  2017-03-29
     *
     * @return array
     */
    private function makeParams()
    {
        $user = VkUser::whereUserId($this->user->id)->first();

        return json_encode(array_merge($this->params, array(
            'access_token' => $user->access_token,
            'v' => config('vk.version', 5.63),
        )));
    }

    /**
     * Check and receive a response.
     *
     * @author Andrey Helldar <helldar@ai-rus.com>
     *
     * @since  2017-03-29
     *
     * @return null|string
     */
    public function get()
    {
        $item = VkRequest::whereUserId($this->user->id)->whereMethod($this->method)->first();

        if (is_null($item) || !$this->is_success) {
            return null;
        }

        $item->delete();

        return $item->response;
    }

    /**
     * @author Andrey Helldar <helldar@ai-rus.com>
     *
     * @since  2017-03-29
     *
     * @param $param
     * @param $parameters
     *
     * @return $this
     */
    public function __call($param, $parameters)
    {
        if (!in_array(snake_case($param), $this->parameters)) {
            throw new BadMethodCallException("Param [{$param}] does not exist.");
        }

        $this->setParameter(snake_case($param), $parameters[0]);

        return $this;
    }

    /**
     * Set a parameter.
     *
     * @author Andrey Helldar <helldar@ai-rus.com>
     *
     * @since  2017-03-29
     *
     * @param string     $parameter
     * @param null|mixed $value
     */
    protected function setParameter($parameter, $value = null)
    {
        if (gettype($value) == 'array' || gettype($value) == 'object') {
            $value = implode(',', $value);
        }

        $this->params[$parameter] = $value;
    }
}
