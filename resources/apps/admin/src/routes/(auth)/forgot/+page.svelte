<script>
    // @ts-nocheck

    import { getErrorMessage } from '$lib/api';
    import { useToast } from '$lib/toast';

    import axios from 'axios';

    let fields = $state({ email: '', password: '' });

    let loading = $state(false);

    const toast = useToast();

    const onSubmit = (event) => {
        event.preventDefault();
        if (loading) return;
        axios
            .post('/forgot', fields)
            .then(() => {
                toast.trigger({
                    message: 'As instruções para redefinir a senha foram enviadas. Redirecionando...',
                    background: 'variant-filled-success'
                });
                setTimeout(() => (window.location.href = '/'), 1000);
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
    <h3 class="h3">Recuperar Senha</h3>
    <p>Informe seu e-mail para redefinir sua senha.</p>
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
                placeholder="seu@email.com"
                required
                disabled={loading}
            />
        </label>
    </div>
    <button
        type="submit"
        disabled={loading}
        class="variant-filled-primary btn w-full font-bold text-white">Enviar</button
    >
    <a href="/login" class="block pt-2 text-center">Voltar ao login</a>
</form>