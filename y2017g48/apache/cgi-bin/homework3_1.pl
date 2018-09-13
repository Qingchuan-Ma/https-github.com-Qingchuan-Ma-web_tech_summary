#!/usr/bin/perl -w
# test
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

$name = $FORM{name};
$age  = $FORM{age};
$gender  = $FORM{gender};
$email  = $FORM{email};

open my $fh_out, '>>', 'result.dat' or die $!;
print $fh_out "Name:$name Age:$age Gender:$gender E-mail:$email\n";
close $fh_out;

print "Content-type:text/html\r\n\r\n";
print "<!DOCTYPE html>";
print "<html>";
print "<head>";
print '<meta charset="utf-8">';
print '<title>Result</title>';
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
print h1("This is the Results!");
print "<div style=\"text-align:center;border:1px solid #9bdf70;background:#f0fbeb;width=100px\">";
print "<b>Name:</b> $name <br><b>Age:</b> $age <br><b>Gender:</b> $gender <br><b>E-mail:</b> $email<br>";
print "</div>";
print h1("Save successful!! and return to look-up or delete");
print "<button type=\"button\" onclick=\"self.location=document.referrer\" class=\"ui-button\">Return</button>";
print "</body>";
print "</html>";
