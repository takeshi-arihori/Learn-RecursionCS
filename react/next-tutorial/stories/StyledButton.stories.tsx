import { ComponentMeta, Story } from '@storybook/react'
import { StyledButton, StyledButtonProps } from '../components/StyledButton'
import { linkTo } from '@storybook/addon-links'

export default {
	title: 'StyledButton',
	component: StyledButton,
} as ComponentMeta<typeof StyledButton>

const Template: Story<StyledButtonProps> = (args) => <StyledButton {...args} />

export const TemplateTest = Template.bind({})
TemplateTest.args = {
	variant: 'primary',
	children: 'Primary',
}

export const Primary = (props) => {
	// クリックしたらStyledButton/Successのストーリーへ遷移する
	return (
		<StyledButton {...props} variant='primary' onClick={linkTo('StyledButton', 'Success')}>
			Primary
		</StyledButton>
	)
}

export const Success = (props) => {
	// クリックしたらStyledButton/Transparentのストーリーへ遷移する
	return (
		<StyledButton {...props} variant='success' onClick={linkTo('StyledButton', 'Transparent')}>
			Success
		</StyledButton>
	)
}

export const Transparent = (props) => {
	// クリックしたらStyledButton/Primaryのストーリーへ遷移する
	return (
		<StyledButton {...props} variant='transparent' onClick={linkTo('StyledButton', 'Primary')}>
			Transparent
		</StyledButton>
	)
}