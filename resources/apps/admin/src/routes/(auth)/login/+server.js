import axios from 'axios';
import { json } from '@sveltejs/kit';
import { useApi } from '$lib/api.js';
export const POST = async ({ request, cookies, url }) => {
	try {
		const { data } = await useApi().post('/auth/login', await request.json());
		if (!data.user?.is_admin)
			return json({ message: 'Acesso permitido apenas ao administrador.' }, { status: 403 });
		cookies.set('token', data.access_token, {
			path: '/',
			httpOnly: true,
			secure: url.protocol === 'https:',
			sameSite: 'lax'
		});
		return json({ success: true });
	} catch (error) {
		const response = axios.isAxiosError(error) ? error.response : undefined;
		return json(
			{ message: response?.data?.message || 'Não foi possível acessar o servidor.' },
			{ status: response?.status || 502 }
		);
	}
};
