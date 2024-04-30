import { NextPage } from "next";
import Image from "next/image";
// 画像ファイルをインポートする
import BibleImage from '../public/images/bible.jpeg';

const ImageSample: NextPage<void> = (props) => {
	return (
		<div>
			<h1>画像の比較</h1>
			<p>imgタグで表示した場合</p>
			{/* 通常のimgタグを使用して画像を表示 */}
			<img src="/images/bible.jpeg" />
			<p>Imageコンポーネントで表示した場合</p>
			<Image src={BibleImage} placeholder="blur" />
			<p>Imageで表示した場合は事前に描画エリアが確保される</p>
		</div>
	);
}

export default ImageSample;