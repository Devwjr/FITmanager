<script>
	import { goto } from '$app/navigation';
	import { getMemberStoreContext } from '$lib/stores/members.store.svelte';
	import { onMount } from 'svelte';
	import { Avatar, Paginator } from '@skeletonlabs/skeleton';
	import { getAvatarUrl } from '$lib/avatar';

	const store = getMemberStoreContext();

	const title = 'Gerenciar Usuários Admin';

	const onEdit = (id) => goto(`/members/${id}`);

	const onAmountChanged = (event) => {
		store.perPage = event.detail;
		store.loadMembers();
	};

	const onPageChanged = (event) => {
		store.currentPage = event.detail;
		store.loadMembers();
	};

	onMount(() => store.loadMembers());

	let paginationSettings = $state({
		page: 0,
		limit: 15,
		size: 0,
		amounts: [5, 10, 15, 20, 40, 60, 100]
	});

	$effect(() => {
		paginationSettings.size = store.totalItems;
	});
</script>

<svelte:head>
	<title>{title}</title>
</svelte:head>

<div class="p-4 lg:p-6">
	<div class="card bg-white p-4 lg:p-6">
		<header class="card-header mb-6 flex items-center">
			<h3 class="h3">{title}</h3>
			<div class="flex-1"></div>
			<button
				type="submit"
				class="variant-filled-primary btn text-white"
				onclick={() => goto('/members/new')}
			>
				Adicionar
			</button>
		</header>
		<div class="table-container">
			<table class="table-hover table bg-white">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>Email</th>
						<th>Ação</th>
					</tr>
				</thead>
				<tbody>
					{#each store.items as item}
						<tr>
							<td style="width: 100px;">{item.id}</td>
							<td>
								<div class="flex items-center gap-4">
									<Avatar
										src={item.avatar ? getAvatarUrl(item.avatar) : undefined}
										initials={item.avatar ? undefined : item.initial}
										width="w-16"
										rounded="rounded-full"
									/>
									<a href={`/members/${item.id}`} class="font-bold">{item.name}</a>
								</div>
							</td>
							<td>{item.email}</td>
							<td>
								<button
									type="button"
									class="variant-filled-primary btn-sm btn text-white"
									onclick={() => onEdit(item.id)}
								>
									Ver Detalhes
								</button>
							</td>
						</tr>
					{/each}
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4" class="bg-white">Resultados encontrados: {store.totalItems}</th>
					</tr>
				</tfoot>
			</table>
			<div class="pt-6">
				<Paginator
					bind:settings={paginationSettings}
					showNumerals
					maxNumerals={1}
					on:amount={onAmountChanged}
					on:page={onPageChanged}
				/>
			</div>
		</div>
	</div>
</div>
