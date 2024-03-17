import { useState, FC } from 'react';
import { Card } from './components/Card';

export const App: FC = () => {
  const [isAdmin, setIsAdmin] = useState<boolean>(false);

  const onClickSwitch = () => setIsAdmin(!isAdmin);

  return (
    <div>
      {isAdmin ? <span>管理者ユーザーです</span> : <span>一般ユーザーです</span>}
      <button onClick={onClickSwitch}>切り替え</button>
      <Card isAdmin={isAdmin} />
    </div>
  );
};
