import { FC } from 'react';

interface EditButtonProps {
    isAdmin: boolean;
}

export const EditButton: FC<EditButtonProps> = ({ isAdmin }) => {
    // ボタンが非活性の場合に適用するTailwind CSSクラス
    const disabledClass = !isAdmin ? 'opacity-50 cursor-not-allowed' : '';

    return (
        <button
            className={`px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors ${disabledClass}`}
            disabled={!isAdmin}
        >
            編集
        </button>
    );
};
