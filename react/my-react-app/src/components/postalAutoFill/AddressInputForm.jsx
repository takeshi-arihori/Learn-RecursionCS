import { useEffect, useState } from "react";

const joinWithoutNullOrUndefined = (...parts) =>
    parts.filter((part) => part != null).join("");

const normalizeAddress = ({
    prefecture_kana,
    city_kana,
    suburb_kana,
    prefecture,
    city,
    suburb,
    street_address,
    office,
    office_kana,
    office_roman,
    prefecture_roman,
    city_roman,
    suburb_roman,
}) => {
    return {
        kana: joinWithoutNullOrUndefined(
            prefecture_kana,
            city_kana,
            suburb_kana,
            street_address,
            office_kana
        ),
        kanji: joinWithoutNullOrUndefined(
            prefecture,
            city,
            suburb,
            street_address,
            office
        ),
        roman: joinWithoutNullOrUndefined(
            prefecture_roman,
            city_roman,
            suburb_roman,
            street_address,
            office_roman
        ),
    };
};

const getAddressFormPostCode = async (postCode) => {
    const apiUrl = `https://postcode.teraren.com/postcodes/${postCode}.json`;

    return await fetch(apiUrl)
        .then((res) => {
            if (!res.ok) throw new Error("Network response was not ok!!");
            return res.json();
        })
        .then((address) => normalizeAddress(address));
};

export const AddressInputForm = () => {
    const [postCode, setPostCode] = useState("");
    const [address, setAddress] = useState({ kana: "", kanji: "", roman: "" });
    const [error, setError] = useState("");

    useEffect(() => {
        if (postCode.length === 7) {
            getAddressFormPostCode(postCode)
                .then((normalizedAddress) => {
                    setAddress(normalizedAddress);
                    setError("");
                })
                .catch((err) => {
                    setError("住所情報を取得できませんでした。");
                    console.error(err);
                });
        }
    }, [postCode]);

    return (
        <div className="p-4">
            <div className="flex flex-col gap-4">
                <div className="flex flex-col">
                    <label
                        htmlFor="zipcode"
                        className="font-semibold text-rose-600"
                    >
                        郵便番号:
                    </label>
                    <input
                        type="text"
                        id="zipcode"
                        value={postCode}
                        onChange={(e) => setPostCode(e.target.value)}
                        placeholder="1234567"
                        className="mt-1 p-2 border border-rose-300 rounded-md focus:outline-none focus:ring-2 focus:ring-rose-500"
                    />
                    {error && (
                        <p className="text-red-500 text-sm mt-2">{error}</p>
                    )}
                </div>
                <div>
                    <label className="font-semibold text-rose-600">
                        住所(カナ):
                        <input
                            type="text"
                            value={address.kana}
                            readOnly
                            className="ml-2 p-2 border border-rose-300 rounded-md"
                        />
                    </label>
                </div>
                <div>
                    <label className="font-semibold text-rose-600">
                        住所(漢字)
                        <input
                            type="text"
                            value={address.kanji}
                            readOnly
                            className="ml-2 p-2 border border-rose-300 rounded-md"
                        />
                    </label>
                </div>
                <div>
                    <label className="font-semibold text-rose-600">
                        住所(ローマ字):
                        <input
                            type="text"
                            value={address.roman}
                            readOnly
                            className="ml-2 p-2 border border-rose-300 rounded-md"
                        />
                    </label>
                </div>
            </div>
        </div>
    );
};

export default AddressInputForm;
