import React, { ChangeEvent, useState, KeyboardEvent, FC, useCallback } from 'react';
import MemoList from './components/MemoList';
import { useMemoList } from './hooks/useMemoList';

export const App: FC = () => {
  // カスタムフックからそれぞれ取得
  const { memos, addTodo, deleteTodo } = useMemoList();
  // テキストボックス State
  const [text, setText] = useState<string>('');

  // テキストボックス入力時に入力内容を State に反映
  const onChangeText = (e: ChangeEvent<HTMLInputElement>) => setText(e.target.value);

  // [追加] ボタンクリック時の処理
  const onClickAdd = () => {
    // カスタムフックで定義したメモ追加ロジックを実行
    addTodo(text);
    // テキストボックスの入力内容をクリア
    setText('');
  };

  // [削除] ボタンクリック時の処理
  const onClickDelete = useCallback((index: number) => {
    deleteTodo(index);
  }, [deleteTodo]);

  // テキストボックスで Enter キー押下時の処理
  const onKeyPress = (e: KeyboardEvent<HTMLInputElement>) => {
    if (e.key === 'Enter') {
      onClickAdd();
    }
  };

  return (
    <div className="flex flex-col items-center justify-center min-h-screen bg-gray-800 text-white">
      <h1 className="text-4xl font-bold mb-6">簡単メモアプリ</h1>
      <div className="flex mb-4">
        <input
          type="text"
          value={text}
          onChange={onChangeText}
          onKeyDown={onKeyPress}
          className="p-2 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-black"
          placeholder="メモを入力..."
        />
        <button
          onClick={onClickAdd}
          className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-lg transition duration-300 ease-in-out"
        >
          追加
        </button>
      </div>
      <MemoList memos={memos} onDelete={onClickDelete} />
    </div>
  );
};
