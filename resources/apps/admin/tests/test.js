import { expect, test } from '@playwright/test';

test.describe('FITmanager Admin', () => {
	test('login page loads with correct title and form', async ({ page }) => {
		await page.goto('/login');
		await expect(page.locator('h3')).toContainText('Acesso à Conta');
		await expect(page.locator('input[name="email"]')).toBeVisible();
		await expect(page.locator('input[name="password"]')).toBeVisible();
		await expect(page.locator('button[type="submit"]')).toContainText('Entrar');
	});

	test('login page has forgot password link', async ({ page }) => {
		await page.goto('/login');
		await expect(page.locator('a[href="/forgot"]')).toBeVisible();
	});

	test('login page has register link', async ({ page }) => {
		await page.goto('/login');
		await expect(page.locator('a[href="/register"]')).toBeVisible();
	});

	test('register page loads with correct form', async ({ page }) => {
		await page.goto('/register');
		await expect(page.locator('h3')).toContainText('Criar Conta');
		await expect(page.locator('input[name="name"]')).toBeVisible();
		await expect(page.locator('input[name="email"]')).toBeVisible();
		await expect(page.locator('input[name="password"]')).toBeVisible();
		await expect(page.locator('input[name="password_confirmation"]')).toBeVisible();
	});

	test('register page has login link', async ({ page }) => {
		await page.goto('/register');
		await expect(page.locator('a[href="/login"]')).toBeVisible();
	});

	test('forgot password page loads correctly', async ({ page }) => {
		await page.goto('/forgot');
		await expect(page.locator('h3')).toContainText('Recuperar Senha');
		await expect(page.locator('input[name="email"]')).toBeVisible();
	});

	test('unauthenticated user is redirected to login', async ({ page }) => {
		await page.goto('/');
		await expect(page).toHaveURL(/\/login/);
	});

	test('login form validation requires fields', async ({ page }) => {
		await page.goto('/login');
		const emailInput = page.locator('input[name="email"]');
		const passwordInput = page.locator('input[name="password"]');
		await expect(emailInput).toHaveAttribute('required', '');
		await expect(passwordInput).toHaveAttribute('required', '');
	});
});
