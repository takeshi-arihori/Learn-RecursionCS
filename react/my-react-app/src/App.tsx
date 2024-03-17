import React, { useContext, FC } from 'react';
import { AdminFlagContext } from './components/providers/AdminFlagProvider';
import { Card } from './components/Card';

export const App: FC = () => {
  const context = useContext(AdminFlagContext);

  if (!context) {
    throw new Error('useContext must be used within a AdminFlagProvider');
  }

  const { isAdmin, setIsAdmin } = context;

  const onClickSwitch = () => setIsAdmin(!isAdmin);

  return (
    <div className='m-2 text-center'>
      {isAdmin ? <span className='p-2'>管理者ユーザーです</span> : <span className='p-2'>一般ユーザーです</span>}
      <button
        className="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors"
        onClick={onClickSwitch}
      >
        ユーザー切り替え
      </button>
      <Card isAdmin={isAdmin} />
    </div>
  );
};
