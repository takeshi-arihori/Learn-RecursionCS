import { ComponentMeta, ComponentStory } from '@storybook/react'
import { StyledButton } from '@/components/StyledButton'
import MDXDocument from './StyledButton.mdx'

export default {
	title: 'StyledButton',
	component: StyledButton,
	parameters: {
		docs: {
			// ドキュメント用のmdxコンポーネントを指定
			page: MDXDocument,
		},
	},
} as ComponentMeta<typeof StyledButton>

// テンプレートコンポーネントを実装
// Storybookから渡されたpropsをそのままButtonに渡す
const Template: ComponentStory<typeof StyledButton> = (args) => (
	<StyledButton {...args} />
)

// bindを呼び出しStoryを作成
export const TemplateTest = Template.bind({})

// デフォルトのpropsを設定する
TemplateTest.args = {
	variant: 'primary',
	children: 'Primary',
}