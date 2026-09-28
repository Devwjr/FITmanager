import { browser } from '$app/environment';
import { PUBLIC_API_URL } from '$env/static/public';

import axios from 'axios';
import { get } from 'svelte/store';
import { page } from '$app/stores';

export const getErrorMessage = (
	/** @type {{ message: any; response: { data: { message: any; }; }; }} */ error
) => {
	let message = error.message;

	if (error && error.response && error.response.data && error.response.data.message) {
		message = error.response.data.message;
	}

	return message;
};

export const getBearerToken = () => {
	if (browser) {
        const token = get(page).data.token;
        if (token) return `Bearer ${token}`;
		const cookies = document.cookie.split(';');
		for (const cookie of cookies) {
			const [name, value] = cookie.trim().split('=');
			if (name === 'token' && value) {
				return `Bearer ${decodeURIComponent(value)}`;
			}
		}
	}
	return undefined;
};

export const useApi = (headers = {}) => {
	return axios.create({ headers, baseURL: PUBLIC_API_URL + '/api' });
};
