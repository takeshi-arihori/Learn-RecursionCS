import './App.css';

// プログラミング言語のデータを持つ配列を定義します。
// この配列は、オブジェクトのリストで、各オブジェクトはプログラミング言語の名前(name)、
// 言語に関する短い説明(description)、そして言語を象徴する画像のURL(imgUrl)を持ちます。
const programmingLanguages = [
  {
    name: 'JavaScript',
    description: 'JavaScriptです。Webブラウザ上で動きます。',
    imgUrl: 'https://recursionist.io/img/feature-1.png',
  },
  {
    name: 'Java',
    description: 'Javaです。主に特にクライアント/サーバモデルのWebアプリケーションで使用',
    imgUrl: 'https://recursionist.io/img/feature-2.png',
  },
  {
    name: 'Python',
    description:
      'Pythonです。データサイエンスやウェブ開発、自動化スクリプトなど幅広い用途で使用されます。',
    imgUrl: 'https://recursionist.io/img/feature-3.png',
  },
];

// ProgramingCard関数コンポーネントは、個々のプログラミング言語に関する情報を表示するために使用されます。
// Propsを通してname, description, imgUrlを受け取り、それらをカード形式で表示します。
function ProgramingCard(Props) {
  // Propsからname, description, imgUrlをデストラクチャリングを使って展開し、
  // 各変数に代入します。これにより、Props.nameのように書く代わりに直接アクセスできます。
  const { name, description, imgUrl } = Props;

  // JSXを返します。ここでは、各プログラミング言語の情報をカード形式で表示しています。
  // カードは画像(imgBoxとimg)、プログラミング言語の名前(programingNameとh2)、
  // そしてその説明(programingDescriptionとp)で構成されています。

  return (
    <div className="cardContainer">
      <div className="imgBox">
        <img src={imgUrl} />
      </div>
      <div className="programmingName">
        <h2>{name}</h2>
      </div>
      <div className="programmingDescription">
        <p>{description}</p>
      </div>
    </div>
  );
}

// App関数コンポーネントはアプリケーションのルートコンポーネントで、
// 上記で定義したプログラミング言語のリストを表示します。
export default function App() {
  // ここでもJSXを返します。このコンポーネントは、全てのプログラミング言語カードを含む
  // コンテナ(div.cards)と、ページのタイトル(h1)を表示します。
  return (
    <div>
      <h1>Programming Languages List</h1> {/* リストのタイトル */}
      <div className="cards">
        {/* programmingLanguages配列をmap関数で繰り返し処理し、
                    配列の各要素に対してProgramingCardコンポーネントを生成します。
                    keyプロパティには一意な値（ここでは配列のインデックス）が必要です。
                    Reactでは、keyプロパティがリスト内の各要素の一意性を識別するために使用されます。
                    https://ja.react.dev/learn/rendering-lists#keeping-list-items-in-order-with-key
                */}
        {programmingLanguages.map((info, i) => (
          <ProgramingCard
            key={i}
            name={info.name}
            description={info.description}
            imgUrl={info.imgUrl}
          />
        ))}
      </div>
    </div>
  );
}

// CSS
