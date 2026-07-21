<script>
    // @ts-nocheck

    import { getErrorMessage } from '$lib/api';
    import { useToast } from '$lib/toast';

    import axios from 'axios';

    const toast = useToast();

    let fields = $state({
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
    });

    let loading = $state(false);

    const onSubmit = (event) => {
        event.preventDefault();
        if (loading) return;
        loading = true;
        axios
            .post('/register', fields)
            .then(() => {
                toast.trigger({
                    message: 'Conta criada com sucesso. Verifique seu email para ativar.',
                    background: 'variant-filled-success'
                });
                setTimeout(() => (window.location.href = '/login'), 2000);
            })
            .catch((error) => {
                toast.trigger({
                    message: getErrorMessage(error),
                    background: 'variant-filled-error'
                });
            })
            .finally(() => {
                loading = false;
            });
    };
</script>

<div class="mb-6">
    <h3 class="h3">Criar Conta</h3>
    <p>Preencha os dados para se cadastrar.</p>
</div>

<form action="" onsubmit={onSubmit}>
    <div class="mb-4">
        <label class="label">
            <span>Nome</span>
            <input
                class="input"
                bind:value={fields.name}
                name="name"
                type="text"
                placeholder="Seu nome completo"
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
                bind:value={fields.email}
                name="email"
                type="email"
                placeholder="seu@email.com"
                required
                disabled={loading}
            />
        </label>
    </div>

    <div class="mb-4">
        <label class="label">
            <span>Senha</span>
            <input
                class="input"
                bind:value={fields.password}
                name="password"
                type="password"
                required
                disabled={loading}
            />
        </label>
    </div>

    <div class="mb-6">
        <label class="label">
            <span>Confirmar Senha</span>
            <input
                class="input"
                bind:value={fields.password_confirmation}
                name="password_confirmation"
                type="password"
                required
                disabled={loading}
            />
        </label>
    </div>

    <button
        type="submit"
        disabled={loading}
        class="variant-filled-primary btn w-full font-bold text-white">Cadastrar</button
    >
    <a href="/login" class="block pt-2 text-center">Já tem conta? Faça login</a>
</form>
