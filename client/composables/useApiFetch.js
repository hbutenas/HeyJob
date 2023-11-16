import {useFetch} from "#app";

export function useApiFetch(path, options) {
    let headers = {
        // 'Accept': 'application/json'
    };

    const token = useCookie('XSRF-TOKEN');

    if (token.value) {
        headers['X-XSRF-TOKEN'] = token.value;
    }

    return useFetch('http://localhost:5000' + path, {
        credentials: 'include',
        watch: false,
        ...options,
        headers: {
            ...headers
        }
    });
}
