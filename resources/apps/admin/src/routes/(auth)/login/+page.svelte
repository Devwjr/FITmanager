<script>
    // @ts-nocheck

    import { useToast } from '$lib/toast';

    import axios from 'axios';

    const toast = useToast();

    let fields = $state({ email: '', password: '' });

    let loading = $state(false);

    const onSubmit = (event) => {
        event.preventDefault();
        if (loading) return;
        axios
            .post('/login', fields)
            .then(() => {
                toast.trigger({
                    message: 'Login realizado com sucesso. Redirecionando...',
                    background: 'variant-filled-success'
                });
                setTimeout(() => (window.location.href = '/'), 1500);
            })
            .catch((error) => {
                toast.trigger({
                    message: 'Não foi possível realizar o login',
                    background: 'variant-filled-error'
                });
            })
            .finally(() => {
                loading = false;
            });
    };
</script>

<div class="mb-6">
    <h3 class="h3">Acesso à Conta</h3>
    <p>Faça login para começar</p>
</div>

<form action="" onsubmit={onSubmit}>
    <div class="mb-4">
        <label class="label">
            <span>Email</span>
            <input
                class="input"
                bind:value={fields.email}
                name="email"
                type="email"
                disabled={loading}
                placeholder="seu@email.com"
                required
            />
        </label>
    </div>

    <div class="mb-6">
        <label class="label">
            <span>Senha</span>
            <input
                class="input"
                bind:value={fields.password}
                name="password"
                type="password"
                placeholder=""
                disabled={loading}
                required
            />
        </label>
    </div>
    <button
        type="submit"
        disabled={loading}
        class="variant-filled-primary btn w-full font-bold text-white">Entrar</button
    >
    <a href="/forgot" class="block pt-2 text-center">Esqueceu a senha?</a>
</form>