<script>
	import { goto } from '$app/navigation';
	import { getBearerToken, getErrorMessage, useApi } from '$lib/api';
	import { prevent } from '$lib/prevent';
	import { useToast } from '$lib/toast';

	const toast = useToast();

	const api = useApi({
		Authorization: getBearerToken()
	});

	let title = 'Novo Ciclo';

	let loading = false;

	let fields = {
		name: '',
		num_days: '',
		status: 'active',
		description: ''
	};

	const onSubmit = () => {
		loading = true;
		api.post('/cycles', fields)
			.then(() => {
				goto('/cycles');
				toast.trigger({
					message: 'Criado com sucesso',
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
</script>

<svelte:head>
	<title>{title}</title>
</svelte:head>

<div class="lg:max-w-1200 p-4 lg:p-6">
	<div class="card bg-white p-4 lg:p-6">
		<header class="card-header mb-6 flex items-center">
			<h3 class="h3">{title}</h3>
			<div class="flex-1"></div>
		</header>
		<form action="" onsubmit={prevent(onSubmit)}>
			<div class="mb-4">
				<label class="label">
					<span>Nome</span>
					<input
						class="input"
						bind:value={fields.name}
						name="name"
						type="text"
						required
						disabled={loading}
					/>
				</label>
			</div>

			<div class="mb-4">
				<label class="label">
					<span>Dias</span>
					<input
						class="input"
						bind:value={fields.num_days}
						name="num_days"
						type="number"
						required
						disabled={loading}
					/>
				</label>
			</div>

			<div class="mb-4">
				<label class="label">
					<span>Status</span>
					<select
						class="select"
						bind:value={fields.status}
						name="status"
						required
						disabled={loading}
					>
						<option value=""></option>
						<option value="active">Ativo</option>
						<option value="inactive">Inativo</option>
					</select>
				</label>
			</div>

			<div class="mb-4">
				<label class="label">
					<span>Descrição</span>
					<textarea
						class="textarea"
						rows="4"
						bind:value={fields.description}
						name="description"
						required
						disabled={loading}
					></textarea>
				</label>
			</div>

			<div class="flex">
				<button
					type="button"
					onclick={() => goto('/cycles')}
					class="btn variant-filled-error text-white"
					disabled={loading}>Cancelar</button
				>
				<div class="flex-1"></div>
				<button
					type="submit"
					class="btn variant-filled-primary mr-2 text-white"
					disabled={loading}>Salvar</button
				>
			</div>
		</form>
	</div>
</div>
