.. _intro:

Introduction
============

phpMyAdmin can manage a whole MySQL server (needs a super-user) as
well as a single database. To accomplish the latter you'll need a
properly set up MySQL user who can read/write only the desired
database. It's up to you to look up the appropriate part in the MySQL
manual.


Currently phpMyAdmin can:
+++++++++++++++++++++++++

* browse and drop databases, tables, views, columns and indexes
* display multiple results sets through stored procedures or queries
* create, copy, drop, rename and alter databases, tables, columns and
  indexes
* maintenance server, databases and tables, with proposals on server
  configuration
* execute, edit and bookmark any :abbr:`SQL (structured query
  language)`-statement, even batch-queries
* load text files into tables
* create [#f1]_ and read dumps of tables
* export [#f1]_ data to various formats: :abbr:`CSV (Comma Separated Values)`,
  :abbr:`XML (Extensible Markup Language)`, :abbr:`PDF (Portable
  Document Format)`, :abbr:`ISO (International Standards
  Organisation)`/:abbr:`IEC (International Electrotechnical Commission)`
  26300 - OpenDocument Text and Spreadsheet, :abbr:`Word (Microsoft Word
  2000)`, and LATEX formats
* import data and MySQL structures from OpenDocument spreadsheets, as
  well as :abbr:`XML (Extensible Markup Language)`, :abbr:`CSV (Comma
  Separated Values)`, and :abbr:`SQL (Server Query Language)` files
* administer multiple servers
* manage MySQL users and privileges
* check referential integrity in MyISAM tables
* using Query-by-example (QBE), create complex queries automatically
  connecting required tables
* create :abbr:`PDF (Portable Document Format)` graphics of your
  Database layout
* search globally in a database or a subset of it
* transform stored data into any format using a set of predefined
  functions, like displaying BLOB-data as image or download-link
* track changes on databases, tables and views
* support InnoDB tables and foreign keys see :ref:`faq3_6`
* support mysqli, the improved MySQL extension see :ref:`faq1_17`
* create, edit, call, export and drop stored procedures and functions
* create, edit, export and drop events and triggers
* communicate in `62 different languages
  <http://www.phpmyadmin.net/home_page/translations.php>`_
* synchronize two databases residing on the same as well as remote
  servers see :ref:`faq9_1`


A word about users:
-------------------

Many people have difficulty understanding the concept of user
management with regards to phpMyAdmin. When a user logs in to
phpMyAdmin, that username and password are passed directly to MySQL.
phpMyAdmin does no account management on its own (other than allowing
one to manipulate the MySQL user account information); all users must
be valid MySQL users.

:sup:`1)` phpMyAdmin can compress (Zip, GZip -RFC 1952- or Bzip2
formats) dumps and :abbr:`CSV (comma separated values)` exports if you
use PHP with Zlib support (``--with-zlib``) and/or Bzip2 support
(``--with-bz2``). Proper support may also need changes in ``php.ini``.

.. rubric:: Footnotes

.. [#f1]

    phpMyAdmin can compress (Zip, GZip -RFC 1952- or Bzip2 formats)
    dumps and :abbr:`CSV (comma separated values)` exports if you use
    PHP with Zlib support (``--with-zlib``) and/or Bzip2 support
    (``--with-bz2``). Proper support may also need changes in
    :file:`php.ini`.
