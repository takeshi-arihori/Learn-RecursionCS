/**
 * Merge Sorted Linked Lists
 * 
 * Example:
 * ソート済みの連結リストの先頭 head1 と head2
 * が与えられるので、それを合体させ、新しい連結リストを返す、mergeTwoSortedLinkedLists という関数を作成してください。
 * 
 */
class MergeSortedLinkedLists {
    public static void main(String[] args) {
        SinglyLinkedListNode<Integer> head1 = new SinglyLinkedListNode<>(1);
        head1.next = new SinglyLinkedListNode<>(3);
        head1.next.next = new SinglyLinkedListNode<>(5);
        head1.next.next.next = new SinglyLinkedListNode<>(7);
        head1.next.next.next.next = new SinglyLinkedListNode<>(9);

        SinglyLinkedListNode<Integer> head2 = new SinglyLinkedListNode<>(2);
        head2.next = new SinglyLinkedListNode<>(4);
        head2.next.next = new SinglyLinkedListNode<>(6);
        head2.next.next.next = new SinglyLinkedListNode<>(8);
        head2.next.next.next.next = new SinglyLinkedListNode<>(10);

        SinglyLinkedListNode<Integer> mergedHead = mergeTwoSortedLinkedLists(head1, head2);

        while (mergedHead != null) {
            System.out.print(mergedHead.data + " ");
            mergedHead = mergedHead.next;
        }
    }

    public static SinglyLinkedListNode<Integer> mergeTwoSortedLinkedLists(SinglyLinkedListNode<Integer> head1,
            SinglyLinkedListNode<Integer> head2) {
        if (head1 == null)
            return head2;
        if (head2 == null)
            return head1;

        SinglyLinkedListNode<Integer> mergeHead;
        if (head1.data < head2.data) {
            mergeHead = head1;
            mergeHead.next = mergeTwoSortedLinkedLists(head1.next, head2);
        } else {
            mergeHead = head2;
            mergeHead.next = mergeTwoSortedLinkedLists(head1, head2.next);
        }

        return mergeHead;
    }
}

class SinglyLinkedListNode<E> {
    public E data;
    public SinglyLinkedListNode<E> next;

    public SinglyLinkedListNode(E data) {
        this.data = data;
        this.next = null;
    }
}