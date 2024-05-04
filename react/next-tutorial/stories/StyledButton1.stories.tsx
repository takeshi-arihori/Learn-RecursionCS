import { useState } from 'react';
import { ComponentMeta } from '@storybook/react';
import { StyledButton } from '../components/StyledButton';
// 新しくactionをインポート
import { action } from '@storybook/addon-actions';

export default {
	title: 'StyledButton',
	component: StyledButton,
} as ComponentMeta<typeof StyledButton>;

// incrementという名前でactionを出力するための関数を作る
const incrementAction = action('increment');

export const Primary = (props) => {
	const [count, setCount] = useState(0);
	const onClick = (e: React.MouseEvent) => {
		// 現在のカウントを渡してincrementActionを呼び出す
		incrementAction(e, count);
		setCount((c) => c + 1)
	}

	return (
		<StyledButton onClick={onClick} variant='primary' {...props}>
			Count: {count}
		</StyledButton>
	)
}
