Uploader
=============

I got tired of explaining how I upload photos to my own domain in Tweetbot, so here's the stuff you need to set it up for yourself and the instructions to get it all working. Have fun.

Support
=============

If this isn't working for you, sorry. Some people have problems with it. It works fine for me. Make sure your server has PHP enabled. If that doesn't work, you're just out of luck. I don't have the know-how or time to troubleshoot your server problems.

Setup
=============

Step 1: Open uploader.php in a text editor

Step 2: Replace the one instance of "YOUR_DOMAIN_HERE" with your domain name.

Step 3: Rename uploader.php and drop it in the root directory of your domain. Keep the name a secret or others will be able to upload to your server.

Step 4: Set Tweetbot for Mac and iOS to use the custom photo and video upload option

Step 5: When Tweetbot asks for the URL of the API endpoint, enter the URL of the PHP file


Now when you tweet an image or video from Tweetbot, it should automatically upload to your server, rename it with a randomly-generated five-character filename, and return the URL of the photo to Tweetbot.

My domain is mkbs.me. My URLs look like this: http://mkbs.me/T3Djn.png


Advanced Stuff
=============

**To change the number of characters in the new filename**, find this line near the top:

    foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];

and change the 5 to another number. Larger numbers are harder for people to guess and lower the risk of the server accidentally giving two files the same name and thus overwriting the older one. Five is a good number that makes both sufficiently difficult, though four could probably work too.

**To upload photos to a specific directory**, locate the following lines (13, 24, 28):

    $uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . '/';
    
    $uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . '/';
    
    $urlToReply = ("YOUR_DOMAIN_HERE/" . $newFileName);

and add a directory name before the trailing slash at the end of each line (in the case of the last line, you'll need to add the directory and an additional slash to the URL).

Place uploader.php and the specified directory in your root folder. Files will be uploaded to the directory and the proper URL will be returned to Tweetbot.

**Migrating from a specific directory to root-only domains:** If you want to move from using a specific directory for your photos to a domain only setup as listed in the main directions above, you'll need to do the following. Note that this only applies to users who have previously setup and used a version of this uploader that employed a custom directory. New setups do not need this. These steps are only to keep existing links working.

1) Change your domain's docroot to the directory where all of your photos are uploaded. Alternatively, you can simply move all of the photos from your custom directory to root. Just make sure that visiting YOUR_DOMAIN.com/[image_filename] loads one of your existing photos.

2) Next, create an .htaccess entry as follows, with your custom directory inserted where marked:

    Redirect 301 /OLD_DIRECTORY_NAME /

Ensure that the final slash remains in place and separated from the URL by a space.

3) Update uploader.php to remove your directory name. Uploader.php should always remain in the root directory.

4) Test a new photo upload and an old URL. Both should work correctly at this point.

**Migrating from a root-only URLs to a custom directory:** If you used the above directions to migrate to root-only URLs and wish to switch back without breaking existing links, do this:

1) Change domain's docroot back to the root folder (or create a new directory inside root and move your existing photos to it).

2) Remove the .htaccess entry

    Redirect 301 /OLD_DIRECTORY_NAME /
    
3) Update uploader.php to remove your directory from these lines  (13, 24, 28):

    $uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . '/YOUR_FOLDER';
    
    $uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . '/YOUR_FOLDER';
    
    $urlToReply = ("YOUR_DOMAIN_HERE/YOUR_FOLDER/" . $newFileName);
    
4) Test a new photo upload and an old URL. Both should work correctly.
