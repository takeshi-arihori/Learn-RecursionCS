import type { NextPage } from 'next'
import styled from 'styled-components'

// propsを使用しスタイルを制御
type ButtonProps = {
	color: string
	backgroundColor: string
}

// 文字色と背景色がpropsから変更可能なボタンコンポーネント
// 型引数にpropsの型を渡す
const Button = styled.button<ButtonProps>`
/* color, background, border-colorはpropsから渡す */
	color: ${({ color }) => color};
	background: ${(props) => props.backgroundColor};
	border: 2px solid ${({ color }) => color};

	font-size: 2em;
	margin: 1em;
	padding: .25em 1em;
	border-radius: 8px;
	cursor: pointer;
`

const Page: NextPage = () => {
	return (
		<div>
			{/* 赤色の文字で透明な背景のボタンを表示 */}
			<Button backgroundColor='transparent' color='#FF0000'>
				Hello
			</Button>
			{/* 白色の文字で青色の背景のボタンを表示 */}
			<Button backgroundColor='#1E90FF' color='white'>
				World
			</Button>
		</div>
	)
}

export default Page