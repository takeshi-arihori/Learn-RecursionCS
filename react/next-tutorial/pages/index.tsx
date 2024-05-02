import { NextPage } from 'next'
import Link, { LinkProps } from 'next/link'
import styled from 'styled-components'
// Next.jsのコンポーネントにスタイルを使用

type BaseLinkProps = React.PropsWithChildren<LinkProps> & {
	className?: string
	children: React.ReactNode
}

// Next.jsのリンクにスタイルを適用するためのヘルパーコンポーネント
// このコンポーネントをstyled-componentsで使用すると、定義したスタイルに対応するclassNameがpropsとして渡される
// このclassNameをa要素に渡す
const BaseLink = (props: BaseLinkProps) => {
	const { className, children, ...rest } = props
	return (
		<Link {...rest} legacyBehavior>
			<a className={className}>{children}</a>
		</Link>
	)
}

const Text = styled.span`
	/* themeから値を参照してスタイルを適用 */
	color: ${(props) => props.theme.colors.red};
	font-size: ${(props) => props.theme.fontSizes[3]};
	margin: ${(props) => props.theme.space[2]};
`

const StyledLink = styled(BaseLink)`
	color: #1e90ff;
	font-size: 2em;
`

const Page: NextPage = () => {
	return (
		<div>
			{/* 青色のリンクを表示する */}
			<StyledLink href="/">Go to index</StyledLink>
			<Text>Themeから参照した色を使用しています。</Text>
		</div>
	)
}

export default Page