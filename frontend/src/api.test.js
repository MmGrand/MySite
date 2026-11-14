import { describe, expect, it } from 'vitest';
import { errorMessage } from './api.js';

describe('errorMessage', () => {
  it('combines validation errors', () => {
    const error = {
      response: { data: { errors: { email: ['Invalid email.'], password: ['Password is required.'] } } },
    };

    expect(errorMessage(error)).toBe('Invalid email. Password is required.');
  });

  it('uses the response message when there are no validation errors', () => {
    expect(errorMessage({ response: { data: { message: 'Request failed.' } } })).toBe('Request failed.');
  });

  it('provides a fallback when there is no response', () => {
    expect(errorMessage({})).toBe('Не удалось выполнить запрос. Попробуйте ещё раз.');
  });
});
