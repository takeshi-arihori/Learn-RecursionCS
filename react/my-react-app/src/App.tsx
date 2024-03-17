import { useState, memo, FC, useCallback } from 'react'; // FCをインポート
import { Child1 } from './components/Child1';
import { Child4 } from './components/Child4';

// Appコンポーネントの型をFC（FunctionComponent）で定義
export const App: FC = memo(() => {
  console.log("Appレンダリング！");

  // useStateに型注釈を追加（numはnumber型）
  const [num, setNum] = useState<number>(0);

  const onClickButton = () => {
    setNum(num + 1);
  }
  // Reset
  const onClickReset = useCallback(() => {
    setNum(0);
  }, []);

  return (
    <>
      <button
        onClick={onClickButton}
        className="px-4 py-2 m-2 bg-blue-400 text-white font-semibold rounded-lg hover:bg-blue-600 transition-colors"
      >ボタン
      </button>
      <p>{num}</p>
      <Child1 onClickReset={onClickReset} />
      <Child4 />
    </>
  );
});
