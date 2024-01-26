package test_code.java;

import java.util.ArrayList;

class Student {
    public int studentId;
    public int grade;
    public String name;
    public int age;
    public double height;

    public Student(int studentId, int grade, String name, int age, double height) {
        this.studentId = studentId;
        this.grade = grade;
        this.name = name;
        this.age = age;
        this.height = height;
    }

    public String toString() {
        return "ID: " + this.studentId + "..." + this.name + ", grade: " + this.grade + ", age: " + this.age
                + ", height " + this.height;
    }
}

class Main {

    public static void printStudents(ArrayList<Student> students) {
        System.out.println("----Total students: " + students.size() + "----");
        for (Student student : students)
            System.out.println(student);
        System.out.println("---END---");
    }

    // s1がs2より若く、背が高いかどうかを返します。もし、同じならs1とs2のIDを比較します。
    public static boolean studentCompare(Student s1, Student s2) {
        if (s1.age == s2.age) {
            return s1.height == s2.height ? s1.studentId < s2.studentId : s1.height > s2.height;
        }
        return s1.age < s2.age;
    }

    // studentListをheapifyし、最初のk個の要素をpopします。
    public static void heapify(ArrayList<Student> l) {
        for (int index = l.size() / 2; index >= 0; index--) {
            minHeap(l, index);
        }
    }

    public static void swap(ArrayList<Student> arr, int i, int j) {
        Student temp = arr.get(i);
        arr.set(i, arr.get(j));
        arr.set(j, temp);
    }

    public static void minHeap(ArrayList<Student> l, int index) {
        int lengthL = l.size();
        int curr = index;
        boolean flag = true;
        while (flag) {
            int left = curr * 2 + 1;
            int right = curr * 2 + 2;
            int smallest = curr;

            if (lengthL > left && !studentCompare(l.get(smallest), l.get(left)))
                smallest = left;
            if (lengthL > right && !studentCompare(l.get(smallest), l.get(right)))
                smallest = right;

            if (smallest == curr)
                flag = false;
            else
                swap(l, curr, smallest);

            curr = smallest;
        }
    }

    // 最年少かつ最も高い生徒をk人返します。
    public static ArrayList<Student> chooseStudent(ArrayList<Student> studentList, int k) {

        // Heapify studentList
        heapify(studentList);

        ArrayList<Student> results = new ArrayList<>();
        for (int i = 0; i < k; i++) {
            // minを最後のノードとswapし、削除します。O(1)
            swap(studentList, 0, studentList.size() - 1);
            results.add(studentList.remove(studentList.size() - 1));

            if (studentList.size() > 0)
                minHeap(studentList, 0);
            else
                break;
        }
        return results;
    }

    public static void main(String[] args) {

        ArrayList<Student> studentList1 = new ArrayList<>() {
            {
                add(new Student(1000, 9, "Matt Verdict", 14, 5.5));
                add(new Student(1001, 9, "Amy Lam", 14, 5.5));
                add(new Student(1002, 10, "Bryant Gonzales", 15, 5.9));
                add(new Student(1003, 9, "Kimberly York", 15, 5.3));
                add(new Student(1004, 11, "Christine Bryant", 15, 5.8));
                add(new Student(1005, 10, "Mike Allen", 16, 6.2));
            }
        };
        // 最年少かつ最も高い生徒をid順に並べると、[1000, 1001, 1002, 1004, 1003, 1005]

        ArrayList<Student> studentList2 = new ArrayList<>() {
            {
                add(new Student(1000, 9, "Matt Verdict", 14, 5.5));
                add(new Student(1001, 9, "Amy Lam", 13, 5.5));// 変更され、13歳
                add(new Student(1002, 10, "Bryant Gonzales", 15, 5.9));
                add(new Student(1003, 9, "Kimberly York", 15, 5.3));
                add(new Student(1004, 11, "Christine Bryant", 15, 5.8));
                add(new Student(1005, 10, "Mike Allen", 16, 6.2));

            }
        };
        // 最年少かつ最も高い生徒をid順に並べると、[1001, 1000, 1002, 1004, 1003, 1005]

        // リスト1に対してテストを実行します
        printStudents(studentList1);
        // ブラックボックステスト
        System.out.println(chooseStudent(studentList1, 1).get(0).studentId == 1000);
        // 副作用。popにより、リストから一人が減り、idでソートされていた配列もheapifyされてバラバラになりました。
        // 関数内のin-placeアルゴリズムによって、入力の配列に影響を与えました。
        printStudents(studentList1);

        // リスト2
        printStudents(studentList2);
        // ブラックボックステスト
        System.out.println(chooseStudent(studentList2, 1).get(0).studentId == 1001);
        // 副作用。popにより、リストから一人が減り、idでソートされていた配列もheapifyされてバラバラになりました。
        // 関数内のin-placeアルゴリズムによって、入力の配列に影響を与えました。
        printStudents(studentList2);

        ArrayList<Student> studentList3 = new ArrayList<>() {
            {
                add(new Student(1000, 9, "Matt Verdict", 11, 5.5));// 変更、11歳
                add(new Student(1001, 9, "Amy Lam", 13, 5.5));
                add(new Student(1002, 10, "Bryant Gonzales", 13, 5.5));// 変更、13歳
                add(new Student(1003, 9, "Kimberly York", 15, 5.3));
                add(new Student(1004, 11, "Christine Bryant", 15, 5.3)); // 変更、5.3高さ
                add(new Student(1005, 10, "Mike Allen", 16, 6.2));

            }
        };
        // 最年少かつ最も高い生徒をid順に並べると、[1000, 1001, 1002, 1003, 1004, 1005]

        printStudents(studentList3);
        // リスト3から4人を出力します。
        printStudents(chooseStudent(studentList3, 4));
        // 副作用。Christine BryantとMike Allenしか残っていません。
        // 関数内のin-placeアルゴリズムによって、入力の配列に影響を与えました。
        printStudents(studentList3);
    }
}