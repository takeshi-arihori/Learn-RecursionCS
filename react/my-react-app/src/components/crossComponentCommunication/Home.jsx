import { useReducer } from "react";
import { UserProvider } from "./context/UserProvider";
import HomePage from "./HomePage";
import AboutPage from "./AboutPage";

export const Home = () => {
    const initialPage = "home";
    const [currentPage, setCurrentPage] = useReducer((state, action) => {
        switch (action) {
            case "home":
                return "home";
            case "about":
                return "about";
            default:
                return state;
        }
    }, initialPage);

    return (
        <UserProvider>
            <div className="w-full">
                <h3 className="m-auto p-3 text-center">{currentPage}ページ</h3>
                {/* <button>Homeに戻る</button> tailwindで装飾 */}
                <div className="flex w-full justify-center">
                    <button
                        className="m-2 p-2 bg-blue-500 text-white"
                        onClick={() => setCurrentPage("about")}
                    >
                        Aboutページへ
                    </button>
                    {/* <button>Aboutページへ</button> tailwindで装飾 */}
                    <button
                        className="m-2 p-2 bg-green-500 text-white"
                        onClick={() => setCurrentPage("home")}
                    >
                        HomePageへ
                    </button>
                </div>
                <div className="text-center">
                    {currentPage === "home" ? <HomePage /> : <AboutPage />}
                </div>
            </div>
        </UserProvider>
    );
};
