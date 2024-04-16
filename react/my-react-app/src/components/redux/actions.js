// アクションタイプ
export const INCREMENT = 'INCREMENT';
export const DECREMENT = 'DECREMENT';

// アクションクリエータ
export const increment = () => ({
    type: INCREMENT
});

export const decrement = () => ({
    type: DECREMENT
});