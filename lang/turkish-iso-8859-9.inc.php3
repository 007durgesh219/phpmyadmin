<?php

/* $Id$ */

//�eviride eksik veya hatal� oldu�unu d���nd���n�z k�s�mlar� bora@ktu.edu.tr adresine g�nderebilirsiniz...
//bora alio�lu 02.08.2002...tempus fugit...

$charset = 'iso-8859-9';
$text_dir = 'ltr';
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
// shortcuts for Byte, Kilo, Mega, Tera, Peta, Exa
$byteUnits = array('Byte', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');
//veritabanlar� terminolojisinde terc�meye pek m�sait olmayan index ve unique s�zc�kleri aynen kullan�ld�: uniqe=e�siz,tek
$day_of_week = array('Pazar', 'Pazartesi', 'Sal�', '�ar�amba', 'Per�embe', 'Cuma', 'Cumartesi');
$month = array('Ocak', '�ubat', 'Mart', 'Nisan', 'May�s', 'Haziran', 'Temmuz', 'A�ustos', 'Eyl�l', 'Ekim', 'Kas�m', 'Aral�k');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%B %d, %Y at %I:%M %p';


$strAccessDenied = 'Eri�im engellendi';
$strAction = 'Eylem';
$strAddDeleteColumn = 'S�tun alan� Ekle/Sil';
$strAddDeleteRow = 'Kriter sat�r� Ekle/Sil';
$strAddNewField = 'Yeni alan ekle';
$strAddPrivMessage = 'Yeni ayr�cal�k eklediniz..';
$strAddPriv = 'Yeni ayr�cal�k ekle';
$strAddSearchConditions = 'Arama durumu ekle ("where" c�mleci�i i�in):';
$strAddToIndex = '%s s�tununu(s�tunlar&#305;na) index ekle';
$strAddUserMessage = 'Yeni bir kullan�c� eklediniz.';
$strAddUser = 'Yeni kullan�c� ekle';
$strAffectedRows = 'Etkilenen sat�rlar:';
$strAfterInsertBack = 'Return';
$strAfterInsertNewInsert = 'Yeni kayit ekle';
$strAfter = 'Sonuna %s';
$strAllTableSameWidth = 'B�t�n tablolar� ayn� geni�likte g�ster';
$strAll = 'T�m�';
$strAlterOrderBy = 'Tabloyu de�i�tir ve �una g�re s�rala:';
$strAnalyzeTable = 'Tabloyu analiz et';
$strAnd = 'Ve';
$strAnIndex = '%s �zerinde yeni bir index eklendi';
$strAnyColumn = 'Herhangi s�tun';
$strAnyDatabase = 'Herhangi veritaban�';
$strAny = 'Herhangi';
$strAnyHost = 'Herhangi sunucu';
$strAnyTable = 'Herhangi tablo';
$strAnyUser = 'Herhangi kullan�c�';
$strAPrimaryKey = '%s �zerinde birincil index eklendi';
$strAscending = 'Artan';
$strAtBeginningOfTable = 'Tablonun ba��nda';
$strAtEndOfTable = 'Tablonun sonunda';
$strAttr = '�zellikler';

$strBack = 'Geri';
$strBinary = 'Binari';
$strBinaryDoNotEdit = 'Binari - d�zenlemeyiniz';
$strBookmarkDeleted = 'Bookmark silindi.';
$strBookmarkLabel = 'Etiket';
$strBookmarkQuery = ' SQL-sorgusu';
$strBookmarkThis = 'Bu SQL-sorgusunu i�aretle';
$strBookmarkView = 'Sadece g�zat';
$strBrowse = 'Tara';
$strBzip = '"bzipped"';

$strCantLoadMySQL = 'mySQL uzant�s�n� y�kleyemiyor,<br />l�tfen PHP ayarlar�n� kontrol ediniz.';
$strCantLoadRecodeIconv = 'Karakter seti d�n���m� i�in gerekli olan Iconv veya recode uzant�lar�n� y�kleyenemiyor.  Php\'nin bu uzant�lara izin vermesini sa�lay�n veya phpMyAdmin i�inde karakter d�n���m�n� devre d��� b�rak�n�z...';
$strCantRenameIdxToPrimary = 'Index\'i PRIMARY olarak adland&#305;r&#305;mazs&#305;n&#305;z!';
$strCantUseRecodeIconv = 'Uzant� raporlar� y�klenmi�ken , ne iconv ne libinconv ne de recode_string fonksiyonu  kullan�lamaz.  Php ayarlar�n�z� kontrol ediniz.';
$strCardinality = 'En �nemli';
$strCarriage = 'Enter Karakteri: \\r';
$strChange = 'De�i�tir';
$strChangeDisplay = 'G�rmek istedi�iniz alan� se�iniz';
$strChangePassword = '�ifre De�i�tir';
$strCharsetOfFile = 'Dosyan�n karakter seti:';
$strCheckAll = 'T�m�n� se�';
$strCheckDbPriv = 'Veritaban� �nceliklerini kontrol et';
$strCheckTable = 'Tabloyu kontrol et';
$strChoosePage = 'L�tfen d�zenlemek istedi�iniz sayfay� se�in';
$strColComFeat = 'S�tun yorumlar� g�steriliyor';
$strColumnNames = 'S�tun adlar�';
$strColumn = 'S�tun';
$strComments = 'Yorumlar';
$strCompleteInserts = 'Tamamlanm�� eklemeler';
$strConfigFileError ='phpMyAdmin konfigurasyon dosyan�z� okuyamad�....<br /> Bu php yorumlama hatas� buldu�u zaman veya dosyay� bulamad��� zaman meydana gelebilir..<br /> L�tfen a�a��daki linki kullanarak dosyay� direkt olarak �a��r�n ve ald���n�z php hata mesajlar�n� okuyunuz.�o�u durumda herhangi bir yerde t�rnak veya noktal� virg�l eksiktir<br /> Bo� bir sayfayla kar��la��rsan�z ,her�ey yolunda demektir.';
$strConfigureTableCoord = ' L�tfen %s tablosu i�in koordinatlar� yap�land�r�n�z';
$strConfirm = 'A�a��daki komutu uygulamak istedi�inizden emin misiniz?';
$strCookiesRequired = 'Cookieler a�&#305;k olmal&#305;d&#305;r.';
$strCopyTableOK = '%s tablosu %s �zerine kopyaland�.';
$strCopyTable = 'Tabloyu (veritaban�<b>.</b>tablo) kopyala:';
$strCreate = 'Git';
$strCreateIndex = '%s s�tununda yeni bir index olu&#351;tur';
$strCreateIndexTopic = 'Yeni bir index olu&#351;tur';
$strCreateNewDatabase = 'Yeni veritaban� olu�tur';
$strCreateNewTable = '%s veritaban� �zerinde yeni bir tablo olu�tur';
$strCreatePage = 'Yeni sayfa olu�tur';
$strCreatePdfFeat = 'PDF\'lerin olu�turulmas�';
$strCriteria = 'Kriter';

$strDatabaseHasBeenDropped = '%s veritaban� kald�r�ld�.';
$strDatabasesStats = 'Veritaban� istatistikleri';
$strDatabases = 'veritabanlar�';
$strDatabase = 'Veritaban� ';
$strDatabaseWildcard = 'Veritaban� (* izin verili):';
$strDataOnly = 'Sadece veri';
$strData = 'Veri';
$strDefault = 'Varsay�lan';
$strDeletedRows = 'Silinen sat�rlar:';
$strDeleted = 'Sat�r silindi.';
$strDeleteFailed = 'Silme s�ras�nda hata olu�tu!';
$strDelete = 'Sil';
$strDeleteUserMessage = '%s kullan�c�s�n� sildiniz.';
$strDescending = 'Azalan';
$strDisabled = 'Etkin de�il';
$strDisplayFeat = '�zellikleri G�ster';
$strDisplay = 'G�r�nt�le';
$strDisplayOrder = 'G�r�n�m d�zeni:';
$strDisplayPDF = 'PDF �emas�n� g�ster';
$strDoAQuery = '"�rnekle sorgu" yap (joker: "%")';
$strDocu = 'Yard�m';
$strDoYouReally = 'A�a��daki komutu uygulamak istedi�inizden emin misiniz? ';
$strDropDB = 'Veritaban�\'n� kald�r %s';
$strDrop = 'Kald�r';
$strDropTable = 'Tablo\'yu kald�r';
$strDumpingData = 'Tablo d�k�m verisi';
$strDumpXRows = ' %s sat�rdan ba�layarak  %s a kadar ��kt� �ret.';
$strDynamic = 'dinamik';

$strEdit = 'D�zenle';
$strEditPDFPages = ' PDF Sayfalar�n� d�zenle';
$strEditPrivileges = '�ncelikleri D�zenle';
$strEffective = 'Efektif';
$strEmpty = 'Bo�alt';
$strEmptyResultSet = 'MySQL bo� bir sonuc k�mesi d�nd�rd� ( s�f�r sat�r).';
$strEnabled = 'Etkin';
$strEnd = 'Son';
$strEnglishPrivileges = ' Not: mySQL  �ncelik adlar� �ngilizce olarak belirtilmi�tir ';
$strError = 'Hata';
$strExplain = 'SQL\'i a��kla';
$strExport = 'D�n��t�r';
$strExportToXML = 'XML format�na d�n��t�r';
$strExtendedInserts = 'Geni�letilmi� eklemeler';
$strExtra = 'Ayr�ca';

$strField = 'Alan';
$strFieldHasBeenDropped = '%s alan� kald�r�lm��t�r';
$strFields = 'Alanlar';
$strFieldsEmpty = ' Alan say�s� bo�! ';
$strFieldsEnclosedBy = 'Alan ay�r�c� i�aret';//it does not seem well but just works
$strFieldsEscapedBy = 'Ka��� simgesi(�zel i�aretler i�in)';//it does not seem well but just works
$strFieldsTerminatedBy = 'Alan bitirici i�aret';//it does not stand seem but just works
$strFixed = 'sabit';
$strFlushTable = 'Tabloyu kapat("FLUSH")';
$strFormat = 'Bi�im';
$strFormEmpty = 'Form\'da eksik de�er !';
$strFullText = 'T�m metinler';
$strFunction = 'Fonksiyon';

$strGenBy = 'Olu�turuldu->:';
$strGeneralRelationFeat = 'Genel ili�ki �zellikleri';
$strGenTime = '��kt� Tarihi';
$strGo = 'Git';
$strGrants = 'Haklar';
$strGzip = '"gziplenmi�"';

$strHasBeenAltered = 'd�zenlendi.';
$strHasBeenCreated = 'yarat�ld�.';
$strHaveToShow = 'G�r�nt�lemek i�in en az bir s�tun se�melisiniz';
$strHome = 'Ana Sayfa';
$strHomepageOfficial = 'phpMyAdmin Web Sayfas�';
$strHomepageSourceforge = 'Sourceforge phpMyAdmin Y�kleme Sayfas�';
$strHostEmpty = 'Sunucu ismi alan� doldurulmad�!';
$strHost = 'Sunucu:';

$strIdxFulltext = 'T�m metinler';
$strIfYouWish = 'E�er bir tablo\'nun sadece baz� s�tunlar�n� y�klemek istiyorsan�z,virg�llerle ayr�lm�� bir alan listesi belirtiniz.';
$strIgnore = 'Yoksay';
$strIndexes = 'Index\'ler';
$strIndexHasBeenDropped = '%s index\'i silindi.';
$strIndex = 'Index';
$strIndexName = 'Index ismi :';
$strIndexType = 'Index tipi :';
$strInsertAsNewRow = 'Yeni bir sat�r olarak ekle';
$strInsertedRows = 'Eklenen sat�rlar:';
$strInsert = 'Ekle';
$strInsertNewRow = 'Yeni sat�r ekle';
$strInsertTextfiles = 'Tablo i�ine metin dosyas� ekle';
$strInstructions = 'Talimatlar';
$strInUse = 'kullan�mda';
$strInvalidName = '"%s" s�zc��� kullan�lamayan s�zc�k.Veritaban�/tablo/alan ismi olarak kullanamass�n�z, you can\'t use it as a database/table/field name.';

$strKeepPass = '�ifreyi de�i�tirme';
$strKeyname = 'Anahtar ismi';
$strKill = 'Kapat';

$strLength = 'Boyut';
$strLengthSet = 'Boyut/De�erler*';
$strLimitNumRows = 'Sayfa ba&#351;&#305;na kay&#305;t say&#305;s&#305;';
$strLineFeed = 'Sat�r: \\n';
$strLines = 'Sat�rlar';
$strLinesTerminatedBy = 'Sat�r sonu';
$strLinkNotFound = 'Link bulunamad�';
$strLinksTo = 'Linkler->';
$strLocationTextfile = 'Dosyadan y�kle';
$strLogin = 'Login';
$strLogout = '��k��';
$strLogPassword = '&#350;ifre:';
$strLogUsername = 'Kullan&#305;c&#305; Ad&#305;:';

$strMissingBracket = 'Parantez eksik';
$strModifications = 'De�i�iklikler kaydedildi';
$strModify = 'De�i�tir';
$strModifyIndexTopic = 'Index d�zenle';
$strMoveTableOK = '%s tablosu %s �zerine ta��nd�.';
$strMoveTable = 'Tabloyu (veritaban�<b>.</b>tablo) ta��:';
$strMySQLCharset = 'MySQL karakter seti';
$strMySQLReloaded = 'MySQL yeniden y�klendi.';
$strMySQLSaid = 'MySQL ��kt�s�: ';
$strMySQLServerProcess = ' MySQL %pma_s1%   %pma_s2%  �zerinde  %pma_s3% olarak �al���yor';
$strMySQLShowProcess = '��lemleri g�ster';
$strMySQLShowStatus = 'MySQL �al��ma zaman� bilgisini g�ster';
$strMySQLShowVars = 'MySQL sistem de�i�kenlerini g�ster';

$strName = '�sim';
$strNext = 'Sonraki';
$strNoDatabases = 'Veritaban� yok';
$strNoDescription = 'Tan�mlama yok';
$strNoDropDatabases = '"DROP DATABASE" c�mlesi burada kullan�lamaz.';
$strNoExplain = 'SQL a��klamas�n� yapma';
$strNoFrames = 'phpMyAdmin frame destekli bir taray&#305;c&#305; ile daha iyi �al&#305;&#351;maktad&#305;r...';
$strNo = 'Hay�r';
$strNoIndex = 'Index tan&#305;mlanmad&#305;!';
$strNoIndexPartsDefined = 'Index k&#305;sm&#305; tan&#305;mlanmad&#305;!';
$strNoModification = 'De�i�iklik yok';
$strNone = 'Hi�biri';
$strNoPassword = '�ifre yok';
$strNoPhp = ' PHP kodsuz';
$strNoPrivileges = 'Ayr�cal�k yok';
$strNoQuery = 'SQL sorgusu yok!';
$strNoRights = 'Burada bulunmak i�in yeterli haklara sahip de�ilsiniz!';
$strNoTablesFound = 'Veritaban�\'nda tablo bulunamad�.';
$strNotNumber = 'Bu bir say� de�il!';
$strNotOK = 'Tamam de�il';
$strNotSet = '<b>%s</b> tablosu bulunamad� veya %s i�inde tan�mlanmad�';
$strNotValidNumber = ' ge�erli bir sat�r say�s� de�il!';
$strNoUsersFound = 'Kullan�c�(lar) bulunamad�.';
$strNoValidateSQL = 'SQL do�rulamas�n� yapma';
$strNull = 'Bo�';
$strNumSearchResultsInTable = '%s e�le�im : %s tablosu i�inde';
$strNumSearchResultsTotal = 'Toplam: %s e�le�im';

$strOftenQuotation = 'S�k kullan�lan aktarma i�aretleri.SE��ME BA�LI,sadece char ve varchar alanlar�n�n "enclosed-by" karakteri ile �evrenelece�i anlam�na gelir..';
$strOK = 'Tamam';
$strOperations = '��lemler';
$strOptimizeTable = 'Tabloyu optimize et';
$strOptionalControls = '�zel karakterleri yazmak ve okumak i�in kontroller.Opsiyonel';
$strOptionally = 'Se�ime Ba�l�';
$strOptions = 'Se�enekler';
$strOr = 'veya';
$strOverhead = 'Kullan&#305;lamayan Veri';

$strPageNumber = 'Sayfa numaras�:';
$strPartialText = 'B�l�msel Metinler';
$strPasswordEmpty = '�ifre alan� doldurulmad�!';
$strPasswordNotSame = 'Girilen �ifreler ayn� de�il!';
$strPassword = '�ifre';
$strPdfDbSchema = ' "%s" veritaban�n�n �emas� - Sayfa %s';
$strPdfInvalidPageNum = 'Tan�mlanmam�� PDF sayfa numaras�!';
$strPdfInvalidTblName = ' "%s" tablosu bulunam�yor !';
$strPhp = 'PHP kodu olu�tur';
$strPHPVersion = 'PHP S�r�m�';
$strPmaDocumentation = 'phpMyAdmin yard�m';
$strPmaUriError = '<tt>$cfg[\'PmaAbsoluteUri\']</tt>\' nin de�eri  konfigurasyon dosyas�n�n i�inde verilmelidir!';
$strPos1 = 'Ba�lang��';
$strPrevious = '�nceki';
$strPrimary = 'Birincil';
$strPrimaryKey = 'Birincil anahtar';
$strPrimaryKeyHasBeenDropped = 'Birincil anahtar silindi';
$strPrimaryKeyName = 'PRIMARY KEY TEK olmal&#305;d&#305;r!';
$strPrimaryKeyWarning = '("PRIMARY" <b>sadece</b> bir anahtar&#305;n ismi <b>olmal&#305;d&#305;r!</b>)';
$strPrintView = 'Yaz�c� g�r�nt�s�';
$strPrivileges = '�ncelikler';
$strProperties = '�zellikler';

$strQBEDel = 'Del';
$strQBEIns = 'Ins';
$strQBE = ' Sorgula';
$strQueryOnDb = 'Veritaban� �zerinde SQL-sorgusu&nbsp;<b>%s</b>:';

$strRecords = 'Kay�tlar';
$strReferentialIntegrity = 'Referans b�t�nl���n� kontrol et.';
$strRelationNotWorking = 'Ba�l� tablolarla �al��mada kullan�lan ekstra �zellikler deaktif edildi...Ni�in oldu�unu ��renmek i�in %sburaya%s t�klay�n�z...';
$strRelationView = '�li�ki g�r�n�m�';
$strReloadFailed = 'MySQL yeniden y�klenmesi ger�ekle�tirilemedi.';
$strReloadMySQL = 'MySQL\'i yeniden y�kle';
$strRememberReload = 'Server\'� yeniden y�klemeyi unutmay�n�z.';
$strRenameTableOK = '%s tablosu %s olarak yeniden adland�r�ld�';
$strRenameTable = 'Tablonun ismini �una de�i�tir';
$strRepairTable = 'Tablo\'yu onar';
$strReplaceTable = 'Tablo verisini bir dosyadaki ile de�i�tir';
$strReplace = 'Yerde�i�tir';
$strReset = 'S�f�rla';
$strReType = 'Yeniden gir';
$strRevoke = 'Ge�ersiz k�l';
$strRevokeGrant = 'Hak ge�ersiz k�l';
$strRevokeGrantMessage = '%s i�in Grant �nceli&#287;ini kald&#305;rd&#305;n&#305;z';
$strRevokeMessage = '%s\'in �nceliklerini kald&#305;rd&#305;n&#305;z';
$strRevokePriv = 'Ayr�cal�klar� ge�ersiz k�l';
$strRowLength = 'Sat�r boyu';
$strRowsFrom = '(kay�t)ba�layaca�� kay�t :';
$strRowSize = ' Sat�r boyutu ';
$strRowsModeHorizontal= 'yatay';
$strRowsModeOptions= '%s modunda ve %s h�cre sonra ba&#351;l&#305;&#287;&#305; tekrarla';
$strRowsModeVertical= 'dikey';
$strRows = 'Sat�r Say�s�';
$strRowsStatistic = 'Sat�r istatisti�i';
$strRunning = ': %s �zerinde �al���yor...';
$strRunQuery = 'Sorguyu �al��t�r';
$strRunSQLQuery = '%s veritaban� �zerinde sorgu/sorgular �al��t�r';

$strSave = 'Kaydet';
$strScaleFactorSmall = '�arpan fakt�r� sayfadaki �ema i�in �ok k���k';
$strSearch = 'Ara';
$strSearchFormTitle = 'Veritaban�nda ara';
$strSearchInTables = 'Tablo(lar) i�inde:';
$strSearchNeedle = 'Aranacak kelime veya de�erler (joker: "%"):';
$strSearchOption1 = 'kelimelerin en az�ndan biri';
$strSearchOption2 = 'b�t�n kelimeler';
$strSearchOption3 = 'tam e�le�im';
$strSearchOption4 = 'normal deyim gibi';
$strSearchResultsFor = ' "%s" %s i�in arama sonu�lar�:';
$strSearchType = 'Bul:';
$strSelectADb = ' L�tfen bir veritaban&#305; se�iniz';
$strSelectAll = 'T�m�n� se�';
$strSelectFields = 'Alan se� (en az bir):';
$strSelectNumRows = 'sorgu i�erisinde';
$strSelect = 'Se�';
$strSelectTables = 'Tablolar� se�';
$strSend = 'Dosya olarak kaydet';
$strServerChoice = 'Server se�imi';
$strServerVersion = 'Server s�r�m�';
$strSetEnumVal = 'E�er alan tipi "enum" veya  "set" ise , l�tfen verileri �u formata g�re giriniz: \'a\',\'b\',\'c\'...<br>E�er bu de�erler aras�na backslash ("\") veya tek t�rnak koyman�z gerekirse ("\'"),bunun i�in backslash kullan�n (mesela \'\\\\xyz\' veya \'a\\\'b\').';
$strShowAll = 'T�m�n� g�ster';
$strShowColor = 'Rengi g�ster';
$strShowCols = 'B�t�n s�tunlar� g�ster';
$strShow = 'G�ster:';
$strShowGrid = 'Izgaray� g�ster';
$strShowingRecords = 'Kay�tlar� g�steriyor';
$strShowPHPInfo = 'PHP bilgisini g�ster';
$strShowTableDimension = 'Tablolar�n boyutlar�n� g�ster';
$strShowTables = 'Tablolar� g�ster';
$strShowThisQuery = ' Bu sorguyu burda yine g�ster ';
$strSingly = '(birer birer)';
$strSize = 'Boyut';
$strSort = 'S�rala';
$strSpaceUsage = 'Kullan�lan alan';
$strSplitWordsWithSpace = 'Kelimeler bir bo�luk karakteriyle b�l�nm��t�r (" ").';
$strSQLQuery = 'SQL-sorgusu';
$strSQLResult = 'SQL sonucu';
$strSQL = 'SQL';
$strStatement = '�fadeler';
$strStrucCSV = 'CSV verisi';
$strStrucData = 'Yap� ve Veri';
$strStrucDrop = '\'Drop table\' ekle';
$strStrucExcelCSV = 'MS Excel verisi i�in CSV';
$strStrucOnly = 'Sadece yap�';
$strStructPropose = 'Tablo yap�s�n� ayarla(mysql,tablo yap�s�n� optimize eder)';
$strStructure = 'Yap�';
$strSubmit = 'Onayla';
$strSuccess = 'SQL sorgunuz ba�ar�yla �al��t�r�lm��t�r';
$strSum = 'toplam';

$strTableComments = 'Tablo yorumlar�';
$strTableEmpty = 'Tablo ismi bo�!';
$strTableHasBeenDropped = '%s tablosu kald�r�lm��t�r';
$strTableHasBeenEmptied = '%s tablosu bo�alt�lm��t�r';
$strTableHasBeenFlushed = '%s tablosu ba&#351;ar&#305;yla kapat&#305;lm&#305;&#351;t&#305;r.';
$strTableMaintenance = 'Tablo bak�m�';
$strTables = '%s tablo';
$strTableStructure = 'Tablo i�in tablo yap�s�';
$strTable = 'tablo ';
$strTableType = 'Tablo tipi';
$strTextAreaLength = 'Boyutu nedeniyle,<br /> bu alan d�zenlenmeyebilir ';
$strTheContent = 'Dosyan�z�n i�eri�i eklendi.';
$strTheContents = 'Dosyan�n i�eri�i tablonun i�eri�ini ayn� birincil veya unique anahtar de�erli s�tunlar i�in yer de�i�tirir..';
$strTheTerminator = 'Alan bitimini belirten i�aret.';
$strTotal = 'toplam';
$strType = 'Tip';

$strUncheckAll = 'Hi�birisini Se�me';
$strUnique = 'Unique';
$strUnselectAll = 'Hi�birisini se�me';
$strUpdatePrivMessage = '%s i�in olan ayr�cal�klar� g�ncellediniz.';
$strUpdateProfileMessage = 'Profil g�ncellendi.';
$strUpdateProfile = 'Profil g�ncelle:';
$strUpdateQuery = 'Sorguyu g�ncelle';
$strUsage = 'Kullan�m';
$strUseBackquotes = 'Tablo ve alan isimleri i�in ters t�rnak " ` " i�aretini kullan';
$strUserEmpty = 'Kullan�c� ismi alan� doldurulmad�!';
$strUser = 'Kullan�c�:';
$strUserName = 'Kullan�c� ismi';
$strUsers = 'Kullan�c�lar';
$strUseTables = 'Tablolar� kullan';

$strValidateSQL = 'SQL\'i do�rula'; 
$strValue = 'De�er';
$strViewDumpDB = 'Veritaban�\'n�n d�k�m(�ema)\'�n� g�ster';
$strViewDump = 'Tablo\'nun d�k�m(�ema)\'�n� g�ster';

$strWelcome = '%s \'e HO�GELD�N�Z....';
$strWithChecked = 'se�ilileri:';
$strWrongUser = 'Hatal� kullan�c�/parola. Eri�im engellendi.';

$strYes = 'Evet';

$strZip = '"ziplenmi�"';
// To translate


$strBeginCut = 'BEGIN CUT';  //to translate
$strBeginRaw = 'BEGIN RAW';  //to translate

$strEndCut = 'END CUT';  //to translate
$strEndRaw = 'END RAW';  //to translate

$strPdfNoTables = 'No tables';  //to translate

$strSQLParserBugMessage = 'There is a chance that you may have found a bug in the SQL parser. Please examine your query closely, and check that the quotes are correct and not mis-matched. Other possible failure causes may be that you are uploading a file with binary outside of a quoted text area. You can also try your query on the MySQL command line interface. The MySQL server error output below, if there is any, may also help you in diagnosing the problem. If you still have problems or if the parser fails where the command line interface succeeds, please reduce your SQL query input to the single query that causes problems, and submit a bug report with the data chunk in the CUT section below:';  //to translate
$strSQLParserUserError = 'There seems to be an error in your SQL query. The MySQL server error output below, if there is any, may also help you in diagnosing the problem';  //to translate
$strSQPBugInvalidIdentifer = 'Invalid Identifer';  //to translate
$strSQPBugUnclosedQuote = 'Unclosed quote';  //to translate
$strSQPBugUnknownPunctuation = 'Unknown Punctuation String';  //to translate

?>
