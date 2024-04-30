import { GetServerSideProps, NextPage } from 'next';
import Head from 'next/head';

type SSRProps = {
	message: string
};

const SSR: NextPage<SSRProps> = (props) => {
	const { message } = props

	return (
		<div>
			<Head>
				<title>Cerate Next App</title>
				<link rel="icon" href="/favicon.ico" />
			</Head>
			<main>
				<p>
					このページはサーバーサイドレンダリングによってアクセス時にサーバーで描画されたページです。
				</p>
				<p>{message}</p>
			</main>
		</div>
	)
}

// geetServerSidePropsはページへのリクエストがある度に実行される
export const getServerSideProps: GetServerSideProps<SSRProps> = async (context) => {
	const timestamp = new Date().toLocaleString();
	const message = `${timestamp} にgetServerSidePropsが実行されました。`;
	console.log(message);
	return {
		props: {
			message,
		},
	}
}

export default SSR;