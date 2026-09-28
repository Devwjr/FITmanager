<script>
	import { goto } from '$app/navigation';
	import { getBearerToken, getErrorMessage, useApi } from '$lib/api';
	import { getAvatarUrl } from '$lib/avatar';
	import { useToast } from '$lib/toast';
	import { Avatar, FileButton } from '@skeletonlabs/skeleton';
	import { onMount } from 'svelte';

	const api = useApi({
		Authorization: getBearerToken()
	});

	const toast = useToast();

	const title = 'Minha Conta';

	let loading = $state(false);

	let user = $state({});

	let active = $state('profile');

	let profileFields = $state({
		name: '',
		email: '',
		contact_number: '',
		address: '',
		city: '',
		state: '',
		country: '',
		postcode: ''
	});

	let securityFields = $state({
		password: '',
		password_confirmation: ''
	});

	const loadUser = async () => {
		loading = true;
		try {
			const response = await api.get('/me');
			user = response.data;
			profileFields = {
				name: user.name || '',
				email: user.email || '',
				contact_number: user.profile?.contact_number || '',
				address: user.profile?.address || '',
				city: user.profile?.city || '',
				state: user.profile?.state || '',
				country: user.profile?.country || '',
				postcode: user.profile?.postcode || ''
			};
		} catch (error) {
			toast.trigger({
				message: getErrorMessage(error),
				background: 'variant-filled-error'
			});
		} finally {
			loading = false;
		}
	};

	const onProfileSubmit = (event) => {
		event.preventDefault();
		loading = true;

		api.put(`/users/${user.id}`, profileFields)
			.then(() => {
				toast.trigger({
					message: 'Perfil atualizado com sucesso',
					background: 'variant-filled-success'
				});
			})
			.catch((error) => {
				toast.trigger({
					message: getErrorMessage(error),
					background: 'variant-filled-error'
				});
			})
			.finally(() => (loading = false));
	};

	const onSecuritySubmit = (event) => {
		event.preventDefault();
		loading = true;

		api.put(`/users/${user.id}`, securityFields)
			.then(() => {
				toast.trigger({
					message: 'Senha atualizada com sucesso',
					background: 'variant-filled-success'
				});
				securityFields = { password: '', password_confirmation: '' };
			})
			.catch((error) => {
				toast.trigger({
					message: getErrorMessage(error),
					background: 'variant-filled-error'
				});
			})
			.finally(() => (loading = false));
	};

	const onAvatarChange = (event) => {
		if (event.target.files && event.target.files.length) {
			const file = event.target.files[0];
			const form = new FormData();
			form.append('avatar', file);
			loading = true;
			api.post(`/users/${user.id}/avatar`, form)
				.then((response) => {
					user.avatar = response.data.path;
					toast.trigger({
						message: 'Avatar atualizado com sucesso',
						background: 'variant-filled-success'
					});
				})
				.catch((error) => {
					toast.trigger({
						message: getErrorMessage(error),
						background: 'variant-filled-error'
					});
				})
				.finally(() => (loading = false));
		}
	};

	const onNavItemClicked = (next) => (event) => {
		event.preventDefault();
		active = next;
	};

	onMount(() => {
		loadUser();
	});
</script>

<svelte:head>
	<title>{title}</title>
</svelte:head>

<div class="px-6 py-6">
	<div class="card flex min-h-screen flex-row items-stretch rounded-lg bg-white shadow-md">
		<div class="user-sidebar">
			<div class="justify-cente flex items-center justify-center py-8">
				<Avatar
					src={user.avatar ? getAvatarUrl(user.avatar) : undefined}
					initials={user.initial}
					width="w-32"
					rounded="rounded-full"
				/>
			</div>
			<nav class="user-nav list-nav">
				<ul>
					<li>
						<a
							class={active === 'profile' ? 'active' : ''}
							onclick={onNavItemClicked('profile')}
							href="/">Perfil</a
						>
					</li>
					<li>
						<a
							class={active === 'security' ? 'active' : ''}
							onclick={onNavItemClicked('security')}
							href="/">Segurança</a
						>
					</li>
				</ul>
			</nav>
		</div>
		<div class="flex-1">
			<div class="px-6 py-6">
				{#if active === 'profile'}
					<h3 class="h3 mb-4">Meu Perfil</h3>
					<form action="" onsubmit={onProfileSubmit}>
						<div class="mb-6 flex items-center gap-4 pt-4">
							<Avatar
								src={user.avatar ? getAvatarUrl(user.avatar) : undefined}
								initials={user.initial}
								width="w-24"
								rounded="rounded-full"
							/>
							<FileButton
								name="files"
								button="btn btn-sm variant-soft-primary"
								accept="image/*"
								onchange={onAvatarChange}>Alterar Avatar</FileButton
							>
						</div>

						<div class="mb-4">
							<label class="label">
								<span>Nome</span>
								<input
									class="input"
									bind:value={profileFields.name}
									name="name"
									type="text"
									required
									disabled={loading}
								/>
							</label>
						</div>

						<div class="mb-4">
							<label class="label">
								<span>Email</span>
								<input
									class="input"
									bind:value={profileFields.email}
									name="email"
									type="email"
									readonly
									disabled={loading}
								/>
							</label>
						</div>

						<div class="mb-4">
							<label class="label">
								<span>Telefone</span>
								<input
									class="input"
									bind:value={profileFields.contact_number}
									name="contact_number"
									type="tel"
									disabled={loading}
								/>
							</label>
						</div>

						<div class="mb-4">
							<label class="label">
								<span>Endereço</span>
								<input
									class="input"
									bind:value={profileFields.address}
									name="address"
									type="text"
									disabled={loading}
								/>
							</label>
						</div>

						<div class="mb-4 flex flex-row gap-4">
							<label class="label flex-1">
								<span>Cidade</span>
								<input
									class="input"
									bind:value={profileFields.city}
									name="city"
									type="text"
									disabled={loading}
								/>
							</label>
							<label class="label flex-1">
								<span>Estado</span>
								<input
									class="input"
									bind:value={profileFields.state}
									name="state"
									type="text"
									disabled={loading}
								/>
							</label>
						</div>

						<div class="mb-4 flex flex-row gap-4">
							<label class="label flex-1">
								<span>País</span>
								<input
									class="input"
									bind:value={profileFields.country}
									name="country"
									type="text"
									disabled={loading}
								/>
							</label>
							<label class="label flex-1">
								<span>CEP</span>
								<input
									class="input"
									bind:value={profileFields.postcode}
									name="postcode"
									type="text"
									disabled={loading}
								/>
							</label>
						</div>

						<div class="flex pt-8">
							<div class="flex-1"></div>
							<button
								type="submit"
								class="btn variant-filled-primary mr-2 text-white"
								disabled={loading}>Salvar</button
							>
						</div>
					</form>
				{/if}

				{#if active === 'security'}
					<h3 class="h3 mb-4">Segurança e Privacidade</h3>
					<form action="" onsubmit={onSecuritySubmit}>
						<div class="mb-4">
							<label class="label">
								<span>Nova Senha</span>
								<input
									class="input"
									bind:value={securityFields.password}
									name="password"
									type="password"
									disabled={loading}
								/>
							</label>
						</div>

						<div class="mb-4">
							<label class="label">
								<span>Confirmar Nova Senha</span>
								<input
									class="input"
									bind:value={securityFields.password_confirmation}
									name="password_confirmation"
									type="password"
									disabled={loading}
								/>
							</label>
						</div>

						<div class="flex pt-8">
							<div class="flex-1"></div>
							<button
								type="submit"
								class="btn variant-filled-primary mr-2 text-white"
								disabled={loading}>Salvar</button
							>
						</div>
					</form>
				{/if}
			</div>
		</div>
	</div>
</div>

<style lang="postcss">
	.user-sidebar {
		@apply min-h-full w-72 border-r;
	}

	.user-nav a {
		@apply text-gray-800;
	}

	.user-nav a.active {
		@apply bg-amber-600 text-white;
	}

	.user-nav a:hover {
		@apply text-white;
	}
</style>
