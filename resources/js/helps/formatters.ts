// resources/js/utils/formatters.ts

/**
 * Utility functions for formatting various data types
 */

// ===== Date Formatting =====
export function timeAgo(date: string | Date): string {
    const now = new Date();
    const past = new Date(date);
    const diffInSeconds = Math.floor((now.getTime() - past.getTime()) / 1000);

    if (diffInSeconds < 60) {
        return 'just now';
    }

    const units: [Intl.RelativeTimeFormatUnit, number][] = [
        ['year', 60 * 60 * 24 * 365],
        ['month', 60 * 60 * 24 * 30],
        ['week', 60 * 60 * 24 * 7],
        ['day', 60 * 60 * 24],
        ['hour', 60 * 60],
        ['minute', 60],
    ];

    const rtf = new Intl.RelativeTimeFormat('en', { numeric: 'auto' });

    for (const [unit, seconds] of units) {
        const value = Math.floor(diffInSeconds / seconds);
        if (value >= 1) {
            return rtf.format(-value, unit);
        }
    }

    return 'just now';
}

export function formatDate(date: string | Date): string {
    return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
}

export function formatDateTime(date: string | Date): string {
    return new Date(date).toLocaleString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// ===== Currency Formatting =====
export function formatCurrency(value: number, currency: string = 'USD'): string {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: currency,
    }).format(value);
}

export function formatCurrencyShort(value: number): string {
    if (value >= 1000000) {
        return `$${(value / 1000000).toFixed(1)}M`;
    }
    if (value >= 1000) {
        return `$${(value / 1000).toFixed(0)}K`;
    }
    return `$${value}`;
}

// ===== Number Formatting =====
export function formatNumber(value: number): string {
    return new Intl.NumberFormat('en-US').format(value);
}

export function formatPercentage(value: number, decimals: number = 1): string {
    return `${value.toFixed(decimals)}%`;
}

// ===== String Formatting =====
export function truncate(text: string, length: number = 100): string {
    if (text.length <= length) return text;
    return text.substring(0, length) + '...';
}

export function capitalize(text: string): string {
    return text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
}

export function slugify(text: string): string {
    return text
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, '')
        .replace(/[\s_-]+/g, '-')
        .replace(/^-+|-+$/g, '');
}

// ===== File Size Formatting =====
export function formatFileSize(bytes: number): string {
    if (bytes === 0) return '0 Bytes';
    
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}