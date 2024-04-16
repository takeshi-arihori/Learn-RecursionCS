import React from "react";
import { useSelector, useDispatch } from "react-redux";
import { increment, decrement } from "./actions";

const CounterComponent = () => {
    // Reduxストアからカウントの値を取得
    const count = useSelector((state) => state.count);
    // アクションをディスパッチするための関数を取得
    const dispatch = useDispatch();

    return (
        <div>
            <p>Count: {count}</p>
            <button onClick={() => dispatch(increment())}>Increment</button>
            <button onClick={() => dispatch(decrement())}>Decrement</button>
        </div>
    );
};

export default CounterComponent;
