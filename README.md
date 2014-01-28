Uploader
=============

I got tired of explaining how I upload photos to my own domain in Tweetbot, so here's the stuff you need to set it up for yourself and the instructions to get it all working. Have fun.

Support
=============

If this isn't working for you, sorry. Some people have problems with it. It works fine for me. Make sure your server has PHP enabled. If that doesn't work, you're just out of luck. I don't have the know-how or time to troubleshoot your server problems.

Setup
=============

Step 1: Open uploader.php in a text editor

Step 2: Replace all instances of the word "FOLDER" with the name of the directory you want your images uploaded to. Example: "pic/" (keep the trailing slash)

Step 3: Replace the one instance of "YOUR_DOMAIN_HERE" with your domain name.

Step 4: Rename uploader.php and drop it in the root directory of your domain. Keep the name a secret or others will be able to upload to your server.

Step 5: Create a new directory inside root with the name you picked earlier (here it's "pic," remember not to include trailing slash)

Step 6: Set Tweetbot for Mac and iOS to use the custom photo and video upload option

Step 7: When Tweetbot asks for the URL of the API endpoint, enter the URL of the PHP file


Now when you tweet an image or video from Tweetbot, it should automatically upload to your server, rename it with a randomly-generated five-character filename, place it in the directory you created (in this case, "pic") and return the URL of the photo to Tweetbot.

My domain is mkbs.me, and my image directory is pic. My URLs look like this: http://mkbs.me/pic/T3Djn.png


Advanced Stuff
=============

To change the number of characters in the new filename, find this line near the top:

    foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];

and change the 5 to another number. Larger numbers are harder for people to guess and lower the risk of the server accidentally giving two files the same name and thus overwriting the older one. Five is a good number that makes both sufficiently difficult, though four could probably work too.
