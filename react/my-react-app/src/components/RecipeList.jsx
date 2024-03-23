import { useState } from "react";

export const RecipeList = () => {
    const [recipes, setRecipes] = useState([]);
    const [newRecipe, setNewRecipe] = useState("");
    const [newDetails, setNewDetails] = useState("");
    const [showDetails, setShowDetails] = useState(null);

    const addRecipe = (e) => {
        e.preventDefault();
        if (!newRecipe.trim()) return;
        setRecipes([
            ...recipes,
            { id: Date.now(), name: newRecipe, details: newDetails },
        ]);
        setNewRecipe(""); // フォームをクリア
        setNewDetails(""); // フォームをクリア
    };

    return (
        <div className="max-w-4xl mx-auto py-8 px-4">
            <h2 className="text-3xl font-bold text-center text-gray-800 mb-8">
                料理レシピ共有アプリ
            </h2>
            <form onSubmit={addRecipe} className="mb-8">
                <input
                    type="text"
                    className="w-full p-2 border border-gray-300 rounded-md mb-4"
                    placeholder="レシピ名"
                    value={newRecipe}
                    onChange={(e) => setNewRecipe(e.target.value)}
                />
                <textarea
                    className="w-full p-2 border border-gray-300 rounded-md mb-4"
                    placeholder="レシピの詳細を入力..."
                    value={newDetails}
                    onChange={(e) => setNewDetails(e.target.value)}
                    rows="4"
                ></textarea>
                <button
                    type="submit"
                    className="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors"
                >
                    レシピを追加
                </button>
                <button
                    type="button"
                    onClick={() => setRecipes([])}
                    className="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors"
                >
                    レシピをリセット
                </button>
            </form>
            <ul className="recipe-list space-y-2">
                {recipes.map((recipe) => (
                    <li
                        key={recipe.id}
                        className="p-4 border border-gray-200 rounded-md cursor-pointer hover:bg-gray-100 transition-colors flex justify-between items-center"
                    >
                        <span>{recipe.name}</span>
                        <div>
                            <button
                                onClick={() =>
                                    setRecipes(
                                        recipes.filter(
                                            (r) => r.id !== recipe.id
                                        )
                                    )
                                }
                                className="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600 transition-colors mr-2"
                            >
                                削除
                            </button>
                            <button
                                onClick={() =>
                                    setShowDetails(
                                        showDetails === recipe.id
                                            ? null
                                            : recipe.id
                                    )
                                }
                                className="bg-blue-500 text-white px-2 py-1 rounded-md hover:bg-blue-600 transition-colors"
                            >
                                {showDetails === recipe.id
                                    ? "詳細を閉じる"
                                    : "詳細を表示"}
                            </button>
                        </div>
                    </li>
                ))}
            </ul>
            {showDetails && (
                <div className="mt-4 p-4 border border-gray-200 rounded-md">
                    {recipes.find((recipe) => recipe.id === showDetails)
                        ?.details || "詳細がありません。"}
                </div>
            )}
            <div className="mt-8 text-center font-semibold">
                レシピ総数: {recipes.length}
            </div>
        </div>
    );
};
