@php
    $rating = $product['rating'];
    $floor = floor($rating);
    $dropRate = 5;
    for ($i = 1; $i <= $floor; $i++) {
        echo '<small class="fa fa-star text-primary mr-1"></small>';
        $dropRate--;
    }
    if ($rating > $floor) {
        echo '<small class="fa fa-star-half-alt text-primary mr-1"></small>';
        $dropRate--;
    }
    if ($dropRate != 0) {
        for ($j = 0; $j != $dropRate; ) {
            echo '<small class="far fa-star text-primary mr-1"></small>';
            $dropRate--;
        }
    }
    
@endphp
