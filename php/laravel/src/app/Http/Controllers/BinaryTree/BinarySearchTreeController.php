<?php

namespace App\Http\Controllers\BinaryTree;

use App\Http\Controllers\Controller;

class BinarySearchTreeController extends Controller
{
    public BinaryTreeController $root;

    public function __construct(array $arr)
    {
        sort($arr);
        $this->root = $this->sortedArrayToBSTHelper($arr, 0, count($arr) - 1);
    }

    /**
     * Undocumented function
     *
     * @param array $arr
     * @param integer $start
     * @param integer $end
     * @return BinaryTreeController
     */
    private function sortedArrayToBSTHelper(array $arr, int $start, int $end): BinaryTreeController
    {
        if ($start === $end) return new BinaryTreeController($arr[$start]);

        $mid = floor(($start + $end) / 2);

        $left = ($mid - 1 >= $start) ? $this->sortedArrayToBSTHelper($arr, $start, $mid - 1) : null;
        $right = ($mid + 1 <= $end) ? $this->sortedArrayToBSTHelper($arr, $mid + 1, $end) : null;
        return new BinaryTreeController($arr[$mid], $left, $right);
    }

    public function search(int $key): ?BinaryTreeController
    {
        $iterator = $this->root;
        while ($iterator !== null) {
            if ($iterator->getData() === $key) {
                return $iterator;
            } elseif ($key < $iterator->getData()) {
                $iterator = $iterator->getLeftData();
            } else {
                $iterator = $iterator->getRightData();
            }
        }
        return null;
    }
}
