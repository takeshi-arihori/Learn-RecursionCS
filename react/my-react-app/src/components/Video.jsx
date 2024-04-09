import { useEffect, useRef, useState } from "react";

function VideoPlayer({ isPlaying, src }) {
    const videoRef = useRef(null);

    useEffect(() => {
        if (isPlaying) {
            console.log("Calling video play()");
            videoRef.current.play();
        } else {
            console.log("Calling video pause()");
            videoRef.current.pause();
        }
    }, [isPlaying]);
    return <video ref={videoRef} src={src} controls />;
}

export default function Video() {
    const [isPlaying, setIsPlaying] = useState(false);
    const [text, setText] = useState("");
    return (
        <>
            <VideoPlayer
                isPlaying={isPlaying}
                src="https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4"
            />
            {/* ボタンを中央に配置するためのdiv要素を追加 */}
            {/* ボタンの装飾をtailwindcssで行う */}
            {/* play: 青色、hover時: 濃い青色、文字色: 白 */}
            <div className="flex flex-row w-96">
                <div className="basis-3/4">
                    <input
                        type="text"
                        value={text}
                        onChange={(e) => setText(e.target.value)}
                        className="border border-gray-400 p-2 w-1/2"
                    />
                </div>
                <div className="basis-1/4">
                    <button
                        className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        onClick={() => setIsPlaying(!isPlaying)}
                    >
                        {isPlaying ? "Pause" : "Play"}
                    </button>
                </div>
            </div>
        </>
    );
}
