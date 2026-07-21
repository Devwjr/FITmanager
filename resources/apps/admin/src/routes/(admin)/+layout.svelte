<script>
	import AppLayout from '$lib/components/AppLayout.svelte';

	export let data = { token: '' };
</script>

<AppLayout>
	<main>
		<slot></slot>
	</main>
</AppLayout>
