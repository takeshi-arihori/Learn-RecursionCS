import type { NextPage } from 'next'
import styled, { css } from 'styled-components'

// 赤色のボーダーを表示するスタイル
const redBox = css`
	padding: 0.25em 1em;
	border: 3px solid #ff0000;
	border-radius: 10px;
`

// 青色文字を表示するスタイル
const font = css`
	color: #1e90ff;
	font-size: 2em;
`

// 赤色ボーダーと青色文字のスタイルをそれぞれ適用し、背景が透明なボタンコンポーネント
const Button = styled.button`
	background: transparent;
	margin: 1em;
	cursor: pointer;

	${redBox}
	${font}
`

// 青色文字のスタイルを継承し、ボールドでテキストを表示するコンポーネント
const Text = styled.p`
	font-weight: bold;

	${font}
`

const Page: NextPage = () => {
	return (
		<div>
			{/* 青色文字で赤色ボーダーのボタンを表示 */}
			<Button>Hello</Button>
			{/* 青色文字のテキストを表示 */}
			<Text>World</Text>
		</div>
	)
}

export default Page