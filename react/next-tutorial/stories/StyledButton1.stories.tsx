// argTypeを使用してUIからpropsを制御するストーリー
import { ComponentStory, ComponentMeta } from '@storybook/react'
import { StyledButton } from '../components/StyledButton'
import { title } from 'process'

export default {
	title: 'StyledButton',
	component: StyledButton,
	argTypes: {
		// propsに渡すvariantをStorybookから変更できるように追加
		variant: {
			// ラジオボタンで設定できるように指定
			control: { type: 'radio' },
			options: ['primary', 'success', 'transparent'],
		},
		// propsに渡すchildrenをStorybookから変更できるように追加
		children: {
			// テキストボックスで入力できるよう設定
			control: { type: 'text' },
		},
	},
} as ComponentMeta<typeof StyledButton>

// テンプレートコンポーネントを実装
// Storybookから渡されたpropsをそのままButtonに渡す
const Template: ComponentStory<typeof StyledButton> = (args) => <StyledButton {...args} />

// 各propsを設定してStorybookで表示
export const Primary = Template.bind({})
Primary.args = {
	variant: 'primary',
	children: 'Primary',
}