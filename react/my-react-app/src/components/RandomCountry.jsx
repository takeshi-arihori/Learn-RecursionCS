import { useState, useEffect } from "react";

export const RandomCountry = () => {
    const [country, setCountry] = useState(null);
    const [fetchCount, setFetchCount] = useState(0);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(() => {
        setIsLoading(true);
        fetch("https://restcountries.com/v2/all")
            .then((res) => res.json())
            .then((data) => {
                const randomCountry =
                    data[Math.floor(Math.random() * data.length)];
                setCountry(randomCountry);
                setIsLoading(false);
            })
            .catch((error) => {
                console.error("Error fetching country:", error);
                setError("Failed to fetch country data. Please try again.");
                setIsLoading(false);
            });
    }, [fetchCount]);

    return (
        <div className="max-w-md mx-auto my-10 bg-white shadow-md overflow-hidden md:max-w-2xl">
            <h1 className="text-center text-3xl font-semibold text-gray-800 py-4">
                Random Country Information
            </h1>
            {error && <p className="text-center text-red-500">{error}</p>}
            {isLoading ? (
                <p className="text-center text-gray-800">Loading...</p>
            ) : country ? (
                <div className="p-4">
                    <h2 className="text-2xl text-gray-800 font-bold">
                        {country.name}
                    </h2>
                    <p className="text-gray-700">首都: {country.capital}</p>
                    <p className="text-gray-700">
                        人口: {country.population.toLocaleString()}
                    </p>
                    <p className="text-gray-700">
                        言語:{" "}
                        {country.languages.map((lang) => lang.name).join(", ")}
                    </p>
                    <div className="my-4">
                        <img
                            src={country.flag}
                            alt={`Flag of ${country.name}`}
                            className="mx-auto w-48 h-auto"
                        />
                    </div>
                    <button
                        onClick={() => {
                            setError(null); // 以前のエラーをクリア
                            setFetchCount((prev) => prev + 1);
                        }}
                        className={`mt-4 px-4 py-2 ${
                            isLoading
                                ? "bg-gray-500"
                                : "bg-blue-500 hover:bg-blue-700"
                        } text-white rounded focus:outline-none focus:shadow-outline`}
                        disabled={isLoading}
                    >
                        別の国を表示
                    </button>
                </div>
            ) : null}
        </div>
    );
};
