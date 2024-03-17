import React, { useContext } from 'react';
import { AdminFlagContext } from './providers/AdminFlagProvider';

export const EditButton: React.FC = () => {
    const context = useContext(AdminFlagContext);

    if (!context) {
        throw new Error('EditButton must be used within a AdminFlagProvider');
    }

    const { isAdmin } = context;
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
