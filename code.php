<?php
// 1. Coding


// Given an array of integers, return indices of the two numbers such that they add up to a specific target.

// You may assume that each input would have exactly one solution, and you may not use the same element twice.

// Example:

// Given nums = [2, 7, 11, 15], target = 9,

// Because nums[0] + nums[1] = 2 + 7 = 9,
// return [0, 1].



class Solution {
  /**
   * @param Integer[] $nums
   * @param Integer $target
   * @return Integer[]
   */
  function twoSum($nums, $target) {
    $count = 0;  
    $testSum = array();
    $response = array();
    while (count($nums) < $count) {
      foreach($nums as $key=>$responseNums) {
        if($key != $count)
        $testSum[$count.$key] = $nums[$count] + $responseNums;
      }
      $count++;
    }
    foreach($testSum as $secondKey=>$resultSum) {
      if($resultSum == $target) {
        $response[$secondKey];
      }
    }
  }

}