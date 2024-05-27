import Image from "next/image";

export default function Home() {
	return (
		<>
			<h1 className="mt-3 text-center">Next.js + Docker</h1>
			<Image
				src="/vercel.svg"
				alt="Vercel Logo"
				width={283}
				height={64}
			/>
		</>
	);
}
