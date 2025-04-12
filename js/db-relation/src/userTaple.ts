class User {
    userId: number;
    userName: string;
    email: string;
    password: string;
    dateOfBirth: string;
    countryCode: number;
    type: string;

    constructor(userId: number, userName: string, email: string, password: string, dateOfBirth: string, countryCode: number, type: string) {
        this.userId = userId;
        this.userName = userName;
        this.email = email;
        this.password = password;
        this.dateOfBirth = dateOfBirth;
        this.countryCode = countryCode;
        this.type = type;
    }

    static printUsersRelation(relation: User[]) {
        console.log("---Printing users---");
        for (let i = 0; i < relation.length; i++) {
            console.log(`UserId: ${relation[i].userId}, UserName: ${relation[i].userName}, Email: ${relation[i].email}, Password: ${relation[i].password}, DateOfBirth: ${relation[i].dateOfBirth}, CountryCode: ${relation[i].countryCode}, Type: ${relation[i].type}`);
        }
        console.log("---End of users---");
    }
}

// userのタプル
let user1 = new User(1, "tommy434", "tommy434@example.com", "c387c2fb3e99cb5", "05/25/1982", 1, "admin");
let user2 = new User(2, "doorpink9", "doors2doors@example.com", "386449c7dba62e", "02/16/1979", 1, "default");
let user3 = new User(3, "parkriderz", "parkriderz@example.com", "79879ce55ebf7e0", "10/18/1990", 1, "subscriber");
let user4 = new User(4, "derkknight", "derkknight93@example.com", "9f340036bcb891", "08/20/1993", 44, "editor");
let user5 = new User(5, "soulstart234", "standby4r@example.com", "15c6647e8d2649", "09/04/2000", 44, "default");
let user6 = new User(6, "estrologyturnout", "cosmoticsrty@example.com", "55235311007445", "01/02/1999", 44, "subscriber");

// user関係
let userRelation = [user1, user2, user3, user4, user5, user6];

// select演算子
let selectUser = (predicateF: (user: User) => boolean, relation: User[]): User[] => relation.filter(predicateF);

// predicateF
let f: <T>(predicate: (tuple: T) => boolean) => (tuple: T) => boolean = predicate => tuple => predicate(tuple);

// σusername = "parkriderz"(USERS)
// - users 関係から、username 属性が "parkriderz" に等しい全てのタプルを選択します。
console.log("----例1----");
let ex1 = selectUser(f(x => x.userName == "parkriderz"), userRelation);
console.log(ex1);