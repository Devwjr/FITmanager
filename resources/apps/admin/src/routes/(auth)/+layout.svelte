<script>
	// @ts-nocheck

	import Logo from '$lib/components/Logo.svelte';
	import Wrapper from '$lib/components/wrapper.svelte';
	import { onMount } from 'svelte';

	const { children } = $props();
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

<Wrapper>
	<button class="theme-toggle" type="button" onclick={toggleTheme} aria-label="Alternar tema">
		{mode === 'dark' ? '☼ Tema claro' : '☾ Tema escuro'}
	</button>
	<div class="login">
		<div class="login-card">
			<div class="mx-auto mb-8 flex justify-center">
				<Logo />
			</div>
			{@render children()}
		</div>
	</div>
</Wrapper>

<style lang="postcss">
	.login {
		@apply fixed bottom-0 left-0 right-0 top-0 flex h-full w-full items-center justify-center overflow-y-auto;
		background: var(--edufit-bg);
	}

	.login-card {
		@apply mx-4 rounded-xl p-8 shadow-none lg:my-8 lg:shadow-lg;
		background: var(--edufit-panel);
		color: var(--edufit-text);
		width: 500px;
		max-width: 100%;
	}

	.theme-toggle {
		@apply fixed right-5 top-5 z-10 rounded-full px-4 py-2 text-sm font-bold;
		border: 1px solid var(--edufit-yellow);
		color: var(--edufit-yellow);
		background: var(--edufit-panel);
	}
</style>
