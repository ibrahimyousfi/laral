/**
 * Bootstrap JS: Axios and global defaults for HTTP requests.
 */
import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
