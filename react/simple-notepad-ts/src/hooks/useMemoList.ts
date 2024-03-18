import { useCallback, useState } from "react";

export const useMemoList = () => {
  // メモ一覧 State
  const [memos, setMemos] = useState<string[]>([]);

  // メモ一覧 ロジック
  const addTodo = useCallback(
    (text: string) => {
      if (!text) return;
      // State 変更を正常に検知させるために新たな配列を生成
      const newMemos = [...memos];
      // テキストボックスの入力内容をメモ配列に追加
      newMemos.push(text);
      setMemos(newMemos);
      // 依存配列に忘れずにmomosを設定
    },
    [memos]
  );

  // メモ削除ロジック
  const deleteTodo = useCallback(
    (index: number) => {
      // State 変更を正常に検知させるために新たな配列を生成
      const newMemos = [...memos];
      // メモ配列から該当の要素を削除
      newMemos.splice(index, 1);
      setMemos(newMemos);
      // 依存配列に忘れずにmomosを設定
    },
    [memos]
  );

  return { memos, addTodo, deleteTodo };
};
