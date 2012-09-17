WP-Base-Theme
=============

WP Base Theme used to simplify the development process.

This Base Theme, so called Skeleton, contains most commonly used 
WordPress page templates and functionality, i.e.

Page Templates 
==============

404.php
archive.php
comments.php
content-archive.php
content-page.php
content-single.php
content.php
footer.php
front-page.php (for landing page)
functions.php
header.php
home.php (for blog entries)
index.php (not used most of the time)
page.php
screenshot.png
search.php
searchform.php
sidebar.php
single.php
style.css
todos.txt

File functions.php is split into logical inclusions that reside inside the /includes file
Each of these files contains most common / used functionalities that enable certain kind of WP feature
For example scripts.php have functions responsible for scripts enqueueing.

The idea is to further extend the theme with some config values via configuration array.
"skeleton" directory contains Skeleton_Theme_Config Class that is responsible for seting up the theme
all config options can be provided via config.php file which returns the config array

Todos
=====

@todo1 add default widget class with default fields, that would be then extended, to simplify widget development, 
for example text_widget with input[type="text"]

@todo2 extend settings api with default entries (similar to above)

@todo3 create default meta boxes to use from within the admin dashboard

@todo4 extend base class with other functionality (page generator / auto script enqueues) 
