"use client";
import { useEffect, useState } from "react";

export const CountryCode = () => {
    const [countries, setCountries] = useState([]);

    useEffect(() => {
        fetch("https://restcountries.com/v2/all")
            .then((res) => res.json())
            .then((data) => {
                const randomContry =
                    data[Math.floor(Math.random() * data.length)];
                setCountries(randomContry);
            });
    }, []);
    return (
        <>
            <h1>Random Country Information</h1>
            {countries ? (
                <div>
                    <h2>{countries.name}</h2>
                    <p>Capital: {countries.capital}</p>
                    <p>Population: {countries.population}</p>
                    <p>Region: {countries.region}</p>
                    <p>Subregion: {countries.subregion}</p>
                    <p>Area: {countries.area}</p>
                    <p>Timezones: {countries.timezones}</p>
                    <p>Calling Codes: {countries.callingCodes}</p>
                    <p>Top Level Domain: {countries.topLevelDomain}</p>
                    <img
                        style={{ width: "300px", height: "200px" }}
                        src={countries.flag}
                        alt={`Flag of ${countries.name}`}
                        className="flagImage"
                    />
                </div>
            ) : (
                <p>Loading...</p>
            )}
        </>
    );
};
