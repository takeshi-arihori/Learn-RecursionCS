import React from 'react';

type Props = {
    memos: string[];
    onDelete: (index: number) => void;
};

const MemoList: React.FC<Props> = ({ memos, onDelete }) => {
    return (
        <div className="text-left w-96">
            <p className="text-2xl mb-4">メモ一覧</p>
            <ul className="space-y-2">
                {memos.map((memo, index) => (
                    <li key={index} className="bg-gray-700 p-3 rounded-lg flex justify-between items-center">
                        <p>{memo}</p>
                        <button
                            onClick={() => onDelete(index)}
                            className="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded transition duration-300 ease-in-out"
                        >
                            削除
                        </button>
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default MemoList;
