import { useCallback, useState } from "react";

export const Form = () => {
  const [name, setName] = useState("Taylor");
  const [age, setAge] = useState(42);
  const [email, setEmail] = useState("zzz@gmail.com");

  const clickAge = useCallback(() => {
    setAge(age + 1);
  }, [age]);

  const changeEmail = useCallback(
    (e) => {
      setEmail(e.target.value);
    },
    [email]
  );

  return (
    <div className="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-4">
      <input
        className="px-4 py-2 mb-4 border rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
        value={name}
        onChange={(e) => setName(e.target.value)}
      />
      <button
        className="px-4 py-2 mb-4 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        onClick={clickAge}
      >
        Increment Age
      </button>
      <input
        className="px-4 py-2 mb-4 border rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
        value={email}
        onChange={changeEmail}
      />
      <p className="text-lg text-gray-700">
        Hello, {name}. You are {age} years old. Your email is {email}.
      </p>
    </div>
  );
};
