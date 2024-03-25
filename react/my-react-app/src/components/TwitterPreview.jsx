import { useState } from "react";

export const TwitterPreview = () => {
    const [tweetData, setTweetData] = useState(null);

    const handleTweetChange = (tweetData) => {
        setTweetData({
            ...tweetData,
            timestamp: formattedTimestamp,
        });
    };

    const timestamp = new Date();

    const formattedTimestamp =
        new Intl.DateTimeFormat("en-US", {
            year: "numeric",
            month: "short",
            day: "numeric",
            hour: "numeric",
            minute: "numeric",
            second: "numeric",
            hour12: true,
        }).format(timestamp) + " - Twitter Web App";

    return (
        <div className="container mx-auto px-4 py-8">
            <TweetForm onTweetSubmit={handleTweetChange} />
            {tweetData && <TweetPreview tweetData={tweetData} />}
        </div>
    );
};

const TweetForm = ({ onTweetSubmit }) => {
    const [tweet, setTweet] = useState({
        name: "",
        id: "",
        content: "",
        icon: "",
    });

    const handleChange = (e) => {
        setTweet({ ...tweet, [e.target.name]: e.target.value });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        onTweetSubmit(tweet);
    };

    return (
        <form onSubmit={handleSubmit} className="space-y-4">
            <div className="flex flex-wrap -mx-3 mb-6">
                <div className="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label
                        className="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        htmlFor="name"
                    >
                        Name
                    </label>
                    <input
                        className="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                        name="name"
                        value={tweet.name}
                        onChange={handleChange}
                        placeholder="Enter your name"
                    />
                </div>
                <div className="w-full md:w-1/2 px-3">
                    <label
                        className="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        htmlFor="id"
                    >
                        ID
                    </label>
                    <input
                        className="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                        name="id"
                        value={tweet.id}
                        onChange={handleChange}
                        placeholder="Enter your ID"
                    />
                </div>
            </div>
            <div className="mb-6">
                <label
                    className="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                    htmlFor="content"
                >
                    Tweet Content
                </label>
                <textarea
                    className="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                    name="content"
                    value={tweet.content}
                    onChange={handleChange}
                    rows="4"
                    placeholder="What's happening?"
                ></textarea>
            </div>
            <button
                type="submit"
                className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            >
                Create Tweet
            </button>
        </form>
    );
};

const TweetPreview = ({ tweetData }) => {
    return (
        <div className="mt-8">
            <h3 className="text-lg font-semibold mb-4">Preview</h3>
            <TweetSimple tweetData={tweetData} />
            <TweetDetail tweetData={tweetData} />
        </div>
    );
};

const TweetSimple = ({ tweetData }) => {
    return (
        <div className="border p-4 rounded-lg mb-4">
            <div className="flex justify-between items-center mb-4">
                <span className="font-bold">{tweetData.name}</span>
                <span>Apr 2</span>
            </div>
            <p>{tweetData.content}</p>
            <div className="flex justify-between items-center mt-4">
                <span>57K Retweets</span>
                <span>246.1K Quote Tweets</span>
                <span>1.3M Likes</span>
            </div>
        </div>
    );
};

const TweetDetail = ({ tweetData }) => {
    return (
        <div className="border p-4 rounded-lg">
            <div className="mb-4">
                <span className="font-bold">{tweetData.name}</span>
                <span className="ml-2 text-sm text-gray-500">
                    @{tweetData.id} • {tweetData.timestamp}
                </span>
            </div>
            <p>{tweetData.content}</p>
            <div className="flex justify-between items-center mt-4">
                <span>118.3K Retweets</span>
                <span>127.8K Quote Tweets</span>
                <span>1.3M Likes</span>
            </div>
        </div>
    );
};
