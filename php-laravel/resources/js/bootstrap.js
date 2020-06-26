import axios from 'axios'

/**
 * When using the Server Side Rendering option. 'window' is unavailable
 * during the SSR, so any 'window' actions must first be checked to see
 * if it is actually undefined
 */
if (typeof window !== 'undefined') {
    /**
     * We'll load the axios HTTP library which allows us to easily issue requests
     * to our Laravel back-end. This library automatically handles sending the
     * CSRF token as a header based on the value of the "XSRF" token cookie.
     */
    window.axios = axios;

    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
}
