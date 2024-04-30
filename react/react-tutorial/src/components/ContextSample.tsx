import { createContext, useContext } from "react";

const TitleContext = createContext<string>("");

const Title = () => {

	const titleContext = useContext<string>(TitleContext);
	return <h1>{titleContext ? titleContext : '値なし'}</h1>
}

const Header = () => {
	return (
		<div>
			{/* HeaderからTitleへは何もデータを渡さない */}
			<Title />
		</div>
	)
}

const Page = () => {
	const title = 'React Book'

	return (
		<TitleContext.Provider value={title}>
			<Header />
		</TitleContext.Provider>
	)
}

export default Page;