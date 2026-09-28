<script>
	// @ts-nocheck
	import { onMount } from 'svelte';
	import { useApi, getErrorMessage } from '$lib/api';
	let { data } = $props();
	const api = useApi({ Authorization: `Bearer ${data.token}` });
	let students = $state([]),
		exercises = $state([]),
		workouts = $state([]),
		report = $state(null);
	let student = $state(''),
		period = $state('week'),
		date = $state(new Date().toLocaleDateString('en-CA'));
	let busy = $state(false),
		error = $state(''),
		message = $state(''),
		ready = $state(false);
	let exercise = $state({ name: '', muscle_group: '', instructions: '' }),
		exerciseId = $state(null);
	const blank = () => ({ name: '', days_per_week: 1, notes: '', items: [] });
	let workout = $state(blank()),
		workoutId = $state(null);
	let session = $state({
		performed_on: new Date().toLocaleDateString('en-CA'),
		notes: '',
		items: []
	});
	let selectedTemplate = $state('');
	const templates = [
		{
			id: 'full-body',
			name: 'Full body · 2 dias',
			days_per_week: 2,
			notes: 'Modelo geral para começar. Ajuste volume, carga e exercícios ao aluno.',
			items: [
				['Agachamento', 'Pernas', 3, 8, 0],
				['Supino reto', 'Peito', 3, 8, 0],
				['Remada', 'Costas', 3, 10, 0],
				['Desenvolvimento', 'Ombros', 2, 10, 0]
			]
		},
		{
			id: 'upper-lower',
			name: 'Upper / lower · 4 dias',
			days_per_week: 4,
			notes: 'Divisão de membros superiores e inferiores. Personalize para a experiência do aluno.',
			items: [
				['Agachamento', 'Pernas', 3, 8, 0],
				['Levantamento terra romeno', 'Posterior', 3, 10, 0],
				['Supino reto', 'Peito', 3, 8, 0],
				['Puxada frontal', 'Costas', 3, 10, 0]
			]
		},
		{
			id: 'push-pull-legs',
			name: 'Push / pull / legs · 3 dias',
			days_per_week: 3,
			notes: 'Divisão por padrões de movimento. Revise a recuperação e a técnica antes de aplicar.',
			items: [
				['Supino reto', 'Peito', 3, 8, 0],
				['Remada', 'Costas', 3, 10, 0],
				['Agachamento', 'Pernas', 3, 8, 0],
				['Elevação lateral', 'Ombros', 2, 12, 0]
			]
		}
	];
	const row = () => ({ exercise_id: exercises[0]?.id || '', sets: 3, reps: 10, weight: 0 });
	const volume = (items) =>
		items.reduce((n, i) => n + Number(i.sets) * Number(i.reps) * Number(i.weight), 0);
	const sets = (items) => items.reduce((n, i) => n + Number(i.sets), 0);
	const fmt = (n) => Number(n).toLocaleString('pt-BR', { maximumFractionDigits: 1 });
	const chartData = () => {
		if (!report?.sessions?.length) return [];
		return [...report.sessions].reverse().map((s) => ({
			date: s.performed_on.slice(5),
			volume: volume(s.items),
			sets: sets(s.items)
		}));
	};
	const chartMax = () => Math.max(...chartData().map((point) => point.volume), 1);
	const chartX = (index) => 36 + index * (568 / Math.max(chartData().length - 1, 1));
	const chartY = (value) => 150 - (value / chartMax()) * 112;
	async function action(fn) {
		if (busy) return;
		busy = true;
		error = '';
		message = '';
		try {
			await fn();
		} catch (e) {
			error = getErrorMessage(e);
		} finally {
			busy = false;
		}
	}
	async function refresh() {
		if (!student) {
			report = null;
			workouts = [];
			return;
		}
		const id = student;
		const [w, p] = await Promise.all([
			api.get(`/training/${id}/workouts`),
			api.get(`/training/${id}/progress`, { params: { period, date } })
		]);
		if (id !== student) return;
		workouts = w.data;
		report = p.data;
	}
	onMount(() =>
		action(async () => {
			const [s, e] = await Promise.all([
				api.get('/training/students'),
				api.get('/training/exercises')
			]);
			students = s.data;
			exercises = e.data;
			ready = true;
		})
	);
	function changeStudent() {
		workout = blank();
		workoutId = null;
		session.items = [];
		report = null;
		workouts = [];
		action(refresh);
	}
	async function saveExercise() {
		await action(async () => {
			await api[exerciseId ? 'put' : 'post'](
				'/training/exercises' + (exerciseId ? `/${exerciseId}` : ''),
				exercise
			);
			exercises = (await api.get('/training/exercises')).data;
			exercise = { name: '', muscle_group: '', instructions: '' };
			exerciseId = null;
			message = 'Exercício salvo.';
		});
	}
	async function useTemplate() {
		const template = templates.find((item) => item.id === selectedTemplate);
		if (!template || !student) return;
		await action(async () => {
			const items = [];
			for (const [name, muscle_group, sets, reps, weight] of template.items) {
				let existing = exercises.find((item) => item.name.toLowerCase() === name.toLowerCase());
				if (!existing) {
					existing = (await api.post('/training/exercises', { name, muscle_group })).data;
					exercises = [...exercises, existing];
				}
				items.push({ exercise_id: existing.id, sets, reps, weight });
			}
			workout = {
				name: template.name,
				days_per_week: template.days_per_week,
				notes: template.notes,
				items
			};
			workoutId = null;
			message = 'Modelo carregado. Revise e salve a ficha para este aluno.';
		});
	}
	async function saveWorkout() {
		await action(async () => {
			await api[workoutId ? 'put' : 'post'](
				`/training/${student}/workouts` + (workoutId ? `/${workoutId}` : ''),
				workout
			);
			workout = blank();
			workoutId = null;
			await refresh();
			message = 'Ficha salva.';
		});
	}
	async function saveSession() {
		await action(async () => {
			await api.post(`/training/${student}/sessions`, session);
			date = session.performed_on;
			session = { performed_on: date, notes: '', items: [] };
			await refresh();
			message = 'Sessão registrada na evolução.';
		});
	}
	function editWorkout(w) {
		workoutId = w.id;
		workout = structuredClone($state.snapshot(w));
	}
	function startSession(w) {
		session = {
			performed_on: new Date().toLocaleDateString('en-CA'),
			notes: '',
			items: structuredClone($state.snapshot(w.items))
		};
		message = 'Ficha copiada. Ajuste os valores realizados e registre a sessão abaixo.';
	}
	async function remove(kind, id) {
		if (!confirm('Excluir este registro?')) return;
		await action(async () => {
			await api.delete(`/training/${student}/${kind}/${id}`);
			await refresh();
		});
	}
</script>

<svelte:head><title>Treinos e evolução · EduFit</title></svelte:head>
<div class="space-y-6 p-4 md:p-8">
	<header>
		<p class="text-sm opacity-70">EDUFIT / ACOMPANHAMENTO</p>
		<h1 class="h1">Treinos e evolução</h1>
		<p>Monte as fichas, registre o que foi realizado e acompanhe cada aluno.</p>
	</header>
	{#if error}<div class="rounded bg-red-950 p-4 text-white" role="alert">{error}</div>{/if}
	{#if message}<div class="rounded bg-emerald-950 p-4 text-white" role="status">
			{message}
		</div>{/if}
	{#if busy}<p role="status">Carregando / salvando…</p>{/if}
	<section class="card space-y-4 p-5">
		<h2 class="h2">Biblioteca de exercícios</h2>
		<form
			onsubmit={(e) => {
				e.preventDefault();
				saveExercise();
			}}
			class="space-y-3"
		>
			<fieldset disabled={busy} class="grid gap-3 md:grid-cols-3">
				<label class="label"
					>Nome<input
						class="input"
						bind:value={exercise.name}
						required
						maxlength="150"
						placeholder="Ex.: Agachamento"
					/></label
				>
				<label class="label"
					>Grupo muscular<input
						class="input"
						bind:value={exercise.muscle_group}
						required
						maxlength="100"
						placeholder="Ex.: Quadríceps"
					/></label
				>
				<label class="label"
					>Orientações<input
						class="input"
						bind:value={exercise.instructions}
						maxlength="5000"
					/></label
				>
			</fieldset>
			<button class="variant-filled-primary btn" disabled={busy}
				>{exerciseId ? 'Salvar alteração' : 'Cadastrar exercício'}</button
			>
			{#if exerciseId}<button
					type="button"
					class="btn"
					onclick={() => {
						exerciseId = null;
						exercise = { name: '', muscle_group: '', instructions: '' };
					}}>Cancelar</button
				>{/if}
		</form>
		<div class="flex flex-wrap gap-2">
			{#each exercises as ex}<button
					disabled={busy}
					class="variant-soft btn"
					onclick={() => {
						exerciseId = ex.id;
						exercise = {
							name: ex.name,
							muscle_group: ex.muscle_group,
							instructions: ex.instructions || ''
						};
					}}>{ex.name} · {ex.muscle_group} ✎</button
				>{/each}
		</div>
		{#if ready && !exercises.length}<p>
				Cadastre o primeiro exercício para começar a montar fichas.
			</p>{/if}
	</section>
	<section class="card space-y-4 p-5">
		<h2 class="h2">Acompanhamento do aluno</h2>
		<div class="grid gap-4 md:grid-cols-3">
			<label class="label"
				>Aluno<select
					class="select"
					bind:value={student}
					onchange={changeStudent}
					disabled={busy}
					><option value="">Selecione um aluno</option>{#each students as s}<option
							value={s.id}>{s.name}</option
						>{/each}</select
				></label
			>
			<label class="label"
				>Comparação<select
					class="select"
					bind:value={period}
					onchange={() => action(refresh)}
					disabled={busy}
					><option value="week">Semanal</option><option value="month">Mensal</option
					></select
				></label
			>
			<label class="label"
				>Data de referência<input
					class="input"
					type="date"
					bind:value={date}
					onchange={() => {
						if (date) action(refresh);
					}}
					disabled={busy}
				/></label
			>
		</div>
		{#if ready && !students.length}<p>
				Nenhum aluno cadastrado. <a class="anchor" href="/members/new">Cadastrar aluno</a>
			</p>{/if}
		{#if report}
			<p>
				{report.start} a {report.end} · comparado com {report.previous_start} a {report.previous_end}
			</p>
			<div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
				{#each [['sessions', 'Sessões'], ['sets', 'Séries'], ['reps', 'Repetições'], ['volume', 'Volume (kg)']] as [key, label]}
					<article class="rounded-xl bg-surface-700 p-4 text-white">
						<p>{label}</p>
						<strong class="text-3xl">{fmt(report.current[key])}</strong>
						<p class="text-sm">Anterior: {fmt(report.previous[key])}</p>
						<p>
							{report.changes[key] === null
								? 'Sem base de comparação'
								: `${report.changes[key] > 0 ? '+' : ''}${fmt(report.changes[key])}%`}
						</p>
					</article>
				{/each}
			</div>
			{#if report.sessions.length}
				<div class="rounded-xl border border-surface-500 p-4">
					<div class="mb-3 flex items-center justify-between"><h3 class="h3">Volume por sessão</h3><span class="text-sm opacity-70">kg movimentados</span></div>
					<svg viewBox="0 0 640 190" class="h-auto w-full" role="img" aria-label="Gráfico de volume por sessão">
						<line x1="36" y1="150" x2="604" y2="150" stroke="currentColor" opacity=".25" />
						<line x1="36" y1="38" x2="36" y2="150" stroke="currentColor" opacity=".25" />
						<polyline fill="none" stroke="#facc15" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" points={chartData().map((point, i) => `${chartX(i)},${chartY(point.volume)}`).join(' ')} />
						{#each chartData() as point, i}<circle cx={chartX(i)} cy={chartY(point.volume)} r="5" fill="#facc15" /><text x={chartX(i)} y="170" text-anchor="middle" class="chart-label">{point.date}</text>{/each}
					</svg>
				</div>
			{/if}
			<p class="text-sm opacity-75">
				Volume = séries × repetições × carga externa em kg. A variação compara períodos
				completos; o período atual pode estar incompleto. Mais volume não significa,
				sozinho, melhor resultado físico.
			</p>
			<h3 class="h3">Séries realizadas por grupo muscular</h3>
			{#each Object.entries(report.current.muscles) as [muscle, count]}<div>
					<div class="flex justify-between">
						<span>{muscle}</span><span>{count} séries</span>
					</div>
					<progress
						class="progress w-full"
						value={count}
						max={Math.max(...Object.values(report.current.muscles), 1)}
					></progress>
				</div>{:else}<p>Nenhuma sessão registrada neste período.</p>{/each}
		{/if}
	</section>
	{#if student}
	<section class="card space-y-4 p-5">
		<div class="rounded-xl border border-yellow-500/40 bg-yellow-500/5 p-4">
			<h2 class="h2">Fichas padrão</h2>
			<p class="mb-3 text-sm opacity-80">Modelos iniciais para você revisar. Eles não substituem avaliação individual, progressão planejada ou orientação profissional.</p>
			<div class="flex flex-wrap gap-3"><select class="select max-w-sm" bind:value={selectedTemplate}><option value="">Escolha um modelo</option>{#each templates as template}<option value={template.id}>{template.name}</option>{/each}</select><button class="btn variant-soft-primary" type="button" disabled={!selectedTemplate || busy} onclick={useTemplate}>Carregar modelo</button></div>
		</div>
		<h2 class="h2">{workoutId ? 'Editar ficha' : 'Montar ficha de treino'}</h2>
			<form
				onsubmit={(e) => {
					e.preventDefault();
					saveWorkout();
				}}
				class="space-y-4"
			>
				<fieldset disabled={busy} class="space-y-4">
					<div class="grid gap-3 md:grid-cols-3">
						<label class="label"
							>Nome da ficha<input
								class="input"
								bind:value={workout.name}
								required
								maxlength="150"
								placeholder="Treino A"
							/></label
						><label class="label"
							>Vezes por semana<input
								class="input"
								type="number"
								min="1"
								max="7"
								bind:value={workout.days_per_week}
								required
							/></label
						><label class="label"
							>Observações<input
								class="input"
								bind:value={workout.notes}
								maxlength="5000"
							/></label
						>
					</div>
					{@render itemEditor(workout.items)}
					<p>
						Por sessão: {sets(workout.items)} séries · {fmt(volume(workout.items))} kg. Planejado
						por semana: {sets(workout.items) * workout.days_per_week} séries · {fmt(
							volume(workout.items) * workout.days_per_week
						)} kg.
					</p>
					<button class="variant-filled-primary btn" disabled={!workout.items.length}
						>Salvar ficha</button
					>
					{#if workoutId}<button
							type="button"
							class="btn"
							onclick={() => {
								workoutId = null;
								workout = blank();
							}}>Cancelar edição</button
						>{/if}
				</fieldset>
			</form>
			<h3 class="h3">Fichas do aluno</h3>
			<p>
				Total semanal planejado: {workouts.reduce(
					(n, w) => n + sets(w.items) * w.days_per_week,
					0
				)} séries · {fmt(
					workouts.reduce((n, w) => n + volume(w.items) * w.days_per_week, 0)
				)} kg.
			</p>
			{#each workouts as w}<article class="rounded border border-surface-500 p-4">
					<strong>{w.name}</strong> · {w.days_per_week}×/semana · {sets(w.items)} séries/sessão
					<p>
						{w.items
							.map((i) => `${i.name}: ${i.sets}×${i.reps} / ${i.weight} kg`)
							.join(' • ')}
					</p>
					<p>{w.notes || ''}</p>
					<div class="mt-3 flex flex-wrap gap-2">
						<button
							class="variant-soft-primary btn"
							disabled={busy}
							onclick={() => startSession(w)}>Registrar execução</button
						><button
							class="variant-soft btn"
							disabled={busy}
							onclick={() => editWorkout(w)}>Editar</button
						><button
							class="variant-soft-error btn"
							disabled={busy}
							onclick={() => remove('workouts', w.id)}>Excluir ficha</button
						>
					</div>
				</article>{:else}<p>Monte a primeira ficha deste aluno.</p>{/each}
		</section>
		<section class="card space-y-4 p-5">
			<h2 class="h2">Registrar sessão realizada</h2>
			<p>
				Informe os valores executados. Para cargas diferentes entre séries, adicione o
				exercício em mais de uma linha.
			</p>
			<form
				onsubmit={(e) => {
					e.preventDefault();
					saveSession();
				}}
				class="space-y-4"
			>
				<fieldset disabled={busy} class="space-y-4">
					<div class="grid gap-3 md:grid-cols-2">
						<label class="label"
							>Data<input
								class="input"
								type="date"
								bind:value={session.performed_on}
								max={new Date().toLocaleDateString('en-CA')}
								required
							/></label
						><label class="label"
							>Observações<input
								class="input"
								bind:value={session.notes}
								maxlength="5000"
							/></label
						>
					</div>
					{@render itemEditor(session.items)}<button
						class="variant-filled-primary btn"
						disabled={!session.items.length}>Salvar sessão</button
					>
				</fieldset>
			</form>
		</section>
		{#if report}<section class="card space-y-4 p-5">
				<h2 class="h2">Histórico do período</h2>
				{#each report.sessions as s}<article class="rounded border border-surface-500 p-4">
						<strong>{s.performed_on}</strong> · {fmt(volume(s.items))} kg
						<p>
							{s.items
								.map((i) => `${i.name}: ${i.sets}×${i.reps} / ${i.weight} kg`)
								.join(' • ')}
						</p>
						<p>{s.notes || ''}</p>
						<button
							class="variant-soft-error btn mt-2"
							disabled={busy}
							onclick={() => remove('sessions', s.id)}>Excluir registro</button
						>
					</article>{:else}<p>O histórico aparecerá após registrar uma sessão.</p>{/each}
			</section>{/if}
	{/if}
</div>

<style>
	.chart-label { fill: currentColor; font-size: 10px; }
</style>

{#snippet itemEditor(items)}
	<div class="space-y-3">
		{#each items as item, i}<div
				class="grid items-end gap-2 rounded bg-surface-800 p-3 text-white sm:grid-cols-5"
			>
				<label class="label"
					>Exercício<select class="select" bind:value={item.exercise_id} required
						>{#each exercises as ex}<option value={ex.id}>{ex.name}</option
							>{/each}</select
					></label
				>
				<label class="label"
					>Séries<input
						class="input"
						type="number"
						min="1"
						max="100"
						bind:value={item.sets}
						required
					/></label
				>
				<label class="label"
					>Repetições<input
						class="input"
						type="number"
						min="1"
						max="1000"
						bind:value={item.reps}
						required
					/></label
				>
				<label class="label"
					>Carga (kg)<input
						class="input"
						type="number"
						min="0"
						max="2000"
						step="0.01"
						bind:value={item.weight}
						required
					/></label
				>
				<button
					class="variant-soft-error btn"
					type="button"
					onclick={() => items.splice(i, 1)}>Remover</button
				>
			</div>{/each}<button
			class="variant-soft-primary btn"
			type="button"
			disabled={!exercises.length}
			onclick={() => items.push(row())}>+ Adicionar exercício</button
		>
	</div>
{/snippet}
