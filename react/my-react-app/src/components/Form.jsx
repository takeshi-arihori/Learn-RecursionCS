import { useState } from "react";

export function Form() {
  const [person, setPerson] = useState({
    name: "Niki de Saint Phalle",
    artwork: {
      title: "Blue Nana",
      city: "Hamburg",
      image: "https://i.imgur.com/Sd1AgUOm.jpg",
    },
  });

  function handleNameChange(e) {
    setPerson({
      ...person,
      name: e.target.value,
    });
  }

  function handleTitleChange(e) {
    setPerson({
      ...person,
      artwork: {
        ...person.artwork,
        title: e.target.value,
      },
    });
  }

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

  function handleImageChange(e) {
    setPerson({
      ...person,
      artwork: {
        ...person.artwork,
        image: e.target.value,
      },
    });
  }

  return (
    <div className="space-y-4">
      <div>
        <label className="block text-sm font-medium text-gray-700">
          Name:
          <input
            className="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
            value={person.name}
            onChange={handleNameChange}
          />
        </label>
      </div>
      <div>
        <label className="block text-sm font-medium text-gray-700">
          Title:
          <input
            className="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
            value={person.artwork.title}
            onChange={handleTitleChange}
          />
        </label>
      </div>
      <div>
        <label className="block text-sm font-medium text-gray-700">
          City:
          <input
            className="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
            value={person.artwork.city}
            onChange={handleCityChange}
          />
        </label>
      </div>
      <div>
        <label className="block text-sm font-medium text-gray-700">
          Image:
          <input
            className="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
            value={person.artwork.image}
            onChange={handleImageChange}
          />
        </label>
      </div>
      <p className="text-gray-700">
        <i>{person.artwork.title}</i>
        {" by "}
        {person.name}
        <br />
        (located in {person.artwork.city})
      </p>
      <img
        className="max-w-xs mx-auto mt-4 rounded-lg shadow-md"
        src={person.artwork.image}
        alt={person.artwork.title}
      />
    </div>
  );
}
