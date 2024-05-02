import { AppProps } from "next/app";
import { ThemeProvider } from "styled-components";
import { theme } from './theme';

const MyApp = ({ Component, pageProps }: AppProps) => {
	// styled-componentsでテーマを使用するためにThemeProviderを置く
	return (
		<ThemeProvider theme={theme}>
			<Component {...pageProps} />
		</ThemeProvider>
	)
}

export default MyApp