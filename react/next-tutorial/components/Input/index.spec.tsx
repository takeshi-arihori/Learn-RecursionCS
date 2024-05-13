import { render, screen, RenderResult } from '@testing-library/react'
import { Input } from './index'
import { afterEach } from 'node:test'
import { expect } from '@storybook/test'

// describeで処理をまとめる
describe('Input', () => {
	let renderResult: RenderResult

	// それぞれのテストケース前にコンポーネントを描画し、renderResultにセットする
	beforeEach(() => {
		renderResult = render(<Input id="username" label="Username" />)
	})

	// テストケース実行後に描画していたコンポーネントを解放する
	afterEach(() => {
		renderResult.unmount()
	})

	// 初期描画時にinput要素が空であることをテスト
	it('should empty in input on initial render', () => {
		// labelがUsernameであるコンポーネントに対応するinputの要素を取得する
		const inputNode = screen.getByLabelText('Username') as HTMLInputElement

		// input要素の表示がからか確認する
		expect(inputNode).toHaveValue('')
	})
})