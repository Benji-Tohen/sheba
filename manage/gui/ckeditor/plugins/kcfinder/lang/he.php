<?php

/** Hebrew localization file for KCFinder
  * 
  * Transalated by Yaniv Morozovsky
  * for Tohen Media
  * yaniv@tohen-media.com
  */

$lang = array(

    '_locale' => "he_IL.UTF-8",  // UNIX localization code
    '_charset' => "utf-8",       // Browser charset

    // Date time formats. See http://www.php.net/manual/en/function.strftime.php
    '_dateTimeFull' => "יום %A, %e ב%B %Y בשעה %I:%M",
    '_dateTimeMid' => "%e ב%b' %Y בשעה %I:%M",
    '_dateTimeSmall' => "%d/%m/%Y %I:%M",

    "You don't have permissions to upload files." => "אין לך הרשאה להעלות קבצים",
    "You don't have permissions to browse server." => "אין לך הרשאה לסייר בשרת",
    "Cannot move uploaded file to target folder." => "לא ניתן להעביר את הקובץ המועלה לתיקיית היעד",
    "Unknown error." => "שגיאה",
    "The uploaded file exceeds {size} bytes." => "הקובץ המועלה חורג מהגודל המותר: {size} בייטים",
    "The uploaded file was only partially uploaded." => "הקובץ הועלה באופן חלקי בלבד",
    "No file was uploaded." => "לא הועלה קובץ",
    "Missing a temporary folder." => "חסרה תיקיה זמנית",
    "Failed to write file." => "לא ניתן לשכתב את הקובץ",
    "Denied file extension." => "סיומת הקובץ אינה מותרת",
    "Unknown image format/encoding." => "פורמט התמונה אינו מזוהה",
    "The image is too big and/or cannot be resized." => "התמונה גדולה מדי ו/או לא ניתנת להקטנה",
    "Cannot create {dir} folder." => "לא ניתן לייצר תיקייה בשם {dir}. אנא נסו שם אחר",
    "Cannot rename the folder." => "לא ניתן לשנות את שם התיקייה",
    "Cannot write to upload folder." => "לא ניתן להעלות לתיקייה זו",
    "Cannot read .htaccess" => "שגיאת קריאה בקובץ .htaccess. נא ליצור קשר עם טוחן מדיה לפתרון התקלה.",
    "Incorrect .htaccess file. Cannot rewrite it!" => "קובץ .htaccess שגוי. נא ליצור קשר עם טוחן מדיה לפתרון התקלה.",
    "Cannot read upload folder." => "תיקיית ההעלאה לא ניתנת לקריאה. נא ליצור קשר עם טוחן מדיה לפתרון התקלה",
    "Cannot access or create thumbnails folder." => "לא ניתן לגשת או ליצור תמונות מוקטנות. נא ליצור קשר עם טוחן מדיה לפתרון התקלה",
    "Cannot access or write to upload folder." => "לא ניתן לגשת או לכתוב לתיקיית ההעלאה. נא ליצור קשר עם טוחן מדיה לפתרון התקלה",
    "Please enter new folder name." => "אנא כתבו שם חדש לתיקיה",
    "Unallowable characters in folder name." => "תווים לא חוקיים בשם התיקיה. נסו להשתמש באותיות קטנות באנגלית ובמספרים בלבד",
    "Folder name shouldn't begins with '.'" => "שם תיקיה לא יכול להכיל '.'",
    "Please enter new file name." => "אנא כתבו שם חדש לקובץ זה",
    "Unallowable characters in file name." => "תווים לא מותרים בשם הקובץ",
    "File name shouldn't begins with '.'" => "שם קובץ לא יכול להתחיל ב- '.'",
    "Are you sure you want to delete this file?" => "האם אתם בטוחים שברצונכם למחוק קובץ זה?",
    "Are you sure you want to delete this folder and all its content?" => "האם אתם בטוחים שברצונכם למחוק תיקייה זו? אזהרה, כל התוכן שבתוכה יימחק",
    "Non-existing directory type." => "סוג תיקייה לא קיים",
    "Undefined MIME types." => "לא הוגדרו סוגי MIME. נא ליצור קשר עם טוחן מדיה לפתרון התקלה",
    "Fileinfo PECL extension is missing." => "מידע קובץ PECL חסר. נא ליצור קשר עם טוחן מדיה לפתרון התקלה",
    "Opening fileinfo database failed." => "פתיחת בסיס הנתונים FileInfo נכשלה. נא ליצור קשר עם טוחן מדיה לפתרון התקלה",
    "You can't upload such files." => "לא ניתן להעלות קבצים כאלה",
    "The file '{file}' does not exist." => "הקובץ '{file}' לא קיים",
    "Cannot read '{file}'." => "לא ניתן לקרוא את הקובץ '{file}'",
    "Cannot copy '{file}'." => "לא ניתן להעתיק את הקובץ '{file}'",
    "Cannot move '{file}'." => "לא ניתן להעביר את הקובץ '{file}'",
    "Cannot delete '{file}'." => "לא ניתן למחוק את הקובץ '{file}'",
    "Cannot delete the folder." => "לא ניתן למחוק את תיקייה זו",
    "Click to remove from the Clipboard" => "לחצו כאן למחיקה מהלוח",
    "This file is already added to the Clipboard." => "קובץ זה כבר קיים בלוח",
    "The files in the Clipboard are not readable." => "הקבצים בלוח אינם קריאים",
    "{count} files in the Clipboard are not readable. Do you want to copy the rest?" => "{count} קבצים בלוח אינם קריאים. האם תרצו להעתיק את היתר?",
    "The files in the Clipboard are not movable." => "הקבצים בלוח אינם ניתנים להעברה",
    "{count} files in the Clipboard are not movable. Do you want to move the rest?" => "{count} קבצים בלוח לא ניתנים להזזה. האם תרצו להעביר את היתר?",
    "The files in the Clipboard are not removable." => "הקבצים בלוח לא ניתנים להסרה",
    "{count} files in the Clipboard are not removable. Do you want to delete the rest?" => "{count} קבצים בלוח אינם ניתנים להסרה. האם תרצו למחוק את היתר?",
    "The selected files are not removable." => "הקבצים הנבחרים בלתי ניתנים להסרה",
    "{count} selected files are not removable. Do you want to delete the rest?" => "{count} קבצים מתוך בחירתכם לא ניתנים להסרה. האם תרצו למחוק את היתר?",
    "Are you sure you want to delete all selected files?" => "האם אתם בטוחים שתרצו למחוק את כל הקבצים הנבחרים?",
    "Failed to delete {count} files/folders." => "מחיקת {count} קבצים / תיקיות נכשלה",
    "A file or folder with that name already exists." => "קיימים כבר קובץ או תיקייה בשם זה",
    "Copy files here" => "העתיקו קבצים לכאן",
    "Move files here" => "העבירו קבצים לכאן",
    "Delete files" => "מחיקת קבצים",
    "Clear the Clipboard" => "ניקוי הלוח",
    "Are you sure you want to delete all files in the Clipboard?" => "האם אתם בטוחים שאתם רוצים למחוק את כל הקבצים בלוח?",
    "Copy {count} files" => "העתקת {count} קבצים",
    "Move {count} files" => "העברת {count} קבצים",
    "Add to Clipboard" => "הוספה ללוח",
    "Inexistant or inaccessible folder." => "תיקייה לא קיימת או לא נגישה",
    "New folder name:" => "שם תיקייה חדש:",
    "New file name:" => "שם קובץ חדש: ",
    "Upload" => "העלאה",
    "Refresh" => "ריענון",
    "Settings" => "הגדרות",
    "Maximize" => "הגדלה",
    "About" => "אודות",
    "files" => "קבצים",
    "selected files" => "קבצים שנבחרו",
    "View:" => "תצוגה:",
    "Show:" => "הצגה:",
    "Order by:" => "סדר לפי:",
    "Thumbnails" => "תמונות מוקטנות",
    "List" => "רשימה",
    "Name" => "שם",
    "Type" => "סוג",
    "Size" => "גודל",
    "Date" => "תאריך",
    "Descending" => "סדר יורד",
    "Uploading file..." => "מעלה קובץ...",
    "Loading image..." => "מעלה תמונה...",
    "Loading folders..." => "מעלה תיקיות...",
    "Loading files..." => "טוען קבצים...",
    "New Subfolder..." => "תיקיית משנה חדשה...",
    "Rename..." => "שינוי שם...",
    "Delete" => "מחיקה",
    "OK" => "אישור",
    "Cancel" => "ביטול",
    "Select" => "בחירה",
    "Select Thumbnail" => "בחירת תמונה מוקטנת",
    "Select Thumbnails" => "בחירת תמונות מוקטנות",
    "View" => "תצוגה",
    "Download" => "הורדה",
    "Download files" => "הורדת קבצים",
    "Clipboard" => "לוח",
    "Checking for new version..." => "בודק גרסה חדשה...",
    "Unable to connect!" => "לא ניתן להתחבר",
    "Download version {version} now!" => "הורידו את גרסת {version} עכשיו",
    "KCFinder is up to date!" => "רכיב העלאת התמונות מעודכן",
    "Licenses:" => "רישיונות:",
    "Attention" => "לתשומת ליבכם",
    "Question" => "שאלה",
    "Yes" => "כן",
    "No" => "לא",
    "You cannot rename the extension of files!" => "לא ניתן לשנות את הסיומות של הקבצים",
    "Uploading file {number} of {count}... {progress}" => "מעלה קובץ {number} מתוך {count}... {progress}",
    "Failed to upload {filename}!" => "לא ניתן להעלות את הקובץ {filename}",
	"ChooseMe" => "<strong>שימו לב:</strong> לחצו פעמיים על הקובץ כדי לבחור אותו",
);

?>