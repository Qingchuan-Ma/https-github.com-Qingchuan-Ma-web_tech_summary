#!/usr/bin/perl -w

use CGI qw(:standard);

local ($buffer, @pairs, $pair, $name, $value, %FORM);
# 读取文本信息
$ENV{'REQUEST_METHOD'} =~ tr/a-z/A-Z/;
if ($ENV{'REQUEST_METHOD'} eq "POST")
{
   read(STDIN, $buffer, $ENV{'CONTENT_LENGTH'});
}else {
   $buffer = $ENV{'QUERY_STRING'};
}
# 读取 name/value 对信息

@pairs = split(/&/, $buffer);
foreach $pair (@pairs)
{
   ($name, $value) = split(/=/, $pair);
   $value =~ tr/+/ /;
   $value =~ s/%(..)/pack("C", hex($1))/eg;
   $FORM{$name} = $value;
}

$length=$FORM{number};

for($j=1;$j<=$length;$j++)
{
  $usr[$j]="usr"."$j";
  if( $FORM{$usr[$j]} )
  {
    $list[$j] ="ON";
  }
  else
  {
    $list[$j] ="OFF";
  }
}

open my $fh_in, '<' , 'result.dat' or die $!;

$i=0;
while (<$fh_in>)
{
  $i=$i+1;
  $string[$i]=$_;
}

close $fh_in;


print "Content-type:text/html\r\n\r\n";
print "<!DOCTYPE html>";
print "<html>";
print "<head>";
print '<meta charset="utf-8">';
print '<title>Delete Successful</title>';
print "<link href=\"../css/jquery-ui.css\" rel=\"stylesheet\">";
print "<style>";
print "
		h1 {
			font-size:40px;
			color: transparent;
			-webkit-text-stroke: 1px black;
			letter-spacing: 0.04em;
			background-color:
		}";
print "</style>";
print "</head>";
print "<body style=\"text-align:center\">";

open my $fh_out, '+>', 'result.dat' or die $!;
$len=@string;

print "<h1>You delete Following information:</h1>";

print "<div style=\"text-align:center;border:1px solid #9bdf70;background:#f0fbeb;width=100px\">";
for($i=1;$i<$len;$i++){
  if($list[$i] eq "OFF")
  {
      print $fh_out $string[$i];
      print "\n"
  }
  if($list[$i] eq "ON")
  {
    print "<h3>$string[$i]</h3>";
  }
}
close $fh_out;
print "</div>";
print "<h1>Delete Seccessful</h1>";

print "<form action=\"./homework3_2.pl\">";
print "<button type=\"submit\" class=\"ui-button\" >Return </button>";
print "</form>";

print "</body>";
print "</html>";
