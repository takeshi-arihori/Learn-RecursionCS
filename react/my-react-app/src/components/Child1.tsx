import { Child2 } from './Child2';
import { Child3 } from './Child3';
import { memo, FC } from 'react';

const style = {
    height: "200px",
    backgroundColor: "lightblue",
    padding: "8px"
};

// memo化する
export const Child1: FC = memo((props) => {
    console.log("Child1レンダリング！");

    const { onClickReset } = props;

    return (
        <div style={style}>
            <p>Child1</p>
            <button className='px-4 py-2 m-2 bg-green-400 text-white font-semibold rounded-lg hover:bg-green-600 transition-colors' onClick={onClickReset}>リセット</button>
            <Child2 />
            <Child3 />
        </div>
    );
});