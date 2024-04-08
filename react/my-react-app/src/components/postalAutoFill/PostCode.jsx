import AddressInputForm from "./AddressInputForm";

export const PostCode = () => {
    return (
        <div className="min-h-screen flex flex-col justify-center items-center bg-rose-50">
            <h1 className="text-3xl font-bold text-center text-rose-600">
                Postal Code AutoFill
            </h1>
            <div className="mt-8 w-full max-w-md px-4">
                <AddressInputForm />
            </div>
        </div>
    );
};

export default PostCode;
