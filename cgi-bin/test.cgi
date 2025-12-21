#!/usr/bin/perl
use CGI qw(:all);

# Set the content type header
print header();

# Start HTML output
print start_html("CGI Test Page");

# Output a simple message
print h1("Hello, CGI World!");
print p("This is a test CGI script running on your server.");

# End HTML output
print end_html();
