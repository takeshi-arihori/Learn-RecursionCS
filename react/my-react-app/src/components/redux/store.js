import { createStore } from 'redux';
import counterReducer from './reducers';

// ストアの作成
const store = createStore(counterReducer);

export default store;