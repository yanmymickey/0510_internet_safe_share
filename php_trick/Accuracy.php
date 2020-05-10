<?php
var_dump(intval((0.1+0.7)*10));  //int(7)
var_dump(floor((0.1+0.7)*10));  //float(7)
var_dump(intval((0.1+0.7)*10)==floor((0.1+0.7)*10));
var_dump(intval((0.1+0.7)*10)===floor((0.1+0.7)*10));

var_dump(intval(0.58*100));  //int(57)
var_dump(floor(0.58*100));  //float(57)
var_dump(intval(0.58*100)==floor(0.58*100));
var_dump(intval(0.58*100)===floor(0.58*100));

var_dump(1.000000000000000 == 1);//bool(true)
var_dump(1.0000000000000001 == 1);//bool(true)
var_dump(1.000000000000000==1.0000000000000001);
