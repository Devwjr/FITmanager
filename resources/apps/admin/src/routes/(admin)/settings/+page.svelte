<script>
	import { getBearerToken, getErrorMessage, useApi } from '$lib/api';
	import { useToast } from '$lib/toast';
	import { onMount } from 'svelte';

	const api = useApi({
		Authorization: getBearerToken()
	});

	const toast = useToast();

	const title = 'Configurações do Sistema';

	let loading = $state(false);

	let settings = $state({
		site_name: '',
		site_email: '',
		site_timezone: 'America/Sao_Paulo'
	});

	const timezones = [
		'America/Sao_Paulo',
		'America/Manaus',
		'America/Fortaleza',
		'America/Bahia',
		'America/Belem',
		'America/Cuiaba',
		'America/Campo_Grande',
		'America/Porto_Velho',
		'America/Boa_Vista',
		'America/Rio_Branco'
	];

	const loadSettings = () => {
		const saved = localStorage.getItem('fitmanager_settings');
		if (saved) {
			settings = { ...settings, ...JSON.parse(saved) };
		} else {
			settings.site_name = 'FITmanager';
			settings.site_email = 'admin@fitmanager.com';
			settings.site_timezone = 'America/Sao_Paulo';
		}
	};

	const onSubmit = (event) => {
		event.preventDefault();
		loading = true;

		try {
			localStorage.setItem('fitmanager_settings', JSON.stringify(settings));
			toast.trigger({
				message: 'Configurações salvas com sucesso',
				background: 'variant-filled-success'
			});
		} catch (error) {
			toast.trigger({
				message: getErrorMessage(error),
				background: 'variant-filled-error'
			});
		} finally {
			loading = false;
		}
	};

	onMount(() => {
		loadSettings();
	});
</script>

<svelte:head>
	<title>{title}</title>
</svelte:head>

<div class="p-4 lg:max-w-1200 lg:p-6">
	<div class="card bg-white p-4 lg:p-6">
		<header class="card-header mb-6 flex items-center">
			<h3 class="h3">{title}</h3>
			<div class="flex-1"></div>
		</header>
		<form action="" onsubmit={onSubmit}>
			<div class="mb-4">
				<label class="label">
					<span>Nome do Sistema</span>
					<input
						class="input"
						bind:value={settings.site_name}
						name="site_name"
						type="text"
						required
						disabled={loading}
						placeholder="Nome do sistema"
					/>
				</label>
			</div>

			<div class="mb-4">
				<label class="label">
					<span>Email do Sistema</span>
					<input
						class="input"
						bind:value={settings.site_email}
						name="site_email"
						type="email"
						required
						disabled={loading}
						placeholder="admin@fitmanager.com"
					/>
				</label>
			</div>

			<div class="mb-4">
				<label class="label">
					<span>Fuso Horário</span>
					<select class="select" bind:value={settings.site_timezone} name="site_timezone" disabled={loading}>
						{#each timezones as tz}
							<option value={tz}>{tz}</option>
						{/each}
					</select>
				</label>
			</div>

			<div class="flex">
				<button
					type="button"
					onclick={loadSettings}
					class="variant-filled-error btn text-white"
					disabled={loading}>Restaurar Padrão</button
				>
				<div class="flex-1"></div>
				<button
					type="submit"
					class="variant-filled-primary btn mr-2 text-white"
					disabled={loading}>Salvar</button
				>
			</div>
		</form>
	</div>
</div>
