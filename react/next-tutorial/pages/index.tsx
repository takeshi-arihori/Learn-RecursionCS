import type { NextPage } from 'next'
import styled from 'styled-components'

const Badge = styled.span`
	padding: 8px 16px;
	font-weight: bold;
	text-align: center;
	color: white;
	background-color: red;
	border-radius: 16px;
`

const Page: NextPage = () => {
	return <Badge>Next.js</Badge>
}

export default Page