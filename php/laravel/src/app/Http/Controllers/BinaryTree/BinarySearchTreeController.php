<?php

namespace App\Http\Controllers\BinaryTree;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

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
                $iterator = $iterator->getLeftTree();
            } else {
                $iterator = $iterator->getRightTree();
            }
        }
        return null;
    }

    public function insert(int $data): ?BinaryTreeController
    {
        if (is_null($data)) {
            Log::channel('binaryTreeError')->info('The data is null.');
            return $this->root;
        }
        if ($this->root === null) {
            $this->root = new BinaryTreeController($data);
            Log::channel('binaryTreeSuccess')->info('The root node is null. The data has been inserted as the root node.');
            return $this->root;
        }

        $iterator = $this->root;
        while ($iterator !== null) {
            if ($iterator->getData() === $data) {
                // データが既に存在する場合はログに記録しルートのノードを返す
                Log::channel('binaryTreeError')->info('The data already exists in the tree.');
                return $this->root;
            }
            if ($iterator->getData() > $data && $iterator->getLeftTree() === null) {
                $iterator->setLeftTree($data);
            } elseif ($iterator->getData() < $data && $iterator->getRightTree() === null) {
                $iterator->setRightTree($data);
            }

            $iterator = ($data < $iterator->getData()) ? $iterator->getLeftTree() : $iterator->getRightTree();
        }
        return $this->root;
    }
}
