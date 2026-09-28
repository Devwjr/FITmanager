<script>
	import { AppBar, getDrawerStore } from '@skeletonlabs/skeleton';
	import Sun from 'svelte-icons/fa/FaSun.svelte';
	import Moon from 'svelte-icons/fa/FaMoon.svelte';
	import { onMount } from 'svelte';

	const drawerStore = getDrawerStore();

	const drawerOpen = () => drawerStore.open({});
	let mode = $state('dark');

	onMount(() => {
		mode = localStorage.getItem('edufit-theme') || 'dark';
		document.documentElement.dataset.mode = mode;
	});

	const toggleTheme = () => {
		mode = mode === 'dark' ? 'light' : 'dark';
		document.documentElement.dataset.mode = mode;
		localStorage.setItem('edufit-theme', mode);
	};
</script>

<AppBar background="bg-black border-b border-yellow-500/40">
	<svelte:fragment slot="lead">
		<div class="flex items-center">
			<button
				class="btn btn-sm mr-4 lg:hidden"
				aria-label="Abrir Menu"
				onclick={drawerOpen}
			>
				<span>
					<svg viewBox="0 0 100 80" class="h-4 w-4 fill-white">
						<rect width="100" height="20" />
						<rect y="30" width="100" height="20" />
						<rect y="60" width="100" height="20" />
					</svg>
				</span>
			</button>
			<strong class="text-xl font-black tracking-tight text-yellow-400">EduFit</strong>
		</div>
	</svelte:fragment>
	<svelte:fragment slot="trail">
		<button class="theme-toggle" type="button" onclick={toggleTheme} aria-label={mode === 'dark' ? 'Ativar tema claro' : 'Ativar tema escuro'}>
			{#if mode === 'dark'}<Sun />{:else}<Moon />{/if}
			<span>{mode === 'dark' ? 'Tema claro' : 'Tema escuro'}</span>
		</button>
	</svelte:fragment>
</AppBar>

<style>
	.theme-toggle {
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		border: 1px solid rgb(250 204 21 / 0.5);
		border-radius: 9999px;
		padding: 0.45rem 0.75rem;
		color: #facc15;
		font-size: 0.75rem;
		font-weight: 700;
	}

	.theme-toggle:hover {
		background: rgb(250 204 21 / 0.12);
	}

	.theme-toggle :global(svg) {
		height: 1rem;
		width: 1rem;
	}
</style>
