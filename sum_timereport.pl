#!/usr/bin/env perl
use strict;
use DateTime;
binmode(STDOUT, ":utf8");

unless(@ARGV==1)
{
    print "Usage: $0 file.trep\n";
    exit(1);
}

my $filename = $ARGV[0];
open(my $fh, '<:encoding(UTF-8)', $filename) or die "Couldn't open file '$filename'";

# parse report
my $month = "";
my $week = "";
my $str = "";
my $sum = 0;
my %tagged;
my $days = "Mon|Tue|Wed|Thu|Fri|Sat|Sun";

sub add() {
  $str = shift;
  while($str =~ /\((-?\d+)\s(\w+)\)/g) {
    if(!defined($tagged{$2})) {
      $tagged{$2} = 0;
    }
    $tagged{$2} += int($1);
  }
}

while(my $row = <$fh>) {
  if($row =~ /^\s*#/ ) {
    next;
  }

  if($row =~ /^\d\d\d\d\s(\w+)$/) {
    $month = $1;
    next;
  }
  if($row =~/^-+$/) {
    next;
  }
  if($row =~/^\s*(\d+)\s+(\d+)\s($days)\s(.*)$/) {
    $week = $1;
    &add($4);
  }
  if($row =~/^\s+(\d+)\s($days)\s(.*)$/) {
    &add($3);
  }
  if($str =~ /^(\d+).*$/) {
    $sum += int($1);
  }

}
print "Sum: $sum\n";
for my $tag (keys %tagged) {
  print "$tag: $tagged{$tag}\n";
}
