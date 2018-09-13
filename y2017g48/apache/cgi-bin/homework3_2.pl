#!/usr/bin/perl -w

use CGI qw(:standard);

open my $fh_in, '<', 'result.dat' or die $!;




print "Content-type:text/html\r\n\r\n";
print "<!DOCTYPE html>";
print "<html>";
print "<head>";
print '<meta charset="utf-8">';
print '<title>Result</title>';
print "<link href=\"../css/jquery-ui.css\" rel=\"stylesheet\">";
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

$i=0;
while (<$fh_in>) {
  $i=$i+1;
  $string[$i]=$_;
}

print h1("This is the List!");
print "<form action=\"./homework3_3.pl\">";
print "<input type=\"hidden\" name=\"number\" value=\"$i\" />";

print "<div style=\"text-align:center;border:1px solid #9bdf70;background:#f0fbeb;width=100px\">";
for($j=1;$j<=$i;$j++){
  print "<input type=\"checkbox\" name=\"usr$j\" value=\"$string[$j]\" class= \"checkboxclass\"> $string[$j] <br>";
}
print "</div>";

close $fh_in;
print "<button type=\"submit\" class=\"ui-button\" >Delete</button>";
print "</form>";
print "<button type=\"button\" onclick=\"window.location.href='../homework3_2.html' \" class=\"ui-button\">Return</button>";


print "</body>";
print "</html>";
