export default function ProfileCard({
    name,
    age,
    sex,
    profession = "NO PROFESSION",
}) {
    return (
        <div>
            <h3>Card</h3>
            <div>
                <p>Name: {name}</p>
                <p>Age: {age}</p>
                <p>Sex: {sex}</p>
                <p>Profession: {profession}</p>
            </div>
        </div>
    );
}
