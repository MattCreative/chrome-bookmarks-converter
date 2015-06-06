# Chrome Bookmarks Converter
A script for converting Chrome bookmark.bak files to Chrome Bookmark.html files so you can import your bookmarks from your AppData file.

I ran into a situation where I forgot to export my bookmarks from Chrome before doing a re-install of Windows. I grabbed my backup, and found that you could not directly import the bookmarks.bak file that Chrome uses to store your boookmarks.

After looking at the strucutre I built a parser to convert the file to the .html format Chrome was happy to import.

# How to Run
1. Add convertor.php to a server.
2. Upload your .bak file as bookmarks.txt (or rename in the script to match).
3. Run the script.
4. Your bookmarks will be converted, and saved as export.html

# Notes
I threw this together pretty quick, so it may not be most efficient or support ALL use-cases for .bak file. It is recursive so it will keep folder structures intact.
