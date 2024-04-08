import Image from "next/image";
import styles from "./page.module.css";
import { CountryCode } from "./components/CountryCode";

export default function Home() {
    return (
        <main className={styles.main}>
            <CountryCode />
        </main>
    );
}
