<?php namespace RainLab\User\Classes;

use App;
use Illuminate\Routing\Redirector;

class UserRedirector extends Redirector
{
    /**
     * Create a new redirect response, while putting the current URL in the session.
     *
     * @param  string  $path
     * @param  int     $status
     * @param  array   $headers
     * @param  bool    $secure
     * @return \Illuminate\Http\RedirectResponse
     */
    public function guest($path, $status = 302, $headers = [], $secure = null)
    {
        $sessionKey = App::runningInBackend() ? 'url.intended' : 'url.frontend.intended';
        $this->session->put($sessionKey, $this->generator->full());

        return $this->to($path, $status, $headers, $secure);
    }

    /**
     * Create a new redirect response to the previously intended location.
     *
     * @param  string  $default
     * @param  int     $status
     * @param  array   $headers
     * @param  bool    $secure
     * @return \Illuminate\Http\RedirectResponse
     */
    public function intended($default = '/', $status = 302, $headers = [], $secure = null)
    {
        $sessionKey = App::runningInBackend() ? 'url.intended' : 'url.frontend.intended';
        $path = $this->session->pull($sessionKey, $default);

        return $this->to($path, $status, $headers, $secure);
    }
}
