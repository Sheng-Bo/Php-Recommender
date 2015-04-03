<?php

//  /Users/artalose/github/php-recommender

$data = array(
        'item1' => array(1, 2, 3, 4, 5),
        'item2' => array(2, 3, 4, 5, 5)
);

print_r($data);

echo pearson ($data[item1], $data[item2])."\n";

function pearson($item1ratings, $item2ratings) {
        $n = $sum1 = $sum2 = $sumSq1 = $sumSq2 = $product = 0;

        foreach($item1ratings as $user => $score) {
                if(!isset($item2ratings[$user])) {
                        continue;
                }

                $n++;
                $sum1 += $score;
                $sum2 += $item2ratings[$user];
                $sumSq1 += pow($score, 2);
                $sumSq2 += pow($item2ratings[$user], 2);
                $product += $score * $item2ratings[$user];
        }

        // No shared ratings, so the similarity is 0
        // May want to tweak this to have a different minimum
        if($n == 0) {
                return 0;
        }

        // Work out the actual score
        $num = $product - (($sum1* $sum2)/$n);
        $den = sqrt(($sumSq1-pow($sum1, 2) / $n) * ($sumSq2 - pow($sum2, 2)/$n));

        if($den == 0) {
                return 0;
        }

        return $num/$den;
}


?>
