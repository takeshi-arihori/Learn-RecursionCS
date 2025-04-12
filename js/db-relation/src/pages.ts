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

// page関係
let page1 = new Page(1, "Hello World", "Explain how hello world works", "<div>Hello World!!! Today we will learn about logging</div>", "/learn/hello-world", 1);
let page2 = new Page(2, "I/O Streams", "Cover input and output streams.", "<p>Input and output streams are important to understand. They allow us to input from and output to OS.</p>", "/learn/io-streams", 1);
let page3 = new Page(3, "Careers", "Information regarding job openings", "<h2>We currently have several job openings!</h2>", "/uk/careers/openings", 4);
let page4 = new Page(4, "Contact", "Contact information", "<form>Use this form to contact us!</form>", "/contact", 4);
let page5 = new Page(5, "Your dream job", "Learn how to land your dream job.", "<p>Finding your dream job comes down to the intersection of your likes, your talents, and other's needs</p>", "/blog/dream-job", 4);
let page6 = new Page(6, "Cooking with Joe - Cake", "Learn how to prepare cake with our guest Joe.", "<p>Hi, my name is Joe and we will learn how to bake cakes. Lets go over the ingredients you will need.</p>", "/learn/cooking/cake-with-joe", 1);

// page関係
let pageRelation = [page1, page2, page3, page4, page5, page6];

// select演算子
const selectPage = <T>(predicateF: (tuple: T) => boolean, relation: T[]): T[] => relation.filter(predicateF);

// predicateF
const fPage = <T>(predicate: (tuple: T) => boolean) => (tuple: T): boolean => predicate(tuple);

console.log("----例5 page 関係から、authorId が 1 に等しい全てのタプルを選択 ----");
let ex5 = selectPage(fPage(x => x.authorId == 1), pageRelation);
console.log(ex5);