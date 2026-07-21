import { describe, it, expect } from 'vitest';

describe('FITmanager Utils', () => {
	it('validates email format', () => {
		const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		expect(emailRegex.test('admin@admin.com')).toBe(true);
		expect(emailRegex.test('invalid-email')).toBe(false);
		expect(emailRegex.test('')).toBe(false);
	});

	it('validates password minimum length', () => {
		const isValidPassword = (password) => password.length >= 8;
		expect(isValidPassword('password123')).toBe(true);
		expect(isValidPassword('short')).toBe(false);
		expect(isValidPassword('')).toBe(false);
	});

	it('formats account number with leading zeros', () => {
		const formatAccountNumber = (id) => String(id).padStart(12, '0');
		expect(formatAccountNumber(1)).toBe('000000000001');
		expect(formatAccountNumber(42)).toBe('000000000042');
		expect(formatAccountNumber(123456)).toBe('000000123456');
	});

	it('extracts initials from name', () => {
		const getInitials = (name) => {
			const words = name.split(' ');
			return (words[0][0] + words[words.length - 1][0]).toUpperCase();
		};
		expect(getInitials('João Silva')).toBe('JS');
		expect(getInitials('Maria')).toBe('MM');
		expect(getInitials('Ana Maria Santos')).toBe('AS');
	});

	it('validates status values', () => {
		const validStatuses = ['active', 'inactive', 'suspended', 'deleted', 'expired'];
		expect(validStatuses.includes('active')).toBe(true);
		expect(validStatuses.includes('invalid')).toBe(false);
	});

	it('validates activity types', () => {
		const validTypes = ['attendance', 'system'];
		expect(validTypes.includes('attendance')).toBe(true);
		expect(validTypes.includes('system')).toBe(true);
		expect(validTypes.includes('invalid')).toBe(false);
	});
});
