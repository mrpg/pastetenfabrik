pastetenfabrik
==============

This is a simple pastebin written in PHP. It is used on a wide variety of web sites, e.g. as my
own private pastebin: http://paste.mrpg.pw/

It can be operated in multi-user, single-user or public mode.

To use it, please adjust the settings in pref.php and upload the whole package to your web server.
That's all - Bob's your uncle.

Depending on your setup, everybody or only people with an account (see pref.php) are allowed to
create new pastes.
Only the master may delete pastes. If your Pastetenfabrik is being operated in private mode, the
creator of the paste may also delete his or her own pastes.

Paste metadata is stored in pastes.php for the sake of simplicity. This solution is also quite fast -
even with thousands of pastes - and it is also safe. The actual pastes are stored bzip2-compressed.
