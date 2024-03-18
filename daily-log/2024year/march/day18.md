# 2024 年 03 月 18 日

## 本日の目標(朝一番に確認してから学習開始)

- **React, TypeScript**: 4H

## 目標振り返り

### 読書 オブジェクト指向でなぜつくるのか:

### React, TypeScript:

- **useState**
  State は読み取り専用として扱う必要がある。もし State を更新する場合は書き換えるのではなく置き換える(replace)。
- ネストされたオブジェクト: 更新するオブジェクトのコピーを作成する必要がある。さらに、そのオブジェクトを内容する上位のオブジェクトも同様に、コピーを作成する必要がある。

- **ネストされたオブジェクトの更新例**

**artwork オブジェクトの中の city プロパティの値を更新する例**

```
  // useStateの宣言
  const [person, setPerson] = useState({
    name: "Niki de Saint Phalle",
    artwork: {
      title: "Blue Nana",
      city: "Hamburg",
      image: "https://i.imgur.com/Sd1AgUOm.jpg",
    },
  });

  // ハンドラー関数
  function handleCityChange(e) {
    setPerson({
      // まず、現在のpersonオブジェクトのコピーを作ります。
      // これにより、personオブジェクトの他のプロパティ（この場合はnameとartwork）は
      // そのまま保持されます。
      ...person,
      artwork: {
        // 次に、person.artwork（ネストされたオブジェクト）のコピーを作ります。
        // これにより、artworkオブジェクトの他のプロパティ（この場合はtitleとimage）は
        // そのまま保持されます。
        ...person.artwork,
        // 最後に、cityプロパティを更新します。
        // e.target.valueには、入力された新しい都市の名前が含まれています。
        // この操作で、artworkオブジェクトのcityのみが新しい値に更新され、
        // 他のプロパティはそのまま保持されます。
        city: e.target.value,
      },
    });
  }

  // 呼び出し側の処理
    <label className="block text-sm font-medium text-gray-700">
      City:
      <input
        className="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
        value={person.artwork.city}
        onChange={handleCityChange}
      />
    </label>
```

## 合計学習時間

- H

## 明日の目標（TODO 目標/できるようになりたいこと）

- **React, TypeScript**: 4H
