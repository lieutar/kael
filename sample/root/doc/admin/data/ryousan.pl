#!/usr/bin/perl

$BASE = 38231002;

for($i=0;$i < 50;$i++)
  {
    open OUT,">".($BASE+$i).".csv";
    print OUT ("dummy ${i},dummy ${i},dummy ${i},,".($i * 60 + 1034134022));
    close OUT;
  }
