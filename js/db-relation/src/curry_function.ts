// 通常の関数
const add = (a: number, b: number): number => a + b;

// カリー化された関数
const curryAdd = (a: number) => (b: number): number => a + b;

const add3 = curryAdd(3);
console.log(add3(5)); // 8

const trim = (s: string) => s.trim();
const toLower = (s: string) => s.toLowerCase();

const compose = <T>(f: (x: T) => T, g: (x: T) => T) => (x: T) => f(g(x));

const sanitize = compose(toLower, trim);
console.log(sanitize("  HeLLo  ")); // "hello"

// ユーザー型の定義
type User = {
    userId: number;
    userName: string;
    email: string;
    password: string;
    dateOfBirth: Date;
    countryCode: number;
    type: string;
};

// Controllerから渡ってくるデータ（Userの配列）
const users: User[] = [
    {
        userId: 1,
        userName: "tommy434",
        email: "tommy434@example.com",
        password: "c387c2fb3e99cb5",
        dateOfBirth: new Date("1982-05-25"),
        countryCode: 1,
        type: "admin",
    },
    {
        userId: 2,
        userName: "doorpink9",
        email: "doors2doors@example.com",
        password: "386449c7dba62e",
        dateOfBirth: new Date("1979-02-16"),
        countryCode: 1,
        type: "default",
    },
    {
        userId: 3,
        userName: "parkriderz",
        email: "parkriderz@example.com",
        password: "79879ce55ebf7e0",
        dateOfBirth: new Date("1990-10-18"),
        countryCode: 1,
        type: "subscriber",
    },
    {
        userId: 4,
        userName: "derkknight",
        email: "derkknight93@example.com",
        password: "9f340036bcb891",
        dateOfBirth: new Date("1993-08-20"),
        countryCode: 44,
        type: "editor",
    },
];

// ユーザータイプでフィルタリングする関数
const hasType = (type: string) => (user: User): boolean => user.type === type;

// 国コードでフィルタリングする関数
const fromCountry = (code: number) => (user: User): boolean => user.countryCode === code;

// 指定した年以前に生まれた人でフィルタリングする関数
const bornBefore = (year: number) => (user: User): boolean => user.dateOfBirth.getFullYear() <= year;

// 複数の述語関数を受け取り、それらをAND条件で合成する関数
const pipePredicate = (predicates: Array<(user: User) => boolean>) =>
    (user: User): boolean => predicates.every((fn) => fn(user));

// 複数条件でフィルタリング
const filtered = users.filter(
    pipePredicate([
        hasType("subscriber"),    // タイプが "subscriber" のユーザー
        fromCountry(1),           // 国コードが 1 のユーザー
        bornBefore(1995),         // 1995年以前に生まれたユーザー
    ])
);

console.log(filtered);

type Product = {
    id: number;
    name: string;
    price: number;
    category: string;
    tags: string[];
    inStock: boolean;
    rating: number;
    releaseDate: Date;
};

const products: Product[] = [
    {
        id: 1,
        name: "高性能ノートPC",
        price: 120000,
        category: "electronics",
        tags: ["laptop", "business", "windows"],
        inStock: true,
        rating: 4.5,
        releaseDate: new Date("2023-05-15")
    },
    {
        id: 2,
        name: "ゲーミングモニター",
        price: 45000,
        category: "electronics",
        tags: ["gaming", "monitor", "4k"],
        inStock: true,
        rating: 4.7,
        releaseDate: new Date("2022-12-01")
    },
    {
        id: 3,
        name: "コーヒーメーカー",
        price: 15000,
        category: "home",
        tags: ["kitchen", "coffee", "automatic"],
        inStock: true,
        rating: 3.8,
        releaseDate: new Date("2024-01-10")
    },
    {
        id: 4,
        name: "デザイナーチェア",
        price: 32000,
        category: "furniture",
        tags: ["chair", "ergonomic", "office"],
        inStock: true,
        rating: 4.2,
        releaseDate: new Date("2023-08-22")
    }
];
// 価格範囲でフィルタリング
const priceRange = (min: number, max: number) =>
    (product: Product): boolean => product.price >= min && product.price <= max;

// カテゴリでフィルタリング
const inCategory = (category: string) =>
    (product: Product): boolean => product.category === category;

// タグを含むかでフィルタリング
const hasTag = (tag: string) =>
    (product: Product): boolean => product.tags.includes(tag);

// 在庫があるかでフィルタリング
const isInStock = () =>
    (product: Product): boolean => product.inStock;

// 評価が一定以上でフィルタリング
const minRating = (rating: number) =>
    (product: Product): boolean => product.rating >= rating;

// 特定の日付以降に発売されたものでフィルタリング
const releasedAfter = (date: Date) =>
    (product: Product): boolean => product.releaseDate >= date;

// 汎用的なAND条件（すべての条件を満たす）
const pipePredicateGeneric = <T>(predicates: Array<(item: T) => boolean>) =>
    (item: T): boolean => predicates.every((fn) => fn(item));

// 汎用的なOR条件（いずれかの条件を満たす）
const orPredicate = <T>(predicates: Array<(item: T) => boolean>) =>
    (item: T): boolean => predicates.some((fn) => fn(item));

// AND条件とOR条件を組み合わせる
const searchResults = products.filter(
    pipePredicateGeneric<Product>([
        inCategory("electronics"),
        priceRange(0, 120000),
        isInStock(),
        orPredicate<Product>([
            hasTag("gaming"),
            hasTag("business")
        ])
    ])
);

console.log(searchResults);


// ユーザー入力から検索条件を構築する関数
function buildFilters(options: {
    category?: string;
    minPrice?: number;
    maxPrice?: number;
    inStockOnly?: boolean;
    tags?: string[];
    minRating?: number;
}): (product: Product) => boolean {
    const filters: Array<(product: Product) => boolean> = [];

    if (options.category) {
        filters.push(inCategory(options.category));
    }

    if (options.minPrice !== undefined || options.maxPrice !== undefined) {
        const min = options.minPrice ?? 0;
        const max = options.maxPrice ?? Infinity;
        filters.push(priceRange(min, max));
    }

    if (options.inStockOnly) {
        filters.push(isInStock());
    }

    if (options.tags && options.tags.length > 0) {
        const tagFilters = options.tags.map(tag => hasTag(tag));
        filters.push(orPredicate<Product>(tagFilters));
    }

    if (options.minRating !== undefined) {
        filters.push(minRating(options.minRating));
    }

    return filters.length > 0 ? pipePredicateGeneric<Product>(filters) : () => true;
}

// 使用例
const userFilters = buildFilters({
    category: "electronics",
    minPrice: 45000,
    inStockOnly: true,
    tags: ["monitor"]
});

const userSearchResults = products.filter(userFilters);
console.log("userSearchResults");
console.log(userSearchResults);