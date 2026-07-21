import { PUBLIC_API_URL } from '$env/static/public';

/** @param {string|null|undefined} avatar */
export const getAvatarUrl = (avatar) => {
	return PUBLIC_API_URL + avatar;
};
