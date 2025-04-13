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

    // パスワードを文字列として受け取り、その文字列をマップし、ハッシュ化されたパスワードhashedPassword返します。
    static hashPassword(password: string): number {
        let hash = 0;
        for (let i = 0; i < password.length; i++) {
            let character = password.charCodeAt(i);
            hash = ((hash << 5) - hash) + character;
            hash = hash & hash;
        }
        return Math.abs(hash);
    }

    static printUsersRelation(relation: User[]) {
        console.log("---Printing users---");
        for (let i = 0; i < relation.length; i++) {
            console.log(`UserId: ${relation[i].userId}, UserName: ${relation[i].userName}, Email: ${relation[i].email}, Password: ${relation[i].password}, DateOfBirth: ${relation[i].dateOfBirth}, CountryCode: ${relation[i].countryCode}, Type: ${relation[i].type}`);
        }
        console.log("---End of users---");
    }

    static printlogUsersRelation(relation: User[]): void {
        console.log("----console.loging users----");
        for (let i = 0; i < relation.length; i++) {
            console.log(`[userId: ${relation[i].userId}, userName: ${relation[i].userName} , email: ${relation[i].email}, password: ${relation[i].password}, date of birth: ${relation[i].dateOfBirth}, country code: ${relation[i].countryCode}, type: ${relation[i].type}]`);
        }
        console.log("--------");
    }
}

class Page {
    pageId: number;
    title: string;
    description: string;
    content: string;
    url: string;
    authorId: number;
    constructor(
        pageId: number,
        title: string,
        description: string,
        content: string,
        url: string,
        authorId: number
    ) {
        this.pageId = pageId;
        this.title = title;
        this.description = description;
        this.content = content;
        this.url = url;
        this.authorId = authorId;
    }
}

// userのタプル
let user1: User = new User(1, "tommy434", "tommy434@example.com", "c387c2fb3e99cb5", "05/25/1982", 1, "admin");
let user2: User = new User(2, "doorpink9", "doors2doors@example.com", "386449c7dba62e", "02/16/1979", 1, "default");
let user3: User = new User(3, "parkriderz", "parkriderz@example.com", "79879ce55ebf7e0", "10/18/1990", 1, "subscriber");
let user4: User = new User(4, "derkknight", "derkknight93@example.com", "9f340036bcb891", "08/20/1993", 44, "editor");
let user5: User = new User(5, "soulstart234", "standby4r@example.com", "15c6647e8d2649", "09/04/2000", 44, "default");
let user6: User = new User(6, "estrologyturnout", "cosmoticsrty@example.com", "55235311007445", "01/02/1999", 44, "subscriber");

// user関係
let userRelation: User[] = [user1, user2, user3, user4, user5, user6];

// page関係
let page1: Page = new Page(1, "Hello World", "Explain how hello world works", "<div>Hello World!!! Today we will learn about logging</div>", "/learn/hello-world", 1);
let page2: Page = new Page(2, "I/O Streams", "Cover input and output streams.", "<p>Input and output streams are important to understand. They allow us to input from and output to OS.</p>", "/learn/io-streams", 1);
let page3: Page = new Page(3, "Careers", "Information regarding job openings", "<h2>We currently have several job openings!</h2>", "/uk/careers/openings", 4);
let page4: Page = new Page(4, "Contact", "Contact information", "<form>Use this form to contact us!</form>", "/contact", 4);
let page5: Page = new Page(5, "Your dream job", "Learn how to land your dream job.", "<p>Finding your dream job comes down to the intersection of your likes, your talents, and other's needs</p>", "/blog/dream-job", 4);
let page6: Page = new Page(6, "Cooking with Joe - Cake", "Learn how to prepare cake with our guest Joe.", "<p>Hi, my name is Joe and we will learn how to bake cakes. Lets go over the ingredients you will need.</p>", "/learn/cooking/cake-with-joe", 1);

// page関係
let pageRelation: Page[] = [page1, page2, page3, page4, page5, page6];

// select演算子
let select = (predicateF: (item: User | Page) => boolean, relation: (User | Page)[]): (User | Page)[] => relation.filter(predicateF);

// project演算子
let project = (predicateF: (item: User | Page) => User | Page, relation: (User | Page)[]): (User | Page)[] => relation.map(predicateF);

// predicateF
let f: <T>(predicate: (item: T) => boolean) => (tuple: T) => boolean = predicate => tuple => predicate(tuple);

console.log("----例1 users 関係から、username 属性が parkriderz に等しい全てのタプルを選択 ----");
let ex1 = select(f(x => x instanceof User && x.userName == "parkriderz"), userRelation);
console.log(ex1);
console.log("----例2 users 関係から、countryCode 属性が 44 に等しい全てのタプルを選択 ----");
let ex2 = select(f(x => x instanceof User && x.countryCode == 44), userRelation);
console.log(ex2);
console.log("----例3 users 関係から、type 属性が admin または type 属性が editor に等しい全てのタプルを選択 ----");
let ex3 = select(f(x => x instanceof User && (x.type == "admin" || x.type == "editor")), userRelation);
console.log(ex3);
console.log("----例4 users 関係から、type が subscriber に等しく、かつ、dateOfBirth 年が 1995 年以下の全てのタプルを選択 ----");
let ex4 = select(f(x => x instanceof User && x.type == "subscriber" && parseInt(x.dateOfBirth.split("/")[2]) <= 1995), userRelation);
console.log(ex4);
console.log("----例5 page 関係から、authorId が 1 に等しい全てのタプルを選択 ----");
let ex5 = select(f(x => x instanceof Page && x.authorId == 1), pageRelation);
console.log(ex5);
